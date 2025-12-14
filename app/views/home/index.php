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
                <a href="<?php echo URL_ROOT; ?>/auth/login" class="bg-green-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-600 transition">
                    <i class="fas fa-user-tie mr-2"></i>Sou Instrutor
                </a>
            </div>
        </div>
    </div>
</div>

<div id="legal2025Modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4" style="z-index: 50;">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4 flex items-center justify-between">
            <h3 class="text-lg font-semibold">Aviso importante (regras 2025)</h3>
            <button id="legal2025CloseX" class="text-white hover:text-gray-200" aria-label="Fechar">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 text-gray-700">
            <p class="mb-4">
                Em 2025, o Ministério dos Transportes propôs mudanças que ampliam a atuação de <strong>instrutores autônomos</strong>,
                sem vínculo obrigatório com autoescola, desde que <strong>autorizados pelo DETRAN</strong> e seguindo as regras estaduais.
            </p>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                <p class="font-semibold mb-2">Pontos-chave para alunos e instrutores</p>
                <ul class="list-disc pl-5 space-y-1 text-sm">
                    <li>Instrutor precisa estar autorizado/cadastrado pelo DETRAN e poderá ser fiscalizado.</li>
                    <li>Durante as aulas práticas, o instrutor deve portar documentos obrigatórios (ex.: CNH, credencial, LAV, CRLV).</li>
                    <li>Veículo deve atender requisitos do CTB e pode exigir identificação como veículo de ensino.</li>
                    <li>Regras e procedimentos podem variar conforme o DETRAN de cada estado.</li>
                </ul>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                   href="https://www.gov.br/transportes/pt-br/assuntos/noticias/2025/10/instrutor-autonomo-de-transito-entenda-como-vai-funcionar-o-mercado-de-trabalho-para-esses-profissionais">
                    <i class="fas fa-external-link-alt mr-2"></i>Leia a fonte oficial
                </a>
                <a target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-gray-100 text-gray-800 hover:bg-gray-200"
                   href="https://play.google.com/store/search?q=CNH%20Brasil&c=apps">
                    <i class="fas fa-mobile-alt mr-2"></i>App CNH Brasil
                </a>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 flex justify-end gap-2">
            <button id="legal2025Close" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Entendi</button>
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
                    <a href="<?php echo URL_ROOT; ?>/home/instrutor/<?php echo $instructor->id; ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Ver Perfil</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script>
    (function() {
        const key = 'legal_2025_ack_v1';
        const modal = document.getElementById('legal2025Modal');
        const closeBtn = document.getElementById('legal2025Close');
        const closeX = document.getElementById('legal2025CloseX');

        function openModal() {
            if(!modal) return;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            if(!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            try { localStorage.setItem(key, '1'); } catch(e) {}
        }

        try {
            const hasAck = localStorage.getItem(key) === '1';
            if(!hasAck) {
                setTimeout(openModal, 600);
            }
        } catch(e) {
            setTimeout(openModal, 600);
        }

        if(closeBtn) closeBtn.addEventListener('click', closeModal);
        if(closeX) closeX.addEventListener('click', closeModal);
        if(modal) {
            modal.addEventListener('click', function(ev) {
                if(ev.target === modal) closeModal();
            });
        }
    })();
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>
