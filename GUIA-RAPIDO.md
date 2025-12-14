# ⚡ Guia Rápido de Instalação

## 🎯 3 Passos Simples

### 1. Importar Banco de Dados
```
1. Abra: http://localhost/phpmyadmin
2. Clique em "SQL"
3. Cole o conteúdo de: database/schema.sql
4. Clique "Executar"
5. Repita com: database/seed.sql
```

### 2. Criar Pasta de Uploads
```
Crie as pastas:
- public/uploads
- public/uploads/detran
```

### 3. Acessar o Sistema
```
Abra: http://localhost/instrutor44
```

## 🔑 Login de Teste

**Admin:**
- Email: `admin@instrutor44.com`
- Senha: `password`

**Instrutor:**
- Email: `joao.silva@email.com`
- Senha: `password`

**Aluno:**
- Email: `pedro.aluno@email.com`
- Senha: `password`

## ✅ Verificação

Se tudo estiver correto, você verá:
- ✅ Página inicial com menu de navegação
- ✅ Seção "Encontre o Instrutor de Direção Perfeito"
- ✅ Instrutores em destaque na homepage

## 🆘 Problemas?

**Erro 404:** Verifique se o Apache está rodando no XAMPP

**Erro de Banco:** Confirme que o MySQL está ativo e o banco foi criado

**Página em Branco:** Verifique os logs em `C:\xampp\apache\logs\error.log`

---

Para instruções detalhadas, consulte: **LEIA-ME.md**
