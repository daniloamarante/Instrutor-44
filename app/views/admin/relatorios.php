<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Relatórios</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <p class="text-gray-600 mb-2">Total de Usuários</p>
            <p class="text-4xl font-bold text-blue-600"><?php echo $data['total_users']; ?></p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <p class="text-gray-600 mb-2">Instrutores</p>
            <p class="text-4xl font-bold text-green-600"><?php echo $data['total_instructors']; ?></p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <p class="text-gray-600 mb-2">Alunos</p>
            <p class="text-4xl font-bold text-yellow-600"><?php echo $data['total_students']; ?></p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <p class="text-gray-600 mb-2">Total de Aulas</p>
            <p class="text-4xl font-bold text-purple-600"><?php echo $data['total_schedules']; ?></p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
