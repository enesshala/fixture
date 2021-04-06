-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2021 at 10:49 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grooveappdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(20) NOT NULL,
  `contact_email` varchar(20) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `contact_gender` varchar(7) NOT NULL,
  `contact_favlang` varchar(50) NOT NULL,
  `contact_city` varchar(10) NOT NULL,
  `contact_subject` varchar(50) NOT NULL,
  `contact_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `contact_name`, `contact_email`, `contact_phone`, `contact_gender`, `contact_favlang`, `contact_city`, `contact_subject`, `contact_message`) VALUES
(2, 'Fitim Bytyqi', 'fitim.by@gmail.com', '45-965-063', 'male', 'Java, javascript', 'ferizaj', 'Job Appeal', 'I wanna know if u guys recruit interns. please let me know ;)');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_image` text DEFAULT NULL,
  `post_title` varchar(50) NOT NULL,
  `post_description` text NOT NULL,
  `post_category` varchar(20) NOT NULL,
  `post_author` int(11) NOT NULL,
  `post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_image`, `post_title`, `post_description`, `post_category`, `post_author`, `post_date`) VALUES
(1, 'assets/img/user2/posts/oH2JwBrP.jpg', 'Hello pokemon!', 'Play pokemon GO!', 'adventure', 6, '2021-01-30'),
(3, 'assets/img/fitimbyttyqi/posts/XsQuuIqT.gif', 'This is a post from the Administrator!', 'Only I can see this.', 'gaming', 1, '2021-01-30'),
(6, 'assets/img/user3/posts/1leHXXAo.jpg', 'Night walk with group!', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', 'adventure', 7, '2021-01-30'),
(7, 'assets/img/dipsi/posts/tSnein1O.gif', 'Nightmare', 'A nightmare, also called a bad dream,[1] is an unpleasant dream that can cause a strong emotional response from the mind, typically fear but also despair, anxiety or great sadness. However, psychological nomenclature differentiates between nightmares and bad dreams; specifically, people remain asleep during bad dreams, whereas nightmares can awaken individuals. The dream may contain situations of discomfort, psychological or physical terror, or panic. After a nightmare, a person will often awaken in a state of distress and may be unable to return to sleep for a short period of time.[2]\r\n\r\nNightmares can have physical causes such as sleeping in an uncomfortable position or having a fever, or psychological causes such as stress or anxiety. Eating before going to sleep, which triggers an increase in the body\'s metabolism and brain activity, can be a potential stimulus for nightmares.[3]\r\n\r\nRecurrent nightmares may require medical help, as they can interfere with sleeping patterns and cause insomnia.', 'education', 11, '2021-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `subscriber_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `subscriber_email`) VALUES
(2, 'rinor.jet@gmail.com'),
(3, 'elorina.ab@gmail.com'),
(4, 'xheneta.hy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `surname` varchar(25) DEFAULT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `status` char(5) NOT NULL DEFAULT 'user',
  `user_profile` text DEFAULT NULL,
  `about_user` text DEFAULT NULL,
  `facebook_link` varchar(100) DEFAULT NULL,
  `github_link` varchar(100) DEFAULT NULL,
  `address` varchar(55) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(25) DEFAULT NULL,
  `zipcode` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `surname`, `user_email`, `user_password`, `status`, `user_profile`, `about_user`, `facebook_link`, `github_link`, `address`, `city`, `state`, `zipcode`) VALUES
(1, 'fitimbyttyqi', NULL, NULL, 'fitim.by@gmail.com', '$2y$10$YPxvcuHM9xdIIX0DyR1hLeRkJoqEJ2fqDJOiW9BEK8FeQk85MXWLm', 'admin', 'assets/img/fitimbyttyqi/pokemon.gif', 'It\'s me JOKER!', 'https://www.facebook.com/fitimbyttyqi', 'https://github.com/fitimbyttyqi', NULL, NULL, NULL, NULL),
(2, 'admin1', NULL, NULL, 'admin1@gmail.com', '$2y$10$8lb7YCiWtA.XYFrizhcw9.hyduqdQSW51VuJ3EBmJ5RPRGSIvrTu.', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'admin2', NULL, NULL, 'admin2@gmail.com', '$2y$10$QPjcUU0dzdAwRMYSWIPpdu8f8lpDH0esIYNKLvdODxcEaB4f4S9bK', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'admin3', NULL, NULL, 'admin3@gmail.com', '$2y$10$dCsOkFciaukGoIfTY9.fTe//nuKyhobjOzZSbs8mHkzw7J0xbImdi', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'user1', NULL, NULL, 'user1@gmail.com', '$2y$10$LXnFWylSe9NBLQHhuYWZxOtMCGmNKc9GtlqLtDig1MZn9sfZoCe26', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'user2', NULL, NULL, 'user2@gmail.com', '$2y$10$BHS41oKP6/XyEEZ0.vo9/eDz/SlSg0YU3I.Gf5W7nEkdkmd87t6i2', 'user', 'assets/img/user2/photo1.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'user3', NULL, NULL, 'user3@gmail.com', '$2y$10$5jFqbV8uDTwfNjb4BSCNuOYIWUMzhOr6lQ3/IrVRkqBzc8RzLBkYm', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'admin4', NULL, NULL, 'admin4@gmail.com', '$2y$10$.0VX7Pt4qMmkZKoLO23SM.L25JnPF4st0LEelfDiVAyP02NvrnXLC', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'dipsi', NULL, NULL, 'enesishala@gmail.com', '$2y$10$rkqAQ9FIYwLyQElbN18idOsq9/nbCVvu70gcTJgHYhPJPohwmYIkK', 'admin', 'img/dipsi/enes.jpg', 'I built things for the web.', 'https://facebook.com/dipsique', 'https://github.com/enesshala', NULL, NULL, NULL, NULL),
(12, 'Enes Shala', NULL, NULL, 'enesshala@gmail.com', '$2y$10$JqV..j.g5bvxLPWq5HbGQO2yoR8dFhAsx8r8Ucxn.nJ5KMPVL1RVi', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `post_author` FOREIGN KEY (`post_author`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
