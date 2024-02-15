<?php 

    require_once("templates/header.php");
    require_once("dao/GameDAO.php");
    
    $gameDao = new GameDAO($conn, $BASE_URL);

    $latestGames = $gameDao->getLatestGames();
    $actionAndAdventuresGames = $gameDao->getGamesByCategory("Ação e Aventura");
    $sportsGames = $gameDao->getGamesByCategory("Esportes");
    $battleRoyaleGames = $gameDao->getGamesByCategory("Battle Royale");

?>
    <div id="main-container" class="container-fluid">

        <h2 class="section-title">Jogos novos</h2>
        <p class="section-description"> Veja as críticas dos últimos jogos adicionados no GameReviews </p>
        <div class="games-container">
            <?php foreach ($latestGames as $game): ?>
                <?php require("templates/game_card.php"); ?>
            <?php endforeach; ?>
            <?php if(count($latestGames) === 0): ?>
                <p class="empty-list">Ainda não há jogos cadastrados</p>
            <?php endif; ?>
        </div>

        <h2 class="section-title">Ação e Aventura</h2>
        <p class="section-description"> Veja os melhores jogos de ação e aventura </p>
        <div class="games-container">
            <?php foreach ($actionAndAdventuresGames as $game): ?>
                <?php require("templates/game_card.php"); ?>
            <?php endforeach; ?>
            <?php if(count($actionAndAdventuresGames) === 0): ?>
                <p class="empty-list">Ainda não há jogos cadastrados</p>
            <?php endif; ?>
        </div>

        <h2 class="section-title">Esportes</h2>
        <p class="section-description"> Veja os melhores jogos de esportes </p>
        <div class="games-container">
            <?php foreach ($sportsGames as $game): ?>
                <?php require("templates/game_card.php"); ?>
            <?php endforeach; ?>
            <?php if(count($sportsGames) === 0): ?>
                <p class="empty-list">Ainda não há jogos cadastrados</p>
            <?php endif; ?>
        </div>

        <h2 class="section-title">Battle Royale</h2>
        <p class="section-description"> Veja os melhores jogos de Battle Royale </p>
        <div class="games-container">
            <?php foreach ($battleRoyaleGames as $game): ?>
                <?php require("templates/game_card.php"); ?>
            <?php endforeach; ?>
            <?php if(count($battleRoyaleGames) === 0): ?>
                <p class="empty-list">Ainda não há jogos cadastrados</p>
            <?php endif; ?>
        </div>
    </div>
<?php

    require_once("templates/footer.php")
    
?>