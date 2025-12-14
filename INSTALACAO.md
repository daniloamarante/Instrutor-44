# 📦 Guia de Instalação - Encontre Instrutor

## Passo a Passo

### 1️⃣ Preparar o Ambiente

Certifique-se de que o XAMPP está instalado e rodando:
- Apache
- MySQL

### 2️⃣ Importar o Banco de Dados

1. Abra o phpMyAdmin: `http://localhost/phpmyadmin`
2. Clique em "Novo" para criar um banco de dados
3. Ou execute direto os arquivos SQL:

```sql
-- No phpMyAdmin, vá em SQL e execute:
-- Primeiro: database/schema.sql
-- Depois: database/seed.sql
```

### 3️⃣ Configurar Permissões

Certifique-se de que a pasta `public/uploads` tem permissão de escrita:

```bash
# No Windows, clique com botão direito na pasta > Propriedades > Segurança
# Dê permissão total para o usuário atual
```

### 4️⃣ Acessar a Aplicação

Abra seu navegador e acesse:
```
http://localhost/instrutor44
```

## ✅ Verificação

Se tudo estiver correto, você verá a homepage com:
- Menu de navegação
- Hero section
- Seção "Você Sabia?"
- Instrutores em destaque

## 🔑 Credenciais de Teste

| Tipo | Email | Senha |
|------|-------|-------|
| Admin | admin@instrutor44.com | password |
| Instrutor | joao.silva@email.com | password |
| Aluno | pedro.aluno@email.com | password |

## 🐛 Problemas Comuns

### Erro 404 em todas as páginas
- Verifique se o mod_rewrite está habilitado no Apache
- Verifique se os arquivos `.htaccess` estão presentes

### Erro de conexão com banco
- Verifique as credenciais em `config/config.php`
- Certifique-se de que o MySQL está rodando

### Página em branco
- Ative a exibição de erros no PHP
- Verifique os logs do Apache em `xampp/apache/logs/error.log`

## 📞 Suporte

Para mais ajuda, consulte o arquivo `README.md`
