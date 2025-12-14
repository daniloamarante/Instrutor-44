<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Painel do Instrutor</h1>
        <p class="text-gray-600">Bem-vindo, <?php echo htmlspecialchars($data['instructor']->name); ?>!</p>
    </div>
    
    <?php if($data['instructor']->status == 'pendente'): ?>
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-8" role="alert">
        <p class="font-bold">Cadastro em Análise</p>
        <p>Seu cadastro está sendo analisado pela nossa equipe. Você será notificado assim que for aprovado.</p>
    </div>
    <?php elseif($data['instructor']->status == 'rejeitado'): ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8" role="alert">
        <p class="font-bold">Cadastro Rejeitado</p>
        <p>Infelizmente seu cadastro não foi aprovado. Entre em contato conosco para mais informações.</p>
    </div>
    <?php endif; ?>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 mb-1">Solicitações Pendentes</p>
                    <p class="text-3xl font-bold text-yellow-600"><?php echo count($data['pending_schedules']); ?></p>
                </div>
                <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 mb-1">Próximas Aulas</p>
                    <p class="text-3xl font-bold text-blue-600"><?php echo count($data['upcoming_schedules']); ?></p>
                </div>
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-check text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 mb-1">Total de Aulas</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo $data['total_schedules']; ?></p>
                </div>
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 mb-1">Avaliação</p>
                    <p class="text-3xl font-bold text-yellow-500"><?php echo number_format($data['instructor']->rating, 1); ?> ⭐</p>
                </div>
                <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center">
                    <i class="fas fa-star text-yellow-500 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <?php if(!empty($data['pending_schedules'])): ?>
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold mb-4">Solicitações Pendentes</h2>
        <div class="space-y-4">
            <?php foreach($data['pending_schedules'] as $schedule): ?>
            <div class="border rounded-lg p-4 hover:shadow-md transition">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($schedule->student_name); ?></h3>
                        <div class="space-y-1 text-gray-600">
                            <p><i class="fas fa-calendar mr-2"></i><?php echo date('d/m/Y', strtotime($schedule->date_time)); ?></p>
                            <p><i class="fas fa-clock mr-2"></i><?php echo date('H:i', strtotime($schedule->date_time)); ?> - <?php echo $schedule->duration; ?> minutos</p>
                            <p><i class="fas fa-map-marker-alt mr-2"></i><?php echo htmlspecialchars($schedule->location_address); ?></p>
                            <p><i class="fas fa-phone mr-2"></i><?php echo htmlspecialchars($schedule->student_phone); ?></p>
                        </div>
                        <?php if($schedule->notes): ?>
                        <div class="mt-2 bg-gray-50 p-2 rounded">
                            <p class="text-sm text-gray-600"><strong>Observações:</strong> <?php echo htmlspecialchars($schedule->notes); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="ml-6 space-y-2">
                        <a href="<?php echo URL_ROOT; ?>/instrutor/confirmarAula/<?php echo $schedule->id; ?>" 
                           class="block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-center">
                            <i class="fas fa-check mr-2"></i>Confirmar
                        </a>
                        <a href="<?php echo URL_ROOT; ?>/instrutor/rejeitarAula/<?php echo $schedule->id; ?>" 
                           class="block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-center">
                            <i class="fas fa-times mr-2"></i>Rejeitar
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if(!empty($data['upcoming_schedules'])): ?>
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold mb-4">Próximas Aulas</h2>
        <div class="space-y-4">
            <?php foreach($data['upcoming_schedules'] as $schedule): ?>
            <div class="border rounded-lg p-4">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($schedule->student_name); ?></h3>
                        <div class="space-y-1 text-gray-600">
                            <p><i class="fas fa-calendar mr-2"></i><?php echo date('d/m/Y', strtotime($schedule->date_time)); ?></p>
                            <p><i class="fas fa-clock mr-2"></i><?php echo date('H:i', strtotime($schedule->date_time)); ?></p>
                            <p><i class="fas fa-map-marker-alt mr-2"></i><?php echo htmlspecialchars($schedule->location_address); ?></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 mb-2">
                            Confirmado
                        </span>
                        <a href="<?php echo URL_ROOT; ?>/instrutor/concluirAula/<?php echo $schedule->id; ?>" 
                           class="block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-center text-sm">
                            Marcar como Concluída
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="<?php echo URL_ROOT; ?>/instrutor/perfil" class="bg-blue-600 text-white rounded-lg p-6 hover:bg-blue-700 transition">
            <i class="fas fa-user-edit text-3xl mb-2"></i>
            <h3 class="text-xl font-bold mb-2">Editar Perfil</h3>
            <p>Atualize suas informações e preços</p>
        </a>
        
        <a href="<?php echo URL_ROOT; ?>/instrutor/agenda" class="bg-green-600 text-white rounded-lg p-6 hover:bg-green-700 transition">
            <i class="fas fa-calendar-alt text-3xl mb-2"></i>
            <h3 class="text-xl font-bold mb-2">Minha Agenda</h3>
            <p>Veja todas as suas aulas</p>
        </a>
        
        <a href="<?php echo URL_ROOT; ?>/instrutor/avaliacoes" class="bg-yellow-600 text-white rounded-lg p-6 hover:bg-yellow-700 transition">
            <i class="fas fa-star text-3xl mb-2"></i>
            <h3 class="text-xl font-bold mb-2">Avaliações</h3>
            <p>Veja o que os alunos dizem</p>
        </a>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
