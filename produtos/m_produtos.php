<?php require_once __DIR__ . '/../includes/functions.php';

// Busca todos os produtos do banco de dados
$produtos = listar_p($conexao);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Vitrine de Produtos</title>
</head>

<body>

    <h1>VITRINE DE PRODUTOS</h1>

    <?php if (empty($produtos)): ?>
        <p>Nenhum produto disponível para venda no momento.</p>
    <?php else: ?>
        <div class="vitrine">
            <?php foreach ($produtos as $p): ?>
                <!-- Exibe apenas produtos com estoque disponível -->
                <?php if ($p['estoque'] > 0): ?>
                    <div class="produto-item">
                        <!-- Imagem do Produto (Corrigido caminho relativo) -->
                        <?php if (!empty($p['imagem_url'])): ?>
                            <img src="../uploads/<?php echo htmlspecialchars($p['imagem_url']); ?>" width="150" alt="Imagem" style="border-radius: 4px;">
                        <?php else: ?>
                            <div style="width: 50px; text-align: center;">[IMG]</div>
                        <?php endif; ?>

                        <!-- Detalhes do Produto -->
                        <h2><?php echo htmlspecialchars($p['nome']); ?></h2>
                        <p><?php echo htmlspecialchars($p['descricao']); ?></p>
                        <p><strong>Preço:</strong> R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></p>

                        <!-- Formulário que redireciona o produto para a tela de contato na raiz -->
                        <form action="../produtos/checkout.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($p['id']); ?>">
                            <input type="hidden" name="produto" value="<?php echo htmlspecialchars($p['nome']); ?>">
                            <input type="hidden" name="preco" value="<?php echo htmlspecialchars($p['preco']); ?>">
                            <button type="submit">Solicitar Pedido</button>
                        </form>
                        <hr>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <br>
    <a href="/lumina_graca/index.php">Voltar</a>

</body>

</html>