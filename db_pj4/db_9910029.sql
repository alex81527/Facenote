-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生日期: 2013 年 06 月 02 日 09:59
-- 伺服器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `db_pj4`
--

-- --------------------------------------------------------

--
-- 表的結構 `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `uid` varchar(15) NOT NULL,
  `postid` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`postid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `articles`
--

INSERT INTO `articles` (`uid`, `postid`, `content`, `time`) VALUES
('cmwang40', 1, 'Hello World!!', '2013-03-01 08:01:02'),
('cmwang40', 2, 'This is my <b>second</b> post!', '2013-03-02 16:31:48'),
('bbb', 4, 'Hello World!', '2013-03-14 19:35:42'),
('aaa', 5, 'Hello World! <br/>Database project 2!', '2013-03-14 19:13:20'),
('hckou51', 15, 'Sorrrrrry!!', '2013-03-15 08:16:06'),
('aaa', 789, 'My second post!', '2013-03-19 02:04:02'),
('aaa', 1363665318, 'My third post!', '2013-03-19 04:55:18'),
('aaa', 1363665366, 'My fourth post!', '2013-03-19 04:56:06'),
('aaa', 1363665439, 'My Fifth post!!!!!', '2013-03-19 11:57:19'),
('bbb', 1364609473, 'The higher my stamina, the faster my battery recharges? ', '1964-08-30 10:11:13'),
('bbb', 1364609761, 'By the way, does that mushroom recharge your batteries when you eat it? ', '1964-08-30 10:16:01'),
('bbb', 1364609800, 'I ate a Russian Glowcap and it charged up my batteries. ', '1964-08-30 10:16:40'),
('ccc', 1364610706, 'Good morning', '2013-03-30 10:31:46'),
('ddd', 1364610988, 'Say something...?', '2013-03-30 10:36:28'),
('aaa', 1365049490, 'Raining!!!', '2013-04-04 12:24:50'),
('aaa', 1365049610, 'Nooooooooooooo..........!', '2013-04-04 12:26:50'),
('ccc', 1365648567, 'Still rainging....', '2013-04-11 10:49:27'),
('aaa', 1366077299, 'Sunny Day~~~~~', '2013-04-16 09:54:59'),
('fff', 1366858324, 'I don''t have friends .....', '2013-04-25 10:52:04'),
('aaa', 1366858394, 'I''m your friend!!', '2013-04-25 10:53:14'),
('ccclark', 1366859061, 'I''m ccclark not ccc', '2013-04-25 11:04:21'),
('aaa', 1369711843, '"This is a test post for demo." : )', '2013-05-28 11:30:43'),
('aaa', 1369880650, 'asd', '2013-05-30 10:24:10'),
('aaa', 1370159840, 'zsdf', '2013-06-02 15:57:20'),
('aaa', 1370159920, 'welcome to DJ club!!!', '2013-06-02 15:58:40');

-- --------------------------------------------------------

--
-- 表的結構 `club`
--

