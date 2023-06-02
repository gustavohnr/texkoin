-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2023 at 02:56 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `texkoin`
--

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(255) DEFAULT NULL,
  `primeiro_nome` varchar(255) DEFAULT NULL,
  `segundo_nome` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `setor` varchar(255) DEFAULT NULL,
  `texkoins` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `primeiro_nome`, `segundo_nome`, `cargo`, `setor`, `texkoins`, `imagem`, `id`) VALUES
('gustavo.henrique', 'Gustavo', 'Henrique', 'lixo', 'Engenharia', '0.85', 'ghost/1.png', 1),
('joao.canudo', 'João', 'Canudo Porshe', NULL, 'Administrativo', '0.39', 'joao.canudo.png', 3),
('lucas.vela', 'Lucas', 'Vela Ferrari', NULL, 'Comercial', '0.18', 'lucas.vela.png', 4),
('ana.bola', 'Ana', 'Bola Martelo', NULL, 'Recursos Humanos', '0.49', 'ana.bola.png', 5),
('pedro.livro', 'Pedro', 'Livro Helicóptero', NULL, 'Recursos Humanos', '0.29', 'pedro.livro.png', 6),
('maria.pipa', 'Maria', 'Pipa Girassol', NULL, 'Compliance', '0.40', 'maria.pipa.png', 7),
('carlos.cadeira', 'Carlos', 'Cadeira Avião', NULL, 'Marketing', '0.34', 'carlos.cadeira.png', 8),
('sofia.janela', 'Sofia', 'Janela Borboleta', NULL, 'Compliance', '0.21', 'sofia.janela.png', 9),
('tiago.mesa', 'Tiago', 'Mesa Guitarra', NULL, 'Comercial', '0.70', 'tiago.mesa.png', 10),
('isabela.porta', 'Isabela', 'Porta Computador', NULL, 'Administrativo', '0.33', 'isabela.porta.png', 11),
('gabriel.cama', 'Gabriel', 'Cama Espelho', NULL, 'Alianças', '0.78', 'gabriel.cama.png', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
