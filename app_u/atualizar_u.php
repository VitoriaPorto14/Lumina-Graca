<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';

// Bloqueia acesso de usuários não logados
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Processa a atualização dos dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_SESSION['usuario_tipo'] ?? 'cliente';

    atualizar_u($conexao, $nome, $email, $senha, $tipo);
    header("Location: ../conta.php?sucesso=1");
    exit();
}

// Busca os dados atuais do usuário para preencher os campos do formulário
$stmt = $conexao->prepare("SELECT nome, email FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $usuario_id]);
$usuario_atual = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Informações - Lumina & Graça</title>
    <link rel="stylesheet" href="/lumina_graca/css/style.css">
    <link rel="icon" type="image/png" href="/lumina_graca/css/imagens/logo_guia.png">
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main class="container">
        <div class="form-card">
            <div class="form-header">
                <h2>Atualizar Informações</h2>
                <p class="form-subtitulo">Mantenha seus dados de acesso sempre atualizados</p>
                <small class="form-alerta">* Campos obrigatórios</small>
            </div>

            <form action="atualizar_u.php" method="POST" class="form-produto">
                <div class="form-grupo">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario_atual['nome'] ?? ''); ?>" required placeholder="Seu nome completo">
                </div>

                <div class="form-grupo">
                    <label for="email">E-mail *</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($usuario_atual['email'] ?? ''); ?>" required placeholder="seu@email.com">
                </div>

                <div class="form-grupo">
                    <label for="senha">Nova Senha *</label>
                    <input type="password" name="senha" id="senha" required placeholder="Digite sua senha ou uma nova">
                </div>

                <div class="form-acoes">
                    <a href="../conta.php" class="btn-cancelar">CANCELAR</a>
                    <button type="reset" class="btn-limpar">LIMPAR</button>
                    <button type="submit" class="btn-adicionar">SALVAR ALTERAÇÕES</button>
                </div>
            </form>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>