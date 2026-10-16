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

## 3. Requisitos Funcionais (RF)

Os requisitos funcionais descrevem as ações e comportamentos específicos que o sistema deve realizar para atender às necessidades dos utilizadores e administradores.

| Código | Nome | Descrição |
| :---: | :--- | :--- |
| **RF01** | **Registo de Utilizadores** | O sistema deve permitir que novos clientes se cadastrem informando nome, e-mail e palavra-passe. |
| **RF02** | **Autenticação (Login/Logout)** | O sistema deve permitir que clientes e administradores iniciem e terminem sessão com e-mail e palavra-passe. |
| **RF03** | **Gestão do Perfil** | O cliente deve poder atualizar os seus dados pessoais (nome, e-mail, palavra-passe) e eliminar a sua conta. |
| **RF04** | **Exibição da Vitrine** | O sistema deve listar os produtos do catálogo na página de produtos e destacar os "Mais Vendidos" na página inicial. |
| **RF05** | **Processamento de Checkout** | O sistema deve recolher os dados de entrega (CEP, morada, pagamento) e registar a solicitação do pedido. |
| **RF06** | **Integração com WhatsApp** | O sistema deve gerar uma mensagem pré-formatada com o resumo do pedido e redirecionar o cliente para a API do WhatsApp. |
| **RF07** | **Envio de Mensagens de Contato** | O sistema deve disponibilizar um formulário "Fale Conosco" para envio de dúvidas e mensagens de suporte. |
| **RF08** | **Gestão de Produtos (CRUD)** | O administrador deve poder cadastrar, visualizar, editar e remover produtos do catálogo, incluindo o upload de imagens. |
| **RF09** | **Gestão de Pedidos** | O administrador deve visualizar a lista completa de pedidos realizados, com dados do cliente, data e valor total. |
| **RF10** | **Leitura de Mensagens** | O administrador deve ter acesso a um painel para ler todas as mensagens enviadas pelos clientes através do formulário de contacto. |
| **RF11** | **Controlo de Estoque** | O sistema deve atualizar e decrementar automaticamente 1 unidade do estoque no banco de dados a cada pedido concluído. |

---

## 4. Requisitos Não Funcionais (RNF)

Os requisitos não funcionais definem os critérios de qualidade, desempenho, segurança e usabilidade que o sistema deve cumprir.

| Código | Nome | Descrição |
| :---: | :--- | :--- |
| **RNF01** | **Segurança e Acesso** | As sessões do utilizador devem ser validadas no lado do servidor (Server-Side) para restringir o acesso a páginas administrativas apenas a utilizadores do tipo `admin`. |
| **RNF02** | **Proteção contra SQL Injection** | Todas as interações com o banco de dados PostgreSQL devem utilizar instruções preparadas (`Prepared Statements` via PDO). |
| **RNF03** | **Responsividade** | A interface do utilizador deve ser totalmente adaptável a dispositivos móveis (smartphones, tablets) e computadores desktop. |
| **RNF04** | **Usabilidade e Design** | O front-end deve seguir a identidade visual da marca (*off-white, dourado e cinza profundo*) com navegação clara e intuitiva. |
| **RNF05** | **Desempenho e Asseguramento AJAX** | O envio de formulários de contacto deve ser feito de forma assíncrona (Fetch API / AJAX) para evitar recarregamentos desnecessários de página. |
| **RNF06** | **Persistência de Dados** | O sistema deve utilizar o SGBD PostgreSQL com integridade referencial (`FOREIGN KEY`) e ações em cascata para garantir a consistência das informações. |
| **RNF07** | **Disponibilidade e Compatibilidade** | A aplicação deve ser compatível com os principais navegadores modernos (Google Chrome, Mozilla Firefox, Microsoft Edge, Safari) no ambiente PHP 8.x. |

---

## 5. Product Backlog

### Autenticação e Gestão de Contas de Utilizador

#### US01 — Registo de Cliente
* **Como** cliente final,  
* **Quero** criar uma conta no site informando o meu nome, e-mail e palavra-passe,  
* **Para que** eu possa realizar compras e guardar as minhas informações no sistema.
* **Critérios de Aceitação:**
  * Validação de e-mail único na base de dados.
  * Confirmação visual de registo realizado com sucesso.
  * Redirecionamento automático ou direcionamento para a página de login.
* **Prioridade:** Essencial

