-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2023 at 07:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creatorname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `datetime`, `name`, `creatorname`) VALUES
(37, '28-12-22 14:07:50', 'sports', 'AtikHasan'),
(38, '28-12-22 19:48:52', 'fashion', 'AtikHasan'),
(39, '28-12-22 19:49:11', 'food', 'AtikHasan'),
(42, '28-12-22 21:34:59', 'education', 'AtikHasan'),
(46, '28-12-22 21:55:02', 'business', 'tanha'),
(47, '28-12-22 21:55:33', 'life&living', 'tanha'),
(48, '28-12-22 21:55:52', 'youth', 'tanha'),
(49, '28-12-22 22:06:47', 'enter', 'tanha'),
(50, '28-12-22 22:06:57', 'entertainment', 'tanha');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `datetime` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `status` varchar(5) NOT NULL,
  `post_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `status`, `post_no`) VALUES
(12, '27-12-22 13:25:11', 'shamima', 's@c', 'bangladesh jitse yeeeeeeee', 'ON', 14),
(13, '27-12-22 18:44:25', 'shamima tajmim tanha', 'stajmimtanha@gmail.com', 'Bangladesh resumed at seven without loss. Mominul Haque, the highest scorer of Bangladesh in the first innings', 'ON', 14),
(14, '29-12-22 13:29:55', 'tanha', 'tanha@gmail.com', 'very glad to know this post.....\r\n', 'ON', 21),
(15, '29-12-22 18:42:23', 'atik', 'atik@gmail.com', 'nice post', 'ON', 24);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `post` varchar(10000) NOT NULL,
  `Like` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`, `Like`) VALUES
