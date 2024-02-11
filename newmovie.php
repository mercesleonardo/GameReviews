<?php 
    require_once("templates/header.php");
?>
    <div id="main-container" class="container-fluid">
        <div class="offset-md-4 col-md-4 new-movie-container">
            <h1 class="page-title">Adicionar filme</h1>
            <p class="page-description">Adicione sua crítica e compartilhe com o mundo!</p>
            <form action="movie_process.php" method="POST" enctype="multipart/form-data" id="add-movie-form">
                <input type="hidden" name="type" value="create">
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" name="title" id="title" placeholder="Digite o título do seu filme" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image">Imagem:</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="length">Duração:</label>
                    <input type="text" name="length" id="length" placeholder="Digite o duração do filme" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Categoria:</label>
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
                    <input type="text" name="trailer" id="trailer" placeholder="Insira o trailer do filme" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea name="description" id="description" rows="5" placeholder="Descreva o filme" class="form-control"></textarea>
                </div>
                <input type="submit" value="Adicionar filme" class="btn card-btn">
            </form>
        </div>
    </div>
<?php
    require_once("templates/footer.php")
?>