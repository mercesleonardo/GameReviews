<?php
  require_once("templates/header.php");

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 offset-md-1">
          <h1>Título</h1>
          <p class="page-description">Altere os dados do filme no fomrulário abaixo:</p>
          <form id="edit-game-form" action="game_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="">
            <div class="form-group">
              <label for="title">Título:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu filme" value="Título">
            </div>
            <div class="form-group">
              <label for="image">Imagem:</label>
              <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
              <label for="length">Duração:</label>
              <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme" value="3h">
            </div>
            <div class="form-group">
              <label for="category">Category:</label>
              <select name="category" id="category" class="form-control">
                <option value="">Selecione</option>
                <option value="Ação">Ação</option>
                <option value="Comédia">Comédia</option>
                <option value="Terror">Terror</option>
                <option value="Drama">Drama</option>
                <option value="Ficção / Fantasia">Ficção / Fantasia</option>
                <option value="Romance">Romance</option>
              </select>
            </div>
            <div class="form-group">
              <label for="trailer">Trailer:</label>
              <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer" value="">
            </div>
            <div class="form-group">
              <label for="description">Descrição:</label>
              <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o filme...">Descrição</textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Editar filme">
          </form>
        </div>
        <div class="col-md-3">
          <div class="game-image-container"></div>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>