<?php
session_start(); 
require_once('./includes/Page.class.php');

$page = new Page();

$page->title = "Home - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='./css/styles.css'>
    <script src='./js/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";

$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';

$authLink = isset($_SESSION['user_id'])
    ? "<a href='./pages/logout.php'>Sign Out</a>"
    : "<a href='./pages/login.php'>Login</a>";

$page->headerContent = "
    <a href='./Index.php'>
        <img src='./Images/WOT_Logo.png' alt='The Wheel of Time Blog' class='logo'>
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
                <a href='./pages/profile.php'>Profile</a>
                {$authLink}
            </div>
        </div>
    </div>
";

$page->sidebarContent = "
    <a href='./Index.php' class='w3-bar-item w3-button custom-home-btn'>Home</a>
    <a href='./pages/blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='./pages/profile.php' class='w3-bar-item w3-button'>User Profiles</a>
    <a href='./pages/create_post.php' class='w3-bar-item w3-button'>Create Blog Post</a>
    <a href='./pages/dashboard.php' class='w3-bar-item w3-button'> Admin Dashboard</a>
";

$page->content = "
    <main class='content home-page'>
        <h2>Welcome to The Wheel of Time Blog</h2>
        <p>Dive into discussions, share insights, and explore the world of The Wheel of Time.</p>

        <section class='featured-posts'>
            <h3>Featured Posts</h3>
            <div class='post-card'>
                <h3 class='post-title'><a href='./pages/post.php?id=1'>The One Power Explained</a></h3>
                <p>Understanding the Two Halves of the One Power and their impact on the world.</p>
            </div>
        </section>

        <div class='browse-topics'>
            <h2>Browse by Topic</h2>
            <div class='topic-grid'>
                <a href='./pages/blog.php?topic_id=1' class='topic-card'>The One Power & Magic System</a>
                <a href='./pages/blog.php?topic_id=2' class='topic-card'>The Ajahs of the Aes Sedai</a>
                <a href='./pages/blog.php?topic_id=3' class='topic-card'>The Forsaken & Dark One’s Forces</a>
                <a href='./pages/blog.php?topic_id=4' class='topic-card'>Cultures & Nations of Randland</a>
                <a href='./pages/blog.php?topic_id=5' class='topic-card'>Ta’veren & Prophecies</a>
                <a href='./pages/blog.php?topic_id=6' class='topic-card'>Epic Battles & Military Strategy</a>
                <a href='./pages/blog.php?topic_id=7' class='topic-card'>Philosophy & Themes of the Wheel</a>
            </div>
        </div>

        <div class='slideshow-container'>
            <div class='mySlides fade'>
                <img src='./Images/01-The-Eye-of-the-World-outside.jpg' class='full-width-img' alt=''>
            </div>
            <div class='mySlides fade'>
                <img src='./Images/08-Path-of-Daggers.jpg' class='full-width-img' alt=''>
            </div>
            <div class='mySlides fade'>
                <img src='./Images/14-A-Memory-of-Light.jpg' class='full-width-img' alt=''>
            </div>
            <div class='mySlides fade'>
                <img src='./Images/Lord_of_Chaos_ebook_wraparound.png' class='full-width-img' alt=''>
            </div>
            <div class='mySlides fade'>
                <img src='./Images/the-gathering-storm-banner-1.jpg' class='full-width-img' alt=''>
            </div>
        </div>

        <div class='dots-container'>
            <span class='dot'></span>
            <span class='dot'></span>
            <span class='dot'></span>
            <span class='dot'></span>
            <span class='dot'></span>
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
                <li><a href='./Index.php'>Home</a></li>
                <li><a href='./pages/blog.php'>Blog Posts</a></li>
                <li><a href='./pages/profile.php'>Profile</a></li>
                <li><a href='./pages/contact.php'>Contact</a></li>
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
