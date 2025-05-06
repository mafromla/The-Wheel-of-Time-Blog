<?php
session_start();
require_once('../includes/Page.class.php');
require_once('../includes/database.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] > 2) {
    die('Access denied.');
}

$db = new Database();
$topics = $db->getAllTopics();

// Define topic options
$topicOptions = [
    "The One Power & Magic System",
    "The Ajahs of the Aes Sedai",
    "The Forsaken & Dark One’s Forces",
    "Cultures & Nations of Randland",
    "Ta’veren & Prophecies",
    "Epic Battles & Military Strategy",
    "Philosophy & Themes of the Wheel"
];

$selectedTopics = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topics'])) {
    $selectedTopics = $_POST['topics'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = trim($_POST['post-title'] ?? '');
    $selectedTopics = $_POST['topics'] ?? [];
    $content = trim($_POST['post-content'] ?? '');

    $mediaPath = null;
    if (!empty($_FILES['post-media']['name'])) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
            die('Upload directory does not exist or is not writable.');
        }

        $fileName = basename($_FILES['post-media']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['post-media']['tmp_name'], $targetPath)) {
            $mediaPath = '/uploads/' . $fileName;
        }
    }

    if ($title && $selectedTopics && $content) {
        $db->addPost($_SESSION['user_id'], $title, $selectedTopics, $content, $mediaPath);
        header('Location: blog.php');
        exit;
    } else {
        $error = "All fields except media are required.";
    }
}

$page = new Page();
$page->title = "Create Post";
$page->cssScripts = "
    <link rel='stylesheet' href='../css/styles.css'>
    <link rel='stylesheet' href='../css/create_post.css'>
    <script src='../js/script.js' defer></script>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
";

// Dynamic user name display
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

$page->content = "
    <main class='content blog-post-page'>
        <h2>Create a New Blog Post</h2>
        " . (!empty($error) ? "<p style='color:red;'>$error</p>" : "") . "
        <form action='create_post.php' method='post' enctype='multipart/form-data'>
            <div class='container'>
                <label for='post-title'><b>Title</b></label>
                <input type='text' placeholder='Enter Post Title' name='post-title' required>

                <label for='post-topics'><b>Topics</b></label>
                <select name='topics' required>
                    <option value='' disabled selected>Select a topic</option>
                    " . implode("", array_map(function($topic) use ($selectedTopics) {
                        return "<option value='" . htmlspecialchars($topic) . "' " . (in_array($topic, $selectedTopics) ? "selected" : "") . ">" . htmlspecialchars($topic) . "</option>";
                    }, $topicOptions)) . "
                </select>

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
