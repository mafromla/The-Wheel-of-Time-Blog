<?php
session_start();
require_once('../includes/Page.class.php');
require_once('../includes/database.php');

$db = new Database();

$topicFilter = isset($_GET['topic_id']) ? intval($_GET['topic_id']) : null;

if ($topicFilter) {
    $posts = $db->queryArray("
        SELECT p.*, u.username, pr.profile_picture 
        FROM Posts p
        JOIN Users u ON p.user_id = u.user_id
        LEFT JOIN Profiles pr ON p.user_id = pr.user_id
        WHERE p.topic_id = {$topicFilter}
        ORDER BY p.created_at DESC
    ");
} else {
    $posts = $db->getAllPostsWithAuthor();
}

$page = new Page();
$page->title = "Blog Posts - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='../css/blog.css'>
    <script src='../js/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";

$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';
$authLink = isset($_SESSION['user_id']) ? "<a href='logout.php'>Sign Out</a>" : "<a href='login.php'>Login</a>";

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
    <a href='dashboard.php' class='w3-bar-item w3-button'>Admin Dashboard</a>
";

// BUILD BLOG CONTENT
$blogFeedHtml = "";
foreach ($posts as $post) {
    $postId = $post['post_id'];
    $author = htmlspecialchars($post['username']);
    $title = htmlspecialchars($post['title']);
    $summary = htmlspecialchars(mb_strimwidth($post['content'], 0, 140, "..."));
    $created = date("F j, Y, g:i a", strtotime($post['created_at']));
    $pic = !empty($post['profile_picture']) 
        ? "../Images/" . htmlspecialchars($post['profile_picture']) 
        : '../Images/images.3.webp';

    $userId = $_SESSION['user_id'] ?? null;
    $voteType = $userId ? $db->getUserVote($userId, $postId) : null;

    $upClass = ($voteType === 'up') ? 'voted' : '';
    $downClass = ($voteType === 'down') ? 'voted' : '';

    $voteScore = $db->getVoteScore($postId);

    $topicId = intval($post['topic_id']);
    $topicFlair = '';
    if ($topicId) {
        $topic = $db->queryArray("SELECT name FROM Topics WHERE topic_id = $topicId");
        if (!empty($topic)) {
            $topicName = htmlspecialchars($topic[0]['name']);
            $topicFlair = "<a class='topic-flair' href='blog.php?topic_id={$topicId}'>{$topicName}</a>";
        }
    }

    $blogFeedHtml .= "
    <div class='post-card'>
        <div class='post-meta'>
            <img src='{$pic}' class='user-avatar' alt='User'>
            <span class='username'>{$author}</span>
            <span class='post-date'>{$created}</span>
        </div>
        {$topicFlair}
        <h3><a href='post.php?id={$postId}'>{$title}</a></h3>
        <p>{$summary}</p>
        <div class='post-actions'>
            <form method='post' action='vote.php' style='display:inline;'>
                <input type='hidden' name='post_id' value='{$postId}'>
                <input type='hidden' name='vote' value='up'>
                <button class='vote upvote {$upClass}' type='submit'>⬆</button>
            </form>
            <span class='vote-score'>{$voteScore}</span>
            <form method='post' action='vote.php' style='display:inline;'>
                <input type='hidden' name='post_id' value='{$postId}'>
                <input type='hidden' name='vote' value='down'>
                <button class='vote downvote {$downClass}' type='submit'>⬇</button>
            </form>
            <span class='comments'>0 Comments</span>
        </div>
    </div>";
}

$page->content = "
    <main class='content blog-listing-page'>
        <div class='blog-header'>
            <h2>Blog Posts" . (
                $topicFilter 
                    ? " - Topic: " . htmlspecialchars(
                        $db->queryArray("SELECT name FROM Topics WHERE topic_id = {$topicFilter}")[0]['name'] ?? 'Unknown Topic'
                      )
                    : ""
            ) . "</h2>
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
            {$blogFeedHtml}
        </div>
    </main>
";

$page->footerContent = "
    <footer class='footer'>
        <div class='footer-about'>
            <h3>About This Blog</h3>
            <p>The Wheel of Time Blog is a space for fans to explore, discuss, and share insights about the beloved series.</p>
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
