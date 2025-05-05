<?php
session_start();
require_once('../includes/database.php');

if (!isset($_SESSION['user_id'], $_POST['post_id'], $_POST['comment_text'])) {
    header("Location: blog.php");
    exit;
}

$db = new Database();
$userId = intval($_SESSION['user_id']);
$postId = intval($_POST['post_id']);
$text = trim($_POST['comment_text']);

if ($text !== "") {
    $db->addComment($postId, $userId, $text);
}

header("Location: post.php?id=$postId");
exit;
