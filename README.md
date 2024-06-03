<p align="center">
  <h1 align="center">API - Login Toolzz - Laravel</h1>
</p>

# Sobre o projeto

API RESTful desenvolvida com Laravel 11 e MySQL, para autenticação de usuários. Serve como um exemplo prático de um app Laravel, abordando desde a criação até o login de usuários e testes de integração.

## Pré-requisitos 

Para utilizar, é necessário:

- Composer
- Docker & Docker Compose
- git

### Nota

Verifique a disponibilidade da porta 3306 (padrão para MySQL no Laravel Sail) ou ajuste conforme necessário.

## Como Clonar o Projeto

Para clonar o projeto, abra um terminal e execute o comando a seguir e navegue até o diretório do projeto:
```bash
git clone https://github.com/carlosveerde/api-login.git
cd api-login
```

## Instalação e Configuração do Projeto usando Laravel Sail

Faça uma cópia do arquivo `.env.example` e renomeie-o para `.env` para configurar o ambiente:
```bash
cp .env.example .env
```

Instale as dependências do projeto executando o comando de instalação:
```bash
composer install --ignore-platform-reqs
```

Inicie os contêineres Docker utilizando Laravel Sail:

```bash
./vendor/bin/sail up --build
```

Gere a chave da aplicação Laravel :
```bash
./vendor/bin/sail artisan key:generate
```

Prepare as tabelas do banco de dados com o migrate:
```bash
./vendor/bin/sail artisan migrate
```

Caso queira popular o banco de dados com dados de teste, execute o seguinte comando:
```bash
./vendor/bin/sail artisan db:seed
```

## Como Rodar os Testes

Gere a chave da aplicação Laravel para o ambiente de teste executando o seguinte comando:
```bash
./vendor/bin/sail artisan key:generate --env=testing
```

Execute os testes de integração utilizando o seguinte comando:
```bash
./vendor/bin/sail artisan test 
```

## Gerando Documentação da API

Para gerar a documentação, utilize o seguinte comando:
```bash
./vendor/bin/sail artisan l5-swagger:generate
```

## Acessando a API

A API estará acessível através do `http://localhost:80`. 

A documentação da API estará disponível em `http://localhost:80/api/documentation`.

## Desligando o Laravel Sail

Para desligar o Laravel Sail, execute o seguinte comando:
```bash
./vendor/bin/sail down
```

## Possíveis Erros e Soluções

- **Erro**: Porta `3306` já está em uso.
    - **Solução**: Verifique se nenhum outro serviço está usando a porta `3306`. Se necessário, ajuste a porta no seu arquivo `.env` e `docker-compose.yml`.

- **Erro**: Permissões ao executar o Sail.
    - **Solução**: Execute os comandos do Sail com `sudo` ou adicione seu usuário ao grupo Docker.
      
- **Erro**: Problemas ao utilizar o composer.
    - **Solução**: Tente utilizar o PHP 8.2 com a extenção ZIP instalada antes de executar o `composer install`.
