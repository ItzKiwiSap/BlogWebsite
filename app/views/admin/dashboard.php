<?php
    require_once APPROOT . '/views/includes/head.inc.php';
    require_once APPROOT . '/views/includes/navigation.inc.php';

    if(!isAdmin()) {
      header("Location: " . URLROOT);
      return;
    }

    require_once APPROOT . '/controllers/Users.php';
    require_once APPROOT . '/controllers/Posts.php';

    $users = new Users;
    $posts = new Posts;
?>

<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container mt-4">
                <div class="row">
                	<h1 class="col">Dashboard</h1>
                   <a class="col d-flex justify-content-end mt-4" href="<?php echo URLROOT; ?>/admin/users">Bekijk gebruikers</a>
               </div>

               <div class="row d-flex justify-content-around">
                <div class="col-sm-4 col-md-2">
                    <div class="card shadow border-left-primary h-100 align-items-stretch">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>totaal aantal gebruikers</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $users->getTotalUserCount(); ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="card shadow border-left-success h-100 align-items-stretch">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>blogs</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0 d-flex align-items-center"><span><?php echo $posts->getTotalPostCount(); ?></span></div>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="card shadow border-left-info h-100 align-items-stretch">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>bloggers (Inc. beheerders)</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $users->getBloggers(true); ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="card shadow border-left-info h-100 align-items-stretch">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>bloggers (Exc. beheerders)</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $users->getBloggers(false); ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-2">
                    <div class="card shadow border-left-danger h-100 align-items-stretch">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-danger font-weight-bold text-xs mb-1"><span>beheerders</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $users->getAdmins(); ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row chartDiv mt-4">
                <div class="col">
                    <div class="card shadow mb-4"><div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand"><div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary font-weight-bold m-0">Blogs gepubliceerd</h6>
                    </div>
                    <canvas style="min-height: 250px; display: block; height: 182px; width: 1043px;" id="newBlogs" width="1303" height="227" class="chartjs-render-monitor"></canvas>
                </div>
            </div>

            <div class="row pieDiv mb-5">
                <div class="col-md-6">
                    <div class="card shadow"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <div class="card-header d-flex justify-content-center align-items-center">
                            <h6 class="text-primary font-weight-bold m-0 center">Gebruikers</h6>
                        </div>

                        <canvas id="users" width="385" height="192" class="chartjs-render-monitor" style="display: block; height: 154px; width: 308px;"></canvas>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <div class="card-header d-flex justify-content-center align-items-center">
                            <h6 class="text-primary font-weight-bold m-0 center">Top gebruikers (Aantal blogs)</h6>
                        </div>

                        <canvas id="topUsers" width="385" height="192" class="chartjs-render-monitor" style="display: block; height: 154px; width: 308px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '<?php echo URLROOT . '/pages/dashboarddata'; ?>',
            type: 'GET',
            success: function(data) {
                var postData = data.posts;
                var userData = data.users;
                var topUserData = data.topUsers;

                moment.locale("nl");

                var lowestCount = 0;
                var highestCount = 0;

                var days = [];
                var count = [];

                var tempday = 0;
                var tempCount = 0;

                var last;

                for(var i in postData) {
                    if(tempday == 0) {
                        tempday = parseInt(moment(postData[i].creationtime).format("DDDD"));
                    }

                    if(tempday == parseInt(moment(postData[i].creationtime).format("DDDD"))) {
                        tempCount++;
                    }

                    if(!(+i + +1 <= +postData.length - +1 && tempday == parseInt(moment(postData[+i + +1].creationtime).format("DDDD")))) {
                        count.push(tempCount);
                        days.push(capitalizeWords(moment(postData[i].creationtime).format("DD MMMM")));

                        if(highestCount == 0) highestCount = tempCount;
                        if(lowestCount == 0 && highestCount != 0 && tempCount < highestCount) lowestCount = tempCount;

                        if(tempCount > highestCount) highestCount = tempCount;
                        if(tempCount < lowestCount) lowestCount = tempCount;

                        last = moment(postData[i].creationtime);

                        if(+i + +1 <= +postData.length - +1) {
                            last = moment(postData[+i + +1].creationtime);
                            var start = moment(postData[i].creationtime).add(1, 'days');

                            while(start.format("M/D/YYYY") != moment(postData[+i + +1].creationtime).format("M/D/YYYY")) {
                                days.push(capitalizeWords(start.format("DD MMMM")));
                                count.push(0);
                                start.add(1, 'days');
                            }
                        }

                        if(moment().isSameOrBefore(last)) {
                            var start = moment().add(1, 'days');

                            while(start.isSameOrBefore(last)) {
                                days.push(capitalizeWords(start.format("DD MMMM")));
                                count.push(0);
                                start.add(1, 'days');
                            }
                        }

                        tempday = 0;
                        tempCount = 0;
                    }

                    if(tempday == 0 && tempCount == 0 && days.length == 30) break;
                }

                if(moment(last).diff(postData[0].creationtime, 'days') < 30) {
                    var toAdd = +30 - +moment(last).diff(postData[0].creationtime, 'days');
                    var lastAdded = moment(postData[0].creationtime).subtract(1, 'days');

                    for(var i = 0; i < toAdd; i++) {
                        days.unshift(capitalizeWords(lastAdded.format("DD MMMM")));
                        count.unshift(0);
                        lastAdded = lastAdded.subtract(1, 'days');
                    }
                }

                var postChartData = {
                    labels: days,
                    datasets: [{
                        label: "Blogs gepubliceerd",
                        fill: true,
                        lineTensions: 1,
                        backgroundColor: "rgba(0, 17, 255, 0.51)",
                        borderColor: "rgba(0, 17, 255, 1)",
                        data: count
                    }]
                };

                var postCtx = $("#newBlogs");

                var postChart = new Chart(postCtx, {
                    type: 'line',
                    data: postChartData,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    suggestedMin: (+lowestCount - +5 < 0) ? 0 : lowestCount,
                                    suggestedMax: +highestCount + +5
                                }
                            }]
                        }
                    }
                });

                var userChartData = {
                    labels: ['Gebruikers', 'Bloggers', 'Beheerders'],
                    datasets: [{
                        data: [userData.users, userData.bloggers, userData.admins],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ]
                    }]
                };

                var userCtx = $("#users");

                var userChart = new Chart(userCtx, {
                    type: 'pie',
                    data: userChartData
                });

                var topUsers = [];
                var topUserPosts = [];

                for(var i in topUserData) {
                    topUsers.push(i);
                    topUserPosts.push(topUserData[i]);
                }

                var topUserChartData = {
                    labels: topUsers,
                    datasets: [{
                        data: topUserPosts,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            '#66ff66',
                            '#ff66ff',
                            '#FF1E1E',
                            '#B7B21A',
                            '#37F4FB',
                            '#EFAB7F',
                            '#C314E2'
                        ]
                    }]
                };

                var topUserCtx = $("#topUsers");

                var topUserChart = new Chart(topUserCtx, {
                    type: 'pie',
                    data: topUserChartData
                });
            },
            error: function(data) {

            }
        });
    });

    function capitalizeWords(string) {
        return string.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
    }
</script>