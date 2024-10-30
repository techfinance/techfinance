-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/10/2024 às 15:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tech_finance1`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carteira`
--

CREATE TABLE `carteira` (
  `ID_CARTEIRA` int(11) NOT NULL,
  `NOME_CARTEIRA` varchar(100) NOT NULL,
  `SALDO` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Usuario_ID_USUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOME_CATEGORIA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`ID_CATEGORIA`, `NOME_CATEGORIA`) VALUES
(1, 'Alimentação'),
(2, 'Lazer'),
(3, 'Transporte'),
(4, 'Saúde');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoriau`
--

CREATE TABLE `categoriau` (
  `ID_CATEGORIAU` int(11) NOT NULL,
  `NOME_CATEGORIAU` varchar(50) NOT NULL,
  `Usuario_ID_USUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `entrada`
--

CREATE TABLE `entrada` (
  `ID_ENTRADA` int(11) NOT NULL,
  `NOME_ENTR` varchar(100) NOT NULL,
  `VALOR_ENTR` decimal(10,2) NOT NULL,
  `ENTR_DATA` date NOT NULL DEFAULT current_timestamp(),
  `Usuario_ID_USUARIO` int(11) NOT NULL,
  `Carteira_ID_CARTEIRA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `metas`
--

CREATE TABLE `metas` (
  `ID_META` int(11) NOT NULL,
  `VALOR` decimal(10,2) NOT NULL,
  `META_STATUS` varchar(30) NOT NULL,
  `META_DATA` date NOT NULL,
  `META_DATACRIACAO` date NOT NULL DEFAULT current_timestamp(),
  `META_DESCRICAO` varchar(200) DEFAULT NULL,
  `Usuario_ID_USUARIO` int(11) NOT NULL,
  `Categoria_ID_CATEGORIA` int(11) DEFAULT NULL,
  `CategoriaU_ID_CATEGORIAU` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `saida`
--

CREATE TABLE `saida` (
  `ID_SAIDA` int(11) NOT NULL,
  `TIPO` varchar(255) NOT NULL,
  `CATEGORIA` varchar(100) NOT NULL,
  `VALOR` decimal(10,2) NOT NULL,
  `SAIDA_DATA` date NOT NULL DEFAULT current_timestamp(),
  `Usuario_ID_USUARIO` int(11) NOT NULL,
  `Carteira_ID_CARTEIRA` int(11) NOT NULL,
  `Categoria_ID_CATEGORIA` int(11) DEFAULT NULL,
  `CategoriaU_ID_CATEGORIAU` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sonhos`
--

CREATE TABLE `sonhos` (
  `ID_SONHO` int(11) NOT NULL,
  `SONHO_NOME` varchar(100) NOT NULL,
  `VALOR` decimal(10,2) NOT NULL,
  `SONHO_STATUS` varchar(30) NOT NULL,
  `SONHO_DATA` date NOT NULL,
  `Usuario_ID_USUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOME_USER` varchar(100) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `SENHA` varchar(32) NOT NULL,
  `DATA_CADASTRO` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carteira`
--
ALTER TABLE `carteira`
  ADD PRIMARY KEY (`ID_CARTEIRA`),
  ADD KEY `fk_Carteira_Usuario` (`Usuario_ID_USUARIO`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Índices de tabela `categoriau`
--
ALTER TABLE `categoriau`
  ADD PRIMARY KEY (`ID_CATEGORIAU`),
  ADD KEY `fk_CategoriaU_Usuario` (`Usuario_ID_USUARIO`);

--
-- Índices de tabela `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`ID_ENTRADA`),
  ADD KEY `fk_Entrada_Usuario` (`Usuario_ID_USUARIO`),
  ADD KEY `fk_Entrada_Carteira` (`Carteira_ID_CARTEIRA`);

--
-- Índices de tabela `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`ID_META`),
  ADD KEY `fk_Metas_Usuario` (`Usuario_ID_USUARIO`),
  ADD KEY `fk_Categoria_Metas` (`Categoria_ID_CATEGORIA`),
  ADD KEY `fk_CategoriaU_Metas` (`CategoriaU_ID_CATEGORIAU`);

--
-- Índices de tabela `saida`
--
ALTER TABLE `saida`
  ADD PRIMARY KEY (`ID_SAIDA`),
  ADD KEY `fk_Saida_Usuario` (`Usuario_ID_USUARIO`),
  ADD KEY `fk_Saida_Carteira` (`Carteira_ID_CARTEIRA`),
  ADD KEY `fk_Categoria_Carteira` (`Categoria_ID_CATEGORIA`),
  ADD KEY `fk_CategoriaU_Carteira` (`CategoriaU_ID_CATEGORIAU`);

--
-- Índices de tabela `sonhos`
--
ALTER TABLE `sonhos`
  ADD PRIMARY KEY (`ID_SONHO`),
  ADD KEY `fk_Sonhos_Usuario` (`Usuario_ID_USUARIO`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carteira`
--
ALTER TABLE `carteira`
  MODIFY `ID_CARTEIRA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `categoriau`
--
ALTER TABLE `categoriau`
  MODIFY `ID_CATEGORIAU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `entrada`
--
ALTER TABLE `entrada`
  MODIFY `ID_ENTRADA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `metas`
--
ALTER TABLE `metas`
  MODIFY `ID_META` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `saida`
--
ALTER TABLE `saida`
  MODIFY `ID_SAIDA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sonhos`
--
ALTER TABLE `sonhos`
  MODIFY `ID_SONHO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carteira`
--
ALTER TABLE `carteira`
  ADD CONSTRAINT `fk_Carteira_Usuario` FOREIGN KEY (`Usuario_ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Restrições para tabelas `categoriau`
--
ALTER TABLE `categoriau`
  ADD CONSTRAINT `fk_CategoriaU_Usuario` FOREIGN KEY (`Usuario_ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Restrições para tabelas `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `fk_Entrada_Carteira` FOREIGN KEY (`Carteira_ID_CARTEIRA`) REFERENCES `carteira` (`ID_CARTEIRA`),
  ADD CONSTRAINT `fk_Entrada_Usuario` FOREIGN KEY (`Usuario_ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Restrições para tabelas `metas`
--
ALTER TABLE `metas`
  ADD CONSTRAINT `fk_CategoriaU_Metas` FOREIGN KEY (`CategoriaU_ID_CATEGORIAU`) REFERENCES `categoriau` (`ID_CATEGORIAU`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Categoria_Metas` FOREIGN KEY (`Categoria_ID_CATEGORIA`) REFERENCES `categoria` (`ID_CATEGORIA`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Metas_Usuario` FOREIGN KEY (`Usuario_ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Restrições para tabelas `saida`
--
ALTER TABLE `saida`
  ADD CONSTRAINT `fk_CategoriaU_Carteira` FOREIGN KEY (`CategoriaU_ID_CATEGORIAU`) REFERENCES `categoriau` (`ID_CATEGORIAU`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Categoria_Carteira` FOREIGN KEY (`Categoria_ID_CATEGORIA`) REFERENCES `categoria` (`ID_CATEGORIA`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Saida_Carteira` FOREIGN KEY (`Carteira_ID_CARTEIRA`) REFERENCES `carteira` (`ID_CARTEIRA`),
  ADD CONSTRAINT `fk_Saida_Usuario` FOREIGN KEY (`Usuario_ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Restrições para tabelas `sonhos`
--
ALTER TABLE `sonhos`
  ADD CONSTRAINT `fk_Sonhos_Usuario` FOREIGN KEY (`Usuario_ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
