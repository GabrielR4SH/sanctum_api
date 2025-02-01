# Laravel API with Sanctum Authentication

<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

## Sobre o Projeto

Este projeto é uma API Laravel utilizando Sanctum para autenticação. Ele permite a criação de usuários, login, logout e proteção de rotas com autenticação via tokens.

## Tecnologias Utilizadas

- [Laravel 10+](https://laravel.com/docs)
- [Laravel Sanctum](https://laravel.com/docs/sanctum)
- PHP 8+
- MySQL ou SQLite (para testes)

## Instalação

```bash
# Clone o repositório
git clone https://github.com/seuusuario/seurepositorio.git
cd seurepositorio

# Instale as dependências
composer install

# Copie o arquivo .env
cp .env.example .env

# Configure o banco de dados no arquivo .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seubanco
DB_USERNAME=seuusuario
DB_PASSWORD=suasenha

# Gere a chave da aplicação
php artisan key:generate

# Execute as migrações e seeders
php artisan migrate --seed

# Instale e publique o Sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

# Inicie o servidor
php artisan serve
```

## Autenticação com Sanctum

### Registrar Usuário
```http
POST /register
```
#### Parâmetros:
```json
{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "password": "senha123",
    "password_confirmation": "senha123"
}
```

### Login
```http
POST /login
```
#### Parâmetros:
```json
{
    "email": "johndoe@example.com",
    "password": "senha123"
}
```

### Logout
```http
POST /api/auth/logout
```
#### Cabeçalho:
```http
Authorization: Bearer {TOKEN}
```

### Perfil do Usuário
```http
GET /api/auth/user
```
#### Cabeçalho:
```http
Authorization: Bearer {TOKEN}
```

## Exemplo de Teste com cURL

```bash
curl -X POST "http://localhost:8000/api/login" \
     -H "Content-Type: application/json" \
     -d '{"email": "johndoe@example.com", "password": "senha123"}'
```

## Licença

Este projeto é open-source e está licenciado sob a [MIT License](https://opensource.org/licenses/MIT).

## Links Úteis

- [Documentação do Laravel](https://laravel.com/docs)
- [Documentação do Sanctum](https://laravel.com/docs/sanctum)
- [Laravel API Authentication Guide](https://laravel.com/docs/10.x/sanctum#issuing-api-tokens)
