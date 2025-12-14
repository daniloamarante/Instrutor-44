<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../app/views/layouts/seo-meta.php'; ?>
    <link rel="manifest" href="<?php echo URL_ROOT; ?>/public/manifest.json">
    <meta name="theme-color" content="#2563eb">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <?php require_once '../app/views/components/schema-jsonld.php'; ?>
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
                        <span class="text-gray-700 hidden sm:inline">Olá, <?php echo $_SESSION['user_name']; ?></span>

                        <?php if(($_SESSION['user_role'] ?? '') === 'aluno' || ($_SESSION['user_role'] ?? '') === 'instrutor'): ?>
                            <button id="emergencyButton" type="button" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                <i class="fas fa-triangle-exclamation mr-2"></i>Emergência
                            </button>
                        <?php endif; ?>
                        
                        <?php if($_SESSION['user_role'] == 'aluno'): ?>
                            <div class="hidden md:flex items-center space-x-4">
                            <a href="<?php echo URL_ROOT; ?>/aluno/dashboard" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                            <a href="<?php echo URL_ROOT; ?>/aluno/buscar" class="text-gray-700 hover:text-blue-600">Buscar</a>
                            <a href="<?php echo URL_ROOT; ?>/aluno/minhas-aulas" class="text-gray-700 hover:text-blue-600">Minhas Aulas</a>
                            <a href="<?php echo URL_ROOT; ?>/aluno/perfil" class="text-gray-700 hover:text-blue-600">Meu Perfil</a>
                            </div>
                        <?php elseif($_SESSION['user_role'] == 'instrutor'): ?>
                            <div class="hidden md:flex items-center space-x-4">
                            <a href="<?php echo URL_ROOT; ?>/instrutor/dashboard" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                            <a href="<?php echo URL_ROOT; ?>/instrutor/agenda" class="text-gray-700 hover:text-blue-600">Agenda</a>
                            <a href="<?php echo URL_ROOT; ?>/instrutor/alunos" class="text-gray-700 hover:text-blue-600">Alunos</a>
                            </div>
                        <?php elseif($_SESSION['user_role'] == 'admin'): ?>
                            <div class="hidden md:flex items-center space-x-4">
                            <a href="<?php echo URL_ROOT; ?>/admin/dashboard" class="text-gray-700 hover:text-blue-600">Admin</a>
                            <a href="<?php echo URL_ROOT; ?>/admin/instrutores" class="text-gray-700 hover:text-blue-600">Instrutores</a>
                            <a href="<?php echo URL_ROOT; ?>/admin/alunos" class="text-gray-700 hover:text-blue-600">Alunos</a>
                            <a href="<?php echo URL_ROOT; ?>/admin/emergencias" class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700" id="adminEmergenciesLink">
                                <i class="fas fa-triangle-exclamation mr-2"></i>Emergências
                                <span id="adminEmergenciesBadge" class="ml-2 inline-flex items-center justify-center text-xs font-bold bg-white text-red-700 rounded-full px-2 py-0.5" style="display:none"></span>
                            </a>
                            </div>
                        <?php endif; ?>
                        
                        <a href="<?php echo URL_ROOT; ?>/auth/logout" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Sair</a>
                    <?php else: ?>
                        <a href="<?php echo URL_ROOT; ?>/aluno/buscar" class="text-gray-700 hover:text-blue-600">Buscar Instrutores</a>
                        <a href="<?php echo URL_ROOT; ?>/auth/login" class="text-gray-700 hover:text-blue-600">Sou Instrutor</a>
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
    
    <?php require_once '../app/views/components/emergency-sos.php'; ?>
    <main class="py-8 pb-24 md:pb-8">

    <script>
        (function() {
            if('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('<?php echo URL_ROOT; ?>/public/service-worker.js').catch(function(){});
                });
            }
        })();

        (function() {
            const btn = document.getElementById('emergencyButton');
            if(btn) {
                btn.addEventListener('click', async function() {
                    btn.disabled = true;
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Ativando...';

                    function acionar(payload) {
                        return fetch('<?php echo URL_ROOT; ?>/emergencia/acionar', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(payload || {})
                        }).then(r => r.json());
                    }

                    function atualizar(alertId, payload) {
                        return fetch('<?php echo URL_ROOT; ?>/emergencia/atualizar/' + encodeURIComponent(alertId), {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(payload || {})
                        }).then(r => r.json());
                    }

                    try {
                        let alertId = null;

                        const startTracking = (id) => {
                            btn.innerHTML = '<i class="fas fa-location-crosshairs mr-2"></i>Emergência ativa';

                            if(!navigator.geolocation) {
                                return;
                            }

                            let lastSentAt = 0;
                            const minIntervalMs = 60000;

                            navigator.geolocation.watchPosition(async (pos) => {
                                const now = Date.now();
                                if(now - lastSentAt < minIntervalMs) {
                                    return;
                                }
                                lastSentAt = now;

                                try {
                                    await atualizar(id, {
                                        lat: pos.coords.latitude,
                                        lng: pos.coords.longitude,
                                        accuracy_meters: pos.coords.accuracy
                                    });
                                } catch(e) {
                                }
                            }, function() {
                            }, { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 });
                        };

                        if(navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(async (pos) => {
                                const resp = await acionar({ lat: pos.coords.latitude, lng: pos.coords.longitude });
                                if(resp && resp.success && resp.id) {
                                    alertId = resp.id;
                                    startTracking(alertId);
                                } else {
                                    btn.disabled = false;
                                    btn.innerHTML = originalText;
                                }
                            }, async () => {
                                const resp = await acionar({});
                                if(resp && resp.success && resp.id) {
                                    alertId = resp.id;
                                    startTracking(alertId);
                                } else {
                                    btn.disabled = false;
                                    btn.innerHTML = originalText;
                                }
                            }, { enableHighAccuracy: true, timeout: 8000, maximumAge: 0 });
                        } else {
                            const resp = await acionar({});
                            if(resp && resp.success && resp.id) {
                                alertId = resp.id;
                                startTracking(alertId);
                            } else {
                                btn.disabled = false;
                                btn.innerHTML = originalText;
                            }
                        }
                    } catch(e) {
                        btn.disabled = false;
                        btn.innerHTML = originalText;
                    }
                });
            }

            const badge = document.getElementById('adminEmergenciesBadge');
            if(badge) {
                async function refresh() {
                    try {
                        const resp = await fetch('<?php echo URL_ROOT; ?>/admin/emergencias-count');
                        const data = await resp.json();
                        const count = parseInt(data.count || 0, 10);
                        if(count > 0) {
                            badge.style.display = 'inline-flex';
                            badge.textContent = count;
                        } else {
                            badge.style.display = 'none';
                        }
                    } catch(e) {
                    }
                }
                refresh();
                setInterval(refresh, 60000);
            }
        })();
    </script>
