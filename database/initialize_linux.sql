-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Gera��o: 07/05/2013 �s 00:27:28
-- Vers�o do Servidor: 5.1.68-cll
-- Vers�o do PHP: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `parmezan_voting`
--

-- --------------------------------------------------------

INSERT INTO `ADMINISTRADOR` (`ID`, `USUARIO`, `SENHA`) VALUES
(1, 'adm', '123');

-- --------------------------------------------------------

INSERT INTO `PARTICIPANTE` (`ID`, `USUARIO`, `SENHA`, `INSTITUICAO`) VALUES
(30, 'Teste', 'teste', 'UDESC'),
(32, 'participante', 'participante', 'UDESC');

-- --------------------------------------------------------

INSERT INTO `REUNIAO` (`ID`, `CODIGO`, `ATIVA`) VALUES
(1, '001', 1),
(2, '020', 1),
(3, '300', 1);

-- --------------------------------------------------------

INSERT INTO `VOTACAO` (`ID`, `TITULO`, `ID_REUNIAO`, `PERGUNTA`, `SUGESTAO`) VALUES
(1, 'Voting - Interface', 1, 'O que você achou da interface do sistema?', 0),
(2, 'Voting - Geral', 1, 'Você acha este sistema inovador?', 0),
(3, 'Voting - Facilidade', 1, 'Como você avalia a dificuldade de usar o sistema?', 0),
(4, 'Idade', 2, 'Qual sua idade?', 0),
(5, 'Viagem', 2, 'Você já viajou para o exterior?', 0),
(7, 'Praias', 3, 'Voce gosta de praia?', 0),
(11, 'Pesquisa', 2, 'Você gosta de comer salada?', 0),
(12, 'Música', 3, 'Qual seu estilo de música favorito?', 0);

-- --------------------------------------------------------

INSERT INTO `OPCAO` (`ID`, `DESCRICAO`, `ID_VOTACAO`, `NUM_VOTOS`) VALUES
(26, 'Sim', 7, 0),
(27, 'Nao', 7, 0),
(32, 'Bonita', 1, 0),
(33, 'Prática', 1, 0),
(34, 'Ruim', 1, 0),
(35, 'Sim', 2, 0),
(36, 'Não', 2, 0),
(37, 'Talvez', 2, 0),
(38, 'Muito fácil', 3, 0),
(39, 'Fácil', 3, 0),
(40, 'Moderada', 3, 0),
(41, 'Difícil', 3, 0),
(42, 'Muito difícil', 3, 0),
(43, '5 - 30', 4, 0),
(44, '31 - 100', 4, 0),
(45, 'Sim', 5, 0),
(46, 'Não', 5, 0),
(47, 'Não, mas pretendo', 5, 0),
(48, 'Sim', 11, 0),
(49, 'Não', 11, 0),
(50, 'Rock', 12, 0),
(51, 'House', 12, 0),
(52, 'Pop', 12, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
