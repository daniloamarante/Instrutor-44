<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Bem-vindo, <?php echo htmlspecialchars($data['student']->name); ?>!</h1>
        <p class="text-gray-600">Gerencie suas aulas e encontre novos instrutores</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 mb-1">Aulas Confirmadas</p>
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
                    <p class="text-gray-600 mb-1">Aguardando Confirmação</p>
                    <p class="text-3xl font-bold text-yellow-600"><?php echo count($data['pending_schedules']); ?></p>
                </div>
                <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <a href="<?php echo URL_ROOT; ?>/aluno/buscar" class="block text-center">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-search text-green-600 text-2xl"></i>
                </div>
                <p class="font-semibold text-gray-800">Buscar Instrutores</p>
            </a>
        </div>
    </div>
    
    <?php if(!empty($data['upcoming_schedules'])): ?>
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold mb-4">Próximas Aulas</h2>
        <div class="space-y-4">
            <?php foreach($data['upcoming_schedules'] as $schedule): ?>
            <div class="border rounded-lg p-4 hover:shadow-md transition">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($schedule->instructor_name); ?></h3>
                        <div class="space-y-1 text-gray-600">
                            <p><i class="fas fa-calendar mr-2"></i><?php echo date('d/m/Y', strtotime($schedule->date_time)); ?></p>
                            <p><i class="fas fa-clock mr-2"></i><?php echo date('H:i', strtotime($schedule->date_time)); ?></p>
                            <p><i class="fas fa-map-marker-alt mr-2"></i><?php echo htmlspecialchars($schedule->location_address); ?></p>
                            <p><i class="fas fa-dollar-sign mr-2"></i>R$ <?php echo number_format($schedule->price, 2, ',', '.'); ?></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold <?php echo $schedule->status == 'confirmado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                            <?php echo ucfirst($schedule->status); ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="<?php echo URL_ROOT; ?>/aluno/buscar" class="bg-blue-600 text-white rounded-lg p-6 hover:bg-blue-700 transition">
            <i class="fas fa-search text-3xl mb-2"></i>
            <h3 class="text-xl font-bold mb-2">Buscar Instrutores</h3>
            <p>Encontre instrutores perto de você</p>
        </a>
        
        <a href="<?php echo URL_ROOT; ?>/aluno/minhas-aulas" class="bg-green-600 text-white rounded-lg p-6 hover:bg-green-700 transition">
            <i class="fas fa-list text-3xl mb-2"></i>
            <h3 class="text-xl font-bold mb-2">Minhas Aulas</h3>
            <p>Veja todas as suas aulas agendadas</p>
        </a>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
