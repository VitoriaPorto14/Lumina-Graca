<?php
session_start();

if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_tipo'] ?? '') !== 'admin') {
    echo "Acesso negado. Esta página é restrita aos administradores.";
    echo "<br><a href='../index.php'>Voltar para o início</a>";
    exit;
}
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];
    $descricao = $_POST['descricao'];
    $imagem_url = '';

    // Upload do arquivo de imagem
    if (!empty($_FILES['imagem_url']['name'])) {
        $imagem_url = time() . '_' . $_FILES['imagem_url']['name'];
        move_uploaded_file($_FILES['imagem_url']['tmp_name'], '../uploads/' . $imagem_url);
    }

    // Chama a função definida no functions.php
    adicionar_p($conexao, $nome, $descricao, $preco, $estoque, $imagem_url);

    header("Location: /lumina_graca/produto.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Produto</title>
</head>

<body>

    <h2>Adicionar Novo Produto</h2>
    <small>(Todos os campos com * são obrigatórios)</small><br><br>

    <form action="adicionar_p.php" method="POST" enctype="multipart/form-data">
        <label for="nome">* Nome do Produto</label><br>
        <input type="text" name="nome" id="nome" placeholder="ex: Vestido Midi" required><br><br>

        <label for="preco">* Preço (R$)</label><br>
        <input type="number" step="0.01" name="preco" id="preco" placeholder="ex: 59.90" required><br><br>

        <label for="estoque">* Estoque</label><br>
        <input type="number" name="estoque" id="estoque" placeholder="ex: 12" required><br><br>

        <label for="imagem_url">* Imagem</label><br>
        <input type="file" name="imagem_url" id="imagem_url" required><br><br>

        <label for="descricao">Descrição</label><br>
        <textarea name="descricao" id="descricao" rows="4" cols="50" placeholder="Detalhes de tecido, modelagem, acabamento..."></textarea><br><br>

        <a href="/lumina_graca/produto.php"><button type="button">CANCELAR</button></a>
        <button type="submit">ADICIONAR</button>
    </form>

</body>

</html>