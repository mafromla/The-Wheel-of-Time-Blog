<?php
session_start();
require_once('../includes/database.php');

if (!isset($_SESSION['user_id']) || !isset($_POST['post_id'], $_POST['vote'])) {
    header('Location: blog.php');
    exit;
}

$db = new Database();
$userId = intval($_SESSION['user_id']);
$postId = intval($_POST['post_id']);
$vote = ($_POST['vote'] === 'up' || $_POST['vote'] === 'down') ? $_POST['vote'] : 'down';

// Just use ON DUPLICATE KEY UPDATE
$sql = "INSERT INTO Rankings (user_id, post_id, vote_type)
        VALUES ($userId, $postId, '$vote')
        ON DUPLICATE KEY UPDATE vote_type = '$vote'";

$db->query($sql);

header('Location: blog.php');
exit;
?>
