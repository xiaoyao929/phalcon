<?php

use \Phalcon\Loader;
use Phalcon\DI\FactoryDefault;
use \Phalcon\Mvc\View;
use \Phalcon\Mvc\Url;
use \Phalcon\Mvc\Application;
use Phalcon\Db\Adapter\Pdo\Mysql;

try {

    //Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    //Create a DI
    $di = new FactoryDefault();

    //Setup the view component
    $di->set('view', function(){
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

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
            "dbname" => "phalcon"
        ));
    });

    //Handle the request
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}