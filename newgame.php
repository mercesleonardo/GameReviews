<?php 

    require_once("templates/header.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $user = new User();

    $userDao = new UserDAO($conn, $BASE_URL);

    // Check if the user is authenticated
    $userData = $userDao->verifyToken(true);

?>
    <div id="main-container" class="container-fluid">
        <div class="offset-md-4 col-md-4 new-game-container">
            <h1 class="page-title">Adicionar game</h1>
            <p class="page-description">Adicione sua crítica e compartilhe com o mundo!</p>
            <form action="<?= $BASE_URL ?>game_process.php" method="POST" enctype="multipart/form-data" id="add-game-form">
                <input type="hidden" name="type" value="create">
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" name="title" id="title" placeholder="Digite o título do seu jogo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image">Imagem:</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>               
                <div class="form-group">
                    <label for="category">Categoria:</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Selecione</option>
                        <option value="Ação e Aventura">Ação e Aventura</option>
                        <option value="Battle Royale">Battle Royale</option>
                        <option value="Construção e Gestão">Construção e Gestão</option>
                        <option value="Corrida">Corrida</option>
                        <option value="Estratégia">Estratégia</option>
                        <option value="Esportes">Esportes</option>
                        <option value="FPS">FPS</option>
                        <option value="Indie">Indie</option>
                        <option value="Luta">Luta</option>
                        <option value="MMORPG">MMORPG</option>
                        <option value="Mundo Aberto">Mundo Aberto</option>
                        <option value="Narrativos">Narrativos</option>
                        <option value="Plataforma">Plataforma</option>
                        <option value="Puzzle">Puzzle</option>
                        <option value="RTS">RTS</option>
                        <option value="RPG">RPG</option>
                        <option value="Roguelike/Roguelite">Roguelike/Roguelite</option>
                        <option value="Simulação">Simulação</option>
                        <option value="Survival Horror">Survival Horror</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="trailer">Trailer:</label>
                    <input type="text" name="trailer" id="trailer" placeholder="Insira o trailer do jogo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea name="description" id="description" rows="5" placeholder="Descreva o jogo" class="form-control"></textarea>
                </div>
                <input type="submit" value="Adicionar jogo" class="btn card-btn">
            </form>
        </div>
    </div>
<?php
    require_once("templates/footer.php")
?>