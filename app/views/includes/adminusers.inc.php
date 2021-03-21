<?php

	$allUsers = $admin->getAllUsers();

	foreach ($allUsers as $user) {
		echo '<tr style="vertical-align: middle;">
				<td>' . $user->id . '</th>
				<td>' . $user->username . '</td>
				<td>' . $user->email . '</td>
				<td>' . formatGroup($user->privilegegroup) . '</td>
				<td>' . formatPostCount($users->allPosts($user->id)) . '</td>
				<td><button type="button" class="btn btn-danger btn-sm deleteButton" data-toggle="modal" data-target="#modalDelete" onclick="setIdDelete(' . $user->id . ');"><i class="material-icons" style="vertical-align: middle;">close</i></td>
				<td><button type="button" class="btn btn-success btn-sm editButton" data-toggle="modal" data-target="#modalEdit" onclick="setIdEdit(' . $user->id . ');"><i class="material-icons" style="vertical-align: middle;">mode</i></td>
			</tr>';
	}