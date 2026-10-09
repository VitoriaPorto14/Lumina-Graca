<?php
session_start();
require_once __DIR__ . '/includes/functions.php';

// Bloqueia acesso de não-administradores
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_tipo'] ?? '') !== 'admin') {
    header('Location: login.php');
    exit;
}

$mensagens = buscar_mensagens_contato($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens de Contato - Lumina & Graça</title>
    <link rel="stylesheet" href="/lumina_graca/css/style.css">
    <link rel="icon" type="image/png" href="/lumina_graca/css/imagens/logo_guia.png">
</head>

<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="container">
        <div class="admin-card">
            <div class="form-header text-center">
                <h2>Mensagens Recebidas</h2>
                <p class="form-subtitulo">Acompanhe as dúvidas e contatos enviados pelos clientes</p>
                <div class="divisor-dourado"></div>
            </div>

            <?php if (empty($mensagens)): ?>
                <p class="pedidos-vazio text-center">
                    Nenhuma mensagem recebida até o momento.
                </p>
            <?php else: ?>
                <div class="tabela-responsive">
                    <table class="tabela-admin">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Assunto</th>
                                <th>Mensagem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mensagens as $m): ?>
                                <tr>
                                    <td style="white-space: nowrap;"><?php echo date('d/m/Y H:i', strtotime($m['data_envio'])); ?></td>
                                    <td><strong><?php echo htmlspecialchars($m['nome']); ?></strong></td>
                                    <td><a href="mailto:<?php echo htmlspecialchars($m['email']); ?>" class="btn-link"><?php echo htmlspecialchars($m['email']); ?></a></td>
                                    <td><?php echo htmlspecialchars($m['assunto']); ?></td>
                                    <td><?php echo nl2br(htmlspecialchars($m['mensagem'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <div class="auth-footer text-center" style="margin-top: 30px;">
                <a href="conta.php" class="btn-link">← Voltar para Minha Conta</a>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>