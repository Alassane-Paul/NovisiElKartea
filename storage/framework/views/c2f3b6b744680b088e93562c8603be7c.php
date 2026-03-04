<?php $__env->startSection('title', __('Contact')); ?>

<?php $__env->startSection('content'); ?>
<div class="contact-form">
    <h1><?php echo e(__('contact.title')); ?></h1>
    
    <form method="POST" action="<?php echo e(route('contact.store')); ?>">
        <?php echo csrf_field(); ?>
        
        <div class="form-group">
            <label for="name"><?php echo e(__('forms.name')); ?></label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email"><?php echo e(__('forms.email')); ?></label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="message"><?php echo e(__('forms.message')); ?></label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        
        <button type="submit" class="btn-submit">
            <?php echo e(__('buttons.send')); ?>

        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Projets\Gombo\NovisiElKartea\resources\views\contact.blade.php ENDPATH**/ ?>