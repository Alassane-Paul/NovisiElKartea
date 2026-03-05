<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title', $settings['site_name'] ?? 'Novisi Elkartea'); ?></title>

    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', $settings['seo_description'] ?? 'Asociación Novisi Elkartea - Cooperación, Cultura e Interculturalidad en Vitoria-Gasteiz.'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', $settings['seo_keywords'] ?? 'cooperación, cultura, interculturalidad, vitoria-gasteiz, novisi'); ?>">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', $settings['site_name'] ?? 'Novisi Elkartea'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta_description', $settings['seo_description'] ?? 'Asociación Novisi Elkartea - Cooperación, Cultura e Interculturalidad en Vitoria-Gasteiz.'); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('storage/' . ($settings['site_logo'] ?? 'images/logo.png'))); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta property="twitter:title" content="<?php echo $__env->yieldContent('title', $settings['site_name'] ?? 'Novisi Elkartea'); ?>">
    <meta property="twitter:description" content="<?php echo $__env->yieldContent('meta_description', $settings['seo_description'] ?? 'Asociación Novisi Elkartea - Cooperación, Cultura e Interculturalidad en Vitoria-Gasteiz.'); ?>">
    <meta property="twitter:image" content="<?php echo $__env->yieldContent('og_image', asset('storage/' . ($settings['site_logo'] ?? 'images/logo.png'))); ?>">

    <!-- FontAwesome pour icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
    <header class="w-full bg-white shadow-md fixed top-0 left-0 z-50">
        <!-- Top Bar -->
        <div class="bg-[#e0f2f1] py-2 border-b border-gray-200">
            <div class="container mx-auto px-4 flex justify-between items-center text-xs font-semibold tracking-wide">
                <!-- Langues -->
                <div class="flex space-x-3 text-gray-600">
                    <?php $__currentLoopData = ['es' => 'ES', 'eu' => 'EUS', 'fr' => 'FR', 'en' => 'EN']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('lang.switch', $code)); ?>"
                        class="<?php echo e(app()->getLocale() === $code ? 'text-[#009688] font-bold underline' : 'hover:text-[#009688] transition-colors'); ?>">
                        <?php echo e($label); ?>

                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!-- Réseaux Sociaux -->
                <div class="flex space-x-4 text-gray-500">
                    <?php $__currentLoopData = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'tiktok', 'pinterest', 'whatsapp', 'telegram', 'snapchat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(($settings["social_{$key}_active"] ?? false) && ($settings["social_{$key}_url"] ?? '#') !== '#'): ?>
                    <a href="<?php echo e($settings["social_{$key}_url"]); ?>" target="_blank" rel="noopener noreferrer" class="hover:text-[#009688] transition-colors">
                        <i class="fab fa-<?php echo e($key === 'twitter' ? 'x-twitter' : ($key === 'linkedin' ? 'linkedin-in' : $key)); ?>"></i>
                    </a>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Main Navbar -->
        <div class="container mx-auto px-4 py-3 flex justify-between items-center bg-white">
            <!-- Logo -->
            <a href="<?php echo e(route('home')); ?>" class="flex-shrink-0">
                <?php if($settings['site_logo'] ?? false): ?>
                <img src="<?php echo e(asset('storage/' . $settings['site_logo'])); ?>" alt="<?php echo e($settings['site_name'] ?? 'Novisi Elkartea'); ?>" class="h-12 md:h-16 w-auto object-contain">
                <?php else: ?>
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="<?php echo e($settings['site_name'] ?? 'Novisi Elkartea'); ?>" class="h-12 md:h-16 w-auto object-contain" onerror="this.src='https://via.placeholder.com/150x60?text=<?php echo e(urlencode($settings['site_name'] ?? 'Novisi Elkartea')); ?>'">
                <?php endif; ?>
            </a>

            <!-- Navigation Desktop -->
            <nav class="hidden md:flex space-x-6 lg:space-x-10 items-center font-medium text-gray-700 text-sm lg:text-base">

                <!-- Conocernos Dropdown -->
                <div class="relative group">
                    <button class="flex items-center hover:text-[#009688] focus:outline-none py-4 transition-colors">
                        <?php echo e(__('header.about')); ?> <i class="fas fa-chevron-down ml-1 text-[10px] text-gray-400 group-hover:text-[#009688]"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute left-0 top-full mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-b-lg hidden group-hover:block z-50 transform origin-top transition-all duration-200">
                        <div class="py-2">
                            <a href="<?php echo e(route('about.what')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.about_what')); ?></a>
                            <a href="<?php echo e(route('about.who')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.about_who')); ?></a>
                            <a href="<?php echo e(route('about.partners')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.about_partners')); ?></a>
                        </div>
                    </div>
                </div>

                <!-- Qué Hacemos Dropdown -->
                <div class="relative group">
                    <button class="flex items-center hover:text-[#009688] focus:outline-none py-4 transition-colors">
                        <?php echo e(__('header.services')); ?> <i class="fas fa-chevron-down ml-1 text-[10px] text-gray-400 group-hover:text-[#009688]"></i>
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-64 bg-white border border-gray-100 shadow-xl rounded-b-lg hidden group-hover:block z-50">
                        <div class="py-2">
                            <a href="<?php echo e(route('services.index')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688] font-bold border-b border-gray-50"><?php echo e(__('header.services_all')); ?></a>
                            <a href="<?php echo e(route('services.education')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.services_education')); ?></a>
                            <a href="<?php echo e(route('services.intercultural')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.services_intercultural')); ?></a>
                            <a href="<?php echo e(route('services.culture')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.services_culture')); ?></a>
                            <a href="<?php echo e(route('services.participation')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.services_participation')); ?></a>
                            <a href="<?php echo e(route('services.equality')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.services_equality')); ?></a>
                            <a href="<?php echo e(route('services.cooperation')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.services_cooperation')); ?></a>
                        </div>
                    </div>
                </div>

                <!-- Proyectos Dropdown -->
                <div class="relative group">
                    <button class="flex items-center hover:text-[#009688] focus:outline-none py-4 transition-colors">
                        <?php echo e(__('header.projects')); ?> <i class="fas fa-chevron-down ml-1 text-[10px] text-gray-400 group-hover:text-[#009688]"></i>
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-b-lg hidden group-hover:block z-50">
                        <div class="py-2">
                            <a href="<?php echo e(route('projects.show', 'afrikarte')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.projects_afrikarte')); ?></a>
                            <a href="<?php echo e(route('projects.show', 'diversidad')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.projects_diversity')); ?></a>
                            <a href="<?php echo e(route('projects.show', 'igualdad')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.projects_equality')); ?></a>
                            <a href="<?php echo e(route('projects.show', 'new-generation')); ?>" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]"><?php echo e(__('header.projects_new_generation')); ?></a>
                        </div>
                    </div>
                </div>

                <a href="<?php echo e(route('contact.index')); ?>" class="hover:text-[#009688] transition-colors py-4"><?php echo e(__('header.contact')); ?></a>
            </nav>

            <!-- CTA Button -->
            <a id="cta-join-btn" href="<?php echo e(route('join.index')); ?>" class="hidden md:inline-flex items-center justify-center bg-[#ff9800] hover:bg-[#f57c00] text-white font-bold py-2.5 px-6 rounded shadow-md transition-all duration-300 uppercase tracking-wider text-sm transform hover:-translate-y-0.5 animate-pulse-premium">
                <?php echo e(__('header.join') ?? 'ASÓCIATE'); ?>

            </a>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn"
                type="button"
                class="md:hidden text-gray-700 hover:text-[#009688] focus:outline-none p-2 rounded-md hover:bg-gray-50 relative z-[9999]"
                aria-label="Toggle menu">
                <i id="mobile-menu-icon" class="fas fa-bars text-xl transition-transform duration-300"></i>
            </button>
        </div>

        <!-- Mobile Menu Drawer (Slide-in) -->
        <div id="mobile-menu-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[9997] hidden transition-opacity duration-300 pointer-events-none opacity-0"></div>
        <div id="mobile-menu" class="fixed top-0 left-0 w-[280px] h-full bg-white z-[9998] shadow-2xl transform -translate-x-full transition-all duration-300 ease-out hidden">
            <div class="flex flex-col h-full pt-16">

                <div class="flex-grow overflow-y-auto py-6" style="-webkit-overflow-scrolling: touch;">
                    <a href="<?php echo e(route('home')); ?>"
                        class="block px-8 py-4 font-semibold transition-colors <?php echo e(request()->routeIs('home') ? 'text-teal-600 bg-teal-50 border-r-4 border-teal-600' : 'text-gray-700 hover:bg-teal-50 hover:text-teal-600'); ?> text-lg">
                        <?php echo e(__('header.home')); ?>

                    </a>

                    <div class="px-8 py-4">
                        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4"><?php echo e(__('header.about')); ?></div>
                        <div class="space-y-1 ml-2 border-l border-gray-100">
                            <a href="<?php echo e(route('about.what')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->routeIs('about.what') ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.about_what')); ?>

                            </a>
                            <a href="<?php echo e(route('about.who')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->routeIs('about.who') ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.about_who')); ?>

                            </a>
                            <a href="<?php echo e(route('about.partners')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->routeIs('about.partners') ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.about_partners')); ?>

                            </a>
                        </div>
                    </div>

                    <div class="px-8 py-4">
                        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4"><?php echo e(__('header.services')); ?></div>
                        <div class="space-y-1 ml-2 border-l border-gray-100">
                            <a href="<?php echo e(route('services.index')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->routeIs('services.index') ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base border-b border-gray-50 pb-3 mb-2">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.services_all')); ?>

                            </a>
                            <a href="<?php echo e(route('services.education')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->routeIs('services.education') ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.services_education')); ?>

                            </a>
                            <a href="<?php echo e(route('services.intercultural')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->routeIs('services.intercultural') ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.services_intercultural')); ?>

                            </a>
                            <a href="<?php echo e(route('services.culture')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->routeIs('services.culture') ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.services_culture')); ?>

                            </a>
                            <a href="<?php echo e(route('services.participation')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->routeIs('services.participation') ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.services_participation')); ?>

                            </a>
                            <a href="<?php echo e(route('services.equality')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->routeIs('services.equality') ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.services_equality')); ?>

                            </a>
                            <a href="<?php echo e(route('services.cooperation')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->routeIs('services.cooperation') ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.services_cooperation')); ?>

                            </a>
                        </div>
                    </div>

                    <div class="px-8 py-4 border-b border-gray-50 mb-4">
                        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4"><?php echo e(__('header.projects')); ?></div>
                        <div class="space-y-1 ml-2 border-l border-gray-100">
                            <a href="<?php echo e(route('projects.show', 'afrikarte')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->fullUrlIs(route('projects.show', 'afrikarte')) ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.projects_afrikarte')); ?>

                            </a>
                            <a href="<?php echo e(route('projects.show', 'diversidad')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->fullUrlIs(route('projects.show', 'diversidad')) ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.projects_diversity')); ?>

                            </a>
                            <a href="<?php echo e(route('projects.show', 'igualdad')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->fullUrlIs(route('projects.show', 'igualdad')) ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.projects_equality')); ?>

                            </a>
                            <a href="<?php echo e(route('projects.show', 'new-generation')); ?>" class="flex items-center gap-3 pl-6 py-2 transition-colors <?php echo e(request()->fullUrlIs(route('projects.show', 'new-generation')) ? 'text-teal-600 font-bold' : 'text-gray-600 hover:text-teal-600'); ?> text-base">
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <?php echo e(__('header.projects_new_generation')); ?>

                            </a>
                        </div>
                    </div>

                    <a href="<?php echo e(route('contact.index')); ?>"
                        class="block px-8 py-4 font-semibold transition-colors <?php echo e(request()->routeIs('contact.index') ? 'text-teal-600 bg-teal-50 border-r-4 border-teal-600' : 'text-gray-700 hover:bg-teal-50 hover:text-teal-600'); ?> text-lg">
                        <?php echo e(__('header.contact')); ?>

                    </a>
                </div>

                <div class="p-6 bg-gray-50">
                    <a href="<?php echo e(route('join.index')); ?>" class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-xl shadow-lg transition-all uppercase tracking-widest text-xs animate-pulse-premium">
                        <?php echo e(__('header.join')); ?>

                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="content-justified pt-[104px] md:pt-[120px]">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-gray-900 text-gray-300 pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- About Section -->
                <div class="text-center md:text-left">
                    <?php if($settings['site_logo'] ?? false): ?>
                    <a href="<?php echo e(route('home')); ?>" class="flex flex-col md:flex-row items-center gap-3 mb-4">
                        <img src="<?php echo e(asset('storage/' . $settings['site_logo'])); ?>" alt="<?php echo e($settings['site_name'] ?? 'Novisi Elkartea'); ?>" class="h-10 w-auto object-contain brightness-90">
                        <h3 class="text-xl font-bold text-white"><?php echo e($settings['site_name'] ?? 'Novisi Elkartea'); ?></h3>
                    </a>
                    <?php else: ?>
                    <h3 class="text-xl font-bold text-white mb-4"><?php echo e($settings['site_name'] ?? 'Novisi Elkartea'); ?></h3>
                    <?php endif; ?>
                    <p class="text-sm text-gray-400">
                        <?php echo e(__('footer.description')); ?>

                    </p>
                </div>

                <!-- Contact Info -->
                <div class="text-center md:text-left">
                    <h3 class="text-xl font-bold text-white mb-6 border-b border-gray-800 pb-2 inline-block"><?php echo e(__('footer.contact')); ?></h3>
                    <ul class="space-y-4 text-sm">
                        <?php if($settings['contact_email'] ?? false): ?>
                        <li class="flex items-center justify-center md:justify-start group">
                            <div class="w-8 h-8 bg-teal-500/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-teal-500/20 transition-colors">
                                <i class="fas fa-envelope text-teal-400"></i>
                            </div>
                            <a href="mailto:<?php echo e($settings['contact_email']); ?>" class="hover:text-teal-400 transition-colors"><?php echo e($settings['contact_email']); ?></a>
                        </li>
                        <?php endif; ?>

                        <?php if($settings['contact_phone'] ?? false): ?>
                        <li class="flex items-center justify-center md:justify-start group">
                            <div class="w-8 h-8 bg-orange-500/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-orange-500/20 transition-colors">
                                <i class="fas fa-phone text-orange-400"></i>
                            </div>
                            <a href="tel:<?php echo e($settings['contact_phone']); ?>" class="hover:text-teal-400 transition-colors"><?php echo e($settings['contact_phone']); ?></a>
                        </li>
                        <?php endif; ?>

                        <?php if($settings['contact_address'] ?? false): ?>
                        <li class="flex items-start justify-center md:justify-start group">
                            <div class="w-8 h-8 bg-teal-500/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-teal-500/20 transition-colors shrink-0 mt-0.5">
                                <i class="fas fa-map-marker-alt text-teal-400"></i>
                            </div>
                            <div class="text-gray-400 group-hover:text-gray-300 transition-colors">
                                <span class="text-white font-medium"><?php echo e($settings['contact_address']); ?></span><br>
                                <?php if($settings['contact_zip'] ?? false): ?> <?php echo e($settings['contact_zip']); ?> <?php endif; ?>
                                <?php if($settings['contact_municipality'] ?? false): ?> <?php echo e($settings['contact_municipality']); ?> <?php endif; ?>
                                <?php if($settings['contact_territory'] ?? false): ?> (<?php echo e($settings['contact_territory']); ?>) <?php endif; ?>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Social Media -->
                <div class="text-center md:text-left">
                    <h3 class="text-xl font-bold text-white mb-6 border-b border-gray-800 pb-2 inline-block"><?php echo e(__('footer.follow_us')); ?></h3>
                    <div class="flex flex-wrap justify-center md:justify-start gap-4">
                        <?php
                        $brandColors = [
                        'facebook' => 'hover:bg-[#1877F2]',
                        'twitter' => 'hover:bg-[#000000]',
                        'instagram' => 'hover:bg-[#E4405F]',
                        'linkedin' => 'hover:bg-[#0077B5]',
                        'youtube' => 'hover:bg-[#FF0000]',
                        'tiktok' => 'hover:bg-[#000000]',
                        'pinterest' => 'hover:bg-[#BD081C]',
                        'whatsapp' => 'hover:bg-[#25D366]',
                        'telegram' => 'hover:bg-[#0088CC]',
                        'snapchat' => 'hover:bg-[#FFFC00] hover:text-black',
                        ];
                        ?>
                        <?php $__currentLoopData = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'tiktok', 'pinterest', 'whatsapp', 'telegram', 'snapchat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(($settings["social_{$key}_active"] ?? false) && ($settings["social_{$key}_url"] ?? '#') !== '#'): ?>
                        <a href="<?php echo e($settings["social_{$key}_url"]); ?>" target="_blank" rel="noopener noreferrer"
                            class="w-11 h-11 bg-gray-800 rounded-xl flex items-center justify-center text-white transition-all duration-300 transform hover:-translate-y-1 shadow-lg <?php echo e($brandColors[$key] ?? 'hover:bg-teal-600'); ?>">
                            <i class="fab fa-<?php echo e($key === 'twitter' ? 'x-twitter' : ($key === 'linkedin' ? 'linkedin-in' : $key)); ?> text-lg"></i>
                        </a>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 pt-6 text-center text-sm text-gray-500">
                <p>&copy; <?php echo e(date('Y')); ?> <?php echo e($settings['site_name'] ?? 'Novisi Elkartea'); ?>. <?php echo e(__('footer.rights')); ?></p>
            </div>
        </div>
    </footer>

    <?php echo $__env->yieldContent('scripts'); ?>

    <!-- AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Motion One -->
    <script src="https://cdn.jsdelivr.net/npm/motion@10.16.2/dist/motion.js"></script>

    <script>
        // Initialisation AOS
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                easing: 'ease-out-quad',
            });

            // Motion One Animations
            const {
                animate,
                stagger
            } = Motion;

            // Animate Navigation Items
            animate(
                "nav > div, nav > a", {
                    opacity: [0, 1],
                    y: [-20, 0]
                }, {
                    delay: stagger(0.1),
                    duration: 0.8,
                    easing: "ease-out"
                }
            );

            // Pulse effect handled by CSS .animate-pulse-premium

        });

        (function() {
            function init() {
                var btn = document.getElementById('mobile-menu-btn');
                var icon = document.getElementById('mobile-menu-icon');
                var menu = document.getElementById('mobile-menu');
                var backdrop = document.getElementById('mobile-menu-backdrop');
                var isOpen = false;

                if (!btn || !icon || !menu || !backdrop) return;

                function open() {
                    isOpen = true;
                    menu.style.display = 'block';
                    backdrop.style.display = 'block';

                    setTimeout(function() {
                        menu.classList.remove('-translate-x-full');
                        backdrop.classList.add('opacity-100');
                        backdrop.classList.remove('opacity-0');
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    }, 50);

                    document.body.style.overflow = 'hidden';
                }

                function hide() {
                    isOpen = false;
                    menu.classList.add('-translate-x-full');
                    backdrop.classList.remove('opacity-100');
                    backdrop.classList.add('opacity-0');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');

                    setTimeout(function() {
                        menu.style.display = 'none';
                        backdrop.style.display = 'none';
                    }, 300);

                    document.body.style.overflow = '';
                }

                btn.onclick = function(e) {
                    e.preventDefault();
                    if (isOpen) hide();
                    else open();
                };

                backdrop.onclick = hide;
            }

            if (document.readyState === 'complete') {
                init();
            } else {
                window.onload = init;
            }
        })();
    </script>
</body>

</html><?php /**PATH D:\Projets\Gombo\NovisiElKartea\resources\views/layouts/app.blade.php ENDPATH**/ ?>