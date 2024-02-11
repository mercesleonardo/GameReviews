<?php 

    require_once("templates/header.php");
?>
    <div id="main-container" class="container-fluid">
        <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result">Filme B</span></h2>
        <p class="section-description">
            Resultados de buscas retornados com base na sua pesquisa
        </p>
        <div class="movies-container">
        <div class="card movie-card">
            <div class="card-img-top"></div>
            <div class="card-body">
                <p class="card-rating">
                    <i class="fas fa-star"></i>
                    <span class="rating">9,5</span>
                </p>
                <h5 class="card-title">
                    <a href="movie.php">Título</a>
                </h5>
                <a href="movie.php" class="btn btn-primary rate-btn">Avaliar</a>
                <a href="movie.php" class="btn btn-primary card-btn">Conhecer</a>
            </div>
        </div>
                <p class="empty-list">Não há filmes para esta busca, <a href="" class="back-link">voltar</a>.</p>
        </div>
        
    </div>
<?php
    require_once("templates/footer.php")
?>