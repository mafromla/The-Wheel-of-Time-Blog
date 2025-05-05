<?php
session_start();
require_once('../includes/Page.class.php');
require_once('../includes/database.php');

$page = new Page();
$db = new Database();

$postId = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$postId) die("Post ID not provided.");

$postData = $db->getPost($postId);
if (!$postData || count($postData) === 0) die("Post not found.");
$post = $postData[0];

$userData = $db->getUser($post['user_id'])[0] ?? ['username' => 'Unknown'];
$profileData = $db->getProfile($post['user_id'])[0] ?? [];

$fullName = trim(($profileData['first_name'] ?? '') . ' ' . ($profileData['last_name'] ?? '')) ?: $userData['username'];
$pic = isset($profileData['profile_picture']) && $profileData['profile_picture'] !== ''
    ? "../Images/" . htmlspecialchars($profileData['profile_picture'])
    : '../Images/images.3.webp';
$score = $db->getVoteScore($postId);

$page->title = htmlspecialchars($post['title']) . " - The Wheel of Time Blog";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='../css/post1.css'>
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
    <a href='dashboard.php' class='w3-bar-item w3-button'>Dashboard</a>
";

$comments = $db->getCommentsByPost($postId);
$commentsHtml = "<div class='comments-section'><h3>Comments</h3>";

foreach ($comments as $comment) {
    $authorData = $db->getUser($comment['user_id'])[0] ?? ['username' => 'Unknown'];
    $authorName = htmlspecialchars($authorData['username']);
    $text = nl2br(htmlspecialchars($comment['comment_text']));
    $date = date("F j, Y, g:i a", strtotime($comment['created_at']));
    $canDelete = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment['user_id'];

    $commentsHtml .= "
    <div class='comment'>
        <div class='comment-header'>
            <strong>{$authorName}</strong> <small>{$date}</small>
        </div>
        <p>{$text}</p>";

    if ($canDelete) {
        $commentsHtml .= "
        <form method='post' action='delete_comment.php' style='margin-top:5px;'>
            <input type='hidden' name='comment_id' value='{$comment['comment_id']}'>
            <button type='submit' class='delete-comment-btn'>Delete</button>
        </form>";
    }

    $commentsHtml .= "</div>";
}

$commentsHtml .= "</div>";

$topicLabel = '';
$topicId = intval($post['topic_id']);
if ($topicId) {
    $topicRow = $db->queryArray("SELECT name FROM Topics WHERE topic_id = $topicId");
    if (!empty($topicRow)) {
        $topicLabel = htmlspecialchars($topicRow[0]['name']);
    }
}

$page->content = "
    <main class='content post-page'>
        <div class='text-post'>
            <div class='post-meta'>
                <img src='{$pic}' class='user-avatar' alt='User'>
                <span class='username'>" . htmlspecialchars($fullName) . "</span>
                <span class='post-date'>" . date("F j, Y, g:i a", strtotime($post['created_at'])) . "</span>
            </div>
            " . ($topicLabel ? "<div class='flair-wrapper'><a class='topic-flair' href='blog.php?topic_id={$topicId}'>{$topicLabel}</a></div>" : "") . "
            <h2>" . htmlspecialchars($post['title']) . "</h2>
            <p>" . nl2br(htmlspecialchars($post['content'])) . "</p>
            <div class='post-actions'>
                <form method='post' action='vote.php' style='display:inline;'>
                    <input type='hidden' name='post_id' value='{$postId}'>
                    <input type='hidden' name='vote' value='up'>
                    <button class='vote upvote'>⬆</button>
                </form>
                <span class='vote-score'>{$score}</span>
                <form method='post' action='vote.php' style='display:inline;'>
                    <input type='hidden' name='post_id' value='{$postId}'>
                    <input type='hidden' name='vote' value='down'>
                    <button class='vote downvote'>⬇</button>
                </form>
                <span class='comments'>" . count($comments) . " Comments</span>
            </div>
        </div>

        {$commentsHtml}

        <div class='comment-form'>
            <h3>Leave a Comment</h3>
            <form method='post' action='submit_comment.php'>
                <textarea name='comment_text' placeholder='Write your comment...' rows='3' required></textarea>
                <input type='hidden' name='post_id' value='{$postId}'>
                <button class='submit-comment-btn' type='submit'>Submit</button>
            </form>
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
