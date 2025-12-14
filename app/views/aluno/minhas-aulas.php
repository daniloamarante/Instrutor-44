<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Minhas Aulas</h1>
    
    <?php if(empty($data['schedules'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-calendar-times text-gray-400 text-6xl mb-4"></i>
            <p class="text-xl text-gray-600 mb-4">Você ainda não tem aulas agendadas</p>
            <a href="<?php echo URL_ROOT; ?>/aluno/buscar" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                <i class="fas fa-search mr-2"></i>Buscar Instrutores
            </a>
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach($data['schedules'] as $schedule): ?>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center mb-4">
                            <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center text-xl font-bold text-gray-600 mr-4">
                                <?php echo strtoupper(substr($schedule->instructor_name, 0, 1)); ?>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold"><?php echo htmlspecialchars($schedule->instructor_name); ?></h3>
                                <p class="text-gray-600"><?php echo htmlspecialchars($schedule->instructor_phone); ?></p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                            <div>
                                <p class="mb-2"><i class="fas fa-calendar mr-2 text-blue-600"></i><strong>Data:</strong> <?php echo date('d/m/Y', strtotime($schedule->date_time)); ?></p>
                                <p class="mb-2"><i class="fas fa-clock mr-2 text-blue-600"></i><strong>Horário:</strong> <?php echo date('H:i', strtotime($schedule->date_time)); ?></p>
                            </div>
                            <div>
                                <p class="mb-2"><i class="fas fa-hourglass-half mr-2 text-blue-600"></i><strong>Duração:</strong> <?php echo $schedule->duration; ?> minutos</p>
                                <p class="mb-2"><i class="fas fa-dollar-sign mr-2 text-blue-600"></i><strong>Valor:</strong> R$ <?php echo number_format($schedule->price, 2, ',', '.'); ?></p>
                            </div>
                        </div>
                        
                        <p class="mt-4 text-gray-700"><i class="fas fa-map-marker-alt mr-2 text-blue-600"></i><?php echo htmlspecialchars($schedule->location_address); ?></p>
                        
                        <?php if($schedule->notes): ?>
                        <div class="mt-4 bg-gray-50 p-3 rounded">
                            <p class="text-sm text-gray-600"><strong>Observações:</strong> <?php echo nl2br(htmlspecialchars($schedule->notes)); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="text-right ml-6">
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold mb-4
                            <?php 
                                switch($schedule->status) {
                                    case 'confirmado': echo 'bg-green-100 text-green-800'; break;
                                    case 'pendente': echo 'bg-yellow-100 text-yellow-800'; break;
                                    case 'cancelado': echo 'bg-red-100 text-red-800'; break;
                                    case 'concluido': echo 'bg-blue-100 text-blue-800'; break;
                                }
                            ?>">
                            <?php echo ucfirst($schedule->status); ?>
                        </span>
                        
                        <?php if($schedule->status == 'pendente' || $schedule->status == 'confirmado'): ?>
                        <a href="<?php echo URL_ROOT; ?>/aluno/cancelarAula/<?php echo $schedule->id; ?>" 
                           class="block bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 text-center"
                           onclick="return confirm('Tem certeza que deseja cancelar esta aula?')">
                            Cancelar Aula
                        </a>
                        <?php endif; ?>
                        
                        <?php if($schedule->status == 'concluido'): ?>
                        <a href="<?php echo URL_ROOT; ?>/home/instrutor/<?php echo $schedule->instructor_id; ?>" 
                           class="block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-center">
                            Avaliar Instrutor
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
