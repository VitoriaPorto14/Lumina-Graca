# Lumina & Graça — E-Commerce de Moda Cristã e Beleza Consciente
A **Lumina & Graça** é uma aplicação web desenvolvida em PHP com foco no gerenciamento e na comercialização de peças de moda modesta, vestuário cristão e produtos de beleza consciente. O sistema foi criado com o objetivo de oferecer uma experiência de compra elegante, organizada e fluida para as clientes, além de proporcionar uma interface simples e eficiente para a gestão da loja por parte dos administradores.

A plataforma permite realizar operações essenciais de e-commerce e administração, como cadastro, listagem, edição e exclusão de registros de produtos (CRUD), controle de estoque em tempo real, acompanhamento de pedidos e centralização de mensagens de atendimento, utilizando um banco de dados PostgreSQL integrado. Dessa forma, o sistema auxilia no controle das informações do catálogo, dos usuários e das vendas, tornando o atendimento mais rápido, seguro e alinhado aos valores da marca.

---

## 1. Como Executar o Projeto

Para rodar este projeto na sua máquina, será necessário ter instalado um ambiente de servidor local (**PHP**) e o banco de dados **PostgreSQL**.
### Pré-Requisitos 
* **PHP** (v7.4 ou superior) habilitado com a extensão `pdo_pgsql`.
* **PostgreSQL** instalado e a rodar na porta `5432`padrão).
* **Git** instalado na máquina.

### Passo 1: Clonar o Repositório

Abra o terminal e execute:
```
# Clone este repositório
git clone https: https://github.com/VitoriaPorto14/Lumina-Graca.git

# Acesse a pasta do projeto
cd lumina_graca
```

### Passo 2: Configurar o Banco de Dados (Restore do Dump)

O projeto já conta com um ficheiro de dump.sql) com toda a estrutura das tabelase possivelmente dados iniciais) localizada na pasta /db/. Siga os passos abaixo para recriar o banco no seu PostgreSQL:

* 1 - Abra o terminalPrompt de Comando ou PowerShell).

* 2 - Conecte-se ao PostgreSQL usando o seu usuário principal (geralmente `postgres`): 
```
psql -U postgres
```
* 3 - Crie um usuário para executar o projeto:
```
CREATE USER nome_do_usuario WITH PASSWORD 'sua_senha';
```
* 4 - Se o banco de dados já existir de testes anteriores, apague-o e crie um novo para evitar conflitos de tabelas. Dentro do terminal interativo do `psql`, digite:
```
DROP DATABASE IF EXISTS [lumina];
CREATE DATABASE [lumina];
\q
```
* 5 - Navegue para a pasta `db` do projeto clonado e restaure o banco de dados executando o seguinte comando:
```
# Supondo que você esteja na raiz do projeto clonado
cd db

# Restaura o banco de dados
psql -U postgres -d lumina -f lumina.sql

# Volte para a raiz do projeto
cd ..
```

### Passo 3: Configurar a Conexão no PHP

* 1 - Na raiz do projeto, abra o ficheiro `connect.php`.

* 2 - Altere as credenciais para corresponderem às do seu ambiente local PostgreSQL:
```
$host = 'localhost';
$port = '5432';
$dbname = '[nome_bd]'; // O mesmo nome que criou no Passo 2
$user = 'postgres'; // O seu usuário do PostgreSQL
$password = 'sua_senha_aqui'; // A sua senha do PostgreSQL
```

### Passo 4: Acessar a Aplicação

Com o banco de dados configurado, inicie o servidor embutido do PHP.
Certifique-se de que o seu terminal está na raiz do projeto e execute:
```
php -S 0.0.0.0:3007
```
O servidor estará ativo! Agora, basta abrir o seu navegador de preferência e acessar:
```
http://localhost:3007
```
---

## 2. Regras de Negócio (RN)

| Categoria | Código | Regra de Negócio | Descrição |
| :--- | :---: | :--- | :--- |
| **Autenticação** | `RN01` | Níveis de Acesso | O sistema possui apenas dois perfis de usuário: `cliente` e `admin`. |
| **Autenticação** | `RN02` | Restrição do Admin | Páginas de gestão (`estoque.php`, `pedidos.php`, `mensagens.php`) são exclusivas do perfil `admin`. |
| **Autenticação** | `RN03` | Login para Compras | É obrigatório estar logado para acessar o checkout e finalizar um pedido. |
| **Autenticação** | `RN04` | Unicidade de E-mail | Não é permitido cadastrar mais de uma conta utilizando o mesmo e-mail. |
| **Estoque** | `RN05` | Gestão do Catálogo | Apenas o perfil `admin` pode adicionar, editar, atualizar ou remover produtos. |
| **Estoque** | `RN06` | Imagem do Produto | Todo produto deve ter uma imagem em `uploads/` ou exibir uma imagem padrão (*placeholder*). |
| **Estoque** | `RN07` | Baixa de Estoque | A cada pedido finalizado, o sistema decrementa automaticamente 1 unidade do estoque no banco. |
| **Estoque** | `RN08` | Estoque Indisponível | Produtos com estoque zerado (0) não podem ter pedidos concluídos pelos clientes. |
| **Pedidos** | `RN09` | Vínculo do Pedido | Todo pedido gravado deve obrigatoriamente estar associado ao ID do cliente logado. |
| **Pedidos** | `RN10` | Endereço Obrigatório | O formulário de checkout exige o preenchimento de CEP, rua, número, bairro, cidade e estado. |
| **Pedidos** | `RN11` | Integração WhatsApp | Ao concluir a compra, o sistema salva o pedido e direciona o cliente para o WhatsApp com o resumo. |
| **Vitrine** | `RN12` | Destaques da Home | A seção "Mais Vendidos" na página inicial exibe apenas produtos pré-selecionados por ID. |
| **Vitrine** | `RN13` | Listagem de Produtos | A vitrine (`m_produtos.php`) deve listar todos os produtos ativos do banco de dados. |
| **Atendimento** | `RN14` | Envio Assíncrono | O formulário "Fale Conosco" envia dados e salva na tabela `mensagens`. |
| **Atendimento** | `RN15` | Leitura de Mensagens | Somente o usuário `admin` tem acesso à central de mensagens enviadas pelos clientes. |
