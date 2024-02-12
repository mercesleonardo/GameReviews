<?php

require_once("config/globals.php");
require_once("config/db.php");
require_once("models/Game.php");
require_once("models/Message.php");
require_once("dao/GameDAO.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$gameDao = new GameDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken();

// Get the form type
$type = filter_input(INPUT_POST, "type");

// Form type check
if ($type === "create") {

    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");

    $game = new Game();

    // Minimal data verification
    if(!empty($title) && !empty($description) && !empty($category)) {

        $game->title = $title;
        $game->description = $description;
        $game->trailer = $trailer;
        $game->category = $category;
        $game->users_id = $userData->id;

        // Upload game image
        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            // Checking the image type
            if(in_array($image["type"], $imageTypes)) {

                // Cheking if the image is jpg
                if(in_array($image["type"], $jpgArray)) {

                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                } else {

                    $imageFile = imagecreatefrompng($image["tmp_name"]);

                }

                // Generating the image name
                $imageName = $game->imageGenerateName();

                imagejpeg($imageFile, "./img/games/" . $imageName, 100);

                $game->image = $imageName;

            } else {

                $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
      
            }

            
        }
        
        $gameDao->create($game);

    } else {

        $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");

    }

} else if ($type === "update") {



} else if ($type === "delete") {



} else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

}