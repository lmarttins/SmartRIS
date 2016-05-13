SmartRIS
==============
Autor: Leandro Martins <lmarttinssilva@gmail.com>

Configurações:

Rodar o comando "composer install" na raiz do projeto.

É possível subir o webserver bult-in do php, 
executando o comando "php -S localhost:8888" na raiz.

Acessar o arquivo "SmartRIS/src/app.php" e ajustar os parametros
de conexao com o banco de acordo, segue o trecho

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(       
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'dbname' => 'smartris',
        'user' => 'root',
        'password' => '',
        'charset' => 'utf8'
    )
));

O dump do banco está na raiz

Os arquivos xml estão sendo salvos na pasta "/tmp"

