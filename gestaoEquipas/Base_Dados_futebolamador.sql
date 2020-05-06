-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Nov-2019 às 18:54
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `futebolamador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `campos`
--

CREATE TABLE `campos` (
  `Nome_campo` varchar(100) NOT NULL,
  `GPS` varchar(40) DEFAULT NULL,
  `Rua` varchar(100) DEFAULT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Cidade` varchar(100) DEFAULT NULL,
  `Custo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `campos`
--

INSERT INTO `campos` (`Nome_campo`, `GPS`, `Rua`, `Numero`, `Cidade`, `Custo`) VALUES
('Campo de Santa Cruz', '40.214469,-8.416342', 'R. Lourenco de Almeida Azevedo', 19, 'Coimbra', 30),
('Campo da Arregaca', '40.200768,-8.413806', 'R. Fonte do Bispo', 136, 'Coimbra', 25),
('Campo Ramos Carvalho', '40.252203,-8.448396', 'Rua Aluvada', 87, 'Coimbra', 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `capitaes`
--

CREATE TABLE `capitaes` (
  `CC` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `capitaes`
--

INSERT INTO `capitaes` (`CC`) VALUES
('111111115as5'),
('222222227bs2'),
('333333331rt8'),
('444444443bt8'),
('555555559hj7');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipas`
--

