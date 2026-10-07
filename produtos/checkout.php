<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
    header('Location: ../login.php?redirect=' . urlencode('produtos/checkout.php' . $queryString));
    exit;
}
require_once __DIR__ . "/../includes/functions.php";
$produto_id    = $_GET['id'] ?? $_POST['id'] ?? '';
$produto_nome  = $_GET['produto'] ?? $_POST['produto'] ?? '';
$produto_preco = $_GET['preco'] ?? $_POST['preco'] ?? '';
$pedido_finalizado = false;
$dados_pedido = [];

$numero_whatsapp = "5511999999999";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pedido_finalizado = true;
    // Decrementa 1 unidade do estoque no banco de dados
    if (!empty($produto_id)) {
        decrementar_estoque($conexao, $produto_id);
    }
    $cep         = trim($_POST['cep'] ?? '');
    $rua         = trim($_POST['rua'] ?? '');
    $numero      = trim($_POST['numero'] ?? '');
    $complemento = trim($_POST['complemento'] ?? '');
    $bairro      = trim($_POST['bairro'] ?? '');
    $cidade      = trim($_POST['cidade'] ?? '');
    $estado      = trim($_POST['estado'] ?? '');

    $endereco_completo = "Rua {$rua}, Nº {$numero}" . ($complemento ? " ({$complemento})" : "") . " - Bairro: {$bairro}, {$cidade}/{$estado} - CEP: {$cep}";

    $dados_pedido = [
        'nome'              => trim($_POST['nome'] ?? ''),
        'endereco_completo' => $endereco_completo,
        'pagamento'         => trim($_POST['pagamento'] ?? ''),
        'produto'           => trim($_POST['produto'] ?? ''),
        'preco'             => trim($_POST['preco'] ?? '')
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Finalizar Pedido - Lumina Graça</title>
</head>

<body>
    <h1>FINALIZAR PEDIDO</h1>
    <?php if ($pedido_finalizado): ?>
        <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; margin-bottom: 20px;">
            <h2>✅ Pedido solicitado com sucesso!</h2>
            <p>Obrigado, <strong><?php echo htmlspecialchars($dados_pedido['nome']); ?></strong>.</p>
            <p>Acompanhe seu pedido pelo nosso WhatsApp para confirmar os detalhes de envio e pagamento.</p>
            <?php
            $texto_wa = "Olá! Fiz um pedido no site e gostaria de acompanhar:\n"
                . "- Produto: " . $dados_pedido['produto'] . "\n"
                . "- Cliente: " . $dados_pedido['nome'] . "\n"
                . "- Forma de Pagamento: " . $dados_pedido['pagamento'] . "\n"
                . "- Endereço de Entrega: " . $dados_pedido['endereco_completo'];
            $link_wa = "https://wa.me/" . $numero_whatsapp . "?text=" . urlencode($texto_wa);
            ?>
            <br>
            <a href="<?php echo $link_wa; ?>" target="_blank">
                <button type="button" style="background-color: #25D366; color: white; border: none; padding: 12px 20px; font-weight: bold; cursor: pointer; font-size: 16px;">
                    📲 Acompanhar pelo WhatsApp
                </button>
            </a>
        </div>
        <br>
        <a href="../lumina_graca/produtos/m_produtos.php">Voltar para a Vitrine</a>
    <?php else: ?>
        <p><strong>Item selecionado:</strong> <?php echo htmlspecialchars($produto_nome); ?></p>
        <?php if (!empty($produto_preco)): ?>
            <p><strong>Valor:</strong> R$ <?php echo number_format((float)$produto_preco, 2, ',', '.'); ?></p>
        <?php endif; ?>
        <hr>
        <form action="checkout.php" method="POST">
            <!-- ID do produto mantido para a baixa no estoque -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto_id); ?>">

            <input type="hidden" name="produto" value="<?php echo htmlspecialchars($produto_nome); ?>">

            <input type="hidden" name="preco" value="<?php echo htmlspecialchars($produto_preco); ?>">
            <h3>Dados do Cliente</h3>
            <label for="nome">* Nome Completo:</label><br>
            <input type="text" name="nome" id="nome" placeholder="Digite seu nome completo" required><br><br>
            <h3>Endereço de Entrega</h3>
            <label for="cep">* CEP:</label><br>
            <input type="text" name="cep" id="cep" placeholder="00000-000" required><br><br>
            <label for="rua">* Logradouro / Rua:</label><br>
            <input type="text" name="rua" id="rua" placeholder="Ex: Av. Brasil ou Rua das Flores" required><br><br>
            <label for="numero">* Número:</label><br>

            <input type="text" name="numero" id="numero" placeholder="Ex: 123" required><br><br>
            <label for="complemento">Complemento (opcional):</label><br>
            <input type="text" name="complemento" id="complemento" placeholder="Ex: Apto 102, Bloco B"><br><br>
            <label for="bairro">* Bairro:</label><br>
            <input type="text" name="bairro" id="bairro" placeholder="Digite o bairro" required><br><br>
            <label for="cidade">* Cidade:</label><br>

            <nput type="text" name="cidade" id="cidade" placeholder="Digite a cidade" required><br><br>
                <label for="estado">* Estado (UF):</label><br>
                <input type="text" name="estado" id="estado" placeholder="Ex: SP" maxlength="2" style="text-transform: uppercase;" required><br><br>
                <h3>Forma de Pagamento</h3>
                <label>
                    <input type="radio" name="pagamento" value="PIX" checked> PIX
                </label><br>
                <label>
                    <input type="radio" name="pagamento" value="Cartão de Crédito"> Cartão de Crédito
                </label><br>
                <label>
                    <input type="radio" name="pagamento" value="Dinheiro"> Dinheiro na Entrega
                </label><br><br>
                <button type="submit" style="padding: 10px 20px; font-weight: bold; cursor: pointer;">
                    FINALIZAR PEDIDO
                </button>
        </form>
        <br>
        <a href="/lumina_graca/index.php">Voltar</a>
    <?php endif; ?>
</body>

</html