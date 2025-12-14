<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Meu Perfil</h1>
    
    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="<?php echo URL_ROOT; ?>/aluno/perfil" method="POST">
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Nome Completo</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($data['user']->name); ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" value="<?php echo htmlspecialchars($data['user']->email); ?>" 
                       class="w-full px-4 py-2 border rounded-lg bg-gray-100" disabled>
                <p class="text-sm text-gray-500 mt-1">O email não pode ser alterado</p>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Telefone</label>
                <input type="tel" name="phone" value="<?php echo htmlspecialchars($data['user']->phone); ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Endereço</label>
                <input type="text" name="location_address" value="<?php echo htmlspecialchars($data['student']->location_address ?? ''); ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Seu endereço completo">
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Latitude</label>
                    <input type="text" name="location_lat" value="<?php echo $data['student']->location_lat ?? ''; ?>" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="-23.550520">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Longitude</label>
                    <input type="text" name="location_lng" value="<?php echo $data['student']->location_lng ?? ''; ?>" 
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
