<?php
session_start();
require_once('../includes/Page.class.php');
require_once('../includes/database.php');

$db = new Database();
$page = new Page();

// Get ID of user to edit
$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$currentUserId = $_SESSION['user_id'] ?? null;
$currentRoleId = $_SESSION['role_id'] ?? 0;

// Only admins or the user themselves can access
if (!$currentUserId || ($currentRoleId != 1 && $currentUserId != $userId)) {
    header('Location: login.php');
    exit;
}

// Fetch user info
$user = $db->queryArray("SELECT * FROM Users WHERE user_id = $userId")[0] ?? null;

if (!$user) {
    die("User not found.");
}

// Fetch profile info
$profile = $db->queryArray("SELECT * FROM Profiles WHERE user_id = $userId")[0] ?? [];
$pic = !empty($profile['profile_picture']) 
    ? "../Images/" . htmlspecialchars($profile['profile_picture']) 
    : '../Images/images.3.webp';

$page->title = "Edit User - " . trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''));

$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <script src='../js/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";

$username = htmlspecialchars($_SESSION['username']);
$page->headerContent = "
    <a href='index.php'>
        <img src='../Images/WOT_Logo.png' alt='The Wheel of Time Blog' class='logo'>
    </a>
    <div class='header-text'>
        <h1>Edit User</h1>
        <p class='subtitle'>Manage Profile Information</p>
    </div>
    <div class='user-menu'>
        <span id='usernameDisplay'>{$username}</span>
        <div class='dropdown'>
            <button class='dropdown-btn' type='button'>▼</button>
            <div class='dropdown-content'>
                <a href='profile.php'>Profile</a>
                <a href='logout.php'>Sign Out</a>
            </div>
        </div>
    </div>
";

$page->sidebarContent = "
    <a href='index.php' class='w3-bar-item w3-button custom-home-btn'>Home</a>
    <a href='blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='profile.php' class='w3-bar-item w3-button'>User Profiles</a>
    <a href='create_post.php' class='w3-bar-item w3-button'>Create Blog Post</a>
    <a href='dashboard.php' class='w3-bar-item w3-button'>Admin Dashboard</a>
";

$page->content = "
    <main class='content'>
        <h2>Edit User: " . trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')) . "</h2>
        <img src='{$pic}' class='user-profile-img' alt='Profile Picture'>
        <form action='update_user.php' method='POST' enctype='multipart/form-data' class='edit-user-form'>
            <input type='hidden' name='user_id' value='{$userId}'>
            <label>Username: <input type='text' name='username' value='" . htmlspecialchars($user['username']) . "' required></label><br>
            <label>Email: <input type='email' name='email_address' value='" . htmlspecialchars($user['email_address'] ?? '') . "' required></label><br>
            <label>First Name: <input type='text' name='first_name' value='" . htmlspecialchars($user['first_name'] ?? '') . "'></label><br>
            <label>Last Name: <input type='text' name='last_name' value='" . htmlspecialchars($user['last_name'] ?? '') . "'></label><br>
            <label>New Password: <input type='password' name='new_password'></label><br>
            <label>Profile Picture: <input type='file' name='profile_picture'></label><br>
";

if ($currentRoleId == 1) {
    $roles = $db->queryArray("SELECT * FROM Roles");
    $page->content .= "<label>Role:
        <select name='role_id'>";
    foreach ($roles as $role): 
        $roleName = htmlspecialchars($role['role_name'] ?? 'Unknown Role'); // Updated column name
        $selected = $role['role_id'] == $user['role_id'] ? "selected" : "";
        $page->content .= "<option value='{$role['role_id']}' {$selected}>{$roleName}</option>";
    endforeach;
    $page->content .= "</select></label><br>";
}

$page->content .= "
            <button type='submit'>Update User</button>
        </form>
    </main>
";

$page->footerContent = "
    <footer class='footer'>
        <p>&copy; " . date('Y') . " The Wheel of Time Blog</p>
    </footer>
";

$page->Display();
