# 🚗 Encontre Instrutor - Marketplace de Aulas de Direção

Plataforma completa em PHP MVC + Tailwind CSS que conecta alunos com instrutores de direção independentes autorizados pelo DETRAN.

## 🚀 Tecnologias Utilizadas

- **Backend:** PHP 8+ com arquitetura MVC pura
- **Frontend:** Tailwind CSS + HTML5 + JavaScript vanilla
- **Banco de Dados:** MySQL
- **Recursos:** Geolocalização, Upload de documentos, Sistema de avaliações

## 📋 Requisitos do Sistema

- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- Apache com mod_rewrite habilitado
- XAMPP, WAMP ou servidor similar

## 🔧 Instalação Passo a Passo

### 1️⃣ Preparar o Banco de Dados

**Opção A - Via phpMyAdmin:**
1. Abra o navegador e acesse: `http://localhost/phpmyadmin`
2. Clique em "SQL" no menu superior
3. Abra o arquivo `database/schema.sql` em um editor de texto
4. Copie todo o conteúdo e cole na área SQL do phpMyAdmin
5. Clique em "Executar"
6. Repita o processo com o arquivo `database/seed.sql`

**Opção B - Via linha de comando:**
```bash
mysql -u root -p < database/schema.sql
mysql -u root -p < database/seed.sql
```

### 2️⃣ Criar Pasta de Uploads

Crie as pastas necessárias para upload de documentos:

**No Windows:**
1. Navegue até `C:\xampp\htdocs\instrutor44\public`
2. Crie uma pasta chamada `uploads`
3. Dentro de `uploads`, crie uma pasta chamada `detran`

**Via linha de comando:**
```bash
mkdir public\uploads
mkdir public\uploads\detran
```

### 3️⃣ Configurar o Sistema (Opcional)

Se necessário, edite o arquivo `config/config.php` para ajustar as credenciais do banco:

```php
define('DB_HOST', 'localhost');    // Host do MySQL
define('DB_USER', 'root');         // Usuário do MySQL
define('DB_PASS', '');             // Senha do MySQL (vazio por padrão no XAMPP)
define('DB_NAME', 'instrutor44');  // Nome do banco de dados
```

### 4️⃣ Iniciar o Servidor

1. Abra o Painel de Controle do XAMPP
2. Inicie o **Apache** (botão Start)
3. Inicie o **MySQL** (botão Start)
4. Aguarde até que ambos fiquem com fundo verde

### 5️⃣ Acessar a Aplicação

Abra seu navegador e acesse:
```
http://localhost/instrutor44
```

Você deverá ver a página inicial com o título "Encontre o Instrutor de Direção Perfeito"

## 👥 Usuários de Teste

O sistema já vem com usuários pré-cadastrados para teste:

### 🔐 Administrador
- **Email:** admin@instrutor44.com
- **Senha:** password
- **Acesso:** Painel administrativo completo

### 👨‍🏫 Instrutor Aprovado
- **Email:** joao.silva@email.com
- **Senha:** password
- **Acesso:** Dashboard do instrutor, gestão de aulas

### 🎓 Aluno
- **Email:** pedro.aluno@email.com
- **Senha:** password
- **Acesso:** Busca de instrutores, agendamento de aulas

## 📱 Funcionalidades por Tipo de Usuário

### Para Alunos 🎓
- ✅ Buscar instrutores por localização
- ✅ Filtrar por preço, distância e avaliações
- ✅ Ver perfil completo dos instrutores
- ✅ Agendar aulas com data e horário
- ✅ Gerenciar suas aulas agendadas
- ✅ Avaliar instrutores após as aulas
- ✅ Editar seu perfil

### Para Instrutores 👨‍🏫
- ✅ Criar e editar perfil profissional
- ✅ Fazer upload de documentos do DETRAN
- ✅ Definir preço por hora
- ✅ Aceitar ou rejeitar solicitações de aula
- ✅ Gerenciar agenda de aulas
- ✅ Ver lista de alunos
- ✅ Visualizar avaliações recebidas
- ✅ Dashboard com estatísticas

### Para Administradores 👔
- ✅ Aprovar/rejeitar cadastro de instrutores
- ✅ Verificar documentos do DETRAN
- ✅ Gerenciar todos os usuários
- ✅ Visualizar todos os agendamentos
- ✅ Moderar avaliações
- ✅ Gerenciar planos de assinatura
- ✅ Visualizar relatórios e estatísticas

## 🗺️ Navegação do Sistema

### Páginas Públicas (sem login)
- **/** - Página inicial
- **/planos** - Planos e preços para instrutores
- **/para-instrutores** - Informações para instrutores
- **/auth/login** - Página de login
- **/auth/register** - Cadastro de novos usuários

### Área do Aluno
- **/aluno/dashboard** - Painel principal
- **/aluno/buscar** - Buscar instrutores
- **/aluno/instrutor/[id]** - Ver perfil do instrutor
- **/aluno/minhas-aulas** - Minhas aulas agendadas
- **/aluno/perfil** - Editar meu perfil

