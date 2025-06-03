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
A modern, secure, and well-structured REST API built with vanilla PHP. This project implements a custom routing system inspired by modern frameworks, following a layered architecture pattern with clear separation of concerns between controllers, services, and models. It demonstrates practical approaches to error handling, authentication, and database operations in PHP.

### ✨ Features
- 🔐 JWT Authentication
- 🛡️ Secure Password Hashing
- 📦 Layered Architecture
- 🎯 MVC Pattern
- 🔄 RESTful Endpoints
- 🚦 Custom Routing System
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

### 📚 API Endpoints

#### Users
- `POST /users/create` - Create a new user
- `POST /users/login` - User authentication
- `GET /users/fetch` - Get user data (requires JWT)
- `PUT /users/update` - Update user data (requires JWT)
- `DELETE /users/{id}/delete` - Delete user (requires JWT)

### 🚀 Getting Started

#### Prerequisites
- PHP 8.0 or higher
- MySQL Server
- Composer
- Web Server (Apache/Nginx)

#### Installation
1. Clone the repository
```bash
git clone https://github.com/NatanR-dev/vanilla-php-rest-api.git
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

### 📝 Simple Doc for Contributors

This section provides a detailed technical overview of the project's architecture and implementation details for developers who want to understand or contribute to the codebase.

#### Core System Architecture

1. **Routing System**
   ```php
   // Route definition
   Route::post('/users/create', 'UserController@store');
   
   // Route matching in Core class
   $pattern = '#^'. preg_replace('/{id}/', '([\w-]+)', $route['path']) .'$#';
   if (preg_match($pattern, $url, $matches)) {
       // Route matched!
   }
   ```

2. **Request Processing Pipeline**
   ```php
   // Request body parsing
   $json = json_decode(file_get_contents('php://input'), true) ?? [];
   
   // Authorization header handling
   $headers = array_change_key_case(getallheaders(), CASE_LOWER);
   $authorizationPartials = explode(' ', $headers['authorization']);
   ```

3. **Response System**
   ```php
   // HTTP Response formatting
   $this->response->json([
       'error' => false,
       'success' => true,
       'data' => $data
   ], 200);
   ```

#### Database Layer

1. **Connection Management**
   ```php
   // PDO Connection
   $pdo = new PDO("mysql:host=db;dbname=app_db", "user", "user_password");
   ```

2. **Error Handling**
   ```php
   // MySQL Error Mapping
   match (true) {
       MySqlErrorResolver::isNoPermission($code) => 
           ServiceResponse::error('Access denied for user.'),
       MySqlErrorResolver::isDatabaseNotFound($code) => 
           ServiceResponse::error('Database does not exist.'),
       // ... other error cases
   }
   ```

#### Authentication System

1. **JWT Implementation**
   ```php
   // Token Generation
   $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
   $payload = json_encode($data);
   $signature = hash_hmac('sha256', $header . '.' . $payload, $secret, true);
   
   // Token Verification
   $tokenPartials = explode('.', $jwt);
   if ($signature !== self::signature($header, $payload)) return false;
   ```

2. **Password Security**
   ```php
   // Password Hashing
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   
   // Password Verification
   if(!password_verify($password, $user['password'])) return false;
   ```

#### Service Layer Patterns

1. **Standard Response Format**
   ```php
   // Success Response
   return [
       'error' => false,
       'success' => true,
       'message' => $message,
       'data' => $data
   ];
   
   // Error Response
   return [
       'error' => true,
       'success' => false,
       'message' => $message
   ];
   ```

2. **Data Validation**
   ```php
   // Field Validation
   foreach($fields as $field => $value) {
       if (empty(trim($value))) {
           throw new \Exception("The field $field is required.");
       }
   }
   ```

#### Docker Configuration

1. **Service Definitions**
   ```yaml
   services:
     web:
       build:
         context: .
         dockerfile: Dockerfile
       ports:
         - "8080:80"
     
     db:
       image: mysql:5.7
       environment:
         MYSQL_DATABASE: ${MYSQL_DATABASE}
         MYSQL_USER: ${MYSQL_USER}
   ```

2. **PHP Configuration**
   ```dockerfile
   FROM php:8.2-apache
   RUN docker-php-ext-install pdo pdo_mysql
   RUN a2enmod rewrite
   ```

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
Uma API REST moderna, segura e bem estruturada construída com PHP puro. Este projeto implementa um sistema de rotas personalizado inspirado em frameworks modernos, seguindo um padrão de arquitetura em camadas com clara separação de responsabilidades entre controllers, services e models. Demonstra abordagens práticas para tratamento de erros, autenticação e operações com banco de dados em PHP.

### ✨ Funcionalidades
- 🔐 Autenticação JWT
- 🛡️ Hash Seguro de Senhas
- 📦 Arquitetura em Camadas
- 🎯 Padrão MVC
- 🔄 Endpoints RESTful
- 🚦 Sistema de Rotas Personalizado
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

### 📚 Endpoints da API

#### Usuários
- `POST /users/create` - Criar novo usuário
- `POST /users/login` - Autenticação de usuário
- `GET /users/fetch` - Obter dados do usuário (requer JWT)
- `PUT /users/update` - Atualizar dados do usuário (requer JWT)
- `DELETE /users/{id}/delete` - Deletar usuário (requer JWT)

### 🚀 Começando

#### Pré-requisitos
- PHP 8.0 ou superior
- Servidor MySQL
- Composer
- Servidor Web (Apache/Nginx)

#### Instalação
1. Clone o repositório
```bash
git clone https://github.com/NatanR-dev/vanilla-php-rest-api.git
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

