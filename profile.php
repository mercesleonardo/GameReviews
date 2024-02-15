<?php
  require_once("templates/header.php");
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/GameDAO.php");

  $user = new User();
  $userDao = new UserDAO($conn, $BASE_URL);
  $gameDao = new GameDAO($conn, $BASE_URL);

  $id = filter_input(INPUT_GET, "id");

  if(empty($id)) {

    if(!empty($userData)) {

      $id = $userData->id;

    } else {

      $message->setMessage("Usuário não encontrado!", "error", "index.php");

    }

  } else {

    $userData = $userDao->findById($id);

    if(!$userData) {

      $message->setMessage("Usuário não encontrado!", "error", "index.php");

    }

  }

  $fullName = $user->getFullName($userData);

  if($userData->image == "") {

    $userData->image = "user.png";
    
  }

  $userGames = $gameDao->getGamesByUserId($id);

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
      <div class="row profile-container">
        <div class="col-md-12 about-container">
          <h1 class="page-title"><?= $fullName ?></h1>
          <div id="profile-image-container" class="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
          <h3 class="about-title">Sobre:</h3>
          <?php if(!empty($userData->bio)): ?>
            <p class="profile-description"><?= $userData->bio ?></p>
          <?php else: ?>
            <p class="profile-description">O usuário ainda não escreveu nada aqui...</p>
          <?php endif; ?>
        </div>
        <div class="col-md-12 added-games-container">
          <h3>Jogoss que enviou:</h3>
          <div class="games-container">
            <?php foreach($userGames as $game): ?>
              <?php require("templates/game_card.php"); ?>
            <?php endforeach; ?>
            <?php if(count($userGames) === 0): ?>
              <p class="empty-list">O usuário ainda não enviou jogos.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>