<?php $__env->startSection('title', __('about.who_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="overflow-hidden">
    
    <section class="relative min-h-[60vh] flex items-center justify-center pt-12 md:pt-16">
        
        <?php if(isset($page) && $page->featured_image): ?>
        <div class="absolute inset-0 z-0">
            <img src="<?php echo e(asset('storage/' . $page->featured_image)); ?>" class="w-full h-full object-cover" alt="<?php echo e(__('about.who_title')); ?>">
            <div class="absolute inset-0 bg-gradient-to-r from-teal-900/90 to-teal-800/60 mix-blend-multiply"></div>
        </div>
        <?php else: ?>
        <div class="absolute inset-0 bg-gradient-to-br from-teal-900 to-[#00695c] z-0"></div>
        <?php endif; ?>

        
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] transform rotate-180 z-10">
            <svg class="relative block w-[calc(100%+1.3px)] h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-white"></path>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-20 text-white py-12">
            <div class="max-w-4xl">
                <nav class="flex mb-4 text-teal-200 text-sm font-medium animate-fade-in-down">
                    <a href="<?php echo e(route('home')); ?>" class="hover:underline"><?php echo e(__('header.home')); ?></a>
                    <span class="mx-2">/</span>
                    <span><?php echo e(__('header.about')); ?></span>
                </nav>
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight animate-fade-in-up" data-aos="fade-down" data-aos-duration="1000">
                    <?php echo e(__('about.who_title')); ?>

                </h1>
                <div class="w-20 h-1.5 bg-[#ff9800] rounded-full animate-width-grow"></div>
            </div>
        </div>
    </section>
</div>

<div class="container mx-auto px-4 py-12">
    <?php $__currentLoopData = ['board', 'technical']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(isset($members[$category])): ?>
    <section class="mb-12 overflow-hidden">
        <h2 class="text-3xl font-bold text-teal-800 mb-6 text-center uppercase tracking-wider" data-aos="fade-up">
            <?php echo e($category === 'board' ? __('messages.board_directors') : __('messages.technical_team')); ?>

        </h2>

        <?php if($category === 'board'): ?>
        <div class="mb-12 text-center text-lg text-gray-700" data-aos="fade-up" data-aos-delay="100">
            <p><?php echo e(__('about.board_intro')); ?></p>
        </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php $__currentLoopData = $members[$category]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform hover:scale-105 duration-300"
                data-aos="zoom-in" data-aos-delay="<?php echo e(($idx % 4) * 150); ?>">
                <div class="aspect-[4/5] overflow-hidden bg-gray-100">
                    <?php if($member->photo): ?>
                    <img src="<?php echo e(asset('storage/' . $member->photo)); ?>" class="w-full h-full object-cover object-top premium-contour" alt="<?php echo e($member->name[app()->getLocale()] ?? $member->name['es']); ?>">
                    <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="fas fa-user-circle text-7xl"></i>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 mb-2 text-center"><?php echo e($member->name[app()->getLocale()] ?? $member->name['es']); ?></h3>
                    <p class="text-orange-600 font-semibold mb-4 text-center"><?php echo e($member->position[app()->getLocale()] ?? $member->position['es']); ?></p>
                    <?php if($member->bio && isset($member->bio[app()->getLocale()])): ?>
                    <div class="text-gray-600 text-sm italic content-justified"><?php echo $member->bio[app()->getLocale()]; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in-down {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes width-grow {
        from {
            width: 0;
        }

        to {
            width: 5rem;
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }

    .animate-fade-in-down {
        animation: fade-in-down 0.8s ease-out forwards;
    }

    .animate-fade-in {
        animation: fade-in 1s ease-out forwards;
    }

    .animate-width-grow {
        animation: width-grow 1s ease-out forwards;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Projets\Gombo\NovisiElKartea\resources\views\about\who.blade.php ENDPATH**/ ?>