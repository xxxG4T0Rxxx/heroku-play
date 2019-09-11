<?php
$verb = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['PATH_INFO'];
$routes = explode("/", $uri);

$dbhandle = new PDO("sqlite:basicdatabase.db") or die("Failed to open DB");
if (!$dbhandle) die ($error);

function readall(){ echo "read allhere";};
function readone($id){ echo "read onehere ".$id;};
function createone(){ echo "create onehere";};
function updateone($id){ echo "update onehere ".$id;};
function deleteone($id){ echo "delete onehere ".$id;};

if ($routes[1] == "number"){
  if ($verb == "GET"){
    if (count($routes) < 3){
      readall();
    } else {
      readone($routes[2]);
    }
  }
  if ($verb == "POST"){
    createone();
  }
  if ($verb == "PUT"){
    if (count($routes) < 3){
      echo "Usage: PUT /number/:id";
    } else {
      updateone($routes[2]);
    }
  }
  if ($verb == "DELETE"){
    if (count($routes) < 3){
      echo "Usage: DELETE /number/:id";
    } else {
      deleteone($routes[2]);
    }
  }
} else {
  echo "Usage: GET /number[/:id], POST /number, PUT /number/:id, DELETE /number/:id";
}
?>
