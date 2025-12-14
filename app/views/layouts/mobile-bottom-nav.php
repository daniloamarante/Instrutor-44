<?php

$role = $_SESSION['user_role'] ?? '';
if(!isset($_SESSION['user_id']) || ($role !== 'aluno' && $role !== 'instrutor')) {
    return;
}

$path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';

function isActivePath($path, $needle) {
    if($needle === '/') {
        return $path === '/';
    }
    return strpos($path, $needle) !== false;
}

$items = [];

if($role === 'aluno') {
    $items = [
        [
            'href' => URL_ROOT . '/aluno/dashboard',
            'label' => 'Dashboard',
            'icon' => 'fa-house',
            'active' => isActivePath($path, '/aluno/dashboard')
        ],
        [
            'href' => URL_ROOT . '/aluno/buscar',
            'label' => 'Buscar',
            'icon' => 'fa-magnifying-glass',
            'active' => isActivePath($path, '/aluno/buscar')
        ],
        [
            'href' => URL_ROOT . '/aluno/minhas-aulas',
            'label' => 'Aulas',
            'icon' => 'fa-calendar-days',
            'active' => isActivePath($path, '/aluno/minhas-aulas')
        ],
        [
            'href' => URL_ROOT . '/aluno/perfil',
            'label' => 'Perfil',
            'icon' => 'fa-user',
            'active' => isActivePath($path, '/aluno/perfil')
        ]
    ];
} else {
    $items = [
        [
            'href' => URL_ROOT . '/instrutor/dashboard',
            'label' => 'Dashboard',
            'icon' => 'fa-house',
            'active' => isActivePath($path, '/instrutor/dashboard')
        ],
        [
            'href' => URL_ROOT . '/instrutor/agenda',
            'label' => 'Agenda',
            'icon' => 'fa-calendar-days',
            'active' => isActivePath($path, '/instrutor/agenda')
        ],
        [
            'href' => URL_ROOT . '/instrutor/alunos',
            'label' => 'Alunos',
            'icon' => 'fa-users',
            'active' => isActivePath($path, '/instrutor/alunos')
        ],
        [
            'href' => URL_ROOT . '/instrutor/avaliacoes',
            'label' => 'Avaliações',
            'icon' => 'fa-star',
            'active' => isActivePath($path, '/instrutor/avaliacoes')
        ]
    ];
}

?>

<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t shadow-2xl z-40" style="padding-bottom: env(safe-area-inset-bottom);">
    <div class="max-w-md mx-auto">
        <div class="grid grid-cols-4">
            <?php foreach($items as $it): ?>
                <a href="<?php echo $it['href']; ?>" class="flex flex-col items-center justify-center py-3 min-h-12 <?php echo $it['active'] ? 'text-blue-700' : 'text-gray-600'; ?>">
                    <i class="fas <?php echo $it['icon']; ?> text-lg"></i>
                    <span class="text-xs mt-1 font-medium"><?php echo $it['label']; ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>
