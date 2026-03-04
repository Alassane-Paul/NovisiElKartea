<?php $__env->startSection('title', 'Nouvelle Traduction'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="<?php echo e(route('admin.translations.index')); ?>" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-1"></i> Retour
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Ajouter une traduction</h2>
            </div>
            
            <form action="<?php echo e(route('admin.translations.store')); ?>" method="POST" class="p-6">
                <?php echo csrf_field(); ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Groupe</label>
                        <input type="text" name="group" value="<?php echo e(old('group')); ?>" placeholder="ex: header, auth, validation" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Clé</label>
                        <input type="text" name="key" value="<?php echo e(old('key')); ?>" placeholder="ex: welcome_message" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Notes (Contexte)</label>
                    <textarea name="notes" rows="2" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500"><?php echo e(old('notes')); ?></textarea>
                </div>

                <!-- Tabs Langues -->
                <div class="mb-6 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="langTabs">
                        <?php $__currentLoopData = ['es', 'fr', 'eu', 'en']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mr-2">
                            <button type="button" onclick="switchLang('<?php echo e($lang); ?>')" class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 <?php echo e($lang === 'es' ? 'text-teal-600 border-teal-600' : 'border-transparent'); ?>" id="tab-<?php echo e($lang); ?>">
                                <?php echo e(strtoupper($lang)); ?>

                            </button>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <?php $__currentLoopData = ['es', 'fr', 'eu', 'en']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div id="content-<?php echo e($lang); ?>" class="<?php echo e($lang === 'es' ? '' : 'hidden'); ?> lang-content">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Traduction (<?php echo e(strtoupper($lang)); ?>)</label>
                        <textarea name="text[<?php echo e($lang); ?>]" rows="5" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500"><?php echo e(old('text.'.$lang)); ?></textarea>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                        Créer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchLang(lang) {
            document.querySelectorAll('.lang-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('#langTabs button').forEach(el => {
                el.classList.remove('text-teal-600', 'border-teal-600');
                el.classList.add('border-transparent');
            });
            document.getElementById('content-' + lang).classList.remove('hidden');
            const tab = document.getElementById('tab-' + lang);
            tab.classList.remove('border-transparent');
            tab.classList.add('text-teal-600', 'border-teal-600');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Projets\Gombo\NovisiElKartea\resources\views\admin\translations\create.blade.php ENDPATH**/ ?>