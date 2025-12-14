<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center mb-8">Entrar</h2>
        
        <form action="<?php echo URL_ROOT; ?>/auth/login" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" value="<?php echo $data['email']; ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo !empty($data['email_err']) ? 'border-red-500' : ''; ?>"
                       required>
                <?php if(!empty($data['email_err'])): ?>
                    <span class="text-red-500 text-sm"><?php echo $data['email_err']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Senha</label>
                <input type="password" name="password" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo !empty($data['password_err']) ? 'border-red-500' : ''; ?>"
                       required>
                <?php if(!empty($data['password_err'])): ?>
                    <span class="text-red-500 text-sm"><?php echo $data['password_err']; ?></span>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Entrar
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-600">Não tem uma conta? 
                <a href="<?php echo URL_ROOT; ?>/auth/register" class="text-blue-600 hover:underline">Cadastre-se</a>
            </p>
        </div>
        
        <div class="mt-4 pt-4 border-t text-center text-sm text-gray-500">
            <p>Usuário de teste:</p>
            <p><strong>Aluno:</strong> pedro.aluno@email.com</p>
            <p><strong>Instrutor:</strong> joao.silva@email.com</p>
            <p><strong>Admin:</strong> admin@instrutor44.com</p>
            <p><strong>Senha:</strong> password</p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
