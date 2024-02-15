<?php

  require_once("templates/header.php");
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/GameDAO.php");

  $gameDao = new GameDao($conn, $BASE_URL);
  $userDao = new UserDao($conn, $BASE_URL);
  $user = new User();

  // Checks if the user is authenticated
  $userData = $userDao->verifyToken(true);

  $id = filter_input(INPUT_GET, "id");

  if(empty($id)) {

    $message->setMessage("O jogo não foi encontrado!", "error", "index.php");

  } else {

    $game = $gameDao->findById($id);

    // Checks if the game exists
    if(!$game) {

      $message->setMessage("O jogo não foi encontrado!", "error", "index.php");

    }

  }

  // Check if the game has an image
  if($game->image == "") {

    $game->image = "game_cover.jpg";

  }

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 offset-md-1">
          <h1><?= $game->title ?></h1>
          <p class="page-description">Altere os dados do jogo no formulário abaixo:</p>
          <form id="edit-game-form" action="<?= $BASE_URL ?>game_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?= $game->id ?>">
            <div class="form-group">
              <label for="title">Título:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu jogo" value="<?= $game->title ?>">
            </div>
            <div class="form-group">
              <label for="image">Imagem:</label>
              <input type="file" class="form-control-file" name="image" id="image">
            </div>            
            <div class="form-group">
              <label for="category">Category:</label>
              <select name="category" id="category" class="form-control">
                <option value="">Selecione</option>
                <option value="Ação e Aventura" <?= $game->category === "Ação e Aventura" ? "selected" : "" ?>>Ação e Aventura</option>
                <option value="Battle Royale" <?= $game->category === "Battle Royale" ? "selected" : "" ?>>Battle Royale</option>
                <option value="Construção e Gestão" <?= $game->category === "Construção e Gestão" ? "selected" : "" ?>>Construção e Gestão</option>
                <option value="Corrida" <?= $game->category === "Corrida" ? "selected" : "" ?>>Corrida</option>
                <option value="Estratégia" <?= $game->category === "Estratégia" ? "selected" : "" ?>>Estratégia</option>
                <option value="Esportes" <?= $game->category === "Esportes" ? "selected" : "" ?>>Esportes</option>
                <option value="FPS" <?= $game->category === "FPS" ? "selected" : "" ?>>FPS</option>
                <option value="Indie" <?= $game->category === "Indie" ? "selected" : "" ?>>Indie</option>
                <option value="Luta" <?= $game->category === "Luta" ? "selected" : "" ?>>Luta</option>
                <option value="MMORPG" <?= $game->category === "MMORPG" ? "selected" : "" ?>>MMORPG</option>
                <option value="Mundo Aberto" <?= $game->category === "Mundo Aberto" ? "selected" : "" ?>>Mundo Aberto</option>
                <option value="Narrativos" <?= $game->category === "Narrativos" ? "selected" : "" ?>>Narrativos</option>
                <option value="Plataforma" <?= $game->category === "Plataforma" ? "selected" : "" ?>>Plataforma</option>
                <option value="Puzzle" <?= $game->category === "Puzzle" ? "selected" : "" ?>>Puzzle</option>
                <option value="RTS" <?= $game->category === "RTS" ? "selected" : "" ?>>RTS</option>
                <option value="RPG" <?= $game->category === "RPG" ? "selected" : "" ?>>RPG</option>
                <option value="Roguelike/Roguelite" <?= $game->category === "Roguelike/Roguelite" ? "selected" : "" ?>>Roguelike/Roguelite</option>
                <option value="Simulação" <?= $game->category === "Simulação" ? "selected" : "" ?>>Simulação</option>
                <option value="Survival Horror" <?= $game->category === "Survival Horror" ? "selected" : "" ?>>Survival Horror</option>
              </select>
            </div>
            <div class="form-group">
              <label for="trailer">Trailer:</label>
              <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer" value="<?= $game->trailer ?>">
            </div>
            <div class="form-group">
              <label for="description">Descrição:</label>
              <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o jogo..."><?= $game->description ?></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Editar jogo">
          </form>
        </div>
        <div class="col-md-3">
          <div class="game-image-container" style="background-image: url('<?= $BASE_URL ?>img/games/<?= $game->image ?>')"></div>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>