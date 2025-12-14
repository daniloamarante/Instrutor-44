<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold">Emergências</h1>
        <a href="<?php echo URL_ROOT; ?>/admin/dashboard" class="text-gray-700 hover:text-blue-600">Voltar</a>
    </div>

    <?php if(empty($data['alerts'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <p class="text-xl text-gray-600">Nenhuma emergência em aberto</p>
        </div>
    <?php else: ?>
        <div class="space-y-4" id="emergenciesList">
            <?php foreach($data['alerts'] as $alert): ?>
                <div class="bg-red-50 border border-red-200 rounded-lg shadow p-6" data-alert-id="<?php echo $alert->id; ?>">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <div class="flex-1">
                            <p class="text-red-700 font-bold text-lg">ALERTA EMERGENCIAL</p>
                            <p class="font-semibold text-gray-900 mt-1"><?php echo htmlspecialchars($alert->user_name); ?> (<?php echo htmlspecialchars($alert->user_role); ?>)</p>
                            <?php if(!empty($alert->user_phone)): ?>
                                <p class="text-gray-700 mt-1"><i class="fas fa-phone mr-2"></i><?php echo htmlspecialchars($alert->user_phone); ?></p>
                            <?php else: ?>
                                <p class="text-gray-500 mt-1">Telefone não informado</p>
                            <?php endif; ?>

                            <?php if(!empty($alert->lat) && !empty($alert->lng)): ?>
                                <p class="text-gray-700 mt-1" data-alert-location="<?php echo $alert->id; ?>"><i class="fas fa-location-dot mr-2"></i><?php echo htmlspecialchars($alert->lat); ?>, <?php echo htmlspecialchars($alert->lng); ?></p>
                            <?php else: ?>
                                <p class="text-gray-500 mt-1" data-alert-location="<?php echo $alert->id; ?>">Localização não informada (permissão negada ou indisponível)</p>
                            <?php endif; ?>

                            <p class="text-sm text-gray-600 mt-2">Aberto em: <?php echo date('d/m/Y H:i:s', strtotime($alert->created_at)); ?></p>
                            <p class="text-sm text-gray-600" data-alert-updated="<?php echo $alert->id; ?>">Última atualização: <?php echo date('d/m/Y H:i:s', strtotime($alert->updated_at)); ?></p>
                        </div>

                        <div class="flex flex-col gap-2 min-w-[220px]">
                            <?php if(!empty($alert->user_phone)): ?>
                                <a href="tel:<?php echo preg_replace('/\D+/', '', $alert->user_phone); ?>" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-center">
                                    <i class="fas fa-phone mr-2"></i>Ligar
                                </a>
                            <?php endif; ?>

                            <?php if(!empty($alert->lat) && !empty($alert->lng)): ?>
                                <a target="_blank" rel="noopener noreferrer" href="https://www.google.com/maps?q=<?php echo urlencode($alert->lat . ',' . $alert->lng); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-center" data-alert-maps="<?php echo $alert->id; ?>">
                                    <i class="fas fa-map-location-dot mr-2"></i>Ver no Maps
                                </a>

                                <button type="button"
                                        class="bg-white border border-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-100 text-center"
                                        data-copy-coords="<?php echo $alert->id; ?>"
                                        data-lat="<?php echo htmlspecialchars($alert->lat); ?>"
                                        data-lng="<?php echo htmlspecialchars($alert->lng); ?>">
                                    <i class="fas fa-copy mr-2"></i>Copiar coordenadas
                                </button>

                                <button type="button"
                                        class="bg-white border border-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-100 text-center"
                                        data-copy-maps="<?php echo $alert->id; ?>">
                                    <i class="fas fa-link mr-2"></i>Copiar link do Maps
                                </button>
                            <?php endif; ?>

                            <a href="tel:190" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-black text-center">
                                <i class="fas fa-shield-halved mr-2"></i>Acionar 190
                            </a>

                            <button type="button"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 text-center"
                                    data-copy-report="<?php echo $alert->id; ?>"
                                    data-user-name="<?php echo htmlspecialchars($alert->user_name); ?>"
                                    data-user-role="<?php echo htmlspecialchars($alert->user_role); ?>"
                                    data-user-phone="<?php echo htmlspecialchars($alert->user_phone ?? ''); ?>"
                                    data-created-at="<?php echo htmlspecialchars($alert->created_at); ?>">
                                <i class="fas fa-file-lines mr-2"></i>Copiar dados do alerta
                            </button>

                            <form action="<?php echo URL_ROOT; ?>/admin/encerrarEmergencia/<?php echo $alert->id; ?>" method="POST">
                                <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                    <i class="fas fa-circle-check mr-2"></i>Encerrar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    (function() {
        async function copyText(text) {
            if(navigator.clipboard && navigator.clipboard.writeText) {
                await navigator.clipboard.writeText(text);
                return;
            }

            const ta = document.createElement('textarea');
            ta.value = text;
            ta.style.position = 'fixed';
            ta.style.left = '-9999px';
            document.body.appendChild(ta);
            ta.select();
            document.execCommand('copy');
            document.body.removeChild(ta);
        }

        document.addEventListener('click', async function(e) {
            const coordsBtn = e.target.closest('[data-copy-coords]');
            if(coordsBtn) {
                const lat = coordsBtn.getAttribute('data-lat') || '';
                const lng = coordsBtn.getAttribute('data-lng') || '';
                if(lat && lng) {
                    try { await copyText(lat + ', ' + lng); } catch(err) {}
                }
                return;
            }

            const mapsBtn = e.target.closest('[data-copy-maps]');
            if(mapsBtn) {
                const id = mapsBtn.getAttribute('data-copy-maps');
                const mapsEl = document.querySelector('[data-alert-maps="' + id + '"]');
                if(mapsEl && mapsEl.href) {
                    try { await copyText(mapsEl.href); } catch(err) {}
                }
                return;
            }

            const reportBtn = e.target.closest('[data-copy-report]');
            if(reportBtn) {
                const id = reportBtn.getAttribute('data-copy-report');
                const name = reportBtn.getAttribute('data-user-name') || '';
                const role = reportBtn.getAttribute('data-user-role') || '';
                const phone = reportBtn.getAttribute('data-user-phone') || '';
                const createdAt = reportBtn.getAttribute('data-created-at') || '';
                const locEl = document.querySelector('[data-alert-location="' + id + '"]');
                const updEl = document.querySelector('[data-alert-updated="' + id + '"]');
                const mapsEl = document.querySelector('[data-alert-maps="' + id + '"]');

                const locationText = locEl ? locEl.textContent.trim() : '';
                const updatedText = updEl ? updEl.textContent.trim() : '';
                const mapsLink = mapsEl && mapsEl.href ? mapsEl.href : '';

                const msg =
                    'ALERTA DE EMERGÊNCIA (plataforma)\n' +
                    'Pessoa: ' + name + ' (' + role + ')\n' +
                    (phone ? ('Telefone: ' + phone + '\n') : '') +
                    'Aberto em: ' + createdAt + '\n' +
                    (updatedText ? (updatedText + '\n') : '') +
                    (locationText ? ('Localização: ' + locationText + '\n') : '') +
                    (mapsLink ? ('Maps: ' + mapsLink + '\n') : '');

                try { await copyText(msg); } catch(err) {}
                return;
            }
        });

        async function refreshEmergencies() {
            try {
                const resp = await fetch('<?php echo URL_ROOT; ?>/admin/emergencias-open');
                const data = await resp.json();
                const items = data.items || [];

                items.forEach((it) => {
                    const locEl = document.querySelector('[data-alert-location="' + it.id + '"]');
                    const updEl = document.querySelector('[data-alert-updated="' + it.id + '"]');
                    const mapsEl = document.querySelector('[data-alert-maps="' + it.id + '"]');

                    if(updEl && it.updated_at) {
                        updEl.textContent = 'Última atualização: ' + it.updated_at;
                    }

                    if(locEl) {
                        if(it.lat && it.lng) {
                            locEl.className = 'text-gray-700 mt-1';
                            locEl.innerHTML = '<i class="fas fa-location-dot mr-2"></i>' + it.lat + ', ' + it.lng;
                        } else {
                            locEl.className = 'text-gray-500 mt-1';
                            locEl.textContent = 'Localização não informada (permissão negada ou indisponível)';
                        }
                    }

                    if(mapsEl && it.lat && it.lng) {
                        mapsEl.href = 'https://www.google.com/maps?q=' + encodeURIComponent(it.lat + ',' + it.lng);
                    }
                });
            } catch(e) {
            }
        }

        refreshEmergencies();
        setInterval(refreshEmergencies, 60000);
    })();
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>
