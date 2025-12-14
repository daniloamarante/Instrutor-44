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
                       placeholder="DETRAN-SP-12345" required>
                <p class="text-xs text-gray-500 mt-1">Obrigatório para aprovação do perfil (validação via API DETRAN será adicionada futuramente).</p>
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
                <h3 class="text-lg font-semibold mb-2">Documentos obrigatórios para fiscalização (2025)</h3>
                <p class="text-sm text-gray-600 mb-4">Envie PDF/JPG/PNG. O admin pode aprovar/rejeitar com base nas exigências do DETRAN/CTB.</p>

                <?php
                    $docLabels = [
                        'cnh' => 'CNH',
                        'credencial' => 'Credencial/Crachá de Instrutor',
                        'lav' => 'Licença de Aprendizagem Veicular (LAV)',
                        'crlv' => 'CRLV (Certificado de Registro e Licenciamento do Veículo)'
                    ];
                    $docKeys = [
                        'cnh' => 'doc_cnh',
                        'credencial' => 'doc_credencial',
                        'lav' => 'doc_lav',
                        'crlv' => 'doc_crlv'
                    ];
                    $latestStatus = [];
                    if(!empty($data['documents'])) {
                        foreach($data['documents'] as $d) {
                            if(!isset($latestStatus[$d->doc_type])) {
                                $latestStatus[$d->doc_type] = $d->status;
                            }
                        }
                    }
                ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach($docLabels as $type => $label): ?>
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <div class="flex items-center justify-between mb-2">
                                <div class="font-semibold text-gray-800"><?php echo htmlspecialchars($label); ?></div>
                                <?php if(($latestStatus[$type] ?? '') === 'aprovado'): ?>
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-100 text-green-800">Aprovado</span>
                                <?php elseif(($latestStatus[$type] ?? '') === 'rejeitado'): ?>
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-red-100 text-red-800">Rejeitado</span>
                                <?php elseif(isset($latestStatus[$type])): ?>
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">Pendente</span>
                                <?php else: ?>
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-gray-100 text-gray-700">Não enviado</span>
                                <?php endif; ?>
                            </div>
                            <input type="file" name="<?php echo $docKeys[$type]; ?>" accept=".pdf,.jpg,.jpeg,.png" 
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                            <p class="text-xs text-gray-500 mt-2">Você pode reenviar caso seja rejeitado.</p>
                        </div>
                    <?php endforeach; ?>
                </div>
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
