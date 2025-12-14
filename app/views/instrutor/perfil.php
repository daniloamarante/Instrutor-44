<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Editar Perfil</h1>
    
    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="<?php echo URL_ROOT; ?>/instrutor/perfil" method="POST" enctype="multipart/form-data">
            <h2 class="text-2xl font-bold mb-4">Informações Pessoais</h2>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Nome Completo</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($data['user']->name); ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" value="<?php echo htmlspecialchars($data['user']->email); ?>" 
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100" disabled>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Telefone</label>
                <input type="tel" name="phone" value="<?php echo htmlspecialchars($data['user']->phone); ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <h2 class="text-2xl font-bold mb-4 mt-8">Informações Profissionais</h2>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Número DETRAN</label>
                <input type="text" name="detran_number" value="<?php echo htmlspecialchars($data['instructor']->detran_number ?? ''); ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="DETRAN-SP-12345">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Documento DETRAN (PDF ou Imagem)</label>
                <input type="file" name="detran_doc" accept=".pdf,.jpg,.jpeg,.png" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if($data['instructor']->detran_doc): ?>
                <p class="text-sm text-green-600 mt-1"><i class="fas fa-check-circle"></i> Documento enviado</p>
                <?php endif; ?>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Sobre Você</label>
                <textarea name="bio" rows="4" 
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Conte um pouco sobre sua experiência como instrutor..."><?php echo htmlspecialchars($data['instructor']->bio ?? ''); ?></textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Preço por Hora (R$)</label>
                    <input type="number" name="price_per_hour" step="0.01" value="<?php echo $data['instructor']->price_per_hour; ?>" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Anos de Experiência</label>
                    <input type="number" name="experience_years" value="<?php echo $data['instructor']->experience_years; ?>" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Informações do Veículo</label>
                <input type="text" name="vehicle_info" value="<?php echo htmlspecialchars($data['instructor']->vehicle_info ?? ''); ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Ex: Volkswagen Gol 2020 - Câmbio Manual">
            </div>
            
            <h2 class="text-2xl font-bold mb-4 mt-8">Localização</h2>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Endereço</label>
                <input type="text" name="location_address" value="<?php echo htmlspecialchars($data['instructor']->location_address ?? ''); ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Av. Paulista, 1000 - São Paulo, SP">
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Latitude</label>
                    <input type="text" name="location_lat" value="<?php echo $data['instructor']->location_lat ?? ''; ?>" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="-23.550520">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Longitude</label>
                    <input type="text" name="location_lng" value="<?php echo $data['instructor']->location_lng ?? ''; ?>" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="-46.633308">
                </div>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700">
                <i class="fas fa-save mr-2"></i>Salvar Alterações
            </button>
        </form>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
