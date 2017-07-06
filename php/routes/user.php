<?php
//TODO: Convert to POST request
//TODO: Remove loop implement WHERE in MySQL query
$app->get("/api/user/login", function($req,$res){
  global $conn;
  $loginName = $req->getQueryParams()["user"];
  if($result = $conn->query("SELECT * FROM user")){
    while($row = $result->fetch_row()){
      if($row[1] == $loginName){
        $_SESSION["user"]["id"] = $row[0];
        $_SESSION["user"]["name"] = $row[1];
        $_SESSION["user"]["points"] = $row[2];
        return $res->getBody()->write("User found!");
      }
    }
  }
  $res->getBody()->write("No user found.");
  return $res->withStatus(404);
});

/*
* Sets $_SESSION to null.
* Logs out the user
*/
$app->get("/api/user/logout", function($req,$res){
  $user = $_SESSION["user"]["name"];
  $_SESSION["user"] = null;
  return $res->getBody()->write($user . " sucessfully logged out.");
});

/*
* Returns JSON object including user details
*/
$app->get("/api/user", function($req,$res){
  if($_SESSION["user"] == null){
    return $res->withStatus(404);
  }
  $user = ["user" =>["id" => $_SESSION["user"]["id"],
                      "name" => $_SESSION["user"]["name"],
                      "points" => $_SESSION["user"]["points"]
                    ]
          ];
  return $res->getBody()->write(json_encode($user));
});

/*
* Returns active user's name.
*/
$app->get("/api/user/name", function($req,$res){
  if ($_SESSION["user"] == null){
    return $res->withStatus(404);
  }
  return $res->getBody()->write($_SESSION["user"]["name"]);

});

/*
* Returns active users score
*/
$app->get("/api/user/score", function($req,$res){
  if($_SESSION["user"] == null){
    return $res->withStatus("404");
  }
  return $res->getBody()->write($_SESSION["user"]["points"]);
});
?>
