# The Wheel of Time Blog

A responsive blogging platform inspired by *The Wheel of Time* universe. Built with PHP, MySQL, and vanilla JavaScript, it allows users to explore lore-based topics, create posts, comment, and vote — with role-based access control for posters and administrators.

---

## Features

- **User Authentication & Roles**
  - Roles: Admin, Poster, and User
  - Role-based access control for posts, comments, and dashboard
- **Dynamic Content**
  - Topic-based post filtering
  - Voting (up/down) on posts
  - Commenting system with moderation
- **Admin Dashboard**
  - Manage users, posts, and comments
  - Role assignment and profile edits
- **Profile Management**
  - User bios, profile pictures, notification toggles
- **Mobile-Responsive UI**
  - Clean layout with topic cards and slideshow
- **Database Seeding**
  - Preloaded topics, users, and sample posts for quick demo

---

## Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP 7+, MySQL
- **Environment:** XAMPP / LAMP stack
- **Version Control:** Git & GitHub

---

## Screenshots

*(Add your screenshots in `/Images/` and reference them here)*

### Home Page
![Home Page Screenshot](Images/homepage-screenshot.png)

### Blog Listing by Topic
![Blog Page Screenshot](Images/blog-topic-screenshot.png)

### Single Post with Comments
![Single Post Screenshot](Images/single-post-screenshot.png)

### Admin Dashboard
![Admin Dashboard Screenshot](Images/admin-dashboard-screenshot.png)

### Profile Management
![Profile Screenshot](Images/profile-screenshot.png)

---

## Project Structure

```
The-Wheel-of-Time-Blog/
├─ CSS/           # Stylesheets
├─ Database/      # Database seed (mali.sql)
├─ Images/        # Logos, avatars, uploaded images
├─ Includes/      # Config and database connection files
├─ JS/            # Client-side scripts
├─ Pages/         # All app pages (blog, post, login, dashboard, etc.)
├─ index.php      # Entry point
└─ install-web.sh # Optional shell installer
```

---

## Getting Started

### Prerequisites

- PHP 7.4+  
- MySQL 5.7+  
- XAMPP (or similar local dev environment)  

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/mafromla/The-Wheel-of-Time-Blog.git
   ```
2. **Move to your web root**
   ```
   C:\xampp\htdocs\The-Wheel-of-Time-Blog\
   ```
3. **Configure database connection**  
   Edit `Includes/config.php`:
   ```php
   define('DB_HOST','127.0.0.1');
   define('DB_USER','root');
   define('DB_PASS','');
   define('DB_NAME','mali');
   $root = '/The-Wheel-of-Time-Blog/';
   ```
4. **Import the database**
   - Go to [phpMyAdmin](http://localhost/phpmyadmin)
   - Create a database named `mali`
   - Import `Database/mali.sql`
5. **Run the application**
   - Navigate to:  
     [http://localhost/The-Wheel-of-Time-Blog/Pages/index.php](http://localhost/The-Wheel-of-Time-Blog/Pages/index.php)

---

## Suggested Demo Flow (For Recruiters)

- **Home Page:** Show slideshow and topic cards
- **Topic Filtering:** Click a topic card to view related posts
- **Single Post View:** Show voting and commenting in action
- **Login / Register:** Demonstrate user signup and login flow
- **Create Post:** Show how Posters/Admins can add content
- **Admin Dashboard:** Manage users, assign roles, edit content

---

## Known Paths

- Default logo: `/Images/WOT_Logo.png`
- Default avatar: `/Images/images.3.webp`
- User uploads: `/Images/` and `/uploads/`

---

## License

This project is for demonstration and portfolio purposes.

---
