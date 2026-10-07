<?php
require_once __DIR__ . '/includes/functions.php';

$produtos_destaque = listar_produtos_destaque($conexao, 3);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina Graça - Moda Modesta e Elegante</title>
</head>

<body>

    <?php include __DIR__ . '/includes/header.php'; ?>

    <main>
        <!-- Apresentação Inicial -->
        <section>
            <h1>Bem-vinda à Lumina Graça</h1>
            <p><em>"Com Cristo, tudo se ilumina."</em></p>
            <p>
                Moda modesta e elegante para a mulher cristã se vestir com sofisticação, beleza e sem abrir mão de seus valores.
            </p>
        </section>

        <hr>

        <!-- Seção de Destaques (3 Produtos) -->
        <section>
            <h2>Produtos em Destaque</h2>

            <?php if (empty($produtos_destaque)): ?>
                <p>Nenhum produto disponível no momento.</p>
            <?php else: ?>
                <div>
                    <?php foreach ($produtos_destaque as $p): ?>
                        <div>
                            <!-- Imagem do Produto -->
                            <?php if (!empty($p['imagem_url'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($p['imagem_url']); ?>" width="100" alt="Imagem do Produto">
                            <?php else: ?>
                                <div>[Sem Imagem]</div>
                            <?php endif; ?>

                            <h3><?php echo htmlspecialchars($p['nome']); ?></h3>
                            <p><?php echo htmlspecialchars($p['descricao']); ?></p>
                            <p><strong>Preço:</strong> R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></p>

                            <!-- Redireciona diretamente para o checkout enviando os dados do produto -->
                            <form action="checkout.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($p['id']); ?>">
                                <input type="hidden" name="produto" value="<?php echo htmlspecialchars($p['nome']); ?>">
                                <input type="hidden" name="preco" value="<?php echo htmlspecialchars($p['preco']); ?>">
                                <button type="submit">Solicitar Pedido</button>
                            </form>
                            <br>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <p>
                <a href="produtos/m_produtos.php"><strong>Ver toda a vitrine de produtos →</strong></a>
            </p>
        </section>

        <hr>

        <!-- Seção Nova Coleção -->
        <section>
            <h2>Nova Coleção - Graça & Elegância</h2>
            <p>
                Conheça nossa nova linha de peças exclusivas, desenvolvidas para unir caimento impecável, tecidos leves e modelagens modernas que valorizam a modéstia.
            </p>
            <ul>
                <li>Vestidos Midis com acabamento refinado</li>
                <li>Conjuntos elegantes para ocasiões especiais</li>
                <li>Peças atemporais para o dia a dia da mulher cristã</li>
            </ul>
            <p>
                <a href="produtos/m_produtos.php">Confira os lançamentos na vitrine</a>
            </p>
        </section>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

</body>

</html>

```