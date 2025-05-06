# 🌀 The Wheel of Time Blog – Walk‑through Guide

This document is written for Professor Kenji to verify every feature quickly.

---

## 1  Quick‑start

| URL                                | What you’ll see | Must be logged in? | Role required |
|------------------------------------|-----------------|--------------------|---------------|
| `/Pages/index.php`                 | Home, slideshow, **Browse by Topic** cards | No | – |
| `/Pages/blog.php`                  | All posts (or filtered by `?topic_id=`) | No | – |
| `/Pages/post.php?id=<post_id>`     | Single post, comments, **topic flair** | No | – |
| `/Pages/login.php`                 | Login form      | No | – |
| `/Pages/signup.php`                | Registration    | No | – |
| `/Pages/create_post.php`           | New‑post form   | Yes | Admin and Poster |
| `/Pages/profile.php`               | Self‑profile edit page | Yes | Any |
| `/Pages/edit_user.php?id=x`        | Profile edit (self or other) | Yes | Admin **or** owner |
| `/Pages/dashboard.php`             | **Admin‑only** control panel | Yes | **Admin only** |

> **Admin credentials:** `admin / admin`  
> **Standard user:** `rand / rand`

---

## 2  Topic navigation (what to demo)

1. **Home → Browse by Topic**  
   - Seven cards are shown.  
   - Clicking, e.g., **“The Ajahs of the Aes Sedai”** sends you to:  
     ```
     /Pages/blog.php?topic_id=2
     ```
     Only posts whose `topic_id = 2` appear.

2. **Flairs inside blog feed** (`blog.php`)  
   - Each post shows a pill‑shaped **topic flair**.  
   - Clicking the flair performs the same topic filter.

3. **Flair inside single‑post view** (`post.php`)  
   - Located under author meta.  
   - Click jumps back to `blog.php?topic_id=` for that topic.

---

## 3  Voting & comments

* Any logged‑in user can up‑vote / down‑vote on both `blog.php` cards and `post.php`.  
* Comment box at bottom of `post.php`.  
* Users can delete **their own** comments; Admin can delete any.

---

## 4  Admin Dashboard (`dashboard.php`)

| Widget | What it shows |
|--------|---------------|
| **Users**            | Live list; each username links to `edit_user.php?id=` |
| **Posts**            | All posts (title is a link) |
| **Comments**         | Recent comments preview |
| **New Users / This Week** | Counter only |

* Route protection:  
  - If you hit `/Pages/dashboard.php` while **not** admin, you see the styled **Access Denied** screen (pink panel, `Return Home` button in #833).  
* From within dashboard, click a user → `edit_user.php?id=`:  
  - Admin can change role via dropdown, reset password, upload profile picture, etc.

---

## 5  Profile management

* **profile.php** (self‑service) – standard users update their bio, picture, notification toggle.  
* **edit_user.php** – Admin may edit *any* user or a user may edit **themselves** (route guard ensures only those two cases).

---

## 6  Data seeding

A single SQL script (`/Database/mali.sql`) :

1. Creates all tables in correct FK order  
2. Inserts **Roles**, **Topics**  
3. Seeds default users (`admin`, `rand`, plus three sample users) with **bcrypt** hashes  
4. Adds profiles, posts, comments, rankings (images referenced in `/Images/` or `/uploads/`).  

> After import, **no further manual data entry** is required to demo the app.

---

## 7  Grading checklist alignment

| Requirement from assignment | Where to test |
|-----------------------------|---------------|
| Dynamic posts/comments/votes | `blog.php`, `post.php` (topic filter, voting) |
| Logged‑in user can comment & rank | Login as `rand`, use `post.php` |
| Poster (role 2) CRUD on posts | Login as `demo`, create/edit/delete |
| Admin full CRUD on everything | Login as `admin`, open `dashboard.php` |
| Session‑based role limits | Try reaching `dashboard.php` as `rand` → denied |
| Remote deployment path | `http://www.kmvsolutions.net/ics325/students/2025/MAli/Pages/index.php` |

---

## 8  Known image paths

* Header logo: `/Images/WOT_Logo.png`
* Default avatar: `/Images/images.3.webp`
* Uploaded profile pics → `/Images/`
* Post media → `/uploads/`

---

## 9  Local vs Server configuration

* **Local** (XAMPP default): Database connection in `Includes/database.php` points to  
