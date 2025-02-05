<?php
session_start();
if(!isset($_SESSION['usuario_id'])){
    header('Locaton: index.php');//se não estiver logado
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleConteudo.css">
    <title>Conteudo Exclusivo</title>

</head>
<body>

    <div class="conteiner">
    <h1>Olá <?php echo $_SESSION['usuario_nome']?></h1>
    <h2>Seja Bem-Vindo a Pagina Exclusiva</h2>
    <a href="logout.php">Sair</a>
    </div>
    
</body>
</html>