<?php

require_once "config.php";

if (
    !empty($_POST["title"]) &&
    !empty($_POST["author"]) &&
    !empty($_POST["content"]) &&
    !empty($_POST["created_at"])
) {
    //declaração
    $query = "INSERT INTO posts (title, author, content, created_at, updated_at) VALUES ( ?, ?, ?, ?, ?)";
    // preparação
    $sql = $pdo->prepare($query);
    // execução
   if($sql->execute([
        $_POST["title"],
        $_POST["author"],
        $_POST["content"],
        $_POST["created_at"],
        $_POST["created_at"]
    ])){
        $user = $sql->fetch(PDO::FETCH_ASSOC);
    }else {
        $user = []; } 
    }



require_once 'head.php'; 
?>

<div class="page container">
    <section>
        <h3>Create - Post</h3>
        <form class="form" method="POST" action="blog-create.php">
            <div class="form-field">
                <label for="">Título</label>
                <input type="text" name="title">
            </div>
            <div class="form-field">
                <label for="">Autor</label>
                <input type="text" name="author">
            </div>
            <div class="form-field">
                <label for="created_at">Data</label>
                <input id ="datepicker" type="date" name="created_at">
            </div> 
            <div class="form-field">
                <label for="content">Conteúdo</label>
                <textarea id="editor" name="content" cols="30" rows="10"></textarea>
            </div>  
            <div class="form-field">
                <button>Guardar</button>
            </div>
        </form>
    </section>
</div>

<?php

require_once 'foot.php';