SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
  AUTOCOMMIT = 0;

START TRANSACTION;

SET
  time_zone = "+00:00";

--
-- Database: `food_club`
--
-- --------------------------------------------------------

--
-- Estrutura da tabela `responsible`
--
DROP TABLE IF EXISTS `responsible`;

CREATE TABLE IF NOT EXISTS `responsible` (
  `cpf` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL,
  -- `studentsEnrollment` int(9) NOT NULL,
  `access_level` int(1) NOT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE KEY `email` (`cpf`)
) ENGINE = MyISAM AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8;

--
-- Estrutura da tabela `student`
--
DROP TABLE IF EXISTS `student`;

CREATE TABLE IF NOT EXISTS `student` (
  `enrollment` varchar(9) NOT NULL,
  `student_class` int(3) NOT NULL,
  `shift` int(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL,
  `responsible_cpf` varchar(11) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `access_level` int(1) NOT NULL,
  PRIMARY KEY (`enrollment`),
  UNIQUE KEY `email` (`enrollment`)
) ENGINE = MyISAM AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8;

--
-- Estrutura da tabela `staff`
--
DROP TABLE IF EXISTS `staff`;

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `access_level` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`email`)
) ENGINE = MyISAM AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8;

--
-- Estrutura da tabela `product`
--
--@TODO
  -- `ingredients` 
  -- `provider`
DROP TABLE IF EXISTS `product`;

CREATE TABLE IF NOT EXISTS `product` (
  `type` int(1) NOT NULL,
  `code` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `price` varchar(11) NOT NULL,
  `blocked` boolean NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `code` (`name`)
) ENGINE = MyISAM AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8;

--
-- Extraindo dados da tabela `responsible`
--
INSERT INTO
  `responsible` (
    `cpf`,
    `name`,
    `phone_number`,
    `email`,
    `login`,
    `password`,
    `access_level`
  )
VALUES
  (
    '66588207085',
    'Pedro da Silva',
    '75992775555',
    'responsavel@gmail.com',
    'banana144171001',
    '123123',
    2
  ),
  (
    '72771775840',
    'Antonio Sales',
    '79982517774',
    'antoniosales@gmail.com',
    'antonio471268008',
    '123123',
    2
  );
  COMMIT;

--
-- Extraindo dados da tabela `student`
--
INSERT INTO
  `student` (
    `enrollment`,
    `student_class`,
    `shift`,
    `name`,
    `phone_number`,
    `email`,
    `login`,
    `password`,
    `responsible_cpf`,
    `balance`,
    `access_level`
  )
VALUES
  (
    '144171001',
    101,
    2,
    'Joao da Silva',
    '75992775555',
    'aluno@gmail.com',
    'bananinha144171001',
    '123123',
    '66588207085',
    '312',
    3
  ),
  (
    '202973268',
    102,
    1,
    'Fernando Carlos Eduardo Sales',
    '79982517774',
    'fernandosales@gmail.com',
    'fernando471268008',
    '123123',
    '72771775840',
    '241',
    3
  ),
  (
    '198664138',
    102,
    1,
    'Marcio Levi Tiago Sales',
    '7925660814',
    'marciosales@gmail.com',
    'marcio198664138',
    '123123',
    '72771775840',
    '325',
    3
  );
  COMMIT;

--
-- Extraindo dados da tabela `staff`
--
INSERT INTO
  `staff` (
    `name`,
    `adress`,
    `phone_number`,
    `email`,
    `access_level`
  )
VALUES
  (
    'Unifacs',
    'Av. Juracy Magalhães Júnior, S/N - Rio Vermelho, Salvador - BA, 41940-060',
    '7130212800',
    'funcionario@gmail.com',
    1
  );
  COMMIT;

--
-- Extraindo dados da tabela `product`
--
-- @TODO 
    -- ingredients
    -- provider

INSERT INTO
  `product` (
    `type`,
    `code`,
    `name`,
    `picture`,
    `price`,
    `blocked`
  )
VALUES
  (
    1,
    '101',
    'Bauru',
    '',
    '5',
    true
  ),
  (
    1,
    '102',
    'Dinoburguer',
    '',
    '12',
    false
  ),
  (
    2,
    '103',
    'Dinosoba',
    '',
    '4',
    true
  ),
  (
    2,
    '125',
    'Agua',
    '',
    '2',
    false
  );
  COMMIT;