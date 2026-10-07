<?php
require_once __DIR__ . '/../database/connect.php';

function adicionar_u($conexao, $nome, $email, $senha, $tipo)
{

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";

    try {
        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":tipo", $tipo);

        $stmt->execute();
        echo "<br>Usuário cadastrado com sucesso!";
    } catch (PDOException $e) {
        echo "<br>Erro: " . $e->getMessage();
    }
}

function apagar_u($conexao, $nome)
{
    $sql = "DELETE FROM usuarios WHERE nome = :nome";
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();
        echo "Usuário $nome deletado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function atualizar_u($conexao, $nome, $email, $senha, $tipo)
{
    $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, tipo = :tipo WHERE id = :id";

    try {
        $stmt = $conexao->prepare($sql);


        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":tipo", $tipo);

        $stmt->execute();
        echo "<br>Informações atualizadas com sucesso!";
    } catch (PDOException $e) {
        echo "<br>Erro: " . $e->getMessage();
    }
}


// 1. Função para Adicionar Produto
function adicionar_p($conexao, $nome, $descricao, $preco, $estoque, $imagem_url)
{
    $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, imagem_url) VALUES (:nome, :descricao, :preco, :estoque, :imagem_url)";

    try {
        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":estoque", $estoque);
        $stmt->bindParam(":imagem_url", $imagem_url);

        $stmt->execute();
        echo "<br>Produto cadastrado com sucesso!";
    } catch (PDOException $e) {
        echo "<br>Erro: " . $e->getMessage();
    }
}

// 2. Função para Listar Todos os Produtos
function listar_p($conexao)
{
    $sql = "SELECT id, nome, descricao, preco, estoque, imagem_url FROM produtos";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $produtos;
    } catch (PDOException $e) {
        echo "<br>Erro: " . $e->getMessage();
        return [];
    }
}

// 3. Função para Consultar um Único Produto pelo ID (necessário para a página de edição)
function consulta_p($conexao, $id)
{
    $sql = "SELECT id, nome, descricao, preco, estoque, imagem_url FROM produtos WHERE id = :id";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<br>Erro: " . $e->getMessage();
        return false;
    }
}

// 4. Função para Atualizar/Editar Produto
function atualizar_p($conexao, $id, $nome, $descricao, $preco, $estoque, $imagem_url)
{
    $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, estoque = :estoque, imagem_url = :imagem_url WHERE id = :id";

    try {
        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":estoque", $estoque);
        $stmt->bindParam(":imagem_url", $imagem_url);
        $stmt->bindParam(":id", $id);

        $stmt->execute();
        echo "<br>Produto atualizado com sucesso!";
    } catch (PDOException $e) {
        echo "<br>Erro: " . $e->getMessage();
    }
}

function apagar_p($conexao, $id)
{
    $sql = "DELETE FROM produtos WHERE id = :id";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "<br>Erro ao excluir: " . $e->getMessage();
    }
}

// Decrementa em 1 unidade o estoque do produto
function decrementar_estoque($conexao, $id) {
    $sql = "UPDATE produtos SET estoque = estoque - 1 WHERE id = :id AND estoque > 0";
    $stmt = $conexao->prepare($sql);
    return $stmt->execute([':id' => $id]);
}