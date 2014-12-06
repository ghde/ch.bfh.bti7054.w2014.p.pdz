<?php

/**
 * Handles login & logout of a user.
 */
function handleLoginLogout() {
	global $user, $dbDao;

	// Check for login post arguments.
	if (array_key_exists("login", $_POST) //
		&& array_key_exists("username", $_POST) //
		&& array_key_exists("password", $_POST)) {

		// Create new user object = logout.
		$user = new User;

		// Validate credentials
		$customer = $dbDao->getCustomer($_POST["username"], $_POST["password"]);
		if (is_null($customer)) {
			$user->setFailedLoginTry(true);
		}
		else {
			$user->setUsername($customer->getAccountName());
			$user->setFirstname($customer->getFirstName());
			$user->setLastname($customer->getLastName());
			$user->setLoggedIn(true);
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
