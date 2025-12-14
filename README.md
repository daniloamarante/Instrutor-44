# Encontre Instrutor - Marketplace de Aulas de Direção

Plataforma completa em PHP MVC + Tailwind CSS que conecta alunos com instrutores de direção independentes autorizados pelo DETRAN.

## 🚀 Tecnologias

- **Backend:** PHP 8+ com arquitetura MVC pura
- **Frontend:** Tailwind CSS + HTML5 + JavaScript vanilla
- **Database:** MySQL
- **Outros:** Geolocalização, Upload de documentos

## 📋 Requisitos

- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- Apache com mod_rewrite habilitado
- XAMPP, WAMP ou similar

## 🔧 Instalação

### 1. Clone ou extraia o projeto

```bash
cd C:\xampp\htdocs\instrutor44
```

### 2. Configure o banco de dados

Abra o phpMyAdmin e execute os arquivos SQL na seguinte ordem:

```bash
database/schema.sql
database/seed.sql
```

### 3. Configure as credenciais

Edite o arquivo `config/config.php` se necessário:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'instrutor44');
```

### 4. Crie a pasta de uploads

```bash
mkdir public/uploads
mkdir public/uploads/detran
```

### 5. Acesse a aplicação

Abra seu navegador e acesse:
```
http://localhost/instrutor44
```

## 👥 Usuários de Teste

### Administrador
- **Email:** admin@instrutor44.com
- **Senha:** password

### Instrutor
- **Email:** joao.silva@email.com
- **Senha:** password

### Aluno
- **Email:** pedro.aluno@email.com
- **Senha:** password

## 📁 Estrutura do Projeto

```
instrutor44/
├── app/
│   ├── controllers/     # Controladores MVC
│   ├── models/          # Modelos de dados
│   ├── views/           # Views (HTML/PHP)
│   └── core/            # Classes principais (Router, Database, etc)
├── config/              # Configurações
├── database/            # Scripts SQL
├── public/              # Arquivos públicos (index.php, assets)
└── README.md
```

## 🎯 Funcionalidades

### Para Alunos
- Busca geolocalizada de instrutores
- Filtros por localização, preço e avaliações
- Agendamento de aulas
- Sistema de avaliações
- Histórico de aulas

### Para Instrutores
- Cadastro com documentos DETRAN
- Gestão de perfil e preços
- Gerenciamento de agenda
- Confirmação/rejeição de agendamentos
- Dashboard com estatísticas

### Para Administradores
- Dashboard administrativo
- Aprovação de instrutores
- Gestão de usuários
- Moderação de avaliações
- Relatórios e estatísticas

## 🔐 Segurança

- Senhas criptografadas com bcrypt
- Proteção contra SQL Injection (PDO)
- Validação de dados no servidor
- Controle de acesso por roles

## 📝 Licença

Este projeto é de código aberto para fins educacionais.

## 🤝 Suporte

Para dúvidas ou problemas, entre em contato através do email: contato@encontreinstrutor.com
