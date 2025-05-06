/* ─────────────────────────────────────────────
   0.  Create / select database
   ───────────────────────────────────────────── */
CREATE DATABASE IF NOT EXISTS mali;
USE mali;

/* ─────────────────────────────────────────────
   1.  Core lookup tables: Roles  ▸  Topics
   ───────────────────────────────────────────── */
CREATE TABLE IF NOT EXISTS Roles (
    role_id   INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE
);

INSERT IGNORE INTO Roles (role_id, role_name) VALUES
 (1,'Admin'),
 (2,'Poster'),
 (3,'User');

/* Topics used by Posts */
CREATE TABLE IF NOT EXISTS Topics (
    topic_id INT AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(100) NOT NULL UNIQUE
);

INSERT IGNORE INTO Topics (topic_id, name) VALUES
 (1,'The One Power & Magic System'),
 (2,'The Ajahs of the Aes Sedai'),
 (3,'The Forsaken & Dark One’s Forces'),
 (4,'Cultures & Nations of Randland'),
 (5,'Ta’veren & Prophecies'),
 (6,'Epic Battles & Military Strategy'),
 (7,'Philosophy & Themes of the Wheel');

/* ─────────────────────────────────────────────
   2.  Users  ▸  Profiles
   ───────────────────────────────────────────── */
CREATE TABLE IF NOT EXISTS Users (
    user_id       INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    email         VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    role_id       INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES Roles(role_id)
);

CREATE TABLE IF NOT EXISTS Profiles (
    profile_id            INT AUTO_INCREMENT PRIMARY KEY,
    user_id               INT NOT NULL,
    first_name            VARCHAR(50),
    last_name             VARCHAR(50),
    bio                   TEXT,
    profile_picture       VARCHAR(255),
    notifications_enabled BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

/* Seed users (bcrypt hashes for “admin” and “rand”; demo hashes already supplied) */
INSERT IGNORE INTO Users (user_id, username,      email,                       password_hash,                                                                   created_at,             role_id)
VALUES
 (1,     'admin',        'admin@wheeloftimeblog.com', '$2y$10$naNh/Anpi8jgOVPgm6a9aue6xwyteZUmlXTAMDljyPVTRpRSUGRxS', '2025-04-01 10:00:00', 1),
 (2,     'rand',         'rand@wheeloftimeblog.com',  '$2y$10$qi1XfEPKw.85KvQwRxBBaOmg67HxB1x.Dwh/LMuRbs2sjajUnQUHS', '2025-04-01 10:05:00', 2),
 (3,     'matrim',       'mat@wheeloftimeblog.com',    '4d1aab1940db735b8a63e4c9685b5ec6',                           '2025-04-10 21:25:06', 3),
 (7,     'demo',         'demo@wheeloftimeblog.com',   '$2y$10$K.ilFQ4hl44w6QNTscxlumEsqLfeeg6bgXoTdSZ6r1Il4m4iLImdu', '2025-05-04 12:42:33', 2),
 (8,     'emcarter',     'emily.carter@test.com',      '$2y$10$GEepn23eCAnJE4FMm/2ahOazEPWMq37E4lKdY/tNwzudttrrBzV6', '2025-05-04 19:42:30', 2);

INSERT IGNORE INTO Profiles (profile_id, user_id, first_name, last_name, bio,                                   profile_picture, notifications_enabled) VALUES
 (1,          1,      'Site',  'Administrator', 'I manage the site.',            'admin_pic.jpg', 1),
 (2,          2,      'Rand',  'al\'Thor',      'The Dragon Reborn.',            'rand_pic.jpg',  1),
 (3,          3,      'Matrim','Cauthon',       'Lover of dice, luck, mischief', 'mat_pic.jpg',   1),
 (4,          7,      'Demo',  'Demo',          'I''m the demo user for the site','Loial.webp',    0),
 (5,          8,      'Emily', 'Carter',        'Red‑Ajah lore enthusiast.',     'Elaida_.webp',   0);

/* ─────────────────────────────────────────────
   3.  Posts  ▸  Comments  ▸  Rankings
   ───────────────────────────────────────────── */
CREATE TABLE IF NOT EXISTS Posts (
    post_id    INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    topic_id   INT NOT NULL,
    title      VARCHAR(255) NOT NULL,
    content    TEXT NOT NULL,
    media_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)  REFERENCES Users(user_id)  ON DELETE CASCADE,
    FOREIGN KEY (topic_id) REFERENCES Topics(topic_id)
);

