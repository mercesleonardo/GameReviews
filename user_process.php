<?php

require_once("config/globals.php");
require_once("config/db.php");
require_once("dao/UserDAO.php");
require_once("models/User.php");
require_once("models/Message.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

// Get the form type
$type = filter_input(INPUT_POST, "type");

// Form type check
if ($type === "update") {

    //Get user data
    $userData = $userDao->verifyToken();

    //Receive post data
    $email = filter_input(INPUT_POST, "email");
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $bio = filter_input(INPUT_POST, "bio");

    // Create a new user object
    $user = new User();

    // Fill in user data
    $userData->email = $email;
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->bio = $bio;

    // upload image
    if(isset($_FILES["image"]) && $_FILES["image"]["tmp_name"]) {

        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/png", "image/gif", "image/jpg"];
        $imageArray = ["image/jpeg", "image/jpg"];
        $imageGif = ["image/gif"];

        //check image types
        if(in_array($image["type"], $imageTypes)) {

            // If image type is jpeg or jpg
            if(in_array($image["type"], $imageArray)) {

                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
            
            // If image type is gif
            } else if(in_array($image["type"], $imageGif)) {

                $imageFile = imagecreatefromgif($image["tmp_name"]);
            
            // Image is png    
            } else {

                $imageFile = imagecreatefrompng($image["tmp_name"]);

            }
            
            // Delete the old image file if it exists
            if(!empty($userData->image)) {

                $oldImage = "./img/users/" . $userData->image;

                if(file_exists($oldImage)) {

                    unlink($oldImage);

                }

            }

            $imageName = $user->imageGenerateName();

            imagejpeg($imageFile, "./img/users/" . $imageName, 100);

            $userData->image = $imageName;

        } else {

            $message->setMessage("Tipo inválido de imagem, insira png, gif ou jpg!", "error", "back");

        }

    }

    $userDao->update($userData);
    
// update password
} else if ($type === "changepassword") {

    //Get post data
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Receive post data
    $userData = $userDao->verifyToken();

    $id = $userData->id;

    // Check if password is correct
    if($password === $confirmpassword) {

        // Create a new user object
        $user = new User();

        $finalPassword = $user->generatePassword($password);

        $user->password = $finalPassword;
        $user->id = $id;

        $userDao->changePassword($user);

    } else {

        $message->setMessage("As senhas não são iguais!", "error", "back");

    }

} else {

    $message->setMessage("informações inválidas", "error", "index.php");

}