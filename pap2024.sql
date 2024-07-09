-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Tempo de geração: 29/06/2024 às 14:51
-- Versão do servidor: 11.4.2-MariaDB-ubu2404
-- Versão do PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pap2024`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('pending','completed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image_url`) VALUES
(1, 'Pro', 20.00, '<p>Tem um site pessoal? Talvez um hobby? O nosso plano profissional é a sua melhor opção!<br><a href=\"#\">Compare os nossos planos</a></p><p><b>Recursos de Suporte:</b></p><hr><p><img src=\"assets/images/chat_icon.png\" alt=\"Chat\"> Chat<br><img src=\"assets/images/ticket_icon.png\" alt=\"Ticket\"> Ticket<br><img src=\"assets/images/email_icon.png\" alt=\"Email\"> Email</p>', 'assets/images/imagem.png'),
(2, 'Negócios', 200.00, '<p>Tem uma pequena ou média empresa? O nosso plano de Negócios é a sua melhor opção!<br><a href=\"#\">Compare os nossos planos</a></p><p><b>Recursos de Suporte:</b></p><hr><p><img src=\"assets/images/chat_icon.png\" alt=\"Chat\"> Chat<br><img src=\"assets/images/ticket_icon.png\" alt=\"Ticket\"> Ticket<br><img src=\"assets/images/email_icon.png\" alt=\"Email\"> Email</p>', 'assets/images/imagem.png'),
(3, 'Empresarial', 500.00, '<p>Tem uma grande empresa? Estar online é crítico para si? Precisa de algo sob demanda? O nosso plano Empresarial é a sua melhor opção!<br><a href=\"#\">Compare os nossos planos</a></p><p><b>Recursos de Suporte:</b></p><hr><p><img src=\"assets/images/chat_icon.png\" alt=\"Chat\"> Chat<br><img src=\"assets/images/ticket_icon.png\" alt=\"Ticket\"> Ticket<br><img src=\"assets/images/email_icon.png\" alt=\"Email\"> Email<br><img src=\"assets/images/phone_icon.png\" alt=\"Telefone\"> Telefone</p>', 'assets/images/imagem.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `verification_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
