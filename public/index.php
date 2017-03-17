<?php

use Phalcon\Loader;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\Application;
use Phalcon\Db\Adapter\Pdo\Mysql;

try {

    //Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    //Create a DI
    if(php_sapi_name()=="cli"){
        $di = new CliDI();
    }else{
        $di = new FactoryDefault();
    }

    $di = new FactoryDefault();
    // var_dump($di);die;
    $di->set(
        "voltService",
        function ($view, $di) {
            $volt = new Volt($view, $di);
            $volt->setOptions(
                [
                    "compiledPath"      => "../app/cache/",
                    "compiledExtension" => ".compiled",
                ]

            );
            return $volt;
        }
    );

    // Register Volt as template engine
    $di->set(
        "view",
        function () {
            $view = new View();
            $view->setViewsDir("../app/views/");
            $view->registerEngines(
                [
                    ".phtml" => "voltService",
                ]
            );

            return $view;
        }
    );


    //Setup a base URI so that all generated URIs include the "tutorial" folder
    $di->set('url', function(){
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    });

    //setup db
    $di->set('db',function(){
        return new Mysql(array(
            "host" => "localhost",
            "username" => "root",
            "password" => "123456",
            "dbname" => "newhg"
        ));
    });

    //Handle the request
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}