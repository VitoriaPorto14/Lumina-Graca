<?php
require_once __DIR__ . '/../includes/functions.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: /lumina_graca/produtos.php");
    exit();
}

// Busca os dados atuais do produto no banco via função
$produto = consulta_p($conexao, $id);

if (!$produto) {
    header("Location: /lumina_graca/produtos.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $descricao = $_POST['descricao'];
    $imagem_url = $produto['imagem_url']; // Mantém a imagem atual caso não faça upload de uma nova

    if (!empty($_FILES['imagem_url']['name'])) {
        $imagem_url = time() . '_' . $_FILES['imagem_url']['name'];
        move_uploaded_file($_FILES['imagem_url']['tmp_name'], '../uploads/' . $imagem_url);
    }

    // Chama a função de atualização definida no functions.php
    atualizar_p($conexao, $id, $nome, $descricao, $preco, $estoque, $imagem_url);

    header("Location: /lumina_graca/produto.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>

<body>

    <h2>Editar Produto</h2>
    <small>(Todos os campos com * são obrigatórios)</small><br><br>

    <form action="/lumina_graca/app_p/editar_p.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label for="nome">* Nome do Produto</label><br>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required><br><br>

        <label for="preco">* Preço (R$)</label><br>
        <input type="number" step="0.01" name="preco" id="preco" value="<?php echo $produto['preco']; ?>" required><br><br>

        <label for="estoque">* Estoque</label><br>
        <input type="number" name="estoque" id="estoque" value="<?php echo $produto['estoque']; ?>" required><br><br>

        <label for="imagem_url">* Imagem</label><br>
        <?php if (!empty($produto['imagem_url'])): ?>
            <p>Imagem atual: <?php echo htmlspecialchars($produto['imagem_url']); ?></p>
        <?php endif; ?>
        <input type="file" name="imagem_url" id="imagem_url"><br><br>

        <label for="descricao">Descrição</label><br>
        <textarea name="descricao" id="descricao" rows="4" cols="50"><?php echo htmlspecialchars($produto['descricao']); ?></textarea><br><br>

        <a href="/lumina_graca/produto.php"><button type="button">CANCELAR</button></a>
        <button type="submit">SALVAR</button>
    </form>

</body>

</html>