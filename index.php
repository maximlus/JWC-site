<?php
require 'vendor/autoload.php';
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$conn = new mysqli("localhost","root","toor","JWC");
$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer("./");

session_start();
if( !isset($_SESSION["user"]) ){
  $_SESSION["user"] = null;
}

require 'php/routes/viewcount.php';

/*
  On inital request to server, render index.html page from templates folder.
*/
$app->get("/", function($request,$response){
  $response = $this->view->render($response,"index.html");
  return $response;
});


/*
* TEST FUNCTION
* Used to check post requests and how to parse JSON data from them.
*/
$app->post("/api/posttest", function($req,$res,$app) use ($app){
  $json = $req->getParams(); // Get JSON data from request

  $var = $json["title"]; // Return a value from JSON varable
  return $res->getBody()->write($var); // Return varable(title) to sender.
  //return $res->withJson($json);
});

$app->run();

?>
