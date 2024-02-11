<?php
  require_once("templates/header.php");

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informações dos filmes que você enviou</p>
    <div class="col-md-12" id="add-movie-container">
      <a href="newmovie.php" class="btn card-btn">
        <i class="fas fa-plus"></i> Adicionar Filme
      </a>
    </div>
    <div class="col-md-12" id="movies-dashboard">
      <table class="table">
        <thead>
          <th scope="col">#</th>
          <th scope="col">Título</th>
          <th scope="col">Nota</th>
          <th scope="col" class="actions-column">Ações</th>
        </thead>
        <tbody>
            <tr>
              <td scope="row"></td>
              <td><a href="movie.php" class="table-movie-title">Título</a></td>
              <td><i class="fas fa-star"></i>9</td>
              <td class="actions-column">
                <a href="editmovie.php" class="edit-btn">
                  <i class="far fa-edit"></i> Editar
                </a>
                <form action="movie_process.php" method="POST">
                  <input type="hidden" name="type" value="delete">
                  <input type="hidden" name="id" value="">
                  <button type="submit" class="delete-btn">
                    <i class="fas fa-times"></i> Deletar
                  </button>
                </form>
              </td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>