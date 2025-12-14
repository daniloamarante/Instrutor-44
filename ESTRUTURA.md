# 📂 Estrutura Completa do Projeto

## Arquivos Criados

### 🔧 Configuração e Core
- `/.htaccess` - Redirecionamento para pasta public
- `/public/.htaccess` - Rotas amigáveis
- `/public/index.php` - Entry point da aplicação
- `/config/config.php` - Configurações do sistema
- `/app/core/Database.php` - Classe de conexão PDO
- `/app/core/Controller.php` - Controlador base
- `/app/core/Model.php` - Model base
- `/app/core/Router.php` - Sistema de rotas

### 📊 Banco de Dados
- `/database/schema.sql` - Estrutura completa (11 tabelas)
- `/database/seed.sql` - Dados de exemplo

### 🎮 Controllers (5)
- `AuthController.php` - Login, registro, logout
- `HomeController.php` - Páginas públicas
- `AlunoController.php` - Área do aluno
- `InstrutorController.php` - Área do instrutor
- `AdminController.php` - Painel administrativo

### 🚨 Emergência (1)
- `EmergenciaController.php` - Acionamento de emergência e atualização de localização

###  Models (8)
- `User.php` - Gerenciamento de usuários
- `Student.php` - Dados dos alunos
- `Instructor.php` - Dados dos instrutores
- `Schedule.php` - Agendamentos
- `Review.php` - Avaliações
- `Plan.php` - Planos de assinatura
- `EmergencyAlert.php` - Alertas de emergência
- `EmergencyAlertLocation.php` - Histórico de localizações do alerta

### 🎨 Views (29 arquivos)

#### Layouts
- `layouts/header.php` - Cabeçalho com navegação
- `layouts/footer.php` - Rodapé
- `layouts/mobile-bottom-nav.php` - Navegação inferior (mobile) para aluno/instrutor
- `layouts/seo-meta.php` - Meta tags SEO dinâmicas (title/description/canonical/OG)

#### Components
- `components/emergency-sos.php` - Botão SOS flutuante (mobile) com confirmação por double-tap
- `components/schema-jsonld.php` - Schema.org JSON-LD (por página)

#### Públicas (4)
- `home/index.php` - Homepage
- `home/planos.php` - Página de planos
- `home/para-instrutores.php` - Landing page instrutores
- `auth/login.php` - Tela de login
- `auth/register.php` - Cadastro

#### Área do Aluno (5)
- `aluno/dashboard.php` - Dashboard do aluno
- `aluno/buscar.php` - Busca de instrutores
- `aluno/instrutor.php` - Perfil do instrutor + agendamento
- `aluno/minhas-aulas.php` - Lista de aulas
- `aluno/perfil.php` - Editar perfil
- `aluno/avaliar.php` - Avaliação do instrutor (critérios)

#### Área do Instrutor (5)
- `instrutor/dashboard.php` - Dashboard do instrutor
- `instrutor/perfil.php` - Editar perfil profissional
- `instrutor/agenda.php` - Gerenciar agenda
- `instrutor/alunos.php` - Lista de alunos
- `instrutor/avaliacoes.php` - Avaliações recebidas

#### Área Admin (6)
- `admin/dashboard.php` - Dashboard administrativo
- `admin/instrutores.php` - Gerenciar instrutores
- `admin/alunos.php` - Gerenciar alunos
- `admin/agendamentos.php` - Todos os agendamentos
- `admin/avaliacoes.php` - Moderar avaliações
- `admin/planos.php` - Gerenciar planos
- `admin/relatorios.php` - Relatórios e estatísticas
- `admin/emergencias.php` - Monitoramento de emergências (localização)

### 📄 Documentação
- `README.md` - Documentação principal
- `INSTALACAO.md` - Guia de instalação
- `ESTRUTURA.md` - Este arquivo

### 🎨 Assets
- `/public/css/custom.css` - Estilos customizados

### 📄 SEO / PWA (public)
- `/public/robots.txt` - Regras para crawlers + link do sitemap
- `/public/sitemap.xml` - Sitemap (rotas principais)
- `/public/manifest.json` - Manifest PWA
- `/public/service-worker.js` - Service worker (cache básico)

## 🗄️ Estrutura do Banco de Dados

