<?php 

    require_once("templates/header.php");
?>
    <div id="main-container" class="container-fluid">
        <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result">Game B</span></h2>
        <p class="section-description">
            Resultados de buscas retornados com base na sua pesquisa
        </p>
        <div class="games-container">
        <div class="card game-card">
            <div class="card-img-top"></div>
            <div class="card-body">
                <p class="card-rating">
                    <i class="fas fa-star"></i>
                    <span class="rating">9,5</span>
                </p>
                <h5 class="card-title">
                    <a href="game.php">Título</a>
                </h5>
                <a href="game.php" class="btn btn-primary rate-btn">Avaliar</a>
                <a href="game.php" class="btn btn-primary card-btn">Conhecer</a>
            </div>
        </div>
                <p class="empty-list">Não há jogos para esta busca, <a href="" class="back-link">voltar</a>.</p>
        </div>
        
    </div>
<?php
    require_once("templates/footer.php")
?>