<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - Lumina & Graça</title>
    <link rel="stylesheet" href="/lumina_graca/css/style.css">
    <link rel="icon" type="image/png" href="/lumina_graca/css/imagens/logo_guia.png">
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main class="container">
        <div class="form-card contato-card">
            <div class="form-header text-center">
                <h2>Fale Conosco</h2>
                <p class="form-subtitulo">Entre em contato preenchendo o formulário ou através dos nossos canais diretos</p>
                <div class="divisor-dourado"></div>
            </div>

            <!-- Caixa de mensagem de sucesso integrada -->
            <div id="mensagem-sucesso" class="alerta-sucesso-contato" style="display: none;">
                <span class="icone-sucesso">✨</span>
                <div>
                    <strong>Mensagem enviada com sucesso!</strong>
                    <p>Agradecemos o seu contato. Responderemos o mais breve possível.</p>
                </div>
            </div>

            <div class="contato-grid">
                <!-- Formulário com envio suave e aviso customizado -->
                <form id="form-contato" onsubmit="enviarContato(event)" class="form-produto">
                    <div class="form-grupo">
                        <label for="nome">Nome Completo *</label>
                        <input type="text" name="nome" id="nome" placeholder="Digite seu nome" required>
                    </div>

                    <div class="form-grupo">
                        <label for="email">E-mail *</label>
                        <input type="email" name="email" id="email" placeholder="seuemail@exemplo.com" required>
                    </div>

                    <div class="form-grupo">
                        <label for="assunto">Assunto</label>
                        <input type="text" name="assunto" id="assunto" placeholder="Ex: Dúvidas sobre produto">
                    </div>

                    <div class="form-grupo">
                        <label for="mensagem">Mensagem *</label>
                        <textarea name="mensagem" id="mensagem" rows="5" placeholder="Escreva sua mensagem aqui..." required></textarea>
                    </div>

                    <div class="form-acoes-contato">
                        <button type="submit" class="btn-adicionar btn-block">ENVIAR MENSAGEM</button>
                    </div>
                </form>

                <!-- Informações, Canais Diretos e Redes Sociais -->
                <div class="canais-atendimento">
                    <h3>Nossos Canais</h3>
                    <p class="canais-descricao">Estamos à disposição para ajudar você a escolher a peça ideal ou tirar dúvidas sobre o seu pedido.</p>

                    <div class="canal-item">
                        <span class="canal-icone">✉️</span>
                        <div>
                            <strong>E-mail:</strong>
                            <p>contato@luminagraca.com</p>
                        </div>
                    </div>

                    <div class="canal-item">
                        <span class="canal-icone">📱</span>
                        <div>
                            <strong>Telefone / WhatsApp:</strong>
                            <p>(11) 99999-9999</p>
                        </div>
                    </div>

                    <div class="canal-item">
                        <span class="canal-icone">📸</span>
                        <div>
                            <strong>Instagram:</strong>
                            <p>@lumina&graça</p>
                        </div>
                    </div>

                    <div class="canal-item">
                        <span class="canal-icone">📘</span>
                        <div>
                            <strong>Facebook:</strong>
                            <p>lumina&graça</p>
                        </div>
                    </div>

                    <div class="canal-item">
                        <span class="canal-icone">🎵</span>
                        <div>
                            <strong>TikTok:</strong>
                            <p>@lumina&graça</p>
                        </div>
                    </div>

                    <div class="atendimento-horario">
                        <strong>Horário de Atendimento:</strong>
                        <p>Segunda a Sexta, das 09h às 18h</p>
                    </div>
                </div>
            </div>

            <div class="contato-footer">
                <a href="/lumina_graca/index.php" class="btn-link">← Voltar para o Início</a>
            </div>
        </div>
    </main>

    <script>
    function enviarContato(event) {
        event.preventDefault();
        
        // Exibe o banner de sucesso sofisticado
        const banner = document.getElementById('mensagem-sucesso');
        banner.style.display = 'flex';
        
        // Limpa os campos do formulário
        document.getElementById('form-contato').reset();

        // Rola suavemente até o topo da caixa de aviso
        banner.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    </script>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>