CREATE TABLE IF NOT EXISTS Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id    INT NOT NULL,
    user_id    INT NOT NULL,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES Posts(post_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Rankings (
    ranking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NOT NULL,
    post_id    INT NOT NULL,
    vote_type  ENUM('up','down') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (user_id, post_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES Posts(post_id) ON DELETE CASCADE
);

/* Seed posts */
INSERT IGNORE INTO Posts (post_id, user_id, topic_id, title,                                            content,                         media_path,             created_at)
VALUES
 (1, 2, 1, 'The One Power Explained',                             'All about Saidin and Saidar…',     '/uploads/post1_image.jpg', '2025-04-01 11:00:00'),
 (2, 2, 7, 'The Pattern of the Wheel',                             'Deep dive into the Pattern…',      NULL,                      '2025-04-01 12:00:00'),
 (3, 3, 5, 'Horn of Valere',                                       'The horn has been found again…',   '/uploads/horn.jpg',       '2025-04-10 21:25:06'),
 (4, 7, 1, 'Tel’aran’rhiod: The World of Dreams',                  'Tel’aran’rhiod is a realm where…', NULL,                      '2025-05-04 15:40:54'),
 (5, 8, 2, 'The Blue Ajah: Seekers of Truth and Justice',          'Among the seven Ajahs…',           NULL,                      '2025-05-04 20:06:45');


-- Insert posts (complete, 5 entries)
INSERT INTO Posts (post_id, user_id, topic_id, title, content, media_path, created_at) VALUES
(1, 2, 1, 'The One Power Explained',
'Ever wondered how Saidin and Saidar work? Here’s an in-depth breakdown of channeling, the Two Halves of the One Power, and how they shape the world of The Wheel of Time.',
'/uploads/post1_image.jpg', '2025-04-01 11:00:00'),

(2, 2, 7, 'The Pattern of the Wheel',
'A deep dive into the metaphors and lore behind the Wheel of Time.',
NULL, '2025-04-01 12:00:00'),

(3, 3, 5, 'Horn of Valere',
'The horn has been found again...',
'/uploads/horn.jpg', '2025-04-10 21:25:06'),

(4, 7, 1, 'Tel’aran’rhiod: The World of Dreams',
'Tel aran rhiod, the World of Dreams, is a realm where reality and imagination intertwine. In this post, we journey into the depths of this alternate world—a place where thoughts become tangible and time flows differently. Discover how this mystical realm shapes the actions and destinies of those who dare enter its mysterious corridors.',
NULL, '2025-05-04 15:40:54'),

(5, 8, 2, 'The Blue Ajah: Seekers of Truth and Justice in the Hall of the Tower',
'Ever wondered how Saidin and Saidar work? Here’s an in-depth breakdown of channeling, the Two Halves of the One Power, and how they shape the world of The Wheel of Time.

What is the One Power?

The One Power is the energy that drives the universe in Robert Jordan’s The Wheel of Time series. It is the force that turns the Wheel of Time itself, weaving the Pattern of existence. The One Power is divided into two halves: Saidin, the male half, and Saidar, the female half. These two halves are complementary but distinct, each with its own characteristics and rules.

Saidin: The Male Half

Saidin is the half of the One Power that can be channeled by men. It is described as a raging torrent, wild and chaotic. Men who channel Saidin must wrestle with it, asserting their will to control its flow. This struggle is both a source of strength and a potential danger, as losing control can have devastating consequences.

During the Age of Legends, male Aes Sedai used Saidin to perform incredible feats, such as creating the Eye of the World and constructing the Stone of Tear. However, after the Dark One’s taint corrupted Saidin during the Breaking of the World, male channelers were driven mad, leading to widespread destruction. This taint remained until the events of the series, when it was finally cleansed.

Saidar: The Female Half

Saidar, on the other hand, is the half of the One Power that can be channeled by women. Unlike Saidin, Saidar is described as a gentle river, flowing smoothly and naturally. Women who channel Saidar must surrender to its flow, guiding it rather than forcing it. This surrender is key to mastering Saidar.

Female Aes Sedai have been the primary wielders of the One Power since the Breaking of the World, as they were unaffected by the Dark One’s taint. They have used Saidar to maintain order, heal the sick, and protect the world from the Shadow. The White Tower, home of the Aes Sedai, stands as a testament to their enduring influence.

Channeling: The Art of Weaving

Channeling is the process of drawing on the One Power and shaping it into weaves, which can then be used to perform various tasks. These weaves can be as simple as creating a light or as complex as healing a fatal wound. The ability to channel is innate, though it requires training to use effectively.

Both Saidin and Saidar have their own unique weaves, and some weaves can only be performed by one gender. For example, men are better at creating fire and earth weaves, while women excel at water and air weaves. However, there are also weaves that can only be achieved through cooperation between men and women, highlighting the complementary nature of the Two Halves.

The Dark One’s Influence

The Dark One’s taint on Saidin is one of the central conflicts of the series. This corruption not only drove male channelers mad but also made it nearly impossible for men to channel safely. The taint is described as a oily, black sludge that clings to Saidin, poisoning anyone who touches it.

Cleansing the taint is a major turning point in the series, as it restores balance to the One Power and allows male channelers to once again contribute to the fight against the Shadow. This event also symbolizes the importance of unity between men and women, as it is only through their combined efforts that the taint is removed.

The Future of the One Power

As the series progresses, the role of the One Power evolves. With the taint cleansed, male channelers begin to reclaim their place in the world, working alongside female Aes Sedai to prepare for the Last Battle. The rediscovery of lost weaves and the development of new ones further expand the possibilities of channeling.

Ultimately, the One Power is more than just a tool—it is a symbol of the balance between opposing forces. The interplay between Saidin and Saidar reflects the broader themes of the series, such as the importance of cooperation, the struggle against corruption, and the enduring hope for a better future.',
NULL, '2025-05-04 20:06:45');


/* Seed comments */
INSERT IGNORE INTO Comments (comment_id, post_id, user_id, comment_text, created_at) VALUES
 (1, 1, 1, 'Great post, Rand! Very informative.', '2025-04-01 13:00:00'),
 (3, 3, 7, 'The Horn of Valere has been rediscovered — exciting times!', '2025-05-04 18:31:20');

/* Seed votes */
INSERT IGNORE INTO Rankings (user_id, post_id, vote_type, created_at) VALUES
 (1, 1, 'up',  '2025-04-01 13:05:00'),
 (7, 4, 'up',  '2025-05-04 16:28:16'),
 (7, 3, 'up',  '2025-05-04 16:35:26'),
 (7, 1, 'up',  '2025-05-04 16:35:38'),
 (7, 2, 'up',  '2025-05-04 16:35:40'),
 (8, 4, 'up',  '2025-05-04 20:06:53'),
 (8, 1, 'up',  '2025-05-04 20:06:57');


