<?php
session_start(); // Must be first
require_once('../includes/Page.class.php');

$page = new Page();

$page->title = "The One Power Explained - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='../css/post1.css'>
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
    <a href='../blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
    <a href='profile.php' class='w3-bar-item w3-button'>User Profiles</a>
    <a href='../comments.php' class='w3-bar-item w3-button'>Comments &amp; Rankings</a>
    <a href='../moderation.php' class='w3-bar-item w3-button'>Moderation</a>
    <a href='../admin.php' class='w3-bar-item w3-button'>Admin Panel</a>
";

$page->content = "
    <main class='content post-page'>
        <div class='text-post'>
            <div class='post-meta'>
                <img src='../Images/images.1.webp' class='user-avatar' alt='User'>
                <span class='username'>RandAlThor</span>
                <span class='post-date'>2 hours ago</span>
            </div>
            <h2>The One Power Explained</h2>
            <p>Ever wondered how <em>Saidin</em> and <em>Saidar</em> work? Here’s an in-depth breakdown of channeling, the Two Halves of the One Power, and how they shape the world of <em>The Wheel of Time</em>.</p>
            <h3>What is the One Power?</h3>
            <p>The One Power is the energy that drives the universe in Robert Jordan’s <em>The Wheel of Time</em> series. It is the force that turns the Wheel of Time itself, weaving the Pattern of existence. The One Power is divided into two halves: <em>Saidin</em>, the male half, and <em>Saidar</em>, the female half. These two halves are complementary but distinct, each with its own characteristics and rules.</p>
            <h3>Saidin: The Male Half</h3>
            <p><em>Saidin</em> is the half of the One Power that can be channeled by men. It is described as a raging torrent, wild and chaotic. Men who channel <em>Saidin</em> must wrestle with it, asserting their will to control its flow. This struggle is both a source of strength and a potential danger, as losing control can have devastating consequences.</p>
            <p>During the Age of Legends, male Aes Sedai used <em>Saidin</em> to perform incredible feats, such as creating the Eye of the World and constructing the Stone of Tear. However, after the Dark One’s taint corrupted <em>Saidin</em> during the Breaking of the World, male channelers were driven mad, leading to widespread destruction. This taint remained until the events of the series, when it was finally cleansed.</p>
            <h3>Saidar: The Female Half</h3>
            <p><em>Saidar</em>, on the other hand, is the half of the One Power that can be channeled by women. Unlike <em>Saidin</em>, <em>Saidar</em> is described as a gentle river, flowing smoothly and naturally. Women who channel <em>Saidar</em> must surrender to its flow, guiding it rather than forcing it. This surrender is key to mastering <em>Saidar</em>.</p>
            <p>Female Aes Sedai have been the primary wielders of the One Power since the Breaking of the World, as they were unaffected by the Dark One’s taint. They have used <em>Saidar</em> to maintain order, heal the sick, and protect the world from the Shadow. The White Tower, home of the Aes Sedai, stands as a testament to their enduring influence.</p>
            <h3>Channeling: The Art of Weaving</h3>
            <p>Channeling is the process of drawing on the One Power and shaping it into weaves, which can then be used to perform various tasks. These weaves can be as simple as creating a light or as complex as healing a fatal wound. The ability to channel is innate, though it requires training to use effectively.</p>
            <p>Both <em>Saidin</em> and <em>Saidar</em> have their own unique weaves, and some weaves can only be performed by one gender. For example, men are better at creating fire and earth weaves, while women excel at water and air weaves. However, there are also weaves that can only be achieved through cooperation between men and women, highlighting the complementary nature of the Two Halves.</p>
            <h3>The Dark One’s Influence</h3>
            <p>The Dark One’s taint on <em>Saidin</em> is one of the central conflicts of the series. This corruption not only drove male channelers mad but also made it nearly impossible for men to channel safely. The taint is described as a oily, black sludge that clings to <em>Saidin</em>, poisoning anyone who touches it.</p>
            <p>Cleansing the taint is a major turning point in the series, as it restores balance to the One Power and allows male channelers to once again contribute to the fight against the Shadow. This event also symbolizes the importance of unity between men and women, as it is only through their combined efforts that the taint is removed.</p>
            <h3>The Future of the One Power</h3>
            <p>As the series progresses, the role of the One Power evolves. With the taint cleansed, male channelers begin to reclaim their place in the world, working alongside female Aes Sedai to prepare for the Last Battle. The rediscovery of lost weaves and the development of new ones further expand the possibilities of channeling.</p>
            <p>Ultimately, the One Power is more than just a tool—it is a symbol of the balance between opposing forces. The interplay between <em>Saidin</em> and <em>Saidar</em> reflects the broader themes of the series, such as the importance of cooperation, the struggle against corruption, and the enduring hope for a better future.</p>
            <div class='post-actions'>
                <button class='vote upvote'>⬆ 120</button>
                <button class='vote downvote'>⬇</button>
                <span class='comments'>45 Comments</span>
            </div>
        </div>
        <!-- Comment Section -->
        <div class='comments-section'>
            <h3>Comments</h3>
            <div class='comment'>
                <img src='../Images/images.2.webp' class='user-avatar' alt='User'>
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
