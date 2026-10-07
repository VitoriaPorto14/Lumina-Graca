<?php
require_once __DIR__ . '/includes/functions.php';

$produtos = listar_p($conexao);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Estoque / Produtos</title>
</head>

<body>

    <h1>ESTOQUE/PRODUTOS</h1>

    <!-- Botão + Novo Produto -->
    <a href="/lumina_graca/app_p/adicionar_p.php"><button type="button">+ Novo Produto</button></a>
    <br><br>

    <?php if (empty($produtos)): ?>
        <p>Nenhum produto cadastrado no momento.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>PRODUTO</th>
                    <th>DESCRIÇÃO</th>
                    <th>PREÇO</th>
                    <th>ESTOQUE</th>
                    <th>AÇÃO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $p): ?>
                    <tr>
                        <!-- Container Flexbox alinhando imagem e texto lado a lado -->
                        <td style="display: flex; align-items: center; gap: 12px;">
                            <?php if (!empty($p['imagem_url'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($p['imagem_url']); ?>" width="50" alt="Imagem" style="border-radius: 4px;">
                            <?php else: ?>
                                <div style="width: 50px; text-align: center;">[IMG]</div>
                            <?php endif; ?>

                            <div>
                                <strong><?php echo htmlspecialchars($p['nome']); ?></strong><br>
                                <small>ID: <?php echo $p['id']; ?></small>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($p['descricao']); ?></td>
                        <td>R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $p['estoque']; ?> un</td>
                        <td>
                            <a href="/lumina_graca/app_p/editar_p.php?id=<?php echo $p['id']; ?>"><button type="button">✏️</button></a>
                            <a href="/lumina_graca/app_p/excluir_p.php?id=<?php echo $p['id']; ?>" onclick="return confirm('Deseja excluir este produto?')"><button type="button">🗑️</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <a href="/lumina_graca/index.php">
        <p>Voltar</p>
    </a>
</body>

</html>