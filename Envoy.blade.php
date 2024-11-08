@servers(['remote' => '871m4e_arthur@871m4e.ftp.infomaniak.com'])
@setup
$branch = 'master';
$folder = '~/sites/backline.onebigcartel.com/renatal-manager';
@endsetup
@task('test', ['on' => 'remote'])

echo "testing...";
@endtask

@task('pull', ['on' => 'remote'])
cd {{ $folder }}
git pull
@endtask

@task('artisan', ['on' => 'remote'])
cd {{ $folder }}
composer install --optimize-autoloader
php artisan cache:clear
<<<<<<< HEAD
php artisan config:cache
php artisan route:cache
php artisan view:cache

=======
>>>>>>> a6533aa (add invoice command)
@endtask

@task('update', ['on' => 'remote'])
cd {{ $folder }}
composer update

@endtask
<<<<<<< HEAD

@task('cmd', ['on' => 'remote'])
cd {{ $folder }}
php artisan invoice-due

@endtask
=======
>>>>>>> a6533aa (add invoice command)
