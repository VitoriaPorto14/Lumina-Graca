<?php require_once __DIR__ . '/../includes/functions.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
    header('Location: ../login.php?redirect=' . urlencode('produtos/checkout.php' . $queryString));
    exit;
}
$produtos = listar_p($conexao);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>
    <h1>PRODUTOS</h1>

    <?php if (empty($produtos)): ?>
        <p>Nenhum produto disponível para venda no momento.</p>
    <?php else: ?>
        <div class="vitrine">
            <?php foreach ($produtos as $p): ?>
                <?php if ($p['estoque'] > 0): ?>
                    <div class="produto-item">
                        <?php if (!empty($p['imagem_url'])): ?>
                            <img src="/lumina_graca/uploads/<?php echo htmlspecialchars($p['imagem_url']); ?>" width="100" alt="Imagem do Produto">
                        <?php else: ?>
                            <div style="width: 50px; text-align: center;">[IMG]</div>
                        <?php endif; ?>

                        <h2><?php echo htmlspecialchars($p['nome']); ?></h2>
                        <p><?php echo htmlspecialchars($p['descricao']); ?></p>
                        <p><strong>Preço:</strong> R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></p>

                        <form action="checkout.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($p['id']); ?>">
                            <input type="hidden" name="produto" value="<?php echo htmlspecialchars($p['nome']); ?>">
                            <input type="hidden" name="preco" value="<?php echo htmlspecialchars($p['preco']); ?>">
                            <button type="submit">Solicitar Pedido</button>
                            <hr> <br>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <br>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>