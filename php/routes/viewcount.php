<?php
/*
* TODO: Set to increment per unique session
* Increments the view counter stored as a local file: "/php/storage/viewcount.txt"
*/
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

/*
* Set viewcounter to 0
*/
$app->get("/api/viewcounter/reset", function($req,$res){
  $counterFileURL = "./php/storage/viewcount.txt";
  $counterFile = fopen($counterFileURL,"w");
  fwrite($counterFile,"0");
  fclose($counterFile);

  $res->getBody()->write("View Counter reset!");
});
?>
