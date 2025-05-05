<?php
session_start();
require_once('../includes/Page.class.php');
require_once('../includes/database.php');
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input    = trim($_POST['username'] ?? '');
    $password = $_POST['psw'] ?? '';

    if (!$input || !$password) {
        die('Please enter both username/email and password.');
    }

    $rows = $db->findUserBy('username', $input);
    if (!$rows) {
        $rows = $db->findUserBy('email', $input);
    }

    if (!$rows || !password_verify($password, $rows[0]['password_hash'])) {
        die('Invalid login credentials.');
    }

    // Auth success
    $user = $rows[0];
    $_SESSION['user_id']  = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role_id']  = $user['role_id'];

    header('Location: index.php');
    exit;
}


$page = new Page();

$page->title = "Login - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../CSS/styles.css'>
    <link rel='stylesheet' href='../CSS/login.css'>
    <script src='../js/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";

$page->headerContent = "
    <a href='index.php'>
        <img src='../Images/WOT_Logo.png' alt='The Wheel of Time Blog' class='logo'>
    </a>
    <div class='header-text'>
        <h1>The Wheel of Time Blog</h1>
        <p class='subtitle'>Log Into Your Account</p>
    </div>
    <div class='user-menu'>
        <span id='usernameDisplay'>Guest</span>
        <div class='dropdown'>
            <button class='dropdown-btn' type='button'>▼</button>
            <div class='dropdown-content'>
                <a href='profile.php'>Profile</a>
                <a href='login.php'>Login</a>
            </div>
        </div>
    </div>
";

$page->sidebarContent = "
    <a href='index.php' class='w3-bar-item w3-button custom-home-btn'>Home</a>
    <a href='blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='profile.php' class='w3-bar-item w3-button'>User Profiles</a>
    <a href='create_post.php' class='w3-bar-item w3-button'>Create Blog Post</a>
    <a href='dashboard.php' class='w3-bar-item w3-button'>Dashboard</a>
";

$page->content = "
    <main class='content'>
        <h2>Login</h2>
        <form action='login.php' method='post'>
            <div class='container'>
                <label for='uname'><b>Username</b></label>
                <input type='text' placeholder='Username or Email' name='username' required>
                <label for='psw'><b>Password</b></label>
                <input type='password' placeholder='Enter Password' name='psw' required>
                <button type='submit'>Login</button>
                <div class='remember-forgot'>
                    <label>
                        <input type='checkbox' checked='checked' name='remember'> Remember me
                    </label>
                    <span class='psw'><a href='#'>Forgot password?</a></span>
                </div>
            </div>
        </form>
        <p>Don't have an account? <a href='signup.php'>Sign Up</a></p>
    </main>
";

$page->footerContent = "
    <footer class='footer'>
        <div class='footer-about'>
            <h3>About This Blog</h3>
            <p>The Wheel of Time Blog is a space for fans to explore, discuss, and share insights about the beloved series. Whether you're analyzing deep lore, debating theories, or reviewing episodes and books, this is your home for all things Wheel of Time.</p>
        </div>
        <div class='footer-links'>
            <h3>Quick Links</h3>
            <ul>
                <li><a href='index.php'>Home</a></li>
                <li><a href='blog.php'>Blog Posts</a></li>
                <li><a href='profile.php'>Profile</a></li>
                <li><a href='contact.php'>Contact</a></li>
            </ul>
        </div>
        <div class='footer-contact'>
            <h3>Contact Us</h3>
            <p>Email: support@wheeloftimeblog.com</p>
            <p>Follow us on <a href='#'>Twitter</a> | <a href='#'>Facebook</a> | <a href='#'>Instagram</a></p>
        </div>
    </footer>
    
";

$page->Display();
?>