### Área do Instrutor
- **/instrutor/dashboard** - Painel principal
- **/instrutor/perfil** - Editar perfil profissional
- **/instrutor/agenda** - Gerenciar agenda
- **/instrutor/alunos** - Lista de alunos
- **/instrutor/avaliacoes** - Minhas avaliações

### Área Administrativa
- **/admin/dashboard** - Painel administrativo
- **/admin/instrutores** - Gerenciar instrutores
- **/admin/alunos** - Gerenciar alunos
- **/admin/agendamentos** - Ver todos os agendamentos
- **/admin/avaliacoes** - Moderar avaliações
- **/admin/planos** - Gerenciar planos
- **/admin/relatorios** - Relatórios do sistema

## 🗄️ Estrutura do Banco de Dados

O sistema utiliza 9 tabelas principais:

1. **users** - Usuários do sistema (alunos, instrutores, admin)
2. **instructors** - Dados específicos dos instrutores
3. **students** - Dados específicos dos alunos
4. **schedules** - Agendamentos de aulas
5. **reviews** - Avaliações dos instrutores
6. **plans** - Planos de assinatura
7. **plan_subscriptions** - Assinaturas ativas
8. **availability** - Disponibilidade de horários
9. **notifications** - Sistema de notificações

## 🐛 Solução de Problemas

### Erro 404 em todas as páginas
**Problema:** Ao acessar qualquer página, aparece erro 404.

**Solução:**
1. Verifique se o arquivo `.htaccess` existe na raiz do projeto
2. Verifique se o arquivo `.htaccess` existe em `public/`
3. No XAMPP, edite `C:\xampp\apache\conf\httpd.conf`
4. Procure por `AllowOverride None` e mude para `AllowOverride All`
5. Reinicie o Apache

### Erro de conexão com banco de dados
**Problema:** "Connection failed" ou erro de conexão.

**Solução:**
1. Verifique se o MySQL está rodando no XAMPP
2. Confirme as credenciais em `config/config.php`
3. Verifique se o banco `instrutor44` foi criado
4. Tente acessar o phpMyAdmin para confirmar que o MySQL funciona

### Página em branco
**Problema:** A página carrega em branco sem erros.

**Solução:**
1. Ative a exibição de erros no PHP
2. Edite `C:\xampp\php\php.ini`
3. Procure por `display_errors` e mude para `On`
4. Reinicie o Apache
5. Verifique os logs em `C:\xampp\apache\logs\error.log`

### Upload de documentos não funciona
**Problema:** Erro ao fazer upload de documentos DETRAN.

**Solução:**
1. Verifique se a pasta `public/uploads/detran` existe
2. Dê permissão de escrita na pasta (botão direito > Propriedades > Segurança)
3. Verifique o tamanho máximo de upload em `php.ini`:
   - `upload_max_filesize = 10M`
   - `post_max_size = 10M`

### Imagens/CSS não carregam
**Problema:** A página aparece sem estilo.

**Solução:**
1. Verifique se está acessando via `http://localhost/instrutor44`
2. Não acesse diretamente pelo caminho do arquivo
3. Limpe o cache do navegador (Ctrl + Shift + Delete)

## 📁 Estrutura de Pastas

```
instrutor44/
├── app/
│   ├── controllers/      # Controladores (lógica de negócio)
│   ├── models/           # Modelos (acesso ao banco)
│   ├── views/            # Views (interface HTML)
│   └── core/             # Classes principais do framework
├── config/               # Configurações do sistema
├── database/             # Scripts SQL
├── public/               # Arquivos públicos
│   ├── css/             # Estilos customizados
│   ├── uploads/         # Arquivos enviados
│   └── index.php        # Ponto de entrada
├── .htaccess            # Configuração Apache
└── README.md            # Documentação
```

## 🔒 Segurança

- ✅ Senhas criptografadas com bcrypt
- ✅ Proteção contra SQL Injection (PDO preparado)
- ✅ Validação de dados no servidor
- ✅ Controle de acesso por roles (aluno/instrutor/admin)
- ✅ Sanitização de inputs
- ✅ Proteção de rotas privadas

## 🎨 Design e Interface

- Design moderno e responsivo
- Compatível com dispositivos móveis
- Cores baseadas no padrão DETRAN (azul)
- Ícones Font Awesome
- Tailwind CSS para estilização
- Notificações de sucesso/erro
- Cards e badges informativos

## 📞 Suporte e Contato

Para dúvidas, problemas ou sugestões:
- **Email:** contato@encontreinstrutor.com
- **Documentação:** Consulte os arquivos README.md e ESTRUTURA.md

## 📄 Licença

Este projeto é de código aberto para fins educacionais e de demonstração.

---

**Desenvolvido com ❤️ usando PHP MVC + Tailwind CSS**