CREATE TABLE `equipas` (
  `Nome_equipa` varchar(100) NOT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `Nome_torneio` varchar(100) NOT NULL,
  `CC` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `equipas`
--

INSERT INTO `equipas` (`Nome_equipa`, `Estado`, `Nome_torneio`, `CC`) VALUES
('Equipa C', 1, 'Torneio_2', '333333331rt8'),
('Equipa D', 1, 'Torneio_2', '444444443bt8'),
('Equipa E', 0, 'Torneio_3', '555555559hj7'),
('Equipa A', 0, 'Torneio_1', '111111115as5'),
('Equipa B', 0, 'Torneio_1', '222222227bs2'),
('Equipa F', 0, 'Torneio_3', '111111115as5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipas jogadores`
--

CREATE TABLE `equipas jogadores` (
  `Nome_equipa` varchar(100) NOT NULL,
  `CC` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `equipas jogadores`
--

INSERT INTO `equipas jogadores` (`Nome_equipa`, `CC`) VALUES
('Equipa A', '111111115as5'),
('Equipa A', '22227521u13k'),
('Equipa A', '23232323v56j'),
('Equipa A', '333333331rt8'),
('Equipa A', '55557521v22d'),
('Equipa A', '66665821c86n'),
('Equipa B', '222222227bs2'),
('Equipa B', '444444443bt8'),
('Equipa B', '44447521v27e'),
('Equipa B', '666666661lk4'),
('Equipa B', '95674421g29s'),
('Equipa C', '333333331rt8'),
('Equipa C', '555555559hj7'),
('Equipa C', '645675821v83'),
('Equipa D', '33337581v23b'),
('Equipa D', '444444443bt8'),
('Equipa D', '76753421t34v'),
('Equipa D', '888888886ty2'),
('Equipa E', '555555559hj7'),
('Equipa E', '95674421g29s'),
('Equipa E', '999999992df3'),
('Equipa F', '00000000u36n'),
('Equipa F', '111111115as5'),
('Equipa F', '666666661lk4'),
('Equipa F', '86729421t99k'),
('Equipa Z', '00000000u36n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gestores_torneio`
--

CREATE TABLE `gestores_torneio` (
  `CC` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gestores_torneio torneios`
--

CREATE TABLE `gestores_torneio torneios` (
  `CC` varchar(12) NOT NULL,
  `Nome_torneio` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogadores`
--

CREATE TABLE `jogadores` (
  `CC` varchar(12) NOT NULL,
  `Prioridade_conv` int(11) DEFAULT NULL,
  `Numero_falhas` int(11) DEFAULT NULL,
  `Saldo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jogadores`
--

INSERT INTO `jogadores` (`CC`, `Prioridade_conv`, `Numero_falhas`, `Saldo`) VALUES
('33337581v23b', 14, 0, 11),
('333333331rt8', 14, 0, 11),
('222222227bs2', 9, 0, 15),
('22227521u13k', 7, 2, 15),
('23232323v56j', 6, 0, 11),
('111111115as5', 2, 0, 25),
('666666661lk4', 4, 0, 25),
('444444443bt8', 1, 0, 13),
('44447521v27e', 2, 0, 22),
('66665821c86n', 8, 0, 0),
('555555559hj7', 12, 0, 21),
('55557521v22d', 13, 0, 20),
('645675821v83', 16, 0, 12),
('86729421t99k', 3, 0, 16),
('888888886ty2', 8, 0, 16),
('00000000u36n', 0, 0, 20),
('95674421g29s', 15, 0, 11),
('999999992df3', 14, 0, 11),
('76753421t34v', 0, 0, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogadores_jogo`
--

CREATE TABLE `jogadores_jogo` (
  `id_jogo` int(11) NOT NULL,
  `Nome_torneio` varchar(100) NOT NULL,
  `CC` varchar(12) NOT NULL,
  `Nome_equipa` varchar(100) NOT NULL,
  `Posicao` varchar(100) DEFAULT NULL,
  `Suplente` tinyint(1) DEFAULT NULL,
  `Golos_marcados` int(11) DEFAULT NULL,
  `Pediu_subs` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jogadores_jogo`
--

INSERT INTO `jogadores_jogo` (`id_jogo`, `Nome_torneio`, `CC`, `Nome_equipa`, `Posicao`, `Suplente`, `Golos_marcados`, `Pediu_subs`) VALUES
(1, 'Torneio_1', '95674421g29s', 'Equipa B', 'Guarda-redes', 0, 0, 0),
(1, 'Torneio_1', '222222227bs2', 'Equipa B', 'Medio', 0, 0, 0),
(1, 'Torneio_1', '444444443bt8', 'Equipa B', 'Defesa', 0, 0, 0),
(2, 'Torneio_1', '23232323v56j', 'Equipa A', 'Defesa', 0, 0, 0),
(1, 'Torneio_1', '333333331rt8', 'Equipa A', 'Defesa', 0, 0, 0),
(2, 'Torneio_1', '111111115as5', 'Equipa A', 'Defesa', 0, 0, 0),
(1, 'Torneio_1', '55557521v22d', 'Equipa A', 'Medio', 0, 0, 0),
(1, 'Torneio_1', '22227521u13k', 'Equipa A', 'Avancado', 0, 0, 0),
(2, 'Torneio_1', '222222227bs2', 'Equipa B', 'Avancado', 0, 0, 0),
(1, 'Torneio_1', '66665821c86n', 'Equipa A', 'Medio', 0, 0, 0),
(2, 'Torneio_1', '95674421g29s', 'Equipa B', 'Medio', 0, 0, 0),
(1, 'Torneio_1', '44447521v27e', 'Equipa B', 'Avancado', 0, 0, 0),
(2, 'Torneio_1', '66665821c86n', 'Equipa A', 'Guarda-redes', 0, 0, 0),
(2, 'Torneio_1', '22227521u13k', 'Equipa A', 'Medio', 0, 0, 0),
(2, 'Torneio_1', '55557521v22d', 'Equipa A', 'Avancado', 0, 0, 0),
(2, 'Torneio_1', '333333331rt8', 'Equipa A', 'Medio', 0, 0, 0),
(1, 'Torneio_1', '23232323v56j', 'Equipa A', 'Defesa', 0, 0, 0),
(2, 'Torneio_1', '444444443bt8', 'Equipa B', 'Guarda-redes', 0, 0, 0),
(2, 'Torneio_1', '44447521v27e', 'Equipa B', 'Defesa', 0, 0, 0),
(1, 'Torneio_2', '333333331rt8', 'Equipa C', 'Defesa', 0, 0, 0),
(1, 'Torneio_2', '555555559hj7', 'Equipa C', 'Medio', 0, 0, 0),
(1, 'Torneio_2', '645675821v83', 'Equipa C', 'Guarda-redes', 0, 0, 0),
(2, 'Torneio_2', '333333331rt8', 'Equipa C', 'Defesa', 0, 0, 0),
(2, 'Torneio_2', '555555559hj7', 'Equipa C', 'Medio', 0, 0, 0),
(2, 'Torneio_2', '645675821v83', 'Equipa C', 'Guarda-redes', 0, 0, 0),
(1, 'Torneio_2', '33337581v23b', 'Equipa D', 'Guarda-redes', 0, 0, 0),
(1, 'Torneio_2', '444444443bt8', 'Equipa D', 'Medio', 0, 0, 0),
(1, 'Torneio_2', '76753421t34v', 'Equipa D', 'Avancado', 0, 0, 0),
(1, 'Torneio_2', '888888886ty2', 'Equipa D', 'Medio', 0, 0, 0),
(2, 'Torneio_2', '33337581v23b', 'Equipa D', 'Guarda-redes', 0, 0, 0),
(2, 'Torneio_2', '444444443bt8', 'Equipa D', 'Medio', 0, 0, 1),
(2, 'Torneio_2', '76753421t34v', 'Equipa D', 'Avancado', 0, 0, 0),
(2, 'Torneio_2', '888888886ty2', 'Equipa D', 'Medio', 0, 0, 0),
(1, 'Torneio_3', '555555559hj7', 'Equipa E', 'Medio', 0, 0, 0),
(1, 'Torneio_3', '95674421g29s', 'Equipa E', 'Defesa', 0, 0, 0),
(1, 'Torneio_3', '999999992df3', 'Equipa E', 'Avancado', 0, 0, 0),
(2, 'Torneio_3', '555555559hj7', 'Equipa E', 'Medio', 0, 0, 0),
(2, 'Torneio_3', '95674421g29s', 'Equipa E', 'Defesa', 0, 0, 0),
(2, 'Torneio_3', '999999992df3', 'Equipa E', 'Avancado', 0, 0, 0),
(1, 'Torneio_3', '111111115as5', 'Equipa F', 'Avancado', 0, 0, 0),
(1, 'Torneio_3', '86729421t99k', 'Equipa F', 'Guarda-redes', 0, 0, 0),
(2, 'Torneio_3', '111111115as5', 'Equipa F', 'Avancado', 0, 0, 0),
(2, 'Torneio_3', '666666661lk4', 'Equipa F', 'Defesa', 0, 0, 1),
(2, 'Torneio_3', '86729421t99k', 'Equipa F', 'Guarda-redes', 0, 0, 0),
(1, 'Torneio_1', '666666661lk4', 'Equipa B', 'Medio', 0, 0, 0),
(1, 'Torneio_3', '666666661lk4', 'Equipa F', 'Defesa', 0, 0, 0),
(2, 'Torneio_1', '666666661lk4', 'Equipa B', 'Medio', 0, 0, 0),
(2, 'Torneio_3', '00000000u36n', 'Equipa F', 'Avancado', 0, 0, 0),
(1, 'Torneio_3', '00000000u36n', 'Equipa F', 'Avancado', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos`
--

CREATE TABLE `jogos` (
  `id_jogo` int(11) NOT NULL,
  `Nome_torneio` varchar(100) NOT NULL,
  `Data` date DEFAULT NULL,
  `Golos_visitantes` int(11) DEFAULT NULL,
  `Golos_visitados` int(11) DEFAULT NULL,
  `Nome_equipa_visitante` varchar(100) NOT NULL,
  `Nome_equipa_visitada` varchar(100) NOT NULL,
  `id_slot` int(11) NOT NULL,
  `Jornada` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jogos`
--

INSERT INTO `jogos` (`id_jogo`, `Nome_torneio`, `Data`, `Golos_visitantes`, `Golos_visitados`, `Nome_equipa_visitante`, `Nome_equipa_visitada`, `id_slot`, `Jornada`) VALUES
(1, 'Torneio_1', '2019-11-18', 0, 0, 'Equipa A', 'Equipa B', 2, 0),
(1, 'Torneio_3', '2020-03-02', 0, 0, 'Equipa E', 'Equipa F', 2, 0),
(2, 'Torneio_1', '2019-12-17', 0, 0, 'Equipa B', 'Equipa A', 3, 1),
(1, 'Torneio_2', '2020-01-15', 0, 0, 'Equipa C', 'Equipa D', 4, 0),
(2, 'Torneio_2', '2020-01-27', 0, 0, 'Equipa D', 'Equipa C', 4, 1),
(2, 'Torneio_3', '2020-02-26', 0, 0, 'Equipa F', 'Equipa E', 6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `myguests`
--

CREATE TABLE `myguests` (
  `CC` varchar(12) NOT NULL,
  `Nome_torneio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifica`
--

CREATE TABLE `notifica` (
  `CC_autor` varchar(12) NOT NULL,
  `CC` varchar(12) DEFAULT NULL,
  `id_notificacao` char(10) DEFAULT NULL,
  `Lida` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id_notificacao` char(10) NOT NULL,
  `Texto` varchar(1000) DEFAULT NULL,
  `Data` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posicoes desejadas`
--

CREATE TABLE `posicoes desejadas` (
  `Posicao` varchar(100) NOT NULL,
  `CC` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `CC` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`CC`) VALUES
('00000000u36n'),
('100000002v73'),
('20000000v27e'),
('30000000v89m'),
('40000000v22d'),
('50000000l86n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas torneios`
--

CREATE TABLE `reservas torneios` (
  `CC` varchar(12) NOT NULL,
  `Nome_torneio` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `reservas torneios`
--

INSERT INTO `reservas torneios` (`CC`, `Nome_torneio`) VALUES
('00000000u36n', 'Torneio_1'),
('100000002v73', 'Torneio_1'),
('20000000v27e', 'Torneio_2'),
('30000000v89m', 'Torneio_2'),
('40000000v22d', 'Torneio_3'),
('50000000l86n', 'Torneio_3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `slot`
--

CREATE TABLE `slot` (
  `id_slot` int(11) NOT NULL,
  `Nome_campo` varchar(100) NOT NULL,
  `Hora_inicio` time DEFAULT NULL,
  `Hora_fim` time DEFAULT NULL,
  `Dia_semana` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `slot`
--

INSERT INTO `slot` (`id_slot`, `Nome_campo`, `Hora_inicio`, `Hora_fim`, `Dia_semana`) VALUES
(2, 'Campo de Santa Cruz', '10:00:00', NULL, 'Segunda-feira'),
(3, 'Campo da Arregaca', '09:00:00', NULL, 'Terca-feira'),
(4, 'Campo de Santa Cruz', '11:00:00', NULL, 'Quarta-feira'),
(5, 'Campo Ramos Carvalho', '09:00:00', NULL, 'Quinta-feira'),
(6, 'Campo da Arregaca', '18:00:00', NULL, 'Sexta-feira'),
(7, 'Campo Ramos Carvalho', '21:00:00', NULL, 'Sexta-feira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `slot_torneios`
--

CREATE TABLE `slot_torneios` (
  `id_slot` int(11) NOT NULL,
  `Nome_torneio` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `torneios`
--

CREATE TABLE `torneios` (
  `Nome_torneio` varchar(100) NOT NULL,
  `Data_inicio` date NOT NULL,
  `Data_fim` date NOT NULL,
  `Numero_confrontos` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `torneios`
--

INSERT INTO `torneios` (`Nome_torneio`, `Data_inicio`, `Data_fim`, `Numero_confrontos`) VALUES
('Torneio_1', '2019-11-10', '2019-12-10', 2),
('Torneio_2', '2020-01-10', '2020-02-10', 2),
('Torneio_3', '2020-03-10', '2020-04-10', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `CC` varchar(12) NOT NULL,
  `Primeiro_nome` varchar(100) NOT NULL,
  `Ultimo_nome` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Telemovel` int(11) DEFAULT NULL,
  `Admin` tinyint(1) DEFAULT NULL,
  `Confirmado` tinyint(1) NOT NULL DEFAULT 0,
  `Banido` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`CC`, `Primeiro_nome`, `Ultimo_nome`, `Email`, `Password`, `Username`, `Telemovel`, `Admin`, `Confirmado`, `Banido`) VALUES
('123456784ds5', 'administrador', 'boss', 'admin@gmail.com', 'adminadmin', 'Admin', 914689657, 1, 0, 0),
('00000000u36n', 'Rita', 'Garrido', 'ritagarrido@hotmail.com', 'ritapass', 'RitaG', 914914689, 0, 0, 0),
('111111115as5', 'Henrique', 'Santos', 'henrique@gmail.com', 'henrique', 'HS', 935876945, 0, 0, 0),
('222222227bs2', 'Pedro', 'Cardoso', 'pedro@gmail.com', 'pedroC', 'PC', 918563222, 0, 0, 0),
('333333331rt8', 'Andre', 'Rodrigues', 'andre@gmail.com', 'andreR', 'AR', 918458322, 0, 0, 0),
('444444443bt8', 'Joao', 'Antunes', 'joao@gmail.com', 'joaoA', 'JA', 925639888, 0, 0, 0),
('777777776yu4', 'Luis', 'Moreira', 'luis@gmail.com', 'luisM', 'LM', 925652388, 0, 0, 0),
('555555559hj7', 'Andreia', 'Moreira', 'andreia@gmail.com', 'andreiaM', 'AM', 914568999, 0, 1, 0),
('666666661lk4', 'Duarte', 'Santos', 'duarte@gmail.com', 'duarteS', 'DS', 914568899, 0, 1, 0),
('888888886ty2', 'Antonio', 'Mendes', 'antonio@gmail.com', 'antonioM', 'ANM', 914568891, 0, 1, 0),
('999999992df3', 'Dinis', 'Silveira', 'dinis@gmail.com', 'dinisS', 'DIS', 911568891, 0, 1, 0),
('100000002v73', 'Diogo', 'Simao', 'diogo@gmail.com', 'diogoS', 'DSIM', 911538891, 0, 1, 0),
('20000000v27e', 'Hugo', 'Moreira', 'hugo@gmail.com', 'hugoM', 'HM', 911545891, 0, 1, 0),
('30000000v89m', 'Gustavo', 'Abreu', 'gustavo@gmail.com', 'gustavoA', 'GA', 911545899, 0, 1, 0),
('23232323v56j', 'Joao', 'Andre', 'joao@gmail.com', 'joaoA', 'JA', 935698741, 0, 1, 0),
('45674321v89m', 'Joao', 'Pedro', 'joao@gmail.com', 'joaoP', 'JP', 930698741, 0, 1, 0),
('95674421g29s', 'Nuno', 'Pedro', 'nuno@gmail.com', 'NunoP', 'NP', 930698941, 0, 1, 0),
('645675821v83', 'Ricardo', 'Andrade', 'ricardo@gmail.com', 'ricardoA', 'RA', 932698741, 0, 1, 0),
('11117582v81t', 'Sandro', 'Matos', 'sandro@gmail.com', 'sandroM', 'SM', 932648741, 0, 1, 0),
('22227521u13k', 'Bernardo', 'Moreira', 'bernardo@gmail.com', 'bernardoM', 'BM', 931648742, 0, 1, 0),
('11117582v73m', 'Teresa', 'Matos', 'teresa@gmail.com', 'teresaM', 'TM', 936741111, 0, 1, 0),
('33337581v23b', 'Diana', 'Bandeira', 'diana@gmail.com', 'dianaB', 'DB', 936741001, 0, 1, 0),
('44447521v27e', 'Luisa', 'Simao', 'luisa@gmail.com', 'luisaS', 'LS', 936741002, 0, 1, 0),
('55557521v22d', 'Frederico', 'Costa', 'frederico@gmail.com', 'fredericoC', 'FC', 936701002, 0, 1, 0),
('66665821c86n', 'Gustavo', 'Rodrigues', 'gustavo@gmail.com', 'gustavoR', 'GR', 916701032, 0, 1, 0),
('77775821v56n', 'Diogo', 'Binnema', 'diogo@gmail.com', 'diogoB', 'DB', 916781032, 0, 1, 0),
('50000000l86n', 'Dinis', 'Binnema', 'dinis@gmail.com', 'dinisB', 'DNB', 916781532, 0, 1, 0),
('40000000v22d', 'Joana', 'Roma', 'joana@gmail.com', 'joanaR', 'JR', 916781502, 0, 1, 0),
('99995821p84w', 'Luis', 'Sergio', 'luisa@gmail.com', 'luisS', 'LS', 912781502, 0, 1, 0),
('01015821l00a', 'Filipa', 'Martins', 'filipaa@gmail.com', 'filipaM', 'FM', 919781502, 0, 1, 0),
('34555821l05a', 'Fatima', 'Subida', 'fatima@gmail.com', 'fatimaS', 'FS', 929781502, 0, 1, 0),
('64555821l30i', 'Bruno', 'Branco', 'bruno@gmail.com', 'brunoB', 'BB', 921781502, 0, 1, 0),
('66653421y39v', 'Sara', 'Jorge', 'sara@gmail.com', 'saraJ', 'SJ', 911781502, 0, 1, 0),
('76753421t34v', 'Renato', 'Vaz', 'renato@gmail.com', 'renatoV', 'RV', 911781502, 0, 1, 0),
('86729421t99k', 'Pedro', 'Nunes', 'renato@gmail.com', 'renatoV', 'RV', 911781502, 0, 1, 0),
('98329421h77c', 'Filipe', 'Santos', 'renato@gmail.com', 'renatoV', 'RV', 911781502, 0, 1, 0),
('12341234r56h', 'Moreira', 'Ines', 'ines@gmail.com', '1234', 'Ines', 999999999, 0, 1, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `campos`
--
ALTER TABLE `campos`
  ADD PRIMARY KEY (`Nome_campo`);

--
-- Índices para tabela `capitaes`
--
ALTER TABLE `capitaes`
  ADD PRIMARY KEY (`CC`);

--
-- Índices para tabela `equipas`
--
ALTER TABLE `equipas`
  ADD PRIMARY KEY (`Nome_equipa`),
  ADD KEY `RefTorneios20` (`Nome_torneio`),
  ADD KEY `RefCapitaes21` (`CC`);

--
-- Índices para tabela `equipas jogadores`
--
ALTER TABLE `equipas jogadores`
  ADD PRIMARY KEY (`Nome_equipa`,`CC`),
  ADD KEY `RefJogadores24` (`CC`);

--
-- Índices para tabela `gestores_torneio`
--
ALTER TABLE `gestores_torneio`
  ADD PRIMARY KEY (`CC`);

--
-- Índices para tabela `gestores_torneio torneios`
--
ALTER TABLE `gestores_torneio torneios`
  ADD PRIMARY KEY (`CC`,`Nome_torneio`),
  ADD KEY `RefTorneios16` (`Nome_torneio`);

--
-- Índices para tabela `jogadores`
--
ALTER TABLE `jogadores`
  ADD PRIMARY KEY (`CC`);

--
-- Índices para tabela `jogadores_jogo`
--
ALTER TABLE `jogadores_jogo`
  ADD PRIMARY KEY (`id_jogo`,`Nome_torneio`,`CC`),
  ADD KEY `RefEquipas25` (`Nome_equipa`),
  ADD KEY `RefJogadores27` (`CC`);

--
-- Índices para tabela `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id_jogo`,`Nome_torneio`),
  ADD KEY `RefTorneios29` (`Nome_torneio`),
  ADD KEY `RefEquipas32` (`Nome_equipa_visitante`),
  ADD KEY `RefEquipas33` (`Nome_equipa_visitada`),
  ADD KEY `RefSlot37` (`id_slot`);

--
-- Índices para tabela `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`CC_autor`),
  ADD KEY `RefNotificacoes55` (`id_notificacao`),
  ADD KEY `RefUtilizadores56` (`CC`);

--
-- Índices para tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id_notificacao`);

--
-- Índices para tabela `posicoes desejadas`
--
ALTER TABLE `posicoes desejadas`
  ADD PRIMARY KEY (`CC`),
  ADD KEY `RefJogadores7` (`CC`);

--
-- Índices para tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`CC`);

--
-- Índices para tabela `reservas torneios`
--
ALTER TABLE `reservas torneios`
  ADD PRIMARY KEY (`CC`,`Nome_torneio`),
  ADD KEY `RefTorneios13` (`Nome_torneio`);

--
-- Índices para tabela `slot`
--
ALTER TABLE `slot`
  ADD PRIMARY KEY (`id_slot`);

--
-- Índices para tabela `slot_torneios`
--
ALTER TABLE `slot_torneios`
  ADD PRIMARY KEY (`id_slot`,`Nome_torneio`),
  ADD KEY `RefTorneios36` (`Nome_torneio`);

--
-- Índices para tabela `torneios`
--
ALTER TABLE `torneios`
  ADD PRIMARY KEY (`Nome_torneio`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`CC`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
