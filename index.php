<?php
// Import classes
include "php/person.php";
// Import vendor resources
require 'vendor/autoload.php';

// Show errors on PHP errors (By default these are hidden.. for some silly reason)
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

// Create reference to JWC databse
$conn = new mysqli("localhost","root","toor","JWC");

$app = new \Slim\App(["settings" => $config]);

$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer("./");

//global $person;
$person = new Person("shaun", 21);

session_start();

if( !isset($_SESSION["num"]) ){
  $_SESSION["num"] = 0;
}
/*
  On inital request to server, render index.html page from templates folder.
*/
$app->get("/", function($request,$response){
  $response = $this->view->render($response,"index.html");
  return $response;
});

$app->get("/test", function($req,$res){
  $_SESSION["num"] = $_SESSION["num"] + 1;
  return $res->getBody()->write($_SESSION["num"]);
});

$app->get("/mysql/test", function($req,$res){
  // global $conn;
  // $result = mysqli_query($conn,"SELECT * FROM horse");
  // return $res->getBody()->write($result->lengths);
});

$app->get("/test/reset", function($req,$res){
  $oldVal = $_SESSION["num"];
  $_SESSION["num"] = 0;
  return $res->getBody()->write("Test varable set to 0. Was : " . $oldVal);
});

$app->get("/api/connect", function($req,$res){
  global $conn;
  $dataSet = "";
  if($result = $conn->query("SELECT * FROM horse")){
    while($row = $result->fetch_row()){
      $dataSet = $dataSet . $row[1] . "</br>";
    }
  }
  $res->getBody()->write($dataSet);
});


$app->get("/api/viewcounter/new", function($req,$res){
  $counterFileURL = "./php/storage/viewcount.txt";
  $counterFile = fopen($counterFileURL, "r");
  $counterFileSize = filesize($counterFileURL);

  $counter = fread($counterFile,$counterFileSize);

  fclose($counterFile);

  $counterFile = fopen($counterFileURL,"w");
  fwrite($counterFile,$counter+1);
  fclose($counterFile);

  $res->getBody()->write($counter + 1);
});

$app->get("/api/viewcounter/reset", function($req,$res){
  $counterFileURL = "./php/storage/viewcount.txt";
  $counterFile = fopen($counterFileURL,"w");
  fwrite($counterFile,"0");
  fclose($counterFile);

  $res->getBody()->write("View Counter reset!");
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
