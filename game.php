<?php
  require_once("templates/header.php");

  // Verifica se usuário está autenticado
  require_once("models/Game.php");
  require_once("dao/GameDAO.php");
  require_once("dao/ReviewDAO.php");

  $id = filter_input(INPUT_GET, "id");

  $game;

  $gameDao = new GameDAO($conn, $BASE_URL);

  $reviewDao = new ReviewDAO($conn, $BASE_URL);

  if(empty($id)) {

    $message->setMessage("O filme não foi encontrado!", "error", "index.php");

  } else {

    $game = $gameDao->findById($id);

    if(!$game) {

      $message->setMessage("O filme não foi encontrado!", "error", "index.php");

    }

  }

  if($game->image == "") {

    $game->image = "game_cover.jpg";

  }

  $userOwnsGame = false;

  if(!empty($userData)) {

    if($userData->id === $game->users_id) {

      $userOwnsGame = true;

    }

    $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->id);
 
  }

  $gameReviews = $reviewDao->getGamesReview($game->id);

?>
<div id="main-container" class="container-fluid">
  <div class="row">
    <div class="offset-md-1 col-md-6 game-container">
      <h1 class="page-title"><?= $game->title ?></h1>
      <p class="game-details">
        <span class="pipe"></span>
        <span><?= $game->category ?></span>
        <span class="pipe"></span>
        <span><i class="fas fa-star"></i> <?= $game->rating ?></span>
      </p>
      <iframe src="<?= $game->trailer ?>" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encryted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p><?= $game->description ?></p>
    </div>
    <div class="col-md-4">
      <div class="game-image-container" style="background-image: url('<?= $BASE_URL ?>img/games/<?= $game->image ?>')"></div>
    </div>
    <div class="offset-md-1 col-md-10" id="reviews-container">
      <h3 id="reviews-title">Avaliações:</h3>
      <?php if(!empty($userData) && !$userOwnsGame && !$alreadyReviewed): ?>
        <div class="col-md-12" id="review-form-container">
          <h4>Envie sua avaliação:</h4>
          <p class="page-description">Preencha o formulário com a nota e comentário sobre o jogo</p>
          <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
            <input type="hidden" name="type" value="create">
            <input type="hidden" name="games_id" value="<?= $game->id ?>">
            <div class="form-group">
              <label for="rating">Nota do jogo:</label>
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
              <textarea name="review" id="review" rows="3" class="form-control" placeholder="O que você achou do jogo?"></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Enviar comentário">
          </form>
        </div>
      <?php endif; ?>
      <?php foreach($gameReviews as $review): ?>
        <?php require("templates/user_review.php"); ?>
      <?php endforeach; ?>
      <?php if(count($gameReviews) == 0): ?>
        <p class="empty-list">Não há comentários para este jogo ainda...</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php
  require_once("templates/footer.php");
?>