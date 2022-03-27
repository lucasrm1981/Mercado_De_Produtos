
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categorias` (
  `categoriaID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `categoriaNome` varchar(255) CHARACTER SET utf8 NOT NULL UNIQUE,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categorias` (`categoriaNome`, `status`) VALUES
('Limpeza', 1),
('Cama e Banho', 1),
('Eletro', 0),
('Alimentos', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `fornecedorID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nomeFantasia` varchar(255) NOT NULL,
  `razaoSocial` varchar(255) NOT NULL UNIQUE,
  `ie` int(11) NOT NULL UNIQUE,
  `cnpj` int(11) NOT NULL UNIQUE,
  `cnae` int(11) NOT NULL UNIQUE,
  `endereco` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`nomeFantasia`, `razaoSocial`, `ie`, `cnpj`, `cnae`, `endereco`) VALUES
('Barraca do Atacado do Ze', 'BAZ', 11111111, 22222222, 33333333, 'Rua do Fornecedor, 1'),
('Joao varejista', 'JV', 33333333, 1111111, 222222, 'Rua do Fornecedor,2'),
('Pedro Atacarejo', 'PA', 444444, 555555, 666666, 'Rua do Fornecedor, 3'),
('Maria do Grao', 'MG', 777777, 888888, 999999, 'Rua do Fornecedor, 4'),
('O ze fornecedor', 'OZ', 0000000, 1234567, 09876543, 'Rua do Fornecedor, 5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `loginID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `telefone` varchar(255) DEFAULT '21 9999-8888',
  `login` varchar(255) NOT NULL UNIQUE,
  `senha` varchar(255) NOT NULL,
  `enderecoPadrao` varchar(255) NOT NULL,
  `restricao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`nome`, `email`, `telefone`, `login`, `senha`, `enderecoPadrao`, `restricao`) VALUES
('Administrador', 'admin@admin.com.br', '21 9999-8888', 'admin', '12345', 'Rua da empresa, 71', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `produtoID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `produtoNome` varchar(255) CHARACTER SET utf8 NOT NULL UNIQUE,
  `fornecedorID` int(11) NOT NULL,
  `categoriaID` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`produtoNome`, `fornecedorID`, `categoriaID`, `quantidade`, `preco`) VALUES
('PedaÃ§o de bolo', 2, 4, 2000, '5.00'),
('PÃ£o Doce', 2, 2, 11, '11.00'),
('Bala Juquinha', 3, 1, 222, '22.00'),
('Jaca Manteiga', 2, 3, 11, '111.00'),
('Veja Multiuso', 1, 1, 100, '20.00'),
('Biscoito', 2, 1, 22, '222.00'),
('Coca Cola', 2, 1, 22, '22.00'),
('Goiaba', 2, 2, 100, '100.00'),
('Pasta de Dentes', 2, 1, 6666, '6666.00');

-- --------------------------------------------------------
