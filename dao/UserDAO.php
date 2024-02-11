<?php

require_once("models/User.php");
require_once("models/Message.php");

class UserDao implements UserDAOInterface {


    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {

        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);

    }

    // Build and return a User object from the provided data.
    public function buildUser($data) {

        $user = new User();

        $user->id = $data['id'];
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->bio = $data['bio'];
        $user->image = $data['image'];
        $user->password = $data['password'];
        $user->token = $data['token'];

        return $user;

    }

    public function create(User $user, $authUser = false) {

        $stmt = $this->conn->prepare("INSERT INTO users(email, name, lastname, password, token) VALUES(:email, :name, :lastname, :password, :token)");

        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":lastname", $user->lastname);
        $stmt->bindParam(":password", $user->password);
        $stmt->bindParam(":token", $user->token);

        $stmt->execute();

        // Authenticate user, if auth is true
        if($authUser) {

            $this->setTokenToSession($user->token);

        }

    }

    public function update(User $user, $redirect = true) {

        $stmt = $this->conn->prepare("UPDATE users SET email = :email, name = :name, lastname = :lastname, bio = :bio, image = :image, token = :token WHERE id = :id");

        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":lastname", $user->lastname);
        $stmt->bindParam(":bio", $user->bio);
        $stmt->bindParam(":image", $user->image);
        $stmt->bindParam(":token", $user->token);
        $stmt->bindParam(":id", $user->id);

        $stmt->execute();

        if($redirect) {

            $this->message->setMessage("Dados atualizados com sucesso!", "success", "editprofile.php");

        }

    }

    public function destroyToken() {


    }

    public function changePassword(User $user) {


    }

    public function verifyToken($protected = false) {


    }

    public function setTokenToSession($token, $redirect = true) {

        // Salve token in session
        $_SESSION["token"] = $token;

        if($redirect) {

            // Redirect to user edit page
            $this->message->setMessage("Seja bem-vindo!", "success", "editprofile.php");

        }

    }

    public function authenticateUser($email, $password) {

        $user = $this->findByEmail($email);

        if($user) {

            // Check is password is correct
            if(password_verify($password, $user->password)) {

                // Build a token and insert into session
                $token = $user->generateToken();

                $this->setTokenToSession($token, false);

                // update user token
                $user->token = $token;

                $this->update($user, false);

                return true;

            } else {

                return false;

            }

        } else {

            return false;

        }

    }

    public function findByEmail($email) {

        if($email != "") {

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");

            $stmt->bindParam(":email", $email);

            $stmt->execute();

            if($stmt->rowCount() > 0) {

                $data = $stmt->fetch();
                $user = $this->buildUser($data);

                return $user;

            } else {

                return false;

            }

        } else {

            return false;

        }


    }

    public function findById($id) {


    }

    public function findByToken($token) {


    }


}