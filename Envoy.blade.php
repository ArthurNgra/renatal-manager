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
git stash
git pull
@endtask

@task('artisan', ['on' => 'remote'])
cd {{ $folder }}
git stash
git pull
composer_php8.2  install --optimize-autoloader --no-dev
composer_php8.2 fund
php-8.2 artisan cache:clear

php-8.2 artisan config:cache
php-8.2 artisan route:cache
php-8.2 artisan view:cache

@endtask

@task('update', ['on' => 'remote'])
cd {{ $folder }}
composer_php8.2  update

@endtask


@task('cmd', ['on' => 'remote'])
cd {{ $folder }}
php artisan invoice-due
@endtask

@story('deploy')
 pull
 update
 artisan
@endstory
