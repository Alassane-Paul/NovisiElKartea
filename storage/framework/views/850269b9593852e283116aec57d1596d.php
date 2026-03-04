<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Novisi Elkartea</title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-teal-900 text-white flex flex-col">
            <div class="h-16 flex items-center justify-center border-b border-teal-800">
                <span class="text-xl font-bold tracking-wide">Novisi Admin</span>
            </div>

            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1">
                    <li>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center px-6 py-3 hover:bg-teal-800 <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-teal-800 border-l-4 border-orange-500' : ''); ?>">
                            <i class="fas fa-tachometer-alt w-6"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="px-6 py-2 text-xs font-semibold text-teal-200 uppercase tracking-wider mt-4">Contenu</li>

                    <li>
                        <a href="<?php echo e(route('admin.projects.index')); ?>" class="flex items-center px-6 py-3 hover:bg-teal-800 <?php echo e(request()->routeIs('admin.projects.*') ? 'bg-teal-800 border-l-4 border-orange-500' : ''); ?>">
                            <i class="fas fa-project-diagram w-6"></i>
                            <span>Projets</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.services.index')); ?>" class="flex items-center px-6 py-3 hover:bg-teal-800 <?php echo e(request()->routeIs('admin.services.*') ? 'bg-teal-800 border-l-4 border-orange-500' : ''); ?>">
                            <i class="fas fa-hands-helping w-6"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.team.index')); ?>" class="flex items-center px-6 py-3 hover:bg-teal-800 <?php echo e(request()->routeIs('admin.team.*') ? 'bg-teal-800 border-l-4 border-orange-500' : ''); ?>">
                            <i class="fas fa-users w-6"></i>
                            <span>Équipe</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.partners.index')); ?>" class="flex items-center px-6 py-3 hover:bg-teal-800 <?php echo e(request()->routeIs('admin.partners.*') ? 'bg-teal-800 border-l-4 border-orange-500' : ''); ?>">
                            <i class="fas fa-handshake w-6"></i>
                            <span>Partenaires</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.pages.index')); ?>" class="flex items-center px-6 py-3 hover:bg-teal-800 <?php echo e(request()->routeIs('admin.pages.*') ? 'bg-teal-800 border-l-4 border-orange-500' : ''); ?>">
                            <i class="fas fa-file-alt w-6"></i>
                            <span>Pages</span>
                        </a>
                    </li>

                    <li class="px-6 py-2 text-xs font-semibold text-teal-200 uppercase tracking-wider mt-4">Configuration</li>

                    <li>
                        <a href="<?php echo e(route('admin.settings.index')); ?>" class="flex items-center px-6 py-3 hover:bg-teal-800 <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-teal-800 border-l-4 border-orange-500' : ''); ?>">
                            <i class="fas fa-cogs w-6"></i>
                            <span>Paramètres</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.translations.index')); ?>" class="flex items-center px-6 py-3 hover:bg-teal-800 <?php echo e(request()->routeIs('admin.translations.*') ? 'bg-teal-800 border-l-4 border-orange-500' : ''); ?>">
                            <i class="fas fa-language w-6"></i>
                            <span>Traductions</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="p-4 border-t border-teal-800">
                <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="flex items-center px-4 py-2 text-sm text-teal-200 hover:text-white w-full transition-colors">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6">
                <h2 class="text-xl font-semibold text-gray-800"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h2>
                <div class="flex items-center">
                    <span class="text-gray-600 mr-2"><?php echo e(Auth::user()->name); ?></span>
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                        <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            <?php if(session('success')): ?>
            Toast.fire({
                icon: 'success',
                title: "<?php echo e(session('success')); ?>"
            });
            <?php endif; ?>

            <?php if(session('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "<?php echo e(session('error')); ?>",
                confirmButtonColor: '#0d9488'
            });
            <?php endif; ?>

            <?php if(session('warning')): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Attention',
                text: "<?php echo e(session('warning')); ?>",
                confirmButtonColor: '#0d9488'
            });
            <?php endif; ?>

            <?php if(session('info')): ?>
            Toast.fire({
                icon: 'info',
                title: "<?php echo e(session('info')); ?>"
            });
            <?php endif; ?>

            // Override native window.alert
            window.alert = function(message) {
                Swal.fire({
                    text: message,
                    confirmButtonColor: '#0d9488'
                });
            };

            // Override native window.confirm
            window.confirm = function(message) {
                return Swal.fire({
                    text: message,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d9488',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Confirmer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    return result.isConfirmed;
                });
            };

            // Listen for custom events (useful for AJAX or Livewire if added later)
            window.addEventListener('swal:modal', event => {
                Swal.fire({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.icon,
                    confirmButtonColor: '#0d9488'
                });
            });

            window.addEventListener('swal:toast', event => {
                Toast.fire({
                    icon: event.detail.icon,
                    title: event.detail.title
                });
            });
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH D:\Projets\Gombo\NovisiElKartea\resources\views\layouts\admin.blade.php ENDPATH**/ ?>