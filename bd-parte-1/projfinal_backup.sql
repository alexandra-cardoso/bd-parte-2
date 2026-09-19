-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Nov-2025 às 16:01
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projfinal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrativo`
--

CREATE TABLE `administrativo` (
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `administrativo`
--

INSERT INTO `administrativo` (`User_ID`) VALUES
(5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `Turma_Curso_ID` int(11) NOT NULL,
  `Turma_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `obs` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`Turma_Curso_ID`, `Turma_ID`, `User_ID`, `numero`, `obs`) VALUES
(1, 1, 1, 10, 'Aluno interessado'),
(2, 1, 2, 15, 'Boa aluna');

-- --------------------------------------------------------

--
-- Estrutura da tabela `anoletivo`
--

CREATE TABLE `anoletivo` (
  `AnoLetivo_ID` int(11) NOT NULL,
  `media` int(11) DEFAULT NULL,
  `ano` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `anoletivo`
--

INSERT INTO `anoletivo` (`AnoLetivo_ID`, `media`, `ano`) VALUES
(1, 15, '2023'),
(2, 16, '2024');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ano_estabelecimento`
--

CREATE TABLE `ano_estabelecimento` (
  `Estabelecimento_ID_` int(11) NOT NULL,
  `AnoLetivo_ID_` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `ano_estabelecimento`
--

INSERT INTO `ano_estabelecimento` (`Estabelecimento_ID_`, `AnoLetivo_ID_`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `Curso_ID` int(11) NOT NULL,
  `designacao` varchar(100) NOT NULL,
  `codigo` int(11) NOT NULL,
  `anosLetivos` enum('3') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`Curso_ID`, `designacao`, `codigo`, `anosLetivos`) VALUES
(1, 'Técnico de Informática', 101, '3'),
(2, 'Gestão e Administração', 102, '3'),
(4, 'alalalleelel', 98, '3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `Empresa_ID` int(11) NOT NULL,
  `firma` varchar(100) NOT NULL,
  `nContribuinte` int(11) NOT NULL,
  `moradaSede` varchar(100) DEFAULT NULL,
  `localidade` varchar(50) DEFAULT NULL,
  `codigoPostal` varchar(10) NOT NULL,
  `telefone` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `obs` varchar(500) DEFAULT NULL,
  `disponibilidade` bit(1) DEFAULT NULL,
  `nEstagiarios` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`Empresa_ID`, `firma`, `nContribuinte`, `moradaSede`, `localidade`, `codigoPostal`, `telefone`, `email`, `website`, `obs`, `disponibilidade`, `nEstagiarios`) VALUES
(1, 'TechNova', 509999111, 'Rua das Flores 10', 'Lisboa', '1000-001', 212345678, 'info@technova.pt', 'www.technova.pt', 'Empresa tecnológica', b'1', 3),
(2, 'ContabExpress', 501111222, 'Av. da Liberdade 200', 'Porto', '4000-222', 223456789, 'contacto@contab.pt', 'www.contab.pt', 'Gabinete de contabilidade', b'1', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estabelecimento`
--

CREATE TABLE `estabelecimento` (
  `Empresa_ID` int(11) DEFAULT NULL,
  `TipoEstabelecimento_ID` int(11) NOT NULL,
  `Estabelecimento_ID` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `morada` varchar(100) NOT NULL,
  `localidade` varchar(50) NOT NULL,
  `codigoPostal` int(11) NOT NULL,
  `telefone` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` blob DEFAULT NULL,
  `horario` datetime DEFAULT NULL,
  `dataFundacao` date DEFAULT NULL,
  `aceitouFuncAntes` bit(1) DEFAULT NULL,
  `obs` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estabelecimento`
--

INSERT INTO `estabelecimento` (`Empresa_ID`, `TipoEstabelecimento_ID`, `Estabelecimento_ID`, `nome`, `morada`, `localidade`, `codigoPostal`, `telefone`, `email`, `foto`, `horario`, `dataFundacao`, `aceitouFuncAntes`, `obs`) VALUES
(1, 1, 1, 'TechNova Sede', 'Rua das Flores 10', 'Lisboa', 1000001, 212345678, 'geral@technova.pt', NULL, '2024-01-01 09:00:00', '2010-05-10', b'1', 'Sede principal'),
(2, 1, 2, 'ContabExpress Norte', 'Av. Liberdade 200', 'Porto', 4000222, 223456789, 'porto@contab.pt', NULL, '2024-01-01 08:00:00', '2015-09-01', b'0', 'Filial norte');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estagio`
--

CREATE TABLE `estagio` (
  `Aluno_ID` int(11) NOT NULL,
  `Formador_User_ID` int(11) NOT NULL,
  `Responsavel_ID` int(11) NOT NULL,
  `Estagio_ID` int(11) NOT NULL,
  `dataInicio` date DEFAULT NULL,
  `dataFim` date DEFAULT NULL,
  `NotaEmpresa` int(11) DEFAULT NULL,
  `NotaEscola` int(11) DEFAULT NULL,
  `NotaProcura` int(11) DEFAULT NULL,
  `NotaRelatorio` int(11) DEFAULT NULL,
  `NotaFinal` int(11) DEFAULT NULL,
  `classificacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estagio`
--

INSERT INTO `estagio` (`Aluno_ID`, `Formador_User_ID`, `Responsavel_ID`, `Estagio_ID`, `dataInicio`, `dataFim`, `NotaEmpresa`, `NotaEscola`, `NotaProcura`, `NotaRelatorio`, `NotaFinal`, `classificacao`) VALUES
(1, 3, 1, 1, '2024-02-01', '2024-06-30', 17, 16, 15, 18, 17, 17),
(2, 4, 2, 2, '2024-03-01', '2024-07-15', 18, 17, 16, 17, 17, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `formador`
--

CREATE TABLE `formador` (
  `User_ID` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `disciplina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `formador`
--

INSERT INTO `formador` (`User_ID`, `numero`, `disciplina`) VALUES
(3, 101, 1),
(4, 102, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `listado_por`
--

CREATE TABLE `listado_por` (
  `Estabelecimento_ID` int(11) NOT NULL,
  `zona_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `listado_por`
--

INSERT INTO `listado_por` (`Estabelecimento_ID`, `zona_ID`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `Produto_ID` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `marca` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`Produto_ID`, `nome`, `marca`) VALUES
(1, 'Computador Portátil', 'Lenovo'),
(2, 'Impressora', 'HP'),
(3, 'Router Wi-Fi', 'TP-Link');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_estabelecimento`
--

CREATE TABLE `produto_estabelecimento` (
  `Estabelecimento_ID_` int(11) NOT NULL,
  `Produto_ID_` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produto_estabelecimento`
--

INSERT INTO `produto_estabelecimento` (`Estabelecimento_ID_`, `Produto_ID_`) VALUES
(1, 1),
(1, 3),
(2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ramodeatividade`
--

CREATE TABLE `ramodeatividade` (
  `Empresa_ID` int(11) NOT NULL,
  `RamoDeAtividade_ID` int(11) NOT NULL,
  `CAE` int(11) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `ramodeatividade`
--

INSERT INTO `ramodeatividade` (`Empresa_ID`, `RamoDeAtividade_ID`, `CAE`, `descricao`) VALUES
(1, 1, 62010, 'Programação informática'),
(2, 2, 69200, 'Atividades de contabilidade e auditoria');

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsavel`
--

CREATE TABLE `responsavel` (
  `Estabelecimento_ID` int(11) NOT NULL,
  `Responsavel_ID` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `telefoneDireto` int(11) DEFAULT NULL,
  `telemovel` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `obs` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `responsavel`
--

INSERT INTO `responsavel` (`Estabelecimento_ID`, `Responsavel_ID`, `nome`, `titulo`, `cargo`, `telefoneDireto`, `telemovel`, `email`, `obs`) VALUES
(1, 1, 'Rui Costa', 'Eng.', 'Supervisor', 214567890, 919999999, 'rui@technova.pt', 'Responsável pelo setor de TI'),
(2, 2, 'Helena Dias', 'Dra.', 'Gestora', 224567890, 918888888, 'helena@contab.pt', 'Responsável financeira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoestabelecimento`
--

CREATE TABLE `tipoestabelecimento` (
  `TipoEstabelecimento_ID` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tipoestabelecimento`
--

INSERT INTO `tipoestabelecimento` (`TipoEstabelecimento_ID`, `tipo`) VALUES
(1, ''),
(2, ''),
(3, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipotransporte`
--

CREATE TABLE `tipotransporte` (
  `TipoTransporte_ID` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tipotransporte`
--

INSERT INTO `tipotransporte` (`TipoTransporte_ID`, `tipo`) VALUES
(1, 'Autocarro'),
(2, 'Metro'),
(3, 'Comboio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transporte`
--

CREATE TABLE `transporte` (
  `TipoTransporte_ID` int(11) NOT NULL,
  `transporte_ID` int(11) NOT NULL,
  `linha` varchar(10) DEFAULT NULL,
  `observacoes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `transporte`
--

INSERT INTO `transporte` (`TipoTransporte_ID`, `transporte_ID`, `linha`, `observacoes`) VALUES
(1, 1, '705', 'Autocarro urbano'),
(2, 2, 'Linha Azul', 'Metro subterrâneo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transporte_zona`
--

CREATE TABLE `transporte_zona` (
  `zona_ID_` int(11) NOT NULL,
  `transporte_ID_` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `transporte_zona`
--

INSERT INTO `transporte_zona` (`zona_ID_`, `transporte_ID_`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `Curso_ID` int(11) NOT NULL,
  `Turma_ID` int(11) NOT NULL,
  `sigla` varchar(3) DEFAULT NULL,
  `ano` year(4) DEFAULT NULL,
  `capacidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`Curso_ID`, `Turma_ID`, `sigla`, `ano`, `capacidade`) VALUES
(1, 1, 'TI1', '2024', 25),
(2, 1, 'GA1', '2024', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`User_ID`, `nome`, `login`, `password`) VALUES
(1, 'João Silva', 'joaos', '1234'),
(2, 'Maria Santos', 'marias', 'abcd'),
(3, 'Carlos Pereira', 'carlosp', 'pass'),
(4, 'Ana Rodrigues', 'anar', 'qwerty'),
(5, 'Pedro Almeida', 'pedroa', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `zona`
--

CREATE TABLE `zona` (
  `zona_ID` int(11) NOT NULL,
  `designacao` varchar(100) NOT NULL,
  `localidade` varchar(50) NOT NULL,
  `mapa` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`mapa`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `zona`
--

INSERT INTO `zona` (`zona_ID`, `designacao`, `localidade`, `mapa`) VALUES
(1, 'Zona Centro', 'Lisboa', '{\"lat\":38.7169,\"lng\":-9.1399}'),
(2, 'Zona Norte', 'Porto', '{\"lat\":41.1579,\"lng\":-8.6291}');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrativo`
--
ALTER TABLE `administrativo`
  ADD PRIMARY KEY (`User_ID`);

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `FK_Aluno_Turma` (`Turma_Curso_ID`,`Turma_ID`);

--
-- Índices para tabela `anoletivo`
--
ALTER TABLE `anoletivo`
  ADD PRIMARY KEY (`AnoLetivo_ID`);

--
-- Índices para tabela `ano_estabelecimento`
--
ALTER TABLE `ano_estabelecimento`
  ADD PRIMARY KEY (`Estabelecimento_ID_`,`AnoLetivo_ID_`),
  ADD KEY `FK_AnoLetivo_ano_estabelecimento_Estabelecimento_` (`AnoLetivo_ID_`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`Curso_ID`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `designacao` (`designacao`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`Empresa_ID`),
  ADD UNIQUE KEY `nContribuinte` (`nContribuinte`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `estabelecimento`
--
ALTER TABLE `estabelecimento`
  ADD PRIMARY KEY (`Estabelecimento_ID`),
  ADD UNIQUE KEY `morada` (`morada`),
  ADD UNIQUE KEY `codigoPostal` (`codigoPostal`),
  ADD KEY `FK_Estabelecimento_noname_Empresa` (`Empresa_ID`),
  ADD KEY `FK_Estabelecimento_noname_TipoEstabelecimento` (`TipoEstabelecimento_ID`);

--
-- Índices para tabela `estagio`
--
ALTER TABLE `estagio`
  ADD PRIMARY KEY (`Estagio_ID`),
  ADD KEY `FK_Estagio_Aluno` (`Aluno_ID`),
  ADD KEY `FK_Estagio_Formador` (`Formador_User_ID`),
  ADD KEY `FK_Estagio_Responsavel` (`Responsavel_ID`);

--
-- Índices para tabela `formador`
--
ALTER TABLE `formador`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `numero` (`numero`);

--
-- Índices para tabela `listado_por`
--
ALTER TABLE `listado_por`
  ADD PRIMARY KEY (`Estabelecimento_ID`,`zona_ID`),
  ADD KEY `FK_zona_listado_por_Estabelecimento_` (`zona_ID`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`Produto_ID`);

--
-- Índices para tabela `produto_estabelecimento`
--
ALTER TABLE `produto_estabelecimento`
  ADD PRIMARY KEY (`Estabelecimento_ID_`,`Produto_ID_`),
  ADD KEY `FK_Produto_produto_estabelecimento_Estabelecimento_` (`Produto_ID_`);

--
-- Índices para tabela `ramodeatividade`
--
ALTER TABLE `ramodeatividade`
  ADD PRIMARY KEY (`RamoDeAtividade_ID`),
  ADD KEY `FK_RamoDeAtividade_noname_Empresa` (`Empresa_ID`);

--
-- Índices para tabela `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`Responsavel_ID`),
  ADD KEY `FK_Responsavel_noname_Estabelecimento` (`Estabelecimento_ID`);

--
-- Índices para tabela `tipoestabelecimento`
--
ALTER TABLE `tipoestabelecimento`
  ADD PRIMARY KEY (`TipoEstabelecimento_ID`);

--
-- Índices para tabela `tipotransporte`
--
ALTER TABLE `tipotransporte`
  ADD PRIMARY KEY (`TipoTransporte_ID`);

--
-- Índices para tabela `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`transporte_ID`),
  ADD KEY `FK_transporte_noname_TipoTransporte` (`TipoTransporte_ID`);

--
-- Índices para tabela `transporte_zona`
--
ALTER TABLE `transporte_zona`
  ADD PRIMARY KEY (`zona_ID_`,`transporte_ID_`),
  ADD KEY `FK_transporte_transporte_zona_zona_` (`transporte_ID_`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`Curso_ID`,`Turma_ID`),
  ADD UNIQUE KEY `sigla` (`sigla`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Índices para tabela `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`zona_ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `administrativo`
--
ALTER TABLE `administrativo`
  ADD CONSTRAINT `FK_Administrativo_User` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `FK_Aluno_Turma` FOREIGN KEY (`Turma_Curso_ID`,`Turma_ID`) REFERENCES `turma` (`Curso_ID`, `Turma_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Aluno_User` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `ano_estabelecimento`
--
ALTER TABLE `ano_estabelecimento`
  ADD CONSTRAINT `FK_AnoLetivo_ano_estabelecimento_Estabelecimento_` FOREIGN KEY (`AnoLetivo_ID_`) REFERENCES `anoletivo` (`AnoLetivo_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Estabelecimento_ano_estabelecimento_AnoLetivo_` FOREIGN KEY (`Estabelecimento_ID_`) REFERENCES `estabelecimento` (`Estabelecimento_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `estabelecimento`
--
ALTER TABLE `estabelecimento`
  ADD CONSTRAINT `FK_Estabelecimento_noname_Empresa` FOREIGN KEY (`Empresa_ID`) REFERENCES `empresa` (`Empresa_ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Estabelecimento_noname_TipoEstabelecimento` FOREIGN KEY (`TipoEstabelecimento_ID`) REFERENCES `tipoestabelecimento` (`TipoEstabelecimento_ID`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `estagio`
--
ALTER TABLE `estagio`
  ADD CONSTRAINT `FK_Estagio_Aluno` FOREIGN KEY (`Aluno_ID`) REFERENCES `aluno` (`User_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Estagio_Formador` FOREIGN KEY (`Formador_User_ID`) REFERENCES `formador` (`User_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Estagio_Responsavel` FOREIGN KEY (`Responsavel_ID`) REFERENCES `responsavel` (`Responsavel_ID`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `formador`
--
ALTER TABLE `formador`
  ADD CONSTRAINT `FK_Formador_User` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `listado_por`
--
ALTER TABLE `listado_por`
  ADD CONSTRAINT `FK_Estabelecimento_listado_por_zona_` FOREIGN KEY (`Estabelecimento_ID`) REFERENCES `estabelecimento` (`Estabelecimento_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_zona_listado_por_Estabelecimento_` FOREIGN KEY (`zona_ID`) REFERENCES `zona` (`zona_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produto_estabelecimento`
--
ALTER TABLE `produto_estabelecimento`
  ADD CONSTRAINT `FK_Estabelecimento_produto_estabelecimento_Produto_` FOREIGN KEY (`Estabelecimento_ID_`) REFERENCES `estabelecimento` (`Estabelecimento_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Produto_produto_estabelecimento_Estabelecimento_` FOREIGN KEY (`Produto_ID_`) REFERENCES `produto` (`Produto_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `ramodeatividade`
--
ALTER TABLE `ramodeatividade`
  ADD CONSTRAINT `FK_RamoDeAtividade_noname_Empresa` FOREIGN KEY (`Empresa_ID`) REFERENCES `empresa` (`Empresa_ID`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `responsavel`
--
ALTER TABLE `responsavel`
  ADD CONSTRAINT `FK_Responsavel_noname_Estabelecimento` FOREIGN KEY (`Estabelecimento_ID`) REFERENCES `estabelecimento` (`Estabelecimento_ID`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `transporte`
--
ALTER TABLE `transporte`
  ADD CONSTRAINT `FK_transporte_noname_TipoTransporte` FOREIGN KEY (`TipoTransporte_ID`) REFERENCES `tipotransporte` (`TipoTransporte_ID`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `transporte_zona`
--
ALTER TABLE `transporte_zona`
  ADD CONSTRAINT `FK_transporte_transporte_zona_zona_` FOREIGN KEY (`transporte_ID_`) REFERENCES `transporte` (`transporte_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_zona_transporte_zona_transporte_` FOREIGN KEY (`zona_ID_`) REFERENCES `zona` (`zona_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `FK_Turma_noname_Curso` FOREIGN KEY (`Curso_ID`) REFERENCES `curso` (`Curso_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
