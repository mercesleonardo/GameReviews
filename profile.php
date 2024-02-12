<?php
  require_once("templates/header.php");

?>

  <div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
      <div class="row profile-container">
        <div class="col-md-12 about-container">
          <h1 class="page-title">Leonardo</h1>
          <div id="profile-image-container" class="profile-image" ></div>
          <h3 class="about-title">Sobre:</h3>
            <p class="profile-description">Bio do usuário</p>
            <p class="profile-description">O usuário ainda não escreveu nada aqui...</p>
        </div>
        <div class="col-md-12 added-movies-container">
          <h3>Filmes que enviou:</h3>
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
              <p class="empty-list">O usuário ainda não enviou filmes.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>