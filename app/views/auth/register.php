<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center mb-8">Cadastrar</h2>
        
        <form action="<?php echo URL_ROOT; ?>/auth/register" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tipo de Conta</label>
                <select name="role" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="aluno" <?php echo $data['role'] == 'aluno' ? 'selected' : ''; ?>>Aluno</option>
                    <option value="instrutor" <?php echo $data['role'] == 'instrutor' ? 'selected' : ''; ?>>Instrutor</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nome Completo</label>
                <input type="text" name="name" value="<?php echo $data['name']; ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo !empty($data['name_err']) ? 'border-red-500' : ''; ?>"
                       required>
                <?php if(!empty($data['name_err'])): ?>
                    <span class="text-red-500 text-sm"><?php echo $data['name_err']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" value="<?php echo $data['email']; ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo !empty($data['email_err']) ? 'border-red-500' : ''; ?>"
                       required>
                <?php if(!empty($data['email_err'])): ?>
                    <span class="text-red-500 text-sm"><?php echo $data['email_err']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Telefone</label>
                <input type="tel" name="phone" value="<?php echo $data['phone']; ?>" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="(11) 99999-9999">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Senha</label>
                <input type="password" name="password" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo !empty($data['password_err']) ? 'border-red-500' : ''; ?>"
                       required>
                <?php if(!empty($data['password_err'])): ?>
                    <span class="text-red-500 text-sm"><?php echo $data['password_err']; ?></span>
                <?php endif; ?>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Confirmar Senha</label>
                <input type="password" name="confirm_password" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo !empty($data['confirm_password_err']) ? 'border-red-500' : ''; ?>"
                       required>
                <?php if(!empty($data['confirm_password_err'])): ?>
                    <span class="text-red-500 text-sm"><?php echo $data['confirm_password_err']; ?></span>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Cadastrar
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-600">Já tem uma conta? 
                <a href="<?php echo URL_ROOT; ?>/auth/login" class="text-blue-600 hover:underline">Entrar</a>
            </p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
