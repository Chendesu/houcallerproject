<?php

session_start();
$usersList = [
  'user1'=>['id'=>1,'username'=>'king1'],
  'user2'=>['id'=>2,'username'=>'king2']
];
$_SESSION = $usersList;