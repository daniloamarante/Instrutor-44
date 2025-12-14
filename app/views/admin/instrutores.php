<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Gerenciar Instrutores</h1>
        <div class="space-x-2">
            <a href="<?php echo URL_ROOT; ?>/admin/instrutores?status=pendente" 
               class="px-4 py-2 rounded-lg <?php echo $data['status'] == 'pendente' ? 'bg-yellow-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
                Pendentes
            </a>
            <a href="<?php echo URL_ROOT; ?>/admin/instrutores?status=aprovado" 
               class="px-4 py-2 rounded-lg <?php echo $data['status'] == 'aprovado' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
                Aprovados
            </a>
        </div>
    </div>
    
    <?php if(empty($data['instructors'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-user-tie text-gray-400 text-6xl mb-4"></i>
            <p class="text-xl text-gray-600">Nenhum instrutor encontrado</p>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instrutor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contato</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DETRAN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avaliação</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach($data['instructors'] as $instructor): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-sm font-bold text-gray-600 mr-3">
                                    <?php echo strtoupper(substr($instructor->name, 0, 1)); ?>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($instructor->name); ?></div>
                                    <div class="text-sm text-gray-500">R$ <?php echo number_format($instructor->price_per_hour, 2, ',', '.'); ?>/h</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($instructor->email); ?></div>
                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($instructor->phone); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($instructor->detran_number ?? 'N/A'); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="text-yellow-500 mr-1">★</span>
                                <span class="text-sm text-gray-900"><?php echo number_format($instructor->rating, 1); ?></span>
                                <span class="text-sm text-gray-500 ml-1">(<?php echo $instructor->total_reviews; ?>)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <?php if($data['status'] == 'pendente'): ?>
                                <a href="<?php echo URL_ROOT; ?>/admin/aprovarInstrutor/<?php echo $instructor->id; ?>" 
                                   class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-check"></i> Aprovar
                                </a>
                                <a href="<?php echo URL_ROOT; ?>/admin/rejeitarInstrutor/<?php echo $instructor->id; ?>" 
                                   class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-times"></i> Rejeitar
                                </a>
                            <?php else: ?>
                                <span class="text-green-600"><i class="fas fa-check-circle"></i> Aprovado</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