CREATE TABLE IF NOT EXISTS `club` (
  `club_id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `owner` varchar(15) NOT NULL,
  PRIMARY KEY (`club_id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `club`
--

INSERT INTO `club` (`club_id`, `name`, `owner`) VALUES
(1370159906, 'DJ club', 'aaa');

-- --------------------------------------------------------

--
-- 表的結構 `club_articles`
--

CREATE TABLE IF NOT EXISTS `club_articles` (
  `club_id` bigint(20) NOT NULL,
  `article_id` bigint(20) NOT NULL,
  KEY `club_id` (`club_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `club_articles`
--

INSERT INTO `club_articles` (`club_id`, `article_id`) VALUES
(1370159906, 1370159920);

-- --------------------------------------------------------

--
-- 表的結構 `club_member`
--

CREATE TABLE IF NOT EXISTS `club_member` (
  `club_id` bigint(20) NOT NULL,
  `uid` varchar(15) NOT NULL,
  KEY `uid` (`uid`),
  KEY `uid_2` (`uid`),
  KEY `club_id` (`club_id`),
  KEY `uid_3` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `club_member`
--

INSERT INTO `club_member` (`club_id`, `uid`) VALUES
(1370159906, 'aaa'),
(1370159906, 'bbb');

-- --------------------------------------------------------

--
-- 表的結構 `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `uid` varchar(15) NOT NULL,
  `friend_id` varchar(15) NOT NULL,
  `relationship` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`uid`,`friend_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `friends`
--

INSERT INTO `friends` (`uid`, `friend_id`, `relationship`) VALUES
('aaa', 'bbb', 'sadf'),
('aaa', 'ccc', NULL),
('aaa', 'ccclark', NULL),
('aaa', 'ddd', NULL),
('aaa', 'fff', 'aaa'),
('aaa', 'sss', NULL),
('bbb', 'aaa', 'sadf'),
('bbb', 'sss', NULL),
('ccc', 'aaa', NULL),
('ccc', 'ccclark', 'ccclark'),
('ccc', 'ddd', NULL),
('ccclark', 'aaa', NULL),
('ccclark', 'ccc', 'ccclark'),
('cmwang40', 'hckou51', NULL),
('ddd', 'aaa', NULL),
('ddd', 'ccc', NULL),
('fff', 'aaa', 'aaa'),
('hckou51', 'cmwang40', NULL),
('sss', 'aaa', NULL),
('sss', 'bbb', NULL);

-- --------------------------------------------------------

--
-- 表的結構 `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `postid` bigint(20) NOT NULL,
  `uid` varchar(15) NOT NULL,
  PRIMARY KEY (`postid`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `likes`
--

INSERT INTO `likes` (`postid`, `uid`) VALUES
(1364609761, 'aaa'),
(1364610988, 'aaa'),
(1366077299, 'bbb'),
(1369711843, 'bbb'),
(1370159920, 'bbb'),
(5, 'ccc'),
(1364610988, 'ccc'),
(1366077299, 'ccc'),
(1365648567, 'ddd'),
(1366077299, 'ddd'),
(1366077299, 'sss');

-- --------------------------------------------------------

--
-- 表的結構 `main_articles`
--

CREATE TABLE IF NOT EXISTS `main_articles` (
  `uid` varchar(15) NOT NULL,
  `article_id` bigint(20) NOT NULL,
  KEY `uid` (`uid`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `main_articles`
--

INSERT INTO `main_articles` (`uid`, `article_id`) VALUES
('cmwang40', 1),
('cmwang40', 2),
('bbb', 4),
('aaa', 5),
('hckou51', 15),
('aaa', 789),
('aaa', 1363665318),
('aaa', 1363665366),
('aaa', 1363665439),
('bbb', 1364609473),
('bbb', 1364609761),
('bbb', 1364609800),
('ccc', 1364610706),
('ddd', 1364610988),
('aaa', 1365049490),
('aaa', 1365049610),
('ccc', 1365648567),
('aaa', 1366077299),
('fff', 1366858324),
('aaa', 1366858394),
('ccclark', 1366859061),
('aaa', 1369711843),
('aaa', 1369880650);

-- --------------------------------------------------------

--
-- 表的結構 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `from_uid` varchar(15) NOT NULL,
  `to_uid` varchar(15) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  KEY `from_uid` (`from_uid`),
  KEY `to_uid` (`to_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `message`
--

INSERT INTO `message` (`from_uid`, `to_uid`, `content`, `date`) VALUES
('aaa', 'bbb', 'asdd', '2013-05-21 00:00:00'),
('aaa', 'bbb', '123', '2013-05-26 00:00:00'),
('bbb', 'aaa', '123d4d56', '2013-05-30 12:31:58'),
('bbb', 'aaa', '123d4d56', '2013-05-30 12:32:49');

-- --------------------------------------------------------

--
-- 表的結構 `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `response_id` bigint(20) NOT NULL,
  `article_id` bigint(20) NOT NULL,
  `uid` varchar(15) NOT NULL,
  `response` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`response_id`),
  KEY `article_id` (`article_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `responses`
--

INSERT INTO `responses` (`response_id`, `article_id`, `uid`, `response`, `time`) VALUES
(1369711892, 1369711843, 'bbb', 'aaaaaaaa', '2013-05-28 11:31:32'),
(1369711914, 1369711843, 'aaa', 'bbbbbbbb', '2013-05-28 11:31:54'),
(1369832398, 1363665318, 'aaa', 'asdasd', '2013-05-29 20:59:58'),
(1370159963, 1370159920, 'bbb', 'say yo~', '2013-06-02 15:59:23');

-- --------------------------------------------------------

--
-- 表的結構 `responses_likes`
--

CREATE TABLE IF NOT EXISTS `responses_likes` (
  `response_id` bigint(20) NOT NULL,
  `uid` varchar(15) NOT NULL,
  PRIMARY KEY (`response_id`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `responses_likes`
--

INSERT INTO `responses_likes` (`response_id`, `uid`) VALUES
(1369711892, 'bbb');

-- --------------------------------------------------------

--
-- 表的結構 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` varchar(15) NOT NULL,
  `password` char(32) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `sex` enum('M','F') NOT NULL DEFAULT 'M',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 轉存資料表中的資料 `users`
--

INSERT INTO `users` (`uid`, `password`, `name`, `email`, `birthday`, `sex`) VALUES
('aaa', '47bce5c74f589f4867dbd57e9ca9f808', 'Andy A. Adams', 'aaa@bbb.cc', '1980-01-01', 'M'),
('bbb', '08f8e0260c64418510cefb2b06eee5cd', 'Big Boss', 'bbb@bbb.cc', '1935-01-03', 'M'),
('ccc', '9df62e693988eb4e1e1444ece0578579', 'C. C. Clark', 'ccc@aaa.bb', '1980-03-01', 'M'),
('ccclark', '01b3b897eb4e6f81318a07cdcb8231df', 'C. C. Clark', 'ccclark@facenote.com', '1992-07-31', 'F'),
('cmwang40', 'ae482a26d5186e1dde5a17d91080758c', 'Chien-Ming Wang', 'cmwang@ct.com.tw', '1980-03-31', 'M'),
('ddd', '77963b7a931377ad4ab5ad6a9cd718aa', 'Diana DD.', 'dd@aaa.bb', '1985-03-01', 'F'),
('eee', 'd2f2297d6e829cd3493aa7de4416a18f', 'Eric E. Edwards', 'eee@facenote.com', '1999-04-19', 'M'),
('fff', '343d9040a671c45832ee5381860e2996', 'Franklin "Frank" Foster', 'fff5566@facenote.com', '1977-02-28', 'M'),
('hckou51', '3266a050819fe8326a8b811c7b352328', 'Hung-Chih Kuo', 'hckou@ct.com.tw', '1981-07-23', 'M'),
('sss', '9f6e6800cfae7749eb6c486619254b9c', 'Solid Snake', 'ss@sss.com', '1972-01-01', 'M');

--
-- 匯出資料表的 Constraints
--

--
-- 資料表的 Constraints `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE;

--
-- 資料表的 Constraints `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 資料表的 Constraints `club_articles`
--
ALTER TABLE `club_articles`
  ADD CONSTRAINT `club_articles_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club` (`club_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `club_articles_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`postid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 資料表的 Constraints `club_member`
--
ALTER TABLE `club_member`
  ADD CONSTRAINT `club_member_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club` (`club_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `club_member_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 資料表的 Constraints `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`uid`) ON DELETE CASCADE;

--
-- 資料表的 Constraints `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `articles` (`postid`) ON DELETE CASCADE;

--
-- 資料表的 Constraints `main_articles`
--
ALTER TABLE `main_articles`
  ADD CONSTRAINT `main_articles_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`postid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `main_articles_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 資料表的 Constraints `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`from_uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`to_uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 資料表的 Constraints `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE;

--
-- 資料表的 Constraints `responses_likes`
--
ALTER TABLE `responses_likes`
  ADD CONSTRAINT `responses_likes_ibfk_1` FOREIGN KEY (`response_id`) REFERENCES `responses` (`response_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_likes_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
