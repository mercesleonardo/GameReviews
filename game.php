<?php

  require_once("templates/header.php");
  require_once("models/Game.php");
  require_once("dao/GameDAO.php");

  $id = filter_input(INPUT_GET, "id");

  $game;

  $gameDao = new GameDAO($conn, $BASE_URL);

  if(empty($id)) {

    $message->setMessage("O jogo não foi encontrado!", "error", "index.php");

  } else {

    $game = $gameDao->findById($id);

    // Checking if the game exists
    if(!$game) {

      $message->setMessage("O jogo não foi encontrado!", "error", "index.php");

    }

  }

  // Checking if the game has an image
  if($game->image == "") {

    $game->image = "game_cover.jpg";

  }

  // Checking if the game belongs to the user
  $userOwnsGame = false;

  if(!empty($userData)) {

    if($userData->id === $game->users_id) {

      $userOwnsGame = true;

    }

  }

?>
<div id="main-container" class="container-fluid">
  <div class="row">
    <div class="offset-md-1 col-md-6 game-container">
      <h1 class="page-title"><?= $game->title ?></h1>
      <p class="game-details">
        <span class="pipe"></span>
        <span><?= $game->category ?></span>
        <span class="pipe"></span>
        <span><i class="fas fa-star"></i> 10</span>
      </p>
      <iframe src="<?= $game->trailer ?>" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encryted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p><?= $game->description ?></p>
    </div>
    <div class="col-md-4">
      <div class="game-image-container" style="background-image: url('<?= $BASE_URL ?>img/games/<?= $game->image ?>')"></div>
    </div>
    <div class="offset-md-1 col-md-10" id="reviews-container">
      <h3 id="reviews-title">Avaliações:</h3>
        <div class="col-md-12" id="review-form-container">
            <h4>Envie sua avaliação:</h4>
            <p class="page-description">Preencha o formulário com a nota e comentário sobre o filme</p>
            <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
            <input type="hidden" name="type" value="create">
            <input type="hidden" name="games_id" value="<?= $game->id ?>">
            <div class="form-group">
                <label for="rating">Nota do filme:</label>
                <select name="rating" id="rating" class="form-control">
                <option value="">Selecione</option>
                <option value="10">10</option>
                <option value="9">9</option>
                <option value="8">8</option>
                <option value="7">7</option>
                <option value="6">6</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
                </select>
            </div>
            <div class="form-group">
                <label for="review">Seu comentário:</label>
                <textarea name="review" id="review" rows="3" class="form-control" placeholder="O que você achou do filme?"></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Enviar comentário">
            </form>
        </div>
      <!-- Comentários -->
      <div class="col-md-12 review">
        <div class="row">
          <div class="col-md-1">
            <div class="profile-image-container review-image"></div>
          </div>
          <div class="col-md-9 author-details-container">
            <h4 class="author-name">
              <a href="profile.php">Leonardo Carvalho</a>
            </h4>
            <p><i class="fas fa-star">8</p>
          </div>
          <div class="col-md-12">
            <p class="comment-title">Comentário:</p>
            <p>Comentário do filme</p>
          </div>
        </div>
      </div>
        <p class="empty-list">Não há comentários para este filme ainda...</p>
    </div>
  </div>
</div>
<?php

  require_once("templates/footer.php");
  
?>