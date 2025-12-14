<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <div class="flex items-start mb-6">
            <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center text-4xl font-bold text-gray-600 mr-6">
                <?php echo strtoupper(substr($data['instructor']->name, 0, 1)); ?>
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-bold mb-2"><?php echo htmlspecialchars($data['instructor']->name); ?></h1>
                <div class="flex items-center text-yellow-500 mb-2">
                    <?php for($i = 0; $i < 5; $i++): ?>
                        <i class="fas fa-star<?php echo $i < floor($data['instructor']->rating) ? '' : '-o'; ?> text-xl"></i>
                    <?php endfor; ?>
                    <span class="ml-2 text-gray-600 text-lg"><?php echo number_format($data['instructor']->rating, 1); ?> (<?php echo $data['instructor']->total_reviews; ?> avaliações)</span>
                </div>
                <div class="text-gray-600 space-y-1">
                    <?php if(!empty($data['instructor']->phone)): ?>
                        <p><i class="fas fa-phone mr-2"></i><?php echo htmlspecialchars($data['instructor']->phone); ?></p>
                    <?php endif; ?>
                    <?php if(!empty($data['instructor']->location_address)): ?>
                        <p><i class="fas fa-map-marker-alt mr-2"></i><?php echo htmlspecialchars($data['instructor']->location_address); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="text-right">
                <p class="text-4xl font-bold text-blue-600 mb-2">R$ <?php echo number_format($data['instructor']->price_per_hour, 2, ',', '.'); ?></p>
                <p class="text-gray-600">por hora</p>
            </div>
        </div>

        <div class="border-t pt-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">Sobre o Instrutor</h2>
            <p class="text-gray-700 mb-4"><?php echo nl2br(htmlspecialchars($data['instructor']->bio ?? 'Instrutor experiente e dedicado.')); ?></p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="font-semibold mb-2"><i class="fas fa-car mr-2 text-blue-600"></i>Veículo</p>
                    <p class="text-gray-700"><?php echo htmlspecialchars($data['instructor']->vehicle_info ?? 'Informação não disponível'); ?></p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="font-semibold mb-2"><i class="fas fa-award mr-2 text-blue-600"></i>Experiência</p>
                    <p class="text-gray-700"><?php echo $data['instructor']->experience_years; ?> anos como instrutor</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="font-semibold mb-2"><i class="fas fa-id-card mr-2 text-blue-600"></i>Credenciamento</p>
                    <p class="text-gray-700"><?php echo htmlspecialchars($data['instructor']->detran_number ?? 'Não informado'); ?></p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="font-semibold mb-2"><i class="fas fa-check-circle mr-2 text-green-600"></i>Status</p>
                    <p class="text-green-700 font-semibold">Instrutor aprovado na plataforma</p>
                </div>
            </div>
        </div>

        <div class="border-t pt-6">
            <h2 class="text-2xl font-bold mb-4">Agendar Aula</h2>

            <?php if(isset($_SESSION['user_id']) && ($_SESSION['user_role'] ?? '') === 'aluno'): ?>
                <form action="<?php echo URL_ROOT; ?>/aluno/agendar/<?php echo $data['instructor']->id; ?>" method="POST" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Data e Hora</label>
                            <input type="datetime-local" name="date_time" class="w-full px-4 py-2 border rounded-lg" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Duração (minutos)</label>
                            <select name="duration" class="w-full px-4 py-2 border rounded-lg">
                                <option value="60">60 minutos - R$ <?php echo number_format($data['instructor']->price_per_hour, 2, ',', '.'); ?></option>
                                <option value="90">90 minutos - R$ <?php echo number_format($data['instructor']->price_per_hour * 1.5, 2, ',', '.'); ?></option>
                                <option value="120">120 minutos - R$ <?php echo number_format($data['instructor']->price_per_hour * 2, 2, ',', '.'); ?></option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Local da Aula</label>
                        <input type="text" name="location_address" class="w-full px-4 py-2 border rounded-lg" placeholder="Endereço para início da aula" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Observações</label>
                        <textarea name="notes" rows="3" class="w-full px-4 py-2 border rounded-lg" placeholder="Alguma observação ou preferência?"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700">
                        <i class="fas fa-calendar-plus mr-2"></i>Solicitar Agendamento
                    </button>
                </form>
            <?php else: ?>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-gray-700 mb-3">Para solicitar um agendamento, entre como <strong>aluno</strong>.</p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="<?php echo URL_ROOT; ?>/auth/login" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                            <i class="fas fa-sign-in-alt mr-2"></i>Entrar
                        </a>
                        <a href="<?php echo URL_ROOT; ?>/auth/register?tipo=aluno" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-white border border-gray-300 text-gray-800 hover:bg-gray-100">
                            <i class="fas fa-user-plus mr-2"></i>Criar conta de aluno
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if(!empty($data['reviews'])): ?>
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6">Avaliações dos Alunos</h2>
        <div class="space-y-6">
            <?php foreach($data['reviews'] as $review): ?>
            <div class="border-b pb-6 last:border-b-0">
                <div class="flex items-start mb-2">
                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-lg font-bold text-gray-600 mr-4">
                        <?php echo strtoupper(substr($review->student_name, 0, 1)); ?>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold"><?php echo htmlspecialchars($review->student_name); ?></p>
                                <div class="flex items-center text-yellow-500">
                                    <?php for($i = 0; $i < 5; $i++): ?>
                                        <i class="fas fa-star<?php echo $i < $review->rating ? '' : '-o'; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500"><?php echo date('d/m/Y', strtotime($review->created_at)); ?></span>
                        </div>
                        <p class="text-gray-700 mt-2"><?php echo nl2br(htmlspecialchars($review->comment)); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
