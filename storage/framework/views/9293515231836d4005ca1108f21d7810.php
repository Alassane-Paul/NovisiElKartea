<?php $__env->startSection('title', 'Gestion des Traductions'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Traductions de l'interface</h1>
        <div>
            <form action="<?php echo e(route('admin.translations.import')); ?>" method="POST" class="inline-block mr-2" onsubmit="return confirm('Cela va importer les fichiers de langue existants. Continuer ?');">
                <?php echo csrf_field(); ?>
                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-file-import mr-2"></i> Importer
                </button>
            </form>
            <a href="<?php echo e(route('admin.translations.create')); ?>" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i> Nouvelle Traduction
            </a>
        </div>
    </div>

    <!-- Filtres -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form action="<?php echo e(route('admin.translations.index')); ?>" method="GET" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Rechercher une clé ou un texte..." class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
            </div>
            <div>
                <select name="group" class="px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    <option value="">Tous les groupes</option>
                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($group); ?>" <?php echo e(request('group') == $group ? 'selected' : ''); ?>><?php echo e(ucfirst($group)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">
                Filtrer
            </button>
            <?php if(request()->hasAny(['search', 'group'])): ?>
                <a href="<?php echo e(route('admin.translations.index')); ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Reset
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Groupe / Clé</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aperçu (ES)</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__currentLoopData = $translations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $translation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mb-1">
                            <?php echo e($translation->group); ?>

                        </span>
                        <div class="text-sm font-bold text-gray-900"><?php echo e($translation->key); ?></div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 truncate max-w-xs"><?php echo e($translation->text['es'] ?? '-'); ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?php echo e(route('admin.translations.edit', $translation)); ?>" class="text-teal-600 hover:text-teal-900 mr-3">Modifier</a>
                        <form action="<?php echo e(route('admin.translations.destroy', $translation)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr ?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        
        <div class="px-6 py-4 border-t border-gray-200">
            <?php echo e($translations->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Projets\Gombo\NovisiElKartea\resources\views\admin\translations\index.blade.php ENDPATH**/ ?>