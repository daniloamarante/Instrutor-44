<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Gerenciar Planos</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach($data['plans'] as $plan): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($plan->name); ?></h3>
            <p class="text-3xl font-bold text-blue-600 mb-4">R$ <?php echo number_format($plan->price, 2, ',', '.'); ?></p>
            <p class="text-gray-600"><?php echo htmlspecialchars($plan->description); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
