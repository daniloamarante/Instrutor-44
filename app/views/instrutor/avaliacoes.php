<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Minhas Avaliações</h1>
        <div class="flex items-center mt-4">
            <div class="text-5xl font-bold text-yellow-500 mr-4"><?php echo number_format($data['instructor']->rating, 1); ?></div>
            <div>
                <div class="flex items-center text-yellow-500 mb-1">
                    <?php for($i = 0; $i < 5; $i++): ?>
                        <i class="fas fa-star<?php echo $i < floor($data['instructor']->rating) ? '' : '-o'; ?> text-2xl"></i>
                    <?php endfor; ?>
                </div>
                <p class="text-gray-600"><?php echo $data['instructor']->total_reviews; ?> avaliações</p>
            </div>
        </div>
    </div>
    
    <?php if(empty($data['reviews'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-star text-gray-400 text-6xl mb-4"></i>
            <p class="text-xl text-gray-600">Você ainda não tem avaliações</p>
        </div>
    <?php else: ?>
        <div class="space-y-6">
            <?php foreach($data['reviews'] as $review): ?>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-lg font-bold text-gray-600 mr-4 flex-shrink-0">
                        <?php echo strtoupper(substr($review->student_name, 0, 1)); ?>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($review->student_name); ?></h3>
                                <div class="flex items-center text-yellow-500">
                                    <?php for($i = 0; $i < 5; $i++): ?>
                                        <i class="fas fa-star<?php echo $i < $review->rating ? '' : '-o'; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500"><?php echo date('d/m/Y', strtotime($review->created_at)); ?></span>
                        </div>
                        <?php if(!empty($review->hygiene_vehicle) || !empty($review->service_quality) || !empty($review->punctuality) || !empty($review->vehicle_quality)): ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-700">
                            <div>
                                <span class="font-semibold">Higiene do veículo:</span>
                                <span class="ml-2 text-yellow-500">
                                    <?php for($i = 0; $i < 5; $i++): ?>
                                        <i class="fas fa-star<?php echo $i < ($review->hygiene_vehicle ?? 0) ? '' : '-o'; ?>"></i>
                                    <?php endfor; ?>
                                </span>
                            </div>
                            <div>
                                <span class="font-semibold">Atendimento:</span>
                                <span class="ml-2 text-yellow-500">
                                    <?php for($i = 0; $i < 5; $i++): ?>
                                        <i class="fas fa-star<?php echo $i < ($review->service_quality ?? 0) ? '' : '-o'; ?>"></i>
                                    <?php endfor; ?>
                                </span>
                            </div>
                            <div>
                                <span class="font-semibold">Pontualidade:</span>
                                <span class="ml-2 text-yellow-500">
                                    <?php for($i = 0; $i < 5; $i++): ?>
                                        <i class="fas fa-star<?php echo $i < ($review->punctuality ?? 0) ? '' : '-o'; ?>"></i>
                                    <?php endfor; ?>
                                </span>
                            </div>
                            <div>
                                <span class="font-semibold">Qualidade do veículo:</span>
                                <span class="ml-2 text-yellow-500">
                                    <?php for($i = 0; $i < 5; $i++): ?>
                                        <i class="fas fa-star<?php echo $i < ($review->vehicle_quality ?? 0) ? '' : '-o'; ?>"></i>
                                    <?php endfor; ?>
                                </span>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($review->comment): ?>
                        <p class="text-gray-700 mt-2"><?php echo nl2br(htmlspecialchars($review->comment)); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
