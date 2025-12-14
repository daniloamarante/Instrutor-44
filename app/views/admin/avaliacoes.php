<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Moderar Avaliações</h1>
    
    <?php if(empty($data['reviews'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <p class="text-xl text-gray-600">Nenhuma avaliação encontrada</p>
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach($data['reviews'] as $review): ?>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <p class="font-semibold"><?php echo htmlspecialchars($review->student_name); ?> → <?php echo htmlspecialchars($review->instructor_name); ?></p>
                <?php if(!empty($review->hygiene_vehicle) || !empty($review->service_quality) || !empty($review->punctuality) || !empty($review->vehicle_quality)): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-gray-700 mt-2">
                        <div><span class="font-semibold">Higiene do veículo:</span> <?php echo (int)($review->hygiene_vehicle ?? 0); ?>/5</div>
                        <div><span class="font-semibold">Atendimento:</span> <?php echo (int)($review->service_quality ?? 0); ?>/5</div>
                        <div><span class="font-semibold">Pontualidade:</span> <?php echo (int)($review->punctuality ?? 0); ?>/5</div>
                        <div><span class="font-semibold">Qualidade do veículo:</span> <?php echo (int)($review->vehicle_quality ?? 0); ?>/5</div>
                    </div>
                <?php endif; ?>
                <p><?php echo htmlspecialchars($review->comment); ?></p>
                <?php if($data['status'] == 'pendente'): ?>
                <a href="<?php echo URL_ROOT; ?>/admin/aprovarAvaliacao/<?php echo $review->id; ?>" class="bg-green-600 text-white px-4 py-2 rounded">Aprovar</a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
