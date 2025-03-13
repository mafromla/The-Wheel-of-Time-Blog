<?php
// Include the Page class file
require_once('../includes/Page.class.php');  // Adjust path if needed

// Create an instance of the Page class
$page = new Page();

// Set the page-specific properties

// (a) Set the title and include additional CSS/JS
$page->title = "Home - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <script src='../js/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";

// (b) The header portion (logo, site title, and user menu)
$page->headerContent = "
    <a href='index.php'>
        <img src='../images/wot_logo.jpg' alt='The Wheel of Time Blog' class='logo'>
    </a>
    <div class='header-text'>
        <h1>The Wheel of Time Blog</h1>
        <p class='subtitle'>Explore, Discuss, and Learn</p>
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

// (c) The sidebar navigation menu
$page->sidebarContent = "
    <a href='index.php' class='w3-bar-item w3-button custom-home-btn'>Home</a>
    <a href='blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='profile.php' class='w3-bar-item w3-button'>User Profiles</a>
    <a href='comments.php' class='w3-bar-item w3-button'>Comments and Rankings</a>
    <a href='moderation.php' class='w3-bar-item w3-button'>Moderation</a>
    <a href='dashboard.php' class='w3-bar-item w3-button'>Dashboard</a>
";

// (d) The main content area (from your original index.html)
$page->content = "
    <main class='content home-page'>
        <h2>Welcome to The Wheel of Time Blog</h2>
        <p>Dive into discussions, share insights, and explore the world of The Wheel of Time.</p>

        <section class='featured-posts'>
            <h3>Featured Posts</h3>
            <div class='post-card'>
                <h3 class='post-title'><a href='post1.php'>The One Power Explained</a></h3>
                <p>Understanding the Two Halves of the One Power and their impact on the world.</p>
            </div>
        </section>

        <!-- Slideshow -->
        <div class='slideshow-container'>
            <div class='mySlides fade'>
                <img src='../Images/01-The-Eye-of-the-World-outside.jpg' class='full-width-img' alt=''>
            </div>
            <div class='mySlides fade'>
                <img src='../images/08-Path-of-Daggers.jpg' class='full-width-img' alt=''>
            </div>
            <div class='mySlides fade'>
                <img src='../Images/14-A-Memory-of-Light.jpg' class='full-width-img' alt=''>
            </div>
            <div class='mySlides fade'>
                <img src='../Images/Lord_of_Chaos_ebook_wraparound.png' class='full-width-img' alt=''>
            </div>
            <div class='mySlides fade'>
                <img src='../Images/the-gathering-storm-banner-1.jpg' class='full-width-img' alt=''>
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

// (e) The footer content (from your original index.html)
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

// Finally, render the complete page
$page->Display();
?>
