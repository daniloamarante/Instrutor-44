<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Buscar Instrutores</h1>
    
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <form method="GET" action="<?php echo URL_ROOT; ?>/aluno/buscar" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Latitude</label>
                    <input type="text" name="lat" value="<?php echo $data['filters']['lat'] ?? ''; ?>" 
                           class="w-full px-4 py-2 border rounded-lg" placeholder="-23.550520">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Longitude</label>
                    <input type="text" name="lng" value="<?php echo $data['filters']['lng'] ?? ''; ?>" 
                           class="w-full px-4 py-2 border rounded-lg" placeholder="-46.633308">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Distância (km)</label>
                    <select name="distance" class="w-full px-4 py-2 border rounded-lg">
                        <option value="10">10 km</option>
                        <option value="25">25 km</option>
                        <option value="50" selected>50 km</option>
                        <option value="100">100 km</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Preço Máximo</label>
                    <input type="number" name="max_price" value="<?php echo $data['filters']['max_price'] ?? ''; ?>" 
                           class="w-full px-4 py-2 border rounded-lg" placeholder="150">
                </div>
            </div>
            
            <div class="flex justify-between items-center">
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="min_rating" value="4" class="mr-2">
                        <span>Apenas 4+ estrelas</span>
                    </label>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-search mr-2"></i>Buscar
                </button>
            </div>
        </form>
    </div>
    
    <?php if(empty($data['instructors'])): ?>
        <div class="text-center py-12">
            <i class="fas fa-search text-gray-400 text-6xl mb-4"></i>
            <p class="text-xl text-gray-600">Nenhum instrutor encontrado</p>
            <p class="text-gray-500">Tente ajustar os filtros de busca</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach($data['instructors'] as $instructor): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center text-2xl font-bold text-gray-600">
                            <?php echo strtoupper(substr($instructor->name, 0, 1)); ?>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold"><?php echo htmlspecialchars($instructor->name); ?></h3>
                            <div class="flex items-center text-yellow-500">
                                <?php for($i = 0; $i < 5; $i++): ?>
                                    <i class="fas fa-star<?php echo $i < floor($instructor->rating) ? '' : '-o'; ?>"></i>
                                <?php endfor; ?>
                                <span class="ml-2 text-gray-600"><?php echo number_format($instructor->rating, 1); ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-4"><?php echo htmlspecialchars(substr($instructor->bio ?? 'Instrutor experiente', 0, 100)); ?>...</p>
                    
                    <div class="space-y-2 mb-4 text-sm text-gray-600">
                        <p><i class="fas fa-map-marker-alt mr-2"></i><?php echo htmlspecialchars($instructor->location_address); ?></p>
                        <?php if(isset($instructor->distance)): ?>
                        <p><i class="fas fa-route mr-2"></i><?php echo number_format($instructor->distance, 1); ?> km de distância</p>
                        <?php endif; ?>
                        <p><i class="fas fa-car mr-2"></i><?php echo htmlspecialchars($instructor->vehicle_info ?? 'Veículo disponível'); ?></p>
                        <p><i class="fas fa-award mr-2"></i><?php echo $instructor->experience_years; ?> anos de experiência</p>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-blue-600">R$ <?php echo number_format($instructor->price_per_hour, 2, ',', '.'); ?>/h</span>
                        <a href="<?php echo URL_ROOT; ?>/aluno/instrutor/<?php echo $instructor->id; ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Ver Perfil</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