#### US02 — Login e Sessão de Utilizador
* **Como** utilizador (cliente ou admin),  
* **Quero** iniciar sessão informando as minhas credenciais ativas,  
* **Para que** eu possa aceder a recursos restritos de acordo com o meu perfil.
* **Critérios de Aceitação:**
  * Verificação de credenciais seguras no PostgreSQL.
  * Armazenamento do perfil (`cliente` ou `admin`) na sessão PHP.
  * Mensagem clara de erro em caso de dados incorretos.
* **Prioridade:** Essencial

#### US03 — Atualização de Dados e Alteração de Palavra-passe
* **Como** cliente autenticado,  
* **Quero** atualizar o meu nome, e-mail e alterar a minha palavra-passe na área "Minha Conta",  
* **Para que** eu mantenha as minhas informações de contacto e acesso sempre atualizadas.
* **Critérios de Aceitação:**
  * Campo de nova palavra-passe opcional (se mantido em branco, conserva a palavra-passe atual).
  * Atualização imediata dos dados da sessão ativa.
  * Feedback visual de alteração concluída.
* **Prioridade:** Essencial

#### US04 — Eliminação de Conta
* **Como** cliente autenticado,  
* **Quero** ter a opção de eliminar a minha conta no sistema,  
* **Para que** os meus dados sejam removidos conforme as minhas preferências.
* **Critérios de Aceitação:**
  * Exibição de modal de confirmação antes de efetivar a eliminação.
  * Remoção do utilizador na base de dados com destruição da sessão.
  * Redirecionamento para a página inicial com mensagem de sucesso.
* **Prioridade:** Importante

---

### Vitrine de Produtos e Navegação (Front-Office)

#### US05 — Exibição da Página Inicial (Home)
* **Como** visitante da loja,  
* **Quero** visualizar a apresentação da marca, o lançamento exclusivo e a secção de "Mais Vendidos",  
* **Para que** eu conheça a proposta de valor e encontre os produtos em destaque.
* **Critérios de Aceitação:**
  * Destaque para o banner e slogan da marca (*"Com Cristo, tudo se ilumina"*).
  * Exibição da grelha de produtos mais vendidos dinamicamente através da base de dados.
  * Identidade visual alinhada às cores *off-white, dourado e cinza profundo*.
* **Prioridade:** Essencial

#### US06 — Catálogo Completo de Produtos
* **Como** cliente,  
* **Quero** navegar na vitrine completa de produtos (`m_produtos.php`),  
* **Para que** eu possa escolher as peças de moda e beleza da minha preferência.
* **Critérios de Aceitação:**
  * Listagem de nome, foto, descrição e preço formatado em Reais (R$).
  * Exibição de imagem padrão (*placeholder*) quando o produto não possuir imagem cadastrada.
  * Botão de solicitação de pedido visível em cada card.
* **Prioridade:** Essencial

---

#### Processamento de Vendas e Checkout

#### US07 — Checkout e Formulário de Entrega
* **Como** cliente autenticado,  
* **Quero** preencher o meu endereço de entrega e escolher a forma de pagamento,  
* **Para que** eu possa concluir o meu pedido na loja.
* **Critérios de Aceitação:**
  * Validação obrigatória dos campos de CEP, rua, número, bairro, cidade e estado.
  * Verificação e baixa automática de 1 unidade do estoque na base de dados.
  * Registo dos dados nas tabelas `pedidos` e `item_pedido`.
* **Prioridade:** Essencial

#### US08 — Integração de Pedido com WhatsApp
* **Como** cliente,  
* **Quero** ser redirecionado para o WhatsApp com o resumo do meu pedido preenchido,  
* **Para que** eu possa alinhar o pagamento e finalizar o atendimento diretamente com a loja.
* **Critérios de Aceitação:**
  * Abertura automática da API do WhatsApp num novo separador ao enviar o checkout.
  * Formatação limpa com número do pedido, nome do cliente e dados da compra.
* **Prioridade:** Essencial

---

### Atendimento ao Cliente

#### US09 — Formulário "Fale Conosco" (Envio Assíncrono)
* **Como** visitante ou cliente,  
* **Quero** enviar mensagens, dúvidas e sugestões através do formulário de contacto,  
* **Para que** eu receba atendimento da equipa Lumina & Graça.
* **Critérios de Aceitação:**
  * Envio das informações sem recarregar a página (Fetch API / AJAX).
  * Gravação dos dados na tabela `mensagens_contato`.
  * Exibição do banner de sucesso com rolagem suave no ecrã.
* **Prioridade:** Essencial

---

### Painel Administrativo (Back-Office)

