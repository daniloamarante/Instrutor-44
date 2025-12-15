<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Meus Alunos</h1>
    
    <?php if(empty($data['students'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-users text-gray-400 text-6xl mb-4"></i>
            <p class="text-xl text-gray-600">Você ainda não tem alunos</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($data['students'] as $student): ?>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center text-2xl font-bold text-gray-600 mr-4">
                        <?php echo strtoupper(substr($student['name'], 0, 1)); ?>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold"><?php echo htmlspecialchars($student['name']); ?></h3>
                        <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($student['phone']); ?></p>
                    </div>
                </div>
                
                <div class="space-y-2 text-gray-700">
                    <div class="flex justify-between">
                        <span>Total de Aulas:</span>
                        <span class="font-semibold"><?php echo $student['total_classes']; ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Aulas Concluídas:</span>
                        <span class="font-semibold text-green-600"><?php echo $student['completed_classes']; ?></span>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-2">
                    <a href="tel:<?php echo preg_replace('/\D+/', '', (string)($student['phone'] ?? '')); ?>" class="bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 text-center text-sm">
                        <i class="fas fa-phone mr-2"></i>Telefone
                    </a>
                    <a href="mailto:<?php echo htmlspecialchars($student['email'] ?? ''); ?>" class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 text-center text-sm">
                        <i class="fas fa-envelope mr-2"></i>E-mail
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
