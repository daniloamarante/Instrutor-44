<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Avaliar Instrutor</h1>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-6">
            <p class="text-gray-700">Você está avaliando:</p>
            <p class="text-xl font-semibold text-gray-900"><?php echo htmlspecialchars($data['instructor']->name); ?></p>
        </div>

        <form action="<?php echo URL_ROOT; ?>/aluno/avaliar/<?php echo $data['instructor']->id; ?>" method="POST" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Higiene do veículo</label>
                    <select name="hygiene_vehicle" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Selecione</option>
                        <option value="5">5 - Excelente</option>
                        <option value="4">4 - Muito bom</option>
                        <option value="3">3 - Bom</option>
                        <option value="2">2 - Regular</option>
                        <option value="1">1 - Ruim</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Qualidade do atendimento do instrutor</label>
                    <select name="service_quality" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Selecione</option>
                        <option value="5">5 - Excelente</option>
                        <option value="4">4 - Muito bom</option>
                        <option value="3">3 - Bom</option>
                        <option value="2">2 - Regular</option>
                        <option value="1">1 - Ruim</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Pontualidade</label>
                    <select name="punctuality" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Selecione</option>
                        <option value="5">5 - Excelente</option>
                        <option value="4">4 - Muito bom</option>
                        <option value="3">3 - Bom</option>
                        <option value="2">2 - Regular</option>
                        <option value="1">1 - Ruim</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Qualidade do veículo</label>
                    <select name="vehicle_quality" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Selecione</option>
                        <option value="5">5 - Excelente</option>
                        <option value="4">4 - Muito bom</option>
                        <option value="3">3 - Bom</option>
                        <option value="2">2 - Regular</option>
                        <option value="1">1 - Ruim</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Comentário (opcional)</label>
                <textarea name="comment" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Conte como foi sua experiência..."></textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700">
                    <i class="fas fa-paper-plane mr-2"></i>Enviar Avaliação
                </button>
                <a href="<?php echo URL_ROOT; ?>/aluno/minhas-aulas" class="flex-1 bg-gray-100 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-200 text-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
