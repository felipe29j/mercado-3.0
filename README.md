# Desafio técnico - Mercado.

Este é um sistema de mercado desenvolvido para gerenciar produtos, tipos de produtos e vendas. Ele fornece uma interface amigável para os funcionários do mercado registrarem vendas e calcularem os impostos sobre essas vendas.

## 1. Configuração do Ambiente

1.1. Instalação do PHP

Se você ainda não tem o PHP instalado, baixe e instale a versão adequada para o seu sistema operacional. Você pode encontrar o PHP no site oficial PHP.net.

1.2. Instalação do PostgreSQL (Opcional)

Se desejar usar o PostgreSQL como banco de dados, baixe e instale o PostgreSQL em postgresql.org.

## 2. Clone o repositório para sua máquina local:

git clone [git@github.com:felipe29j/mercado-3.0.git](https://github.com/felipe29j/mercado-3.0.git)

Se não ter a SSH pode usar esse 

git clone [https://github.com/felipe29j/mercado-3.0.git](https://github.com/felipe29j/mercado-3.0.git)

## 3. Desenvolvimento do Banco de Dados 

Lembrando que pode se pegar o dump e apenas criar o database com a nome "mercado" para usá-lo, o dump está dentro da pasta raiz com a nomeação de 'mercado'.

Via terminal: 

Execução do Arquivo SQL:

1. Abra o Console do PostgreSQL (psql)

Se você estiver em um ambiente Linux, macOS ou Windows com o PostgreSQL instalado, abra o terminal (ou Command Prompt no Windows) e inicie o console do PostgreSQL com o comando psql. Caso esteja utilizando uma interface gráfica como pgAdmin, você pode executar comandos SQL diretamente por lá.

2. Conecte-se ao PostgreSQL
No terminal, conecte-se ao servidor PostgreSQL usando o comando:

psql -U <username>
Substitua <username> pelo seu nome de usuário do PostgreSQL. Você pode ser solicitado a fornecer a senha do usuário.

3. Crie o Banco de Dados

Após conectar-se ao servidor PostgreSQL, crie o banco de dados usando o comando SQL:

CREATE DATABASE mercado;

Você deve ver uma mensagem de confirmação indicando que o banco de dados foi criado com sucesso.

4. Conecte-se ao Banco de Dados "mercado"

Agora, conecte-se ao banco de dados recém-criado:

\c mercado

Isso muda o contexto do console psql para o banco de dados "mercado".

5. Execute o Script SQL para Criar e Popular as Tabelas

Agora que você está conectado ao banco de dados "mercado", pode executar o script SQL que contém as definições e dados das tabelas.

Se o arquivo SQL estiver no mesmo diretório do seu terminal, use o comando:

\i mercado.sql

Caso o arquivo esteja em outro diretório, forneça o caminho completo para o arquivo:

\i /caminho/para/o/mercado.sql

Via pgAdmin:

1. Abra o pgAdmin e faça login.

2. Crie um database mercado;

3. Selecione o banco de dados para o qual deseja importar o mercado SQL.

4. Clique com o botão direito no banco de dados e escolha "Restore...". Isso abrirá uma janela onde você pode selecionar o arquivo SQL e iniciar o processo de restauração.

3.1. Criação do Banco de Dados e Tabelas(Opcional)

Crie um script SQL para criar o banco de dados "mercado" e as tabelas necessárias dentro dele. Você pode executar esse script usando o pgAdmin ou outro cliente PostgreSQL. 

Certifique-se de executar os comandos SQL dentro do banco de dados "mercado".

CREATE DATABASE mercado;

Nesse ponto acesse a database mercado e depois rode os seguintes comandos:

CREATE TABLE tipos_produtos (

    id SERIAL PRIMARY KEY,

    nome VARCHAR(255) NOT NULL,

    imposto_percentual DECIMAL(5, 2) NOT NULL

);

CREATE TABLE produtos (

    id SERIAL PRIMARY KEY,

    nome VARCHAR(255) NOT NULL,

    tipo_id INT NOT NULL REFERENCES tipos_produtos(id),

    preco DECIMAL(10, 2) NOT NULL

);

CREATE TABLE vendas (

    id SERIAL PRIMARY KEY,

    produto_id INT NOT NULL REFERENCES produtos(id),

    quantidade INT NOT NULL,

    valor_total DECIMAL(10, 2) NOT NULL,

    valor_imposto DECIMAL(10, 2) NOT NULL,

    data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

## 4. Desenvolvimento do Backend em PHP

4.1. Conexão com o Banco de Dados

Criei um arquivo models/Database.php na pasta api para estabelecer a conexão com o banco de dados.

$host = 'localhost'; //Insira o host que ira utilizar 

$port = '5432'; // Altere para a porta correta, a porta 8080 foi usada para fins de teste.

$dbname = 'mercado'; //Ou o que preferir utilizar.

$username = 'username'; //Nome do usuario do banco

$password = 'password'; //Sua senha usada no banco

## 5. Desenvolvimento do Frontend em HTML e CSS

5.1. Páginas HTML

Criei arquivos HTML para as diferentes páginas do projeto, como a página inicial (index.php), página de cadastro de produtos (cadastro_produto.php), página de cadastro de tipos de produtos (cadastro_tipo_produto.php), página de listagem de produtos (listar_produtos.php) e página de registro de vendas (efetuar_venda.php).

5.2. Estilização com CSS

Criei um arquivo style.css na pasta css para estilizar as páginas HTML e tornar o projeto visualmente atraente.

## 6. Teste do Projeto

6.1. Execução do Servidor PHP

Abra o terminal, navegue até a pasta raiz do seu projeto (mercado/) e execute o seguinte comando para iniciar o servidor PHP embutido:

php -S localhost:8080

Lembrando que deve ter as extensões do postgres habilitados ( extension=pdo_pgsql ou extension=pgsql que estará dentro do php.ini do seu php) para a execução correta.

6.2. Acesso às Páginas

Abra um navegador da web e acesse http://localhost:8080 para testar todas as funcionalidades do projeto.

6.3. Iniciando a navegação

Primeiramente cadastre um tipo de produto, isso irá habilitar para cadastrar um novo produto e com isso registre a venda. Logo após pode-se ver na lista de venda a quantidade de produtos vendidos. 

## 7. Conclusão

Parabéns! Você concluiu a instalação do projeto do mercado. Agora, você tem um sistema funcional para cadastrar produtos, tipos de produtos, registro de vendas e listagem de produtos.