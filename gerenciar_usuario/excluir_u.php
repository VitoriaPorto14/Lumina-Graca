<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';

$id = '';

// Processa a exclusão quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id'] ?? '');

    if (!empty($id)) {
        // Executa a exclusão da conta no banco de dados
        apagar_u($conexao, $id);

        // Se o usuário apagou a PRÓPRIA conta logada, encerra a sessão
        if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $id) {
            session_unset();
            session_destroy();
        }

        // Redireciona diretamente para a página inicial
        header("Location: ../index.php?conta_excluida=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Conta</title>
    <link rel="stylesheet" href="/lumina_graca/css/style.css">
    <link rel="icon" type="image/png" href="/lumina_graca/css/imagens/logo_guia.png">
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main class="container">
        <div class="form-card auth-card">
            <div class="form-header text-center">
                <h2>Deletar Conta</h2>
                <p class="form-subtitulo">Informe o ID do usuário que deseja remover do sistema</p>
                <small class="form-alerta">* Esta ação é irreversível</small>
                <div class="divisor-dourado"></div>
            </div>

            <form action="" method="post" class="form-produto">
                <div class="form-grupo">
                    <label for="id">ID do Registro *</label>
                    <input type="number" name="id" id="id" placeholder="Digite o ID para exclusão" required min="1">
                </div>

                <div class="form-acoes">
                    <a href="../conta.php" class="btn-cancelar">VOLTAR</a>
                    <button type="submit" class="btn-adicionar btn-deletar-destaque">APAGAR REGISTRO</button>
                </div>
            </form>

            <div class="auth-footer text-center">
                <a href="../index.php" class="btn-link">← Voltar para o Início</a>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>