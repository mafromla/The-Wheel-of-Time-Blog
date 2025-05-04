<?php
require_once('../includes/Page.class.php');
$page = new Page();

$page->title = "Blog Post - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='../css/create_post.css'>
    <script src='../js/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";

$page->headerContent = "
    <a href='index.php'>
        <img src='../Images/WOT_Logo.jpg' alt='The Wheel of Time Blog' class='logo'>
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

$page->sidebarContent = "
    <a href='index.php' class='w3-bar-item w3-button custom-home-btn'>Home</a>
    <a href='blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='profile.php' class='w3-bar-item w3-button'>User Profiles</a>
    <a href='create_post.php' class='w3-bar-item w3-button'>Create Blog Post</a>
    <a href='dashboard.php' class='w3-bar-item w3-button'>Dashboard</a>
";

$page->content = "
    <main class='content blog-post-page'>
        <h2>Create a New Blog Post</h2>
        <form action='/submit_post.php' method='post' enctype='multipart/form-data'>
            <div class='container'>
                <label for='post-title'><b>Title</b></label>
                <input type='text' placeholder='Enter Post Title' name='post-title' required>
                <label for='post-topics'><b>Topics</b></label>
                <input type='text' placeholder='Enter Topics (comma-separated)' name='post-topics' required>
                <label for='post-media'><b>Media (Image, Video, Audio)</b></label>
                <input type='file' id='post-media' name='post-media' accept='image/*,video/*,audio/*'>
                <label for='post-content'><b>Content</b></label>
                <textarea placeholder='Write your story here...' name='post-content' rows='6' required></textarea>
                <button type='submit' class='submit-post-btn'>Publish Post</button>
            </div>
        </form>
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
