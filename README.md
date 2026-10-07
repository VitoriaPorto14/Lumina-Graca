# Levantamento de Requisitos: LUMINA & GRAÇA

## 1. Requisitos Funcionais (RF)

### Front-Office (Loja Virtual & Área Pública)

* **RF01 - Visualização da Página Inicial (`index.php`)**:
  * Exibir cabeçalho (`header.php`) com logótipo e menu de navegação.
  * Apresentar banner/seção de introdução da marca (logótipo, imagem e descrição).
  * Exibir vitrine de produtos "Em Destaque / Mais Vendidos", com imagem, nome, descrição, preço e botão "Adicionar ao Carrinho".
  * Exibir rodapé (`footer.php`) padronizado com contactos, links de navegação e mini descrição.

* **RF02 - Listagem e Filtro por Categorias**:
  * Permitir a navegação entre páginas específicas de categorias: **Vestimentas** (`vestimentas.php`) e **Maquiagens** (`maquiagens.php`).
  * Exibir catálogo de produtos correspondentes com imagem, nome, descrição, preço e ação de adicionar ao carrinho.

* **RF03 - Visualização e Detalhes do Produto**:
  * Apresentar galeria de fotos do produto.
  * Disponibilizar tabela de medidas (crucial para vestuário).
  * Exibir indicador de stock disponível em tempo real.

* **RF04 - Carrinho e Checkout**:
  * Oferecer carrinho de compras lateral no formato *slide-over* (sem necessidade de recarregar a página).
  * Permitir alteração de quantidade e remoção de itens no carrinho.
  * Processar o checkout em uma única página (Checkout Simplificado / One-Step Checkout).

* **RF05 - Gestão de Conta e Autenticação (`usuarios.php`)**:
  * Permitir registo de novos clientes.
  * Permitir autenticação/login via e-mail e palavra-passe.

---

### Back-Office (Painel Administrativo)

* **RF06 - Autenticação e Controlo de Acesso**:
  * Diferenciar os níveis de permissão entre **Cliente** e **Administrador**.
  * Restringir o acesso às telas de gestão (`produtos.php`, `adicionar.php`, `editar.php`) exclusivamente a perfis de Administrador.

* **RF07 - Gestão de Produtos - Listagem (`produtos.php`)**:
  * Exibir tabela/lista de stock com ID, imagem miniatura, nome do produto, preço, categoria e opções de ação (Editar/Eliminar).
  * Disponibilizar botão de atalho para "Adicionar Novo Produto".

* **RF08 - Gestão de Produtos - Cadastro (`adicionar.php`)**:
  * Formulário para inclusão com os campos: Nome do Produto, Preço (R$), Categoria (Vestimenta ou Maquiagem), Imagem (Upload de ficheiro ou URL externa) e Descrição.

* **RF09 - Gestão de Produtos - Edição (`editar.php`)**:
  * Permitir a atualização dos dados cadastrais e alteração de imagens de um produto existente.

* **RF10 - Gestão de Produtos - Eliminação**:
  * Permitir a remoção/eliminação de produtos cadastrados no sistema.

---

## 2. Requisitos Não Funcionais (RNF)

### Desempenho e Usabilidade

* **RNF01 - Responsividade (Mobile-First)**: A interface deve ser totalmente adaptável para dispositivos móveis (smartphones) e computadores, garantindo a mesma fluidez em ambos os layouts.
* **RNF02 - Atualização Dinâmica (Assincronismo)**: O carrinho de compras lateral deve operar via AJAX ou Fetch API para evitar o recarregamento total da página durante a inclusão de itens.
* **RNF03 - Tempo de Resposta**: As páginas do e-commerce devem carregar em até 2 a 3 segundos para garantir alta retenção de clientes.

### Identidade Visual e Design

* **RNF04 - Fidelidade à Paleta de Cores**: A interface deve utilizar estritamente a identidade da marca nas seguintes tonalidades:
  * Marrom profundo (`#6B421F`)
  * Dourado caramelo (`#A97838`)
  * Bege dourado (`#C8A46A`)
  * Creme claro (`#E9DFC9`)
  * Off-white (`#F7F3EA`)
* **RNF05 - Estética e Conceito Visual**: O design de interface deve transparecer elegância, modéstia e sofisticação ("Beleza Consciente / Moda Modesta Cristã").

### Segurança e Arquitetura Técnico-Estrutural

* **RNF06 - Arquitetura de Código (PHP)**: Estrutura baseada em ficheiros modulares conforme a arquitetura proposta no projeto (`header.php`, `footer.php`, `index.php`, `produtos.php`, etc.).
* **RNF07 - Segurança de Autenticação**:
  * Criptografia forte para palavras-passe na base de dados (ex: `bcrypt` / `password_hash`).
  * Proteção das rotas administrativas contra acesso não autorizado de utilizadores não autenticados ou clientes comuns.
  * Validação no upload de ficheiros (restrição a formatos de imagem permitidos como JPG, PNG, WEBP e limite de tamanho).
* **RNF08 - Disponibilidade e Abrangência**: A infraestrutura deve suportar acessos simultâneos em nível nacional.
