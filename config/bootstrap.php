<?php
/**
 * Created by PhpStorm.
 * User: patricio
 * Date: 23/11/18
 * Time: 22:30
 */

require_once __DIR__ . '/../vendor/autoload.php';
define('BASE_PATH', __DIR__ . '/../');
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$dotenv = new \Dotenv\Dotenv(BASE_PATH);
$dotenv->load();
$dotenv->required([
    'DATABASE_HOST',
    'DATABASE_NAME',
    'DATABASE_PORT',
    'DATABASE_USER',
    'DATABASE_PASSWORD',
    'DATABASE_DRIVER',
    'DATABASE_CHARSET',
]);

$paths = array("/../app/Model");
$isDevMode = true;

// the connection configuration

function getEntityManager() {
    
    $dbParams = array(
        'driver'   => $_ENV['DATABASE_DRIVER'],
        'user'     => $_ENV['DATABASE_USER'],
        'password' => $_ENV['DATABASE_PASSWORD'],
        'dbname'   => $_ENV['DATABASE_NAME'],
        'host' => $_ENV['DATABASE_HOST'],
        'port' => $_ENV['DATABASE_PORT'],
        'charset' => $_ENV['DATABASE_CHARSET'],
    );
    
    $redis = new Redis();
    $redis->connect('redis', 6379);
    
    $cacheDriver = new \Doctrine\Common\Cache\RedisCache();
    $cacheDriver->setRedis($redis);
    $cacheDriver->save('cache_id', 'my_data');
    
    $config = Setup::createAnnotationMetadataConfiguration(
        array(BASE_PATH . $_ENV['MODEL_DIR']),
        $_ENV['DEBUG'],
        ini_get('sys_temp_dir'),
        $cacheDriver,
        false);
    
    $config->setAutoGenerateProxyClasses(true);
    
    if($_ENV['DEBUG']){
        $config->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());
    }
    
    return EntityManager::create($dbParams, $config);
}

