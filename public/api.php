<?php
$app = new \Phalcon\Mvc\Micro();

//define the routes here
$app->get('/test', function() {
	echo 4;
});

$app->handle();