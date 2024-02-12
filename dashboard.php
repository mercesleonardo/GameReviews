<?php
  require_once("templates/header.php");

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informações dos jogos que você enviou</p>
    <div class="col-md-12" id="add-game-container">
      <a href="newgame.php" class="btn card-btn">
        <i class="fas fa-plus"></i> Adicionar Filme
      </a>
    </div>
    <div class="col-md-12" id="games-dashboard">
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
              <td><a href="game.php" class="table-game-title">Título</a></td>
              <td><i class="fas fa-star"></i>9</td>
              <td class="actions-column">
                <a href="editgame.php" class="edit-btn">
                  <i class="far fa-edit"></i> Editar
                </a>
                <form action="game_process.php" method="POST">
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