-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Abr-2021 às 20:35
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `albicod_loja_marcelo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_clientes`
--

CREATE TABLE `cad_clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `tipo_doc` varchar(50) NOT NULL,
  `numero_doc` varchar(50) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cad_clientes`
--

INSERT INTO `cad_clientes` (`id`, `nome`, `email`, `senha`, `tipo_doc`, `numero_doc`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `status`, `dt_registro`) VALUES
(2, 'Thiago dos Santos Alves', 'thiagoalves@albicod.com', '202cb962ac59075b964b07152d234b70', 'CPF', '02957693518', '01153-000', 'Pracinio Ricardo da Silva', 103, 'Casa', 'Teotonio Calheira', 'São Paulo', 'SP', 1, '2021-04-12 14:56:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_cliente_cartoes`
--

CREATE TABLE `cad_cliente_cartoes` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `titular` varchar(100) NOT NULL,
  `numero_cartao` int(50) NOT NULL,
  `vencimento_mes` int(11) NOT NULL,
  `vencimento_ano` int(11) NOT NULL,
  `banco` varchar(50) NOT NULL,
  `bandeira` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_compras`
--

CREATE TABLE `cad_compras` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `total` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '3',
  `link_rastreamento` varchar(100) DEFAULT NULL,
  `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cad_compras`
--

INSERT INTO `cad_compras` (`id`, `id_cliente`, `codigo`, `total`, `status`, `link_rastreamento`, `dt_registro`) VALUES
(2, 2, '1235694105', 3, 1, 'https://www2.correios.com.br/sistemas/rastreamento/default.cfm', '2021-04-12 14:56:13'),
(3, 2, '1235709654', 2, 2, '', '2021-04-12 19:27:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_compra_produtos`
--

CREATE TABLE `cad_compra_produtos` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cad_compra_produtos`
--

INSERT INTO `cad_compra_produtos` (`id`, `id_compra`, `id_produto`, `quantidade`, `valor`) VALUES
(7, 2, 1, 2, 1),
(8, 3, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_config`
--

CREATE TABLE `cad_config` (
  `id` int(11) NOT NULL,
  `loja` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cep` varchar(30) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `google_maps` varchar(100) NOT NULL,
  `whatsapp` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `frete` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cad_config`
--

INSERT INTO `cad_config` (`id`, `loja`, `endereco`, `bairro`, `cep`, `cidade`, `estado`, `logo`, `favicon`, `title`, `titulo`, `imagem`, `instagram`, `facebook`, `google_maps`, `whatsapp`, `email`, `frete`) VALUES
(1, 'Albicod', 'Rua Pracinio Ricardo da Silva, 103', 'Teotonio Calheira', '45450-000', 'Gandu', 'BA', 'd8b606e519b03de16173f2c2ebea821c.webp', 'ce9a8f6e2b23cb261bdb2933f43cc192.webp', 'Albicod - Loja', 'Compre Agora', '74e5d344798bda749ccaae4a14031d04.webp', 'https://www.instagram.com/thiagoalvesdevphp/?hl=pt-br', 'https://www.facebook.com/devthiagoalves/', 'https://goo.gl/maps/uhba7oxYx9ydQYyR7', '73999412514', 'thiagoalves@albicod.com', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_definicao`
--

CREATE TABLE `cad_definicao` (
  `id` int(11) NOT NULL,
  `definicao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cad_definicao`
--

INSERT INTO `cad_definicao` (`id`, `definicao`) VALUES
(1, 'Administrador'),
(2, 'Colaborador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_estados`
--

CREATE TABLE `cad_estados` (
  `id` int(11) NOT NULL,
  `nome` varchar(75) CHARACTER SET latin1 DEFAULT NULL,
  `uf` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cad_estados`
--

INSERT INTO `cad_estados` (`id`, `nome`, `uf`, `status`) VALUES
(1, 'Acre', 'AC', 2),
(2, 'Alagoas', 'AL', 2),
(3, 'Amazonas', 'AM', 2),
(4, 'Amapá', 'AP', 2),
(5, 'Bahia', 'BA', 2),
(6, 'Ceará', 'CE', 2),
(7, 'Distrito Federal', 'DF', 2),
(8, 'Espírito Santo', 'ES', 2),
(9, 'Goiás', 'GO', 2),
(10, 'Maranhão', 'MA', 2),
(11, 'Minas Gerais', 'MG', 2),
(12, 'Mato Grosso do Sul', 'MS', 2),
(13, 'Mato Grosso', 'MT', 2),
(14, 'Pará', 'PA', 2),
(15, 'Paraíba', 'PB', 2),
(16, 'Pernambuco', 'PE', 2),
(17, 'Piauí', 'PI', 2),
(18, 'Paraná', 'PR', 2),
(19, 'Rio de Janeiro', 'RJ', 2),
(20, 'Rio Grande do Norte', 'RN', 2),
(21, 'Rondônia', 'RO', 2),
(22, 'Roraima', 'RR', 2),
(23, 'Rio Grande do Sul', 'RS', 2),
(24, 'Santa Catarina', 'SC', 2),
(25, 'Sergipe', 'SE', 2),
(26, 'São Paulo', 'SP', 1),
(27, 'Tocantins', 'TO', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_links`
--

CREATE TABLE `cad_links` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `link` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_produtos`
--

CREATE TABLE `cad_produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `valor` float NOT NULL,
  `descricao` text NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT '0',
  `peso` float NOT NULL,
  `largura` float NOT NULL,
  `altura` float NOT NULL,
  `comprimento` float NOT NULL,
  `diametro` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL,
  `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cad_produtos`
--

INSERT INTO `cad_produtos` (`id`, `nome`, `valor`, `descricao`, `estoque`, `peso`, `largura`, `altura`, `comprimento`, `diametro`, `status`, `id_usuario`, `dt_registro`) VALUES
(1, 'Produto 01', 1, '<ul>\r\n	<li>Taxa de atualiza&ccedil;&atilde;o de 144Hz e tempo de resposta de 1ms</li>\r\n	<li>Tecnologia AMD Radeon Free Sync para imagens perfeitamente sincronizadas</li>\r\n	<li>M&uacute;ltipla conectividade: DP, HDMI</li>\r\n	<li>Tecnologia Blue Light Shield &amp; antioscila&ccedil;&atilde;o para redu&ccedil;&atilde;o da fadiga</li>\r\n</ul>\r\n', 100, 1, 10, 20, 5, 5, 1, 1, '2021-04-08 19:04:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_produto_imagens`
--

CREATE TABLE `cad_produto_imagens` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `imagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cad_produto_imagens`
--

INSERT INTO `cad_produto_imagens` (`id`, `id_produto`, `imagem`) VALUES
(1, 1, '612c30bf7e65100a0dcde5a1acd13a39.webp');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_usuarios`
--

CREATE TABLE `cad_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `definicao` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cad_usuarios`
--

INSERT INTO `cad_usuarios` (`id`, `nome`, `email`, `login`, `senha`, `status`, `definicao`) VALUES
(1, 'Administrador', 'admin@admin.com', 'admin', '202cb962ac59075b964b07152d234b70', 1, 1),
(2, 'Leidy Brito', 'leide@hotmail.com', 'leidy', '202cb962ac59075b964b07152d234b70', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cad_clientes`
--
ALTER TABLE `cad_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cad_cliente_cartoes`
--
ALTER TABLE `cad_cliente_cartoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cad_compras`
--
ALTER TABLE `cad_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cad_compra_produtos`
--
ALTER TABLE `cad_compra_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cad_config`
--
ALTER TABLE `cad_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cad_definicao`
--
ALTER TABLE `cad_definicao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cad_estados`
--
ALTER TABLE `cad_estados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cad_links`
--
ALTER TABLE `cad_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cad_produtos`
--
ALTER TABLE `cad_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cad_produto_imagens`
--
ALTER TABLE `cad_produto_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cad_usuarios`
--
ALTER TABLE `cad_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cad_clientes`
--
ALTER TABLE `cad_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cad_cliente_cartoes`
--
ALTER TABLE `cad_cliente_cartoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cad_compras`
--
ALTER TABLE `cad_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cad_compra_produtos`
--
ALTER TABLE `cad_compra_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cad_config`
--
ALTER TABLE `cad_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cad_definicao`
--
ALTER TABLE `cad_definicao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cad_estados`
--
ALTER TABLE `cad_estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cad_links`
--
ALTER TABLE `cad_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cad_produtos`
--
ALTER TABLE `cad_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cad_produto_imagens`
--
ALTER TABLE `cad_produto_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cad_usuarios`
--
ALTER TABLE `cad_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
