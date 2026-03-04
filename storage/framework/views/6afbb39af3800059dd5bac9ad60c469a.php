<?php $__env->startSection('title', 'Nouveau Service'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="<?php echo e(route('admin.services.index')); ?>" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left mr-1"></i> Retour aux services
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Créer un nouveau service</h2>
        </div>

        <form action="<?php echo e(route('admin.services.store')); ?>" method="POST" enctype="multipart/form-data" class="p-6">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Catégorie (Section)</label>
                    <select name="category" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                        <option value="">-- Sélectionner une catégorie --</option>
                        <?php $__currentLoopData = App\Models\Service::CATEGORIES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(old('category') === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Slug (URL unique)</label>
                    <input type="text" name="slug" id="slug" value="<?php echo e(old('slug')); ?>" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
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
                    <label class="block text-gray-700 font-bold mb-2">Icone</label>
                    <select name="icon" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                        <?php
                        $icons = [
                        'fas fa-graduation-cap' => 'Éducation',
                        'fas fa-book' => 'Livre',
                        'fas fa-hands-helping' => 'Solidarité',
                        'fas fa-globe' => 'Monde',
                        'fas fa-theater-masks' => 'Culture',
                        'fas fa-paint-brush' => 'Art',
                        'fas fa-users' => 'Social',
                        'fas fa-users-cog' => 'Asociacionismo',
                        'fas fa-balance-scale' => 'Égalité',
                        'fas fa-unisex' => 'Droits Humains',
                        'fas fa-hand-holding-heart' => 'Coopération',
                        'fas fa-seedling' => 'Développement',
                        ];
                        ?>
                        <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($class); ?>" <?php echo e(old('icon') === $class ? 'selected' : ''); ?>><?php echo e($name); ?> (<?php echo e($class); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Ordre</label>
                    <input type="number" name="order" value="<?php echo e(old('order', 0)); ?>" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Statut</label>
                    <label class="flex items-center mt-2">
                        <input type="checkbox" name="active" value="1" <?php echo e(old('active', 1) ? 'checked' : ''); ?> class="form-checkbox h-5 w-5 text-teal-600">
                        <span class="ml-2 text-gray-700">Actif</span>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Image</label>
                <input type="file" name="image" class="w-full px-3 py-2 border rounded border-gray-300">
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
                    <label class="block text-gray-700 font-bold mb-2">Titre (<?php echo e(strtoupper($lang)); ?>)</label>
                    <input type="text" name="title[<?php echo e($lang); ?>]" value="<?php echo e(old('title.'.$lang)); ?>" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Description courte (<?php echo e(strtoupper($lang)); ?>)</label>
                    <textarea name="description[<?php echo e($lang); ?>]" rows="3" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500"><?php echo e(old('description.'.$lang)); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Contenu (<?php echo e(strtoupper($lang)); ?>)</label>
                    <textarea name="content[<?php echo e($lang); ?>]" rows="10" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500"><?php echo e(old('content.'.$lang)); ?></textarea>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Créer le Service
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

    // Auto-slugify from Spanish title
    const titleEs = document.querySelector('input[name="title[es]"]');
    const slugInput = document.getElementById('slug');

    if (titleEs && slugInput) {
        titleEs.addEventListener('input', function() {
            const slug = this.value
                .toLowerCase()
                .trim()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-0 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            slugInput.value = slug;
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Projets\Gombo\NovisiElKartea\resources\views\admin\services\create.blade.php ENDPATH**/ ?>