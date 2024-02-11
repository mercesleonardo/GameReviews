<?php 

    require_once("templates/header.php");    

?>
    <div id="main-container" class="container-fluid">
        <h2 class="section-title">Filmes novos</h2>
        <p class="section-description">
            Veja as críticas dos últimos filmes adicionados no MovieStar
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
            <!-- <p class="empty-list">Ainda não há filmes cadastrados!</p> -->
        </div>
    </div>
<?php
    require_once("templates/footer.php")
?>