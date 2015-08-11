<?php
/**
 * Author: Everlon Passos (dev@everlon.com.br)
 * Date: 11/08/2015 10:04:03
 */

    # Iniciando SILEX
    $app = new Silex\Application();
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

/* ====================================================================================================== */
    # Session
    use Silex\Provider\SessionServiceProvider;
    $app->register(new SessionServiceProvider());
    $app->register( new Silex\Provider\UrlGeneratorServiceProvider() );

/* ====================================================================================================== */
    # HELPER
    require_once(__DIR__.'/../src/objs/Helpers.php');
    $app['helper'] = new Helper();

/* ====================================================================================================== */
    # E-Mail
    require_once(__DIR__.'/../src/objs/TwigMailGenerator.php');
    $app['mail'] = new TwigMailGenerator();

/* ====================================================================================================== */

    # Configurações TWIG
    $app->register(new Silex\Provider\TwigServiceProvider(),
                array(
                    'debug'     => true,
                    // 'cache' => 'cache',
                    'twig.path' => array( __DIR__.'../view' )
            ));

/* ====================================================================================================== */

    # Definição das variáveis básicas
    list($sub, $host, $ext1, $ext2) = explode(".",$_SERVER["SERVER_NAME"]);

    //define('DS',     DIRECTORY_SEPARATOR);
    define('URL_BASE', 'http://'.$host.'.'.$ext1.'.'.$ext2);
    define('ASSETS',   'http://'.$host.'.'.$ext1.'.'.$ext2.'/assets');

    $app['assets'] = array(
        'js'      => ASSETS.'/js',
        'css'     => ASSETS.'/css',
        'url_img' => ASSETS.'/imgs',
    );

/* ====================================================================================================== */

    # Configurações do Banco de Dados
    define('DB_HOST',     'localhost');
    define('DB_DBNAME',   '');
    define('DB_USER',     '');
    define('DB_PASSWORD', '');

    require_once(__DIR__.'/../src/lib/connect.class.php');
    $app['db'] = new connect();

/* ====================================================================================================== */

    # Development
    date_default_timezone_set('America/Sao_Paulo');

    ini_set('display_errors', 1);
    $app['debug']   = true;
    $app['charset'] = 'ISO-8859-1';

/* ====================================================================================================== */