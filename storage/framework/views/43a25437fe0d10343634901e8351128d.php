<?php $__env->startSection('title', __('header.contact')); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen">
    
    <section class="relative pt-12 md:pt-16 pb-12 bg-teal-900 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-teal-900 via-teal-800 to-teal-900 opacity-90"></div>
            
            <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -ml-32 -mt-32"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full -mr-48 -mb-48"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center" data-aos="fade-down">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 uppercase tracking-tight">
                <?php echo e(__('header.contact')); ?>

            </h1>
            <div class="w-20 h-1.5 bg-orange-500 mx-auto rounded-full"></div>
        </div>
    </section>

    <div class="container mx-auto px-4 -mt-16 relative z-20 pb-12">
        <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-5/12" data-aos="fade-right">
                <div class="bg-white rounded-[2.5rem] shadow-2xl p-8 md:p-12 h-full border border-gray-100">
                    <h2 class="text-2xl font-bold text-teal-900 mb-8 border-b border-gray-100 pb-4">
                        <?php echo e(__('messages.questions_title')); ?>

                    </h2>

                    <div class="space-y-8">
                        
                        <?php if($settings['contact_email'] ?? false): ?>
                        <div class="flex items-start group">
                            <div class="w-12 h-12 bg-teal-50 rounded-2xl flex items-center justify-center mr-5 group-hover:bg-teal-100 transition-colors">
                                <i class="fas fa-envelope text-teal-600"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Email</p>
                                <a href="mailto:<?php echo e($settings['contact_email']); ?>" class="text-gray-700 font-bold hover:text-teal-600 transition-colors break-all">
                                    <?php echo e($settings['contact_email']); ?>

                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        
                        <?php if($settings['contact_phone'] ?? false): ?>
                        <div class="flex items-start group">
                            <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center mr-5 group-hover:bg-orange-100 transition-colors">
                                <i class="fas fa-phone text-orange-600"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Tel / WhatsApp</p>
                                <a href="tel:<?php echo e($settings['contact_phone']); ?>" class="text-gray-700 font-bold hover:text-teal-600 transition-colors">
                                    <?php echo e($settings['contact_phone']); ?>

                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        
                        <?php if($settings['contact_address'] ?? false): ?>
                        <div class="flex items-start group">
                            <div class="w-12 h-12 bg-teal-50 rounded-2xl flex items-center justify-center mr-5 group-hover:bg-teal-100 transition-colors">
                                <i class="fas fa-map-marker-alt text-teal-600"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Domicilio</p>
                                <p class="text-gray-700 font-bold leading-relaxed">
                                    <?php echo e($settings['contact_address']); ?><br>
                                    <?php if($settings['contact_zip'] ?? false): ?> <?php echo e($settings['contact_zip']); ?> <?php endif; ?>
                                    <?php if($settings['contact_municipality'] ?? false): ?> <?php echo e($settings['contact_municipality']); ?> <?php endif; ?><br>
                                    <?php if($settings['contact_territory'] ?? false): ?> <?php echo e($settings['contact_territory']); ?> <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-100">
                        <p class="text-gray-500 text-sm leading-relaxed italic">
                            <?php echo e(__('messages.questions_subtitle')); ?>

                        </p>
                    </div>
                </div>
            </div>

            
            <div class="w-full lg:w-7/12" data-aos="fade-left">
                <div class="bg-white rounded-[2.5rem] shadow-2xl p-8 md:p-12 border border-gray-100">
                    <h2 class="text-2xl font-bold text-teal-900 mb-8 border-b border-gray-100 pb-4">
                        <?php echo e(__('contact.title')); ?>

                    </h2>

                    <?php if(session('success')): ?>
                    <div class="mb-8 p-4 bg-teal-50 text-teal-700 rounded-2xl border border-teal-100 flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <?php echo e(session('success')); ?>

                    </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('contact.store')); ?>" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-2"><?php echo e(__('join.label_name')); ?></label>
                                <input type="text" id="name" name="name" required placeholder="<?php echo e(__('join.placeholder_name')); ?>"
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 transition-all outline-none text-gray-700">
                            </div>
                            <div class="form-group">
                                <label for="email" class="block text-sm font-bold text-gray-700 mb-2"><?php echo e(__('join.label_email')); ?></label>
                                <input type="email" id="email" name="email" required placeholder="<?php echo e(__('join.placeholder_email')); ?>"
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 transition-all outline-none text-gray-700">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="block text-sm font-bold text-gray-700 mb-2"><?php echo e(__('join.label_message')); ?></label>
                            <textarea id="message" name="message" rows="6" required placeholder="<?php echo e(__('join.placeholder_message')); ?>"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 transition-all outline-none text-gray-700 resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-5 px-8 rounded-2xl shadow-lg shadow-orange-500/20 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3">
                            <?php echo e(__('buttons.submit')); ?>

                            <i class="fas fa-paper-plane text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Projets\Gombo\NovisiElKartea\resources\views\contact\index.blade.php ENDPATH**/ ?>