<?php
require_once('../includes/Page.class.php');
$page = new Page();

$page->title = "The Symbolism of the Aes Sedai Rings - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='../css/post1.css'>
    <script src='../js/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";
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
$page->sidebarContent = "
    <a href='index.php' class='w3-bar-item w3-button custom-home-btn'>Home</a>
    <a href='blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='profile.php' class='w3-bar-item w3-button'>User Profiles</a>
    <a href='create_post.php' class='w3-bar-item w3-button'>Create Blog Post</a>
    <a href='dashboard.php' class='w3-bar-item w3-button'>Dashboard</a>
";
$page->content = "
    <main class='content post-page'>
      <div class='text-post'>
        <div class='post-meta'>
          <img src='../Images/images.2.webp' class='user-avatar' alt='User'>
          <span class='username'>LoreMaster42</span>
          <span class='post-date'>3 hours ago</span>
        </div>
        <h2>The Symbolism of the Aes Sedai Rings</h2>
        <p>
          The Great Serpent rings worn by the Aes Sedai are not merely ornamental; they are steeped in symbolism and power. Each ring tells a story—of commitment, balance, and the complex interplay of duty and desire. In this post, we examine the historical context and deeper meanings behind these intricate pieces of jewelry, exploring how they remind us of the sacred bond with the One Power.
        </p>
        <div class='post-actions'>
          <button class='vote upvote'>⬆ 72</button>
          <button class='vote downvote'>⬇</button>
          <span class='comments'>25 Comments</span>
        </div>
      </div>


            <!-- Comment Section -->
        <div class='comments-section'>
            <h3>Comments</h3>
            <div class='comment'>
                <img src='../Images/images.1.webp' class='user-avatar' alt='User'>
                <div class='comment-text'>
                    <span class='username'>StormCaller</span>
                    <p>This was a great read! I love how the balance between Saidin and Saidar is described.</p>
                </div>
            </div>
            <div class='comment'>
                <img src='../Images/imagesa d.webp' class='user-avatar' alt='User'>
                <div class='comment-text'>
                    <span class='username'>PatternWeaver</span>
                    <p>I still think balefire is the most interesting weave. What do you think?</p>
                </div>
            </div>
            <div class='comment'>
                <img src='../Images/imagesa d.webp' class='user-avatar' alt='User'>
                <div class='comment-text'>
                    <span class='username'>ThreadSeeker</span>
                    <p>The healing weaves always fascinated me. Such a powerful yet delicate ability.</p>
                </div>
            </div>
        </div>
        <div class='comment-form'>
            <h3>Leave a Comment</h3>
            <textarea placeholder='Write your comment...' name='comment-text' rows='3'></textarea>
            <button class='submit-comment-btn'>Submit</button>
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
