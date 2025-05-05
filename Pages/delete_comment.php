<?php
session_start();
require_once('../includes/database.php');

if (!isset($_SESSION['user_id']) || !isset($_POST['comment_id'])) {
    header('Location: blog.php');
    exit;
}

$db = new Database();
$userId = intval($_SESSION['user_id']);
$commentId = intval($_POST['comment_id']);

// Verify the comment belongs to the user
$comment = $db->getComment($commentId)[0] ?? null;

if ($comment && intval($comment['user_id']) === $userId) {
    $db->deleteComment($commentId);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
