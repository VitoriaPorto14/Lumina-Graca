<?php
session_start();

// Bloqueia acesso de usuários não logados
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/includes/functions.php';

// Busca dados atualizados do usuário (sem retornar a senha)
$usuario_id = $_SESSION['usuario_id'];
$stmt = $conexao->prepare("SELECT id, nome, email, tipo FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - Lumina & Graça</title>
    <link rel="stylesheet" href="/lumina_graca/css/style.css">
    <link rel="icon" type="image/png" href="/lumina_graca/css/imagens/logo_guia.png">
</head>

<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="container">
        <div class="conta-card">
            <div class="conta-header">
                <div class="avatar-placeholder">
                    <?php echo strtoupper(substr($usuario['nome'], 0, 1)); ?>
                </div>
                <h2>Minha Conta</h2>
                <p class="conta-boas-vindas">Olá, <strong><?php echo htmlspecialchars($usuario['nome']); ?></strong>!</p>
            </div>

            <div class="conta-secao">
                <h3>Dados Cadastrados</h3>
                <div class="info-item">
                    <span class="info-label">Nome:</span>
                    <span class="info-valor"><?php echo htmlspecialchars($usuario['nome']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">E-mail:</span>
                    <span class="info-valor"><?php echo htmlspecialchars($usuario['email']); ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">ID:</span>
                    <span class="info-valor"><?php echo htmlspecialchars($usuario['id']); ?></span>
                </div>
            </div>

            <div class="conta-secao">
                <h3>Opções da Conta</h3>
                <div class="conta-acoes">
                    <a href="gerenciar_usuario/atualizar_u.php?id=<?php echo $usuario['id']; ?>" class="btn-conta-opcao">
                        <span>✏️ Atualizar Informações</span>
                    </a>
                    
                    <a href="logout.php" class="btn-conta-opcao btn-logout">
                        <span>🚪 Sair da Conta (Logout)</span>
                    </a>

                    <!-- Botão que abre o modal estilizado -->
                    <button type="button" class="btn-conta-opcao btn-deletar" onclick="abrirModalExclusao()">
                        <span>⚠️ Deletar Conta</span>
                    </button>
                </div>
            </div>

            <div class="conta-footer">
                <a href="index.php" class="btn-link">← Voltar ao Início</a>
            </div>
        </div>
    </main>

    <!-- Modal Elegante de Confirmação de Exclusão -->
    <div id="modal-exclusao" class="modal-overlay" style="display: none;">
        <div class="modal-conteudo">
            <div class="modal-icone">⚠️</div>
            <h3 class="modal-titulo">Excluir Conta</h3>
            <p class="modal-texto">Tem certeza que deseja apagar sua conta? Esta ação não poderá ser desfeita e todos os seus dados serão removidos.</p>
            
            <div class="modal-acoes">
                <button type="button" class="btn-modal-cancelar" onclick="fecharModalExclusao()">Cancelar</button>
                <a href="gerenciar_usuario/excluir_u.php?id=<?php echo $usuario['id']; ?>" class="btn-modal-confirmar">Confirmar Exclusão</a>
            </div>
        </div>
    </div>

    <script>
    function abrirModalExclusao() {
        document.getElementById('modal-exclusao').style.display = 'flex';
    }

    function fecharModalExclusao() {
        document.getElementById('modal-exclusao').style.display = 'none';
    }

    // Fecha o modal ao clicar fora da caixa
    window.onclick = function(event) {
        const modal = document.getElementById('modal-exclusao');
        if (event.target === modal) {
            fecharModalExclusao();
        }
    }
    </script>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>