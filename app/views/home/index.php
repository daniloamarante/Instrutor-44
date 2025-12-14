<?php require_once '../app/views/layouts/header.php'; ?>

<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-6">Encontre o Instrutor de Direção Perfeito</h1>
            <p class="text-xl mb-8">Aulas particulares com instrutores autorizados pelo DETRAN perto de você</p>
            <div class="flex justify-center space-x-4">
                <a href="<?php echo URL_ROOT; ?>/aluno/buscar" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    <i class="fas fa-search mr-2"></i>Buscar Instrutores
                </a>
                <a href="<?php echo URL_ROOT; ?>/para-instrutores" class="bg-green-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-600 transition">
                    <i class="fas fa-user-tie mr-2"></i>Sou Instrutor
                </a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-lg mb-16">
        <h2 class="text-2xl font-bold text-blue-900 mb-4">
            <i class="fas fa-info-circle mr-2"></i>Você Sabia?
        </h2>
        <p class="text-gray-700 text-lg">
            De acordo com a legislação do DETRAN, instrutores de direção independentes devidamente credenciados 
            podem oferecer aulas particulares. Nossa plataforma conecta você com profissionais autorizados, 
            garantindo segurança e qualidade no seu aprendizado.
        </p>
    </div>
    
    <h2 class="text-3xl font-bold text-center mb-12">Como Funciona</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-16">
        <div class="text-center">
            <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-search text-blue-600 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">1. Busque</h3>
            <p class="text-gray-600">Encontre instrutores perto de você usando nossa busca geolocalizada</p>
        </div>
        
        <div class="text-center">
            <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-star text-blue-600 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">2. Compare</h3>
            <p class="text-gray-600">Veja avaliações, preços e perfis completos dos instrutores</p>
        </div>
        
        <div class="text-center">
            <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calendar-check text-blue-600 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">3. Agende</h3>
            <p class="text-gray-600">Escolha o melhor horário e agende sua aula diretamente</p>
        </div>
        
        <div class="text-center">
            <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-graduation-cap text-blue-600 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">4. Aprenda</h3>
            <p class="text-gray-600">Tenha aulas de qualidade e conquiste sua habilitação</p>
        </div>
    </div>
    
    <h2 class="text-3xl font-bold text-center mb-12">Por Que Escolher Nossos Instrutores?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-blue-600 text-4xl mb-4">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Perto de Você</h3>
            <p class="text-gray-600">Encontre instrutores na sua região e economize tempo no deslocamento</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-green-600 text-4xl mb-4">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">100% Seguro</h3>
            <p class="text-gray-600">Todos os instrutores são verificados e autorizados pelo DETRAN</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-yellow-600 text-4xl mb-4">
                <i class="fas fa-comments"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Avaliações Reais</h3>
            <p class="text-gray-600">Veja o que outros alunos dizem sobre cada instrutor</p>
        </div>
    </div>
    
    <?php if(!empty($data['featured_instructors'])): ?>
    <h2 class="text-3xl font-bold text-center mb-12">Instrutores em Destaque</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php foreach(array_slice($data['featured_instructors'], 0, 6) as $instructor): ?>
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
                
                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo htmlspecialchars(substr($instructor->bio ?? 'Instrutor experiente', 0, 100)); ?>...</p>
                
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
