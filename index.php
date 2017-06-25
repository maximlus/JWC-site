<?php
// Import vendor resources
require 'vendor/autoload.php';

// Show errors on PHP errors (By default these are hidden.. for some silly reason)
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
  Create an instance of the Slim app.
  This is used as a framework to handle RESTful API requests
*/
$app = new \Slim\App(["settings" => $config]);

/*
  Create a reference to the app's container.
  Other libarys use access to the container to implement their own functions and features.
  (See line 23 for example)
*/
$container = $app->getContainer();


/*
  Add renderering functionality to server.
  Without this the server will not render any HTML,PHP or PHTML (This took way too long to figure out...)
*/
$container['view'] = new \Slim\Views\PhpRenderer("templates");


/*
  On inital request to server, render index.html page from templates folder.
*/
$app->get("/", function($request,$response){
  $response = $this->view->render($response,"index.html");
  return $response;
});

/*
  Basic API Get request.
  On /hello/"shaun" The server will respond with "Hello,shaun"
*/
$app->get('/hello/{name}', function ($request,$response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");
    return $response;
});

/*
  Starts the server!
*/
$app->run();

?>
