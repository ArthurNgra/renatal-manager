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
php-8.2 artisan config:cache
php-8.2 artisan route:cache
php-8.2 artisan view:cache
@endtask

@task('update', ['on' => 'remote'])
cd {{ $folder }}
composer update
@endtask


@task('cmd', ['on' => 'remote'])
cd {{ $folder }}
php artisan invoice-due

@endtask

