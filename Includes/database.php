<?php
require_once(__DIR__ . '/config.php');

class Database {
    private $connection;

    public function __construct() {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Manual constructor
    public static function create($user, $password, $db, $server) {
        $instance = new self();
        $instance->user = $user;
        $instance->password = $password;
        $instance->db = $db;
        $instance->server = $server;
        $instance->connect();
        return $instance;
    }

    public function connect() {
        $this->connection = new mysqli($this->server, $this->user, $this->password, $this->db);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function close() {
        if ($this->connection) {
            $this->connection->close();
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function queryAll($sql) {
        return $this->connection->query($sql);
    }

    public function queryArray($sql) {
        $result = $this->connection->query($sql);
        $rows = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    // ========== USERS ==========
    public function getUser($id) {
        return $this->queryArray("SELECT * FROM Users WHERE user_id = " . intval($id));
    }

    public function getAllUsers() {
        return $this->queryArray("SELECT * FROM Users");
    }

    public function findUserBy($column, $value) {
        $col = $this->connection->real_escape_string($column);
        $val = $this->connection->real_escape_string($value);
        return $this->queryArray("SELECT * FROM Users WHERE $col = '$val'");
    }

    public function addUser($username, $email, $password_hash) {
        $u = $this->connection->real_escape_string($username);
        $e = $this->connection->real_escape_string($email);
        $p = $this->connection->real_escape_string($password_hash);
        return $this->query("INSERT INTO Users (username, email, password_hash) VALUES ('$u', '$e', '$p')");
    }

    public function updateUser($id, $updates) {
        return $this->dynamicUpdate("Users", "user_id", $id, $updates);
    }

    public function deleteUser($id) {
        return $this->query("DELETE FROM Users WHERE user_id = " . intval($id));
    }

    // ========== PROFILES ==========
    public function getProfile($user_id) {
        return $this->queryArray("SELECT * FROM Profiles WHERE user_id = " . intval($user_id));
    }

    public function getAllProfiles() {
        return $this->queryArray("SELECT * FROM Profiles");
    }

    public function findProfileBy($column, $value) {
        $col = $this->connection->real_escape_string($column);
        $val = $this->connection->real_escape_string($value);
        return $this->queryArray("SELECT * FROM Profiles WHERE $col = '$val'");
    }

    public function addProfile($user_id, $first_name, $last_name, $bio, $profile_picture, $notifications_enabled = true) {
        $first = $this->connection->real_escape_string($first_name);
        $last = $this->connection->real_escape_string($last_name);
        $bio = $this->connection->real_escape_string($bio);
        $pic = $this->connection->real_escape_string($profile_picture);
        $notif = $notifications_enabled ? 1 : 0;
        return $this->query("INSERT INTO Profiles (user_id, first_name, last_name, bio, profile_picture, notifications_enabled) 
                             VALUES ($user_id, '$first', '$last', '$bio', '$pic', $notif)");
    }

    public function updateProfile($id, $updates) {
        return $this->dynamicUpdate("Profiles", "profile_id", $id, $updates);
    }

    public function deleteProfile($id) {
        return $this->query("DELETE FROM Profiles WHERE profile_id = " . intval($id));
    }

    // ========== POSTS ==========
    public function getPost($id) {
        return $this->queryArray("SELECT * FROM Posts WHERE post_id = " . intval($id));
    }

    public function getAllPosts() {
        return $this->queryArray("SELECT * FROM Posts");
    }

    public function findPostBy($column, $value) {
        $col = $this->connection->real_escape_string($column);
        $val = $this->connection->real_escape_string($value);
        return $this->queryArray("SELECT * FROM Posts WHERE $col = '$val'");
    }

    public function addPost($user_id, $title, $topics, $content, $media_path = null) {
        $title = $this->connection->real_escape_string($title);
        $topics = $this->connection->real_escape_string($topics);
        $content = $this->connection->real_escape_string($content);
        $media = $media_path ? "'" . $this->connection->real_escape_string($media_path) . "'" : "NULL";
        return $this->query("INSERT INTO Posts (user_id, title, topics, content, media_path) 
                             VALUES ($user_id, '$title', '$topics', '$content', $media)");
    }

    public function updatePost($id, $updates) {
        return $this->dynamicUpdate("Posts", "post_id", $id, $updates);
    }

    public function deletePost($id) {
        return $this->query("DELETE FROM Posts WHERE post_id = " . intval($id));
    }

    // ========== COMMENTS ==========
    public function getComment($id) {
        return $this->queryArray("SELECT * FROM Comments WHERE comment_id = " . intval($id));
    }

    public function getAllComments() {
        return $this->queryArray("SELECT * FROM Comments");
    }

    public function findCommentBy($column, $value) {
        $col = $this->connection->real_escape_string($column);
        $val = $this->connection->real_escape_string($value);
        return $this->queryArray("SELECT * FROM Comments WHERE $col = '$val'");
    }

    public function addComment($post_id, $user_id, $comment_text) {
        $text = $this->connection->real_escape_string($comment_text);
        return $this->query("INSERT INTO Comments (post_id, user_id, comment_text) 
                             VALUES ($post_id, $user_id, '$text')");
    }

    public function updateComment($id, $updates) {
        return $this->dynamicUpdate("Comments", "comment_id", $id, $updates);
    }

    public function deleteComment($id) {
        return $this->query("DELETE FROM Comments WHERE comment_id = " . intval($id));
    }

    // ========== RANKINGS ==========
    public function getRanking($id) {
        return $this->queryArray("SELECT * FROM Rankings WHERE ranking_id = " . intval($id));
    }

    public function getAllRankings() {
        return $this->queryArray("SELECT * FROM Rankings");
    }

    public function findRankingBy($column, $value) {
        $col = $this->connection->real_escape_string($column);
        $val = $this->connection->real_escape_string($value);
        return $this->queryArray("SELECT * FROM Rankings WHERE $col = '$val'");
    }

    public function addRanking($user_id, $post_id, $vote_type) {
        $type = $this->connection->real_escape_string($vote_type);
        return $this->query("INSERT INTO Rankings (user_id, post_id, vote_type) 
                             VALUES ($user_id, $post_id, '$type')");
    }

    public function updateRanking($id, $updates) {
        return $this->dynamicUpdate("Rankings", "ranking_id", $id, $updates);
    }

    public function deleteRanking($id) {
        return $this->query("DELETE FROM Rankings WHERE ranking_id = " . intval($id));
    }

    public function getVoteScore($post_id) {
        $sql = "
            SELECT 
                SUM(CASE WHEN vote_type = 'up' THEN 1 WHEN vote_type = 'down' THEN -1 ELSE 0 END) AS score
            FROM Rankings
            WHERE post_id = " . intval($post_id);
        $result = $this->queryArray($sql);
        return $result[0]['score'] ?? 0;
    }

    // Shared dynamic update method
    private function dynamicUpdate($table, $keyColumn, $id, $updates) {
        $set = [];
        foreach ($updates as $col => $val) {
            $col = $this->connection->real_escape_string($col);
            $val = $this->connection->real_escape_string($val);
            $set[] = "$col = '$val'";
        }
        $setString = implode(', ', $set);
        $sql = "UPDATE $table SET $setString WHERE $keyColumn = " . intval($id);
        return $this->query($sql);
    }

    // POSTS
    public function getAllPostsWithAuthor() {
        $sql = "
            SELECT p.*, u.username, pr.profile_picture
            FROM Posts p
            JOIN Users u ON p.user_id = u.user_id
            LEFT JOIN Profiles pr ON pr.user_id = u.user_id
            ORDER BY p.created_at DESC
        ";
        return $this->queryArray($sql);
    }

    // VOTES
    public function getUserVote($userId, $postId) {
        $query = "SELECT vote_type FROM Rankings WHERE user_id = ? AND post_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ii", $userId, $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['vote_type'] ?? null;
    }

    // COMMENTS
    public function getCommentsByPost($postId) {
        $postId = intval($postId);
        $sql = "SELECT * FROM Comments WHERE post_id = $postId ORDER BY created_at ASC";
        return $this->queryArray($sql);
    }
    
    // ========== TOPICS ==========
    public function getAllTopics() {
        return $this->queryArray("SELECT topic_id, name FROM Topics");
    }
    
}
?>
