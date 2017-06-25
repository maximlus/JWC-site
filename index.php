<?php
require 'vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer("templates");

$app->get("/", function($request,$response){
  $response = $this->view->render($response,"index.html");
  return $response;
});

$app->get('/hello/{name}', function ($request,$response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->run();

?>