### 📝 Mini Doc para Contribuidores

Esta seção fornece uma visão técnica detalhada da arquitetura do projeto e detalhes de implementação para desenvolvedores que desejam entender ou contribuir com o código.

#### Arquitetura do Sistema Core

1. **Sistema de Rotas**
   ```php
   // Definição de rota
   Route::post('/users/create', 'UserController@store');
   
   // Correspondência de rota na classe Core
   $pattern = '#^'. preg_replace('/{id}/', '([\w-]+)', $route['path']) .'$#';
   if (preg_match($pattern, $url, $matches)) {
       // Rota encontrada!
   }
   ```

2. **Pipeline de Processamento de Requisições**
   ```php
   // Parsing do corpo da requisição
   $json = json_decode(file_get_contents('php://input'), true) ?? [];
   
   // Manipulação do header de autorização
   $headers = array_change_key_case(getallheaders(), CASE_LOWER);
   $authorizationPartials = explode(' ', $headers['authorization']);
   ```

3. **Sistema de Resposta**
   ```php
   // Formatação da resposta HTTP
   $this->response->json([
       'error' => false,
       'success' => true,
       'data' => $data
   ], 200);
   ```

#### Camada de Banco de Dados

1. **Gerenciamento de Conexão**
   ```php
   // Conexão PDO
   $pdo = new PDO("mysql:host=db;dbname=app_db", "user", "user_password");
   ```

2. **Tratamento de Erros**
   ```php
   // Mapeamento de Erros MySQL
   match (true) {
       MySqlErrorResolver::isNoPermission($code) => 
           ServiceResponse::error('Acesso negado para o usuário.'),
       MySqlErrorResolver::isDatabaseNotFound($code) => 
           ServiceResponse::error('Banco de dados não existe.'),
       // ... outros casos de erro
   }
   ```

#### Sistema de Autenticação

1. **Implementação JWT**
   ```php
   // Geração de Token
   $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
   $payload = json_encode($data);
   $signature = hash_hmac('sha256', $header . '.' . $payload, $secret, true);
   
   // Verificação de Token
   $tokenPartials = explode('.', $jwt);
   if ($signature !== self::signature($header, $payload)) return false;
   ```

2. **Segurança de Senha**
   ```php
   // Hash de Senha
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   
   // Verificação de Senha
   if(!password_verify($password, $user['password'])) return false;
   ```

#### Padrões da Camada de Serviço

1. **Formato Padrão de Resposta**
   ```php
   // Resposta de Sucesso
   return [
       'error' => false,
       'success' => true,
       'message' => $message,
       'data' => $data
   ];
   
   // Resposta de Erro
   return [
       'error' => true,
       'success' => false,
       'message' => $message
   ];
   ```

2. **Validação de Dados**
   ```php
   // Validação de Campos
   foreach($fields as $field => $value) {
       if (empty(trim($value))) {
           throw new \Exception("O campo $field é obrigatório.");
       }
   }
   ```

#### Configuração Docker

1. **Definições de Serviço**
   ```yaml
   services:
     web:
       build:
         context: .
         dockerfile: Dockerfile
       ports:
         - "8080:80"
     
     db:
       image: mysql:5.7
       environment:
         MYSQL_DATABASE: ${MYSQL_DATABASE}
         MYSQL_USER: ${MYSQL_USER}
   ```

2. **Configuração PHP**
   ```dockerfile
   FROM php:8.2-apache
   RUN docker-php-ext-install pdo pdo_mysql
   RUN a2enmod rewrite
   ```

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
