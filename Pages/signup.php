<?php
session_start();
require_once('../includes/database.php');
require_once('../includes/Page.class.php');

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username  = trim($_POST['username'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if (!$username || !$email || !$password || !$password2) {
        die('Please fill in all fields.');
    }
    if ($password !== $password2) {
        die('Passwords do not match.');
    }

    if ($db->findUserBy('username', $username)) {
        die('Username already exists.');
    }
    if ($db->findUserBy('email', $email)) {
        die('Email already exists.');
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    if (!$db->addUser($username, $email, $hash)) {
        die('Error creating user.');
    }

    $user = $db->findUserBy('username', $username)[0];

    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role_id'] = $user['role_id'];

    header('Location: dashboard.php');
    exit;
}

$page = new Page();

$page->title = "Sign Up - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='../css/signup.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
    <script src='../js/script.js' defer></script>
";

$page->headerContent = "
    <a href='index.php'>
        <img src='../Images/WOT_Logo.jpg' alt='The Wheel of Time Blog' class='logo'>
    </a>
    <div class='header-text'>
        <h1>The Wheel of Time Blog</h1>
        <p class='subtitle'>Unravel the Pattern</p>
    </div>
";

$page->sidebarContent = "
    <a href='index.php'        class='w3-bar-item w3-button custom-home-btn'>Home</a>
    <a href='blog.php'         class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='profile.php'      class='w3-bar-item w3-button'>Profile</a>
    <a href='comments.php'     class='w3-bar-item w3-button'>Comments</a>
    <a href='moderation.php'   class='w3-bar-item w3-button'>Moderation</a>
    <a href='dashboard.php'    class='w3-bar-item w3-button'>Dashboard</a>
";

$page->content = <<<HTML
<main class="content signup-form">
    <h2>Sign Up</h2>
    <p>Please fill in this form to create an account.</p>
    <form action="signup.php" method="post">
        <div class="container">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <label for="password2"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="password2" required>

            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>

            <p>By creating an account you agree to our <a href="#">Terms &amp; Privacy</a>.</p>
            <button type="submit" class="signupbtn">Sign Up</button>
        </div>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</main>
HTML;

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