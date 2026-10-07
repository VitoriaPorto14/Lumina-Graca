<?php
session_start();

// Bloqueia acesso de usuários não logados
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/includes/functions.php';

// Busca dados atualizados do usuário (sem retornar a senha)
$usuario_id = $_SESSION['usuario_id'];
$stmt = $conexao->prepare("SELECT id, nome, email, tipo FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Conta - Lumina Graça</title>
</head>
<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <main>
        <h1>Minha Conta</h1>

        <section>
            <h2>Seus Dados Cadastrados</h2>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome']); ?></p>
            <p><strong>E-mail:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
            <!-- <p><strong>Tipo de Conta:</strong> <?php echo htmlspecialchars(ucfirst($usuario['tipo'])); ?></p> -->
        </section>

        <hr>

        <section>
            <h2>Opções da Conta</h2>
            <p><a href="app_u/atualizar_u.php?id=<?php echo $usuario['id']; ?>">Atualizar Informações</a></p>
            <p><a href="app_u/excluir_u.php?id=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza que deseja apagar sua conta? Esta ação não poderá ser desfeita.');">Deletar Conta</a></p>
            <p><a href="logout.php">Sair da Conta (Logout)</a></p>
        </section>

        <br>
        <a href="index.php">Voltar ao Início</a>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>