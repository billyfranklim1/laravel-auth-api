# LARAVEL AUTH API

API de autenticação com Laravel Sanctum.

## Pré-requisitos

- PHP >= 8.0.2
- Composer
- Um servidor de banco de dados (MySQL, PostgreSQL, etc.)

## Configuração Inicial

1. **Clone o Repositório**

   ```
   git clone https://github.com/billyfranklim1/laravel-auth-api.git
   cd laravel-auth-api
   ```

2. **Instale as Dependências do Composer**

   ```
   composer install
   ```

3. **Configure o Ambiente**

   Copie o arquivo `.env.example` para criar um arquivo `.env`:

   ```
   cp .env.example .env
   ```

   Edite o arquivo `.env` com as configurações do seu banco de dados e outras variáveis de ambiente necessárias.

4. **Gere a Chave da Aplicação**

   ```
   php artisan key:generate
   ```

5. **Execute as Migrations e Seeders (Opcional)**

   ```
   php artisan migrate
   php artisan db:seed
   ```

## Executando o Projeto

- Inicie o servidor de desenvolvimento:

  ```
  php artisan serve
  ```

- Acesse `http://localhost:8000` no seu navegador.

## Testes

- Para executar os testes:

  ```
  php artisan test
  ```
