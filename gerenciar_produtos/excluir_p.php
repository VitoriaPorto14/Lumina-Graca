<?php
// Sobe um nível para carregar o functions.php
require_once __DIR__ . '/../includes/functions.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Apaga o produto no banco de dados
    apagar_p($conexao, $id);
}

// Redireciona de volta para a lista de produtos (subindo um nível caso produtos.php esteja na raiz)
header("Location: /lumina_graca/produto.php");
exit();