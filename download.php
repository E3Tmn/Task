<?php

$post_json = 'https://jsonplaceholder.typicode.com/posts';
$postData = file_get_contents($post_json);
$postArray = json_decode($postData, true);

$comments_json = 'https://jsonplaceholder.typicode.com/comments';
$comData = file_get_contents($comments_json);
$comArray = json_decode($comData, true);

$link = mysqli_connect('localhost', 'root', '', 'task');

if ($link === false) {
    die("ОШИБКА: не удалось подключиться. " . mysqli_connect_error());
}

$reqPost = "SELECT COUNT(*) FROM Posts";
$otvPost = mysqli_query($link, $reqPost);
$countPost = mysqli_fetch_array($otvPost)[0];
if ($countPost == 0) {
    for ($i = 0; $i < count($postArray); $i++) {
        $userId = $postArray[$i]["userId"];
        $id = $postArray[$i]["id"];
        $title = $postArray[$i]['title'];
        $body =  $postArray[$i]['body'];
        $sql = "INSERT INTO Posts (userID,id, title,body) VALUES ('$userId', '$id','$title', '$body')";
        mysqli_query($link, $sql);
    }
}

$reqCom = "SELECT COUNT(*) FROM Comments";
$otvCom = mysqli_query($link, $reqCom);
$countCom = mysqli_fetch_array($otvCom)[0];
if ($countCom == 0) {
    for ($i = 0; $i < count($comArray); $i++) {
        $postId = $comArray[$i]["postId"];
        $id = $comArray[$i]["id"];
        $name = $comArray[$i]['name'];
        $email = $comArray[$i]['email'];
        $body =  $comArray[$i]['body'];
        $sql = "INSERT INTO Comments (postId, id, name,email,body) VALUES ('$postId','$id', '$name', '$email','$body')";
        mysqli_query($link, $sql);
    }
}

$otvPost = mysqli_query($link, $reqPost);
$countPost = mysqli_fetch_array($otvPost)[0];

$otvCom = mysqli_query($link, $reqCom);
$countCom = mysqli_fetch_array($otvCom)[0];

echo "<script>console.log('Загружено: " . $countPost . " записей и ", $countCom, " комментариев ');</script>";
