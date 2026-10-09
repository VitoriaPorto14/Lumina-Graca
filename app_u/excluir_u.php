<?php
require_once __DIR__ . '/../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Deletar Conta</title>
    <link rel="icon" type="image/png" href="/lumina_graca/css/imagens/logo_guia.png">
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>
    <h1>Deletar Conta</h1>
    <main>
        <form action="" method="post">
            <label for="id">ID: </label>
            <input type="nome" name="nome" id="nome" placeholder="Insira seu nome" required><br>
            <input type="submit" value="Apagar">
            <a href="../index.php">
                <p>Voltar</p>
            </a>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            apagar_u($conexao, $_POST['nome']);
        }
        ?>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>