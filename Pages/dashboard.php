<?php
session_start();
require_once('../includes/Page.class.php');
require_once('../includes/database.php');

// Role check
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    $page = new Page();
    $page->title = "Access Denied";
    $page->cssScripts = "
        <link rel='stylesheet' href='../css/styles.css'>
        <script src='../js/script.js' defer></script>
    ";

    $page->headerContent = "<h1>Access Denied</h1>";
    $page->sidebarContent = ""; 
    $page->content = "
        <div class='access-denied-page'>
            <h2>Access Denied</h2>
            <p>You do not have access to this page. Admins only.</p>
            <a class='custom-button' href='index.php'>Return to Homepage</a>
        </div>
    ";
    $page->footerContent = "<footer class='footer'><p>&copy; " . date('Y') . " The Wheel of Time Blog</p></footer>";
    $page->Display();
    exit;
}

// Only allow admins
if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$page = new Page();
$db = new Database();

$page->title = "Admin Dashboard - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='../css/dashboard.css'>
    <script src='../js/script.js' defer></script>
";

// Header setup
$username = htmlspecialchars($_SESSION['username']);
$authLink = "<a href='logout.php'>Sign Out</a>";
$page->headerContent = "
    <a href='index.php'>
        <img src='../Images/WOT_Logo.png' alt='The Wheel of Time Blog' class='logo'>
    </a>
    <div class='header-text'>
        <h1>Admin Dashboard</h1>
        <p class='subtitle'>Manage Users, Posts, and More</p>
    </div>
    <div class='user-menu'>
        <span id='usernameDisplay'>{$username}</span>
        <div class='dropdown'>
            <button class='dropdown-btn' type='button'>▼</button>
            <div class='dropdown-content'>
                <a href='profile.php'>Profile</a>
                {$authLink}
            </div>
        </div>
    </div>
";

// Sidebar
$page->sidebarContent = "
    <a href='index.php' class='w3-bar-item w3-button custom-home-btn'>Home</a>
    <a href='blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='profile.php' class='w3-bar-item w3-button'>User Profiles</a>
    <a href='create_post.php' class='w3-bar-item w3-button'>Create Blog Post</a>
    <a href='dashboard.php' class='w3-bar-item w3-button'>Admin Dashboard</a>
";

// Fetch data
$totalPosts = count($db->queryArray("SELECT post_id FROM Posts"));
$totalComments = count($db->queryArray("SELECT comment_id FROM Comments"));
$newUsers = count($db->queryArray("SELECT user_id FROM Users WHERE created_at >= CURDATE() - INTERVAL 7 DAY"));

$page->content = "
    <main class='content admin-dashboard'>
        <h2>Admin Controls</h2>

        <section>
            <h3>Users (New This Week: {$newUsers})</h3>
            <ul class='admin-list'>" .
                implode('', array_map(fn($u) => "<li><a href='edit_user.php?id={$u['user_id']}'>" . htmlspecialchars($u['username']) . "</a></li>", $db->queryArray("SELECT * FROM Users"))) .
            "</ul>
        </section>

        <section>
            <h3>Posts (Total: {$totalPosts})</h3>
            <ul class='admin-list'>" .
                implode('', array_map(fn($p) => "<li><a href='post.php?id={$p['post_id']}'>" . htmlspecialchars($p['title']) . "</a></li>", $db->queryArray("SELECT * FROM Posts"))) .
            "</ul>
        </section>

        <section>
            <h3>Comments (Total: {$totalComments})</h3>
            <ul class='admin-list'>" .
                implode('', array_map(fn($c) => "<li>" . htmlspecialchars(substr($c['comment_text'], 0, 60)) . "...</li>", $db->queryArray("SELECT * FROM Comments"))) .
            "</ul>
        </section>
    </main>
";

$page->footerContent = "
    <footer class='footer'>
        <p>© " . date("Y") . " The Wheel of Time Blog | Admin Panel</p>
    </footer>
";

$page->Display();
?>
