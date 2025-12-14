<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-4">Planos para Instrutores</h1>
        <p class="text-xl text-gray-600">Escolha o plano ideal para aumentar sua visibilidade e conquistar mais alunos</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php foreach($data['plans'] as $plan): ?>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden <?php echo $plan->featured ? 'ring-4 ring-blue-500 transform scale-105' : ''; ?>">
            <?php if($plan->featured): ?>
            <div class="bg-blue-600 text-white text-center py-2 font-semibold">
                <i class="fas fa-star mr-2"></i>MAIS POPULAR
            </div>
            <?php endif; ?>
            
            <div class="p-8">
                <h3 class="text-2xl font-bold mb-4"><?php echo htmlspecialchars($plan->name); ?></h3>
                
                <div class="mb-6">
                    <span class="text-4xl font-bold">R$ <?php echo number_format($plan->price, 2, ',', '.'); ?></span>
                    <span class="text-gray-600">/mês</span>
                </div>
                
                <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($plan->description); ?></p>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Até <?php echo $plan->max_photos; ?> fotos no perfil</span>
                    </li>
                    
                    <?php if($plan->featured): ?>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Perfil em destaque</span>
                    </li>
                    <?php endif; ?>
                    
                    <?php if($plan->priority_listing): ?>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Prioridade nas buscas</span>
                    </li>
                    <?php endif; ?>
                    
                    <?php if($plan->analytics): ?>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Relatórios e estatísticas</span>
                    </li>
                    <?php endif; ?>
                    
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Suporte <?php echo $plan->support_priority; ?></span>
                    </li>
                </ul>
                
                <a href="<?php echo URL_ROOT; ?>/auth/register?tipo=instrutor" class="block w-full text-center bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Começar Agora
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="mt-16 bg-blue-50 rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-4 text-center">Perguntas Frequentes</h2>
        
        <div class="space-y-4 max-w-3xl mx-auto">
            <div class="bg-white p-6 rounded-lg">
                <h3 class="font-semibold mb-2">Como funciona o pagamento?</h3>
                <p class="text-gray-600">O pagamento é mensal e pode ser feito via cartão de crédito, boleto ou PIX.</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg">
                <h3 class="font-semibold mb-2">Posso cancelar a qualquer momento?</h3>
                <p class="text-gray-600">Sim, você pode cancelar seu plano a qualquer momento sem multas ou taxas adicionais.</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg">
                <h3 class="font-semibold mb-2">Preciso ser credenciado pelo DETRAN?</h3>
                <p class="text-gray-600">Sim, todos os instrutores devem apresentar documentação válida do DETRAN para aprovação.</p>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
