<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'assaig-backoffice');

// Project repository
set('repository', 'git@github.com:Assaig-2DAW/assaig-backoffice.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts
// De momento se debe cambiar el host con el DNS del servidor PHP cada vez que éste cambie
host('ec2-54-144-199-198.compute-1.amazonaws.com')
    ->user('backoffice_dev')
    ->identityFile('~/.ssh/id_rsa.pub')
    ->set('deploy_path', '/var/www/assaig-backoffice/html');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Crea automáticamente el fichero .env en el servidor
/*task('upload:env', function () {
    upload('.env.develop', '{{deploy_path}}/shared/.env');
})->desc('Environment setup');
*/
// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate:fresh');


task('composer:update', function (){
    run('cd /var/www/assaig-backoffice/html/current && sudo apt install php8.1-intl');
    run('cd /var/www/assaig-backoffice/html/current && composer update');
    //run('cd /var/www/assaig-backoffice/html/current && php artisan db:seed');
});

task('reload:php-fpm', function(){
    run('sudo /etc/init.d/php8.1-fpm restart');
});

task('rsync_function', function (){
    run('rsync -avz -e "ssh -i /home/backoffice_dev/.ssh/nginx" --include="*.html" --include="*.css" --include="*.jpg" --include="*.jpeg" --include="*.png" --exclude="*" /var/www/assaig-backoffice/html backoffice_dev@54.85.146.153:/var/www/assaig-backoffice/');
});

task('artisan:queue:work', function () {
    run('cd /var/www/assaig-backoffice/html/current && php artisan queue:work --queue=default --tries=3');
});

after('deploy', 'composer:update');

after('deploy', 'reload:php-fpm');

after('deploy', 'rsync_function');

//after('deploy', 'artisan:queue:work');

