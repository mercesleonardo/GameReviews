<?php

require_once("models/Game.php");
require_once("models/Message.php");

class GameDAO implements GameDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {

        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);

    }

    public function buildGame($data) {

        $game = new Game();

        $game->id = $data['id'];
        $game->title = $data['title'];
        $game->description = $data['description'];
        $game->image = $data['image'];
        $game->trailer = $data['trailer'];
        $game->category = $data['category'];
        $game->users_id = $data['users_id'];

        return $game;

    }

    public function create(Game $game) {

        $stmt = $this->conn->prepare("INSERT INTO games(title, description, image, trailer, category, users_id) VALUES (:title, :description, :image, :trailer, :category, :users_id)");

        $stmt->bindParam(":title", $game->title);
        $stmt->bindParam(":description", $game->description);
        $stmt->bindParam(":image", $game->image);
        $stmt->bindParam(":trailer", $game->trailer);
        $stmt->bindParam(":category", $game->category);
        $stmt->bindParam(":users_id", $game->users_id);

        $stmt->execute();

        $this->message->setMessage("Jogo adicionado com sucesso!", "success", "index.php");

    }

    public function update(Game $game) {

    }

    public function destroy($id) {

    }

    public function findAll() {

    }

    public function findById($id) {

    }

    public function findByTitle($title) {

    }

    public function getLatestGames() {

    }

    public function getGamesByCategory($category) {

    }

    public function getGamesByUserId($id) {

    }

}