# 🚀 Vanilla PHP REST API

[![PHP Version](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Docker](https://img.shields.io/badge/Docker-Enabled-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com)
[![Apache](https://img.shields.io/badge/Apache-2.4-D22128?style=for-the-badge&logo=apache&logoColor=white)](https://httpd.apache.org)
[![MySQL](https://img.shields.io/badge/MySQL-5.7-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![phpMyAdmin](https://img.shields.io/badge/phpMyAdmin-Enabled-6C78AF?style=for-the-badge&logo=phpmyadmin&logoColor=white)](https://www.phpmyadmin.net)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)
[![Open Source](https://img.shields.io/badge/Open%20Source-Yes-blue?style=for-the-badge)](https://github.com/yourusername/vanilla-php-rest-api)
[![REST API](https://img.shields.io/badge/REST-API-orange?style=for-the-badge)](https://restfulapi.net)

[English](#english) | [Português](#português)

## English

### 📝 Description
A modern, secure, and well-structured REST API built with vanilla PHP. This project demonstrates clean architecture principles, proper error handling, and best practices in PHP development.

### ✨ Features
- 🔐 JWT Authentication
- 🛡️ Secure Password Hashing
- 📦 Clean Architecture
- 🎯 MVC Pattern
- 🔄 RESTful Endpoints
- 🚦 Route Management
- 📊 MySQL Database Integration
- ⚡ PDO for Database Operations
- 🎨 Modern Response Format
- 🛠️ Error Handling System
- 🐳 Docker Containerization

### 🛠️ Technologies
- PHP 8.2 (Docker: php:8.2-apache)
- MySQL 5.7 (Docker)
- phpMyAdmin (Docker)
- PDO
- JWT
- Composer (for dependency management)

### 🐳 Docker Services
The project uses Docker with the following services:
- **Web Server**: PHP 8.2 with Apache
- **Database**: MySQL 5.7
- **Database Management**: phpMyAdmin
- **Network**: Custom bridge network for service communication

### 🏗️ Project Architecture

#### Core System
The project implements a custom routing system inspired by modern PHP frameworks like Laravel. The core functionality is handled by the `Core` class, which manages:
- Route dispatching
- Controller instantiation
- Method execution
- URL normalization
- Request/Response handling

#### Routing System
Routes are defined using static methods, similar to Laravel's syntax:
```php
Route::post('/users/create', 'UserController@store');
Route::get('/users/fetch', 'UserController@fetch');
```

The routing system supports:
- Dynamic route parameters (e.g., `{id}`)
- HTTP method validation
- Controller method mapping
- Automatic dependency injection

#### Directory Structure
```
src/
├── Controllers/     # Application controllers
├── Core/           # Core system classes
├── Http/           # HTTP related classes
├── Models/         # Database models
├── Services/       # Business logic
└── Utils/          # Helper classes
```

#### Key Components
- **Controllers**: Handle HTTP requests and responses
- **Services**: Contain business logic and data processing
- **Models**: Manage database interactions
- **Http**: Handle request/response and routing
- **Utils**: Provide helper functions and utilities

### 🚀 Getting Started

#### Prerequisites
- PHP 8.0 or higher
- MySQL Server
- Composer
- Web Server (Apache/Nginx)

#### Installation
1. Clone the repository
```bash
git clone https://github.com/yourusername/vanilla-php-rest-api.git
```

2. Configure your database
```php
// src/Models/Database.php
$pdo = new PDO("mysql:host=your_host;dbname=your_db", "your_user", "your_password");
```

3. Create the database table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 📚 API Endpoints

#### Users
- `POST /users/create` - Create a new user
- `POST /users/login` - User authentication
- `GET /users/fetch` - Get user data (requires JWT)
- `PUT /users/update` - Update user data (requires JWT)
- `DELETE /users/{id}/delete` - Delete user (requires JWT)

#### Testing the API
You can test all endpoints using the included REST Client file. The project comes with a pre-configured `Request.http` file in the `src/Utils/RestClient` directory. This file contains all the necessary requests to test the API endpoints.

To use it:
1. Install the "REST Client" extension in VS Code
2. Open the `Request.http` file
3. Click on "Send Request" above any request to test it
4. For authenticated endpoints, make sure to update the JWT token in the authorization header

### 🤝 Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

### 📄 License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## Português

### 📝 Descrição
Uma API REST moderna, segura e bem estruturada construída com PHP puro. Este projeto demonstra princípios de arquitetura limpa, tratamento adequado de erros e melhores práticas no desenvolvimento PHP.

### ✨ Funcionalidades
- 🔐 Autenticação JWT
- 🛡️ Hash Seguro de Senhas
- 📦 Arquitetura Limpa
- 🎯 Padrão MVC
- 🔄 Endpoints RESTful
- 🚦 Gerenciamento de Rotas
- 📊 Integração com MySQL
- ⚡ PDO para Operações no Banco
- 🎨 Formato Moderno de Resposta
- 🛠️ Sistema de Tratamento de Erros
- 🐳 Containerização com Docker

### 🛠️ Tecnologias
- PHP 8.2 (Docker: php:8.2-apache)
- MySQL 5.7 (Docker)
- phpMyAdmin (Docker)
- PDO
- JWT
- Composer (para gerenciamento de dependências)

### 🐳 Serviços Docker
O projeto utiliza Docker com os seguintes serviços:
- **Servidor Web**: PHP 8.2 com Apache
- **Banco de Dados**: MySQL 5.7
- **Gerenciamento do Banco**: phpMyAdmin
- **Rede**: Rede bridge personalizada para comunicação entre serviços

### 🏗️ Arquitetura do Projeto

#### Sistema Core
O projeto implementa um sistema de rotas personalizado inspirado em frameworks PHP modernos como Laravel. A funcionalidade principal é gerenciada pela classe `Core`, que controla:
- Despacho de rotas
- Instanciação de controllers
- Execução de métodos
- Normalização de URLs
- Manipulação de Request/Response

#### Sistema de Rotas
As rotas são definidas usando métodos estáticos, similar à sintaxe do Laravel:
```php
Route::post('/users/create', 'UserController@store');
Route::get('/users/fetch', 'UserController@fetch');
```

O sistema de rotas suporta:
- Parâmetros dinâmicos (ex: `{id}`)
- Validação de métodos HTTP
- Mapeamento de métodos do controller
- Injeção automática de dependências

#### Estrutura de Diretórios
```
src/
├── Controllers/     # Controllers da aplicação
├── Core/           # Classes do sistema core
├── Http/           # Classes relacionadas a HTTP
├── Models/         # Modelos do banco de dados
├── Services/       # Lógica de negócios
└── Utils/          # Classes auxiliares
```

#### Componentes Principais
- **Controllers**: Gerenciam requisições e respostas HTTP
- **Services**: Contêm lógica de negócios e processamento de dados
- **Models**: Gerenciam interações com o banco de dados
- **Http**: Manipulam request/response e roteamento
- **Utils**: Fornecem funções e utilitários auxiliares

### 🛠️ Começando

#### Pré-requisitos
- PHP 8.0 ou superior
- Servidor MySQL
- Composer
- Servidor Web (Apache/Nginx)

#### Instalação
1. Clone o repositório
```bash
git clone https://github.com/seuusuario/vanilla-php-rest-api.git
```

2. Configure seu banco de dados
```php
// src/Models/Database.php
$pdo = new PDO("mysql:host=seu_host;dbname=seu_db", "seu_usuario", "sua_senha");
```

3. Crie a tabela do banco de dados
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 📚 Endpoints da API

#### Usuários
- `POST /users/create` - Criar novo usuário
- `POST /users/login` - Autenticação de usuário
- `GET /users/fetch` - Obter dados do usuário (requer JWT)
- `PUT /users/update` - Atualizar dados do usuário (requer JWT)
- `DELETE /users/{id}/delete` - Deletar usuário (requer JWT)

#### Testando a API
Você pode testar todos os endpoints usando o arquivo REST Client incluído. O projeto vem com um arquivo `Request.http` pré-configurado no diretório `src/Utils/RestClient`. Este arquivo contém todas as requisições necessárias para testar os endpoints da API.

Para usar:
1. Instale a extensão "REST Client" no VS Code
2. Abra o arquivo `Request.http`
3. Clique em "Send Request" acima de qualquer requisição para testá-la
4. Para endpoints autenticados, certifique-se de atualizar o token JWT no cabeçalho de autorização

### 🤝 Contribuindo
Contribuições são bem-vindas! Sinta-se à vontade para enviar um Pull Request.

### 📄 Licença
Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.
