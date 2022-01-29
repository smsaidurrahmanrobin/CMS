-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2022 at 11:18 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(2, 'javascript'),
(15, 'JAVA'),
(17, 'php'),
(18, 'css'),
(19, 'movie'),
(20, 'bike'),
(22, 'html'),
(25, 'c++'),
(26, 'game'),
(35, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(5, 27, 'ACI Motors', 'acimotors@yamaha.com', 'That looks ugly. Just look at our Yamaha YZF R1! Comparing to our R1, that looks fatty and heavy AND slow.', 'APPROVED', '2021-12-20'),
(7, 1, 'robin', 'r@mail.com', 'That is an epic movie! Enjoyed watching it really! I highly recommend this movie to anyone who loves action/real live inspired/or gangster thriller movies.', 'APPROVED', '2021-12-20'),
(9, 28, 'John', 'john@shelby.com', 'hey tommy, how are you doing man without me, since i;m dead now!', 'APPROVED', '2021-12-20'),
(10, 28, 'artist', 'artist@email.com', 'hey, tommy whens the new season coming out? Is the shootings all doneeee ', 'UNAPPROVED', '2021-12-21'),
(15, 27, 'robin', 'r@email.com', 'wow!my fav bike just got new look', 'APPROVED', '2021-12-21'),
(20, 27, 'edwin', 'edwin@EMAIL.COM', 'THATS A NICE LOOKING BIKE !', 'UNAPPROVED', '2021-12-21'),
(30, 28, 'Grace', 'grace@dead.com', 'I am commenting from the grave, Tommy! In the mid bleak winter.', 'APPROVED', '2021-12-23'),
(32, 108, 'robin', 'r@email.com', 'That is my second most favorite bike, after the legendary Hayabusa, The Falcon.', 'APPROVED', '2021-12-27'),
(35, 1, 'john', 'john@email.com', 'this is also a test, test number 100', 'unapproved', '2022-01-01'),
(36, 1, 'john', 'john@email.com', 'this is also a test, test number 100', 'unapproved', '2022-01-01'),
(38, 1, 'John', 'acimotors@yamaha.com', 'test number 10000', 'unapproved', '2022-01-01'),
(39, 1, 'John', 'acimotors@yamaha.com', 'test number 10000', 'unapproved', '2022-01-01'),
(65, 27, 'robin', 'email@email.com', 'this is a comment', 'APPROVED', '2022-01-24'),
(67, 108, 'robin', 'ro@emil.com', 'testting', 'unapproved', '2022-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(23, 4, 27),
(24, 4, 109),
(26, 3, 108),
(27, 4, 108);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL,
  `likes` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `likes`) VALUES
(1, 2, 'John Dillenger was once public enemy number 1!', 'robin', '2021-12-29', 'publicenemy.jpg', '<p><strong>John Dillenger, public enemy number one is a great movie to watch. He was shot down by the FBI after a great gunfight!</strong></p>', 'movie, public enemy', 0, 'unpublished', 261, 0),
(27, 2, 'The New Generation of Hayabusa!', 'suzuki motorsports ', '2021-12-25', 'suzuki-hayabusa.jpg', 'This new generation of Suzuki Hayabusa resembles the design signature of the 1st & 2nd generation of Hayabusa. It is much more refined, polished, muscular in-line four cilynder four-stroke motor bike.                                                                                                                                                                                                                                                                ', 'suzuki,hayabusa,bike', 5, 'unpublished', 245, 4),
(28, 2, 'Peaky Blinders!', 'Thomas Shelby', '2021-12-24', 'download.jpg', ' Peaky Blinders Next and Most probably the final season is going to come in 2022 hopefully !                                             ', 'shelby', 6, 'unpublished', 2, 0),
(40, 20, 'The fastest NINJA Out There!', 'kawasaki', '2021-12-27', 'kawasaki_Ninja_H2R_Seattle_motorcycle_show.jpg', 'The Kawasaki Ninja H2 is a \"supercharged supersport\" class[8] motorcycle in the Ninja sportbike series, manufactured by Kawasaki Heavy Industries, featuring a variable-speed centrifugal-type supercharger.[9][10][11][12] The track-only variant is called Ninja H2R, and it is the fastest and most powerful production motorcycle on the market; it produces a maximum of 310 horsepower (230 kW) and 326 horsepower (243 kW) with ram air.[1] The H2R has 50% more power than the fastest street-legal motorcycles, while the street-legal Ninja H2 has a lower power output of 200 hp (150 kW)[13]–210 hp (160 kW) with ram air.[', 'ninja,h2,kawasaki,bike', 2, 'unpublished', 2, 0),
(61, 20, 'Gixxer SF MotoGp 2018', 'robin', '2021-12-29', 'gixxer sf.jpg', 'The bike currently I use as my daily driven is the Suzuki Gixxer SF MotoGP is a product of Suzuki. Its price is Tk 219,950.00. Suzuki is the brand of Japan. Suzuki Gixxer SF MotoGP is Assemble/Made in Bangladesh. This bike is powered by 154.9 cc engine which generates Maximum power 14.6 BHP @ 8000 rpm and its maximum torque is 14 NM @ 6000 rpm. Suzuki Gixxer SF MotoGP can runs 127 KM per hour and it burns fuel 45 KM per Liter (approx). ', 'gixxer,sf,suzuki', 0, 'unpublished', 0, 0),
(108, 35, 'Like test', 'rico', '2022-01-22', 'jquery.png', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'like, test, rico', 0, 'published', 15, 2),
(110, 35, 'realme', 'rico', '2022-01-24', '', '<p>realme wireless buds 2 neo</p>', 'realme', 0, 'unpublished', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(2, 'sr', '$2y$10$iusesomecrazystrings2uPeSnCBfbc5LtTfOxqgN2m1UyfvFL0Z6', 'sr', 'robin', 'rahman@test.com', '', 'admin', '', ''),
(3, 'rico', '$2y$12$3bTKiPMhifN3HvfwvRb/CuINIGFp8Ty3AOcf78jpyCZ3uOrYxhVAG', 'rico', 'elvin', 'rico@email.com', '', 'subscriber', '', '2c82f10f6142de103a98ef87f9ba608cf2623131268bd53a5d81e6fc7a9959bf4128c47db43d4065030c6e9a1ba34885e252'),
(4, 'robin', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', 'robin', 'rahman', 'robin@email.com', '', 'admin', '', 'e03dc8d95b17f40d02d0f322f7402a41b629f8847ce4746652ae9897461a8239644efa5950c02594478a01eebeb5e781d975'),
(43, 'shane', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', 's', 'h', 'shane@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(44, 'test', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', 'test', 'etst', 'tese@email', '', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(73, 'amitumi', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'ami@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', '290eacaecd827f32ce02b8fd24bb825eea6721df3377897cb0ee1c010d950e2cd7e5029a54f7b5dc09a1f0fb3575662e4dd4'),
(74, 'messi', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'messi@psg.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', 'ee7694e7271421fe1afbcd6f5a2b1757b99aff6f81ad85ed0bb64f482fcc54fcc3f2e8cb18d72430450d91dc881feca43994'),
(75, 'cena', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'cena@john.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(76, 'tummmm', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'wedw@edeede.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(77, 'luis', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'luis@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(78, 'here', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'wwefwe@enk.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(79, 'testcase', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'tesetcase@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(80, 'tension', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'tnsn@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(81, 'sdasd', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'dsfsdhaf@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(82, 'sense', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'sense@test.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(83, 'user1', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'user@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(84, 'user2', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'user2@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(85, 'newuser1', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'newuser1@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(86, 'newuser2', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'newuser2@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(87, 'newuser12', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'newuser12@email.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(88, 'newuser3', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'newuser3@e', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(89, 'new123', '$2y$10$iusesomecrazystrings2ui1qr860E30b0c9ijNqwCSwHnHdgz.1K', '', '', 'new123@e', '', 'subscriber', '$2y$10$iusesomecrazystrings22', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(0, 's3aa286pv4qtsqn67vtlqrklug', 1641131896),
(1, '5ce02ln9qcs8g97cvf08e358jm', 1640755889),
(2, 't0dfr2tsfrpo04mmjki27qpt2c', 1640754802),
(3, 'a6k86m75mrvkr0fqj0unr47n33', 1640753949),
(4, 'udo758nqsto6utgdi085q17h28', 1641676677),
(5, 'dfmaf2q9vaa623vgc1s1mjq0t9', 1640898832),
(6, 'djql31fbved6nomtvsbq9eqs7l', 1640874633),
(7, 'dv6oivmlt1pq9g00d3ispuh5nk', 1640874617),
(8, '', 1640875230),
(9, 'pqiibm38ushlo5jau01cui9joc', 1641271985),
(10, '88nkv1tjrm0dj69kddee0idhut', 1642931386),
(11, '6a3tbpntnvfpr28b78a0smoohr', 1641320016),
(12, 'gqek7k0nc9gd6q2n9ivojgvsj9', 1641334272),
(13, '21e8sqsakqi2d281ijqjgorcd0', 1641347433),
(14, 'kbv4jngb19h8a94la053gsq5ro', 1641347687),
(15, 'nncjigr85ecr28cfade3hc6doe', 1641363672),
(16, 'bvf592g6htn4mpbur6ich6tn13', 1641676018),
(17, 'ek0ds1el3pcq3m30uqlu6gg28b', 1641678375),
(18, 'bh2d6ggvjt9s32q7477qs2busd', 1641707268),
(19, 'l5s38qrev0uk12bu62c7u6nfkh', 1641788407),
(20, 'etmteopei4h7l7tea55a5gfeif', 1641868222),
(21, '836nogs9mrbiaugb0rjondoiha', 1641971777),
(22, '5ann8gl17ugul43cb9chroqblq', 1642233547),
(23, 'd38hv0gcammtmiovj52gld7mn5', 1642402127),
(24, 'fveb2jflap4kf8df0mt0gemdqh', 1642478293),
(25, '32mdjo3mql5u1uv6lvn120mit5', 1642559877),
(26, '886jcogh3rl44gajouao0sr5er', 1642575976),
(27, 'tqbubodk1mkheakru12p2fvnnk', 1642845865),
(28, 'p7llsb6ilr27en39402fkgja0u', 1643082910),
(29, 'p31nivcs9aitdipu37dhslq6i4', 1643084613);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
