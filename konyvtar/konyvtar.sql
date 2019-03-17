-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Már 17. 21:49
-- Kiszolgáló verziója: 10.1.37-MariaDB
-- PHP verzió: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `konyvtar`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `publishing` date NOT NULL,
  `story` text NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `lid` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `book`
--

INSERT INTO `book` (`id`, `publishing`, `story`, `book_title`, `cover_image`, `lid`, `quantity`, `language`) VALUES
(1, '2019-02-22', 'Jó könyv.', 'A gyűrűk ura', 'gyu.jpg', 'Keményfedeles', 200, 'magyar'),
(2, '2014-07-18', 'Jó könyv.', 'A gyűrűk ura', 'gyu2.jpg', 'Keményfedeles', 200, 'magyar');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `book_edition`
--

CREATE TABLE `book_edition` (
  `id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `book_edition`
--

INSERT INTO `book_edition` (`id`, `writer_id`, `book_id`, `category_id`) VALUES
(4, 12, 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `category`
--

INSERT INTO `category` (`id`, `genre`) VALUES
(1, 'fantasy'),
(4, 'horror'),
(5, 'krimi'),
(3, 'romantikus');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kolcson`
--

CREATE TABLE `kolcson` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `konyv_id` int(11) NOT NULL,
  `kezd_datum` date NOT NULL,
  `veg_datum` date NOT NULL,
  `mennyiseg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kommentek`
--

CREATE TABLE `kommentek` (
  `id` int(11) NOT NULL,
  `konyv_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `ido` date NOT NULL,
  `moderal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `birthday`) VALUES
(1, 'admin', '1bbd886460827015e5d605ed44252251', 'admin@kek.com', '2018-08-20'),
(3, 'jurrol', '1bbd886460827015e5d605ed44252251', 'roland.jurcsisin@gmail.com', '2019-03-22');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `writer`
--

CREATE TABLE `writer` (
  `id` int(11) NOT NULL,
  `writer_name` varchar(255) NOT NULL,
  `writer_picture` varchar(255) NOT NULL,
  `writer_birthday` date NOT NULL,
  `life_story` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `writer`
--

INSERT INTO `writer` (`id`, `writer_name`, `writer_picture`, `writer_birthday`, `life_story`) VALUES
(12, 'J. R. R. Tolkien', '0f66763d25968a926c58e7a9ff899d8a.png', '2019-02-15', 'Jó író.');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `book_edition`
--
ALTER TABLE `book_edition`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_id` (`category_id`),
  ADD UNIQUE KEY `writer_id` (`writer_id`,`book_id`,`category_id`) USING BTREE,
  ADD KEY `konyv_id` (`book_id`);

--
-- A tábla indexei `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mufaj` (`genre`);

--
-- A tábla indexei `kolcson`
--
ALTER TABLE `kolcson`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`konyv_id`),
  ADD KEY `konyv_id` (`konyv_id`);

--
-- A tábla indexei `kommentek`
--
ALTER TABLE `kommentek`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `konyv_id` (`konyv_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A tábla indexei `writer`
--
ALTER TABLE `writer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `writer_name` (`writer_name`,`writer_picture`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `book_edition`
--
ALTER TABLE `book_edition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `kolcson`
--
ALTER TABLE `kolcson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kommentek`
--
ALTER TABLE `kommentek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `writer`
--
ALTER TABLE `writer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `book_edition`
--
ALTER TABLE `book_edition`
  ADD CONSTRAINT `book_edition_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `book_edition_ibfk_2` FOREIGN KEY (`writer_id`) REFERENCES `writer` (`id`),
  ADD CONSTRAINT `book_edition_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`);

--
-- Megkötések a táblához `kolcson`
--
ALTER TABLE `kolcson`
  ADD CONSTRAINT `kolcson_ibfk_1` FOREIGN KEY (`konyv_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `kolcson_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `kommentek`
--
ALTER TABLE `kommentek`
  ADD CONSTRAINT `kommentek_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kommentek_ibfk_2` FOREIGN KEY (`konyv_id`) REFERENCES `book` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
