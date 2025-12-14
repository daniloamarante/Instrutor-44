<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Painel Administrativo</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 mb-1">Instrutores Ativos</p>
                    <p class="text-3xl font-bold text-blue-600"><?php echo $data['total_instructors']; ?></p>
                </div>
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-tie text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 mb-1">Pendentes Aprovação</p>
                    <p class="text-3xl font-bold text-yellow-600"><?php echo $data['pending_instructors']; ?></p>
                </div>
                <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 mb-1">Total de Alunos</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo $data['total_students']; ?></p>
                </div>
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 mb-1">Total de Aulas</p>
                    <p class="text-3xl font-bold text-purple-600"><?php echo $data['total_schedules']; ?></p>
                </div>
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-check text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <?php if(!empty($data['recent_schedules'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Agendamentos Recentes</h2>
            <div class="space-y-3">
                <?php foreach($data['recent_schedules'] as $schedule): ?>
                <div class="border-b pb-3 last:border-b-0">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold"><?php echo htmlspecialchars($schedule->student_name); ?> → <?php echo htmlspecialchars($schedule->instructor_name); ?></p>
                            <p class="text-sm text-gray-600"><?php echo date('d/m/Y H:i', strtotime($schedule->date_time)); ?></p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full
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
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if(!empty($data['pending_reviews'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Avaliações Pendentes</h2>
            <div class="space-y-3">
                <?php foreach($data['pending_reviews'] as $review): ?>
                <div class="border-b pb-3 last:border-b-0">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="font-semibold"><?php echo htmlspecialchars($review->instructor_name); ?></p>
                            <div class="flex items-center text-yellow-500 text-sm">
                                <?php for($i = 0; $i < 5; $i++): ?>
                                    <i class="fas fa-star<?php echo $i < $review->rating ? '' : '-o'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="text-sm text-gray-600 mt-1"><?php echo htmlspecialchars(substr($review->comment, 0, 50)); ?>...</p>
                        </div>
                        <div class="ml-4 space-x-2">
                            <a href="<?php echo URL_ROOT; ?>/admin/aprovarAvaliacao/<?php echo $review->id; ?>" 
                               class="text-green-600 hover:text-green-800">
                                <i class="fas fa-check"></i>
                            </a>
                            <a href="<?php echo URL_ROOT; ?>/admin/rejeitarAvaliacao/<?php echo $review->id; ?>" 
                               class="text-red-600 hover:text-red-800">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="<?php echo URL_ROOT; ?>/admin/instrutores?status=pendente" class="bg-yellow-600 text-white rounded-lg p-6 hover:bg-yellow-700 transition">
            <i class="fas fa-user-clock text-3xl mb-2"></i>
            <h3 class="text-xl font-bold mb-2">Aprovar Instrutores</h3>
            <p><?php echo $data['pending_instructors']; ?> pendentes</p>
        </a>
        
        <a href="<?php echo URL_ROOT; ?>/admin/instrutores" class="bg-blue-600 text-white rounded-lg p-6 hover:bg-blue-700 transition">
            <i class="fas fa-users text-3xl mb-2"></i>
            <h3 class="text-xl font-bold mb-2">Gerenciar Usuários</h3>
            <p>Instrutores e alunos</p>
        </a>
        
        <a href="<?php echo URL_ROOT; ?>/admin/relatorios" class="bg-green-600 text-white rounded-lg p-6 hover:bg-green-700 transition">
            <i class="fas fa-chart-bar text-3xl mb-2"></i>
            <h3 class="text-xl font-bold mb-2">Relatórios</h3>
            <p>Estatísticas da plataforma</p>
        </a>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
