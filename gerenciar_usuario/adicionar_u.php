<?php
session_start();
require_once __DIR__ . "/../includes/functions.php"; 

$mensagem_sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    $tipo  = 'cliente';

    if (!empty($nome) && !empty($email) && !empty($senha)) {
        adicionar_u($conexao, $nome, $email, $senha, $tipo);
        $mensagem_sucesso = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="/lumina_graca/css/style.css">
    <link rel="icon" type="image/png" href="/lumina_graca/css/imagens/logo_guia.png">
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main class="container">
        <div class="form-card auth-card">
            <div class="form-header text-center">
                <h2>Criar Conta</h2>
                <p class="form-subtitulo">Junte-se à Lumina & Graça para uma experiência exclusiva</p>
                <small class="form-alerta">* Campos obrigatórios</small>
                <div class="divisor-dourado"></div>
            </div>

            <?php if ($mensagem_sucesso): ?>
                <div class="alerta-sucesso-contato">
                    <span class="icone-sucesso">✨</span>
                    <div>
                        <strong>Cadastro realizado com sucesso!</strong>
                        <p>Sua conta foi criada. <a href="../login.php" class="btn-link" style="display: inline; text-decoration: underline;">Clique aqui para fazer login</a>.</p>
                    </div>
                </div>
            <?php endif; ?>

            <form action="" method="post" class="form-produto">
                <div class="form-grupo">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" name="nome" id="nome" placeholder="Digite seu nome completo" required>
                </div>

                <div class="form-grupo">
                    <label for="email">E-mail *</label>
                    <input type="email" name="email" id="email" placeholder="seu@email.com" required>
                </div>

                <div class="form-grupo">
                    <label for="senha">Senha *</label>
                    <input type="password" name="senha" id="senha" placeholder="Crie uma senha segura" required>
                </div>

                <div class="form-acoes">
                    <a href="../index.php" class="btn-cancelar">VOLTAR</a>
                    <button type="reset" class="btn-limpar">LIMPAR</button>
                    <button type="submit" class="btn-adicionar">CADASTRAR</button>
                </div>
            </form>

            <div class="auth-footer text-center">
                <p style="font-size: 0.9rem; color: var(--cor-texto-suave);">
                    Já possui uma conta? <a href="../login.php" class="btn-link" style="display: inline;">Faça Login</a>
                </p>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>