SmartRIS
==============
Autor: Leandro Martins <lmarttinssilva@gmail.com>

Configurações de banco:
Acessar o arquiv "SmartRIS/src/app.php" e ajustar os parametros
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

