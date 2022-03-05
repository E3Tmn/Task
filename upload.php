<?php
$string = $_POST["text"];

$link = mysqli_connect('localhost', 'root', '', 'task');

$sql = "SELECT Posts.title, Comments.body FROM Posts JOIN Comments ON Comments.postId = Posts.id WHERE  Comments.body REGEXP '$string'";
if ($result = mysqli_query($link, $sql)) {
    $count = mysqli_fetch_array($result);
    if ($count != NULL) {
        foreach ($result as $row) {
            print_r("<h1>" . $row['title'] . "</h1>");
            print_r($row['body']);
        }
    } else {
        print_r("</h1>Мы не смогли ничего найти</h1>");
    }
}
