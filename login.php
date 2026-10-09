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

        // Redireciona sempre para a página inicial (index.php)
        header("Location: index.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lumina & Graça</title>
    <link rel="stylesheet" href="/lumina_graca/css/style.css">
    <link rel="icon" type="image/png" href="/lumina_graca/css/imagens/logo_guia.png">
</head>

<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="container">
        <div class="form-card auth-card">
            <div class="form-header text-center">
                <h2>Acessar Minha Conta</h2>
                <p class="form-subtitulo">Informe suas credenciais para continuar</p>
            </div>

            <?php if (!empty($erro)): ?>
                <div class="alerta-erro">
                    <span>⚠️ <?php echo htmlspecialchars($erro); ?></span>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="form-produto">
                <div class="form-grupo">
                    <label for="email">E-mail *</label>
                    <input type="email" name="email" id="email" required placeholder="seu@email.com">
                </div>

                <div class="form-grupo">
                    <label for="senha">Senha *</label>
                    <input type="password" name="senha" id="senha" required placeholder="Sua senha de acesso">
                </div>

                <div class="form-acoes-auth">
                    <button type="submit" class="btn-adicionar btn-block">ENTRAR</button>
                </div>
            </form>

            <div class="auth-footer">
                <p>Ainda não tem conta? <a href="app_u/adicionar_u.php" class="link-destaque">Criar nova conta</a></p>
                <a href="index.php" class="btn-link">← Voltar para o Início</a>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>