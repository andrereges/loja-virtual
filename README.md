Projeto desenvolvido para teste de programador Mobly

Criar um base de dados chamado loja e configurar os dados do arquivo .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=loja
DB_USERNAME=root
DB_PASSWORD=

Rodar esses comandos

php artisan serve --port=8000
php artisan storage:link
php artisan migrate
php artisan db:seed

Usuários criados automaticamente

Usuário1
email: usuario1@teste.com
senha: 123456

Usuário2
email: usuario2@teste.com
senha: 123456
