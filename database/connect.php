<?php
$host = "192.168.10.73";
$dbname = "lumina";
$user = "lumina";
$pass = "lumina123";

try {
    $conexao = new PDO(
        "pgsql:host=$host;
        dbname=$dbname",
        $user,
        $pass
    );
    // echo "Conexão realizada com sucesso! <br>";
    return $conexao;
} catch (PDOException $e){
    echo "Erro: ". $e->getMessage();
}
?>