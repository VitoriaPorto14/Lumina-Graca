<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Atualizar Informações</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>
    <main>
        <h1>Atualizar Informações</h1>
        <form action="" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required><br><br>

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required><br><br>

                <button type="submit">Atualizar</button>
                <button type="reset">Limpar</button>
                <a href="../index.php">
                    <p>Voltar</p>
                </a>
        </form>
        </form>
    </main>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tipo = 'cliente';
        atualizar_u($conexao, $_POST['nome'], $_POST['email'], $_POST['senha'], $tipo);
    }
    ?>
    <?php include __DIR__ . '/../includes/footer.php'; ?>

</body>

</html>