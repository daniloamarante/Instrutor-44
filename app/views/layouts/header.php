<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Encontre Instrutor'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="<?php echo URL_ROOT; ?>" class="flex items-center">
                        <i class="fas fa-car text-blue-600 text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-gray-800">Encontre Instrutor</span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <span class="text-gray-700">Olá, <?php echo $_SESSION['user_name']; ?></span>
                        
                        <?php if($_SESSION['user_role'] == 'aluno'): ?>
                            <a href="<?php echo URL_ROOT; ?>/aluno/dashboard" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                            <a href="<?php echo URL_ROOT; ?>/aluno/buscar" class="text-gray-700 hover:text-blue-600">Buscar</a>
                            <a href="<?php echo URL_ROOT; ?>/aluno/minhas-aulas" class="text-gray-700 hover:text-blue-600">Minhas Aulas</a>
                        <?php elseif($_SESSION['user_role'] == 'instrutor'): ?>
                            <a href="<?php echo URL_ROOT; ?>/instrutor/dashboard" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                            <a href="<?php echo URL_ROOT; ?>/instrutor/agenda" class="text-gray-700 hover:text-blue-600">Agenda</a>
                            <a href="<?php echo URL_ROOT; ?>/instrutor/alunos" class="text-gray-700 hover:text-blue-600">Alunos</a>
                        <?php elseif($_SESSION['user_role'] == 'admin'): ?>
                            <a href="<?php echo URL_ROOT; ?>/admin/dashboard" class="text-gray-700 hover:text-blue-600">Admin</a>
                            <a href="<?php echo URL_ROOT; ?>/admin/instrutores" class="text-gray-700 hover:text-blue-600">Instrutores</a>
                            <a href="<?php echo URL_ROOT; ?>/admin/alunos" class="text-gray-700 hover:text-blue-600">Alunos</a>
                        <?php endif; ?>
                        
                        <a href="<?php echo URL_ROOT; ?>/auth/logout" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Sair</a>
                    <?php else: ?>
                        <a href="<?php echo URL_ROOT; ?>/aluno/buscar" class="text-gray-700 hover:text-blue-600">Buscar Instrutores</a>
                        <a href="<?php echo URL_ROOT; ?>/para-instrutores" class="text-gray-700 hover:text-blue-600">Sou Instrutor</a>
                        <a href="<?php echo URL_ROOT; ?>/auth/login" class="text-gray-700 hover:text-blue-600">Entrar</a>
                        <a href="<?php echo URL_ROOT; ?>/auth/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Cadastrar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    
    <?php if(isset($_SESSION['success'])): ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></span>
            </div>
        </div>
    <?php endif; ?>
    
    <?php if(isset($_SESSION['error'])): ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></span>
            </div>
        </div>
    <?php endif; ?>
    
    <main class="py-8">
