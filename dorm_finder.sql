-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 30 May 2024, 09:25:18
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dorm_finder`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '$2a$12$cMVwTOyf7rSMREVBxKa9Oe6DCfOtzYRG.ysF4lY2cuqzjQ1XzHIwC', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `requested_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `contact_requests`
--

INSERT INTO `contact_requests` (`id`, `requester_id`, `requested_id`, `status`, `created_at`) VALUES
(1, 18, 19, 'approved', '2024-05-30 05:10:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dorm_comments`
--

CREATE TABLE `dorm_comments` (
  `id` int(11) NOT NULL,
  `dorm_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dorm_owners`
--

CREATE TABLE `dorm_owners` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `dormName` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  `dormWebsite` varchar(255) DEFAULT NULL,
  `dormContactNumber` varchar(20) DEFAULT NULL,
  `dormEmail` varchar(255) DEFAULT NULL,
  `dormAddress` text DEFAULT NULL,
  `dormFeatures` text DEFAULT NULL,
  `dormRating` decimal(3,2) DEFAULT NULL,
  `dormReviews` text DEFAULT NULL,
  `dormImage` varchar(255) DEFAULT NULL,
  `ratingCount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `dorm_owners`
--

INSERT INTO `dorm_owners` (`id`, `name`, `surname`, `username`, `dormName`, `password`, `email`, `phone`, `is_approved`, `dormWebsite`, `dormContactNumber`, `dormEmail`, `dormAddress`, `dormFeatures`, `dormRating`, `dormReviews`, `dormImage`, `ratingCount`) VALUES
(17, 'Utku', 'Kaba', 'popart', 'Popart Dorm', '$2y$10$v0qbLVnkVg2wwag7ZHdIFucEAUonyoRuxWnI1c0QEOrCv4r91.cWa', 'utku@gmail.com', '+905338846165', 1, 'https://www.popart.com/', '+4440222', 'iletisim@popart.com', 'KKTC, Gazimağusa, Doğu Akdeniz Üniversitesi, Güney Kampüsü', 'Kafe, Güvenlik, Market, Kırtasiye, Çamaşırhane', 4.00, '', 'uploads/popart.jpg', 1),
(18, 'Hasan', 'Kafalı', 'nural', 'Nural Dorm', '$2y$10$EBuLN9BkeHMol4IiJwQoNeJbl81t/gyznUye.2oT6ZtEao7JSa/Ei', 'hasan@gmail.com', '+905338846165', 1, 'https://www.nural.com/', '+4440111', 'iletisim@nural.com', 'KKTC, Gazimağusa, Doğu Akdeniz Üniversitesi, Güney Kampüsü', 'Resturant, Kırtasiye, Çamaşırhane', 0.00, '', 'uploads/nuraldorm.jpg', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dorm_ratings`
--

CREATE TABLE `dorm_ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dorm_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `dorm_ratings`
--

INSERT INTO `dorm_ratings` (`id`, `user_id`, `dorm_id`, `rating`) VALUES
(1, 18, 17, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dorm_rooms`
--

CREATE TABLE `dorm_rooms` (
  `id` int(11) NOT NULL,
  `dorm_owner_id` int(11) DEFAULT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `size_sqm` int(11) DEFAULT NULL,
  `annual_price` decimal(10,2) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL,
  `room_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `dorm_rooms`
--

INSERT INTO `dorm_rooms` (`id`, `dorm_owner_id`, `room_name`, `capacity`, `size_sqm`, `annual_price`, `features`, `created_at`, `image_path`, `room_quantity`) VALUES
(46, 17, 'Tek Kişilik Oda', 1, 150, 15000.00, 'Kartlı Giriş Sistemi, Klima, Çalışma Masası ve Sandalyesi, Boy Aynası, Buzdolabı', '2024-05-30 05:15:08', 'uploads/tekkisilik.jpg', 5),
(47, 17, 'İki Kişilik Oda', 2, 200, 10000.00, 'Kartlı Giriş Sistemi, Ocak, Kettle, Çalışma Masası ve Sandalyesi, TV', '2024-05-30 05:15:36', 'uploads/ikikisilik.jpg', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dorm_id` int(11) NOT NULL,
  `type` enum('istek','sikayet','oneri') NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `dorm_id`, `type`, `message`, `created_at`) VALUES
(1, 18, 17, 'oneri', 'Çok fazla sivri sinek var, lütfen ilaçlama yapın!', '2024-05-30 05:16:50'),
(2, 18, 17, 'istek', 'Yurdun ortak alanına havuz yapılsın.', '2024-05-30 05:19:17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reservation_requests`
--

CREATE TABLE `reservation_requests` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `dorm_room_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `reservation_requests`
--

INSERT INTO `reservation_requests` (`id`, `student_id`, `dorm_room_id`, `status`, `created_at`) VALUES
(1, 18, 47, 'pending', '2024-05-30 05:16:56');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `birthDate` date NOT NULL,
  `department` varchar(100) NOT NULL,
  `roomMatePreferences` text DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `username`, `password`, `gender`, `email`, `phone`, `birthDate`, `department`, `roomMatePreferences`, `is_approved`) VALUES
(18, 'Tolga', 'Kartal', 'tolgakartal', '$2y$10$4NEflmhJy0hObpTjMllOieqT9lZE6EX/m7NuyE9Jwpta6Uj6dyGEO', 'Male', 'tolga@gmail.com', '+905338846165', '2002-07-24', 'IT', '[\"yes\",\"yes\",\"no\",\"yes\",\"no\"]', 1),
(19, 'Esra', 'Öncel', 'esraoncel', '$2y$10$hvIYvbhdsL9DCRQ0XkRxKOur.qxRAzdFPUs2BQxkxKRcrJp8gfDp6', 'Female', 'esraoncel@gmail.com', '+905338846165', '2002-07-24', 'IT', '[\"no\",\"no\",\"yes\",\"yes\",\"yes\"]', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `wall_comments`
--

CREATE TABLE `wall_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_surname` varchar(255) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_anonymous` tinyint(1) DEFAULT NULL,
  `commented_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `wall_comments`
--

INSERT INTO `wall_comments` (`id`, `user_id`, `user_name`, `user_surname`, `post_id`, `comment`, `is_anonymous`, `commented_at`) VALUES
(16, 19, 'Esra', 'Öncel', 30, 'Selam, naber?', 0, '2024-05-30 05:04:39'),
(17, 19, 'Esra', 'Öncel', 30, 'Çok Gıcıksın!', 1, '2024-05-30 05:04:49'),
(18, 18, 'Tolga', 'Kartal', 31, 'Ahaha, anonimken nasıl bulmamı bekliyorsun? :)\r\n', 1, '2024-05-30 05:06:40');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `wall_posts`
--

CREATE TABLE `wall_posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `posted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_anonymous` tinyint(1) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_surname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `wall_posts`
--

INSERT INTO `wall_posts` (`post_id`, `user_id`, `content`, `posted_at`, `is_anonymous`, `user_name`, `user_surname`) VALUES
(30, 18, 'Herkese Selam!', '2024-05-30 05:02:26', 0, 'Tolga', 'Kartal'),
(31, 18, 'Bugün okulun giriş kapısındaki sarışın kız.. Beni bul!', '2024-05-30 05:06:25', 1, 'Tolga', 'Kartal');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requester_id` (`requester_id`),
  ADD KEY `requested_id` (`requested_id`);

--
-- Tablo için indeksler `dorm_comments`
--
ALTER TABLE `dorm_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dorm_id` (`dorm_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Tablo için indeksler `dorm_owners`
--
ALTER TABLE `dorm_owners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `dorm_ratings`
--
ALTER TABLE `dorm_ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`dorm_id`);

--
-- Tablo için indeksler `dorm_rooms`
--
ALTER TABLE `dorm_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dorm_owner_id` (`dorm_owner_id`);

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Tablo için indeksler `reservation_requests`
--
ALTER TABLE `reservation_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `dorm_room_id` (`dorm_room_id`);

--
-- Tablo için indeksler `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `wall_comments`
--
ALTER TABLE `wall_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Tablo için indeksler `wall_posts`
--
ALTER TABLE `wall_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `dorm_comments`
--
ALTER TABLE `dorm_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `dorm_owners`
--
ALTER TABLE `dorm_owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `dorm_ratings`
--
ALTER TABLE `dorm_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `dorm_rooms`
--
ALTER TABLE `dorm_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `reservation_requests`
--
ALTER TABLE `reservation_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `wall_comments`
--
ALTER TABLE `wall_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `wall_posts`
--
ALTER TABLE `wall_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD CONSTRAINT `contact_requests_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `contact_requests_ibfk_2` FOREIGN KEY (`requested_id`) REFERENCES `students` (`id`);

--
-- Tablo kısıtlamaları `dorm_comments`
--
ALTER TABLE `dorm_comments`
  ADD CONSTRAINT `dorm_comments_ibfk_1` FOREIGN KEY (`dorm_id`) REFERENCES `dorm_owners` (`id`),
  ADD CONSTRAINT `dorm_comments_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Tablo kısıtlamaları `dorm_rooms`
--
ALTER TABLE `dorm_rooms`
  ADD CONSTRAINT `dorm_rooms_ibfk_1` FOREIGN KEY (`dorm_owner_id`) REFERENCES `dorm_owners` (`id`);

--
-- Tablo kısıtlamaları `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`dorm_id`) REFERENCES `dorm_owners` (`id`);

--
-- Tablo kısıtlamaları `reservation_requests`
--
ALTER TABLE `reservation_requests`
  ADD CONSTRAINT `reservation_requests_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `reservation_requests_ibfk_2` FOREIGN KEY (`dorm_room_id`) REFERENCES `dorm_rooms` (`id`);

--
-- Tablo kısıtlamaları `wall_comments`
--
ALTER TABLE `wall_comments`
  ADD CONSTRAINT `wall_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `wall_posts` (`post_id`);

--
-- Tablo kısıtlamaları `wall_posts`
--
ALTER TABLE `wall_posts`
  ADD CONSTRAINT `wall_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
