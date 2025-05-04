<?php
// Include the Page class file (adjust the path as needed)
require_once('../includes/Page.class.php');

// Create an instance of the Page class
$page = new Page();

// Set the page title and additional CSS/JS references
$page->title = "Blog Posts - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='../css/blog.css'>
    <script src='../js/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";

// Set the header content (logo, site title, user menu)
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

// Set the sidebar content (navigation links)
$page->sidebarContent = "
    <a href='index.php' class='w3-bar-item w3-button custom-home-btn'>Home</a>
    <a href='blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='profile.php' class='w3-bar-item w3-button'>User Profiles</a>
    <a href='create_post.php' class='w3-bar-item w3-button'>Create Blog Post</a>
    <a href='dashboard.php' class='w3-bar-item w3-button'>Dashboard</a>
";

// Set the main content (unique to this blog posts page)
$page->content = "
    <main class='content blog-listing-page'>
        <div class='blog-header'>
            <h2>Blog Posts</h2>
            <button class='create-post-btn' onclick='location.href=\"create_post.php\"'>Create New Post</button>
        </div>
        <div class='filter-section'>
            <label for='sort'>Sort by:</label>
            <select id='sort' name='sort'>
                <option value='top'>Top (Highest Ranked)</option>
                <option value='new'>New (Recent Posts)</option>
            </select>
        </div>
        <div class='blog-feed'>
            <!-- Post 1 -->
            <div class='post-card'>
                <div class='post-meta'>
                    <img src='../Images/images.1.webp' class='user-avatar' alt='User'>
                    <span class='username'>RandAlThor</span>
                    <span class='post-date'>2 hours ago</span>
                </div>
                <h3><a href='post1.php'>The One Power Explained</a></h3>
                <p>Ever wondered how Saidin and Saidar work? Here’s an in-depth breakdown of channeling...</p>
                <div class='post-actions'>
                    <button class='vote upvote'>⬆ 120</button>
                    <button class='vote downvote'>⬇</button>
                    <span class='comments'>45 Comments</span>
                </div>
            </div>
            <!-- Post 2 -->
            <div class='post-card'>
                <div class='post-meta'>
                    <img src='../Images/images.2.webp' class='user-avatar' alt='User'>
                    <span class='username'>MoiraineSedai</span>
                    <span class='post-date'>5 hours ago</span>
                </div>
                <h3><a href='post2.php'>Why The Wheel Weaves As It Wills</a></h3>
                <p>The Pattern is a mysterious force, but how does it actually shape the world of WoT?</p>
                <div class='post-actions'>
                    <button class='vote upvote'>⬆ 85</button>
                    <button class='vote downvote'>⬇</button>
                    <span class='comments'>30 Comments</span>
                </div>
            </div>
            <!-- Post 3 -->
            <div class='post-card'>
                <div class='post-meta'>
                    <img src='../Images/imagesa d.webp' class='user-avatar' alt='User'>
                    <span class='username'>LoreMaster42</span>
                    <span class='post-date'>3 hours ago</span>
                </div>
                <h3><a href='post3.php'>The Symbolism of the Aes Sedai Rings</a></h3>
                <p>What do the Great Serpent rings truly represent? A deep dive into their meaning and significance.</p>
                <div class='post-actions'>
                    <button class='vote upvote'>⬆ 72</button>
                    <button class='vote downvote'>⬇</button>
                    <span class='comments'>25 Comments</span>
                </div>
            </div>
            <!-- Post 4 -->
            <div class='post-card'>
                <div class='post-meta'>
                    <img src='../Images/images.1.webp' class='user-avatar' alt='User'>
                    <span class='username'>TavernTales</span>
                    <span class='post-date'>7 hours ago</span>
                </div>
                <h3><a href='post4.php'>The Role of Prophecy in WoT</a></h3>
                <p>From the Dragon Reborn to the Karaethon Cycle, how do prophecies drive the narrative forward?</p>
                <div class='post-actions'>
                    <button class='vote upvote'>⬆ 63</button>
                    <button class='vote downvote'>⬇</button>
                    <span class='comments'>18 Comments</span>
                </div>
            </div>
            <!-- Post 5 -->
            <div class='post-card'>
                <div class='post-meta'>
                    <img src='../Images/images.3.webp' class='user-avatar' alt='User'>
                    <span class='username'>ShadowWatcher</span>
                    <span class='post-date'>10 hours ago</span>
                </div>
                <h3><a href='post5.php'>Exploring the Dark One's Influence</a></h3>
                <p>How does the Dark One's touch corrupt the world, and what does it mean for the Last Battle?</p>
                <div class='post-actions'>
                    <button class='vote upvote'>⬆ 91</button>
                    <button class='vote downvote'>⬇</button>
                    <span class='comments'>42 Comments</span>
                </div>
            </div>
            <!-- Post 6 -->
            <div class='post-card'>
                <div class='post-meta'>
                    <img src='../Images/images.1.webp' class='user-avatar' alt='User'>
                    <span class='username'>ThreadWeaver</span>
                    <span class='post-date'>1 day ago</span>
                </div>
                <h3><a href='post6.php'>The Power of Saidin and Saidar</a></h3>
                <p>What makes the male and female halves of the One Power so unique, and how do they shape the world?</p>
                <div class='post-actions'>
                    <button class='vote upvote'>⬆ 78</button>
                    <button class='vote downvote'>⬇</button>
                    <span class='comments'>35 Comments</span>
                </div>
            </div>
            <!-- Post 7 -->
            <div class='post-card'>
                <div class='post-meta'>
                    <img src='../Images/images.2.webp' class='user-avatar' alt='User'>
                    <span class='username'>DreamWalker</span>
                    <span class='post-date'>2 days ago</span>
                </div>
                <h3><a href='post7.php'>Tel'aran'rhiod: The World of Dreams</a></h3>
                <p>Unraveling the mysteries of the Unseen World and its impact on the characters and plot.</p>
                <div class='post-actions'>
                    <button class='vote upvote'>⬆ 102</button>
                    <button class='vote downvote'>⬇</button>
                    <span class='comments'>50 Comments</span>
                </div>
            </div>
        </div>
    </main>
";

// Set the footer content (common footer information)
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

// Render the complete page
$page->Display();
?>
