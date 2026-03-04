<?php $__env->startSection('title', 'Modifier le Membre'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="<?php echo e(route('admin.team.index')); ?>" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-1"></i> Retour à l'équipe
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Modifier : <?php echo e($member->name['es'] ?? 'Membre'); ?></h2>
            </div>
            
            <form action="<?php echo e(route('admin.team.update', $member)); ?>" method="POST" enctype="multipart/form-data" class="p-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" value="<?php echo e(old('email', $member->email)); ?>" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Téléphone</label>
                        <input type="text" name="phone" value="<?php echo e(old('phone', $member->phone)); ?>" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Ordre</label>
                        <input type="number" name="order" value="<?php echo e(old('order', $member->order)); ?>" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Catégorie</label>
                        <select name="category" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                            <option value="">Sélectionnez une catégorie</option>
                            <?php $__currentLoopData = App\Models\TeamMember::CATEGORIES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e(old('category', $member->category) === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Statut</label>
                         <label class="flex items-center mt-2">
                            <input type="checkbox" name="active" value="1" <?php echo e(old('active', $member->active) ? 'checked' : ''); ?> class="form-checkbox h-5 w-5 text-teal-600">
                            <span class="ml-2 text-gray-700">Actif</span>
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Photo</label>
                    <?php if($member->photo): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('storage/' . $member->photo)); ?>" alt="Photo actuelle" class="h-32 rounded-full object-cover">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="photo" class="w-full px-3 py-2 border rounded border-gray-300">
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
                        <label class="block text-gray-700 font-bold mb-2">Nom (<?php echo e(strtoupper($lang)); ?>)</label>
                        <input type="text" name="name[<?php echo e($lang); ?>]" value="<?php echo e(old('name.'.$lang, $member->name[$lang] ?? '')); ?>" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Poste (<?php echo e(strtoupper($lang)); ?>)</label>
                        <input type="text" name="position[<?php echo e($lang); ?>]" value="<?php echo e(old('position.'.$lang, $member->position[$lang] ?? '')); ?>" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Biographie (<?php echo e(strtoupper($lang)); ?>)</label>
                        <textarea name="bio[<?php echo e($lang); ?>]" rows="5" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500"><?php echo e(old('bio.'.$lang, $member->bio[$lang] ?? '')); ?></textarea>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        document.querySelectorAll('textarea[name^="bio"]').forEach(textarea => {
            ClassicEditor
                .create(textarea, {
                    toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
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
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Projets\Gombo\NovisiElKartea\resources\views\admin\team\edit.blade.php ENDPATH**/ ?>