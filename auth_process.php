<?php

require_once("config/globals.php");
require_once("config/db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

// Get the form type
$type = filter_input(INPUT_POST, "type");

// Form type ckeck
if ($type === "register") {

    $email = filter_input(INPUT_POST, "email");
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Minimum data check
    if($email && $name && $lastname && $password) {

        // Check if passwords match
        if($password === $confirmpassword) {

            // Check if email only exists in the database
            if($userDao->findByEmail($email) === false) {

                $user = new User();

                // Token and password creation
                $userToken = $user->generateToken();
                $finalPassword = $user->generatePassword($password);
                
                $user->email = $email;
                $user->name = $name;
                $user->lastname = $lastname;
                $user->password = $finalPassword;
                $user->token = $userToken;

                $auth = true;

                $userDao->create($user, $auth);

            } else {

                $message->setMessage("Usuário já cadastrado, tente outro e-mail.", "error", "back");

            }

        } else {

            $message->setMessage("As senhas não são iguais.", "error", "back");

        }

    } else {

        $message->setMessage("Por favor, preencha todos os campos.", "error", "back");

    }

} else if ($type === "login") {

    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    // Try to authenticate the user
    if($userDao->authenticateUser($email, $password)) {

        $message->setMessage("Seja bem-vindo!", "success", "editprofile.php");

    } else {

        $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");

    }

} else {

    $message->setMessage("Informações inválidas.", "error", "index.php");    

}