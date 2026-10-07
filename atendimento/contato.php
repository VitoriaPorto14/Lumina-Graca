<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Contato</title>
</head>

<body>

    <h1>CONTATO</h1>
    <p>Entre em contato conosco preenchendo o formulário ou através das nossas redes e canais diretos.</p>

    <!-- Adicionado evento onsubmit para mostrar a mensagem de sucesso -->
    <form onsubmit="alert('Mensagem enviada com sucesso!'); return true;">
        <label for="nome">* Nome Completo:</label><br>
        <input type="text" name="nome" id="nome" placeholder="Digite seu nome" required><br><br>

        <label for="email">* E-mail:</label><br>
        <input type="email" name="email" id="email" placeholder="seuemail@exemplo.com" required><br><br>

        <label for="assunto">Assunto:</label><br>
        <input type="text" name="assunto" id="assunto" placeholder="Ex: Dúvidas sobre produto"><br><br>

        <label for="mensagem">* Mensagem:</label><br>
        <textarea name="mensagem" id="mensagem" rows="5" cols="50" placeholder="Escreva sua mensagem aqui..." required></textarea><br><br>

        <!-- Corrigido de type="button" para type="submit" -->
        <button type="submit">ENVIAR</button>
    </form>

    <hr>

    <h3>Nossos Canais</h3>
    <p><strong>E-mail:</strong> contato@luminagraca.com</p>
    <p><strong>Telefone / WhatsApp:</strong> (00) 99999-9999</p>

    <br>
    <a href="/lumina_graca/index.php">Voltar</a>

</body>

</html>