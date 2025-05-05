<?php
require_once(__DIR__ . '/config.php');

class Page
{
    public $root;
    public $title = "Default Title";
    public $cssScripts = "";
    public $headerContent = "";
    public $sidebarContent = "";
    public $content = "";
    public $footerContent = "";

    public function __construct() {
        global $root;
        $this->root = $root;
    }

    public function Display()
    {
        $this->DisplayHeader();
        $this->DisplaySidebar();
        $this->DisplayContent();
        $this->DisplayFooter();
    }

    protected function DisplayHeader()
    {
        // Default styles and scripts
        $defaultStyles = "
            <link rel='stylesheet' href='../css/styles.css'>
            <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
            <script src='../js/script.js' defer></script>
        ";

        echo "<!DOCTYPE html>\n";
        echo "<html lang='en'>\n";
        echo "<head>\n";
        echo "  <meta charset='UTF-8'>\n";
        echo "  <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
        echo "  <title>" . htmlspecialchars($this->title) . "</title>\n";
        echo $defaultStyles . "\n" . $this->cssScripts . "\n";
        echo "</head>\n";
        echo "<body>\n";

        echo "<header class='header'>\n";
        echo $this->headerContent ?: "
            <a href='index.php'>
                <img src='../Images/WOT_Logo.jpg' alt='The Wheel of Time Blog' class='logo'>
            </a>
            <div class='header-text'>
                <h1>The Wheel of Time Blog</h1>
                <p class='subtitle'>Your source for all things WoT</p>
            </div>
        ";
        echo "</header>\n";
    }

    protected function DisplaySidebar()
    {
        echo "<div class='w3-sidebar w3-bar-block w3-card w3-animate-left' id='mySidebar'>\n";
        echo "  <button type='button' onclick='closeSidebar()' class='w3-bar-item w3-button w3-large'>Close &times;</button>\n";
        echo $this->sidebarContent ?: "
            <a href='index.php' class='w3-bar-item w3-button custom-home-btn'>Home</a>
            <a href='blog.php' class='w3-bar-item w3-button'>Blog Posts</a>
            <a href='profile.php' class='w3-bar-item w3-button'>Profile</a>
            <a href='dashboard.php' class='w3-bar-item w3-button'>Dashboard</a>
        ";
        echo "</div>\n";
        echo "<div class='w3-container'>\n";
        echo "  <button type='button' class='w3-button w3-gray' onclick='openSidebar()'>☰ Menu</button>\n";
        echo "</div>\n";
    }

    protected function DisplayContent()
    {
        echo $this->content;
    }

    protected function DisplayFooter()
    {
        echo $this->footerContent ?: "
            <footer class='footer'>
                <div class='footer-about'>
                    <h3>About This Blog</h3>
                    <p>This is a fan project for the Wheel of Time series.</p>
                </div>
                <div class='footer-links'>
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='blog.php'>Blog</a></li>
                        <li><a href='profile.php'>Profile</a></li>
                        <li><a href='contact.php'>Contact</a></li>
                    </ul>
                </div>
            </footer>
        ";
        echo "\n</body>\n</html>\n";
    }
}
?>
