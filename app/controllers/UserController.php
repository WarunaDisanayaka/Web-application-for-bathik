<?php

class UserController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // validate input
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // create user
            $user = new User($username, $email, $password);

            // save user to database
            if ($user->save()) {
                // redirect to login page
                header('Location: /login.php');
            } else {
                // display error message
                $error = 'Registration failed. Please try again.';
            }
        }

        // load view
        require_once('../views/user_registration.php');
    }
}
