<?php $__env->startSection('title', 'Nouveau Projet'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="<?php echo e(route('admin.projects.index')); ?>" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left mr-1"></i> Retour aux projets
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Créer un nouveau projet</h2>
        </div>

        <form action="<?php echo e(route('admin.projects.store')); ?>" method="POST" enctype="multipart/form-data" class="p-6">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- General Info -->
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Slug (URL)</label>
                    <select name="slug" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-blue-500">
                        <option value="afrikarte" <?php echo e(old('slug') == 'afrikarte' ? 'selected' : ''); ?>>Afrikarte</option>
                        <option value="diversidad" <?php echo e(old('slug') == 'diversidad' ? 'selected' : ''); ?>>Diversidad</option>
                        <option value="igualdad" <?php echo e(old('slug') == 'igualdad' ? 'selected' : ''); ?>>Igualdad</option>
                        <option value="new-generation" <?php echo e(old('slug') == 'new-generation' ? 'selected' : ''); ?>>New Generation</option>
                    </select>
                    <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Catégorie</label>
                    <select name="category" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-blue-500">
                        <option value="education" <?php echo e(old('category') == 'education' ? 'selected' : ''); ?>>Education</option>
                        <option value="culture" <?php echo e(old('category') == 'culture' ? 'selected' : ''); ?>>Culture</option>
                        <option value="social" <?php echo e(old('category') == 'social' ? 'selected' : ''); ?>>Social</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Statut</label>
                    <select name="status" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-blue-500">
                        <option value="active" <?php echo e(old('status') == 'active' ? 'selected' : ''); ?>>Actif</option>
                        <option value="inactive" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>>Inactif</option>
                    </select>
                </div>

                <div>
                    <label class="flex items-center mt-8">
                        <input type="checkbox" name="featured" value="1" <?php echo e(old('featured') ? 'checked' : ''); ?> class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-700">Mettre en avant</span>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Image principale</label>
                <input type="file" name="image" class="w-full px-3 py-2 border rounded border-gray-300">
            </div>

            <!-- Tabs Langues (Simple implementation) -->
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
                    <label class="block text-gray-700 font-bold mb-2">Titre (<?php echo e(strtoupper($lang)); ?>)</label>
                    <input type="text" name="title[<?php echo e($lang); ?>]" value="<?php echo e(old('title.'.$lang)); ?>" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Description courte (<?php echo e(strtoupper($lang)); ?>)</label>
                    <textarea name="description[<?php echo e($lang); ?>]" rows="5" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500"><?php echo e(old('description.'.$lang)); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Contenu (<?php echo e(strtoupper($lang)); ?>)</label>
                    <textarea name="content[<?php echo e($lang); ?>]" rows="10" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500"><?php echo e(old('content.'.$lang)); ?></textarea>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Créer le Projet
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    document.querySelectorAll('textarea[name^="description"], textarea[name^="content"]').forEach(textarea => {
        ClassicEditor
            .create(textarea, {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });
    });

    function switchLang(lang) {
        // Hide all contents
        document.querySelectorAll('.lang-content').forEach(el => el.classList.add('hidden'));
        // Remove active style from all tabs
        document.querySelectorAll('#langTabs button').forEach(el => {
            el.classList.remove('text-teal-600', 'border-teal-600');
            el.classList.add('border-transparent');
        });

        // Show selected content
        document.getElementById('content-' + lang).classList.remove('hidden');
        // Add active style to selected tab
        const tab = document.getElementById('tab-' + lang);
        tab.classList.remove('border-transparent');
        tab.classList.add('text-teal-600', 'border-teal-600');
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Projets\Gombo\NovisiElKartea\resources\views\admin\projects\create.blade.php ENDPATH**/ ?>