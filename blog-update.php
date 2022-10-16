<?php

require_once "config.php";

//Validamos e testamos se as chaves da super global $_POST estão ou não vazias.
// Se NÃO estiverem vazias, atualiza o utilizador com os dados formulário.
// esse if só será executado quando o botão de envio do formulário de atualização for feito
if (!empty($_POST["title"]) && !empty($_POST["author"]) && !empty($_POST["content"]) && !empty($_POST["created_at"])) {
    $updatedAt = date('Y-m-d H:i:s');
    //declaração
    $query = "UPDATE posts SET title = ?, author = ?, content = ?, updated_at = ? WHERE id = ?"; // faz alteraçã nos dados existentes
    // preparação
    $sql = $pdo->prepare($query);
    // execução
    if ($sql->execute([
        $_POST["title"],
        $_POST["author"],
        $_POST["content"],
        $updatedAt,
        $_GET['id']
    ])) {
        header('Location: http://localhost/Exercícios/blog-codemaster/blog-read.php');
    }
} else { // exibe os dados do cliente dentro do formulário quando entro na página, uma vez que o POST ainda está vazio.
    //Iss acontece antes da submissão do formulário, quando então entraremos no If acima. 

    //declaração
    $query = "SELECT * FROM posts WHERE id = ?";
    // preparação
    $sql = $pdo->prepare($query);
    // execução
    if ($sql->execute([$_GET['id']])) {
        $post = $sql->fetch(PDO::FETCH_ASSOC);
    } else {
        $post = [];
    }
}

require_once 'head.php'; ?>

<div class="page container">
    <section>
        <h3>Update - Post</h3>
        <form class="form" method="POST" action="blog-update.php?id=<?php echo $post["id"];?>">
            <div class="form-field">
                <label for="title">Título</label>
                <input type="text" name="title" value="<?php echo $post["title"]; ?>">
            </div>
            <div class="form-field">
                <label for="author">Autor</label>
                <input type="text" name="author" value="<?php echo $post["author"]; ?>">
            </div>
            <div class="form-field">
                <label for="created_at">Data</label>
                <input type="text" name="created_at" value="<?php echo $post["created_at"]; ?>">
            </div>
            <div class="form-field">
                <label for="content">Conteúdo</label>
                <textarea name="content" id= "editore" cols="30" rows="10"><?php echo $post["content"]; ?></textarea>
            </div>
            <div class="form-field">
                <button>Guardar</button>
            </div>
        </form>
    </section>
</div>

<?php

require_once 'foot.php';
