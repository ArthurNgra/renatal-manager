<?php $folder = isset($folder) ? $folder : null; ?>
<?php $branch = isset($branch) ? $branch : null; ?>
<?php $__container->servers(['remote' => '871m4e_arthur@871m4e.ftp.infomaniak.com']); ?>
<?php
$branch = 'master';
$folder = '~/sites/backline.onebigcartel.com/renatal-manager';
?>
<?php $__container->startTask('test', ['on' => 'remote']); ?>

echo "testing...";
<?php $__container->endTask(); ?>

<?php $__container->startMacro(); ?>

<?php $__container->endMacro(); ?>

<?php $__container->startTask('artisan', ['on' => 'web']); ?>
cd <?php echo $folder; ?>


php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
<?php $__container->endTask(); ?>
