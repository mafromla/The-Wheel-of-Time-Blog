<?php
require_once('../includes/Page.class.php');
$page = new Page();

$page->title = "Profile - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../CSS/styles.css'>
    <link rel='stylesheet' href='../CSS/profile.css'>
    <script src='../JS/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";

$page->headerContent = "
    <a href='index.php'>
        <img src='../Images/WOT_Logo.jpg' alt='The Wheel of Time Blog' class='logo'>
    </a>
    <div class='header-text'>
        <h1>The Wheel of Time Blog</h1>
        <p class='subtitle'>Manage Your Profile</p>
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
    <main class='content profile-page'>
        <h2>Profile</h2>
        <form action='/update_profile.php' method='post' enctype='multipart/form-data'>
            <div class='container'>
                <label for='profile-pic'><b>Profile Picture</b></label>
                <input type='file' id='profile-pic' name='profile-pic' accept='image/*'>
                <br>
                <label for='fname'><b>First Name</b></label>
                <input type='text' placeholder='Enter First Name' name='fname' required>
                <label for='lname'><b>Last Name</b></label>
                <input type='text' placeholder='Enter Last Name' name='lname' required>
                <label for='email'><b>Email</b></label>
                <input type='text' placeholder='Enter Email' name='email' required>
                <label for='bio'><b>About Me</b></label>
                <textarea placeholder='Tell us about yourself...' name='bio' rows='4'></textarea>
                <label>
                    <input type='checkbox' checked='checked' name='notifications'> Enable Email Notifications
                </label>
                <button type='submit' class='update-btn'>Update Profile</button>
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
                <li><a href='../blog.php'>Blog Posts</a></li>
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
