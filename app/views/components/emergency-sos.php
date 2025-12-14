<?php

$role = $_SESSION['user_role'] ?? '';
if(!isset($_SESSION['user_id']) || ($role !== 'aluno' && $role !== 'instrutor')) {
    return;
}

?>

<button id="emergencySosFab" type="button" class="md:hidden fixed right-5 bottom-20 w-20 h-20 bg-red-600 text-white rounded-full shadow-2xl z-50 flex flex-col items-center justify-center" style="padding-bottom: env(safe-area-inset-bottom);">
    <i class="fas fa-triangle-exclamation text-2xl"></i>
    <span class="text-[10px] leading-tight font-bold mt-1">SOS</span>
</button>

<div id="emergencySosHint" class="md:hidden fixed right-5 bottom-[11.5rem] bg-gray-900 text-white text-xs px-3 py-2 rounded-lg shadow-lg z-50" style="display:none;">
    Toque 2x para confirmar
</div>

<script>
    (function() {
        const fab = document.getElementById('emergencySosFab');
        if(!fab) return;

        const hint = document.getElementById('emergencySosHint');
        let lastTapAt = 0;
        let hintTimer = null;

        function showHint() {
            if(!hint) return;
            hint.style.display = 'block';
            clearTimeout(hintTimer);
            hintTimer = setTimeout(() => { hint.style.display = 'none'; }, 1500);
        }

        fab.addEventListener('click', function() {
            const now = Date.now();
            if(now - lastTapAt <= 700) {
                lastTapAt = 0;
                if(hint) hint.style.display = 'none';

                const btn = document.getElementById('emergencyButton');
                if(btn && !btn.disabled) {
                    btn.click();
                }
                return;
            }

            lastTapAt = now;
            showHint();
        });
    })();
</script>
