<?php
session_start();
require_once __DIR__ . '/includes/functions.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    $usuario = autenticar_usuario($conexao, $email, $senha);

    if ($usuario) {
        // Armazena dados essenciais na sessão
        $_SESSION['usuario_id']    = $usuario['id'];
        $_SESSION['usuario_nome']  = $usuario['nome'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['usuario_tipo']  = $usuario['tipo']; // 'admin' ou 'cliente'

        // Se veio do checkout, redireciona de volta para finalizar
        $redirect = $_GET['redirect'] ?? 'conta.php';
        header("Location: " . $redirect);
        exit;
    } else {
        $erro = 'E-mail ou senha inválidos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login - Lumina Graça</title>
</head>

<body>

    <h1>Acessar Minha Conta</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><strong><?php echo htmlspecialchars($erro); ?></strong></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="email">E-mail:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" id="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <br>
    <p>Ainda não tem conta? <a href="app_u/adicionar_u.php">Criar nova conta</a></p>
    <p><a href="index.php">Voltar para o Início</a></p>

</body>

</html>