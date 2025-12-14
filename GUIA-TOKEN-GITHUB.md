# 🔑 Como Criar Token do GitHub e Subir o Projeto

## Passo 1: Criar Token de Acesso Pessoal

### 1.1 Acessar Configurações do GitHub

1. Faça login no GitHub: https://github.com
2. Clique na sua **foto de perfil** (canto superior direito)
3. Clique em **"Settings"** (Configurações)
4. No menu lateral esquerdo, role até o final e clique em **"Developer settings"**
5. Clique em **"Personal access tokens"**
6. Clique em **"Tokens (classic)"**

### 1.2 Gerar Novo Token

1. Clique no botão **"Generate new token"** → **"Generate new token (classic)"**
2. Pode pedir sua senha - digite e confirme

### 1.3 Configurar o Token

Preencha os campos:

**Note (Nome do token):**
```
Token Instrutor44 - Upload Projeto
```

**Expiration (Validade):**
- Selecione: **"No expiration"** (sem expiração) ou **"90 days"**

**Select scopes (Permissões):**
Marque estas opções:
- ✅ **repo** (todas as sub-opções serão marcadas automaticamente)
- ✅ **workflow** (se aparecer)

### 1.4 Gerar e Copiar o Token

1. Role até o final e clique em **"Generate token"**
2. **IMPORTANTE:** Você verá um token que começa com `ghp_...`
3. **COPIE ESTE TOKEN IMEDIATAMENTE** e salve em um lugar seguro
4. ⚠️ **Você só verá este token UMA VEZ!** Se perder, terá que criar outro

**Exemplo de token:**
```
ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

---

## Passo 2: Preparar o Projeto

### 2.1 Verificar Arquivos Sensíveis

Certifique-se de que o arquivo `.gitignore` existe e contém:
```
config/config.php
public/uploads/*
!public/uploads/.gitkeep
```

### 2.2 Criar Pasta de Uploads Vazia

Certifique-se de que existe:
- `public/uploads/.gitkeep` (arquivo vazio)

---

## Passo 3: Usar GitHub CLI (Recomendado)

### 3.1 Baixar GitHub CLI

1. Acesse: https://cli.github.com/
2. Clique em **"Download for Windows"**
3. Instale o programa (é bem leve, ~15MB)
4. Após instalar, **reinicie o terminal/Windsurf**

### 3.2 Autenticar com o Token

Abra o terminal e execute:

```bash
gh auth login
```

Responda:
- **What account do you want to log into?** → GitHub.com
- **What is your preferred protocol?** → HTTPS
- **Authenticate Git with your GitHub credentials?** → Yes
- **How would you like to authenticate?** → Paste an authentication token
- **Paste your authentication token:** → Cole o token que você copiou

### 3.3 Verificar Autenticação

```bash
gh auth status
```

Deve mostrar que você está logado.

---

## Passo 4: Subir o Projeto

### 4.1 Navegar até a Pasta

```bash
cd C:\xampp\htdocs\instrutor44
```

### 4.2 Inicializar Repositório Local

```bash
gh repo clone daniloamarante/Instrutor-44 temp_repo
```

Se o repositório já existir no GitHub mas estiver vazio, pule para 4.3.

### 4.3 Conectar ao Repositório Remoto

```bash
# Adicionar remote
gh repo set-default daniloamarante/Instrutor-44
```

### 4.4 Fazer Upload dos Arquivos

**Opção A - Via GitHub CLI:**
```bash
# Adicionar todos os arquivos (respeitando .gitignore)
gh repo sync

# Ou usar comandos Git que o GitHub CLI já configurou:
git add .
git commit -m "Initial commit - Plataforma Instrutor 44"
git push
```

---

## Alternativa: Upload via Web com Token

Se não quiser instalar nada, use a API do GitHub:

### 1. Instalar GitHub Desktop (Mais Simples)

1. Baixe: https://desktop.github.com/
2. Instale e abra
3. Clique em **"Sign in to GitHub.com"**
4. Faça login normalmente (não precisa do token aqui)
5. Clique em **"File"** → **"Add local repository"**
6. Selecione: `C:\xampp\htdocs\instrutor44`
7. Clique em **"Publish repository"**
8. Desmarque **"Keep this code private"** se quiser público
9. Clique em **"Publish repository"**

**Pronto!** O GitHub Desktop vai fazer tudo automaticamente e respeitar o `.gitignore`.

---

## ✅ Verificação Final

Após o upload, acesse:
```
https://github.com/daniloamarante/Instrutor-44
```

Você deve ver:
- ✅ Todos os arquivos e pastas
- ✅ README.md aparecendo na página principal
- ✅ **NÃO deve ter** o arquivo `config/config.php`
- ✅ Pasta `public/uploads/` deve estar vazia (só com `.gitkeep`)

---

## 🔒 Segurança do Token

**NUNCA compartilhe seu token!** Ele dá acesso total aos seus repositórios.

Se você acidentalmente expor o token:
1. Vá em Settings → Developer settings → Personal access tokens
2. Encontre o token e clique em **"Delete"**
3. Gere um novo token

---

## 📞 Problemas Comuns

**"Repository not found":**
- Verifique se o repositório existe em: https://github.com/daniloamarante/Instrutor-44
- Certifique-se de que está logado na conta correta

**"Permission denied":**
- Verifique se o token tem permissão `repo` marcada
- Gere um novo token se necessário

**Arquivos sensíveis foram enviados:**
- Remova-os do GitHub imediatamente
- Use: Settings → Danger Zone → Delete this repository
- Crie novo repositório e suba novamente

---

## 🎯 Recomendação Final

**Use o GitHub Desktop** - é a forma mais simples:
- ✅ Interface gráfica amigável
- ✅ Não precisa de linha de comando
- ✅ Respeita automaticamente o `.gitignore`
- ✅ Faz login com sua conta (sem precisar token)
- ✅ Um clique para publicar

Download: https://desktop.github.com/
