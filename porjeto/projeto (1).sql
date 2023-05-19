-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Maio-2023 às 16:24
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

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
  `estado` varchar(20) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `consulta`
--

INSERT INTO `consulta` (`id`, `data`, `estado`, `id_medico`, `id_utente`) VALUES
(1, '2023-05-18', 'Agendada', 1, 1),
(2, '2023-05-19', 'Agendada', 2, 2),
(3, '2023-05-20', 'Concluída', 3, 3),
(4, '2023-05-21', 'Agendada', 4, 4),
(5, '2023-05-22', 'Cancelada', 5, 5),
(6, '2023-05-23', 'Agendada', 6, 6),
(7, '2023-05-24', 'Agendada', 7, 7),
(8, '2023-05-25', 'Concluída', 8, 8),
(9, '2023-05-26', 'Agendada', 9, 9),
(10, '2023-05-27', 'Agendada', 10, 10),
(11, '2023-05-28', 'Agendada', 1, 11),
(12, '2023-05-29', 'Concluída', 2, 12),
(13, '2023-05-30', 'Agendada', 3, 13),
(14, '2023-05-31', 'Agendada', 4, 14),
(15, '2023-06-01', 'Agendada', 5, 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enfermeiro_consulta`
--

CREATE TABLE `enfermeiro_consulta` (
  `id_enfermeiro` int(11) NOT NULL,
  `id_consulta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `enfermeiro_consulta`
--

INSERT INTO `enfermeiro_consulta` (`id_enfermeiro`, `id_consulta`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 3),
(7, 4),
(8, 4),
(9, 5),
(10, 5),
(11, 6),
(12, 6),
(13, 7),
(14, 7),
(15, 8),
(1, 8),
(2, 9),
(3, 9),
(4, 10),
(5, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nif` int(8) NOT NULL,
  `iban` varchar(25) NOT NULL,
  `especialidade` varchar(50) NOT NULL,
  `id_morada` int(11) NOT NULL,
  `profissao` tinyint(1) NOT NULL COMMENT 'medico = 1, enfermeiro 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `nome`, `username`, `password`, `nif`, `iban`, `especialidade`, `id_morada`, `profissao`) VALUES
(1, 'João', 'joao123', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 123456789, 'PT50 01231231231231', 'veterinario', 1, 1),
(2, 'Maria', 'maria456', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 987654321, 'PT50 01231231231232', 'enfermeiro', 2, 0),
(3, 'Pedro', 'pedro789', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 246813579, 'PT50 01231231231233', 'veterinario', 3, 1),
(4, 'Ana', 'ana123', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 135792468, 'PT50 01231231231234', 'rececionista', 4, 0),
(5, 'Carlos', 'carlos456', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 864209753, 'PT50 01231231231235', 'veterinario', 5, 1),
(6, 'Sofia', 'sofia789', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 357914680, 'PT50 01231231231236', 'enfermeiro', 6, 0),
(7, 'Ricardo', 'ricardo123', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 680124579, 'PT50 01231231231237', 'veterinario', 7, 1),
(8, 'Marta', 'marta456', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 975310462, 'PT50 01231231231238', 'rececionista', 8, 0),
(9, 'Hugo', 'hugo789', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 462357910, 'PT50 01231231231239', 'veterinario', 9, 1),
(10, 'Laura', 'laura123', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 91246853, 'PT50 01231231231240', 'enfermeiro', 10, 0),
(11, 'Tiago', 'tiago456', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 304567891, 'PT50 01231231231241', 'veterinario', 11, 1),
(12, 'Rita', 'rita789', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 789012345, 'PT50 01231231231242', 'rececionista', 12, 0),
(13, 'Hugo', 'hugo123', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 456789012, 'PT50 01231231231243', 'veterinario', 13, 1),
(14, 'Carolina', 'carolina456', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 123450987, 'PT50 01231231231244', 'enfermeiro', 14, 0),
(15, 'Hélder', 'helder789', '$2a$08$5/RTnse4S4E4k3JFDHiZIuwv19EFzH39GROC0sySWYTSZa4el2Gri', 890123456, 'PT50 01231231231245', 'veterinario', 15, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `morada`
--

CREATE TABLE `morada` (
  `id` int(11) NOT NULL,
  `nome` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `morada`
--

INSERT INTO `morada` (`id`, `nome`) VALUES
(1, 'Rua D. Carlos I'),
(2, 'Avenida da Liberdade'),
(3, 'Rua do Rosário'),
(4, 'Travessa das Flores'),
(5, 'Largo de São Pedro'),
(6, 'Avenida João XXI'),
(7, 'Praça da República'),
(8, 'Rua Direita'),
(9, 'Travessa do Sol'),
(10, 'Avenida dos Aliados'),
(11, 'Rua das Oliveiras'),
(12, 'Praça da Sé'),
(13, 'Largo de Santa Catarina'),
(14, 'Travessa da Esperança'),
(15, 'Avenida Central');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `value`) VALUES
(1, 'Ração Especial para Ouriços', 15.99),
(2, 'Rodinha de Exercício para Ouriços', 8.5),
(3, 'Casa de Descanso para Ouriços', 12.99),
(4, 'Brinquedo de Pelúcia para Ouriços', 6.75),
(5, 'Vitamina para Fortalecimento dos Espinhos', 9.99),
(6, 'Kit de Higiene para Ouriços', 14.5),
(7, 'Bebedouro Automático para Ouriços', 7.99),
(8, 'Toca Aconchegante para Ouriços', 11.25),
(9, 'Areia para Banho de Ouriços', 5.5),
(10, 'Suplemento Alimentar para Ouriços', 12.99),
(11, 'Escova para Ouriços', 8.75),
(12, 'Comedouro para Ouriços', 9.99),
(13, 'Cama Aconchegante para Ouriços', 16.5),
(14, 'Brinquedo de Labirinto para Ouriços', 7.25),
(15, 'Shampoo Especial para Ouriços', 11.99);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `id` int(11) NOT NULL,
  `cuidado` varchar(100) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `receita` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receita`
--

INSERT INTO `receita` (`id`, `cuidado`, `id_medico`, `id_utente`, `receita`) VALUES
(1, 'Tratamento X', 1, 1, 'Medicação Y'),
(2, 'Tratamento Z', 2, 2, 'Medicação W'),
(3, 'Tratamento A', 3, 3, 'Medicação B'),
(4, 'Tratamento C', 4, 4, 'Medicação D'),
(5, 'Tratamento E', 5, 5, 'Medicação F'),
(6, 'Tratamento G', 6, 6, 'Medicação H'),
(7, 'Tratamento I', 7, 7, 'Medicação J'),
(8, 'Tratamento K', 8, 8, 'Medicação L'),
(9, 'Tratamento M', 9, 9, 'Medicação N'),
(10, 'Tratamento O', 10, 10, 'Medicação P');

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
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10),
(6, 11),
(6, 12),
(7, 13),
(7, 14),
(8, 15),
(8, 1),
(9, 2),
(9, 3),
(10, 4),
(10, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `nUtente` varchar(6) NOT NULL,
  `id_morada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utente`
--

INSERT INTO `utente` (`id`, `nome`, `nUtente`, `id_morada`) VALUES
(1, 'Nao Joao', 'U12345', 1),
(2, 'Maria', 'U98765', 2),
(3, 'Pedro', 'U24681', 3),
(4, 'Ana', 'U13579', 4),
(5, 'Carlos', 'U86420', 5),
(6, 'Sofia', 'U35791', 6),
(7, 'Ricardo', 'U68012', 7),
(8, 'Marta', 'U97531', 8),
(9, 'José', 'U46803', 9),
(10, 'Inês', 'U21584', 10);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `morada`
--
ALTER TABLE `morada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
