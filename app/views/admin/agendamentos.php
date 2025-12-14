<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Todos os Agendamentos</h1>
    
    <?php if(empty($data['schedules'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-calendar-times text-gray-400 text-6xl mb-4"></i>
            <p class="text-xl text-gray-600">Nenhum agendamento encontrado</p>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aluno</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instrutor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data/Hora</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach($data['schedules'] as $schedule): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($schedule->student_name); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($schedule->instructor_name); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo date('d/m/Y', strtotime($schedule->date_time)); ?></div>
                            <div class="text-sm text-gray-500"><?php echo date('H:i', strtotime($schedule->date_time)); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            R$ <?php echo number_format($schedule->price, 2, ',', '.'); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
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
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