(14, '01-01-23 13:53:11', 'Dhaka Test: Bangladesh secure 71-4 before lunch', 'sports', 'tanha', 'bdsports.jpg', 'Offspinner Ravichandran Ashwin gave India first breakthrough in just second over of the day, trapping opener Najmul Hossain Shanto leg-before for 5 as Bangladesh resumed at seven without loss.\r\n\r\nMominul Haque, the highest scorer of Bangladesh in the first innings, then edged pacer Mohammed Siraj delivery behind the wicket for just 5.', 1),
(15, '26-12-22 16:06:41', 'Marmalade Self-saucing Puddings ', 'food', 'Tanha', 'food.jpg', 'Ingredients:\r\nv    80g orange marmalade, plus 2 tbs extra\r\nv    185g unsalted butter\r\nv    125g self-raising flour, sifted\r\nv    1/2 cup (110g) caster sugar\r\nv    Finely grated zest of 2 oranges\r\nv    1/2 tsp ground cardamom\r\nv    1 egg\r\nv    100ml milk\r\nv    1 tsp vanilla bean paste\r\nv    Thickened cream, to serve\r\nMethod:\r\n1.    Preheat oven to 160oC. Grease four 1 cup (250ml) ramekins, and spoon 1 tbs orange marmalade into the base of each.\r\n2.    Place 85g butter in a small saucepan over low heat. Stir until melted then remove from heat and cool.\r\n\r\n\r\n3.    Combine flour, sugar, orange zest and cardamom in a bowl. In a separate large bowl, lightly beat the egg, then stir in the milk, melted butter and vanilla. Add the flour mixture and stir to combine. Divide batter among ramekins until two-thirds full. Place on a baking tray and bake for 40 minutes or until the centres spring back when lightly pressed. Set aside to cool slightly.\r\n4.    Meanwhile, to make the brown butter, place remaining 100g butter in a saucepan over medium-high heat. Swirling the pan, cook for 5 minutes or until nutty brown. Add the extra 2 tbs marmalade and stir to melt.\r\n5.    Turn warm puddings out into bowls and drizzle with brown butter and cream to serve.', 0),
(18, '28-12-22 21:50:36', 'Difference between Artificial intelligence and Machine learning', '', 'Tanha', 'learning.png', 'Artificial intelligence is a field of computer science which makes a computer system that can mimic human intelligence. It is comprised of two words \"Artificial\" and \"intelligence\", which means \"a human-made thinking power.\" Hence we can define it as, Artificial intelligence is a technology using which we can create intelligent systems that can simulate human intelligence. The Artificial intelligence system does not require to be pre-programmed, instead of that, they use such algorithms which can work with their own intelligence. It involves machine learning algorithms such as Reinforcement learning algorithm and deep learning neural networks. AI is being used in multiple places such as Siri, Google?s AlphaGo, AI in Chess playing, etc. Based on capabilities, AI can be classified into three types: Weak AI General AI Strong AI Currently, we are working with weak AI and general AI. The future of AI is Strong AI for which it is said that it will be intelligent than humans. Machine learning Machine learning is about extracting knowledge from the data. It can be defined as, Machine learning is a subfield of artificial intelligence, which enables machines to learn from past data or experiences without being explicitly programmed.', 0),
(19, '28-12-22 22:01:17', 'Australia eye victory after Carey century in 2nd South Africa Test', 'sports', 'tanha', 'prothomalo-english_2022-12_917707b6-7347-49a7-9fb4-72644fda3fd1_823534_01_02.webp', 'Australia closed in on winning the second Test and the series against South Africa on Wednesday after Alex Carey struck a maiden century to leave them in a commanding position.\r\n\r\nThe hosts declared at tea on 575-8 on day three with an ominous lead of 386 after South Africa were bowled out in their first innings for 189.\r\n\r\nIn reply, the Proteas were 15-1 when play was abandoned early at the Melbourne Cricket Ground due to persistent drizzle.\r\n\r\nTheir bid to save the Test, and the three-match series after losing the opener in Brisbane, got off to a horror start with under-pressure skipper Dean Elgar caught by Carey off Pat Cummins without scoring in the second over.', 0),
(20, '28-12-22 22:04:07', '44th BCS written tests of Arabic, Islamic studies on 11 January', 'youth', 'tanha', 'youth.webp', 'The written tests of Arabic and Islamic studies modules for the 44th Bangladesh Civil Service (BCS) examinations will be held on 11 January, 2023, reports UNB.\r\n\r\nBangladesh Public Service Commission (PSC) issued a press release on this regard on Monday.\r\n\r\nThe written tests for Arabic  (131) and Islamic Studies (201) of all the candidates will be held from 10.00am to 2.00pm on the day at Dhaka center of BPSC 71 Auditorium in the capital’s Agargaon area, the notice stated.', 0),
(21, '29-12-22 13:53:42', 'CSE Female CoCurricular Day', 'education', 'tanha', 'sportt.jpg', 'অনুকূল আবহাওয়ায় প্রিয় ক্যাম্পাসের Female মাঠে বেলা ১১টা থেকে শুরু হয় আমাদের কর্মসূচী। কুরআন তিলাওয়াত এবং ছোট একটি উদ্বোধনী অনুষ্ঠানের মাধ্যমে আমাদের ব্যাডমিন্টন টুর্নামেন্টের ফাইনাল ম্যাচের সূচনা হয়। উদ্বোধন করেন সম্মানিত হেড শারমিনা জামান ম্যাম এবং মনোয়ারা সুলতানা মর্জিনা ম্যাম। Finalist টিমগুলো ছিল Team Gladiator (ফাবিহা আফাফ - 60 ব্যাচ, মিশিলা মারওয়া - 60 ব্যাচ) এবং Team Virus (ফাহমিদা হাকিম সূচিতা - 58 ব্যাচ, নাইমুন জান্নাত প্রাপ্তি - 57 ব্যাচ)। টুর্নামেন্টে বিজয়ী হয় Team Gladiator। উল্লেখ্য আমাদের ডিপার্টমেন্টে এটাই প্রথম কোনো Female টুর্নামেন্ট।\r\nএরপর ছিল Throwing Ball Game। ১ মিনিটে সর্বোচ্চ ৬টি বল নিক্ষেপ করে ১ম হয় ফাবিহা আফাফ (60 ব্যাচ), ২য় হয় তাসনিম বিনতে আনোয়ার (56 ব্যাচ) এবং ৩য় হয় তানজিম আলম তন্নি (52 ব্যাচ)। ৩য় বিজয়ী পেতে অবশ্য টাই ব্রেকার রাউন্ড করা হয় তন্নি ও মিশিলার মধ্যে।', 3),
(23, '29-12-22 10:19:34', 'হালান্ডের জোড়া গোলে ম্যানচেস্টার সিটির জয়', 'sports', 'tanha', 'named.webp', 'আর্লিং হালান্ডের জোড়া গোলে ম্যানচেস্টার সিটি দুর্দান্ত জয় পেয়েছে। লিডস ইউনাইটেডের বিপক্ষে ৩-১ গোলে জয় তুলে নেয় সিটি।\r\n\r\nবুধবার (২৮ ডিসেম্বর) লিডস ইউনাইটেডের মাঠে নেমে দাপট দেখিয়েই জয় তুলে নিয়েছে পেপ গুয়ার্দিওলার দল। প্রথমার্ধের অতিরিক্ত সময়ে রদ্রির গোলে লিড পায় ম্যান সিটি। এরপর দ্বিতীয়ার্ধের ১৯ মিনিটের ব্যবধানে দু’বার জালে বল পাঠান হালান্ড। ৩-০ তে পিছিয়ে থাকার পর ম্যাচের ৭৩ মিনিটে পাস্কাল স্ট্রুইজকের গোলে ব্যবধান কমায় লিডস। তবে শেষ পর্যন্ত ৩-১ গোলের জয় নিয়েই মাঠ ছাড়ে গার্দিওলার শিষ্যরা।', 0),
(24, '29-12-22 13:48:05', 'Marvel announces ‘Stan Lee’ documentary coming to life in 2023', 'entertainment', 'tanha', 'jani.webp', 'In the recently released video, a few of Stan Lee’s minor roles and guest appearances in cinema are seen. The joyous montage ends with a zoom-out that gradually shows an image of the multi-talented inventor.\r\n\r\nLee is most known for developing adored characters like Spider-Man, the Hulk, Iron Man, Captain America, the Avengers, and more while working with other writer-artists like Jack Kirby and Steve Ditko. Lee maintained his relationship with Marvel even after leaving the company in the 1990s by serving as an executive producer on Marvel-produced films and cameo appearances.\r\n\r\n\r\nAccording to Variety, Genius Brands International established a new online store with three limited-edition Lee-branded collections earlier this month to celebrate Lee’s 100th birthday.\r\n\r\nThe entertainment firm has agreed to co-executive produce the “Stan Lee” documentary. It is the owner of the name, voice, likeness, signature, and licencing of intellectual property linked to Lee.\r\n\r\n', 2),
(26, '29-12-22 15:53:21', 'What is the Future of Machine Learning?', 'education', 'tanha', 'future-of-machine-learning.jpg.webp', '<h3>The Exciting Future of Machine Learning</h3>\r\nMachine Learning is not only offering tremendous growth opportunities but also disrupting long-standing industries. Machine Learning is easily one of humanity’s best allies by enabling businesses to make more informed decisions, helping developers look at problems in innovative ways, and offering insights round the clock with inhuman speeds and accuracy. \r\n\r\nIn a survey conducted by PWC in 2021, 86% of individuals said that Machine Learning and Artificial Intelligence are now a mainstream part of their company. Over 50% of them reported acceleration of adoption plans for this technology after the impact of the COVID-19 pandemic on businesses worldwide.\r\n\r\n<img style=\"width:100%\" src=\"https://www.naukri.com/learning/articles/wp-content/uploads/sites/11/2022/05/image-275-768x429.png\">\r\n\r\nThe market leaders in machine learning introduce new capabilities in their product offerings to strengthen their positions in the ML market. Companies such as Microsoft, Oracle, Amazon, and IBM are the key industry players leveraging Artificial Intelligence and Machine Learning to empower their businesses and innovate responsibly. For example,\r\n\r\nOracle launched the Oracle Cloud Data Science Platform in February 2020 to assist businesses in collaboratively training, managing, and deploying ML models to improve their predictive accuracy in data science programs.\r\n\r\nMicrosoft has launched an open database for transportation, health, population and safety, and others to help improve the performance of ML models using its publicly available datasets. ', 9);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `addedby` varchar(200) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `datetime`, `name`, `addedby`, `password`) VALUES
(3, '28-12-22 13:03:39', 'tanha', 'Tanha', 'tajmim'),
(4, '28-12-22 13:36:52', 'AtikHasan', 'Tanha', 'atikhasan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(60) NOT NULL,
  `date` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `date`, `email`, `phone_no`, `password`) VALUES
(2, 'shamimatajmim', '30-12-22 12:03:26', 'stajmimtanha@gmail.com', '0123456789', '123456'),
(3, 'atikhasan', '30-12-22 12:56:46', 'atik@gmail.com', '0123456987', '123123'),
(4, 'shamima', '30-12-22 20:04:21', 'shamima.bhola@gmail.com', '01736564133', '123456'),
(5, 'sinthia', '31-12-22 16:54:09', 'sumaiyasinthia998@gmail.com', '01533819291', 'sinthu1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_no` (`post_no`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_no`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
