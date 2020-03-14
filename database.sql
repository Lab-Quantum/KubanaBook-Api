-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 26-Fev-2020 às 02:43
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `kubanabook`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `firstName` varchar(55) DEFAULT NULL,
  `lastName` varchar(55) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `phone` varchar(55) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `banned` tinyint(4) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `firstName`, `lastName`, `email`, `phone`, `password`, `active`, `banned`, `createdAt`, `updatedAt`) VALUES
(1, 'peil', 'Luan', 'Peil', 'luan@peil.dev', NULL, '0', 1, 0, '2020-02-26 00:40:40', '2020-02-26 01:43:16'),
(2, 'Kubanabook', NULL, NULL, NULL, '5553991822922', '0', 1, 0, '2020-02-26 01:11:32', '2020-02-26 01:43:18'),
(3, 'lpeil', NULL, NULL, NULL, '53 888', '$2y$10$9VCqp1mq4l/DL8GVQJ4VDu6n6tK9LStNlaooRl8zWD2RB4eFxBnNe', 0, 0, '2020-02-26 01:18:29', '2020-02-26 01:40:20'),
(4, 'fulano', NULL, NULL, 'fulano@gmail.com', NULL, '$2y$10$mAknnykCgw0eRnGcEhxk5.15xRvTtfItLkR.XDTJcRX34O0jbt0/O', 0, 0, '2020-02-26 01:25:31', '2020-02-26 01:31:07'),
(5, 'ciclano', NULL, NULL, 'ciclano@gmail.com', NULL, '$2y$10$vxvTpCRwWEJ5znNNIBBqDejkbXupi1B46MOf7HnxG2YeuaFs0fiqy', 0, 0, '2020-02-26 01:31:15', '2020-02-26 01:40:24'),
(6, 'tiberio', NULL, NULL, 'tiberio@gmail.com', NULL, '$2y$10$1hYqP.XfkYyfRfx1yB3tgO0x0Ou2R4C5qCS3Lo4p.Auel8R71KyBy', 0, 0, '2020-02-26 01:40:28', '2020-02-26 01:40:28'),
(7, 'hercules', NULL, NULL, 'hercules@gmail.com', NULL, '$2y$10$sqZZTrmxv5B1GFGARRJTAO9mLKNj0N8AfFAMQitR5ugcB/yPGtx6u', 0, 0, '2020-02-26 01:42:50', '2020-02-26 01:42:50');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
