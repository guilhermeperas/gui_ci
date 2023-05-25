-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Maio-2023 às 21:33
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consulta`
--

CREATE TABLE `consulta` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'Agendada',
  `id_medico` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_receita` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `consulta`
--

INSERT INTO `consulta` (`id`, `data`, `estado`, `id_medico`, `id_utente`, `id_receita`) VALUES
(1, '2023-05-17', 'Concluida', 1, 4, 1),
(2, '2023-05-19', 'Agendada', 3, 4, 13),
(23, '2023-06-07', 'Agendada', 1, 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nome` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'to be cehcked',
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enfermeiro`
--

CREATE TABLE `enfermeiro` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `nif` int(11) NOT NULL,
  `iban` varchar(30) NOT NULL,
  `especialidade` varchar(30) NOT NULL,
  `id_morada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `enfermeiro`
--

INSERT INTO `enfermeiro` (`id`, `nome`, `nif`, `iban`, `especialidade`, `id_morada`) VALUES
(1, 'Enfermeiro 1', 123456789, 'PT50 01231231231231', 'Cardiologia', 1),
(3, 'Enfermeiro 3', 456789012, 'PT50 01231231231233', 'Ortopedia', 3),
(4, 'Enfermeiro 4', 12345678, 'PT50 01231231231234', 'Dermatologia', 4),
(5, 'Enfermeiro 5', 987654321, 'PT50 01231231231235', 'Oftalmologia', 5),
(6, 'Enfermeiro 6', 654321098, 'PT50 01231231231236', 'Ginecologia', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enfermeiro_consulta`
--

CREATE TABLE `enfermeiro_consulta` (
  `id_enfermeiro` int(11) NOT NULL COMMENT 'fk enfermeiro',
  `id_consulta` int(11) NOT NULL COMMENT 'fk consulta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico`
--

CREATE TABLE `medico` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `nif` int(8) NOT NULL,
  `iban` varchar(30) NOT NULL,
  `especialidade` varchar(30) NOT NULL,
  `id_morada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medico`
--

INSERT INTO `medico` (`id`, `nome`, `nif`, `iban`, `especialidade`, `id_morada`) VALUES
(3, 'Medico 3', 456789012, 'PT50 01231231231233', 'Ortopedia', 3),
(4, 'Medico 4', 12345678, 'PT50 01231231231234', 'Dermatologia', 4),
(5, 'Medico 5', 987654321, 'PT50 01231231231235', 'Oftalmologia', 5),
(6, 'Medico 6', 654321098, 'PT50 01231231231236', 'Ginecologia', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `morada`
--

CREATE TABLE `morada` (
  `id` int(11) NOT NULL,
  `nome` varchar(280) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `morada`
--

INSERT INTO `morada` (`id`, `nome`) VALUES
(2, 'Rua D. Carlos I'),
(3, 'Avenida da Liberdade'),
(4, 'Rua do Rosário'),
(5, 'Travessa das Flores'),
(6, 'Largo de São Pedro'),
(7, 'Avenida João XXI'),
(8, 'Praça da República'),
(9, 'Rua Direita'),
(10, 'Travessa do Sol'),
(11, 'Avenida dos Aliados'),
(12, 'Rua das Oliveiras'),
(13, 'Praça da Sé'),
(14, 'Largo de Santa Catarina'),
(15, 'Travessa da Esperança'),
(16, 'Avenida Central'),
(18, 'Rua D. Carlos I, 52 1 andar'),
(19, 'ASDADS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `value` float NOT NULL,
  `img_path` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `value`, `img_path`) VALUES
(1, 'Ração Especial para Ouriços', 15.99, 'watermark.png'),
(2, 'Rodinha de Exercício para Ouriços', 8.5, 'watermark.png'),
(3, 'Casa de Descanso para Ouriços', 12.99, 'watermark.png'),
(4, 'Brinquedo de Pelúcia para Ouriços', 6.75, 'watermark.png'),
(5, 'Vitamina para Fortalecimento dos Espinhos', 9.99, 'watermark.png'),
(6, 'Kit de Higiene para Ouriços', 14.5, 'watermark.png'),
(7, 'Bebedouro Automático para Ouriços', 7.99, 'watermark.png'),
(8, 'Toca Aconchegante para Ouriços', 11.25, 'watermark.png'),
(9, 'Areia para Banho de Ouriços', 5.5, 'watermark.png'),
(10, 'Suplemento Alimentar para Ouriços', 12.99, 'watermark.png'),
(11, 'Escova para Ouriços', 8.75, 'watermark.png'),
(12, 'Comedouro para Ouriços', 9.99, 'watermark.png'),
(13, 'Cama Aconchegante para Ouriços', 16.5, 'watermark.png'),
(14, 'Brinquedo de Labirinto para Ouriços', 7.25, 'watermark.png'),
(15, 'Shampoo Especial para Ouriços', 11.99, 'watermark.png'),
(17, 'asdasd', 12, 'watermark.png'),
(18, 'Guilherme Pereira', 123, 'watermark.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `id` int(11) NOT NULL,
  `cuidado` varchar(80) NOT NULL,
  `receita` longtext NOT NULL,
  `id_consulta` int(11) NOT NULL,
  `imagem` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receita`
--

INSERT INTO `receita` (`id`, `cuidado`, `receita`, `id_consulta`, `imagem`) VALUES
(1, 'Tratamento X', 'Medicação Y', 1, NULL),
(2, 'Tratamento Z', 'Medicação W', 2, NULL),
(13, 'asd', 'asd', 23, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita_produto`
--

CREATE TABLE `receita_produto` (
  `id_receita` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receita_produto`
--

INSERT INTO `receita_produto` (`id_receita`, `id_produto`) VALUES
(2, 2),
(3, 3),
(1, 11),
(1, 14),
(1, 3),
(1, 13),
(1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) DEFAULT NULL COMMENT 'null for recepcionists / admin',
  `username` varchar(20) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(300) NOT NULL,
  `tipo` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `tipo`) VALUES
(1, 'medico12', 'al220002@epcc.pt', '$2a$08$GqO0NwfNJK.AcSDPJEICauWu8jhRhRoPJQIuujIs.UVkyMQ.00Muu', 'medico'),
(2, 'medico22', 'al220002@epcc.pt', '$2a$08$D16U5sdi7GefA/R0byg/HOqyJd75aVxs3A9mVcHojkYa2uGHZWzRq', 'medico'),
(3, 'medico3', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'medico'),
(4, 'medico4', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'medico'),
(5, 'medico5', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'medico'),
(6, 'medico6', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'medico'),
(1, 'medico12', 'al220002@epcc.pt', '$2a$08$GqO0NwfNJK.AcSDPJEICauWu8jhRhRoPJQIuujIs.UVkyMQ.00Muu', 'enfermeiro'),
(2, 'medico22', 'al220002@epcc.pt', '$2a$08$D16U5sdi7GefA/R0byg/HOqyJd75aVxs3A9mVcHojkYa2uGHZWzRq', 'enfermeiro'),
(3, 'medico3', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'enfermeiro'),
(4, 'enfermeiro4', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'enfermeiro'),
(5, 'enfermeiro5', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'enfermeiro'),
(6, 'enfermeiro6', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'enfermeiro'),
(1, 'medico12', 'al220002@epcc.pt', '$2a$08$GqO0NwfNJK.AcSDPJEICauWu8jhRhRoPJQIuujIs.UVkyMQ.00Muu', 'utente'),
(2, 'medico22', 'al220002@epcc.pt', '$2a$08$D16U5sdi7GefA/R0byg/HOqyJd75aVxs3A9mVcHojkYa2uGHZWzRq', 'utente'),
(3, 'medico3', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'utente'),
(4, 'utente4', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'utente'),
(5, 'utente5', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'utente'),
(6, 'utente6', 'al220002@epcc.pt', '$2a$08$KiWiG9PqRLW5v/8.4ostFuS4RdutD3iLML52k6H1gCUdODlVf4paG', 'utente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `nUtente` int(9) NOT NULL COMMENT 'unique',
  `id_morada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utente`
--

INSERT INTO `utente` (`id`, `nome`, `nUtente`, `id_morada`) VALUES
(1, 'Utente 1', 123456789, 1),
(2, 'Utente 2', 543211234, 2),
(3, 'Utente 3', 987651234, 3),
(4, 'Utente 4', 678901234, 4),
(5, 'Utente 5', 456781234, 5),
(6, 'Utente 6', 543212344, 6);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `enfermeiro`
--
ALTER TABLE `enfermeiro`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `morada`
--
ALTER TABLE `morada`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `enfermeiro`
--
ALTER TABLE `enfermeiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `morada`
--
ALTER TABLE `morada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
