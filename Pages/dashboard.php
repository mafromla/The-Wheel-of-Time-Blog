<?php
session_start();
require_once('../includes/Page.class.php');

$page = new Page();

$page->title = "Dashboard - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='../CSS/dashboard.css'>
    <script src='../js/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";

// Dynamic user name display
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';

// Dynamic auth link: Login or Logout
$authLink = isset($_SESSION['user_id'])
    ? "<a href='logout.php'>Sign Out</a>"
    : "<a href='login.php'>Login</a>";

// Header with dynamic content
$page->headerContent = "
    <a href='index.php'>
        <img src='../Images/WOT_Logo.png' alt='The Wheel of Time Blog' class='logo'>
    </a>
    <div class='header-text'>
        <h1>The Wheel of Time Blog</h1>
        <p class='subtitle'>Explore, Discuss, and Learn</p>
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

$page->sidebarContent = "
    <a href='index.php' class='w3-bar-item w3-button custom-home-btn'>Home</a>
    <a href='blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='profile.php' class='w3-bar-item w3-button'>User Profiles</a>
    <a href='create_post.php' class='w3-bar-item w3-button'>Create Blog Post</a>
    <a href='dashboard.php' class='w3-bar-item w3-button'>Dashboard</a>
";

$page->content = "
    <main class='content dashboard-page'>
        <h2>Dashboard</h2>
        <div class='dashboard-widgets'>
            <div class='widget'>
                <h3>Total Posts</h3>
                <p>24</p>
            </div>
            <div class='widget'>
                <h3>Total Comments</h3>
                <p>87</p>
            </div>
            <div class='widget'>
                <h3>New Users</h3>
                <p>5</p>
            </div>
            <div class='widget'>
                <h3>Pending Moderation</h3>
                <p>3</p>
            </div>
        </div>
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
