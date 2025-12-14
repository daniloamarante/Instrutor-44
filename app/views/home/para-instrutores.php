<?php require_once '../app/views/layouts/header.php'; ?>

<div class="bg-gradient-to-r from-green-600 to-green-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-6">Seja um Instrutor Parceiro</h1>
            <p class="text-xl mb-8">Aumente sua visibilidade e conquiste mais alunos com nossa plataforma</p>
            <a href="<?php echo URL_ROOT; ?>/auth/register?tipo=instrutor" class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
                <i class="fas fa-user-plus mr-2"></i>Cadastre-se Gratuitamente
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-3xl font-bold text-center mb-12">Por Que Ser um Parceiro?</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="text-center">
            <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-green-600 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Mais Alunos</h3>
            <p class="text-gray-600">Conecte-se com centenas de alunos procurando instrutores na sua região</p>
        </div>
        
        <div class="text-center">
            <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calendar-alt text-green-600 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Gestão Simplificada</h3>
            <p class="text-gray-600">Gerencie sua agenda, alunos e pagamentos em um só lugar</p>
        </div>
        
        <div class="text-center">
            <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-chart-line text-green-600 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Aumente sua Renda</h3>
            <p class="text-gray-600">Maximize seus ganhos com mais aulas e melhor aproveitamento do tempo</p>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-lg p-8 mb-16">
        <h2 class="text-3xl font-bold mb-8 text-center">Como Funciona</h2>
        
        <div class="space-y-6">
            <div class="flex items-start">
                <div class="bg-green-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">1</div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Cadastre-se</h3>
                    <p class="text-gray-600">Crie sua conta e preencha seu perfil com suas informações e credenciais do DETRAN</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="bg-green-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">2</div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Aguarde Aprovação</h3>
                    <p class="text-gray-600">Nossa equipe verificará seus documentos do DETRAN em até 48 horas</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="bg-green-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">3</div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Configure seu Perfil</h3>
                    <p class="text-gray-600">Adicione fotos, defina seus preços, horários disponíveis e área de atendimento</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="bg-green-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">4</div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Receba Solicitações</h3>
                    <p class="text-gray-600">Alunos interessados enviarão solicitações de aula que você pode aceitar ou recusar</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="bg-green-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">5</div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Dê Aulas e Receba</h3>
                    <p class="text-gray-600">Ministre suas aulas e receba o pagamento diretamente dos alunos</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-blue-50 rounded-lg p-8 mb-16">
        <h2 class="text-3xl font-bold mb-8 text-center">Requisitos</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-2xl mr-4 mt-1"></i>
                <div>
                    <h3 class="font-semibold mb-1">Credenciamento DETRAN</h3>
                    <p class="text-gray-600">Documento válido de instrutor credenciado</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-2xl mr-4 mt-1"></i>
                <div>
                    <h3 class="font-semibold mb-1">Veículo Próprio</h3>
                    <p class="text-gray-600">Veículo em boas condições para aulas</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-2xl mr-4 mt-1"></i>
                <div>
                    <h3 class="font-semibold mb-1">Experiência</h3>
                    <p class="text-gray-600">Experiência comprovada como instrutor</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <i class="fas fa-check-circle text-green-600 text-2xl mr-4 mt-1"></i>
                <div>
                    <h3 class="font-semibold mb-1">Disponibilidade</h3>
                    <p class="text-gray-600">Horários flexíveis para atender alunos</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-center">
        <h2 class="text-3xl font-bold mb-6">Pronto para Começar?</h2>
        <p class="text-xl text-gray-600 mb-8">Cadastre-se agora e comece a receber solicitações de aula</p>
        <div class="space-x-4">
            <a href="<?php echo URL_ROOT; ?>/auth/register?tipo=instrutor" class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition inline-block">
                Cadastrar Agora
            </a>
            <a href="<?php echo URL_ROOT; ?>/planos" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition inline-block">
                Ver Planos
            </a>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
