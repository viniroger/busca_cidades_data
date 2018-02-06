use NOME_DATABASE;
DROP TABLE IF EXISTS `cidades`;
DROP TABLE IF EXISTS `estados`;
CREATE TABLE `cidades` (
  `cod_cidades` int(8) DEFAULT NULL,
  `nome` varchar(72) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sigla` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE `estados` (
  `sigla` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(72) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
LOAD DATA LOCAL INFILE '/home/user/cidades.csv' INTO TABLE cidades
 FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n' (cod_cidades,nome,sigla);
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('AC', 'ACRE');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('AL', 'ALAGOAS');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('AP', 'AMAPÁ');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('AM', 'AMAZONAS');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('BA', 'BAHIA');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('CE', 'CEARÁ');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('DF', 'DISTRITO FEDERAL');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('ES', 'ESPÍRITO SANTO');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('RR', 'RORAIMA');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('GO', 'GOIÁS');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('MA', 'MARANHÃO');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('MT', 'MATO GROSSO');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('MS', 'MATO GROSSO DO SUL');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('MG', 'MINAS GERAIS');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('PA', 'PARÁ');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('PB', 'PARAÍBA');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('PR', 'PARANÁ');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('PE', 'PERNAMBUCO');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('PI', 'PIAUÍ');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('RJ', 'RIO DE JANEIRO');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('RN', 'RIO GRANDE DO NORTE');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('RS', 'RIO GRANDE DO SUL');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('RO', 'RONDÔNIA');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('TO', 'TOCANTINS');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('SC', 'SANTA CATARINA');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('SP', 'SÃO PAULO');
INSERT INTO `estados` (`sigla`, `nome`) VALUES ('SE', 'SERGIPE');