### Tabelas (11)
1. **users** - Usuários do sistema (alunos, instrutores, admin)
2. **instructors** - Dados específicos dos instrutores
3. **students** - Dados específicos dos alunos
4. **schedules** - Agendamentos de aulas
5. **reviews** - Avaliações dos instrutores
6. **plans** - Planos de assinatura
7. **plan_subscriptions** - Assinaturas dos instrutores
8. **availability** - Disponibilidade de horários
9. **notifications** - Sistema de notificações
10. **emergency_alerts** - Alertas de emergência (status + última localização)
11. **emergency_alert_locations** - Histórico de localizações do alerta

## 🔐 Roles e Permissões

### Aluno
- Buscar instrutores
- Agendar aulas
- Avaliar instrutores
- Gerenciar perfil

### Instrutor
- Gerenciar perfil profissional
- Aceitar/rejeitar agendamentos
- Visualizar alunos
- Ver avaliações

### Admin
- Aprovar instrutores
- Gerenciar usuários
- Moderar avaliações
- Ver relatórios

## 🎯 Funcionalidades Implementadas

✅ Sistema de autenticação completo
✅ Busca geolocalizada de instrutores
✅ Sistema de agendamento
✅ Sistema de avaliações
✅ Avaliações com critérios (higiene, atendimento, pontualidade, qualidade do veículo)
✅ Dashboard para cada tipo de usuário
✅ Aprovação manual de instrutores
✅ Gestão de planos
✅ Upload de documentos DETRAN
✅ Design responsivo com Tailwind CSS
✅ Notificações de sucesso/erro
✅ Proteção de rotas por role

✅ Mobile-first (UX)
- Bottom navigation (mobile) para aluno/instrutor
- Botão flutuante SOS (mobile) com confirmação por double-tap

✅ Sistema de Emergência
- Botão global de emergência para aluno/instrutor
- Captura de localização via Geolocation API (web)
- Atualização periódica de localização (atual: 1 minuto)
- Painel admin para acompanhar alertas abertos, ver Maps e acionar contatos
- Ações rápidas no admin: copiar coordenadas, copiar link do Maps, copiar texto completo do alerta

✅ SEO técnico (base)
- Meta tags dinâmicas (title template, description, canonical, robots)
- OpenGraph + Twitter cards
- Schema.org JSON-LD (base)

✅ PWA (básico)
- Manifest + Service Worker

## 📱 Páginas e Rotas

### Públicas
- `/` - Homepage
- `/planos` - Planos e preços
- `/para-instrutores` - Para instrutores
- `/home/instrutor/{id}` - Perfil público do instrutor
- `/auth/login` - Login
- `/auth/register` - Cadastro

### Aluno
- `/aluno/dashboard` - Dashboard
- `/aluno/buscar` - Buscar instrutores
- `/aluno/instrutor/{id}` - Ver perfil do instrutor
- `/aluno/minhas-aulas` - Minhas aulas
- `/aluno/perfil` - Meu perfil
- `/aluno/avaliar/{instructor_id}` - Avaliar instrutor

### Instrutor
- `/instrutor/dashboard` - Dashboard
- `/instrutor/perfil` - Editar perfil
- `/instrutor/agenda` - Minha agenda
- `/instrutor/alunos` - Meus alunos
- `/instrutor/avaliacoes` - Minhas avaliações

### Admin
- `/admin/dashboard` - Dashboard
- `/admin/instrutores` - Gerenciar instrutores
- `/admin/alunos` - Gerenciar alunos
- `/admin/agendamentos` - Agendamentos
- `/admin/avaliacoes` - Moderar avaliações
- `/admin/planos` - Gerenciar planos
- `/admin/relatorios` - Relatórios

### Emergência
- `/emergencia/acionar` - Cria alerta de emergência (JSON)
- `/emergencia/atualizar/{alert_id}` - Atualiza localização e salva histórico (JSON)

### Admin (Emergência)
- `/admin/emergencias` - Tela de emergências
- `/admin/emergencias-count` - Contagem de emergências abertas (JSON)
- `/admin/emergencias-open` - Listagem/atualização de emergências abertas (JSON)
- `/admin/encerrarEmergencia/{id}` - Encerrar emergência

## 🧩 Observações sobre Emergência (Web)

- O rastreamento de localização depende da permissão do navegador e normalmente funciona enquanto a página estiver aberta.
- Intervalo atual de atualização (envio/polling): **1 minuto**.

## 🚀 Pronto para Uso!

O sistema está 100% funcional e pronto para ser testado.
