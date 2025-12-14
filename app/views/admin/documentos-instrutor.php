<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">Documentos do Instrutor</h1>
            <p class="text-gray-600 mt-1"><?php echo htmlspecialchars($data['instructor']->name); ?> (<?php echo htmlspecialchars($data['instructor']->email); ?>)</p>
        </div>
        <a href="<?php echo URL_ROOT; ?>/admin/instrutores?status=pendente" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
            <i class="fas fa-arrow-left mr-2"></i>Voltar
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Checklist (baseado nas regras 2025)</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <?php foreach($data['required'] as $key => $label): ?>
                <div class="flex items-center justify-between p-3 rounded-lg border">
                    <div>
                        <div class="font-medium text-gray-900"><?php echo htmlspecialchars($label); ?></div>
                        <div class="text-gray-500"><?php echo htmlspecialchars($key); ?></div>
                    </div>
                    <?php if(!empty($data['required_status'][$key]) && $data['required_status'][$key] === true): ?>
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">Aprovado</span>
                    <?php else: ?>
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">Pendente</span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if(empty($data['documents'])): ?>
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <i class="fas fa-file-alt text-gray-400 text-6xl mb-4"></i>
            <p class="text-xl text-gray-600">Nenhum documento enviado ainda</p>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arquivo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach($data['documents'] as $doc): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($data['labels'][$doc->doc_type] ?? $doc->doc_type); ?></div>
                                <div class="text-xs text-gray-500"><?php echo htmlspecialchars($doc->doc_type); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a class="text-blue-600 hover:underline" target="_blank" rel="noopener noreferrer" href="<?php echo URL_ROOT . '/public/uploads/' . $doc->file_path; ?>">
                                    <i class="fas fa-download mr-2"></i>Ver/baixar
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($doc->status === 'aprovado'): ?>
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">Aprovado</span>
                                <?php elseif($doc->status === 'rejeitado'): ?>
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">Rejeitado</span>
                                <?php else: ?>
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">Pendente</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-700"><?php echo htmlspecialchars($doc->admin_notes ?? ''); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form class="flex flex-col gap-2" action="<?php echo URL_ROOT; ?>/admin/atualizarDocumento/<?php echo $doc->id; ?>" method="POST">
                                    <input type="text" name="admin_notes" class="px-3 py-2 border rounded-lg" placeholder="Nota (opcional)" value="<?php echo htmlspecialchars($doc->admin_notes ?? ''); ?>">
                                    <div class="flex gap-3">
                                        <button name="action" value="aprovar" class="text-green-700 hover:text-green-900">
                                            <i class="fas fa-check"></i> Aprovar
                                        </button>
                                        <button name="action" value="rejeitar" class="text-red-700 hover:text-red-900">
                                            <i class="fas fa-times"></i> Rejeitar
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
