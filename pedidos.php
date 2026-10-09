<?php
session_start();
require_once __DIR__ . '/includes/functions.php';

// Proteção da rota: Apenas administradores podem acessar
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_tipo'] ?? '') !== 'admin') {
    header('Location: login.php');
    exit;
}

$pedidos = buscar_todos_pedidos($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Pedidos</title>
    <link rel="stylesheet" href="/lumina_graca/css/style.css">
    <link rel="icon" type="image/png" href="/lumina_graca/css/imagens/logo_guia.png">
</head>

<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="container">
        <div class="admin-card">
            <div class="form-header text-center">
                <h2>Painel de Pedidos</h2>
                <p class="form-subtitulo">Acompanhe as vendas da loja em tempo real</p>
                <div class="divisor-dourado"></div>
            </div>

            <?php if (empty($pedidos)): ?>
                <p class="pedidos-vazio text-center">
                    Nenhum pedido registrado no banco de dados.
                </p>
            <?php else: ?>
                <div class="tabela-responsive">
                    <table class="tabela-admin">
                        <thead>
                            <tr>
                                <th># Pedido</th>
                                <th>Cliente</th>
                                <th>E-mail</th>
                                <th>Data</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pedidos as $p): ?>
                                <tr>
                                    <td class="col-id"><strong>#<?php echo str_pad($p['pedido_id'], 4, '0', STR_PAD_LEFT); ?></strong></td>
                                    <td><?php echo htmlspecialchars($p['cliente_nome']); ?></td>
                                    <td><?php echo htmlspecialchars($p['cliente_email']); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($p['data_pedido'])); ?></td>
                                    <td class="valor-dourado">R$ <?php echo number_format($p['total'], 2, ',', '.'); ?></td>
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