#### US10 — Gestão de Estoque e Catálogo (CRUD de Produtos)
* **Como** administrador,  
* **Quero** cadastrar, editar, atualizar preços/quantidades e remover produtos no painel de estoque,  
* **Para que** o catálogo de produtos esteja sempre atualizado em tempo real.
* **Critérios de Aceitação:**
  * Proteção do acesso: apenas utilizadores do perfil `admin` podem visualizar e alterar.
  * Suporte a upload e substituição de imagens de produtos na pasta `uploads/`.
  * Tabela responsiva e estilizada para gestão dos itens.
* **Prioridade:** Essencial

#### US11 — Acompanhamento de Pedidos
* **Como** administrador,  
* **Quero** visualizar a lista de todos os pedidos efetuados na loja (`pedidos.php`),  
* **Para que** eu monitorize os clientes, datas e faturamento gerado.
* **Critérios de Aceitação:**
  * Exibição das colunas de número do pedido, cliente, e-mail, data formatada e valor total.
  * Alinhamento e estilização limpa da tabela administrativa.
* **Prioridade:** Essencial

#### US12 — Central de Leitura de Mensagens de Atendimento
* **Como** administrador,  
* **Quero** aceder a um painel dedicado às mensagens enviadas no "Fale Conosco" (`mensagens.php`),  
* **Para que** eu possa ler as dúvidas e responder aos clientes via e-mail.
* **Critérios de Aceitação:**
  * Listagem em ordem cronológica (mensagens mais recentes no topo).
  * Link direto `mailto:` para facilitar o envio da resposta para o e-mail do cliente.
* **Prioridade:** Importante

---

## 6. Tabela Resumo do Product Backlog — Lumina & Graça

| ID | Épico | História de Usuário (User Story) | Prioridade | Critérios de Aceitação Principal |
| :---: | :--- | :--- | :---: | :--- |
| **US01** | Autenticação | **Registo de Cliente:** Criar conta com nome, e-mail e palavra-passe. | `Essencial` | E-mail único, confirmação visual de sucesso e redirecionamento. |
| **US02** | Autenticação | **Login e Sessão:** Autenticar cliente ou admin no sistema. | `Essencial` | Validação no PostgreSQL, armazenamento do perfil na sessão PHP e erro em dados incorretos. |
| **US03** | Autenticação | **Atualização de Perfil:** Alterar nome, e-mail e senha na área "Minha Conta". | `Essencial` | Campo de senha opcional, atualização imediata da sessão ativa e feedback visual. |
| **US04** | Autenticação | **Eliminação de Conta:** Excluir permanentemente o perfil no site. | `Importante` | Modal de confirmação antes de apagar, destruição de sessão e limpeza no banco. |
| **US05** | Vitrine | **Página Inicial (Home):** Exibir apresentação da marca e "Mais Vendidos". | `Essencial` | Destaque do banner/slogan, grelha dinâmica de produtos e visual *off-white/dourado*. |
| **US06** | Vitrine | **Catálogo de Produtos:** Listar todas as peças em `m_produtos.php`. | `Essencial` | Exibição de foto, nome, preço em R$, imagem padrão (*placeholder*) e botão de pedido. |
| **US07** | Checkout | **Formulário de Entrega:** Preencher endereço, CEP e forma de pagamento. | `Essencial` | Validação de campos obrigatórios, baixa automática de 1 unidade no estoque e gravação no banco. |
| **US08** | Checkout | **Integração WhatsApp:** Redirecionar cliente com resumo do pedido. | `Essencial` | Abertura automática da API do WhatsApp com número do pedido e itens selecionados. |
| **US09** | Atendimento | **Formulário "Fale Conosco":** Enviar dúvidas e mensagens via AJAX. | `Essencial` | Envio sem recarregar a página (Fetch API), gravação em `mensagens_contato` e aviso em tela. |
| **US10** | Painel Admin | **CRUD de Estoque:** Cadastrar, editar e remover produtos do catálogo. | `Essencial` | Acesso exclusivo para `admin`, upload/substituição de imagens em `uploads/` e tabela responsiva. |
| **US11** | Painel Admin | **Acompanhamento de Pedidos:** Listar todas as compras em `pedidos.php`. | `Essencial` | Colunas de ID, cliente, e-mail, data formatada e valor total faturado. |
| **US12** | Painel Admin | **Central de Mensagens:** Ler mensagens do formulário de contato em `mensagens.php`. | `Importante` | Ordenação por data mais recente e botão `mailto:` com clique direto para resposta. |

## 7. Prototipagem Canva - Média Fidelidade

[Prototipagem Canva](https://canva.link/6hg20e9foarpfzx)
