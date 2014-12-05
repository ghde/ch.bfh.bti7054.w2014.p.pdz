<?php

/**
 * Handles login & logout of a user.
 */
function handleLoginLogout() {

	global $user;

	// Check for login post arguments.
	if (array_key_exists("login", $_POST) //
		&& array_key_exists("username", $_POST) //
		&& array_key_exists("password", $_POST)) {

		// Create new user object = logout.
		$user = new User;

		// Validate credentials
		// TODO : get user data from database
		if (($_POST["username"] == "peter" && $_POST["password"] == "pan")
			|| ($_POST["username"] == "micky" && $_POST["password"] == "maus")) {

			$user->setId(1);
			$user->setUsername($_POST["username"]);
			$user->setFirstname($_POST["username"]);
			$user->setLastname($_POST["password"]);
			$user->setLoggedIn(true);
		} else {
			$user->setFailedLoginTry(true);
		}

		// Save change user object, write & close session.
		$_SESSION["user"] = $user;
		session_write_close();

		// Redirect user.
		header("Location: " . $_SERVER["REQUEST_URI"]);


	} else if (array_key_exists("logout", $_POST)) {

		// Delete session
		session_destroy();

		// Redirect user.
		header("Location: " . $_SERVER["REQUEST_URI"]);
	}
}
