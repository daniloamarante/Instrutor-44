    </main>
    
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Encontre Instrutor</h3>
                    <p class="text-gray-400">Conectando alunos com instrutores de direção autorizados pelo DETRAN.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Para Alunos</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo URL_ROOT; ?>/aluno/buscar" class="text-gray-400 hover:text-white">Buscar Instrutores</a></li>
                        <li><a href="<?php echo URL_ROOT; ?>/auth/register?tipo=aluno" class="text-gray-400 hover:text-white">Cadastrar-se</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Para Instrutores</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo URL_ROOT; ?>/para-instrutores" class="text-gray-400 hover:text-white">Como Funciona</a></li>
                        <li><a href="<?php echo URL_ROOT; ?>/planos" class="text-gray-400 hover:text-white">Planos e Preços</a></li>
                        <li><a href="<?php echo URL_ROOT; ?>/auth/login" class="text-gray-400 hover:text-white">Entrar</a></li>
                        <li><a href="<?php echo URL_ROOT; ?>/auth/register?tipo=instrutor" class="text-gray-400 hover:text-white">Cadastrar-se</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contato</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400"><i class="fas fa-envelope mr-2"></i> contato@encontreinstrutor.com</li>
                        <li class="text-gray-400"><i class="fas fa-phone mr-2"></i> (11) 3000-0000</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> Encontre Instrutor. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
    
    <script>
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
