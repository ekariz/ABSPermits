 
DROP TABLE IF EXISTS `api_access`;
CREATE TABLE `api_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL DEFAULT '',
  `all_access` tinyint(1) NOT NULL DEFAULT '0',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
DROP TABLE IF EXISTS `api_keys`;
CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
DROP TABLE IF EXISTS `api_limits`;
CREATE TABLE `api_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `api_logs`;
CREATE TABLE `api_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
DROP TABLE IF EXISTS `appayments`;
CREATE TABLE `appayments` (
  `refid` int(10) NOT NULL,
  `apptype` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `paid1` int(1) DEFAULT NULL,
  `paid2` int(1) DEFAULT NULL,
  `paid3` int(1) DEFAULT NULL,
  `paid4` int(1) DEFAULT NULL,
  `paid5` int(1) DEFAULT NULL,
  `paid6` int(1) DEFAULT NULL,
  `paid7` int(1) DEFAULT NULL,
  `paid8` int(1) DEFAULT NULL,
  `paid9` int(1) DEFAULT NULL,
  `paid10` int(1) DEFAULT NULL,
  `payref1` varchar(30) DEFAULT NULL,
  `payref2` varchar(30) DEFAULT NULL,
  `payref3` varchar(30) DEFAULT NULL,
  `payref4` varchar(30) DEFAULT NULL,
  `payref5` varchar(30) DEFAULT NULL,
  `payref6` varchar(30) DEFAULT NULL,
  `payref7` varchar(30) DEFAULT NULL,
  `payref8` varchar(30) DEFAULT NULL,
  `payref9` varchar(30) DEFAULT NULL,
  `payref10` varchar(30) DEFAULT NULL,
  `paytime1` int(10) DEFAULT NULL,
  `paytime2` int(10) DEFAULT NULL,
  `paytime3` int(10) DEFAULT NULL,
  `paytime4` int(10) DEFAULT NULL,
  `paytime5` int(10) DEFAULT NULL,
  `paytime6` int(10) DEFAULT NULL,
  `paytime7` int(10) DEFAULT NULL,
  `paytime8` int(10) DEFAULT NULL,
  `paytime9` int(10) DEFAULT NULL,
  `paytime10` int(10) DEFAULT NULL,
  `paymode1` varchar(20) DEFAULT NULL,
  `paymode2` varchar(20) DEFAULT NULL,
  `paymode3` varchar(20) DEFAULT NULL,
  `paymode4` varchar(20) DEFAULT NULL,
  `paymode5` varchar(20) DEFAULT NULL,
  `paymode6` varchar(20) DEFAULT NULL,
  `paymode7` varchar(20) DEFAULT NULL,
  `paymode8` varchar(20) DEFAULT NULL,
  `paymode9` varchar(20) DEFAULT NULL,
  `paymode10` varchar(20) DEFAULT NULL,
  `paycurrcode1` varchar(5) DEFAULT NULL,
  `paycurrcode2` varchar(5) DEFAULT NULL,
  `paycurrcode3` varchar(5) DEFAULT NULL,
  `paycurrcode4` varchar(5) DEFAULT NULL,
  `paycurrcode5` varchar(5) DEFAULT NULL,
  `paycurrcode6` varchar(5) DEFAULT NULL,
  `paycurrcode7` varchar(5) DEFAULT NULL,
  `paycurrcode8` varchar(5) DEFAULT NULL,
  `paycurrcode9` varchar(5) DEFAULT NULL,
  `paycurrcode10` varchar(5) DEFAULT NULL,
  `idpassno` int(10) NOT NULL,
  `paidamount1` decimal(9,2) DEFAULT NULL,
  `paidamount2` decimal(9,2) DEFAULT NULL,
  `paidamount3` decimal(9,2) DEFAULT NULL,
  `paidamount4` decimal(9,2) DEFAULT NULL,
  `paidamount5` decimal(9,2) DEFAULT NULL,
  `paidamount6` decimal(9,2) DEFAULT NULL,
  `paidamount7` decimal(9,2) DEFAULT NULL,
  `paidamount8` decimal(9,2) DEFAULT NULL,
  `paidamount9` decimal(9,2) DEFAULT NULL,
  `paidamount10` decimal(9,2) DEFAULT NULL,
  `paygateway1` varchar(20) DEFAULT NULL,
  `paygateway2` varchar(20) DEFAULT NULL,
  `paygateway3` varchar(20) DEFAULT NULL,
  `paygateway4` varchar(20) DEFAULT NULL,
  `paygateway5` varchar(20) DEFAULT NULL,
  `paygateway6` varchar(20) DEFAULT NULL,
  `paygateway7` varchar(20) DEFAULT NULL,
  `paygateway8` varchar(20) DEFAULT NULL,
  `paygateway9` varchar(20) DEFAULT NULL,
  `paygateway10` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`refid`),
  UNIQUE KEY `idx_pk` (`refid`,`idpassno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `applcs`;
CREATE TABLE `applcs` (
  `id` int(10) NOT NULL,
  `appno` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `instcode` varchar(10) NOT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `file_type` varchar(20) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`appno`,`email`,`instcode`),
  UNIQUE KEY `idx_pk` (`appno`,`email`,`instcode`),
  FULLTEXT KEY `idx_search` (`appno`,`email`,`instcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 
DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications` (
  `id` int(10) NOT NULL,
  `appno` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `position` varchar(10) NOT NULL,
  `applyingas` varchar(50) NOT NULL,
  `researcherid` varchar(30) DEFAULT NULL,
  `legalofficeremail` varchar(100) NOT NULL,
  `resourcetype` varchar(100) DEFAULT NULL,
  `speciesname` varchar(100) DEFAULT NULL,
  `scientificname` varchar(100) DEFAULT NULL,
  `commonname` varchar(100) DEFAULT NULL,
  `projectlocation` varchar(100) DEFAULT NULL,
  `projectarea` varchar(100) DEFAULT NULL,
  `resourceallocationpurpose` varchar(100) DEFAULT NULL,
  `exportanswer` varchar(10) DEFAULT NULL,
  `resourcetypeother` varchar(100) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `purposeother` varchar(255) DEFAULT NULL,
  `documentregistration` longtext NOT NULL,
  `documentresearchproposal` longtext NOT NULL,
  `documentaffiliation` longtext NOT NULL,
  `documentresearchbudget` longtext NOT NULL,
  `documentcv` longtext NOT NULL,
  `documentpic` longtext,
  `documentmat` longtext,
  `documentmta` longtext,
  `researchtype` varchar(10) DEFAULT NULL,
  `samplesamount` int(10) DEFAULT NULL,
  `conservestatus` varchar(10) DEFAULT NULL,
  `conservestatusdesc` varchar(100) DEFAULT NULL,
  `restraditionalknow` varchar(100) DEFAULT NULL,
  `exportgeneticresources` varchar(100) DEFAULT NULL,
  `legislationagree` varchar(5) DEFAULT NULL,
  `sampleuom` varchar(5) DEFAULT NULL,
  `apptime` int(10) DEFAULT NULL,
  `approved1` int(1) DEFAULT NULL,
  `approved2` int(1) DEFAULT NULL,
  `approved3` int(1) DEFAULT NULL,
  `approved4` int(1) DEFAULT NULL,
  `approved5` int(1) DEFAULT NULL,
  `approved6` int(1) DEFAULT NULL,
  `approved7` int(1) DEFAULT NULL,
  `approved8` int(1) DEFAULT NULL,
  `approved9` int(1) DEFAULT NULL,
  `approved10` int(1) DEFAULT NULL,
  `approver1` varchar(50) DEFAULT NULL,
  `approver2` varchar(50) DEFAULT NULL,
  `approver3` varchar(50) DEFAULT NULL,
  `approver4` varchar(50) DEFAULT NULL,
  `approver5` varchar(50) DEFAULT NULL,
  `approver6` varchar(50) DEFAULT NULL,
  `approver7` varchar(50) DEFAULT NULL,
  `approver8` varchar(50) DEFAULT NULL,
  `approver9` varchar(50) DEFAULT NULL,
  `approver10` varchar(50) DEFAULT NULL,
  `approvetime1` int(10) DEFAULT NULL,
  `approvetime2` int(10) DEFAULT NULL,
  `approvetime3` int(10) DEFAULT NULL,
  `approvetime4` int(10) DEFAULT NULL,
  `approvetime5` int(10) DEFAULT NULL,
  `approvetime6` int(10) DEFAULT NULL,
  `approvetime7` int(10) DEFAULT NULL,
  `approvetime8` int(10) DEFAULT NULL,
  `approvetime9` int(10) DEFAULT NULL,
  `approvetime10` int(10) DEFAULT NULL,
  `discomment1` varchar(255) DEFAULT NULL,
  `discomment2` varchar(255) DEFAULT NULL,
  `discomment3` varchar(255) DEFAULT NULL,
  `discomment4` varchar(255) DEFAULT NULL,
  `discomment5` varchar(255) DEFAULT NULL,
  `discomment6` varchar(255) DEFAULT NULL,
  `discomment7` varchar(255) DEFAULT NULL,
  `discomment8` varchar(255) DEFAULT NULL,
  `discomment9` varchar(255) DEFAULT NULL,
  `discomment10` varchar(255) DEFAULT NULL,
  `aprcomment1` varchar(255) DEFAULT NULL,
  `aprcomment2` varchar(255) DEFAULT NULL,
  `aprcomment3` varchar(255) DEFAULT NULL,
  `aprcomment4` varchar(255) DEFAULT NULL,
  `aprcomment5` varchar(255) DEFAULT NULL,
  `aprcomment6` varchar(255) DEFAULT NULL,
  `aprcomment7` varchar(255) DEFAULT NULL,
  `aprcomment8` varchar(255) DEFAULT NULL,
  `aprcomment9` varchar(255) DEFAULT NULL,
  `aprcomment10` varchar(255) DEFAULT NULL,
  `documentip` longtext,
  `latlng` varchar(100) DEFAULT NULL,
  `geneticresourcerc` varchar(10) DEFAULT NULL,
  `resourcesdeposit` varchar(10) DEFAULT NULL,
  `legalofficername` varchar(100) NOT NULL,
  `paid1` int(1) DEFAULT NULL,
  `paid2` int(1) DEFAULT NULL,
  `paid3` int(1) DEFAULT NULL,
  `paid4` int(1) DEFAULT NULL,
  `paid5` int(1) DEFAULT NULL,
  `paid6` int(1) DEFAULT NULL,
  `paid7` int(1) DEFAULT NULL,
  `paid8` int(1) DEFAULT NULL,
  `paid9` int(1) DEFAULT NULL,
  `paid10` int(1) DEFAULT NULL,
  `payref1` varchar(30) DEFAULT NULL,
  `payref2` varchar(30) DEFAULT NULL,
  `payref3` varchar(30) DEFAULT NULL,
  `payref4` varchar(30) DEFAULT NULL,
  `payref5` varchar(30) DEFAULT NULL,
  `payref6` varchar(30) DEFAULT NULL,
  `payref7` varchar(30) DEFAULT NULL,
  `payref8` varchar(30) DEFAULT NULL,
  `payref9` varchar(30) DEFAULT NULL,
  `payref10` varchar(30) DEFAULT NULL,
  `paytime1` int(10) DEFAULT NULL,
  `paytime2` int(10) DEFAULT NULL,
  `paytime3` int(10) DEFAULT NULL,
  `paytime4` int(10) DEFAULT NULL,
  `paytime5` int(10) DEFAULT NULL,
  `paytime6` int(10) DEFAULT NULL,
  `paytime7` int(10) DEFAULT NULL,
  `paytime8` int(10) DEFAULT NULL,
  `paytime9` int(10) DEFAULT NULL,
  `paytime10` int(10) DEFAULT NULL,
  `paymode1` varchar(20) DEFAULT NULL,
  `paymode2` varchar(20) DEFAULT NULL,
  `paymode3` varchar(20) DEFAULT NULL,
  `paymode4` varchar(20) DEFAULT NULL,
  `paymode5` varchar(20) DEFAULT NULL,
  `paymode6` varchar(20) DEFAULT NULL,
  `paymode7` varchar(20) DEFAULT NULL,
  `paymode8` varchar(20) DEFAULT NULL,
  `paymode9` varchar(20) DEFAULT NULL,
  `paymode10` varchar(20) DEFAULT NULL,
  `docpayment` longtext,
  `routed` int(10) DEFAULT NULL,
  `instcode` varchar(10) DEFAULT NULL,
  `orcid` varchar(50) DEFAULT NULL,
  `routed_time` int(10) DEFAULT NULL,
  `routed_comments` varchar(255) DEFAULT NULL,
  `resourcetypes` varchar(255) DEFAULT NULL,
  `export_port` varchar(100) DEFAULT NULL,
  `export_country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 
DROP TABLE IF EXISTS `applicationstmp`;
CREATE TABLE `applicationstmp` (
  `id` int(10) NOT NULL,
  `stepnumber` int(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `applyingas` varchar(50) DEFAULT NULL,
  `researcherid` varchar(30) DEFAULT NULL,
  `legalofficername` varchar(100) DEFAULT NULL,
  `legalofficeremail` varchar(100) DEFAULT NULL,
  `resourcetype` varchar(100) DEFAULT NULL,
  `speciesname` varchar(100) DEFAULT NULL,
  `scientificname` varchar(100) DEFAULT NULL,
  `commonname` varchar(100) DEFAULT NULL,
  `projectlocation` varchar(100) DEFAULT NULL,
  `projectarea` varchar(100) DEFAULT NULL,
  `resourceallocationpurpose` varchar(100) DEFAULT NULL,
  `exportanswer` varchar(10) DEFAULT NULL,
  `resourcetypeother` varchar(100) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `purposeother` varchar(255) DEFAULT NULL,
  `documentregistration` longtext,
  `documentresearchproposal` longtext,
  `documentaffiliation` longtext,
  `documentresearchbudget` longtext,
  `documentcv` longtext,
  `documentpic` longtext,
  `documentmat` longtext,
  `documentmta` longtext,
  `researchtype` varchar(10) DEFAULT NULL,
  `samplesamount` int(10) DEFAULT NULL,
  `conservestatus` varchar(10) DEFAULT NULL,
  `conservestatusdesc` varchar(100) DEFAULT NULL,
  `restraditionalknow` varchar(100) DEFAULT NULL,
  `exportgeneticresources` varchar(100) DEFAULT NULL,
  `legislationagree` varchar(5) DEFAULT NULL,
  `sampleuom` varchar(5) DEFAULT NULL,
  `documentip` longtext,
  `latlng` varchar(100) DEFAULT NULL,
  `geneticresourcerc` varchar(10) DEFAULT NULL,
  `resourcesdeposit` varchar(10) DEFAULT NULL,
  `paid1` int(1) DEFAULT NULL,
  `paid2` int(1) DEFAULT NULL,
  `paid3` int(1) DEFAULT NULL,
  `paid4` int(1) DEFAULT NULL,
  `paid5` int(1) DEFAULT NULL,
  `paid6` int(1) DEFAULT NULL,
  `paid7` int(1) DEFAULT NULL,
  `paid8` int(1) DEFAULT NULL,
  `paid9` int(1) DEFAULT NULL,
  `paid10` int(1) DEFAULT NULL,
  `payref1` varchar(30) DEFAULT NULL,
  `payref2` varchar(30) DEFAULT NULL,
  `payref3` varchar(30) DEFAULT NULL,
  `payref4` varchar(30) DEFAULT NULL,
  `payref5` varchar(30) DEFAULT NULL,
  `payref6` varchar(30) DEFAULT NULL,
  `payref7` varchar(30) DEFAULT NULL,
  `payref8` varchar(30) DEFAULT NULL,
  `payref9` varchar(30) DEFAULT NULL,
  `payref10` varchar(30) DEFAULT NULL,
  `paytime1` int(10) DEFAULT NULL,
  `paytime2` int(10) DEFAULT NULL,
  `paytime3` int(10) DEFAULT NULL,
  `paytime4` int(10) DEFAULT NULL,
  `paytime5` int(10) DEFAULT NULL,
  `paytime6` int(10) DEFAULT NULL,
  `paytime7` int(10) DEFAULT NULL,
  `paytime8` int(10) DEFAULT NULL,
  `paytime9` int(10) DEFAULT NULL,
  `paytime10` int(10) DEFAULT NULL,
  `paymode1` varchar(20) DEFAULT NULL,
  `paymode2` varchar(20) DEFAULT NULL,
  `paymode3` varchar(20) DEFAULT NULL,
  `paymode4` varchar(20) DEFAULT NULL,
  `paymode5` varchar(20) DEFAULT NULL,
  `paymode6` varchar(20) DEFAULT NULL,
  `paymode7` varchar(20) DEFAULT NULL,
  `paymode8` varchar(20) DEFAULT NULL,
  `paymode9` varchar(20) DEFAULT NULL,
  `paymode10` varchar(20) DEFAULT NULL,
  `docpayment` longtext,
  `orcid` varchar(50) DEFAULT NULL,
  `resourcetypes` varchar(255) DEFAULT NULL,
  `export_port` varchar(100) DEFAULT NULL,
  `export_country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 
DROP TABLE IF EXISTS `applyas`;
CREATE TABLE `applyas` (
  `id` int(2) NOT NULL,
  `ascode` varchar(10) NOT NULL,
  `asname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `applyas` (`id`, `ascode`, `asname`) VALUES
(1,	'IND',	'Individual'),
(2,	'AI',	'Academic Institution'),
(3,	'CRP',	'Company/Research Program');

DROP TABLE IF EXISTS `approvesteps`;
CREATE TABLE `approvesteps` (
  `id` int(11) NOT NULL,
  `stepno` int(11) NOT NULL,
  `stepname` varchar(100) NOT NULL,
  `stepdesc` varchar(100) NOT NULL,
  `instcode` varchar(10) DEFAULT NULL,
  `emtplaplapr` int(2) DEFAULT NULL,
  `emtplapldsp` int(2) DEFAULT NULL,
  `emtplinsapr` int(2) DEFAULT NULL,
  `emtplinsdsp` int(2) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `approvesteps_ibfk_1` FOREIGN KEY (`id`) REFERENCES `sysicons` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `approvesteps` (`id`, `stepno`, `stepname`, `stepdesc`, `instcode`, `emtplaplapr`, `emtplapldsp`, `emtplinsapr`, `emtplinsdsp`) VALUES
(3,	2,	'Forestry Unit',	'Forest Unit',	'FU',	5,	5,	4,	4),
(4,	1,	'BEST',	'Research Permit',	'BEST',	5,	5,	4,	4),
(8,	3,	'PORT DEPARTMENT',	'PORT DEPARTMENT',	'PD',	5,	5,	4,	4),
(10,	5,	'Dept. of Marine Resources (DMR)',	'Dept. of Marine Resources (DMR)',	'DMR',	5,	5,	4,	4),
(11,	6,	'Department of Agriculture (DoA)',	'Department of Agriculture (DoA)',	'DOA',	5,	5,	4,	4),
(12,	7,	'Bahamas National Trust',	'Bahamas National Trust',	'BNT',	5,	5,	4,	4),
(13,	8,	'Antiquities, Monuments and Museums Corporation',	'Antiquities, Monuments and Museums Corporation',	'AMMC',	5,	5,	4,	4);

DROP TABLE IF EXISTS `appsetup`;
CREATE TABLE `appsetup` (
  `id` varchar(10) NOT NULL,
  `emtpllc` int(2) DEFAULT NULL,
  `emtplfr` int(2) DEFAULT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` int(10) DEFAULT NULL,
  `emtplap` int(2) DEFAULT NULL,
  `emtplwanl` int(2) DEFAULT NULL,
  `emtplwanr` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `appsetup` (`id`, `emtpllc`, `emtplfr`, `audituser`, `auditdate`, `audittime`, `auditip`, `emtplap`, `emtplwanl`, `emtplwanr`) VALUES
('1',	8,	8,	'2',	'2019-07-23',	1563850427,	1270,	1,	5,	4);

DROP TABLE IF EXISTS `bankaccounts`;
CREATE TABLE `bankaccounts` (
  `id` int(4) NOT NULL,
  `currcode` varchar(5) NOT NULL,
  `instcode` varchar(10) NOT NULL,
  `branchcode` varchar(10) NOT NULL,
  `accountno` varchar(10) NOT NULL,
  `accountname` varchar(50) NOT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`branchcode`,`accountno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
DROP TABLE IF EXISTS `bankbranch`;
CREATE TABLE `bankbranch` (
  `id` int(4) NOT NULL,
  `branchcode` varchar(10) NOT NULL,
  `branchname` varchar(50) NOT NULL,
  `bankcode` varchar(10) NOT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`branchcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
DROP TABLE IF EXISTS `counties`;
CREATE TABLE `counties` (
  `id` int(11) NOT NULL,
  `county` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_pk` (`id`),
  FULLTEXT KEY `idx_search` (`county`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(2) NOT NULL,
  `ctncode` varchar(10) NOT NULL,
  `ctnname` varchar(50) NOT NULL,
  `natcode` varchar(10) DEFAULT NULL,
  `ntnname` varchar(50) DEFAULT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` int(10) DEFAULT NULL,
  PRIMARY KEY (`ctncode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `countries` (`id`, `ctncode`, `ctnname`, `natcode`, `ntnname`, `audituser`, `auditdate`, `audittime`, `auditip`) VALUES
(1,	'AD',	'Andorra',	'AD',	'Andorran',	NULL,	NULL,	0,	0),
(2,	'AE',	'United Arab Emirates',	'AE',	'Emirian',	'2',	'2018-08-08',	1533711962,	1270),
(3,	'AF',	'Afghanistan',	'AF',	'Afghani',	NULL,	NULL,	0,	0),
(4,	'AG',	'Antigua and Barbuda',	'AG',	'Antiguan',	NULL,	NULL,	0,	0),
(5,	'AI',	'Anguilla',	'AI',	'Anguillan',	NULL,	NULL,	0,	0),
(6,	'AL',	'Albania',	'AL',	'Albanian',	NULL,	NULL,	0,	0),
(7,	'AM',	'Armenia',	'AM',	'Armenian',	NULL,	NULL,	0,	0),
(8,	'AO',	'Angola',	'AO',	'Angolan',	'2',	'2019-07-09',	1562677279,	41139),
(9,	'AQ',	'Antarctica',	'AQ',	'Antarctic',	NULL,	NULL,	0,	0),
(10,	'AR',	'Argentina',	'AR',	'Argentine',	NULL,	NULL,	0,	0),
(11,	'AS',	'American Samoa',	'AS',	'Samoan',	NULL,	NULL,	0,	0),
(12,	'AT',	'Austria',	'AT',	'Austrian',	NULL,	NULL,	0,	0),
(13,	'AU',	'Australia',	'AU',	'Australian',	NULL,	NULL,	0,	0),
(14,	'AW',	'Aruba',	'AW',	'Arubian',	NULL,	NULL,	0,	0),
(15,	'AX',	'land Islands',	'AX',	'landic',	NULL,	NULL,	0,	0),
(16,	'AZ',	'Azerbaijan',	'AZ',	'Azerbaijani',	NULL,	NULL,	0,	0),
(17,	'BA',	'Bosnia and Herzegovina',	'BA',	'Bosnian',	NULL,	NULL,	0,	0),
(18,	'BB',	'Barbados',	'BB',	'Barbadian',	NULL,	NULL,	0,	0),
(19,	'BD',	'Bangladesh',	'BD',	'Bangladeshi',	NULL,	NULL,	0,	0),
(20,	'BE',	'Belgium',	'BE',	'Belgian',	NULL,	NULL,	0,	0),
(21,	'BF',	'Burkina Faso',	'BF',	'Burkinabe',	'2',	'2019-07-09',	1562677261,	41139),
(22,	'BG',	'Bulgaria',	'BG',	'Bulgarian',	NULL,	NULL,	0,	0),
(23,	'BH',	'Bahrain',	'BH',	'Bahrainian',	NULL,	NULL,	0,	0),
(24,	'BI',	'Burundi',	'BI',	'Burundian',	'2',	'2019-07-09',	1562677253,	41139),
(25,	'BJ',	'Benin',	'BJ',	'Beninese',	'2',	'2019-07-09',	1562677248,	41139),
(26,	'BL',	'Saint Barth`lemy',	'BL',	'Barth`lemois',	NULL,	NULL,	0,	0),
(27,	'BM',	'Bermuda',	'BM',	'Bermudan',	NULL,	NULL,	0,	0),
(28,	'BN',	'Brunei',	'BN',	'Bruneian',	NULL,	NULL,	0,	0),
(29,	'BO',	'Bolivia',	'BO',	'Bolivian',	NULL,	NULL,	0,	0),
(30,	'BQ',	'Caribbean Netherlands',	'BQ',	NULL,	NULL,	NULL,	0,	0),
(31,	'BR',	'Brazil',	'BR',	'Brazilian',	NULL,	NULL,	0,	0),
(32,	'BS',	'Bahamas',	'BS',	'Bahameese',	NULL,	NULL,	0,	0),
(33,	'BT',	'Bhutan',	'BT',	'Bhutanese',	NULL,	NULL,	0,	0),
(34,	'BV',	'Bouvet Island',	'BV',	'Bouvet',	NULL,	NULL,	0,	0),
(35,	'BW',	'Botswana',	'BW',	'Motswana',	'2',	'2019-07-09',	1562677235,	41139),
(36,	'BY',	'Belarus',	'BY',	'Belarusian',	NULL,	NULL,	0,	0),
(37,	'BZ',	'Belize',	'BZ',	'Belizean',	NULL,	NULL,	0,	0),
(38,	'CA',	'Canada',	'CA',	'Canadian',	NULL,	NULL,	0,	0),
(39,	'CC',	'Cocos (Keeling) Islands',	'CC',	'Cocossian',	NULL,	NULL,	0,	0),
(40,	'CD',	'Democratic Republic of the Congo',	'CD',	'Congolese',	'2',	'2019-07-09',	1562677228,	41139),
(41,	'CF',	'Central African Republic',	'CF',	'Central African',	'2',	'2019-07-09',	1562677223,	41139),
(42,	'CG',	'Congo (Republic of)',	'CG',	'Congolese',	'2',	'2019-07-09',	1562677215,	41139),
(43,	'CH',	'Switzerland',	'CH',	'Swiss',	NULL,	NULL,	0,	0),
(45,	'CK',	'Cook Islands',	'CK',	'Cook Islander',	NULL,	NULL,	0,	0),
(46,	'CL',	'Chile',	'CL',	'Chilean',	NULL,	NULL,	0,	0),
(47,	'CM',	'Cameroon',	'CM',	'Cameroonian',	'2',	'2019-07-09',	1562677209,	41139),
(48,	'CN',	'China',	'CN',	'Chinese',	NULL,	NULL,	0,	0),
(49,	'CO',	'Colombia',	'CO',	'Colombian',	NULL,	NULL,	0,	0),
(50,	'CR',	'Costa Rica',	'CR',	'Costa Rican',	NULL,	NULL,	0,	0),
(51,	'CU',	'Cuba',	'CU',	'Cuban',	NULL,	NULL,	0,	0),
(52,	'CV',	'Cape Verde',	'CV',	'Cape Verdean',	'2',	'2019-07-09',	1562677199,	41139),
(53,	'CW',	'Cura`ao',	'CW',	'Cura`aoan',	NULL,	NULL,	0,	0),
(54,	'CX',	'Christmas Island',	'CX',	'Christmas Islander',	NULL,	NULL,	0,	0),
(55,	'CY',	'Cyprus',	'CY',	'Cypriot',	NULL,	NULL,	0,	0),
(56,	'CZ',	'Czech Republic',	'CZ',	'Czech',	NULL,	NULL,	0,	0),
(57,	'DE',	'Germany',	'DE',	'German',	NULL,	NULL,	0,	0),
(58,	'DJ',	'Djibouti',	'DJ',	'Djiboutian',	'2',	'2019-07-09',	1562677191,	41139),
(59,	'DK',	'Denmark',	'DK',	'Danish',	NULL,	NULL,	0,	0),
(60,	'DM',	'Dominica',	'DM',	'Dominican',	NULL,	NULL,	0,	0),
(61,	'DO',	'Dominican Republic',	'DO',	'Dominican',	NULL,	NULL,	0,	0),
(62,	'DZ',	'Algeria',	'DZ',	'Algerian',	'2',	'2019-07-09',	1562677173,	41139),
(63,	'EC',	'Ecuador',	'EC',	'Ecuadorean',	NULL,	NULL,	0,	0),
(64,	'EE',	'Estonia',	'EE',	'Estonian',	NULL,	NULL,	0,	0),
(65,	'EG',	'Egypt',	'EG',	'Egyptian',	'2',	'2019-07-09',	1562677169,	41139),
(66,	'EH',	'Western Saharan',	'EH',	'Western Saharan',	NULL,	'2019-07-10',	1562760403,	41191),
(67,	'ER',	'Eritrea',	'ER',	'Eritrean',	'2',	'2019-07-09',	1562677178,	41139),
(68,	'ES',	'Spain',	'ES',	'Spanish',	NULL,	NULL,	0,	0),
(69,	'ET',	'Ethiopia',	'ET',	'Ethiopian',	'2',	'2018-08-08',	1533711870,	1270),
(70,	'FI',	'Finland',	'FI',	'Finnish',	NULL,	NULL,	0,	0),
(71,	'FJ',	'Fiji',	'FJ',	'Fijian',	NULL,	NULL,	0,	0),
(72,	'FK',	'Falkland Islands',	'FK',	'Falkland Islander',	NULL,	NULL,	0,	0),
(73,	'FM',	'Micronesia',	'FM',	'Micronesian',	NULL,	NULL,	0,	0),
(74,	'FO',	'Faroe Islands',	'FO',	'Faroese',	NULL,	NULL,	0,	0),
(75,	'FR',	'France',	'FR',	'French',	NULL,	NULL,	0,	0),
(76,	'GA',	'Gabon',	'GA',	'Gabonese',	'2',	'2019-07-09',	1562677158,	41139),
(77,	'GB',	'United Kingdom',	'GB',	'British',	NULL,	NULL,	0,	0),
(78,	'GD',	'Grenada',	'GD',	'Grenadian',	NULL,	NULL,	0,	0),
(79,	'GE',	'Georgia',	'GE',	'Georgian',	NULL,	NULL,	0,	0),
(80,	'GF',	'French Guiana',	'GF',	'French Guianese',	NULL,	NULL,	0,	0),
(81,	'GG',	'Guernsey',	'GG',	NULL,	NULL,	NULL,	0,	0),
(82,	'GH',	'Ghana',	'GH',	'Ghanaian',	'2',	'2019-07-09',	1562677150,	41139),
(83,	'GI',	'Gibralter',	'GI',	'Gibralterian',	NULL,	NULL,	0,	0),
(84,	'GL',	'Greenland',	'GL',	'Greenlander',	NULL,	NULL,	0,	0),
(85,	'GM',	'Gambia',	'GM',	'Gambian',	'2',	'2019-07-09',	1562677142,	41139),
(86,	'GN',	'Guinea',	'GN',	'Guinean',	'2',	'2019-07-09',	1562677137,	41139),
(87,	'GP',	'Guadeloupe',	'GP',	'Guadeloupean',	NULL,	NULL,	0,	0),
(88,	'GQ',	'Equatorial Guinea',	'GQ',	'Equatorial Guinean',	'2',	'2019-07-09',	1562677103,	41139),
(89,	'GR',	'Greece',	'GR',	'Greek',	NULL,	NULL,	0,	0),
(90,	'GS',	'South Georgia and the South Sandwich Islands',	'GS',	NULL,	NULL,	NULL,	0,	0),
(91,	'GT',	'Guatemala',	'GT',	'Guatemalan',	NULL,	NULL,	0,	0),
(92,	'GU',	'Guam',	'GU',	'Guamanian',	NULL,	NULL,	0,	0),
(93,	'GW',	'Guinea-Bissau',	'GW',	'Guinean',	NULL,	'2019-07-10',	1562760415,	41191),
(94,	'GY',	'Guyana',	'GY',	'Guyanese',	NULL,	NULL,	0,	0),
(95,	'HK',	'Hong Kong',	'HK',	'Hong Konger',	NULL,	NULL,	0,	0),
(96,	'HM',	'Heard and McDonald Islands',	'HM',	NULL,	NULL,	NULL,	0,	0),
(97,	'HN',	'Honduras',	'HN',	'Honduran',	NULL,	NULL,	0,	0),
(98,	'HR',	'Croatia',	'HR',	'Croatian',	NULL,	NULL,	0,	0),
(99,	'HT',	'Haiti',	'HT',	'Haitian',	NULL,	NULL,	0,	0),
(100,	'HU',	'Hungary',	'HU',	'Hungarian',	NULL,	NULL,	0,	0),
(101,	'ID',	'Indonesia',	'ID',	'Indonesian',	NULL,	NULL,	0,	0),
(102,	'IE',	'Ireland',	'IE',	'Irish',	NULL,	NULL,	0,	0),
(103,	'IL',	'Israel',	'IL',	'Israeli',	NULL,	NULL,	0,	0),
(104,	'IM',	'Isle of Man',	'IM',	'Manx',	NULL,	NULL,	0,	0),
(105,	'IN',	'India',	'IN',	'Indian',	'2',	'2019-01-21',	1548059245,	1270),
(106,	'IO',	'British Indian Ocean Territory',	'IO',	NULL,	NULL,	NULL,	0,	0),
(107,	'IQ',	'Iraq',	'IQ',	'Iraqi',	NULL,	NULL,	0,	0),
(108,	'IR',	'Iran',	'IR',	'Iranian',	NULL,	NULL,	0,	0),
(109,	'IS',	'Iceland',	'IS',	'Icelander',	NULL,	NULL,	0,	0),
(110,	'IT',	'Italy',	'IT',	'Italian',	NULL,	NULL,	0,	0),
(111,	'JE',	'Jersey',	'JE',	NULL,	NULL,	NULL,	0,	0),
(112,	'JM',	'Jamaica',	'JM',	'Jamaican',	NULL,	NULL,	0,	0),
(113,	'JO',	'Jordan',	'JO',	'Jordanian',	NULL,	NULL,	0,	0),
(114,	'JP',	'Japan',	'JP',	'Japanese',	NULL,	NULL,	0,	0),
(115,	'KE',	'Kenya',	'KE',	'Kenyan',	'2',	'2019-01-21',	1548059212,	1270),
(116,	'KG',	'Kyrgyzstan',	'KG',	'Kyrgyzstani',	NULL,	NULL,	0,	0),
(117,	'KH',	'Cambodia',	'KH',	'Cambodian',	NULL,	NULL,	0,	0),
(118,	'KI',	'Kiribati',	'KI',	'I-Kiribati',	NULL,	NULL,	0,	0),
(119,	'KM',	'Comoros',	'KM',	'Comoran',	'2',	'2019-07-09',	1562677088,	41139),
(120,	'KN',	'Saint Kitts and Nevis',	'KN',	'Kittian',	NULL,	NULL,	0,	0),
(121,	'KP',	'North Korea',	'KP',	'North Korean',	NULL,	NULL,	0,	0),
(122,	'KR',	'South Korea',	'KR',	'South Korean',	NULL,	NULL,	0,	0),
(123,	'KW',	'Kuwait',	'KW',	'Kuwaiti',	NULL,	NULL,	0,	0),
(124,	'KY',	'Cayman Islands',	'KY',	'Caymanian',	NULL,	NULL,	0,	0),
(125,	'KZ',	'Kazakhstan',	'KZ',	'Kazakhstani',	NULL,	NULL,	0,	0),
(126,	'LA',	'Laos',	'LA',	'Laotian',	NULL,	NULL,	0,	0),
(127,	'LB',	'Lebanon',	'LB',	'Lebanese',	NULL,	NULL,	0,	0),
(128,	'LC',	'Saint Lucia',	'LC',	'Saint Lucian',	NULL,	NULL,	0,	0),
(129,	'LI',	'Liechtenstein',	'LI',	'Liechtensteiner',	NULL,	NULL,	0,	0),
(130,	'LK',	'Sri Lanka',	'LK',	'Sri Lankan',	NULL,	NULL,	0,	0),
(131,	'LR',	'Liberia',	'LR',	'Liberian',	'2',	'2019-07-09',	1562676934,	41139),
(132,	'LS',	'Lesotho',	'LS',	'Mosotho',	NULL,	'2019-07-10',	1562760432,	41191),
(133,	'LT',	'Lithuania',	'LT',	'Lithunian',	NULL,	NULL,	0,	0),
(134,	'LU',	'Luxembourg',	'LU',	'Luxembourger',	NULL,	NULL,	0,	0),
(135,	'LV',	'Latvia',	'LV',	'Latvian',	NULL,	NULL,	0,	0),
(136,	'LY',	'Libya',	'LY',	'Libyan',	'2',	'2019-07-09',	1562676901,	41139),
(137,	'MA',	'Morocco',	'MA',	'Moroccan',	'2',	'2019-07-09',	1562676891,	41139),
(138,	'MC',	'Monaco',	'MC',	'Monacan',	NULL,	NULL,	0,	0),
(139,	'MD',	'Moldova',	'MD',	'Moldovan',	NULL,	NULL,	0,	0),
(140,	'ME',	'Montenegro',	'ME',	'Montenegrin',	NULL,	NULL,	0,	0),
(141,	'MF',	'Saint Martin (France)',	'MF',	NULL,	NULL,	NULL,	0,	0),
(142,	'MG',	'Madagascar',	'MG',	'Malagasy',	NULL,	'2019-07-10',	1562760446,	41191),
(143,	'MH',	'Marshall Islands',	'MH',	'Marshallese',	NULL,	NULL,	0,	0),
(144,	'MK',	'Macedonia',	'MK',	'Macedonian',	NULL,	NULL,	0,	0),
(145,	'ML',	'Mali',	'ML',	'Malian',	'2',	'2019-07-09',	1562676879,	41139),
(146,	'MM',	'Burma (Republic of the Union of Myanmar)',	'MM',	'Myanmarese',	NULL,	NULL,	0,	0),
(147,	'MN',	'Mongolia',	'MN',	'Mongolian',	NULL,	NULL,	0,	0),
(148,	'MO',	'Macau',	'MO',	'Macanese',	NULL,	NULL,	0,	0),
(149,	'MP',	'Northern Mariana Islands',	'MP',	'Northern Mariana Islander',	NULL,	NULL,	0,	0),
(150,	'MQ',	'Martinique',	'MQ',	'Martinican',	NULL,	NULL,	0,	0),
(151,	'MR',	'Mauritania',	'MR',	'Mauritanian',	NULL,	'2019-07-10',	1562760457,	41191),
(152,	'MS',	'Montserrat',	'MS',	'Montserratian',	NULL,	NULL,	0,	0),
(153,	'MT',	'Malta',	'MT',	'Maltese',	NULL,	NULL,	0,	0),
(154,	'MU',	'Mauritius',	'MU',	'Mauritian',	'2',	'2019-07-09',	1562676832,	41139),
(155,	'MV',	'Maldives',	'MV',	'Maldivan',	NULL,	NULL,	0,	0),
(156,	'MW',	'Malawi',	'MW',	'Malawian',	'2',	'2019-07-09',	1562676823,	41139),
(157,	'MX',	'Mexico',	'MX',	'Mexican',	NULL,	NULL,	0,	0),
(158,	'MY',	'Malaysia',	'MY',	'Malaysian',	NULL,	NULL,	0,	0),
(159,	'MZ',	'Mozambique',	'MZ',	'Mozambican',	'2',	'2019-07-09',	1562676816,	41139),
(160,	'NA',	'Namibia',	'NA',	'Namibian',	'2',	'2019-07-09',	1562676865,	41139),
(161,	'NC',	'New Caledonia',	'NC',	'New Caledonian',	NULL,	NULL,	0,	0),
(162,	'NE',	'Niger',	'NE',	'Nigerien',	'2',	'2019-07-09',	1562677336,	41139),
(163,	'NF',	'Norfolk Island',	'NF',	'Norfolk Islander',	NULL,	NULL,	0,	0),
(164,	'NG',	'Nigeria',	'NG',	'Nigerian',	'2',	'2019-07-09',	1562677330,	41139),
(165,	'NI',	'Nicaragua',	'NI',	'Nicaraguan',	NULL,	NULL,	0,	0),
(166,	'NL',	'Netherlands',	'NL',	'Dutch',	NULL,	NULL,	0,	0),
(167,	'NO',	'Norway',	'NO',	'Norwegian',	NULL,	NULL,	0,	0),
(168,	'NP',	'Nepal',	'NP',	'Nepalese',	NULL,	NULL,	0,	0),
(169,	'NR',	'Nauru',	'NR',	'Nauruan',	NULL,	NULL,	0,	0),
(170,	'NU',	'Niue',	'NU',	'Niuean',	NULL,	NULL,	0,	0),
(171,	'NZ',	'New Zealand',	'NZ',	'New Zealander',	NULL,	NULL,	0,	0),
(172,	'OM',	'Oman',	'OM',	'Omani',	NULL,	NULL,	0,	0),
(173,	'PA',	'Panama',	'PA',	'Panamanian',	NULL,	NULL,	0,	0),
(174,	'PE',	'Peru',	'PE',	'Peruvian',	NULL,	NULL,	0,	0),
(175,	'PF',	'French Polynesia',	'PF',	'French Polynesian',	NULL,	NULL,	0,	0),
(176,	'PG',	'Papua New Guinea',	'PG',	'Papua New Guinean',	'2',	'2019-07-09',	1562677320,	41139),
(177,	'PH',	'Philippines',	'PH',	'Filipino',	NULL,	NULL,	0,	0),
(178,	'PK',	'Pakistan',	'PK',	'Pakistani',	NULL,	NULL,	0,	0),
(179,	'PL',	'Poland',	'PL',	'Polish',	NULL,	NULL,	0,	0),
(180,	'PM',	'St. Pierre and Miquelon',	'PM',	'Saint-Pierrais',	NULL,	NULL,	0,	0),
(181,	'PN',	'Pitcairn',	'PN',	'Pitcairn Islander',	NULL,	NULL,	0,	0),
(182,	'PR',	'Puerto Rico',	'PR',	'Puerto Rican',	NULL,	NULL,	0,	0),
(183,	'PS',	'Palestine',	'PS',	'Palestinian',	NULL,	NULL,	0,	0),
(184,	'PT',	'Portugal',	'PT',	'Portuguese',	NULL,	NULL,	0,	0),
(185,	'PW',	'Palau',	'PW',	'Palauan',	NULL,	NULL,	0,	0),
(186,	'PY',	'Paraguay',	'PY',	'Paraguayan',	NULL,	NULL,	0,	0),
(187,	'QA',	'Qatar',	'QA',	'Qatari',	'2',	'2018-08-08',	1533711927,	1270),
(188,	'RE',	'R union',	'RE',	NULL,	'2',	'2019-07-09',	1562677309,	41139),
(189,	'RO',	'Romania',	'RO',	'Romanian',	NULL,	NULL,	0,	0),
(190,	'RS',	'Serbia',	'RS',	'Serbian',	NULL,	NULL,	0,	0),
(191,	'RU',	'Russian Federation',	'RU',	'Russian',	NULL,	NULL,	0,	0),
(192,	'RW',	'Rwanda',	'RW',	'Rwandan',	'2',	'2019-07-09',	1562676844,	41139),
(193,	'SA',	'Saudi Arabia',	'SA',	'Saudi Arabian',	NULL,	NULL,	0,	0),
(194,	'SB',	'Solomon Islands',	'SB',	'Solomon Islander',	NULL,	NULL,	0,	0),
(195,	'SC',	'Seychelles',	'SC',	'Seychellois',	'2',	'2019-07-09',	1562677302,	41139),
(196,	'SD',	'Sudan',	'SD',	'Sudanese',	'2',	'2019-07-09',	1562677294,	41139),
(197,	'SE',	'Sweden',	'SE',	'Swedish',	NULL,	NULL,	0,	0),
(198,	'SG',	'Singapore',	'SG',	'Singaporean',	'2',	'2019-07-10',	1562741851,	41191),
(199,	'SH',	'Saint Helena',	'SH',	'Saint Helenian',	'2',	'2019-07-10',	1562741845,	41191),
(200,	'SI',	'Slovenia',	'SI',	'Slovenian',	'2',	'2018-08-08',	1533711795,	1270),
(204,	'SO',	'Somalia',	NULL,	NULL,	'2',	'2019-07-10',	1562787967,	154156),
(202,	'TZ',	'Tanzania',	NULL,	NULL,	'2',	'2019-07-09',	1562681763,	41139),
(203,	'UG',	'Uganda',	NULL,	NULL,	'2',	'2019-07-09',	1562681794,	41139),
(201,	'US',	'United States of America',	'US',	NULL,	NULL,	'2019-01-18',	1547825327,	1270);

DROP TABLE IF EXISTS `countryregions`;
CREATE TABLE `countryregions` (
  `id` int(2) NOT NULL,
  `regioncode` varchar(10) NOT NULL,
  `regionname` varchar(50) NOT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` int(10) DEFAULT NULL,
  PRIMARY KEY (`regioncode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `countryregions` (`id`, `regioncode`, `regionname`, `audituser`, `auditdate`, `audittime`, `auditip`) VALUES
(1,	'001',	'Africa',	'2',	'2018-08-08',	1533711639,	1270),
(2,	'002',	'Oceania',	'2',	'2018-08-08',	1533711644,	1270),
(3,	'003',	'Americas',	'2',	'2018-08-08',	1533711650,	1270),
(4,	'004',	'Asia',	'2',	'2018-08-08',	1533711656,	1270),
(5,	'005',	'Europe',	'2',	'2018-08-08',	1533711661,	1270),
(7,	'006',	'Local',	'2',	'2018-08-08',	1533711828,	1270),
(6,	'999',	'Other',	'2',	'2018-08-08',	1533711673,	1270);

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies` (
  `id` varchar(10) NOT NULL,
  `currcode` varchar(5) NOT NULL,
  `currname` varchar(50) NOT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` varchar(15) DEFAULT NULL,
  `isdefault` int(1) DEFAULT NULL,
  PRIMARY KEY (`currcode`),
  UNIQUE KEY `idx_pk` (`currcode`),
  FULLTEXT KEY `idx_search` (`currcode`,`currname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `currencies` (`id`, `currcode`, `currname`, `audituser`, `auditdate`, `audittime`, `auditip`, `isdefault`) VALUES
('145',	'AED',	'Dirham',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('9',	'AFN',	'Afghani',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('10',	'ALL',	'Lek',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('14',	'AMD',	'Dram',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('15',	'ANG',	'Netherlands Antilles Guilder',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('154',	'AOA',	'Angolan kwanza',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('155',	'AQD',	'Antarctican dollar',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('13',	'ARS',	'Peso',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('2',	'AUD',	'Australian Dollars',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('16',	'AZN',	'Manat',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('156',	'BAM',	'Bosnia and Herzegovina convertible mark',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('20',	'BBD',	'Barbadian Dollar',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('19',	'BDT',	'Taka',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('31',	'BGN',	'Lev',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('18',	'BHD',	'Bahraini Dinar',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('32',	'BIF',	'Burundi Franc',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('24',	'BMD',	'Bermudian Dollar',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('30',	'BND',	'Bruneian Dollar',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('26',	'BOB',	'Boliviano',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('29',	'BRL',	'Brazil',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('17',	'BSD',	'Bahamian Dollar',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('27',	'BWP',	'Pula',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('21',	'BYR',	'Belarus Ruble',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('22',	'BZD',	'Belizean Dollar',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('7',	'CAD',	'Canadian Dollar',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('41',	'CDF',	'Congolese Frank',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('86',	'CHF',	'Swiss Franc',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('37',	'CLP',	'Chilean Peso',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('38',	'CNY',	'Yuan Renminbi',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('39',	'COP',	'Peso',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('42',	'CRC',	'Costa Rican Colon',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('44',	'CUP',	'Cuban Peso',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('35',	'CVE',	'Escudo',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('45',	'CYP',	'Cypriot Pound',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('46',	'CZK',	'Koruna',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('48',	'DJF',	'Djiboutian Franc',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('47',	'DKK',	'Danish Krone',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('49',	'DOP',	'Dominican Peso',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('11',	'DZD',	'Algerian Dinar',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('51',	'ECS',	'Sucre',	'admin',	'2018-08-08',	1533712557,	'127.0.0.1',	NULL),
('55',	'EEK',	'Estonian Kroon',	'admin',	'2018-08-08',	1533712557,	'127.0.0.1',	NULL),
('52',	'EGP',	'Egyptian Pound',	'admin',	'2018-08-08',	1533712557,	'127.0.0.1',	NULL),
('54',	'ETB',	'Ethiopian Birr',	'admin',	'2018-08-08',	1533712557,	'127.0.0.1',	NULL),
('3',	'EUR',	'Euros',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('57',	'FJD',	'Fijian Dollar',	'admin',	'2018-08-08',	1533712557,	'127.0.0.1',	NULL),
('56',	'FKP',	'Falkland Pound',	'admin',	'2018-08-08',	1533712557,	'127.0.0.1',	NULL),
('4',	'GBP',	'Sterling',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('60',	'GEL',	'Lari',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('158',	'GGP',	'Guernsey pound',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('157',	'GHS',	'Ghana cedi',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('61',	'GIP',	'Gibraltar Pound',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('59',	'GMD',	'Dalasi',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('63',	'GNF',	'Guinean Franc',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('62',	'GTQ',	'Quetzal',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('64',	'GYD',	'Guyanaese Dollar',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('6',	'HKD',	'HKD',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('66',	'HNL',	'Lempira',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('43',	'HRK',	'Croatian Dinar',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('65',	'HTG',	'Gourde',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('67',	'HUF',	'Forint',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('50',	'IDR',	'Indonesian Rupiah',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('71',	'ILS',	'Shekel',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('25',	'INR',	'Indian Rupee',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('70',	'IQD',	'Iraqi Dinar',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('69',	'IRR',	'Iranian Rial',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('68',	'ISK',	'Icelandic Krona',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('72',	'JMD',	'Jamaican Dollar',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('73',	'JOD',	'Jordanian Dinar',	'admin',	'2018-08-08',	1533712558,	'127.0.0.1',	NULL),
('8',	'JPY',	'Japanese Yen',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('75',	'KES',	'Kenyan Shilling',	'2',	'2019-07-22',	1563816322,	'127.0.0.1',	1),
('79',	'KGS',	'Som',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('33',	'KHR',	'Riel',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('40',	'KMF',	'Comoran Franc',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('76',	'KPW',	'Won',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('77',	'KRW',	'Won',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('78',	'KWD',	'Kuwaiti Dinar',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('36',	'KYD',	'Caymanian Dollar',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('74',	'KZT',	'Tenge',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('80',	'LAK',	'Kip',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('82',	'LBP',	'Lebanese Pound',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('128',	'LKR',	'Rupee',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('84',	'LRD',	'Liberian Dollar',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('83',	'LSL',	'Loti',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('87',	'LTL',	'Lita',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('81',	'LVL',	'Lat',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('85',	'LYD',	'Libyan Dinar',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('100',	'MAD',	'Dirham',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('98',	'MDL',	'Leu',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('90',	'MGA',	'Malagasy Franc',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('89',	'MKD',	'Denar',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('102',	'MMK',	'Kyat',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('99',	'MNT',	'Tugrik',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('88',	'MOP',	'Pataca',	'admin',	'2018-08-08',	1533712559,	'127.0.0.1',	NULL),
('95',	'MRO',	'Ouguiya',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('94',	'MTL',	'Maltese Lira',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('96',	'MUR',	'Mauritian Rupee',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('93',	'MVR',	'Rufiyaa',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('91',	'MWK',	'Malawian Kwacha',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('97',	'MXN',	'Peso',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('92',	'MYR',	'Ringgit',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('101',	'MZN',	'Metical',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('103',	'NAD',	'Dollar',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('106',	'NGN',	'Naira',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('105',	'NIO',	'Cordoba Oro',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('28',	'NOK',	'Norwegian Krone',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('104',	'NPR',	'Nepalese Rupee',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('1',	'NZD',	'New Zealand Dollars',	'admin',	'2018-08-08',	1533712547,	'127.0.0.1',	NULL),
('107',	'OMR',	'Sul Rial',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('109',	'PAB',	'Balboa',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('112',	'PEN',	'Nuevo Sol',	'admin',	'2018-08-08',	1533712561,	'127.0.0.1',	NULL),
('110',	'PGK',	'Kina',	'admin',	'2018-08-08',	1533712561,	'127.0.0.1',	NULL),
('113',	'PHP',	'Peso',	'admin',	'2018-08-08',	1533712561,	'127.0.0.1',	NULL),
('108',	'PKR',	'Rupee',	'admin',	'2018-08-08',	1533712560,	'127.0.0.1',	NULL),
('114',	'PLN',	'Zloty',	'admin',	'2018-08-08',	1533712561,	'127.0.0.1',	NULL),
('111',	'PYG',	'Guarani',	'admin',	'2018-08-08',	1533712561,	'127.0.0.1',	NULL),
('115',	'QAR',	'Rial',	'admin',	'2018-08-08',	1533712561,	'127.0.0.1',	NULL),
('116',	'RON',	'Leu',	'admin',	'2018-08-08',	1533712561,	'127.0.0.1',	NULL),
('159',	'RSD',	'Serbian dinar',	'admin',	'2018-08-08',	1533712564,	'127.0.0.1',	NULL),
('117',	'RUB',	'Ruble',	'admin',	'2018-08-08',	1533712561,	'127.0.0.1',	NULL),
('118',	'RWF',	'Rwanda Franc',	'admin',	'2018-08-08',	1533712561,	'127.0.0.1',	NULL),
('120',	'SAR',	'Riyal',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('125',	'SBD',	'Solomon Islands Dollar',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('121',	'SCR',	'Rupee',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('129',	'SDG',	'Dinar',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('132',	'SEK',	'Krona',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('123',	'SGD',	'Dollar',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('124',	'SKK',	'Koruna',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('122',	'SLL',	'Leone',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('126',	'SOS',	'Shilling',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('130',	'SRD',	'Surinamese Guilder',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('119',	'STD',	'Dobra',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('53',	'SVC',	'Salvadoran Colon',	'admin',	'2018-08-08',	1533712557,	'127.0.0.1',	NULL),
('133',	'SYP',	'Syrian Pound',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('131',	'SZL',	'Lilangeni',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('137',	'THB',	'Baht',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('135',	'TJS',	'Tajikistan Ruble',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('142',	'TMT',	'Manat',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('140',	'TND',	'Tunisian Dinar',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('138',	'TOP',	'PaÕanga',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('141',	'TRY',	'Lira',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('139',	'TTD',	'Trinidad and Tobago Dollar',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('134',	'TWD',	'Dollar',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('136',	'TZS',	'Shilling',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('144',	'UAH',	'Hryvnia',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('143',	'UGX',	'Shilling',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('5',	'USD',	'USD',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('146',	'UYU',	'Peso',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('147',	'UZS',	'Som',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('149',	'VEF',	'Bolivar',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('150',	'VND',	'Dong',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('148',	'VUV',	'Vatu',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('34',	'XAF',	'CFA Franc BEAC',	'admin',	'2018-08-08',	1533712556,	'127.0.0.1',	NULL),
('12',	'XCD',	'East Caribbean Dollar',	'admin',	'2018-08-08',	1533712554,	'127.0.0.1',	NULL),
('23',	'XOF',	'CFA Franc BCEAO',	'admin',	'2018-08-08',	1533712555,	'127.0.0.1',	NULL),
('58',	'XPF',	'CFP Franc',	'admin',	'2018-08-08',	1533712557,	'127.0.0.1',	NULL),
('151',	'YER',	'Rial',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('127',	'ZAR',	'Rand',	'admin',	'2018-08-08',	1533712562,	'127.0.0.1',	NULL),
('152',	'ZMK',	'Kwacha',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL),
('153',	'ZWD',	'Zimbabwe Dollar',	'admin',	'2018-08-08',	1533712563,	'127.0.0.1',	NULL);

DROP TABLE IF EXISTS `docnos`;
CREATE TABLE `docnos` (
  `id` int(10) NOT NULL,
  `appnos` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `docnos` (`id`, `appnos`) VALUES
(1,	56);

DROP TABLE IF EXISTS `emails`;
CREATE TABLE `emails` (
  `id` int(255) NOT NULL,
  `fromaddr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `maildate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `retrieved` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `etemplateasg`;
CREATE TABLE `etemplateasg` (
  `id` int(10) NOT NULL,
  `emtpl_sev` int(2) DEFAULT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `etemplateasg` (`id`, `emtpl_sev`, `audituser`, `auditdate`, `audittime`, `auditip`) VALUES
(1,	1,	'2',	'2018-12-13',	1544718701,	1270);

DROP TABLE IF EXISTS `etemplates`;
CREATE TABLE `etemplates` (
  `id` int(2) NOT NULL,
  `tmplref` int(10) DEFAULT NULL,
  `templatename` varchar(50) NOT NULL,
  `template` longtext,
  FULLTEXT KEY `idx_nm` (`templatename`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `etemplates` (`id`, `tmplref`, `templatename`, `template`) VALUES
(1,	837130953,	'Sign up Email Template',	'<p>Hello [[firstname]]</p>\n\n<p>Thanks for signing up.</p>\n\n<p>click&nbsp;[[verificationurl]] to verify your email address</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n'),
(2,	1887361604,	'Application Approved (to KEPHIS)',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td>\n			<b>Hi [[approver_next_name]]</b>\n			</td>\n		</tr>\n		<tr>\n			<td><br />\n			<strong>[[stepname_current]]</strong> has approved a Harmonized ABS Application Reference Number <strong>[[appno]]</strong>.<br />\n			<br />\n			To View the application [[urlfrontend]]</td>\n		</tr>\n		<tr>\n			<td>\n			<p>1. Please <strong>generate</strong> KEPHIS phytosanitary certificate using your internal system.</p>\n\n			<p>2.<strong>Reply</strong> to this email and attach the phytosanitary certificate as a <strong>PDF</strong> file.</p>\n			</td>\n		</tr>\n		<tr>\n			<td><br />\n			Best regards\n			<hr /> [[companyname]] Customer Care</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[approver_next_email]]<br />\n			From:[[companyname]] </small></td>\n		</tr>\n	</tbody>\n</table>\n'),
(3,	1423439489,	'Application Approved (DVS for applicant)',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td><strong>Hi [[fullname]]</strong></td>\n		</tr>\n		<tr>\n			<td><br />\n			<strong>[[stepname_current]]</strong> has approved a Harmonized ABS Application Reference Number <strong>[[appno]]</strong>.</td>\n		</tr>\n		<tr>\n			<td>\n			<p>1. Please <strong>generate</strong> DVS phytosanitary certificate using the <a href=\"https://kenyatradenet.go.ke/kesws/jsf/login/KESWSLoginPage.jsf\"><strong>KENTRADE</strong></a> system.</p>\n\n			<p>2. Once you have your DVS permit click&nbsp; [[permitattachurl]] to attach your DVS Pemit.</p>\n			</td>\n		</tr>\n		<tr>\n			<td>Best regards\n			<hr /> [[companyname]] Customer Care</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[email]]<br />\n			From:[[companyname]] </small></td>\n		</tr>\n	</tbody>\n</table>\n'),
(4,	1647721989,	'Approved by Instituion ( to next Institunion)',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td>\n			<h2>Hi [[approver_next_name]]</h2>\n			</td>\n		</tr>\n		<tr>\n			<td><br />\n			<strong>[[stepname_current]]</strong> has approved a Harmonized ABS Application Reference Number <strong>[[appno]]</strong>.<br />\n			<br />\n			To View the application ,&nbsp; [[urlbacklist]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			If you received this email in error, you can safely ignore this email.</td>\n		</tr>\n		<tr>\n			<td><br />\n			Best regards\n			<hr /> [[companyname]] Customer Care</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[approver_email]]<br />\n			From:[[companyname]] </small></td>\n		</tr>\n	</tbody>\n</table>\n'),
(5,	88620475,	'Approved by Instituion ( to applicant)',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td>\n			<h2>Hi [[firstname]]</h2>\n			</td>\n		</tr>\n		<tr>\n			<td><br />\n			<strong>[[stepname_current]]</strong> has approved your Harmonized ABS Application Reference Number <strong>[[appno]]</strong>.</td>\n		</tr>\n		<tr>\n			<td><br />\n			The next approval will be done by <strong>[[stepname_next]]</strong><br />\n			<br />\n			To Track the application progress [[urlfrontview]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			If you received this email in error, you can safely ignore this email.</td>\n		</tr>\n		<tr>\n			<td><br />\n			Best regards\n			<hr /> [[companyname]] Customer Care</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[email]]<br />\n			From:[[companyname]] </small></td>\n		</tr>\n	</tbody>\n</table>\n'),
(6,	1812020999,	'Application Dis-Approved (to applicant)',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td>\n			<h2>Hi [[firstname]]</h2>\n			</td>\n		</tr>\n		<tr>\n			<td><br />\n			<strong>[[stepname_current]]</strong> has dis-approved your Harmonized ABS Application Reference Number <strong>[[appno]]</strong>.<br />\n			<br />\n			The dis-approval reason was :<strong>[[reason]]</strong></td>\n		</tr>\n		<tr>\n			<td>To Track the application progress, [[urlfrontview]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			If you received this email in error, you can safely ignore this email.</td>\n		</tr>\n		<tr>\n			<td><br />\n			Best regards\n			<hr /> [[companyname]] Customer Care</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[email]]<br />\n			From:[[companyname]] </small></td>\n		</tr>\n	</tbody>\n</table>\n'),
(7,	1155466430,	'Application Dis-Approved (to previous institution)',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td><strong>Hi [[approver_previous_name]]</strong></td>\n		</tr>\n		<tr>\n			<td><strong>[[stepname_current]]</strong> has dis-approved Harmonized ABS Application Reference Number <strong>[[appno]]</strong>.<br />\n			<br />\n			The dis-approval reason was :<strong>[[reason]]</strong></td>\n		</tr>\n		<tr>\n			<td>To Track the application progress [[urlbacklist]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			If you received this email in error, you can safely ignore this email.</td>\n		</tr>\n		<tr>\n			<td><br />\n			Best regards\n			<hr /> [[companyname]] Customer Care</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[approver_previous_email]]<br />\n			From:[[companyname]] </small></td>\n		</tr>\n	</tbody>\n</table>\n'),
(8,	399614762,	'Application Successful ( to applicant)',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td><strong>ABS Application</strong></td>\n		</tr>\n		<tr>\n			<td><br />\n			Thank you [[$firstname]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			Your Harmonized Application Reference Number is <strong>[[appno]]</strong>.<br />\n			Please follow the link below to view the approval progress of your application : [[urlfrontview]]<br />\n			&nbsp;</td>\n		</tr>\n		<tr>\n			<td><br />\n			If you received this email in error, you can safely ignore this email.</td>\n		</tr>\n		<tr>\n			<td><br />\n			Best regards\n			<hr /> [[$companyname]] Customer Care</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[$email]]<br />\n			From:[[$companyname]] </small></td>\n		</tr>\n		<tr>\n			<td><small>&nbsp;</small></td>\n		</tr>\n	</tbody>\n</table>\n'),
(9,	1279995371,	'Application Successful (to approver)',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td><strong>ABS Application</strong></td>\n		</tr>\n		<tr>\n			<td>Hi [[approver_name]],</td>\n		</tr>\n		<tr>\n			<td><br />\n			[[fullname]] ([[email]]) has submitted a Harmonized ABS Application with Reference Number is <strong>[[appno]]</strong>.<br />\n			To view the application [[urlbacklist]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			If you received this email in error, you can safely ignore this email.</td>\n		</tr>\n		<tr>\n			<td><br />\n			Best regards\n			<hr /> [[companyname]] Customer Care</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[approver_next_email]]<br />\n			From:[[companyname]] </small></td>\n		</tr>\n	</tbody>\n</table>\n'),
(10,	2055332664,	'Approvals Complete (to applicant)',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td>\n			<b>Hi [[firstname]]</b>\n			</td>\n		</tr>\n		<tr>\n			<td><br />\n			<strong>[[stepname_current]]</strong> has approved your Harmonized ABS Application Reference Number <strong>[[appno]]</strong>.</td>\n		</tr>\n		<tr>\n			<td><br />\n			Your ABS PERMIT is now Ready<br />\n			<br />\n			To view your application [[urlfrontview]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			If you received this email in error, you can safely ignore this email.</td>\n		</tr>\n		<tr>\n			<td><br />\n			Best regards\n			<hr /> [[companyname]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[email]]<br />\n			From:[[companyname]] </small></td>\n		</tr>\n	</tbody>\n</table>\n'),
(11,	448051233,	'Consult Approver Template',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td><strong>Hi [[main_approver_username]]</strong></td>\n		</tr>\n		<tr>\n			<td>You have a new consultation from [[fromnamne]]</td>\n		</tr>\n		<tr>\n			<td>[[message_body]]</td>\n		</tr>\n		<tr>\n			<td>\n			<table>\n				<tbody>\n					<tr>\n						<td>Application Reference</td>\n						<td>[[appno]]</td>\n					</tr>\n					<tr>\n						<td>Applicant Name</td>\n						<td>[[firstname]] [[lastname]]</td>\n					</tr>\n					<tr>\n						<td>Applicant County</td>\n						<td>[[ctnname]]</td>\n					</tr>\n					<tr>\n						<td>Applied As</td>\n						<td>[[applyingasname]]</td>\n					</tr>\n					<tr>\n						<td>Email</td>\n						<td>[[email]]</td>\n					</tr>\n					<tr>\n						<td>Mobile</td>\n						<td>[[mobile]]</td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n		<tr>\n			<td>To view the ABS PERMIT Application, [[urlbackview]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			If you received this email in error, you can safely ignore this email.</td>\n		</tr>\n		<tr>\n			<td><br />\n			Best regards\n			<hr /> [[companyname]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[main_approver_email]]<br />\n			From:[[companyname]] </small></td>\n		</tr>\n	</tbody>\n</table>\n'),
(12,	626110675,	'Payment Remider Before Approval to Applicant',	'<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td>\n			<h2>Hi [[firstname]]</h2>\n			</td>\n		</tr>\n		<tr>\n			<td>Please pay <strong>[[approver_next_charges]]</strong> before <strong>[[approver_next_name]]</strong>&nbsp; approves your Harmonized ABS Application Reference Number <strong>[[appno]]</strong>.</td>\n		</tr>\n		<tr>\n			<td>&nbsp;<br />\n			To pay, please&nbsp; visit [[urlfrontpayment]]</td>\n		</tr>\n		<tr>\n			<td><br />\n			&nbsp;</td>\n		</tr>\n		<tr>\n			<td><br />\n			Best regards\n			<hr /> [[companyname]] Customer Care</td>\n		</tr>\n		<tr>\n			<td><br />\n			<small>This message was sent to [[email]]<br />\n			From:[[companyname]] </small></td>\n		</tr>\n	</tbody>\n</table>\n');

DROP TABLE IF EXISTS `etemplatevars`;
CREATE TABLE `etemplatevars` (
  `id` int(2) NOT NULL,
  `colno` varchar(30) NOT NULL,
  `coldesc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`colno`),
  UNIQUE KEY `idx_pk` (`colno`),
  FULLTEXT KEY `idx_nm` (`coldesc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `etemplatevars` (`id`, `colno`, `coldesc`) VALUES
(41,	'applyingasname',	'applying as '),
(40,	'appno',	'application reference no'),
(53,	'approver_email',	'approver email'),
(52,	'approver_name',	'approver name'),
(65,	'approver_next_charges',	'Approver Next Charges'),
(55,	'approver_next_email',	'approver next email'),
(14,	'approver_next_institution_name',	'Approver Next  Institution Name '),
(54,	'approver_next_name',	'approver next name'),
(60,	'approver_previous_email',	'approver previous email'),
(59,	'approver_previous_name',	'approver previous name'),
(51,	'companyname',	'company name'),
(9,	'ctncode',	'country code'),
(10,	'ctnname',	'country name'),
(13,	'dob',	'Birth Date'),
(3,	'email',	'email '),
(31,	'empaddress',	'Employer address '),
(37,	'empcountry',	'Employer country name'),
(36,	'empctncode',	'Employer country code '),
(35,	'emphone',	'emphone '),
(32,	'emppcode',	'Employer postal code '),
(33,	'emppzip',	'Employer zip code'),
(34,	'emptown',	'Employer town '),
(46,	'exportanswer',	'export answer'),
(4,	'firstname',	'First name '),
(7,	'fullname',	'Full name '),
(8,	'gender',	'gender '),
(2,	'idpassno',	'ID/ Passport no'),
(67,	'institutionname',	'Institution name '),
(5,	'lastname',	'Last name '),
(42,	'legalofficername',	'legal officer name'),
(6,	'midname',	'Middle name '),
(17,	'mobile',	'mobile '),
(38,	'orcidid',	'ORCID Id'),
(56,	'permitattachurl',	'URL Permit Attachment'),
(11,	'pinno',	'PIN/TAX No'),
(18,	'postaddress',	'Postal ddress '),
(19,	'postcode',	'postcode '),
(21,	'prmaddress',	'Primary address '),
(22,	'prmpcode',	'Primary postal code '),
(24,	'prmphone',	'Primary phone '),
(25,	'prmresidence',	'Primary residence '),
(23,	'prmtown',	'Primary town '),
(47,	'purpose',	'purpose'),
(15,	'qualification',	'qualification '),
(58,	'reason',	'Disapprove Reason'),
(48,	'researchtypename',	'research type  '),
(43,	'resourcetypename',	'resource type name'),
(45,	'scientificname',	'scientific name'),
(26,	'secaddress',	'Secondary address '),
(27,	'secpcode',	'Secondary postal code '),
(29,	'secphone',	'Secondary phone '),
(30,	'secresidence',	'Secondary residence '),
(28,	'sectown',	'Secondary  town '),
(16,	'specarea',	'area of specialization'),
(44,	'speciesname',	'species name'),
(49,	'stepname_current',	'current approval step name'),
(12,	'title',	'title '),
(20,	'town',	'town '),
(50,	'urlbackend',	'URL Backend'),
(63,	'urlbacklist',	'URL Back List'),
(64,	'urlbackview',	'URL Back View'),
(61,	'urlfrontend',	'URL Frontend'),
(62,	'urlfrontlist',	'URL Front List'),
(66,	'urlfrontpayment',	'URL Frontend Payment'),
(57,	'urlfrontview',	'URL From View'),
(39,	'verificationurl',	'URL Signup Verification');

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email_id` int(255) NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailsize` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `insetmpl`;
CREATE TABLE `insetmpl` (
  `id` int(2) NOT NULL,
  `tmplref` int(10) DEFAULT NULL,
  `instcode` varchar(10) NOT NULL,
  `templatename` varchar(50) NOT NULL,
  `template` longtext,
  FULLTEXT KEY `idx_nm` (`templatename`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
DROP TABLE IF EXISTS `institutions`;
CREATE TABLE `institutions` (
  `id` int(11) NOT NULL,
  `instcode` varchar(10) NOT NULL,
  `instname` varchar(100) NOT NULL,
  `instphoto` longtext,
  `photourl` varchar(255) DEFAULT NULL,
  `thumburl` varchar(255) DEFAULT NULL,
  `charges` decimal(9,2) NOT NULL,
  `consultemail` varchar(100) NOT NULL,
  `consultperson` varchar(100) NOT NULL,
  `licmdcode` varchar(5) DEFAULT NULL,
  `paytimecode` varchar(5) DEFAULT NULL,
  `permitdesc` varchar(255) NOT NULL,
  `api_username` varchar(20) DEFAULT NULL,
  `api_password` varchar(50) DEFAULT NULL,
  `api_baseurl` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`instcode`),
  UNIQUE KEY `idx_pk` (`instcode`),
  FULLTEXT KEY `idx_search` (`instcode`,`instname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `institutions` (`id`, `instcode`, `instname`, `instphoto`, `photourl`, `thumburl`, `charges`, `consultemail`, `consultperson`, `licmdcode`, `paytimecode`, `permitdesc`, `api_username`, `api_password`, `api_baseurl`) VALUES
(8,	'AMMC',	'ANTIQUITIES, MONUMENTS AND MUSEUMS CORPORATION',	'{\"success\":1,\"message\":\"Logo  Uploaded\",\"document\":{\"file_name\":\"8.png\",\"file_type\":\"image\\/png\",\"file_path\":\"\\/var\\/www\\/html\\/absprototype\\/public\\/uploads\\/insphotos\\/\",\"full_path\":\"\\/var\\/www\\/html\\/absprototype\\/public\\/uploads\\/insphotos\\/8.png\",\"raw_name\":\"8\",\"orig_name\":\"8.png\",\"client_name\":\"AMMC.png\",\"file_ext\":\".png\",\"file_size\":32.88,\"is_image\":true,\"image_width\":100,\"image_height\":100,\"image_type\":\"png\",\"image_size_str\":\"width=\\\"100\\\" height=\\\"100\\\"\"}}',	'http://admin.absprototype.net/uploads/insphotos/8.png',	'http://admin.absprototype.net/uploads/insphotos/8_thumb.png',	50.00,	'ekariz@gmail.com',	'',	'SAG',	'BA',	'',	'',	'',	''),
(1,	'BEST',	'Bahamas Environment Science and Technology (BEST) ',	'{\"success\":1,\"message\":\"Logo  Uploaded\",\"document\":{\"file_name\":\"1.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"\\/var\\/www\\/html\\/abs\\/public\\/uploads\\/insphotos\\/\",\"full_path\":\"\\/var\\/www\\/html\\/abs\\/public\\/uploads\\/insphotos\\/1.jpg\",\"raw_name\":\"1\",\"orig_name\":\"1.jpg\",\"client_name\":\"best-logo300.jpg\",\"file_ext\":\".jpg\",\"file_size\":22.79,\"is_image\":true,\"image_width\":334,\"image_height\":398,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"334\\\" height=\\\"398\\\"\"}}',	'http://admin.abs.co.ke/uploads/insphotos/1.jpg',	'http://admin.abs.co.ke/uploads/insphotos/1_thumb.jpg',	0.00,	'',	'',	'SAG',	'BA',	'',	'',	'',	''),
(6,	'BNT',	'Bahamas National Trust',	'{\"success\":1,\"message\":\"Logo  Uploaded\",\"document\":{\"file_name\":\"6.png\",\"file_type\":\"image\\/png\",\"file_path\":\"\\/var\\/www\\/html\\/abs\\/public\\/uploads\\/insphotos\\/\",\"full_path\":\"\\/var\\/www\\/html\\/abs\\/public\\/uploads\\/insphotos\\/6.png\",\"raw_name\":\"6\",\"orig_name\":\"6.png\",\"client_name\":\"Bahamas National Trust Logo.png\",\"file_ext\":\".png\",\"file_size\":45.54,\"is_image\":true,\"image_width\":300,\"image_height\":300,\"image_type\":\"png\",\"image_size_str\":\"width=\\\"300\\\" height=\\\"300\\\"\"}}',	'http://admin.abs.co.ke/uploads/insphotos/6.png',	'http://admin.abs.co.ke/uploads/insphotos/6_thumb.png',	30000.00,	'',	'',	'SAG',	'BA',	'',	'',	'',	''),
(5,	'DMR',	'Dept. of Marine Resources (DMR)',	'{\"success\":1,\"message\":\"Logo  Uploaded\",\"document\":{\"file_name\":\"5.png\",\"file_type\":\"image\\/png\",\"file_path\":\"\\/var\\/www\\/html\\/abs\\/public\\/uploads\\/insphotos\\/\",\"full_path\":\"\\/var\\/www\\/html\\/abs\\/public\\/uploads\\/insphotos\\/5.png\",\"raw_name\":\"5\",\"orig_name\":\"5.png\",\"client_name\":\"dept-of-marine.png\",\"file_ext\":\".png\",\"file_size\":20.6,\"is_image\":true,\"image_width\":174,\"image_height\":150,\"image_type\":\"png\",\"image_size_str\":\"width=\\\"174\\\" height=\\\"150\\\"\"}}',	'http://admin.abs.co.ke/uploads/insphotos/5.png',	'http://admin.abs.co.ke/uploads/insphotos/5_thumb.png',	20000.00,	'',	'',	'SAG',	'BA',	'',	'',	'',	''),
(4,	'DOA',	'Department of Agriculture (DoA)',	'{\"success\":1,\"message\":\"Logo  Uploaded\",\"document\":{\"file_name\":\"4.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"\\/var\\/www\\/html\\/abs\\/public\\/uploads\\/insphotos\\/\",\"full_path\":\"\\/var\\/www\\/html\\/abs\\/public\\/uploads\\/insphotos\\/4.jpg\",\"raw_name\":\"4\",\"orig_name\":\"4.jpg\",\"client_name\":\"Department of Agriculture.jpg\",\"file_ext\":\".jpg\",\"file_size\":25.69,\"is_image\":true,\"image_width\":512,\"image_height\":336,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"512\\\" height=\\\"336\\\"\"}}',	'http://admin.abs.co.ke/uploads/insphotos/4.jpg',	'http://admin.abs.co.ke/uploads/insphotos/4_thumb.jpg',	45000.00,	'',	'',	'SAG',	'BA',	'',	'',	'',	''),
(7,	'FU',	'FORESTRY UNIT',	'{\"success\":1,\"message\":\"Logo  Uploaded\",\"document\":{\"file_name\":\"7.png\",\"file_type\":\"image\\/png\",\"file_path\":\"\\/var\\/www\\/html\\/absprototype\\/public\\/uploads\\/insphotos\\/\",\"full_path\":\"\\/var\\/www\\/html\\/absprototype\\/public\\/uploads\\/insphotos\\/7.png\",\"raw_name\":\"7\",\"orig_name\":\"7.png\",\"client_name\":\"logo-government.png\",\"file_ext\":\".png\",\"file_size\":27.22,\"is_image\":true,\"image_width\":200,\"image_height\":108,\"image_type\":\"png\",\"image_size_str\":\"width=\\\"200\\\" height=\\\"108\\\"\"}}',	'http://admin.absprototype.net/uploads/insphotos/7.png',	'http://admin.absprototype.net/uploads/insphotos/7_thumb.png',	12.00,	'ekariz@gmail.com',	'ABS',	'SAG',	'BA',	'',	'',	'',	''),
(3,	'PD',	'PORT DEPARTMENT',	'{\"success\":1,\"message\":\"Logo  Uploaded\",\"document\":{\"file_name\":\"3.jpeg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"\\/var\\/www\\/html\\/abs\\/public\\/uploads\\/insphotos\\/\",\"full_path\":\"\\/var\\/www\\/html\\/abs\\/public\\/uploads\\/insphotos\\/3.jpeg\",\"raw_name\":\"3\",\"orig_name\":\"3.jpeg\",\"client_name\":\"Port Department.jpeg\",\"file_ext\":\".jpeg\",\"file_size\":11.72,\"is_image\":true,\"image_width\":225,\"image_height\":225,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"225\\\" height=\\\"225\\\"\"}}',	'http://admin.abs.co.ke/uploads/insphotos/3.jpeg',	'http://admin.abs.co.ke/uploads/insphotos/3_thumb.jpeg',	87500.00,	'ekariz@gmail.com',	'DVS',	'SAG',	'BA',	'',	'',	'',	'');

DROP TABLE IF EXISTS `iucnlist`;
CREATE TABLE `iucnlist` (
  `id` int(11) NOT NULL,
  `iucncode` varchar(10) NOT NULL,
  `iucnname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `iucnlist` (`id`, `iucncode`, `iucnname`) VALUES
(1,	'LC',	'Least Concerned'),
(2,	'NT',	'Near Threatened'),
(3,	'VL',	'Vulnerable'),
(4,	'EDG',	'Endangered'),
(5,	'CE',	'Critically Endangered'),
(6,	'EIW',	'Extinct in the WIld'),
(7,	'EXT',	'Extinct');

DROP TABLE IF EXISTS `keys`;
CREATE TABLE `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresse` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_2` (`key`),
  KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  KEY `key` (`key`),
  CONSTRAINT `keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`),
  CONSTRAINT `keys_ibfk_3` FOREIGN KEY (`key`) REFERENCES `login` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresse`, `date_created`) VALUES
(1,	1,	'toquempadrao',	0,	0,	0,	NULL,	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `licmodes`;
CREATE TABLE `licmodes` (
  `id` varchar(10) NOT NULL,
  `licmdcode` varchar(5) NOT NULL,
  `licmdname` varchar(30) NOT NULL,
  `isauto` int(1) DEFAULT NULL,
  `ismanapp` int(1) DEFAULT NULL,
  `ismanins` int(1) DEFAULT NULL,
  `isemail` int(1) DEFAULT NULL,
  PRIMARY KEY (`licmdcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `licmodes` (`id`, `licmdcode`, `licmdname`, `isauto`, `ismanapp`, `ismanins`, `isemail`) VALUES
('4',	'IIE',	'Instituion Issues via Email',	0,	0,	0,	1),
('2',	'MUA',	'Manual Upload by Applicant',	0,	1,	0,	0),
('3',	'MUI',	'Manual Upload by Instituion',	0,	0,	1,	0),
('1',	'SAG',	'System Auto Generated',	1,	0,	0,	0);

DROP TABLE IF EXISTS `lista`;
CREATE TABLE `lista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `valor` varchar(10) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('A','I','B') NOT NULL DEFAULT 'A' COMMENT '[A]tivo, [I]nativo, [B]loqueado',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fornecedor_id` (`fornecedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
     
DROP TABLE IF EXISTS `optlists`;
CREATE TABLE `optlists` (
  `id` int(10) NOT NULL,
  `category` varchar(10) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `optlists` (`id`, `category`, `code`, `name`) VALUES
(1,	'yesno',	'1',	'Yes'),
(2,	'yesno',	'2',	'NO');

DROP TABLE IF EXISTS `orcidlogs`;
CREATE TABLE `orcidlogs` (
  `request` longtext,
  `responsecode` varchar(5) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `body` longtext,
  `auditdate` datetime DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
DROP TABLE IF EXISTS `paytimes`;
CREATE TABLE `paytimes` (
  `id` varchar(10) NOT NULL,
  `paytimecode` varchar(5) NOT NULL,
  `paytimename` varchar(30) NOT NULL,
  `isbfrsub` int(1) DEFAULT NULL,
  `isbfrapr` int(1) DEFAULT NULL,
  PRIMARY KEY (`paytimecode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `paytimes` (`id`, `paytimecode`, `paytimename`, `isbfrsub`, `isbfrapr`) VALUES
('2',	'BA',	'Before Approval By Institution',	0,	1),
('1',	'BS',	'Before Submitting Application',	1,	0);

DROP TABLE IF EXISTS `purposes`;
CREATE TABLE `purposes` (
  `id` int(11) NOT NULL,
  `pupcode` varchar(5) NOT NULL,
  `pupname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `purposes` (`id`, `pupcode`, `pupname`) VALUES
(1,	'SM',	'Species management'),
(2,	'BI',	'Biomonitoring'),
(3,	'EM',	'Environmental Monitoring'),
(4,	'SS',	'Species Survey'),
(6,	'INS',	'Instructional'),
(5,	'RSH',	'Research'),
(7,	'other',	'Others');

DROP TABLE IF EXISTS `qualifications`;
CREATE TABLE `qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `qualifications` (`id`, `qualification`) VALUES
(2,	'PhD\r\n'),
(3,	'Masters\r\n'),
(4,	'Bachelors\r\n'),
(5,	'Diploma\r\n'),
(6,	'Certificate');

DROP TABLE IF EXISTS `queuemail`;
CREATE TABLE `queuemail` (
  `id` int(10) NOT NULL,
  `toemail` varchar(50) NOT NULL,
  `toname` varchar(50) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `message` longtext,
  `queuedate` date DEFAULT NULL,
  `sentdate` date DEFAULT NULL,
  `sent` int(1) DEFAULT NULL,
  `attachfile` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
DROP TABLE IF EXISTS `queueremider`;
CREATE TABLE `queueremider` (
  `id` int(10) NOT NULL,
  `toemail` varchar(50) NOT NULL,
  `toname` varchar(50) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `message` longtext,
  `queuedate` date DEFAULT NULL,
  `reminddate` date DEFAULT NULL,
  `sent` int(1) DEFAULT NULL,
  `attachfile` varchar(200) DEFAULT NULL,
  `remindcheckfn` varchar(200) DEFAULT NULL,
  `remindcheckvars` varchar(200) DEFAULT NULL,
  `checkpassed` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
DROP TABLE IF EXISTS `queuesms`;
CREATE TABLE `queuesms` (
  `id` int(10) NOT NULL,
  `refno` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `sms` longtext,
  `queuetime` int(10) NOT NULL,
  `sent` int(1) DEFAULT NULL,
  `senttime` int(10) NOT NULL,
  `apiresponse` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `requiredocs`;
CREATE TABLE `requiredocs` (
  `id` int(10) NOT NULL,
  `docname` varchar(50) NOT NULL,
  `doctemplate` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `requiredocs` (`id`, `docname`, `doctemplate`) VALUES
(2,	'ID/Passport',	NULL),
(3,	'Passport Photo',	NULL),
(4,	'Import Permit (If Exporting)',	NULL),
(5,	'Company/ Corporate Organization',	NULL),
(6,	'Local Affiliation',	NULL),
(7,	'Prior Informed Consent Description',	NULL),
(8,	'Mutually Agreed Terms Description',	NULL),
(9,	'Material Transfer Agreement Description',	NULL),
(10,	'Research Proposal',	NULL),
(11,	'Resume',	NULL),
(12,	' Collaborative agreement',	NULL),
(13,	' Letter from academic/research institute',	NULL);

DROP TABLE IF EXISTS `researchareas`;
CREATE TABLE `researchareas` (
  `id` int(11) NOT NULL,
  `area` varchar(50) NOT NULL,
  `requpload` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `researchareas` (`id`, `area`, `requpload`) VALUES
(1,	'Agricultural and Allied Sciences',	NULL),
(2,	'Biological Sciences',	NULL),
(3,	'Engineering',	NULL),
(4,	'Environmental and Earth Sciences',	NULL),
(5,	'Health Sciences',	'1'),
(6,	'Industrial and Allied Sciences',	NULL),
(7,	'Information Sciences including ICT',	NULL),
(8,	'Physical and Nuclear Sciences',	NULL),
(9,	'Social Sciences',	NULL);

DROP TABLE IF EXISTS `researchers`;
CREATE TABLE `researchers` (
  `id` int(10) NOT NULL,
  `idpassno` varchar(30) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `midname` varchar(30) NOT NULL,
  `fullname` varchar(30) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `ctncode` varchar(10) NOT NULL,
  `pinno` varchar(20) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `idpassip` varchar(50) DEFAULT NULL,
  `idpassdi` date DEFAULT NULL,
  `idpassdx` date DEFAULT NULL,
  `institutionname` varchar(100) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `specarea` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `postaddress` varchar(20) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `town` varchar(50) DEFAULT NULL,
  `prmaddress` varchar(100) NOT NULL,
  `prmpcode` varchar(100) NOT NULL,
  `prmtown` varchar(100) NOT NULL,
  `prmphone` varchar(100) NOT NULL,
  `prmresidence` varchar(100) DEFAULT NULL,
  `secaddress` varchar(100) DEFAULT NULL,
  `secpcode` varchar(100) DEFAULT NULL,
  `sectown` varchar(100) DEFAULT NULL,
  `secphone` varchar(100) DEFAULT NULL,
  `secresidence` varchar(100) DEFAULT NULL,
  `empaddress` varchar(100) DEFAULT NULL,
  `emppcode` varchar(100) DEFAULT NULL,
  `emppzip` varchar(100) DEFAULT NULL,
  `emptown` varchar(100) DEFAULT NULL,
  `emphone` varchar(100) DEFAULT NULL,
  `empctncode` varchar(10) DEFAULT NULL,
  `empcountry` varchar(40) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `verifycode` varchar(10) DEFAULT NULL,
  `verifydate` date DEFAULT NULL,
  `verified` int(1) DEFAULT NULL,
  `hasuploads` int(1) DEFAULT NULL,
  `docid` longtext,
  `active` int(1) DEFAULT NULL,
  `setup` int(1) DEFAULT NULL,
  `regdate` date DEFAULT NULL,
  `regtime` int(10) DEFAULT NULL,
  `orcidid` varchar(100) DEFAULT NULL,
  `orcidname` varchar(100) DEFAULT NULL,
  `accesstoken` varchar(100) DEFAULT NULL,
  `tokentype` varchar(100) DEFAULT NULL,
  `refreshtoken` varchar(100) DEFAULT NULL,
  `tokenexpiry` int(10) DEFAULT NULL,
  `tokenscope` varchar(100) DEFAULT NULL,
  `auditdate` date NOT NULL,
  `audittime` int(10) NOT NULL,
  `auditip` varchar(15) NOT NULL,
  `docpassport` longtext,
  `urlphoto` varchar(255) DEFAULT NULL,
  `docidpass` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
DROP TABLE IF EXISTS `researchinst`;
CREATE TABLE `researchinst` (
  `id` int(11) NOT NULL,
  `instcode` varchar(10) NOT NULL,
  `instname` varchar(100) NOT NULL,
  `mou` int(1) DEFAULT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` int(10) DEFAULT NULL,
  `instemail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`instcode`),
  UNIQUE KEY `idx_pk` (`instcode`),
  FULLTEXT KEY `idx_search` (`instcode`,`instname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `researchinst` (`id`, `instcode`, `instname`, `mou`, `audituser`, `auditdate`, `audittime`, `auditip`, `instemail`) VALUES
(10,	'AFF',	'African Forest',	NULL,	NULL,	'2018-10-04',	1538631598,	1270,	''),
(16,	'CIFOR',	'CIFOR',	NULL,	NULL,	'2018-10-04',	1538631709,	1270,	''),
(5,	'CUU',	'Columbia University, USA',	NULL,	NULL,	'2018-10-04',	1538631537,	1270,	''),
(20,	'HKU',	'Hokkaido University - Japan',	NULL,	NULL,	'2018-10-04',	1538631773,	1270,	''),
(15,	'ICIPE',	'ICIPE',	NULL,	NULL,	'2018-10-04',	1538631664,	1270,	''),
(23,	'ICRAF',	'INTERNATIONAL CENTER FOR RESEARCH IN AGROFORESTRY',	NULL,	'2',	'2018-10-05',	1538724441,	1270,	'info@ICRAF.org'),
(6,	'IFCMS',	'Integrated Forestry Consultancy & Mgt Services',	NULL,	NULL,	'2018-10-04',	1538631751,	1270,	''),
(7,	'JKUAT',	'JKUAT',	NULL,	NULL,	'2018-10-04',	1538631557,	1270,	''),
(9,	'KEFRI',	'KEFRI',	NULL,	NULL,	'2018-10-04',	1538631580,	1270,	''),
(22,	'KIRDI',	'KIRDI',	NULL,	NULL,	'2018-10-04',	1538631801,	1270,	''),
(19,	'KRU',	'Karatina University',	NULL,	NULL,	'2018-10-04',	1538631740,	1270,	''),
(1,	'KU',	'Kenyatta University',	1,	NULL,	'2018-10-04',	1538631676,	1270,	''),
(11,	'MPIG',	'Max Planck Institute-Germany',	NULL,	NULL,	'2018-10-04',	1538631610,	1270,	''),
(2,	'NMK',	'National Museums of Kenya',	1,	'2',	'2018-10-05',	1538727375,	1270,	'publicrelations@museums.or.ke'),
(12,	'PAU',	'Pan African University',	NULL,	NULL,	'2018-10-04',	1538631618,	1270,	''),
(17,	'ROA',	'Royal Oil Africa',	NULL,	NULL,	'2018-10-04',	1538631721,	1270,	''),
(21,	'TPFAP',	'The  Peregrine Fund - Africa Programs',	NULL,	NULL,	'2018-10-04',	1538631792,	1270,	''),
(14,	'TUM',	'Technische Universitat muchen',	NULL,	NULL,	'2018-10-04',	1538631637,	1270,	''),
(13,	'UOE',	'University of Embu',	NULL,	NULL,	'2018-10-04',	1538631627,	1270,	''),
(8,	'UOH',	'University of Helsinki',	NULL,	NULL,	'2018-10-04',	1538631699,	1270,	''),
(4,	'UOK',	'University of Kent',	NULL,	NULL,	'2018-10-04',	1538631524,	1270,	''),
(3,	'UON',	'University of Nairobi',	NULL,	NULL,	'2018-10-04',	1538631514,	1270,	''),
(18,	'VPW',	'Ventopower',	NULL,	NULL,	'2018-10-04',	1538631730,	1270,	'');

DROP TABLE IF EXISTS `researchtypes`;
CREATE TABLE `researchtypes` (
  `id` int(11) NOT NULL,
  `typecode` varchar(10) NOT NULL,
  `typename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `researchtypes` (`id`, `typecode`, `typename`) VALUES
(3,	'T1',	'Applied'),
(4,	'T2',	'Basic');

DROP TABLE IF EXISTS `resourcetypes`;
CREATE TABLE `resourcetypes` (
  `id` int(11) NOT NULL,
  `typecode` varchar(10) NOT NULL,
  `typename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `resourcetypes` (`id`, `typecode`, `typename`) VALUES
(9,	'T1',	'Animalia'),
(10,	'T2',	'Archaea'),
(11,	'T3',	'Bacteria'),
(12,	'T4',	'Chromista'),
(13,	'T5',	'Fungi'),
(14,	'T6',	'Plantae'),
(15,	'T7',	'Protozoa'),
(16,	'T8',	'Viruses'),
(17,	'T10',	'incertae sedis'),
(18,	'T9',	'Environmental Samples (e.g. Soil, Water, Air, metagenomes)'),
(19,	'T11',	'Multiple types');

DROP TABLE IF EXISTS `rights_root`;
CREATE TABLE `rights_root` (
  `userid` varchar(10) NOT NULL,
  `moduleid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
DROP TABLE IF EXISTS `rights_sub`;
CREATE TABLE `rights_sub` (
  `userid` varchar(20) NOT NULL,
  `moduleid` varchar(30) NOT NULL,
  `sub_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
DROP TABLE IF EXISTS `rights_sub_sub`;
CREATE TABLE `rights_sub_sub` (
  `userid` varchar(20) NOT NULL,
  `moduleid` varchar(30) NOT NULL,
  `sub_id` varchar(30) NOT NULL,
  `sub_sub_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
DROP TABLE IF EXISTS `salutations`;
CREATE TABLE `salutations` (
  `id` int(2) NOT NULL,
  `sltcode` varchar(5) NOT NULL,
  `sltname` varchar(50) NOT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` int(10) DEFAULT NULL,
  PRIMARY KEY (`sltcode`),
  UNIQUE KEY `idx_pk` (`sltcode`),
  FULLTEXT KEY `idx_nm` (`sltname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `salutations` (`id`, `sltcode`, `sltname`, `audituser`, `auditdate`, `audittime`, `auditip`) VALUES
(5,	'dr',	'dr',	NULL,	NULL,	NULL,	NULL),
(1,	'mr',	'mr',	NULL,	NULL,	NULL,	NULL),
(3,	'mrs',	'mrs',	NULL,	NULL,	NULL,	NULL),
(2,	'ms',	'ms',	NULL,	NULL,	NULL,	NULL),
(6,	'na',	'Not Availed',	'1',	'2017-07-18',	1500381641,	1270),
(4,	'prof',	'prof',	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `sampleuom`;
CREATE TABLE `sampleuom` (
  `id` int(11) NOT NULL,
  `uomcode` varchar(10) NOT NULL,
  `uomname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sampleuom` (`id`, `uomcode`, `uomname`) VALUES
(1,	'E',	'EACH'),
(2,	'KG',	'Kilogramms'),
(3,	'PC',	'Pieces'),
(4,	'ML',	'Miligrammes'),
(5,	'P',	'Per Plan');

DROP TABLE IF EXISTS `signups`;
CREATE TABLE `signups` (
  `id` int(10) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `ctncode` varchar(10) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `verifycode` varchar(10) DEFAULT NULL,
  `verifydate` date DEFAULT NULL,
  `verified` int(1) DEFAULT NULL,
  `hasuploads` int(1) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `setup` int(1) DEFAULT NULL,
  `auditdate` date NOT NULL,
  `audittime` int(10) NOT NULL,
  `auditip` varchar(15) NOT NULL,
  `docid` longtext,
  `docpassport` longtext,
  PRIMARY KEY (`email`),
  KEY `ctncode` (`ctncode`),
  CONSTRAINT `signups_ibfk_1` FOREIGN KEY (`ctncode`) REFERENCES `countries` (`ctncode`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `smsbulk`;
CREATE TABLE `smsbulk` (
  `id` int(11) NOT NULL,
  `sms` varchar(255) NOT NULL,
  `queuetime` int(10) NOT NULL,
  `draft` int(1) DEFAULT NULL,
  `sent` int(1) DEFAULT NULL,
  `senttime` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sysapps`;
CREATE TABLE `sysapps` (
  `id` varchar(10) NOT NULL,
  `appid` varchar(2) NOT NULL,
  `appname` varchar(50) NOT NULL,
  `appicon` varchar(20) DEFAULT NULL,
  `iconclr` varchar(20) DEFAULT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` varchar(15) DEFAULT NULL,
  `isdef` int(1) DEFAULT NULL,
  `isadmin` int(1) DEFAULT NULL,
  `isdev` int(1) DEFAULT NULL,
  `isuser` int(1) DEFAULT NULL,
  PRIMARY KEY (`appid`),
  UNIQUE KEY `idx_pk` (`appid`),
  FULLTEXT KEY `idx_search` (`appid`,`appname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sysapps` (`id`, `appid`, `appname`, `appicon`, `iconclr`, `audituser`, `auditdate`, `audittime`, `auditip`, `isdef`, `isadmin`, `isdev`, `isuser`) VALUES
('5',	'CA',	'Administration',	'group',	'greenLight',	'1',	'2017-08-19',	1503134426,	'127.0.0.1',	NULL,	NULL,	NULL,	NULL),
('6',	'RG',	'ABS',	'check-square-o',	'blueDark',	'2',	'2018-02-19',	1519059625,	'127.0.0.1',	1,	1,	NULL,	1),
('4',	'SY',	'Dev Console ',	'wrench',	'orange',	'1',	'2017-08-21',	1503319243,	'127.0.0.1',	NULL,	NULL,	1,	NULL);

DROP TABLE IF EXISTS `syshist`;
CREATE TABLE `syshist` (
  `userid` int(5) NOT NULL,
  `controller` varchar(5) NOT NULL,
  `timestamp` varchar(50) NOT NULL,
  FULLTEXT KEY `idx_search` (`controller`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sysicons`;
CREATE TABLE `sysicons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sysicons` (`id`, `icon`) VALUES
(1,	'fa-glass'),
(2,	'fa-music'),
(3,	'fa-search'),
(4,	'fa-envelope-o'),
(5,	'fa-heart'),
(6,	'fa-star'),
(7,	'fa-star-o'),
(8,	'fa-user'),
(9,	'fa-film'),
(10,	'fa-th-large'),
(11,	'fa-th'),
(12,	'fa-th-list'),
(13,	'fa-check'),
(14,	'fa-remove'),
(15,	'fa-close'),
(16,	'fa-times'),
(17,	'fa-search-plus'),
(18,	'fa-search-minus'),
(19,	'fa-power-off'),
(20,	'fa-signal'),
(21,	'fa-gear'),
(22,	'fa-cog'),
(23,	'fa-trash-o'),
(24,	'fa-home'),
(25,	'fa-file-o'),
(26,	'fa-clock-o'),
(27,	'fa-road'),
(28,	'fa-download'),
(29,	'fa-arrow-circle-o-do'),
(30,	'fa-arrow-circle-o-up'),
(31,	'fa-inbox'),
(32,	'fa-play-circle-o'),
(33,	'fa-rotate-right'),
(34,	'fa-repeat'),
(35,	'fa-refresh'),
(36,	'fa-list-alt'),
(37,	'fa-lock'),
(38,	'fa-flag'),
(39,	'fa-headphones'),
(40,	'fa-volume-off'),
(41,	'fa-volume-down'),
(42,	'fa-volume-up'),
(43,	'fa-qrcode'),
(44,	'fa-barcode'),
(45,	'fa-tag'),
(46,	'fa-tags'),
(47,	'fa-book'),
(48,	'fa-bookmark'),
(49,	'fa-print f'),
(50,	'fa-camera'),
(51,	'fa-font'),
(52,	'fa-bold'),
(53,	'fa-italic'),
(54,	'fa-text-height'),
(55,	'fa-text-width'),
(56,	'fa-align-left'),
(57,	'fa-align-center'),
(58,	'fa-align-right'),
(59,	'fa-align-justify'),
(60,	'fa-list'),
(61,	'fa-dedent'),
(62,	'fa-outdent'),
(63,	'fa-indent'),
(64,	'fa-video-camera'),
(65,	'fa-photo'),
(66,	'fa-image'),
(67,	'fa-picture-o'),
(68,	'fa-pencil'),
(69,	'fa-map-marker'),
(70,	'fa-adjust'),
(71,	'fa-tint'),
(72,	'fa-edit'),
(73,	'fa-pencil-square-o'),
(74,	'fa-share-square-o'),
(75,	'fa-check-square-o'),
(76,	'fa-arrows'),
(77,	'fa-step-backward'),
(78,	'fa-fast-backward'),
(79,	'fa-backward'),
(80,	'fa-play'),
(81,	'fa-pause'),
(82,	'fa-stop'),
(83,	'fa-forward'),
(84,	'fa-fast-forward'),
(85,	'fa-step-forward'),
(86,	'fa-eject'),
(87,	'fa-chevron-left'),
(88,	'fa-chevron-right'),
(89,	'fa-plus-circle'),
(90,	'fa-minus-circle'),
(91,	'fa-times-circle'),
(92,	'fa-check-circle'),
(93,	'fa-question-circle'),
(94,	'fa-info-circle'),
(95,	'fa-crosshairs'),
(96,	'fa-times-circle-o'),
(97,	'fa-check-circle-o'),
(98,	'fa-ban'),
(99,	'fa-arrow-left'),
(100,	'fa-arrow-right'),
(101,	'fa-arrow-up'),
(102,	'fa-arrow-down'),
(103,	'fa-mail-forward'),
(104,	'fa-share'),
(105,	'fa-expand'),
(106,	'fa-compress'),
(107,	'fa-plus'),
(108,	'fa-minus'),
(109,	'fa-asterisk'),
(110,	'fa-exclamation-circl'),
(111,	'fa-gift'),
(112,	'fa-leaf'),
(113,	'fa-fire'),
(114,	'fa-eye'),
(115,	'fa-eye-slash'),
(116,	'fa-warning'),
(117,	'fa-exclamation-trian'),
(118,	'fa-plane'),
(119,	'fa-calendar'),
(120,	'fa-random'),
(121,	'fa-comment'),
(122,	'fa-magnet'),
(123,	'fa-chevron-up'),
(124,	'fa-chevron-down'),
(125,	'fa-retweet'),
(126,	'fa-shopping-cart'),
(127,	'fa-folder'),
(128,	'fa-folder-open'),
(129,	'fa-arrows-v'),
(130,	'fa-arrows-h'),
(131,	'fa-bar-chart-o'),
(132,	'fa-bar-chart'),
(133,	'fa-twitter-square'),
(134,	'fa-facebook-square'),
(135,	'fa-camera-retro'),
(136,	'fa-key'),
(137,	'fa-gears'),
(138,	'fa-cogs'),
(139,	'fa-comments'),
(140,	'fa-thumbs-o-up'),
(141,	'fa-thumbs-o-down'),
(142,	'fa-star-half'),
(143,	'fa-heart-o'),
(144,	'fa-sign-out'),
(145,	'fa-linkedin-square'),
(146,	'fa-thumb-tack'),
(147,	'fa-external-link'),
(148,	'fa-sign-in'),
(149,	'fa-trophy'),
(150,	'fa-github-square'),
(151,	'fa-upload'),
(152,	'fa-lemon-o'),
(153,	'fa-phone'),
(154,	'fa-square-o'),
(155,	'fa-bookmark-o'),
(156,	'fa-phone-square'),
(157,	'fa-twitter'),
(158,	'fa-facebook-f'),
(159,	'fa-facebook'),
(160,	'fa-github'),
(161,	'fa-unlock'),
(162,	'fa-credit-card'),
(163,	'fa-rss'),
(164,	'fa-hdd-o'),
(165,	'fa-bullhorn'),
(166,	'fa-bell'),
(167,	'fa-certificate'),
(168,	'fa-hand-o-right'),
(169,	'fa-hand-o-left'),
(170,	'fa-hand-o-up'),
(171,	'fa-hand-o-down'),
(172,	'fa-arrow-circle-left'),
(173,	'fa-arrow-circle-righ'),
(174,	'fa-arrow-circle-up'),
(175,	'fa-arrow-circle-down'),
(176,	'fa-globe'),
(177,	'fa-wrench'),
(178,	'fa-tasks'),
(179,	'fa-filter'),
(180,	'fa-briefcase'),
(181,	'fa-arrows-alt'),
(182,	'fa-group'),
(183,	'fa-users'),
(184,	'fa-chain'),
(185,	'fa-link'),
(186,	'fa-cloud'),
(187,	'fa-flask'),
(188,	'fa-cut'),
(189,	'fa-scissors'),
(190,	'fa-copy'),
(191,	'fa-files-o'),
(192,	'fa-paperclip'),
(193,	'fa-save'),
(194,	'fa-floppy-o'),
(195,	'fa-square'),
(196,	'fa-navicon'),
(197,	'fa-reorder'),
(198,	'fa-bars'),
(199,	'fa-list-ul'),
(200,	'fa-list-ol'),
(201,	'fa-strikethrough'),
(202,	'fa-underline'),
(203,	'fa-table'),
(204,	'fa-magic'),
(205,	'fa-truck'),
(206,	'fa-pinterest'),
(207,	'fa-pinterest-square'),
(208,	'fa-google-plus-squar'),
(209,	'fa-google-plus'),
(210,	'fa-money'),
(211,	'fa-caret-down'),
(212,	'fa-caret-up'),
(213,	'fa-caret-left'),
(214,	'fa-caret-right'),
(215,	'fa-columns'),
(216,	'fa-unsorted'),
(217,	'fa-sort'),
(218,	'fa-sort-down'),
(219,	'fa-sort-desc'),
(220,	'fa-sort-up'),
(221,	'fa-sort-asc'),
(222,	'fa-envelope'),
(223,	'fa-linkedin'),
(224,	'fa-rotate-left'),
(225,	'fa-undo'),
(226,	'fa-legal'),
(227,	'fa-gavel'),
(228,	'fa-dashboard'),
(229,	'fa-tachometer'),
(230,	'fa-comment-o'),
(231,	'fa-comments-o'),
(232,	'fa-flash'),
(233,	'fa-bolt'),
(234,	'fa-sitemap'),
(235,	'fa-umbrella'),
(236,	'fa-paste'),
(237,	'fa-clipboard'),
(238,	'fa-lightbulb-o'),
(239,	'fa-exchange'),
(240,	'fa-cloud-download'),
(241,	'fa-cloud-upload'),
(242,	'fa-user-md'),
(243,	'fa-stethoscope'),
(244,	'fa-suitcase'),
(245,	'fa-bell-o'),
(246,	'fa-coffee'),
(247,	'fa-cutlery'),
(248,	'fa-file-text-o'),
(249,	'fa-building-o'),
(250,	'fa-hospital-o'),
(251,	'fa-ambulance'),
(252,	'fa-medkit'),
(253,	'fa-fighter-jet'),
(254,	'fa-beer'),
(255,	'fa-h-square'),
(256,	'fa-plus-square'),
(257,	'fa-angle-double-left'),
(258,	'fa-angle-double-righ'),
(259,	'fa-angle-double-up'),
(260,	'fa-angle-double-down'),
(261,	'fa-angle-left'),
(262,	'fa-angle-right'),
(263,	'fa-angle-up'),
(264,	'fa-angle-down'),
(265,	'fa-desktop'),
(266,	'fa-laptop'),
(267,	'fa-tablet'),
(268,	'fa-mobile-phone'),
(269,	'fa-mobile'),
(270,	'fa-circle-o'),
(271,	'fa-quote-left'),
(272,	'fa-quote-right'),
(273,	'fa-spinner'),
(274,	'fa-circle'),
(275,	'fa-mail-reply'),
(276,	'fa-reply'),
(277,	'fa-github-alt'),
(278,	'fa-folder-o'),
(279,	'fa-folder-open-o'),
(280,	'fa-smile-o'),
(281,	'fa-frown-o'),
(282,	'fa-meh-o'),
(283,	'fa-gamepad'),
(284,	'fa-keyboard-o'),
(285,	'fa-flag-o'),
(286,	'fa-flag-checkered'),
(287,	'fa-terminal'),
(288,	'fa-code'),
(289,	'fa-mail-reply-all'),
(290,	'fa-reply-all'),
(291,	'fa-star-half-empty'),
(292,	'fa-star-half-full'),
(293,	'fa-star-half-o'),
(294,	'fa-location-arrow'),
(295,	'fa-crop'),
(296,	'fa-code-fork'),
(297,	'fa-unlink'),
(298,	'fa-chain-broken'),
(299,	'fa-question'),
(300,	'fa-info'),
(301,	'fa-exclamation'),
(302,	'fa-superscript'),
(303,	'fa-subscript'),
(304,	'fa-eraser'),
(305,	'fa-puzzle-piece'),
(306,	'fa-microphone'),
(307,	'fa-microphone-slash'),
(308,	'fa-shield'),
(309,	'fa-calendar-o'),
(310,	'fa-fire-extinguisher'),
(311,	'fa-rocket'),
(312,	'fa-maxcdn'),
(313,	'fa-chevron-circle-le'),
(314,	'fa-chevron-circle-ri'),
(315,	'fa-chevron-circle-up'),
(316,	'fa-chevron-circle-do'),
(317,	'fa-html5'),
(318,	'fa-css3'),
(319,	'fa-anchor'),
(320,	'fa-unlock-alt'),
(321,	'fa-bullseye'),
(322,	'fa-ellipsis-h'),
(323,	'fa-ellipsis-v'),
(324,	'fa-rss-square'),
(325,	'fa-play-circle'),
(326,	'fa-ticket'),
(327,	'fa-minus-square'),
(328,	'fa-minus-square-o'),
(329,	'fa-level-up'),
(330,	'fa-level-down'),
(331,	'fa-check-square'),
(332,	'fa-pencil-square'),
(333,	'fa-external-link-squ'),
(334,	'fa-share-square'),
(335,	'fa-compass'),
(336,	'fa-toggle-down'),
(337,	'fa-caret-square-o-do'),
(338,	'fa-toggle-up'),
(339,	'fa-caret-square-o-up'),
(340,	'fa-toggle-right'),
(341,	'fa-caret-square-o-ri'),
(342,	'fa-euro'),
(343,	'fa-eur'),
(344,	'fa-gbp'),
(345,	'fa-dollar'),
(346,	'fa-usd'),
(347,	'fa-rupee'),
(348,	'fa-inr'),
(349,	'fa-cny'),
(350,	'fa-rmb'),
(351,	'fa-yen'),
(352,	'fa-jpy'),
(353,	'fa-ruble'),
(354,	'fa-rouble'),
(355,	'fa-rub'),
(356,	'fa-won'),
(357,	'fa-krw'),
(358,	'fa-bitcoin'),
(359,	'fa-btc'),
(360,	'fa-file'),
(361,	'fa-file-text'),
(362,	'fa-sort-alpha-asc'),
(363,	'fa-sort-alpha-desc'),
(364,	'fa-sort-amount-asc'),
(365,	'fa-sort-amount-desc'),
(366,	'fa-sort-numeric-asc'),
(367,	'fa-sort-numeric-desc'),
(368,	'fa-thumbs-up'),
(369,	'fa-thumbs-down'),
(370,	'fa-youtube-square'),
(371,	'fa-youtube'),
(372,	'fa-xing'),
(373,	'fa-xing-square'),
(374,	'fa-youtube-play'),
(375,	'fa-dropbox'),
(376,	'fa-stack-overflow'),
(377,	'fa-instagram'),
(378,	'fa-flickr'),
(379,	'fa-adn'),
(380,	'fa-bitbucket'),
(381,	'fa-bitbucket-square'),
(382,	'fa-tumblr'),
(383,	'fa-tumblr-square'),
(384,	'fa-long-arrow-down'),
(385,	'fa-long-arrow-up'),
(386,	'fa-long-arrow-left'),
(387,	'fa-long-arrow-right'),
(388,	'fa-apple'),
(389,	'fa-windows'),
(390,	'fa-android'),
(391,	'fa-linux'),
(392,	'fa-dribbble'),
(393,	'fa-skype'),
(394,	'fa-foursquare'),
(395,	'fa-trello'),
(396,	'fa-female'),
(397,	'fa-male'),
(398,	'fa-gittip'),
(399,	'fa-gratipay'),
(400,	'fa-sun-o'),
(401,	'fa-moon-o'),
(402,	'fa-archive'),
(403,	'fa-bug'),
(404,	'fa-vk'),
(405,	'fa-weibo'),
(406,	'fa-renren'),
(407,	'fa-pagelines'),
(408,	'fa-stack-exchange'),
(409,	'fa-arrow-circle-o-ri'),
(410,	'fa-arrow-circle-o-le'),
(411,	'fa-toggle-left'),
(412,	'fa-caret-square-o-le'),
(413,	'fa-dot-circle-o'),
(414,	'fa-wheelchair'),
(415,	'fa-vimeo-square'),
(416,	'fa-turkish-lira'),
(417,	'fa-try'),
(418,	'fa-plus-square-o'),
(419,	'fa-space-shuttle'),
(420,	'fa-slack'),
(421,	'fa-envelope-square'),
(422,	'fa-wordpress'),
(423,	'fa-openid'),
(424,	'fa-institution'),
(425,	'fa-bank'),
(426,	'fa-university'),
(427,	'fa-mortar-board'),
(428,	'fa-graduation-cap'),
(429,	'fa-yahoo'),
(430,	'fa-google'),
(431,	'fa-reddit'),
(432,	'fa-reddit-square'),
(433,	'fa-stumbleupon-circl'),
(434,	'fa-stumbleupon'),
(435,	'fa-delicious'),
(436,	'fa-digg'),
(437,	'fa-pied-piper'),
(438,	'fa-pied-piper-alt'),
(439,	'fa-drupal'),
(440,	'fa-joomla'),
(441,	'fa-language'),
(442,	'fa-fax'),
(443,	'fa-building'),
(444,	'fa-child'),
(445,	'fa-paw'),
(446,	'fa-spoon'),
(447,	'fa-cube'),
(448,	'fa-cubes'),
(449,	'fa-behance'),
(450,	'fa-behance-square'),
(451,	'fa-steam'),
(452,	'fa-steam-square'),
(453,	'fa-recycle'),
(454,	'fa-automobile'),
(455,	'fa-car'),
(456,	'fa-cab'),
(457,	'fa-taxi'),
(458,	'fa-tree'),
(459,	'fa-spotify'),
(460,	'fa-deviantart'),
(461,	'fa-soundcloud'),
(462,	'fa-database'),
(463,	'fa-file-pdf-o'),
(464,	'fa-file-word-o'),
(465,	'fa-file-excel-o'),
(466,	'fa-file-powerpoint-o'),
(467,	'fa-file-photo-o'),
(468,	'fa-file-picture-o'),
(469,	'fa-file-image-o'),
(470,	'fa-file-zip-o'),
(471,	'fa-file-archive-o'),
(472,	'fa-file-sound-o'),
(473,	'fa-file-audio-o'),
(474,	'fa-file-movie-o'),
(475,	'fa-file-video-o'),
(476,	'fa-file-code-o'),
(477,	'fa-vine'),
(478,	'fa-codepen'),
(479,	'fa-jsfiddle'),
(480,	'fa-life-bouy'),
(481,	'fa-life-buoy'),
(482,	'fa-life-saver'),
(483,	'fa-support'),
(484,	'fa-life-ring'),
(485,	'fa-circle-o-notch'),
(486,	'fa-ra'),
(487,	'fa-rebel'),
(488,	'fa-ge'),
(489,	'fa-empire'),
(490,	'fa-git-square'),
(491,	'fa-git'),
(492,	'fa-hacker-news'),
(493,	'fa-tencent-weibo'),
(494,	'fa-qq'),
(495,	'fa-wechat'),
(496,	'fa-weixin'),
(497,	'fa-send'),
(498,	'fa-paper-plane'),
(499,	'fa-send-o'),
(500,	'fa-paper-plane-o'),
(501,	'fa-history'),
(502,	'fa-genderless'),
(503,	'fa-circle-thin'),
(504,	'fa-header'),
(505,	'fa-paragraph'),
(506,	'fa-sliders'),
(507,	'fa-share-alt'),
(508,	'fa-share-alt-square'),
(509,	'fa-bomb'),
(510,	'fa-soccer-ball-o'),
(511,	'fa-futbol-o'),
(512,	'fa-tty'),
(513,	'fa-binoculars'),
(514,	'fa-plug'),
(515,	'fa-slideshare'),
(516,	'fa-twitch'),
(517,	'fa-yelp'),
(518,	'fa-newspaper-o'),
(519,	'fa-wifi'),
(520,	'fa-calculator'),
(521,	'fa-paypal'),
(522,	'fa-google-wallet'),
(523,	'fa-cc-visa'),
(524,	'fa-cc-mastercard'),
(525,	'fa-cc-discover'),
(526,	'fa-cc-amex'),
(527,	'fa-cc-paypal'),
(528,	'fa-cc-stripe'),
(529,	'fa-bell-slash'),
(530,	'fa-bell-slash-o'),
(531,	'fa-trash'),
(532,	'fa-copyright'),
(533,	'fa-at'),
(534,	'fa-eyedropper'),
(535,	'fa-paint-brush'),
(536,	'fa-birthday-cake'),
(537,	'fa-area-chart'),
(538,	'fa-pie-chart'),
(539,	'fa-line-chart'),
(540,	'fa-lastfm'),
(541,	'fa-lastfm-square'),
(542,	'fa-toggle-off'),
(543,	'fa-toggle-on'),
(544,	'fa-bicycle'),
(545,	'fa-bus'),
(546,	'fa-ioxhost'),
(547,	'fa-angellist'),
(548,	'fa-cc za'),
(549,	'fa-shekel'),
(550,	'fa-sheqel'),
(551,	'fa-ils'),
(552,	'fa-meanpath'),
(553,	'fa-buysellads'),
(554,	'fa-connectdevelop'),
(555,	'fa-dashcube'),
(556,	'fa-forumbee'),
(557,	'fa-leanpub'),
(558,	'fa-sellsy'),
(559,	'fa-shirtsinbulk'),
(560,	'fa-simplybuilt'),
(561,	'fa-skyatlas'),
(562,	'fa-cart-plus'),
(563,	'fa-cart-arrow-down'),
(564,	'fa-diamond'),
(565,	'fa-ship'),
(566,	'fa-user-secret'),
(567,	'fa-motorcycle'),
(568,	'fa-street-view'),
(569,	'fa-heartbeat'),
(570,	'fa-venus'),
(571,	'fa-mars'),
(572,	'fa-mercury'),
(573,	'fa-transgender'),
(574,	'fa-transgender-alt'),
(575,	'fa-venus-double'),
(576,	'fa-mars-double'),
(577,	'fa-venus-mars'),
(578,	'fa-mars-stroke'),
(579,	'fa-mars-stroke-v'),
(580,	'fa-mars-stroke-h'),
(581,	'fa-neuter'),
(582,	'fa-facebook-official'),
(583,	'fa-pinterest-p'),
(584,	'fa-whatsapp'),
(585,	'fa-server'),
(586,	'fa-user-plus'),
(587,	'fa-user-times'),
(588,	'fa-hotel'),
(589,	'fa-bed'),
(590,	'fa-viacoin'),
(591,	'fa-train'),
(592,	'fa-subway'),
(593,	'fa-medium');

DROP TABLE IF EXISTS `sysmods`;
CREATE TABLE `sysmods` (
  `id` int(2) NOT NULL,
  `appid` varchar(10) NOT NULL,
  `modname` varchar(30) NOT NULL,
  `modpos` int(2) DEFAULT NULL,
  `modicon` varchar(20) DEFAULT NULL,
  `parentid` int(5) DEFAULT NULL,
  `modkey` varchar(100) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `modcont` varchar(100) DEFAULT NULL,
  `modview` varchar(100) DEFAULT NULL,
  `mnutype` varchar(5) DEFAULT NULL,
  `iconclr` varchar(20) DEFAULT NULL,
  `vars` longtext NOT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`appid`,`id`),
  UNIQUE KEY `idx_pk` (`appid`,`id`),
  FULLTEXT KEY `idx_search` (`appid`,`modname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sysmods` (`id`, `appid`, `modname`, `modpos`, `modicon`, `parentid`, `modkey`, `active`, `modcont`, `modview`, `mnutype`, `iconclr`, `vars`, `audituser`, `auditdate`, `audittime`, `auditip`) VALUES
(209,	'CA',	'Clients',	1,	'fa-group',	0,	NULL,	1,	NULL,	NULL,	'dga',	'blue',	'',	'1',	'2017-08-19',	1503135569,	'127.0.0.1'),
(210,	'CA',	'Sign Ups',	1,	'fa-users',	209,	NULL,	1,	'Signups',	NULL,	'cmd',	'blue',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjEwIjtzOjc6Im1vZGNvbnQiO3M6NzoiU2lnbnVwcyI7fQ==',	'1',	'2017-08-30',	1504113222,	'127.0.0.1'),
(211,	'CA',	'Companies',	2,	'fa-building-o',	209,	NULL,	1,	'Companies',	NULL,	'cmd',	'green',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjExIjtzOjc6Im1vZGNvbnQiO3M6OToiQ29tcGFuaWVzIjt9',	'1',	'2017-08-30',	1504113230,	'127.0.0.1'),
(226,	'RG',	'Settings',	1,	'fa-wrench',	0,	NULL,	1,	NULL,	NULL,	'dga',	'0',	'',	NULL,	'2018-02-19',	1519058525,	'127.0.0.1'),
(228,	'RG',	'Apply As',	5,	'fa-user-secret',	226,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToxNzp7czo0OiJtbmlkIjtzOjM6IjIyOCI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjc6ImFwcGx5YXMiO3M6MTM6InRhYmxlX2RhdGFzcmMiO3M6NzoiYXBwbHlhcyI7czoxNDoiY2hrX2J1dHRvbl9hZGQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9lZGl0IjtzOjE6IjEiO3M6MTU6ImNoa19idXR0b25fc2F2ZSI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2RlbGV0ZSI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2ltcG9ydCI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2V4cG9ydCI7czoxOiIxIjtzOjE1OiJwcmltYXJ5X2tleV9jb2wiO3M6MjoiaWQiO3M6NToiYWxpYXMiO2E6Mjp7czo2OiJhc2NvZGUiO3M6NjoiZGN0a2F0IjtzOjY6ImFzbmFtZSI7czo2OiJwZnZoeW0iO31zOjU6InRpdGxlIjthOjI6e3M6NjoiYXNjb2RlIjtzOjQ6IkNvZGUiO3M6NjoiYXNuYW1lIjtzOjExOiJEZXNjcmlwdGlvbiI7fXM6NzoidmlzaWJsZSI7YToyOntzOjY6ImFzY29kZSI7czoxOiIxIjtzOjY6ImFzbmFtZSI7czoxOiIxIjt9czo4OiJyZXF1aXJlZCI7YToyOntzOjY6ImFzY29kZSI7czoxOiIxIjtzOjY6ImFzbmFtZSI7czoxOiIxIjt9czoxNjoiZm9ybWlucHV0X2FzY29kZSI7czo0OiJ0ZXh0IjtzOjE2OiJmb3JtaW5wdXRfYXNuYW1lIjtzOjQ6InRleHQiO30=',	'2',	'2019-01-08',	1546930708,	'127.0.0.1'),
(231,	'RG',	'ABS',	3,	'fa-pencil-square',	0,	NULL,	1,	'datacrud',	NULL,	'dga',	'greenDark',	'YToxNzp7czo0OiJtbmlkIjtzOjM6IjIzMSI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjEyOiJhcHByb3Zlc3RlcHMiO3M6MTM6InRhYmxlX2RhdGFzcmMiO3M6MTI6ImFwcHJvdmVzdGVwcyI7czoxNDoiY2hrX2J1dHRvbl9hZGQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9lZGl0IjtzOjE6IjEiO3M6MTU6ImNoa19idXR0b25fc2F2ZSI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2RlbGV0ZSI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2ltcG9ydCI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2V4cG9ydCI7czoxOiIxIjtzOjE1OiJwcmltYXJ5X2tleV9jb2wiO3M6MjoiaWQiO3M6NToiYWxpYXMiO2E6Mjp7czo2OiJzdGVwbm8iO3M6NjoidXJrc3ZlIjtzOjg6InN0ZXBuYW1lIjtzOjY6Im9pbnFibCI7fXM6NToidGl0bGUiO2E6Mjp7czo2OiJzdGVwbm8iO3M6NzoiU3RlcCBObyI7czo4OiJzdGVwbmFtZSI7czo5OiJTdGVwIE5hbWUiO31zOjc6InZpc2libGUiO2E6Mjp7czo2OiJzdGVwbm8iO3M6MToiMSI7czo4OiJzdGVwbmFtZSI7czoxOiIxIjt9czo4OiJyZXF1aXJlZCI7YToyOntzOjY6InN0ZXBubyI7czoxOiIxIjtzOjg6InN0ZXBuYW1lIjtzOjE6IjEiO31zOjE2OiJmb3JtaW5wdXRfc3RlcG5vIjtzOjQ6InRleHQiO3M6MTg6ImZvcm1pbnB1dF9zdGVwbmFtZSI7czo0OiJ0ZXh0Ijt9',	'3',	'2018-03-01',	1519890417,	'127.0.0.1'),
(234,	'RG',	'Applications',	2,	'fa-folder-open-o',	231,	NULL,	1,	'Workflow',	NULL,	'cmd',	'greenLight',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjM0IjtzOjc6Im1vZGNvbnQiO3M6ODoiV29ya2Zsb3ciO30=',	'3',	'2018-03-01',	1519892774,	'127.0.0.1'),
(235,	'RG',	'Purposes',	5,	'fa-list',	226,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToxNzp7czo0OiJtbmlkIjtzOjM6IjIzNSI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjg6InB1cnBvc2VzIjtzOjEzOiJ0YWJsZV9kYXRhc3JjIjtzOjg6InB1cnBvc2VzIjtzOjE0OiJjaGtfYnV0dG9uX2FkZCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX2VkaXQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9zYXZlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZGVsZXRlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25faW1wb3J0IjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZXhwb3J0IjtzOjE6IjEiO3M6MTU6InByaW1hcnlfa2V5X2NvbCI7czoyOiJpZCI7czo1OiJhbGlhcyI7YToyOntzOjc6InB1cGNvZGUiO3M6NjoiaGlvenluIjtzOjc6InB1cG5hbWUiO3M6NjoiY2VldWl3Ijt9czo1OiJ0aXRsZSI7YToyOntzOjc6InB1cGNvZGUiO3M6NDoiQ29kZSI7czo3OiJwdXBuYW1lIjtzOjc6IlB1cnBvc2UiO31zOjc6InZpc2libGUiO2E6Mjp7czo3OiJwdXBjb2RlIjtzOjE6IjEiO3M6NzoicHVwbmFtZSI7czoxOiIxIjt9czo4OiJyZXF1aXJlZCI7YToyOntzOjc6InB1cGNvZGUiO3M6MToiMSI7czo3OiJwdXBuYW1lIjtzOjE6IjEiO31zOjE3OiJmb3JtaW5wdXRfcHVwY29kZSI7czo0OiJ0ZXh0IjtzOjE3OiJmb3JtaW5wdXRfcHVwbmFtZSI7czo0OiJ0ZXh0Ijt9',	'3',	'2018-03-01',	1519891547,	'127.0.0.1'),
(236,	'RG',	'Countries',	20,	'fa-globe',	226,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToyNDp7czo0OiJtbmlkIjtzOjM6IjIzNiI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjk6ImNvdW50cmllcyI7czoxMzoidGFibGVfZGF0YXNyYyI7czoxMzoidmlld2NvdW50cmllcyI7czoxNDoiY2hrX2J1dHRvbl9hZGQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9lZGl0IjtzOjE6IjEiO3M6MTU6ImNoa19idXR0b25fc2F2ZSI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2RlbGV0ZSI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2ltcG9ydCI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2V4cG9ydCI7czoxOiIxIjtzOjE1OiJwcmltYXJ5X2tleV9jb2wiO3M6NzoiY3RuY29kZSI7czo1OiJhbGlhcyI7YTo4OntzOjc6ImN0bmNvZGUiO3M6NjoiYnFmaHpsIjtzOjExOiJjdG5jb2RlaXNvMyI7czo2OiJnc2pwdmYiO3M6NzoiY3RubmFtZSI7czo2OiJpbXN5ZmoiO3M6NzoibmF0Y29kZSI7czo2OiJicW54aG8iO3M6NzoibnRubmFtZSI7czo2OiJzeWNzenYiO3M6MTA6InJlZ2lvbmNvZGUiO3M6NjoieHBob2t5IjtzOjEwOiJyZWdpb25uYW1lIjtzOjY6ImFkZGphYiI7czo5OiJpc2RlZmF1bHQiO3M6Njoib2V0YWFvIjt9czo1OiJ0aXRsZSI7YTo4OntzOjc6ImN0bmNvZGUiO3M6MTI6IkNvdW50cnkgQ29kZSI7czoxMToiY3RuY29kZWlzbzMiO3M6NDoiSVNPMyI7czo3OiJjdG5uYW1lIjtzOjEyOiJDb3VudHJ5IE5hbWUiO3M6NzoibmF0Y29kZSI7czoxMToiTmF0aW9uYWxpdHkiO3M6NzoibnRubmFtZSI7czoxMToiTmF0aW9uYWxpdHkiO3M6MTA6InJlZ2lvbmNvZGUiO3M6NjoiUmVnaW9uIjtzOjEwOiJyZWdpb25uYW1lIjtzOjY6IlJlZ2lvbiI7czo5OiJpc2RlZmF1bHQiO3M6MTM6IkhvbWUgQ291bnRyeT8iO31zOjc6InZpc2libGUiO2E6ODp7czo3OiJjdG5jb2RlIjtzOjE6IjEiO3M6MTE6ImN0bmNvZGVpc28zIjtzOjE6IjEiO3M6NzoiY3RubmFtZSI7czoxOiIxIjtzOjc6Im5hdGNvZGUiO3M6MToiNCI7czo3OiJudG5uYW1lIjtzOjE6IjQiO3M6MTA6InJlZ2lvbmNvZGUiO3M6MToiMyI7czoxMDoicmVnaW9ubmFtZSI7czoxOiIyIjtzOjk6ImlzZGVmYXVsdCI7czoxOiIxIjt9czo4OiJyZXF1aXJlZCI7YTo4OntzOjc6ImN0bmNvZGUiO3M6MToiMSI7czoxMToiY3RuY29kZWlzbzMiO3M6MToiMSI7czo3OiJjdG5uYW1lIjtzOjE6IjEiO3M6NzoibmF0Y29kZSI7czoxOiIxIjtzOjc6Im50bm5hbWUiO3M6MToiMSI7czoxMDoicmVnaW9uY29kZSI7czoxOiIxIjtzOjEwOiJyZWdpb25uYW1lIjtzOjE6IjEiO3M6OToiaXNkZWZhdWx0IjtzOjE6IjEiO31zOjE3OiJmb3JtaW5wdXRfY3RuY29kZSI7czo0OiJ0ZXh0IjtzOjIxOiJmb3JtaW5wdXRfY3RuY29kZWlzbzMiO3M6NDoidGV4dCI7czoxNzoiZm9ybWlucHV0X2N0bm5hbWUiO3M6NDoidGV4dCI7czoxNzoiZm9ybWlucHV0X25hdGNvZGUiO3M6NDoidGV4dCI7czoxNzoiZm9ybWlucHV0X250bm5hbWUiO3M6NDoidGV4dCI7czoyMDoiZm9ybWlucHV0X3JlZ2lvbmNvZGUiO3M6Njoic2VsZWN0IjtzOjIwOiJmb3JtaW5wdXRfcmVnaW9ubmFtZSI7czo0OiJ0ZXh0IjtzOjE5OiJmb3JtaW5wdXRfaXNkZWZhdWx0IjtzOjg6ImNoZWNrYm94IjtzOjc6InNlbGVjdHMiO2E6MTp7czoxMDoicmVnaW9uY29kZSI7YTozOntzOjU6InRhYmxlIjtzOjE0OiJjb3VudHJ5cmVnaW9ucyI7czo4OiJjb2xfY29kZSI7czoxMDoicmVnaW9uY29kZSI7czo4OiJjb2xfbmFtZSI7czoxMDoicmVnaW9ubmFtZSI7fX19',	NULL,	'2019-01-18',	1547825318,	'127.0.0.1'),
(237,	'RG',	'UCN List',	5,	'fa-list',	226,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToxNzp7czo0OiJtbmlkIjtzOjM6IjIzNyI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjg6Iml1Y25saXN0IjtzOjEzOiJ0YWJsZV9kYXRhc3JjIjtzOjg6Iml1Y25saXN0IjtzOjE0OiJjaGtfYnV0dG9uX2FkZCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX2VkaXQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9zYXZlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZGVsZXRlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25faW1wb3J0IjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZXhwb3J0IjtzOjE6IjEiO3M6MTU6InByaW1hcnlfa2V5X2NvbCI7czoyOiJpZCI7czo1OiJhbGlhcyI7YToyOntzOjg6Iml1Y25jb2RlIjtzOjY6Im9zcHRjciI7czo4OiJpdWNubmFtZSI7czo2OiJnbmpkcGoiO31zOjU6InRpdGxlIjthOjI6e3M6ODoiaXVjbmNvZGUiO3M6NDoiQ29kZSI7czo4OiJpdWNubmFtZSI7czoxOToiQ29uc2VydmF0aW9uIFN0YXR1cyI7fXM6NzoidmlzaWJsZSI7YToyOntzOjg6Iml1Y25jb2RlIjtzOjE6IjEiO3M6ODoiaXVjbm5hbWUiO3M6MToiMSI7fXM6ODoicmVxdWlyZWQiO2E6Mjp7czo4OiJpdWNuY29kZSI7czoxOiIxIjtzOjg6Iml1Y25uYW1lIjtzOjE6IjEiO31zOjE4OiJmb3JtaW5wdXRfaXVjbmNvZGUiO3M6NDoidGV4dCI7czoxODoiZm9ybWlucHV0X2l1Y25uYW1lIjtzOjQ6InRleHQiO30=',	'2',	'2020-03-11',	1583895492,	'127.0.0.1'),
(238,	'RG',	'Access',	0,	'fa-group',	0,	NULL,	1,	NULL,	NULL,	'dga',	'blue',	'',	'3',	'2018-03-01',	1519888109,	'127.0.0.1'),
(239,	'RG',	'User Groups',	2,	'fa-group',	238,	NULL,	1,	'datacrud',	NULL,	'dga',	'blueLight',	'YToxNzp7czo0OiJtbmlkIjtzOjM6IjIzOSI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjg6InN5c3JvbGVzIjtzOjEzOiJ0YWJsZV9kYXRhc3JjIjtzOjg6InN5c3JvbGVzIjtzOjE0OiJjaGtfYnV0dG9uX2FkZCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX2VkaXQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9zYXZlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZGVsZXRlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25faW1wb3J0IjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZXhwb3J0IjtzOjE6IjEiO3M6MTU6InByaW1hcnlfa2V5X2NvbCI7czo4OiJyb2xlY29kZSI7czo1OiJhbGlhcyI7YToyOntzOjg6InJvbGVjb2RlIjtzOjY6InZvemFuYiI7czo4OiJyb2xlbmFtZSI7czo2OiJwc3BzYWQiO31zOjU6InRpdGxlIjthOjI6e3M6ODoicm9sZWNvZGUiO3M6OToiUm9sZSBDb2RlIjtzOjg6InJvbGVuYW1lIjtzOjk6IlJvbGUgTmFtZSI7fXM6NzoidmlzaWJsZSI7YToyOntzOjg6InJvbGVjb2RlIjtzOjE6IjEiO3M6ODoicm9sZW5hbWUiO3M6MToiMSI7fXM6ODoicmVxdWlyZWQiO2E6Mjp7czo4OiJyb2xlY29kZSI7czoxOiIxIjtzOjg6InJvbGVuYW1lIjtzOjE6IjEiO31zOjE4OiJmb3JtaW5wdXRfcm9sZWNvZGUiO3M6NDoidGV4dCI7czoxODoiZm9ybWlucHV0X3JvbGVuYW1lIjtzOjQ6InRleHQiO30=',	'3',	'2018-03-02',	1519971091,	'127.0.0.1'),
(240,	'RG',	'Users',	1,	'fa-user',	238,	NULL,	1,	'Users',	NULL,	'cmd',	'blueLight',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjQwIjtzOjc6Im1vZGNvbnQiO3M6NToiVXNlcnMiO30=',	'3',	'2018-03-02',	1519971132,	'127.0.0.1'),
(241,	'RG',	'Privileges',	2,	'fa-check-square-o',	238,	NULL,	1,	'Priviledges',	NULL,	'cmd',	'blueDark',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjQxIjtzOjc6Im1vZGNvbnQiO3M6MTE6IlByaXZpbGVkZ2VzIjt9',	'3',	'2018-03-02',	1519970852,	'127.0.0.1'),
(242,	'RG',	'Routing (BEST)',	1,	'fa-paper-plane-o',	231,	NULL,	1,	'Routing',	NULL,	'cmd',	'blue',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjQyIjtzOjc6Im1vZGNvbnQiO3M6NzoiUm91dGluZyI7fQ==',	'6',	'2020-02-05',	1580889690,	'127.0.0.1'),
(243,	'RG',	'Research Types',	7,	'fa-list',	226,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToxNzp7czo0OiJtbmlkIjtzOjM6IjI0MyI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjEzOiJyZXNlYXJjaHR5cGVzIjtzOjEzOiJ0YWJsZV9kYXRhc3JjIjtzOjEzOiJyZXNlYXJjaHR5cGVzIjtzOjE0OiJjaGtfYnV0dG9uX2FkZCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX2VkaXQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9zYXZlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZGVsZXRlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25faW1wb3J0IjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZXhwb3J0IjtzOjE6IjEiO3M6MTU6InByaW1hcnlfa2V5X2NvbCI7czoyOiJpZCI7czo1OiJhbGlhcyI7YToyOntzOjg6InR5cGVjb2RlIjtzOjY6ImlvbHh1ayI7czo4OiJ0eXBlbmFtZSI7czo2OiJ5eWhpZmMiO31zOjU6InRpdGxlIjthOjI6e3M6ODoidHlwZWNvZGUiO3M6OToiVHlwZSBDb2RlIjtzOjg6InR5cGVuYW1lIjtzOjk6IlR5cGUgTmFtZSI7fXM6NzoidmlzaWJsZSI7YToyOntzOjg6InR5cGVjb2RlIjtzOjE6IjEiO3M6ODoidHlwZW5hbWUiO3M6MToiMSI7fXM6ODoicmVxdWlyZWQiO2E6Mjp7czo4OiJ0eXBlY29kZSI7czoxOiIxIjtzOjg6InR5cGVuYW1lIjtzOjE6IjEiO31zOjE4OiJmb3JtaW5wdXRfdHlwZWNvZGUiO3M6NDoidGV4dCI7czoxODoiZm9ybWlucHV0X3R5cGVuYW1lIjtzOjQ6InRleHQiO30=',	'3',	'2018-03-01',	1519890748,	'127.0.0.1'),
(244,	'RG',	'Resource Types',	6,	'fa-list',	226,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToxNzp7czo0OiJtbmlkIjtzOjM6IjI0NCI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjEzOiJyZXNvdXJjZXR5cGVzIjtzOjEzOiJ0YWJsZV9kYXRhc3JjIjtzOjEzOiJyZXNvdXJjZXR5cGVzIjtzOjE0OiJjaGtfYnV0dG9uX2FkZCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX2VkaXQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9zYXZlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZGVsZXRlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25faW1wb3J0IjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZXhwb3J0IjtzOjE6IjEiO3M6MTU6InByaW1hcnlfa2V5X2NvbCI7czoyOiJpZCI7czo1OiJhbGlhcyI7YToyOntzOjg6InR5cGVjb2RlIjtzOjY6Imp5bmp0dyI7czo4OiJ0eXBlbmFtZSI7czo2OiJqb2FmY3giO31zOjU6InRpdGxlIjthOjI6e3M6ODoidHlwZWNvZGUiO3M6OToiVHlwZSBDb2RlIjtzOjg6InR5cGVuYW1lIjtzOjk6IlR5cGUgTmFtZSI7fXM6NzoidmlzaWJsZSI7YToyOntzOjg6InR5cGVjb2RlIjtzOjE6IjEiO3M6ODoidHlwZW5hbWUiO3M6MToiMSI7fXM6ODoicmVxdWlyZWQiO2E6Mjp7czo4OiJ0eXBlY29kZSI7czoxOiIxIjtzOjg6InR5cGVuYW1lIjtzOjE6IjEiO31zOjE4OiJmb3JtaW5wdXRfdHlwZWNvZGUiO3M6NDoidGV4dCI7czoxODoiZm9ybWlucHV0X3R5cGVuYW1lIjtzOjQ6InRleHQiO30=',	'3',	'2018-03-01',	1519890727,	'127.0.0.1'),
(245,	'RG',	'Units of Measure',	8,	'fa-list',	226,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToxNzp7czo0OiJtbmlkIjtzOjM6IjI0NSI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjk6InNhbXBsZXVvbSI7czoxMzoidGFibGVfZGF0YXNyYyI7czo5OiJzYW1wbGV1b20iO3M6MTQ6ImNoa19idXR0b25fYWRkIjtzOjE6IjEiO3M6MTU6ImNoa19idXR0b25fZWRpdCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX3NhdmUiO3M6MToiMSI7czoxNzoiY2hrX2J1dHRvbl9kZWxldGUiO3M6MToiMSI7czoxNzoiY2hrX2J1dHRvbl9pbXBvcnQiO3M6MToiMSI7czoxNzoiY2hrX2J1dHRvbl9leHBvcnQiO3M6MToiMSI7czoxNToicHJpbWFyeV9rZXlfY29sIjtzOjI6ImlkIjtzOjU6ImFsaWFzIjthOjI6e3M6NzoidW9tY29kZSI7czo2OiJrd210aGciO3M6NzoidW9tbmFtZSI7czo2OiJhZGdxenIiO31zOjU6InRpdGxlIjthOjI6e3M6NzoidW9tY29kZSI7czo5OiJVbml0IENvZGUiO3M6NzoidW9tbmFtZSI7czo5OiJVbml0IE5hbWUiO31zOjc6InZpc2libGUiO2E6Mjp7czo3OiJ1b21jb2RlIjtzOjE6IjEiO3M6NzoidW9tbmFtZSI7czoxOiIxIjt9czo4OiJyZXF1aXJlZCI7YToyOntzOjc6InVvbWNvZGUiO3M6MToiMSI7czo3OiJ1b21uYW1lIjtzOjE6IjEiO31zOjE3OiJmb3JtaW5wdXRfdW9tY29kZSI7czo0OiJ0ZXh0IjtzOjE3OiJmb3JtaW5wdXRfdW9tbmFtZSI7czo0OiJ0ZXh0Ijt9',	'3',	'2018-03-01',	1519890774,	'127.0.0.1'),
(246,	'RG',	'Researchers',	0,	'fa-group',	231,	NULL,	1,	'Researchers',	NULL,	'cmd',	'blueDark',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjQ2IjtzOjc6Im1vZGNvbnQiO3M6MTE6IlJlc2VhcmNoZXJzIjt9',	'2',	'2019-01-07',	1546839192,	'127.0.0.1'),
(247,	'RG',	'Approval Steps',	4,	'fa-list',	226,	NULL,	1,	'ApprovalSteps',	NULL,	'cmd',	'0',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjQ3IjtzOjc6Im1vZGNvbnQiO3M6MTM6IkFwcHJvdmFsU3RlcHMiO30=',	'2',	'2019-01-08',	1546925477,	'127.0.0.1'),
(248,	'RG',	'Institution Users',	4,	'fa-group',	238,	NULL,	1,	'InstitutionUsers',	NULL,	'cmd',	'0',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjQ4IjtzOjc6Im1vZGNvbnQiO3M6MTY6Ikluc3RpdHV0aW9uVXNlcnMiO30=',	'3',	'2018-03-02',	1519971508,	'127.0.0.1'),
(249,	'RG',	'Licencing Institutions',	2,	'fa-building',	226,	NULL,	1,	'Institutions',	NULL,	'cmd',	'0',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjQ5IjtzOjc6Im1vZGNvbnQiO3M6MTI6Ikluc3RpdHV0aW9ucyI7fQ==',	'2',	'2019-01-21',	1548043100,	'127.0.0.1'),
(250,	'RG',	'ABS Required Docs',	20,	'fa-folder-open',	226,	NULL,	1,	'datacrud',	NULL,	'dga',	'orange',	'YToxNzp7czo0OiJtbmlkIjtzOjM6IjI1MCI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjExOiJyZXF1aXJlZG9jcyI7czoxMzoidGFibGVfZGF0YXNyYyI7czoxMToicmVxdWlyZWRvY3MiO3M6MTQ6ImNoa19idXR0b25fYWRkIjtzOjE6IjEiO3M6MTU6ImNoa19idXR0b25fZWRpdCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX3NhdmUiO3M6MToiMSI7czoxNzoiY2hrX2J1dHRvbl9kZWxldGUiO3M6MToiMSI7czoxNzoiY2hrX2J1dHRvbl9pbXBvcnQiO3M6MToiMSI7czoxNzoiY2hrX2J1dHRvbl9leHBvcnQiO3M6MToiMSI7czoxNToicHJpbWFyeV9rZXlfY29sIjtzOjI6ImlkIjtzOjU6ImFsaWFzIjthOjI6e3M6NzoiZG9jbmFtZSI7czo2OiJmcXdvZmEiO3M6MTE6ImRvY3RlbXBsYXRlIjtzOjY6Im1rcW96cyI7fXM6NToidGl0bGUiO2E6Mjp7czo3OiJkb2NuYW1lIjtzOjg6IkRvYyBOYW1lIjtzOjExOiJkb2N0ZW1wbGF0ZSI7czo4OiJUZW1wbGF0ZSI7fXM6NzoidmlzaWJsZSI7YToyOntzOjc6ImRvY25hbWUiO3M6MToiMSI7czoxMToiZG9jdGVtcGxhdGUiO3M6MToiMSI7fXM6ODoicmVxdWlyZWQiO2E6Mjp7czo3OiJkb2NuYW1lIjtzOjE6IjEiO3M6MTE6ImRvY3RlbXBsYXRlIjtzOjE6IjEiO31zOjE3OiJmb3JtaW5wdXRfZG9jbmFtZSI7czo0OiJ0ZXh0IjtzOjIxOiJmb3JtaW5wdXRfZG9jdGVtcGxhdGUiO3M6NDoidGV4dCI7fQ==',	'2',	'2018-04-12',	1523507404,	'41.220.229.26'),
(251,	'RG',	'Email Templates',	1,	'fa-cog',	226,	NULL,	1,	NULL,	NULL,	'dga',	'0',	'',	'2',	'2018-11-01',	1541086163,	'127.0.0.1'),
(252,	'RG',	'Variables',	1,	'',	251,	NULL,	1,	'datacrud',	NULL,	'dga',	'blueDark',	'YToxNzp7czo0OiJtbmlkIjtzOjM6IjI1MiI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjEzOiJldGVtcGxhdGV2YXJzIjtzOjEzOiJ0YWJsZV9kYXRhc3JjIjtzOjEzOiJldGVtcGxhdGV2YXJzIjtzOjE0OiJjaGtfYnV0dG9uX2FkZCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX2VkaXQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9zYXZlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZGVsZXRlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25faW1wb3J0IjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZXhwb3J0IjtzOjE6IjEiO3M6MTU6InByaW1hcnlfa2V5X2NvbCI7czo1OiJjb2xubyI7czo1OiJhbGlhcyI7YToyOntzOjU6ImNvbG5vIjtzOjY6ImNrdnB6ZyI7czo3OiJjb2xkZXNjIjtzOjY6ImZqdGR5cyI7fXM6NToidGl0bGUiO2E6Mjp7czo1OiJjb2xubyI7czo2OiJDb2x1bW4iO3M6NzoiY29sZGVzYyI7czoxMToiRGVzY3JpcHRpb24iO31zOjc6InZpc2libGUiO2E6Mjp7czo1OiJjb2xubyI7czoxOiIxIjtzOjc6ImNvbGRlc2MiO3M6MToiMSI7fXM6ODoicmVxdWlyZWQiO2E6Mjp7czo1OiJjb2xubyI7czoxOiIxIjtzOjc6ImNvbGRlc2MiO3M6MToiMSI7fXM6MTU6ImZvcm1pbnB1dF9jb2xubyI7czo0OiJ0ZXh0IjtzOjE3OiJmb3JtaW5wdXRfY29sZGVzYyI7czo0OiJ0ZXh0Ijt9',	'2',	'2018-11-01',	1541086578,	'127.0.0.1'),
(253,	'RG',	'Templates',	2,	'',	251,	NULL,	1,	'EmailTemplates',	NULL,	'cmd',	'blueDark',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjUzIjtzOjc6Im1vZGNvbnQiO3M6MTQ6IkVtYWlsVGVtcGxhdGVzIjt9',	'2',	'2018-11-01',	1541086648,	'127.0.0.1'),
(254,	'RG',	'Setup',	4,	'',	251,	NULL,	1,	'ApplicationsConfig',	NULL,	'cmd',	'blueDark',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjU0IjtzOjc6Im1vZGNvbnQiO3M6MTg6IkFwcGxpY2F0aW9uc0NvbmZpZyI7fQ==',	'2',	'2018-12-13',	1544719127,	'127.0.0.1'),
(256,	'RG',	'Payments',	10,	'',	226,	NULL,	1,	NULL,	NULL,	'dga',	'0',	'',	NULL,	'2019-01-07',	1546844548,	'127.0.0.1'),
(257,	'RG',	'Banks',	1,	'',	256,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToxOTp7czo0OiJtbmlkIjtzOjM6IjI1NyI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjU6ImJhbmtzIjtzOjEzOiJ0YWJsZV9kYXRhc3JjIjtzOjU6ImJhbmtzIjtzOjE0OiJjaGtfYnV0dG9uX2FkZCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX2VkaXQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9zYXZlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZGVsZXRlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25faW1wb3J0IjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZXhwb3J0IjtzOjE6IjEiO3M6MTU6InByaW1hcnlfa2V5X2NvbCI7czo4OiJiYW5rY29kZSI7czo1OiJhbGlhcyI7YTo0OntzOjg6ImJhbmtjb2RlIjtzOjY6InVvaWhocyI7czo4OiJiYW5rbmFtZSI7czo2OiJ2ZmdpeHAiO3M6OToic3dpZnRjb2RlIjtzOjY6ImN1dXh5diI7czo2OiJoYXNlZnQiO3M6NjoicHRqZmtrIjt9czo1OiJ0aXRsZSI7YTo0OntzOjg6ImJhbmtjb2RlIjtzOjk6IkJhbmsgY29kZSI7czo4OiJiYW5rbmFtZSI7czo5OiJCYW5rIG5hbWUiO3M6OToic3dpZnRjb2RlIjtzOjEwOiJTd2lmdCBjb2RlIjtzOjY6Imhhc2VmdCI7czo2OiJIYXNlZnQiO31zOjc6InZpc2libGUiO2E6NDp7czo4OiJiYW5rY29kZSI7czoxOiIxIjtzOjg6ImJhbmtuYW1lIjtzOjE6IjEiO3M6OToic3dpZnRjb2RlIjtzOjE6IjEiO3M6NjoiaGFzZWZ0IjtzOjE6IjQiO31zOjg6InJlcXVpcmVkIjthOjQ6e3M6ODoiYmFua2NvZGUiO3M6MToiMSI7czo4OiJiYW5rbmFtZSI7czoxOiIxIjtzOjk6InN3aWZ0Y29kZSI7czoxOiIwIjtzOjY6Imhhc2VmdCI7czoxOiIwIjt9czoxODoiZm9ybWlucHV0X2Jhbmtjb2RlIjtzOjQ6InRleHQiO3M6MTg6ImZvcm1pbnB1dF9iYW5rbmFtZSI7czo0OiJ0ZXh0IjtzOjE5OiJmb3JtaW5wdXRfc3dpZnRjb2RlIjtzOjQ6InRleHQiO3M6MTY6ImZvcm1pbnB1dF9oYXNlZnQiO3M6NDoidGV4dCI7fQ==',	'2',	'2018-12-14',	1544751176,	'127.0.0.1'),
(258,	'RG',	'Bank Branch',	2,	'',	256,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToyMjp7czo0OiJtbmlkIjtzOjM6IjI1OCI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjEwOiJiYW5rYnJhbmNoIjtzOjEzOiJ0YWJsZV9kYXRhc3JjIjtzOjE2OiJ2aWV3YmFua2JyYW5jaGVzIjtzOjE0OiJjaGtfYnV0dG9uX2FkZCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX2VkaXQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9zYXZlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZGVsZXRlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25faW1wb3J0IjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZXhwb3J0IjtzOjE6IjEiO3M6MTU6InByaW1hcnlfa2V5X2NvbCI7czoxMDoiYnJhbmNoY29kZSI7czo1OiJhbGlhcyI7YTo2OntzOjEwOiJicmFuY2hjb2RlIjtzOjY6InhnYWhtYiI7czoxMDoiYnJhbmNobmFtZSI7czo2OiJrYXp0ZGYiO3M6ODoiYmFua2NvZGUiO3M6Njoia2ljZGd4IjtzOjg6ImJhbmtuYW1lIjtzOjY6ImZlY2FidCI7czo5OiJzd2lmdGNvZGUiO3M6NjoicWp0YnZ6IjtzOjY6Imhhc2VmdCI7czo2OiJvcGRzbmYiO31zOjU6InRpdGxlIjthOjY6e3M6MTA6ImJyYW5jaGNvZGUiO3M6MTE6IkJyYW5jaCBjb2RlIjtzOjEwOiJicmFuY2huYW1lIjtzOjExOiJCcmFuY2ggbmFtZSI7czo4OiJiYW5rY29kZSI7czo1OiJCYW5rICI7czo4OiJiYW5rbmFtZSI7czo1OiJCYW5rICI7czo5OiJzd2lmdGNvZGUiO3M6OToiU3dpZnRjb2RlIjtzOjY6Imhhc2VmdCI7czo2OiJIYXNlZnQiO31zOjc6InZpc2libGUiO2E6Njp7czoxMDoiYnJhbmNoY29kZSI7czoxOiIxIjtzOjEwOiJicmFuY2huYW1lIjtzOjE6IjEiO3M6ODoiYmFua2NvZGUiO3M6MToiMSI7czo4OiJiYW5rbmFtZSI7czoxOiIyIjtzOjk6InN3aWZ0Y29kZSI7czoxOiI0IjtzOjY6Imhhc2VmdCI7czoxOiI0Ijt9czo4OiJyZXF1aXJlZCI7YTo2OntzOjEwOiJicmFuY2hjb2RlIjtzOjE6IjEiO3M6MTA6ImJyYW5jaG5hbWUiO3M6MToiMSI7czo4OiJiYW5rY29kZSI7czoxOiIxIjtzOjg6ImJhbmtuYW1lIjtzOjE6IjEiO3M6OToic3dpZnRjb2RlIjtzOjE6IjEiO3M6NjoiaGFzZWZ0IjtzOjE6IjEiO31zOjIwOiJmb3JtaW5wdXRfYnJhbmNoY29kZSI7czo0OiJ0ZXh0IjtzOjIwOiJmb3JtaW5wdXRfYnJhbmNobmFtZSI7czo0OiJ0ZXh0IjtzOjE4OiJmb3JtaW5wdXRfYmFua2NvZGUiO3M6Njoic2VsZWN0IjtzOjE4OiJmb3JtaW5wdXRfYmFua25hbWUiO3M6NDoidGV4dCI7czoxOToiZm9ybWlucHV0X3N3aWZ0Y29kZSI7czo0OiJ0ZXh0IjtzOjE2OiJmb3JtaW5wdXRfaGFzZWZ0IjtzOjQ6InRleHQiO3M6Nzoic2VsZWN0cyI7YToxOntzOjg6ImJhbmtjb2RlIjthOjM6e3M6NToidGFibGUiO3M6NToiYmFua3MiO3M6ODoiY29sX2NvZGUiO3M6ODoiYmFua2NvZGUiO3M6ODoiY29sX25hbWUiO3M6ODoiYmFua25hbWUiO319fQ==',	'2',	'2018-12-14',	1544751236,	'127.0.0.1'),
(259,	'RG',	'Bank Accounts',	3,	'',	256,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToyNzp7czo0OiJtbmlkIjtzOjM6IjI1OSI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjEyOiJiYW5rYWNjb3VudHMiO3M6MTM6InRhYmxlX2RhdGFzcmMiO3M6MTY6InZpZXdiYW5rYWNjb3VudHMiO3M6MTQ6ImNoa19idXR0b25fYWRkIjtzOjE6IjEiO3M6MTU6ImNoa19idXR0b25fZWRpdCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX3NhdmUiO3M6MToiMSI7czoxNzoiY2hrX2J1dHRvbl9kZWxldGUiO3M6MToiMSI7czoxNzoiY2hrX2J1dHRvbl9pbXBvcnQiO3M6MToiMSI7czoxNzoiY2hrX2J1dHRvbl9leHBvcnQiO3M6MToiMSI7czoxNToicHJpbWFyeV9rZXlfY29sIjtzOjEwOiJicmFuY2hjb2RlIjtzOjU6ImFsaWFzIjthOjExOntzOjg6Imluc3Rjb2RlIjtzOjY6Im1wZWx1YyI7czo4OiJpbnN0bmFtZSI7czo2OiJjdGF2ZWkiO3M6ODoiY3VycmNvZGUiO3M6NjoiZGRxcWVrIjtzOjg6ImN1cnJuYW1lIjtzOjY6InZjaWd3ZSI7czo5OiJhY2NvdW50bm8iO3M6NjoidWxpeGZ6IjtzOjExOiJhY2NvdW50bmFtZSI7czo2OiJvZHVyY3ciO3M6ODoiYmFua2NvZGUiO3M6NjoieW5qaXVxIjtzOjg6ImJhbmtuYW1lIjtzOjY6Im1mbnh3byI7czoxMDoiYnJhbmNoY29kZSI7czo2OiJ4ZXhnbnkiO3M6MTA6ImJyYW5jaG5hbWUiO3M6NjoidWt5enBhIjtzOjk6InN3aWZ0Y29kZSI7czo2OiJ5aWN3ZW0iO31zOjU6InRpdGxlIjthOjExOntzOjg6Imluc3Rjb2RlIjtzOjExOiJJbnN0aXR1dGlvbiI7czo4OiJpbnN0bmFtZSI7czoxMToiSW5zdGl0dXRpb24iO3M6ODoiY3VycmNvZGUiO3M6ODoiQ3VycmVuY3kiO3M6ODoiY3Vycm5hbWUiO3M6ODoiQ3VycmVuY3kiO3M6OToiYWNjb3VudG5vIjtzOjEwOiJBY2NvdW50IE5vIjtzOjExOiJhY2NvdW50bmFtZSI7czoxMjoiQWNjb3VudCBOYW1lIjtzOjg6ImJhbmtjb2RlIjtzOjk6IkJhbmsgY29kZSI7czo4OiJiYW5rbmFtZSI7czo5OiJCYW5rIG5hbWUiO3M6MTA6ImJyYW5jaGNvZGUiO3M6MTE6IkJyYW5jaCBjb2RlIjtzOjEwOiJicmFuY2huYW1lIjtzOjExOiJCcmFuY2ggbmFtZSI7czo5OiJzd2lmdGNvZGUiO3M6MTA6IlN3aWZ0IGNvZGUiO31zOjc6InZpc2libGUiO2E6MTE6e3M6ODoiaW5zdGNvZGUiO3M6MToiMyI7czo4OiJpbnN0bmFtZSI7czoxOiIyIjtzOjg6ImN1cnJjb2RlIjtzOjE6IjMiO3M6ODoiY3Vycm5hbWUiO3M6MToiMiI7czo5OiJhY2NvdW50bm8iO3M6MToiMSI7czoxMToiYWNjb3VudG5hbWUiO3M6MToiMSI7czo4OiJiYW5rY29kZSI7czoxOiI0IjtzOjg6ImJhbmtuYW1lIjtzOjE6IjQiO3M6MTA6ImJyYW5jaGNvZGUiO3M6MToiMyI7czoxMDoiYnJhbmNobmFtZSI7czoxOiIyIjtzOjk6InN3aWZ0Y29kZSI7czoxOiI0Ijt9czo4OiJyZXF1aXJlZCI7YToxMTp7czo4OiJpbnN0Y29kZSI7czoxOiIxIjtzOjg6Imluc3RuYW1lIjtzOjE6IjEiO3M6ODoiY3VycmNvZGUiO3M6MToiMSI7czo4OiJjdXJybmFtZSI7czoxOiIxIjtzOjk6ImFjY291bnRubyI7czoxOiIxIjtzOjExOiJhY2NvdW50bmFtZSI7czoxOiIxIjtzOjg6ImJhbmtjb2RlIjtzOjE6IjEiO3M6ODoiYmFua25hbWUiO3M6MToiMSI7czoxMDoiYnJhbmNoY29kZSI7czoxOiIxIjtzOjEwOiJicmFuY2huYW1lIjtzOjE6IjEiO3M6OToic3dpZnRjb2RlIjtzOjE6IjEiO31zOjE4OiJmb3JtaW5wdXRfaW5zdGNvZGUiO3M6Njoic2VsZWN0IjtzOjE4OiJmb3JtaW5wdXRfaW5zdG5hbWUiO3M6NDoidGV4dCI7czoxODoiZm9ybWlucHV0X2N1cnJjb2RlIjtzOjY6InNlbGVjdCI7czoxODoiZm9ybWlucHV0X2N1cnJuYW1lIjtzOjQ6InRleHQiO3M6MTk6ImZvcm1pbnB1dF9hY2NvdW50bm8iO3M6NDoidGV4dCI7czoyMToiZm9ybWlucHV0X2FjY291bnRuYW1lIjtzOjQ6InRleHQiO3M6MTg6ImZvcm1pbnB1dF9iYW5rY29kZSI7czo2OiJzZWxlY3QiO3M6MTg6ImZvcm1pbnB1dF9iYW5rbmFtZSI7czo0OiJ0ZXh0IjtzOjIwOiJmb3JtaW5wdXRfYnJhbmNoY29kZSI7czo2OiJzZWxlY3QiO3M6MjA6ImZvcm1pbnB1dF9icmFuY2huYW1lIjtzOjQ6InRleHQiO3M6MTk6ImZvcm1pbnB1dF9zd2lmdGNvZGUiO3M6NDoidGV4dCI7czo3OiJzZWxlY3RzIjthOjQ6e3M6ODoiaW5zdGNvZGUiO2E6Mzp7czo1OiJ0YWJsZSI7czoxMjoiaW5zdGl0dXRpb25zIjtzOjg6ImNvbF9jb2RlIjtzOjg6Imluc3Rjb2RlIjtzOjg6ImNvbF9uYW1lIjtzOjg6Imluc3RuYW1lIjt9czo4OiJiYW5rY29kZSI7YTozOntzOjU6InRhYmxlIjtzOjU6ImJhbmtzIjtzOjg6ImNvbF9jb2RlIjtzOjg6ImJhbmtjb2RlIjtzOjg6ImNvbF9uYW1lIjtzOjg6ImJhbmtuYW1lIjt9czoxMDoiYnJhbmNoY29kZSI7YTozOntzOjU6InRhYmxlIjtzOjEwOiJiYW5rYnJhbmNoIjtzOjg6ImNvbF9jb2RlIjtzOjEwOiJicmFuY2hjb2RlIjtzOjg6ImNvbF9uYW1lIjtzOjEwOiJicmFuY2huYW1lIjt9czo4OiJjdXJyY29kZSI7YTozOntzOjU6InRhYmxlIjtzOjEwOiJjdXJyZW5jaWVzIjtzOjg6ImNvbF9jb2RlIjtzOjg6ImN1cnJjb2RlIjtzOjg6ImNvbF9uYW1lIjtzOjg6ImN1cnJuYW1lIjt9fX0=',	'2',	'2018-12-14',	1544751957,	'127.0.0.1'),
(260,	'RG',	'MPESA Payments',	4,	'',	256,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToxODp7czo0OiJtbmlkIjtzOjM6IjI2MCI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjEyOiJtcGVzYWFjY291bnQiO3M6MTM6InRhYmxlX2RhdGFzcmMiO3M6MTI6Im1wZXNhYWNjb3VudCI7czoxNDoiY2hrX2J1dHRvbl9hZGQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9lZGl0IjtzOjE6IjEiO3M6MTU6ImNoa19idXR0b25fc2F2ZSI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2RlbGV0ZSI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2ltcG9ydCI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2V4cG9ydCI7czoxOiIxIjtzOjE1OiJwcmltYXJ5X2tleV9jb2wiO3M6ODoiaW5zdGNvZGUiO3M6NToiYWxpYXMiO2E6Mjp7czo4OiJpbnN0Y29kZSI7czo2OiJua3RjaWgiO3M6OToicGF5YmlsbG5vIjtzOjY6ImhrZWFvbyI7fXM6NToidGl0bGUiO2E6Mjp7czo4OiJpbnN0Y29kZSI7czoxMToiSW5zdGl0dXRpb24iO3M6OToicGF5YmlsbG5vIjtzOjExOiJQYXkgQmlsbCBObyI7fXM6NzoidmlzaWJsZSI7YToyOntzOjg6Imluc3Rjb2RlIjtzOjE6IjEiO3M6OToicGF5YmlsbG5vIjtzOjE6IjEiO31zOjg6InJlcXVpcmVkIjthOjI6e3M6ODoiaW5zdGNvZGUiO3M6MToiMSI7czo5OiJwYXliaWxsbm8iO3M6MToiMSI7fXM6MTg6ImZvcm1pbnB1dF9pbnN0Y29kZSI7czo2OiJzZWxlY3QiO3M6MTk6ImZvcm1pbnB1dF9wYXliaWxsbm8iO3M6NDoidGV4dCI7czo3OiJzZWxlY3RzIjthOjE6e3M6ODoiaW5zdGNvZGUiO2E6Mzp7czo1OiJ0YWJsZSI7czoxMjoiaW5zdGl0dXRpb25zIjtzOjg6ImNvbF9jb2RlIjtzOjg6Imluc3Rjb2RlIjtzOjg6ImNvbF9uYW1lIjtzOjg6Imluc3RuYW1lIjt9fX0=',	'2',	'2018-12-14',	1544754557,	'127.0.0.1'),
(261,	'RG',	'Currencies',	0,	'',	256,	NULL,	1,	'datacrud',	NULL,	'dga',	'0',	'YToxODp7czo0OiJtbmlkIjtzOjM6IjI2MSI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjEwOiJjdXJyZW5jaWVzIjtzOjEzOiJ0YWJsZV9kYXRhc3JjIjtzOjEwOiJjdXJyZW5jaWVzIjtzOjE0OiJjaGtfYnV0dG9uX2FkZCI7czoxOiIxIjtzOjE1OiJjaGtfYnV0dG9uX2VkaXQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9zYXZlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZGVsZXRlIjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25faW1wb3J0IjtzOjE6IjEiO3M6MTc6ImNoa19idXR0b25fZXhwb3J0IjtzOjE6IjEiO3M6MTU6InByaW1hcnlfa2V5X2NvbCI7czo4OiJjdXJyY29kZSI7czo1OiJhbGlhcyI7YTozOntzOjg6ImN1cnJjb2RlIjtzOjY6Im53ZWJpcyI7czo4OiJjdXJybmFtZSI7czo2OiJmbHJwdW4iO3M6OToiaXNkZWZhdWx0IjtzOjY6Inh4eWViaCI7fXM6NToidGl0bGUiO2E6Mzp7czo4OiJjdXJyY29kZSI7czoxMzoiY3VycmVuY3kgY29kZSI7czo4OiJjdXJybmFtZSI7czoxMzoiY3VycmVuY3kgbmFtZSI7czo5OiJpc2RlZmF1bHQiO3M6MTc6IkRlZmF1bHQgQ3VycmVuY3k/Ijt9czo3OiJ2aXNpYmxlIjthOjM6e3M6ODoiY3VycmNvZGUiO3M6MToiMSI7czo4OiJjdXJybmFtZSI7czoxOiIxIjtzOjk6ImlzZGVmYXVsdCI7czoxOiIxIjt9czo4OiJyZXF1aXJlZCI7YTozOntzOjg6ImN1cnJjb2RlIjtzOjE6IjEiO3M6ODoiY3Vycm5hbWUiO3M6MToiMSI7czo5OiJpc2RlZmF1bHQiO3M6MToiMSI7fXM6MTg6ImZvcm1pbnB1dF9jdXJyY29kZSI7czo0OiJ0ZXh0IjtzOjE4OiJmb3JtaW5wdXRfY3Vycm5hbWUiO3M6NDoidGV4dCI7czoxOToiZm9ybWlucHV0X2lzZGVmYXVsdCI7czo4OiJjaGVja2JveCI7fQ==',	'2',	'2019-01-18',	1547812911,	'127.0.0.1'),
(262,	'RG',	'Research Institutions',	10,	'fa-building',	226,	NULL,	1,	'datacrud',	NULL,	'dga',	'blueLight',	'YToxOTp7czo0OiJtbmlkIjtzOjM6IjI2MiI7czo3OiJtb2Rjb250IjtzOjg6ImRhdGFjcnVkIjtzOjEzOiJ0YWJsZV9kYXRhdGJsIjtzOjEyOiJyZXNlYXJjaGluc3QiO3M6MTM6InRhYmxlX2RhdGFzcmMiO3M6MTI6InJlc2VhcmNoaW5zdCI7czoxNDoiY2hrX2J1dHRvbl9hZGQiO3M6MToiMSI7czoxNToiY2hrX2J1dHRvbl9lZGl0IjtzOjE6IjEiO3M6MTU6ImNoa19idXR0b25fc2F2ZSI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2RlbGV0ZSI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2ltcG9ydCI7czoxOiIxIjtzOjE3OiJjaGtfYnV0dG9uX2V4cG9ydCI7czoxOiIxIjtzOjE1OiJwcmltYXJ5X2tleV9jb2wiO3M6ODoiaW5zdGNvZGUiO3M6NToiYWxpYXMiO2E6NDp7czo4OiJpbnN0Y29kZSI7czo2OiJlZHp1ZHIiO3M6ODoiaW5zdG5hbWUiO3M6NjoidXNkemdyIjtzOjM6Im1vdSI7czo2OiJnYXZpY20iO3M6OToiaW5zdGVtYWlsIjtzOjY6Iml4ZWJycCI7fXM6NToidGl0bGUiO2E6NDp7czo4OiJpbnN0Y29kZSI7czoxNjoiSW5zdGl0dXRpb24gQ29kZSI7czo4OiJpbnN0bmFtZSI7czoxNjoiSW5zdGl0dXRpb24gbmFtZSI7czozOiJtb3UiO3M6NzoiSGFzIE1vdSI7czo5OiJpbnN0ZW1haWwiO3M6NToiRW1haWwiO31zOjc6InZpc2libGUiO2E6NDp7czo4OiJpbnN0Y29kZSI7czoxOiIxIjtzOjg6Imluc3RuYW1lIjtzOjE6IjEiO3M6MzoibW91IjtzOjE6IjQiO3M6OToiaW5zdGVtYWlsIjtzOjE6IjEiO31zOjg6InJlcXVpcmVkIjthOjQ6e3M6ODoiaW5zdGNvZGUiO3M6MToiMSI7czo4OiJpbnN0bmFtZSI7czoxOiIxIjtzOjM6Im1vdSI7czoxOiIxIjtzOjk6Imluc3RlbWFpbCI7czoxOiIxIjt9czoxODoiZm9ybWlucHV0X2luc3Rjb2RlIjtzOjQ6InRleHQiO3M6MTg6ImZvcm1pbnB1dF9pbnN0bmFtZSI7czo0OiJ0ZXh0IjtzOjEzOiJmb3JtaW5wdXRfbW91IjtzOjg6ImNoZWNrYm94IjtzOjE5OiJmb3JtaW5wdXRfaW5zdGVtYWlsIjtzOjQ6InRleHQiO30=',	'2',	'2019-01-21',	1548043185,	'127.0.0.1'),
(25,	'SY',	'Dev Tools',	1,	'fa-cogs',	0,	NULL,	1,	'',	'',	'cmd',	'blue',	'',	NULL,	NULL,	NULL,	NULL),
(30,	'SY',	'Load Tables',	4,	'fa-database',	25,	NULL,	1,	'DataDict/tables',	NULL,	'cmd',	'blueLight',	'YToyOntzOjQ6Im1uaWQiO3M6MjoiMzAiO3M6NzoibW9kY29udCI7czo4OiJEYXRhRGljdCI7fQ==',	'1',	'2017-09-15',	1505456325,	'127.0.0.1'),
(45,	'SY',	'Load Views',	5,	'fa-gear',	25,	NULL,	1,	'DataDict/views',	NULL,	'cmd',	'orange',	'YToyOntzOjQ6Im1uaWQiO3M6MjoiNDUiO3M6NzoibW9kY29udCI7czo4OiJEYXRhRGljdCI7fQ==',	'1',	'2017-09-15',	1505456333,	'127.0.0.1'),
(46,	'SY',	'Applications',	0,	'fa-cubes',	25,	NULL,	1,	'SystemApps',	NULL,	'cmd',	'0',	'YToyOntzOjQ6Im1uaWQiO3M6MjoiNDYiO3M6NzoibW9kY29udCI7czo4OiJEYXRhRGljdCI7fQ==',	'1',	'2017-09-15',	1505456295,	'127.0.0.1'),
(47,	'SY',	'Menu',	3,	'fa-list-alt',	25,	NULL,	1,	'ModuleMenu',	NULL,	'cmd',	'blue',	'YToyOntzOjQ6Im1uaWQiO3M6MjoiNDciO3M6NzoibW9kY29udCI7czo4OiJEYXRhRGljdCI7fQ==',	'1',	'2017-09-15',	1505456313,	'127.0.0.1'),
(219,	'SY',	'Data Copy',	6,	'fa-database',	25,	NULL,	1,	'DataDict/datacopy',	NULL,	'cmd',	'magenta',	'YToyOntzOjQ6Im1uaWQiO3M6MzoiMjE5IjtzOjc6Im1vZGNvbnQiO3M6ODoiRGF0YURpY3QiO30=',	'1',	'2017-09-15',	1505456797,	'127.0.0.1');

DROP TABLE IF EXISTS `sysrights`;
CREATE TABLE `sysrights` (
  `appid` varchar(10) NOT NULL,
  `moduleid` int(10) NOT NULL,
  `menuid` int(10) NOT NULL,
  `rolecode` varchar(5) NOT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`appid`,`moduleid`,`menuid`,`rolecode`),
  UNIQUE KEY `idx_pk` (`appid`,`moduleid`,`menuid`,`rolecode`),
  FULLTEXT KEY `idx_search` (`appid`,`rolecode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sysrights` (`appid`, `moduleid`, `menuid`, `rolecode`, `audituser`, `auditdate`, `audittime`, `auditip`) VALUES
('RG',	226,	226,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	228,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	235,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	236,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	237,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	243,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	244,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	245,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	247,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	249,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	250,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	251,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	252,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	253,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	254,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	256,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	257,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	258,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	259,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	260,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	261,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	226,	262,	'admin',	'2',	'2019-01-21',	1548043201,	NULL),
('RG',	231,	231,	'admin',	'3',	'2018-03-02',	1519971686,	NULL),
('RG',	231,	231,	'IA',	'3',	'2018-03-02',	1519972416,	NULL),
('RG',	231,	234,	'admin',	'3',	'2018-03-02',	1519971686,	NULL),
('RG',	231,	234,	'IA',	'3',	'2018-03-02',	1519972416,	NULL),
('RG',	231,	242,	'admin',	'3',	'2018-03-02',	1519971686,	NULL),
('RG',	231,	246,	'admin',	'3',	'2018-03-02',	1519971686,	NULL),
('RG',	238,	238,	'admin',	'3',	'2018-03-02',	1519973943,	NULL),
('RG',	238,	238,	'IA',	'3',	'2018-03-02',	1519971661,	NULL),
('RG',	238,	239,	'admin',	'3',	'2018-03-02',	1519973943,	NULL),
('RG',	238,	240,	'admin',	'3',	'2018-03-02',	1519973943,	NULL),
('RG',	238,	241,	'admin',	'3',	'2018-03-02',	1519973943,	NULL),
('RG',	238,	248,	'admin',	'3',	'2018-03-02',	1519973943,	NULL),
('RG',	238,	248,	'IA',	'3',	'2018-03-02',	1519971661,	NULL);

DROP TABLE IF EXISTS `sysroles`;
CREATE TABLE `sysroles` (
  `id` int(10) NOT NULL,
  `rolecode` varchar(5) NOT NULL,
  `rolename` varchar(50) NOT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`rolecode`),
  UNIQUE KEY `idx_pk` (`rolecode`),
  FULLTEXT KEY `idx_search` (`rolecode`,`rolename`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sysroles` (`id`, `rolecode`, `rolename`, `audituser`, `auditdate`, `audittime`, `auditip`) VALUES
(2,	'admin',	'System Administrator',	'3',	'2018-03-02',	1519971298,	'127.0.0.1'),
(3,	'AP',	'Institution User',	'3',	'2018-03-02',	1519971312,	'127.0.0.1'),
(4,	'IA',	'Institution Administrator',	'3',	'2018-03-02',	1519971291,	'127.0.0.1');

DROP TABLE IF EXISTS `sysusers`;
CREATE TABLE `sysusers` (
  `id` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `rolecode` varchar(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `disabled` date DEFAULT NULL,
  `audituser` varchar(20) DEFAULT NULL,
  `auditdate` date DEFAULT NULL,
  `audittime` int(10) DEFAULT NULL,
  `auditip` varchar(15) DEFAULT NULL,
  `resetcode` varchar(100) DEFAULT NULL,
  `instcode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `idx_pk` (`email`),
  FULLTEXT KEY `idx_search` (`email`,`username`,`rolecode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sysusers` (`id`, `email`, `rolecode`, `username`, `mobile`, `password`, `disabled`, `audituser`, `auditdate`, `audittime`, `auditip`, `resetcode`, `instcode`) VALUES
(2,	'admin@abs.gov.bs',	'admin',	'Administrator',	'  +2423224546',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	NULL,	'2',	'2018-03-05',	1520257879,	'127.0.0.1',	NULL,	'NA'),
(16,	'ammc@abs.gov.bs',	'IA',	'AMMC Admin',	'  +2423224546',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	NULL,	'2',	'2020-02-04',	1580833404,	'127.0.0.1',	NULL,	'AMMC'),
(8,	'best@abs.gov.bs',	'IA',	'BEST - Admin',	'  +2423224546',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	NULL,	'2',	'2020-02-04',	1580833764,	'127.0.0.1',	NULL,	'BEST'),
(15,	'bna@abs.gov.bs',	'IA',	'Bahamas National Trust',	'  +2423224546',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	NULL,	'2',	'2020-02-04',	1580831980,	'127.0.0.1',	NULL,	'BNT'),
(13,	'dmr@abs.gov.bs',	'IA',	'Dept. of Marine Resources - Admin',	'  +2423224546',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	NULL,	'2',	'2020-02-04',	1580833441,	'127.0.0.1',	NULL,	'DMR'),
(14,	'doa@abs.gov.bs',	'IA',	'Department of Agriculture - Admin',	'  +2423224546',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	NULL,	'2',	'2020-02-04',	1580833449,	'127.0.0.1',	NULL,	'DOA'),
(12,	'fa@abs.gov.bs',	'IA',	'FOREIGN AFFAIRS Admin',	'  +2423224546',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	NULL,	'2',	'2020-02-04',	1580833388,	'127.0.0.1',	NULL,	'MFA'),
(11,	'forestry@abs.gov.bs',	'IA',	'Forestry Unit Admin',	'  +2423224546',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	NULL,	'2',	'2020-02-04',	1580833375,	'127.0.0.1',	NULL,	'FU'),
(6,	'port@abs.gov.bs',	'IA',	'PORT DEPARTMENT Admin',	'  +2423224546',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	NULL,	'2',	'2020-02-04',	1580833759,	'127.0.0.1',	NULL,	'PD');

DROP TABLE IF EXISTS `titles`;
CREATE TABLE `titles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titlecode` varchar(10) NOT NULL,
  `titlename` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `titles` (`id`, `titlecode`, `titlename`) VALUES
(1,	'Mr.',	'Mr.'),
(2,	'Miss.',	'Miss.'),
(3,	'Ms.',	'Ms.'),
(4,	'Dr.',	'Dr.'),
(5,	'Prof.',	'Prof.');

DROP VIEW IF EXISTS `viewapplications`;
CREATE TABLE `viewapplications` (`id` int(10), `appno` varchar(30), `email` varchar(100), `firstname` varchar(30), `lastname` varchar(30), `gender` varchar(10), `ctncode` varchar(10), `ctnname` varchar(50), `mobile` varchar(15), `position` varchar(10), `applyingas` varchar(50), `applyingasname` varchar(100), `orcid` varchar(50), `researcherid` varchar(30), `legalofficername` varchar(100), `legalofficeremail` varchar(100), `resourcetypes` varchar(255), `resourcetype` varchar(100), `resourcetypename` varchar(100), `speciesname` varchar(100), `scientificname` varchar(100), `commonname` varchar(100), `projectlocation` varchar(100), `projectarea` varchar(100), `resourceallocationpurpose` varchar(100), `exportanswer` varchar(10), `resourcetypeother` varchar(100), `export_port` varchar(100), `export_country` varchar(100), `purpose` varchar(255), `purposeother` varchar(255), `documentregistration` longtext, `documentresearchproposal` longtext, `documentaffiliation` longtext, `documentresearchbudget` longtext, `documentcv` longtext, `documentpic` longtext, `documentmat` longtext, `documentmta` longtext, `documentip` longtext, `docpayment` longtext, `researchtype` varchar(10), `researchtypename` varchar(50), `samplesamount` int(10), `conservestatus` varchar(10), `conservestatusdesc` varchar(100), `restraditionalknow` varchar(100), `exportgeneticresources` varchar(100), `legislationagree` varchar(5), `sampleuom` varchar(5), `sampleuomname` varchar(100), `apptime` int(10), `approved1` int(1), `approved2` int(1), `approved3` int(1), `approved4` int(1), `approved5` int(1), `approved6` int(1), `approved7` int(1), `approved8` int(1), `approved9` int(1), `approved10` int(1), `aprcomment1` varchar(255), `aprcomment2` varchar(255), `aprcomment3` varchar(255), `aprcomment4` varchar(255), `aprcomment5` varchar(255), `aprcomment6` varchar(255), `aprcomment7` varchar(255), `aprcomment8` varchar(255), `aprcomment9` varchar(255), `aprcomment10` varchar(255), `discomment1` varchar(255), `discomment2` varchar(255), `discomment3` varchar(255), `discomment4` varchar(255), `discomment5` varchar(255), `discomment6` varchar(255), `discomment7` varchar(255), `discomment8` varchar(255), `discomment9` varchar(255), `discomment10` varchar(255), `paid1` int(1), `paid2` int(1), `paid3` int(1), `paid4` int(1), `paid5` int(1), `paid6` int(1), `paid7` int(1), `paid8` int(1), `paid9` int(1), `paid10` int(1), `payref1` varchar(30), `payref2` varchar(30), `payref3` varchar(30), `payref4` varchar(30), `payref5` varchar(30), `payref6` varchar(30), `payref7` varchar(30), `payref8` varchar(30), `payref9` varchar(30), `payref10` varchar(30), `paytime1` int(10), `paytime2` int(10), `paytime3` int(10), `paytime4` int(10), `paytime5` int(10), `paytime6` int(10), `paytime7` int(10), `paytime8` int(10), `paytime9` int(10), `paytime10` int(10), `paymode1` varchar(20), `paymode2` varchar(20), `paymode3` varchar(20), `paymode4` varchar(20), `paymode5` varchar(20), `paymode6` varchar(20), `paymode7` varchar(20), `paymode8` varchar(20), `paymode9` varchar(20), `paymode10` varchar(20), `routed` int(10), `instcode` varchar(10));


DROP VIEW IF EXISTS `viewapplicationsnew`;
CREATE TABLE `viewapplicationsnew` (`id` int(10), `appno` varchar(30), `email` varchar(100), `firstname` varchar(30), `lastname` varchar(30), `gender` varchar(10), `ctncode` varchar(10), `ctnname` varchar(50), `mobile` varchar(15), `position` varchar(10), `applyingas` varchar(50), `applyingasname` varchar(100), `orcid` varchar(50), `researcherid` varchar(30), `legalofficername` varchar(100), `legalofficeremail` varchar(100), `resourcetype` varchar(100), `resourcetypename` varchar(100), `speciesname` varchar(100), `scientificname` varchar(100), `commonname` varchar(100), `projectlocation` varchar(100), `projectarea` varchar(100), `resourceallocationpurpose` varchar(100), `exportanswer` varchar(10), `resourcetypeother` varchar(100), `purpose` varchar(255), `purposeother` varchar(255), `documentregistration` longtext, `documentresearchproposal` longtext, `documentaffiliation` longtext, `documentresearchbudget` longtext, `documentcv` longtext, `documentpic` longtext, `documentmat` longtext, `documentmta` longtext, `documentip` longtext, `docpayment` longtext, `researchtype` varchar(10), `researchtypename` varchar(50), `samplesamount` int(10), `conservestatus` varchar(10), `conservestatusdesc` varchar(100), `restraditionalknow` varchar(100), `exportgeneticresources` varchar(100), `legislationagree` varchar(5), `sampleuom` varchar(5), `sampleuomname` varchar(100), `apptime` int(10), `approved1` int(1), `approved2` int(1), `approved3` int(1), `approved4` int(1), `approved5` int(1), `approved6` int(1), `approved7` int(1), `approved8` int(1), `approved9` int(1), `approved10` int(1), `aprcomment1` varchar(255), `aprcomment2` varchar(255), `aprcomment3` varchar(255), `aprcomment4` varchar(255), `aprcomment5` varchar(255), `aprcomment6` varchar(255), `aprcomment7` varchar(255), `aprcomment8` varchar(255), `aprcomment9` varchar(255), `aprcomment10` varchar(255), `discomment1` varchar(255), `discomment2` varchar(255), `discomment3` varchar(255), `discomment4` varchar(255), `discomment5` varchar(255), `discomment6` varchar(255), `discomment7` varchar(255), `discomment8` varchar(255), `discomment9` varchar(255), `discomment10` varchar(255), `paid1` int(1), `paid2` int(1), `paid3` int(1), `paid4` int(1), `paid5` int(1), `paid6` int(1), `paid7` int(1), `paid8` int(1), `paid9` int(1), `paid10` int(1), `payref1` varchar(30), `payref2` varchar(30), `payref3` varchar(30), `payref4` varchar(30), `payref5` varchar(30), `payref6` varchar(30), `payref7` varchar(30), `payref8` varchar(30), `payref9` varchar(30), `payref10` varchar(30), `paytime1` int(10), `paytime2` int(10), `paytime3` int(10), `paytime4` int(10), `paytime5` int(10), `paytime6` int(10), `paytime7` int(10), `paytime8` int(10), `paytime9` int(10), `paytime10` int(10), `paymode1` varchar(20), `paymode2` varchar(20), `paymode3` varchar(20), `paymode4` varchar(20), `paymode5` varchar(20), `paymode6` varchar(20), `paymode7` varchar(20), `paymode8` varchar(20), `paymode9` varchar(20), `paymode10` varchar(20), `routed` int(10), `instcode` varchar(10));


DROP VIEW IF EXISTS `viewapplicationstmp`;
CREATE TABLE `viewapplicationstmp` ();


DROP VIEW IF EXISTS `viewapproved1`;
CREATE TABLE `viewapproved1` (`id` int(10), `appno` varchar(30), `email` varchar(100), `firstname` varchar(30), `lastname` varchar(30), `gender` varchar(10), `ctncode` varchar(10), `ctnname` varchar(50), `mobile` varchar(15), `position` varchar(10), `applyingas` varchar(50), `applyingasname` varchar(100), `orcid` varchar(50), `researcherid` varchar(30), `legalofficername` varchar(100), `legalofficeremail` varchar(100), `resourcetypes` varchar(255), `resourcetype` varchar(100), `resourcetypename` varchar(100), `speciesname` varchar(100), `scientificname` varchar(100), `commonname` varchar(100), `projectlocation` varchar(100), `projectarea` varchar(100), `resourceallocationpurpose` varchar(100), `exportanswer` varchar(10), `resourcetypeother` varchar(100), `export_port` varchar(100), `export_country` varchar(100), `purpose` varchar(255), `purposeother` varchar(255), `documentregistration` longtext, `documentresearchproposal` longtext, `documentaffiliation` longtext, `documentresearchbudget` longtext, `documentcv` longtext, `documentpic` longtext, `documentmat` longtext, `documentmta` longtext, `documentip` longtext, `docpayment` longtext, `researchtype` varchar(10), `researchtypename` varchar(50), `samplesamount` int(10), `conservestatus` varchar(10), `conservestatusdesc` varchar(100), `restraditionalknow` varchar(100), `exportgeneticresources` varchar(100), `legislationagree` varchar(5), `sampleuom` varchar(5), `sampleuomname` varchar(100), `apptime` int(10), `approved1` int(1), `approved2` int(1), `approved3` int(1), `approved4` int(1), `approved5` int(1), `approved6` int(1), `approved7` int(1), `approved8` int(1), `approved9` int(1), `approved10` int(1), `aprcomment1` varchar(255), `aprcomment2` varchar(255), `aprcomment3` varchar(255), `aprcomment4` varchar(255), `aprcomment5` varchar(255), `aprcomment6` varchar(255), `aprcomment7` varchar(255), `aprcomment8` varchar(255), `aprcomment9` varchar(255), `aprcomment10` varchar(255), `discomment1` varchar(255), `discomment2` varchar(255), `discomment3` varchar(255), `discomment4` varchar(255), `discomment5` varchar(255), `discomment6` varchar(255), `discomment7` varchar(255), `discomment8` varchar(255), `discomment9` varchar(255), `discomment10` varchar(255), `paid1` int(1), `paid2` int(1), `paid3` int(1), `paid4` int(1), `paid5` int(1), `paid6` int(1), `paid7` int(1), `paid8` int(1), `paid9` int(1), `paid10` int(1), `payref1` varchar(30), `payref2` varchar(30), `payref3` varchar(30), `payref4` varchar(30), `payref5` varchar(30), `payref6` varchar(30), `payref7` varchar(30), `payref8` varchar(30), `payref9` varchar(30), `payref10` varchar(30), `paytime1` int(10), `paytime2` int(10), `paytime3` int(10), `paytime4` int(10), `paytime5` int(10), `paytime6` int(10), `paytime7` int(10), `paytime8` int(10), `paytime9` int(10), `paytime10` int(10), `paymode1` varchar(20), `paymode2` varchar(20), `paymode3` varchar(20), `paymode4` varchar(20), `paymode5` varchar(20), `paymode6` varchar(20), `paymode7` varchar(20), `paymode8` varchar(20), `paymode9` varchar(20), `paymode10` varchar(20), `routed` int(10), `instcode` varchar(10));


DROP VIEW IF EXISTS `viewapproved2`;
CREATE TABLE `viewapproved2` ();


DROP VIEW IF EXISTS `viewapproved3`;
CREATE TABLE `viewapproved3` ();


DROP VIEW IF EXISTS `viewapproved4`;
CREATE TABLE `viewapproved4` ();


DROP VIEW IF EXISTS `viewapproved5`;
CREATE TABLE `viewapproved5` ();


DROP VIEW IF EXISTS `viewapproved6`;
CREATE TABLE `viewapproved6` ();


DROP VIEW IF EXISTS `viewapprovesteps`;
CREATE TABLE `viewapprovesteps` (`id` int(11), `stepno` int(11), `stepname` varchar(100), `stepdesc` varchar(100), `instcode` varchar(10), `instname` varchar(100), `emtplaplapr` int(2), `emtplapldsp` int(2), `emtplinsapr` int(2), `emtplinsdsp` int(2));


DROP VIEW IF EXISTS `viewbankaccounts`;
CREATE TABLE `viewbankaccounts` (`id` int(4), `instcode` varchar(10), `instname` varchar(100), `currcode` varchar(5), `currname` varchar(50), `accountno` varchar(10), `accountname` varchar(50), `bankcode` varchar(10), `bankname` varchar(50), `branchcode` varchar(10), `branchname` varchar(50), `swiftcode` varchar(20));


DROP VIEW IF EXISTS `viewbankbranches`;
CREATE TABLE `viewbankbranches` (`id` int(4), `branchcode` varchar(10), `branchname` varchar(50), `bankcode` varchar(10), `bankname` varchar(50), `swiftcode` varchar(20), `haseft` varchar(20));


DROP VIEW IF EXISTS `viewcountries`;
CREATE TABLE `viewcountries` ();


DROP VIEW IF EXISTS `viewinstitutions`;
CREATE TABLE `viewinstitutions` (`id` int(11), `instcode` varchar(10), `instname` varchar(100), `instphoto` longtext, `photourl` varchar(255), `thumburl` varchar(255), `permitdesc` varchar(255), `charges` decimal(9,2), `consultemail` varchar(100), `consultperson` varchar(100), `paytimecode` varchar(5), `paytimename` varchar(30), `isbfrsub` int(1), `isbfrapr` int(1), `licmdcode` varchar(5), `licmdname` varchar(30), `isauto` int(1), `ismanapp` int(1), `ismanins` int(1), `isemail` int(1), `stepno` int(11), `stepname` varchar(100), `stepdesc` varchar(100), `emtplaplapr` int(2), `emtplapldsp` int(2), `emtplinsapr` int(2), `emtplinsdsp` int(2), `api_username` varchar(20), `api_password` varchar(50), `api_baseurl` varchar(100));


DROP VIEW IF EXISTS `viewresearchers`;
CREATE TABLE `viewresearchers` (`id` int(10), `idpassno` varchar(30), `orcidid` varchar(100), `orcidname` varchar(100), `accesstoken` varchar(100), `tokentype` varchar(100), `refreshtoken` varchar(100), `tokenexpiry` int(10), `tokenscope` varchar(100), `firstname` varchar(30), `lastname` varchar(30), `midname` varchar(30), `fullname` varchar(30), `gender` varchar(10), `ctncode` varchar(10), `email` varchar(50), `title` varchar(50), `dob` date, `idpassip` varchar(50), `idpassdi` date, `idpassdx` date, `institutionname` varchar(100), `qualification` varchar(100), `specarea` varchar(50), `mobile` varchar(15), `postaddress` varchar(20), `postcode` varchar(10), `town` varchar(50), `prmaddress` varchar(100), `prmpcode` varchar(100), `prmtown` varchar(100), `prmphone` varchar(100), `prmresidence` varchar(100), `secaddress` varchar(100), `secpcode` varchar(100), `sectown` varchar(100), `secphone` varchar(100), `secresidence` varchar(100), `empaddress` varchar(100), `emppcode` varchar(100), `emppzip` varchar(100), `emptown` varchar(100), `emphone` varchar(100), `empctncode` varchar(10), `empcountry` varchar(40), `password` varchar(100), `verifycode` varchar(10), `verifydate` date, `verified` int(1), `hasuploads` int(1), `docpassport` longtext, `docid` longtext, `docidpass` longtext, `urlphoto` varchar(255), `active` int(1), `setup` int(1), `regdate` date, `regtime` int(10), `pinno` varchar(20), `ctnname` varchar(50), `natcode` varchar(10), `ntnname` varchar(50));


DROP VIEW IF EXISTS `viewusers`;
CREATE TABLE `viewusers` (`id` int(10), `email` varchar(30), `username` varchar(50), `mobile` varchar(20), `disabled` date, `rolecode` varchar(5), `rolename` varchar(50), `instcode` varchar(10), `instname` varchar(100), `audituser` varchar(20));

 
DROP TABLE IF EXISTS `yesno`;
CREATE TABLE `yesno` (
  `id` int(10) NOT NULL,
  `appnos` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `yesno` (`id`, `appnos`) VALUES
(1,	0),
(2,	0);

DROP TABLE IF EXISTS `viewapplications`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewapplications` AS select `y`.`id` AS `id`,`y`.`appno` AS `appno`,`y`.`email` AS `email`,`s`.`firstname` AS `firstname`,`s`.`lastname` AS `lastname`,`s`.`gender` AS `gender`,`s`.`ctncode` AS `ctncode`,`c`.`ctnname` AS `ctnname`,`s`.`mobile` AS `mobile`,`y`.`position` AS `position`,`y`.`applyingas` AS `applyingas`,`a`.`asname` AS `applyingasname`,`y`.`orcid` AS `orcid`,`y`.`researcherid` AS `researcherid`,`y`.`legalofficername` AS `legalofficername`,`y`.`legalofficeremail` AS `legalofficeremail`,`y`.`resourcetypes` AS `resourcetypes`,`y`.`resourcetype` AS `resourcetype`,`r`.`typename` AS `resourcetypename`,`y`.`speciesname` AS `speciesname`,`y`.`scientificname` AS `scientificname`,`y`.`commonname` AS `commonname`,`y`.`projectlocation` AS `projectlocation`,`y`.`projectarea` AS `projectarea`,`y`.`resourceallocationpurpose` AS `resourceallocationpurpose`,`y`.`exportanswer` AS `exportanswer`,`y`.`resourcetypeother` AS `resourcetypeother`,`y`.`export_port` AS `export_port`,`y`.`export_country` AS `export_country`,`y`.`purpose` AS `purpose`,`y`.`purposeother` AS `purposeother`,`y`.`documentregistration` AS `documentregistration`,`y`.`documentresearchproposal` AS `documentresearchproposal`,`y`.`documentaffiliation` AS `documentaffiliation`,`y`.`documentresearchbudget` AS `documentresearchbudget`,`y`.`documentcv` AS `documentcv`,`y`.`documentpic` AS `documentpic`,`y`.`documentmat` AS `documentmat`,`y`.`documentmta` AS `documentmta`,`y`.`documentip` AS `documentip`,`y`.`docpayment` AS `docpayment`,`y`.`researchtype` AS `researchtype`,`t`.`typename` AS `researchtypename`,`y`.`samplesamount` AS `samplesamount`,`y`.`conservestatus` AS `conservestatus`,`y`.`conservestatusdesc` AS `conservestatusdesc`,`y`.`restraditionalknow` AS `restraditionalknow`,`y`.`exportgeneticresources` AS `exportgeneticresources`,`y`.`legislationagree` AS `legislationagree`,`y`.`sampleuom` AS `sampleuom`,`u`.`uomname` AS `sampleuomname`,`y`.`apptime` AS `apptime`,`y`.`approved1` AS `approved1`,`y`.`approved2` AS `approved2`,`y`.`approved3` AS `approved3`,`y`.`approved4` AS `approved4`,`y`.`approved5` AS `approved5`,`y`.`approved6` AS `approved6`,`y`.`approved7` AS `approved7`,`y`.`approved8` AS `approved8`,`y`.`approved9` AS `approved9`,`y`.`approved10` AS `approved10`,`y`.`aprcomment1` AS `aprcomment1`,`y`.`aprcomment2` AS `aprcomment2`,`y`.`aprcomment3` AS `aprcomment3`,`y`.`aprcomment4` AS `aprcomment4`,`y`.`aprcomment5` AS `aprcomment5`,`y`.`aprcomment6` AS `aprcomment6`,`y`.`aprcomment7` AS `aprcomment7`,`y`.`aprcomment8` AS `aprcomment8`,`y`.`aprcomment9` AS `aprcomment9`,`y`.`aprcomment10` AS `aprcomment10`,`y`.`discomment1` AS `discomment1`,`y`.`discomment2` AS `discomment2`,`y`.`discomment3` AS `discomment3`,`y`.`discomment4` AS `discomment4`,`y`.`discomment5` AS `discomment5`,`y`.`discomment6` AS `discomment6`,`y`.`discomment7` AS `discomment7`,`y`.`discomment8` AS `discomment8`,`y`.`discomment9` AS `discomment9`,`y`.`discomment10` AS `discomment10`,`y`.`paid1` AS `paid1`,`y`.`paid2` AS `paid2`,`y`.`paid3` AS `paid3`,`y`.`paid4` AS `paid4`,`y`.`paid5` AS `paid5`,`y`.`paid6` AS `paid6`,`y`.`paid7` AS `paid7`,`y`.`paid8` AS `paid8`,`y`.`paid9` AS `paid9`,`y`.`paid10` AS `paid10`,`y`.`payref1` AS `payref1`,`y`.`payref2` AS `payref2`,`y`.`payref3` AS `payref3`,`y`.`payref4` AS `payref4`,`y`.`payref5` AS `payref5`,`y`.`payref6` AS `payref6`,`y`.`payref7` AS `payref7`,`y`.`payref8` AS `payref8`,`y`.`payref9` AS `payref9`,`y`.`payref10` AS `payref10`,`y`.`paytime1` AS `paytime1`,`y`.`paytime2` AS `paytime2`,`y`.`paytime3` AS `paytime3`,`y`.`paytime4` AS `paytime4`,`y`.`paytime5` AS `paytime5`,`y`.`paytime6` AS `paytime6`,`y`.`paytime7` AS `paytime7`,`y`.`paytime8` AS `paytime8`,`y`.`paytime9` AS `paytime9`,`y`.`paytime10` AS `paytime10`,`y`.`paymode1` AS `paymode1`,`y`.`paymode2` AS `paymode2`,`y`.`paymode3` AS `paymode3`,`y`.`paymode4` AS `paymode4`,`y`.`paymode5` AS `paymode5`,`y`.`paymode6` AS `paymode6`,`y`.`paymode7` AS `paymode7`,`y`.`paymode8` AS `paymode8`,`y`.`paymode9` AS `paymode9`,`y`.`paymode10` AS `paymode10`,`y`.`routed` AS `routed`,`y`.`instcode` AS `instcode` from ((((((`applications` `y` join `researchers` `s` on((`s`.`email` = `y`.`email`))) left join `countries` `c` on((`c`.`ctncode` = `s`.`ctncode`))) left join `applyas` `a` on((`a`.`ascode` = `y`.`applyingas`))) left join `researchtypes` `t` on((`t`.`typecode` = `y`.`researchtype`))) left join `resourcetypes` `r` on((`r`.`typecode` = `y`.`resourcetype`))) left join `sampleuom` `u` on((`u`.`uomcode` = `y`.`sampleuom`)));

DROP TABLE IF EXISTS `viewapplicationsnew`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewapplicationsnew` AS select `y`.`id` AS `id`,`y`.`appno` AS `appno`,`y`.`email` AS `email`,`s`.`firstname` AS `firstname`,`s`.`lastname` AS `lastname`,`s`.`gender` AS `gender`,`s`.`ctncode` AS `ctncode`,`c`.`ctnname` AS `ctnname`,`s`.`mobile` AS `mobile`,`y`.`position` AS `position`,`y`.`applyingas` AS `applyingas`,`a`.`asname` AS `applyingasname`,`y`.`orcid` AS `orcid`,`y`.`researcherid` AS `researcherid`,`y`.`legalofficername` AS `legalofficername`,`y`.`legalofficeremail` AS `legalofficeremail`,`y`.`resourcetype` AS `resourcetype`,`r`.`typename` AS `resourcetypename`,`y`.`speciesname` AS `speciesname`,`y`.`scientificname` AS `scientificname`,`y`.`commonname` AS `commonname`,`y`.`projectlocation` AS `projectlocation`,`y`.`projectarea` AS `projectarea`,`y`.`resourceallocationpurpose` AS `resourceallocationpurpose`,`y`.`exportanswer` AS `exportanswer`,`y`.`resourcetypeother` AS `resourcetypeother`,`y`.`purpose` AS `purpose`,`y`.`purposeother` AS `purposeother`,`y`.`documentregistration` AS `documentregistration`,`y`.`documentresearchproposal` AS `documentresearchproposal`,`y`.`documentaffiliation` AS `documentaffiliation`,`y`.`documentresearchbudget` AS `documentresearchbudget`,`y`.`documentcv` AS `documentcv`,`y`.`documentpic` AS `documentpic`,`y`.`documentmat` AS `documentmat`,`y`.`documentmta` AS `documentmta`,`y`.`documentip` AS `documentip`,`y`.`docpayment` AS `docpayment`,`y`.`researchtype` AS `researchtype`,`t`.`typename` AS `researchtypename`,`y`.`samplesamount` AS `samplesamount`,`y`.`conservestatus` AS `conservestatus`,`y`.`conservestatusdesc` AS `conservestatusdesc`,`y`.`restraditionalknow` AS `restraditionalknow`,`y`.`exportgeneticresources` AS `exportgeneticresources`,`y`.`legislationagree` AS `legislationagree`,`y`.`sampleuom` AS `sampleuom`,`u`.`uomname` AS `sampleuomname`,`y`.`apptime` AS `apptime`,`y`.`approved1` AS `approved1`,`y`.`approved2` AS `approved2`,`y`.`approved3` AS `approved3`,`y`.`approved4` AS `approved4`,`y`.`approved5` AS `approved5`,`y`.`approved6` AS `approved6`,`y`.`approved7` AS `approved7`,`y`.`approved8` AS `approved8`,`y`.`approved9` AS `approved9`,`y`.`approved10` AS `approved10`,`y`.`aprcomment1` AS `aprcomment1`,`y`.`aprcomment2` AS `aprcomment2`,`y`.`aprcomment3` AS `aprcomment3`,`y`.`aprcomment4` AS `aprcomment4`,`y`.`aprcomment5` AS `aprcomment5`,`y`.`aprcomment6` AS `aprcomment6`,`y`.`aprcomment7` AS `aprcomment7`,`y`.`aprcomment8` AS `aprcomment8`,`y`.`aprcomment9` AS `aprcomment9`,`y`.`aprcomment10` AS `aprcomment10`,`y`.`discomment1` AS `discomment1`,`y`.`discomment2` AS `discomment2`,`y`.`discomment3` AS `discomment3`,`y`.`discomment4` AS `discomment4`,`y`.`discomment5` AS `discomment5`,`y`.`discomment6` AS `discomment6`,`y`.`discomment7` AS `discomment7`,`y`.`discomment8` AS `discomment8`,`y`.`discomment9` AS `discomment9`,`y`.`discomment10` AS `discomment10`,`y`.`paid1` AS `paid1`,`y`.`paid2` AS `paid2`,`y`.`paid3` AS `paid3`,`y`.`paid4` AS `paid4`,`y`.`paid5` AS `paid5`,`y`.`paid6` AS `paid6`,`y`.`paid7` AS `paid7`,`y`.`paid8` AS `paid8`,`y`.`paid9` AS `paid9`,`y`.`paid10` AS `paid10`,`y`.`payref1` AS `payref1`,`y`.`payref2` AS `payref2`,`y`.`payref3` AS `payref3`,`y`.`payref4` AS `payref4`,`y`.`payref5` AS `payref5`,`y`.`payref6` AS `payref6`,`y`.`payref7` AS `payref7`,`y`.`payref8` AS `payref8`,`y`.`payref9` AS `payref9`,`y`.`payref10` AS `payref10`,`y`.`paytime1` AS `paytime1`,`y`.`paytime2` AS `paytime2`,`y`.`paytime3` AS `paytime3`,`y`.`paytime4` AS `paytime4`,`y`.`paytime5` AS `paytime5`,`y`.`paytime6` AS `paytime6`,`y`.`paytime7` AS `paytime7`,`y`.`paytime8` AS `paytime8`,`y`.`paytime9` AS `paytime9`,`y`.`paytime10` AS `paytime10`,`y`.`paymode1` AS `paymode1`,`y`.`paymode2` AS `paymode2`,`y`.`paymode3` AS `paymode3`,`y`.`paymode4` AS `paymode4`,`y`.`paymode5` AS `paymode5`,`y`.`paymode6` AS `paymode6`,`y`.`paymode7` AS `paymode7`,`y`.`paymode8` AS `paymode8`,`y`.`paymode9` AS `paymode9`,`y`.`paymode10` AS `paymode10`,`y`.`routed` AS `routed`,`y`.`instcode` AS `instcode` from ((((((`applications` `y` join `researchers` `s` on((`s`.`email` = `y`.`email`))) left join `countries` `c` on((`c`.`ctncode` = `s`.`ctncode`))) left join `applyas` `a` on((`a`.`ascode` = `y`.`applyingas`))) left join `researchtypes` `t` on((`t`.`typecode` = `y`.`researchtype`))) left join `resourcetypes` `r` on((`r`.`typecode` = `y`.`resourcetype`))) left join `sampleuom` `u` on((`u`.`uomcode` = `y`.`sampleuom`))) where isnull(`y`.`routed`);

DROP TABLE IF EXISTS `viewapplicationstmp`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewapplicationstmp` AS select distinct `y`.`id` AS `id`,`y`.`email` AS `email`,`f`.`idpassno` AS `appno`,`f`.`idpassno` AS `idpassno`,`f`.`firstname` AS `firstname`,`f`.`lastname` AS `lastname`,`f`.`midname` AS `midname`,`f`.`fullname` AS `fullname`,`f`.`gender` AS `gender`,`f`.`ctncode` AS `ctncode`,`c`.`ctnname` AS `ctnname`,`c`.`natcode` AS `natcode`,`c`.`ntnname` AS `ntnname`,`c`.`regioncode` AS `regioncode`,`g`.`regionname` AS `regionname`,`f`.`title` AS `title`,`f`.`dob` AS `dob`,`f`.`pinno` AS `pinno`,`f`.`idpassip` AS `idpassip`,`f`.`idpassdi` AS `idpassdi`,`f`.`idpassdx` AS `idpassdx`,`f`.`institutionname` AS `institutionname`,`f`.`qualification` AS `qualification`,`f`.`specarea` AS `specarea`,`f`.`mobile` AS `mobile`,`f`.`postaddress` AS `postaddress`,`f`.`postcode` AS `postcode`,`f`.`town` AS `town`,`f`.`prmaddress` AS `prmaddress`,`f`.`prmpcode` AS `prmpcode`,`f`.`prmtown` AS `prmtown`,`f`.`prmphone` AS `prmphone`,`f`.`prmresidence` AS `prmresidence`,`f`.`secaddress` AS `secaddress`,`f`.`secpcode` AS `secpcode`,`f`.`sectown` AS `sectown`,`f`.`secphone` AS `secphone`,`f`.`secresidence` AS `secresidence`,`f`.`empaddress` AS `empaddress`,`f`.`emppcode` AS `emppcode`,`f`.`emptown` AS `emptown`,`f`.`emphone` AS `emphone`,`f`.`empctncode` AS `empctncode`,`f`.`docpassport` AS `docpassport`,`f`.`active` AS `active`,`y`.`position` AS `position`,`y`.`applyingas` AS `applyingas`,`a`.`asname` AS `applyingasname`,`y`.`orchid` AS `orchid`,`y`.`researcherid` AS `researcherid`,`y`.`legalofficername` AS `legalofficername`,`y`.`legalofficeremail` AS `legalofficeremail`,`y`.`projecttitle` AS `projecttitle`,`y`.`startdate` AS `startdate`,`y`.`enddate` AS `enddate`,`y`.`researchinstitution` AS `researchinstitution`,`y`.`institutiondepart` AS `institutiondepart`,`y`.`conductingresearch` AS `conductingresearch`,`y`.`resourcetype` AS `resourcetype`,`r`.`typename` AS `resourcetypename`,`y`.`speciesname` AS `speciesname`,`y`.`scientificname` AS `scientificname`,`y`.`commonname` AS `commonname`,`y`.`projectlocation` AS `projectlocation`,`y`.`projectarea` AS `projectarea`,`y`.`resourceallocationpurpose` AS `resourceallocationpurpose`,`y`.`exportanswer` AS `exportanswer`,`y`.`resourcetypeother` AS `resourcetypeother`,`y`.`purpose` AS `purpose`,`y`.`purposeother` AS `purposeother`,`y`.`documentregistration` AS `documentregistration`,`y`.`documentresearchproposal` AS `documentresearchproposal`,`y`.`documentaffiliation` AS `documentaffiliation`,`y`.`documentresearchbudget` AS `documentresearchbudget`,`y`.`documentcv` AS `documentcv`,`y`.`documentpic` AS `documentpic`,`y`.`documentmat` AS `documentmat`,`y`.`documentmta` AS `documentmta`,`y`.`documentip` AS `documentip`,`y`.`researchtype` AS `researchtype`,`t`.`typename` AS `researchtypename`,`y`.`samplesamount` AS `samplesamount`,`y`.`conservestatus` AS `conservestatus`,`y`.`conservestatusdesc` AS `conservestatusdesc`,`y`.`restraditionalknow` AS `restraditionalknow`,`y`.`exportgeneticresources` AS `exportgeneticresources`,`y`.`legislationagree` AS `legislationagree`,`y`.`sampleuom` AS `sampleuom`,`u`.`uomname` AS `sampleuomname`,`y`.`payamount1` AS `payamount1`,`y`.`payamount2` AS `payamount2`,`y`.`payamount3` AS `payamount3`,`y`.`payamount4` AS `payamount4`,`y`.`payamount5` AS `payamount5`,`y`.`payamount6` AS `payamount6`,`y`.`payamount7` AS `payamount7`,`y`.`payamount8` AS `payamount8`,`y`.`payamount9` AS `payamount9`,`y`.`payamount10` AS `payamount10`,`y`.`payamtusd1` AS `payamtusd1`,`y`.`payamtusd2` AS `payamtusd2`,`y`.`payamtusd3` AS `payamtusd3`,`y`.`payamtusd4` AS `payamtusd4`,`y`.`payamtusd5` AS `payamtusd5`,`y`.`payamtusd6` AS `payamtusd6`,`y`.`payamtusd7` AS `payamtusd7`,`y`.`payamtusd8` AS `payamtusd8`,`y`.`payamtusd9` AS `payamtusd9`,`y`.`payamtusd10` AS `payamtusd10` from (((((((`applicationstmp` `y` join `researchers` `f` on((`f`.`email` = `y`.`email`))) left join `countries` `c` on((`c`.`ctncode` = `f`.`ctncode`))) left join `countryregions` `g` on((`g`.`regioncode` = `c`.`regioncode`))) left join `applyas` `a` on((`a`.`ascode` = `y`.`applyingas`))) left join `researchtypes` `t` on((`t`.`typecode` = `y`.`researchtype`))) left join `resourcetypes` `r` on((`r`.`typecode` = `y`.`resourcetype`))) left join `sampleuom` `u` on((`u`.`uomcode` = `y`.`sampleuom`)));

DROP TABLE IF EXISTS `viewapproved1`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewapproved1` AS select `viewapplications`.`id` AS `id`,`viewapplications`.`appno` AS `appno`,`viewapplications`.`email` AS `email`,`viewapplications`.`firstname` AS `firstname`,`viewapplications`.`lastname` AS `lastname`,`viewapplications`.`gender` AS `gender`,`viewapplications`.`ctncode` AS `ctncode`,`viewapplications`.`ctnname` AS `ctnname`,`viewapplications`.`mobile` AS `mobile`,`viewapplications`.`position` AS `position`,`viewapplications`.`applyingas` AS `applyingas`,`viewapplications`.`applyingasname` AS `applyingasname`,`viewapplications`.`orcid` AS `orcid`,`viewapplications`.`researcherid` AS `researcherid`,`viewapplications`.`legalofficername` AS `legalofficername`,`viewapplications`.`legalofficeremail` AS `legalofficeremail`,`viewapplications`.`resourcetypes` AS `resourcetypes`,`viewapplications`.`resourcetype` AS `resourcetype`,`viewapplications`.`resourcetypename` AS `resourcetypename`,`viewapplications`.`speciesname` AS `speciesname`,`viewapplications`.`scientificname` AS `scientificname`,`viewapplications`.`commonname` AS `commonname`,`viewapplications`.`projectlocation` AS `projectlocation`,`viewapplications`.`projectarea` AS `projectarea`,`viewapplications`.`resourceallocationpurpose` AS `resourceallocationpurpose`,`viewapplications`.`exportanswer` AS `exportanswer`,`viewapplications`.`resourcetypeother` AS `resourcetypeother`,`viewapplications`.`export_port` AS `export_port`,`viewapplications`.`export_country` AS `export_country`,`viewapplications`.`purpose` AS `purpose`,`viewapplications`.`purposeother` AS `purposeother`,`viewapplications`.`documentregistration` AS `documentregistration`,`viewapplications`.`documentresearchproposal` AS `documentresearchproposal`,`viewapplications`.`documentaffiliation` AS `documentaffiliation`,`viewapplications`.`documentresearchbudget` AS `documentresearchbudget`,`viewapplications`.`documentcv` AS `documentcv`,`viewapplications`.`documentpic` AS `documentpic`,`viewapplications`.`documentmat` AS `documentmat`,`viewapplications`.`documentmta` AS `documentmta`,`viewapplications`.`documentip` AS `documentip`,`viewapplications`.`docpayment` AS `docpayment`,`viewapplications`.`researchtype` AS `researchtype`,`viewapplications`.`researchtypename` AS `researchtypename`,`viewapplications`.`samplesamount` AS `samplesamount`,`viewapplications`.`conservestatus` AS `conservestatus`,`viewapplications`.`conservestatusdesc` AS `conservestatusdesc`,`viewapplications`.`restraditionalknow` AS `restraditionalknow`,`viewapplications`.`exportgeneticresources` AS `exportgeneticresources`,`viewapplications`.`legislationagree` AS `legislationagree`,`viewapplications`.`sampleuom` AS `sampleuom`,`viewapplications`.`sampleuomname` AS `sampleuomname`,`viewapplications`.`apptime` AS `apptime`,`viewapplications`.`approved1` AS `approved1`,`viewapplications`.`approved2` AS `approved2`,`viewapplications`.`approved3` AS `approved3`,`viewapplications`.`approved4` AS `approved4`,`viewapplications`.`approved5` AS `approved5`,`viewapplications`.`approved6` AS `approved6`,`viewapplications`.`approved7` AS `approved7`,`viewapplications`.`approved8` AS `approved8`,`viewapplications`.`approved9` AS `approved9`,`viewapplications`.`approved10` AS `approved10`,`viewapplications`.`aprcomment1` AS `aprcomment1`,`viewapplications`.`aprcomment2` AS `aprcomment2`,`viewapplications`.`aprcomment3` AS `aprcomment3`,`viewapplications`.`aprcomment4` AS `aprcomment4`,`viewapplications`.`aprcomment5` AS `aprcomment5`,`viewapplications`.`aprcomment6` AS `aprcomment6`,`viewapplications`.`aprcomment7` AS `aprcomment7`,`viewapplications`.`aprcomment8` AS `aprcomment8`,`viewapplications`.`aprcomment9` AS `aprcomment9`,`viewapplications`.`aprcomment10` AS `aprcomment10`,`viewapplications`.`discomment1` AS `discomment1`,`viewapplications`.`discomment2` AS `discomment2`,`viewapplications`.`discomment3` AS `discomment3`,`viewapplications`.`discomment4` AS `discomment4`,`viewapplications`.`discomment5` AS `discomment5`,`viewapplications`.`discomment6` AS `discomment6`,`viewapplications`.`discomment7` AS `discomment7`,`viewapplications`.`discomment8` AS `discomment8`,`viewapplications`.`discomment9` AS `discomment9`,`viewapplications`.`discomment10` AS `discomment10`,`viewapplications`.`paid1` AS `paid1`,`viewapplications`.`paid2` AS `paid2`,`viewapplications`.`paid3` AS `paid3`,`viewapplications`.`paid4` AS `paid4`,`viewapplications`.`paid5` AS `paid5`,`viewapplications`.`paid6` AS `paid6`,`viewapplications`.`paid7` AS `paid7`,`viewapplications`.`paid8` AS `paid8`,`viewapplications`.`paid9` AS `paid9`,`viewapplications`.`paid10` AS `paid10`,`viewapplications`.`payref1` AS `payref1`,`viewapplications`.`payref2` AS `payref2`,`viewapplications`.`payref3` AS `payref3`,`viewapplications`.`payref4` AS `payref4`,`viewapplications`.`payref5` AS `payref5`,`viewapplications`.`payref6` AS `payref6`,`viewapplications`.`payref7` AS `payref7`,`viewapplications`.`payref8` AS `payref8`,`viewapplications`.`payref9` AS `payref9`,`viewapplications`.`payref10` AS `payref10`,`viewapplications`.`paytime1` AS `paytime1`,`viewapplications`.`paytime2` AS `paytime2`,`viewapplications`.`paytime3` AS `paytime3`,`viewapplications`.`paytime4` AS `paytime4`,`viewapplications`.`paytime5` AS `paytime5`,`viewapplications`.`paytime6` AS `paytime6`,`viewapplications`.`paytime7` AS `paytime7`,`viewapplications`.`paytime8` AS `paytime8`,`viewapplications`.`paytime9` AS `paytime9`,`viewapplications`.`paytime10` AS `paytime10`,`viewapplications`.`paymode1` AS `paymode1`,`viewapplications`.`paymode2` AS `paymode2`,`viewapplications`.`paymode3` AS `paymode3`,`viewapplications`.`paymode4` AS `paymode4`,`viewapplications`.`paymode5` AS `paymode5`,`viewapplications`.`paymode6` AS `paymode6`,`viewapplications`.`paymode7` AS `paymode7`,`viewapplications`.`paymode8` AS `paymode8`,`viewapplications`.`paymode9` AS `paymode9`,`viewapplications`.`paymode10` AS `paymode10`,`viewapplications`.`routed` AS `routed`,`viewapplications`.`instcode` AS `instcode` from `viewapplications` where ((`viewapplications`.`approved1` = 1) and (isnull(`viewapplications`.`approved2`) or (`viewapplications`.`approved2` = 0)));

DROP TABLE IF EXISTS `viewapproved2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewapproved2` AS select `viewapplications`.`id` AS `id`,`viewapplications`.`appno` AS `appno`,`viewapplications`.`email` AS `email`,`viewapplications`.`idpassno` AS `idpassno`,`viewapplications`.`firstname` AS `firstname`,`viewapplications`.`lastname` AS `lastname`,`viewapplications`.`midname` AS `midname`,`viewapplications`.`fullname` AS `fullname`,`viewapplications`.`gender` AS `gender`,`viewapplications`.`ctncode` AS `ctncode`,`viewapplications`.`ctnname` AS `ctnname`,`viewapplications`.`natcode` AS `natcode`,`viewapplications`.`ntnname` AS `ntnname`,`viewapplications`.`regioncode` AS `regioncode`,`viewapplications`.`regionname` AS `regionname`,`viewapplications`.`title` AS `title`,`viewapplications`.`dob` AS `dob`,`viewapplications`.`pinno` AS `pinno`,`viewapplications`.`idpassip` AS `idpassip`,`viewapplications`.`idpassdi` AS `idpassdi`,`viewapplications`.`idpassdx` AS `idpassdx`,`viewapplications`.`institutionname` AS `institutionname`,`viewapplications`.`qualification` AS `qualification`,`viewapplications`.`specarea` AS `specarea`,`viewapplications`.`mobile` AS `mobile`,`viewapplications`.`postaddress` AS `postaddress`,`viewapplications`.`postcode` AS `postcode`,`viewapplications`.`town` AS `town`,`viewapplications`.`prmaddress` AS `prmaddress`,`viewapplications`.`prmpcode` AS `prmpcode`,`viewapplications`.`prmtown` AS `prmtown`,`viewapplications`.`prmphone` AS `prmphone`,`viewapplications`.`prmresidence` AS `prmresidence`,`viewapplications`.`secaddress` AS `secaddress`,`viewapplications`.`secpcode` AS `secpcode`,`viewapplications`.`sectown` AS `sectown`,`viewapplications`.`secphone` AS `secphone`,`viewapplications`.`secresidence` AS `secresidence`,`viewapplications`.`empaddress` AS `empaddress`,`viewapplications`.`emppcode` AS `emppcode`,`viewapplications`.`emptown` AS `emptown`,`viewapplications`.`emphone` AS `emphone`,`viewapplications`.`empctncode` AS `empctncode`,`viewapplications`.`docpassport` AS `docpassport`,`viewapplications`.`active` AS `active`,`viewapplications`.`position` AS `position`,`viewapplications`.`applyingas` AS `applyingas`,`viewapplications`.`applyingasname` AS `applyingasname`,`viewapplications`.`orchid` AS `orchid`,`viewapplications`.`researcherid` AS `researcherid`,`viewapplications`.`legalofficername` AS `legalofficername`,`viewapplications`.`legalofficeremail` AS `legalofficeremail`,`viewapplications`.`projecttitle` AS `projecttitle`,`viewapplications`.`startdate` AS `startdate`,`viewapplications`.`enddate` AS `enddate`,`viewapplications`.`researchinstitution` AS `researchinstitution`,`viewapplications`.`institutiondepart` AS `institutiondepart`,`viewapplications`.`conductingresearch` AS `conductingresearch`,`viewapplications`.`resourcetype` AS `resourcetype`,`viewapplications`.`resourcetypename` AS `resourcetypename`,`viewapplications`.`speciesname` AS `speciesname`,`viewapplications`.`scientificname` AS `scientificname`,`viewapplications`.`commonname` AS `commonname`,`viewapplications`.`projectlocation` AS `projectlocation`,`viewapplications`.`projectarea` AS `projectarea`,`viewapplications`.`resourceallocationpurpose` AS `resourceallocationpurpose`,`viewapplications`.`exportanswer` AS `exportanswer`,`viewapplications`.`resourcetypeother` AS `resourcetypeother`,`viewapplications`.`purpose` AS `purpose`,`viewapplications`.`purposeother` AS `purposeother`,`viewapplications`.`documentregistration` AS `documentregistration`,`viewapplications`.`documentresearchproposal` AS `documentresearchproposal`,`viewapplications`.`documentaffiliation` AS `documentaffiliation`,`viewapplications`.`documentresearchbudget` AS `documentresearchbudget`,`viewapplications`.`documentcv` AS `documentcv`,`viewapplications`.`documentpic` AS `documentpic`,`viewapplications`.`documentmat` AS `documentmat`,`viewapplications`.`documentmta` AS `documentmta`,`viewapplications`.`documentip` AS `documentip`,`viewapplications`.`researchtype` AS `researchtype`,`viewapplications`.`researchtypename` AS `researchtypename`,`viewapplications`.`samplesamount` AS `samplesamount`,`viewapplications`.`conservestatus` AS `conservestatus`,`viewapplications`.`conservestatusdesc` AS `conservestatusdesc`,`viewapplications`.`restraditionalknow` AS `restraditionalknow`,`viewapplications`.`exportgeneticresources` AS `exportgeneticresources`,`viewapplications`.`legislationagree` AS `legislationagree`,`viewapplications`.`sampleuom` AS `sampleuom`,`viewapplications`.`sampleuomname` AS `sampleuomname`,`viewapplications`.`apptime` AS `apptime`,`viewapplications`.`approved1` AS `approved1`,`viewapplications`.`approved2` AS `approved2`,`viewapplications`.`approved3` AS `approved3`,`viewapplications`.`approved4` AS `approved4`,`viewapplications`.`approved5` AS `approved5`,`viewapplications`.`approved6` AS `approved6`,`viewapplications`.`approved7` AS `approved7`,`viewapplications`.`approved8` AS `approved8`,`viewapplications`.`approved9` AS `approved9`,`viewapplications`.`approved10` AS `approved10`,`viewapplications`.`aprcomment1` AS `aprcomment1`,`viewapplications`.`aprcomment2` AS `aprcomment2`,`viewapplications`.`aprcomment3` AS `aprcomment3`,`viewapplications`.`aprcomment4` AS `aprcomment4`,`viewapplications`.`aprcomment5` AS `aprcomment5`,`viewapplications`.`aprcomment6` AS `aprcomment6`,`viewapplications`.`aprcomment7` AS `aprcomment7`,`viewapplications`.`aprcomment8` AS `aprcomment8`,`viewapplications`.`aprcomment9` AS `aprcomment9`,`viewapplications`.`aprcomment10` AS `aprcomment10`,`viewapplications`.`discomment1` AS `discomment1`,`viewapplications`.`discomment2` AS `discomment2`,`viewapplications`.`discomment3` AS `discomment3`,`viewapplications`.`discomment4` AS `discomment4`,`viewapplications`.`discomment5` AS `discomment5`,`viewapplications`.`discomment6` AS `discomment6`,`viewapplications`.`discomment7` AS `discomment7`,`viewapplications`.`discomment8` AS `discomment8`,`viewapplications`.`discomment9` AS `discomment9`,`viewapplications`.`discomment10` AS `discomment10`,`viewapplications`.`payamount1` AS `payamount1`,`viewapplications`.`payamount2` AS `payamount2`,`viewapplications`.`payamount3` AS `payamount3`,`viewapplications`.`payamount4` AS `payamount4`,`viewapplications`.`payamount5` AS `payamount5`,`viewapplications`.`payamount6` AS `payamount6`,`viewapplications`.`payamount7` AS `payamount7`,`viewapplications`.`payamount8` AS `payamount8`,`viewapplications`.`payamount9` AS `payamount9`,`viewapplications`.`payamount10` AS `payamount10`,`viewapplications`.`payamtusd1` AS `payamtusd1`,`viewapplications`.`payamtusd2` AS `payamtusd2`,`viewapplications`.`payamtusd3` AS `payamtusd3`,`viewapplications`.`payamtusd4` AS `payamtusd4`,`viewapplications`.`payamtusd5` AS `payamtusd5`,`viewapplications`.`payamtusd6` AS `payamtusd6`,`viewapplications`.`payamtusd7` AS `payamtusd7`,`viewapplications`.`payamtusd8` AS `payamtusd8`,`viewapplications`.`payamtusd9` AS `payamtusd9`,`viewapplications`.`payamtusd10` AS `payamtusd10` from `viewapplications` where (((`viewapplications`.`approved2` = 1) and isnull(`viewapplications`.`approved3`)) or (`viewapplications`.`approved3` = 0));

DROP TABLE IF EXISTS `viewapproved3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewapproved3` AS select `viewapplications`.`id` AS `id`,`viewapplications`.`appno` AS `appno`,`viewapplications`.`email` AS `email`,`viewapplications`.`idpassno` AS `idpassno`,`viewapplications`.`firstname` AS `firstname`,`viewapplications`.`lastname` AS `lastname`,`viewapplications`.`midname` AS `midname`,`viewapplications`.`fullname` AS `fullname`,`viewapplications`.`gender` AS `gender`,`viewapplications`.`ctncode` AS `ctncode`,`viewapplications`.`ctnname` AS `ctnname`,`viewapplications`.`natcode` AS `natcode`,`viewapplications`.`ntnname` AS `ntnname`,`viewapplications`.`regioncode` AS `regioncode`,`viewapplications`.`regionname` AS `regionname`,`viewapplications`.`title` AS `title`,`viewapplications`.`dob` AS `dob`,`viewapplications`.`pinno` AS `pinno`,`viewapplications`.`idpassip` AS `idpassip`,`viewapplications`.`idpassdi` AS `idpassdi`,`viewapplications`.`idpassdx` AS `idpassdx`,`viewapplications`.`institutionname` AS `institutionname`,`viewapplications`.`qualification` AS `qualification`,`viewapplications`.`specarea` AS `specarea`,`viewapplications`.`mobile` AS `mobile`,`viewapplications`.`postaddress` AS `postaddress`,`viewapplications`.`postcode` AS `postcode`,`viewapplications`.`town` AS `town`,`viewapplications`.`prmaddress` AS `prmaddress`,`viewapplications`.`prmpcode` AS `prmpcode`,`viewapplications`.`prmtown` AS `prmtown`,`viewapplications`.`prmphone` AS `prmphone`,`viewapplications`.`prmresidence` AS `prmresidence`,`viewapplications`.`secaddress` AS `secaddress`,`viewapplications`.`secpcode` AS `secpcode`,`viewapplications`.`sectown` AS `sectown`,`viewapplications`.`secphone` AS `secphone`,`viewapplications`.`secresidence` AS `secresidence`,`viewapplications`.`empaddress` AS `empaddress`,`viewapplications`.`emppcode` AS `emppcode`,`viewapplications`.`emptown` AS `emptown`,`viewapplications`.`emphone` AS `emphone`,`viewapplications`.`empctncode` AS `empctncode`,`viewapplications`.`docpassport` AS `docpassport`,`viewapplications`.`active` AS `active`,`viewapplications`.`position` AS `position`,`viewapplications`.`applyingas` AS `applyingas`,`viewapplications`.`applyingasname` AS `applyingasname`,`viewapplications`.`orchid` AS `orchid`,`viewapplications`.`researcherid` AS `researcherid`,`viewapplications`.`legalofficername` AS `legalofficername`,`viewapplications`.`legalofficeremail` AS `legalofficeremail`,`viewapplications`.`projecttitle` AS `projecttitle`,`viewapplications`.`startdate` AS `startdate`,`viewapplications`.`enddate` AS `enddate`,`viewapplications`.`researchinstitution` AS `researchinstitution`,`viewapplications`.`institutiondepart` AS `institutiondepart`,`viewapplications`.`conductingresearch` AS `conductingresearch`,`viewapplications`.`resourcetype` AS `resourcetype`,`viewapplications`.`resourcetypename` AS `resourcetypename`,`viewapplications`.`speciesname` AS `speciesname`,`viewapplications`.`scientificname` AS `scientificname`,`viewapplications`.`commonname` AS `commonname`,`viewapplications`.`projectlocation` AS `projectlocation`,`viewapplications`.`projectarea` AS `projectarea`,`viewapplications`.`resourceallocationpurpose` AS `resourceallocationpurpose`,`viewapplications`.`exportanswer` AS `exportanswer`,`viewapplications`.`resourcetypeother` AS `resourcetypeother`,`viewapplications`.`purpose` AS `purpose`,`viewapplications`.`purposeother` AS `purposeother`,`viewapplications`.`documentregistration` AS `documentregistration`,`viewapplications`.`documentresearchproposal` AS `documentresearchproposal`,`viewapplications`.`documentaffiliation` AS `documentaffiliation`,`viewapplications`.`documentresearchbudget` AS `documentresearchbudget`,`viewapplications`.`documentcv` AS `documentcv`,`viewapplications`.`documentpic` AS `documentpic`,`viewapplications`.`documentmat` AS `documentmat`,`viewapplications`.`documentmta` AS `documentmta`,`viewapplications`.`documentip` AS `documentip`,`viewapplications`.`researchtype` AS `researchtype`,`viewapplications`.`researchtypename` AS `researchtypename`,`viewapplications`.`samplesamount` AS `samplesamount`,`viewapplications`.`conservestatus` AS `conservestatus`,`viewapplications`.`conservestatusdesc` AS `conservestatusdesc`,`viewapplications`.`restraditionalknow` AS `restraditionalknow`,`viewapplications`.`exportgeneticresources` AS `exportgeneticresources`,`viewapplications`.`legislationagree` AS `legislationagree`,`viewapplications`.`sampleuom` AS `sampleuom`,`viewapplications`.`sampleuomname` AS `sampleuomname`,`viewapplications`.`apptime` AS `apptime`,`viewapplications`.`approved1` AS `approved1`,`viewapplications`.`approved2` AS `approved2`,`viewapplications`.`approved3` AS `approved3`,`viewapplications`.`approved4` AS `approved4`,`viewapplications`.`approved5` AS `approved5`,`viewapplications`.`approved6` AS `approved6`,`viewapplications`.`approved7` AS `approved7`,`viewapplications`.`approved8` AS `approved8`,`viewapplications`.`approved9` AS `approved9`,`viewapplications`.`approved10` AS `approved10`,`viewapplications`.`aprcomment1` AS `aprcomment1`,`viewapplications`.`aprcomment2` AS `aprcomment2`,`viewapplications`.`aprcomment3` AS `aprcomment3`,`viewapplications`.`aprcomment4` AS `aprcomment4`,`viewapplications`.`aprcomment5` AS `aprcomment5`,`viewapplications`.`aprcomment6` AS `aprcomment6`,`viewapplications`.`aprcomment7` AS `aprcomment7`,`viewapplications`.`aprcomment8` AS `aprcomment8`,`viewapplications`.`aprcomment9` AS `aprcomment9`,`viewapplications`.`aprcomment10` AS `aprcomment10`,`viewapplications`.`discomment1` AS `discomment1`,`viewapplications`.`discomment2` AS `discomment2`,`viewapplications`.`discomment3` AS `discomment3`,`viewapplications`.`discomment4` AS `discomment4`,`viewapplications`.`discomment5` AS `discomment5`,`viewapplications`.`discomment6` AS `discomment6`,`viewapplications`.`discomment7` AS `discomment7`,`viewapplications`.`discomment8` AS `discomment8`,`viewapplications`.`discomment9` AS `discomment9`,`viewapplications`.`discomment10` AS `discomment10`,`viewapplications`.`payamount1` AS `payamount1`,`viewapplications`.`payamount2` AS `payamount2`,`viewapplications`.`payamount3` AS `payamount3`,`viewapplications`.`payamount4` AS `payamount4`,`viewapplications`.`payamount5` AS `payamount5`,`viewapplications`.`payamount6` AS `payamount6`,`viewapplications`.`payamount7` AS `payamount7`,`viewapplications`.`payamount8` AS `payamount8`,`viewapplications`.`payamount9` AS `payamount9`,`viewapplications`.`payamount10` AS `payamount10`,`viewapplications`.`payamtusd1` AS `payamtusd1`,`viewapplications`.`payamtusd2` AS `payamtusd2`,`viewapplications`.`payamtusd3` AS `payamtusd3`,`viewapplications`.`payamtusd4` AS `payamtusd4`,`viewapplications`.`payamtusd5` AS `payamtusd5`,`viewapplications`.`payamtusd6` AS `payamtusd6`,`viewapplications`.`payamtusd7` AS `payamtusd7`,`viewapplications`.`payamtusd8` AS `payamtusd8`,`viewapplications`.`payamtusd9` AS `payamtusd9`,`viewapplications`.`payamtusd10` AS `payamtusd10` from `viewapplications` where (((`viewapplications`.`approved3` = 1) and isnull(`viewapplications`.`approved4`)) or (`viewapplications`.`approved4` = 0));

DROP TABLE IF EXISTS `viewapproved4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewapproved4` AS select `viewapplications`.`id` AS `id`,`viewapplications`.`appno` AS `appno`,`viewapplications`.`email` AS `email`,`viewapplications`.`idpassno` AS `idpassno`,`viewapplications`.`firstname` AS `firstname`,`viewapplications`.`lastname` AS `lastname`,`viewapplications`.`midname` AS `midname`,`viewapplications`.`fullname` AS `fullname`,`viewapplications`.`gender` AS `gender`,`viewapplications`.`ctncode` AS `ctncode`,`viewapplications`.`ctnname` AS `ctnname`,`viewapplications`.`natcode` AS `natcode`,`viewapplications`.`ntnname` AS `ntnname`,`viewapplications`.`regioncode` AS `regioncode`,`viewapplications`.`regionname` AS `regionname`,`viewapplications`.`title` AS `title`,`viewapplications`.`dob` AS `dob`,`viewapplications`.`pinno` AS `pinno`,`viewapplications`.`idpassip` AS `idpassip`,`viewapplications`.`idpassdi` AS `idpassdi`,`viewapplications`.`idpassdx` AS `idpassdx`,`viewapplications`.`institutionname` AS `institutionname`,`viewapplications`.`qualification` AS `qualification`,`viewapplications`.`specarea` AS `specarea`,`viewapplications`.`mobile` AS `mobile`,`viewapplications`.`postaddress` AS `postaddress`,`viewapplications`.`postcode` AS `postcode`,`viewapplications`.`town` AS `town`,`viewapplications`.`prmaddress` AS `prmaddress`,`viewapplications`.`prmpcode` AS `prmpcode`,`viewapplications`.`prmtown` AS `prmtown`,`viewapplications`.`prmphone` AS `prmphone`,`viewapplications`.`prmresidence` AS `prmresidence`,`viewapplications`.`secaddress` AS `secaddress`,`viewapplications`.`secpcode` AS `secpcode`,`viewapplications`.`sectown` AS `sectown`,`viewapplications`.`secphone` AS `secphone`,`viewapplications`.`secresidence` AS `secresidence`,`viewapplications`.`empaddress` AS `empaddress`,`viewapplications`.`emppcode` AS `emppcode`,`viewapplications`.`emptown` AS `emptown`,`viewapplications`.`emphone` AS `emphone`,`viewapplications`.`empctncode` AS `empctncode`,`viewapplications`.`docpassport` AS `docpassport`,`viewapplications`.`active` AS `active`,`viewapplications`.`position` AS `position`,`viewapplications`.`applyingas` AS `applyingas`,`viewapplications`.`applyingasname` AS `applyingasname`,`viewapplications`.`orchid` AS `orchid`,`viewapplications`.`researcherid` AS `researcherid`,`viewapplications`.`legalofficername` AS `legalofficername`,`viewapplications`.`legalofficeremail` AS `legalofficeremail`,`viewapplications`.`projecttitle` AS `projecttitle`,`viewapplications`.`startdate` AS `startdate`,`viewapplications`.`enddate` AS `enddate`,`viewapplications`.`researchinstitution` AS `researchinstitution`,`viewapplications`.`institutiondepart` AS `institutiondepart`,`viewapplications`.`conductingresearch` AS `conductingresearch`,`viewapplications`.`resourcetype` AS `resourcetype`,`viewapplications`.`resourcetypename` AS `resourcetypename`,`viewapplications`.`speciesname` AS `speciesname`,`viewapplications`.`scientificname` AS `scientificname`,`viewapplications`.`commonname` AS `commonname`,`viewapplications`.`projectlocation` AS `projectlocation`,`viewapplications`.`projectarea` AS `projectarea`,`viewapplications`.`resourceallocationpurpose` AS `resourceallocationpurpose`,`viewapplications`.`exportanswer` AS `exportanswer`,`viewapplications`.`resourcetypeother` AS `resourcetypeother`,`viewapplications`.`purpose` AS `purpose`,`viewapplications`.`purposeother` AS `purposeother`,`viewapplications`.`documentregistration` AS `documentregistration`,`viewapplications`.`documentresearchproposal` AS `documentresearchproposal`,`viewapplications`.`documentaffiliation` AS `documentaffiliation`,`viewapplications`.`documentresearchbudget` AS `documentresearchbudget`,`viewapplications`.`documentcv` AS `documentcv`,`viewapplications`.`documentpic` AS `documentpic`,`viewapplications`.`documentmat` AS `documentmat`,`viewapplications`.`documentmta` AS `documentmta`,`viewapplications`.`documentip` AS `documentip`,`viewapplications`.`researchtype` AS `researchtype`,`viewapplications`.`researchtypename` AS `researchtypename`,`viewapplications`.`samplesamount` AS `samplesamount`,`viewapplications`.`conservestatus` AS `conservestatus`,`viewapplications`.`conservestatusdesc` AS `conservestatusdesc`,`viewapplications`.`restraditionalknow` AS `restraditionalknow`,`viewapplications`.`exportgeneticresources` AS `exportgeneticresources`,`viewapplications`.`legislationagree` AS `legislationagree`,`viewapplications`.`sampleuom` AS `sampleuom`,`viewapplications`.`sampleuomname` AS `sampleuomname`,`viewapplications`.`apptime` AS `apptime`,`viewapplications`.`approved1` AS `approved1`,`viewapplications`.`approved2` AS `approved2`,`viewapplications`.`approved3` AS `approved3`,`viewapplications`.`approved4` AS `approved4`,`viewapplications`.`approved5` AS `approved5`,`viewapplications`.`approved6` AS `approved6`,`viewapplications`.`approved7` AS `approved7`,`viewapplications`.`approved8` AS `approved8`,`viewapplications`.`approved9` AS `approved9`,`viewapplications`.`approved10` AS `approved10`,`viewapplications`.`aprcomment1` AS `aprcomment1`,`viewapplications`.`aprcomment2` AS `aprcomment2`,`viewapplications`.`aprcomment3` AS `aprcomment3`,`viewapplications`.`aprcomment4` AS `aprcomment4`,`viewapplications`.`aprcomment5` AS `aprcomment5`,`viewapplications`.`aprcomment6` AS `aprcomment6`,`viewapplications`.`aprcomment7` AS `aprcomment7`,`viewapplications`.`aprcomment8` AS `aprcomment8`,`viewapplications`.`aprcomment9` AS `aprcomment9`,`viewapplications`.`aprcomment10` AS `aprcomment10`,`viewapplications`.`discomment1` AS `discomment1`,`viewapplications`.`discomment2` AS `discomment2`,`viewapplications`.`discomment3` AS `discomment3`,`viewapplications`.`discomment4` AS `discomment4`,`viewapplications`.`discomment5` AS `discomment5`,`viewapplications`.`discomment6` AS `discomment6`,`viewapplications`.`discomment7` AS `discomment7`,`viewapplications`.`discomment8` AS `discomment8`,`viewapplications`.`discomment9` AS `discomment9`,`viewapplications`.`discomment10` AS `discomment10`,`viewapplications`.`payamount1` AS `payamount1`,`viewapplications`.`payamount2` AS `payamount2`,`viewapplications`.`payamount3` AS `payamount3`,`viewapplications`.`payamount4` AS `payamount4`,`viewapplications`.`payamount5` AS `payamount5`,`viewapplications`.`payamount6` AS `payamount6`,`viewapplications`.`payamount7` AS `payamount7`,`viewapplications`.`payamount8` AS `payamount8`,`viewapplications`.`payamount9` AS `payamount9`,`viewapplications`.`payamount10` AS `payamount10`,`viewapplications`.`payamtusd1` AS `payamtusd1`,`viewapplications`.`payamtusd2` AS `payamtusd2`,`viewapplications`.`payamtusd3` AS `payamtusd3`,`viewapplications`.`payamtusd4` AS `payamtusd4`,`viewapplications`.`payamtusd5` AS `payamtusd5`,`viewapplications`.`payamtusd6` AS `payamtusd6`,`viewapplications`.`payamtusd7` AS `payamtusd7`,`viewapplications`.`payamtusd8` AS `payamtusd8`,`viewapplications`.`payamtusd9` AS `payamtusd9`,`viewapplications`.`payamtusd10` AS `payamtusd10` from `viewapplications` where (((`viewapplications`.`approved4` = 1) and isnull(`viewapplications`.`approved5`)) or (`viewapplications`.`approved5` = 0));

DROP TABLE IF EXISTS `viewapproved5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewapproved5` AS select `viewapplications`.`id` AS `id`,`viewapplications`.`appno` AS `appno`,`viewapplications`.`email` AS `email`,`viewapplications`.`idpassno` AS `idpassno`,`viewapplications`.`firstname` AS `firstname`,`viewapplications`.`lastname` AS `lastname`,`viewapplications`.`midname` AS `midname`,`viewapplications`.`fullname` AS `fullname`,`viewapplications`.`gender` AS `gender`,`viewapplications`.`ctncode` AS `ctncode`,`viewapplications`.`ctnname` AS `ctnname`,`viewapplications`.`natcode` AS `natcode`,`viewapplications`.`ntnname` AS `ntnname`,`viewapplications`.`regioncode` AS `regioncode`,`viewapplications`.`regionname` AS `regionname`,`viewapplications`.`title` AS `title`,`viewapplications`.`dob` AS `dob`,`viewapplications`.`pinno` AS `pinno`,`viewapplications`.`idpassip` AS `idpassip`,`viewapplications`.`idpassdi` AS `idpassdi`,`viewapplications`.`idpassdx` AS `idpassdx`,`viewapplications`.`institutionname` AS `institutionname`,`viewapplications`.`qualification` AS `qualification`,`viewapplications`.`specarea` AS `specarea`,`viewapplications`.`mobile` AS `mobile`,`viewapplications`.`postaddress` AS `postaddress`,`viewapplications`.`postcode` AS `postcode`,`viewapplications`.`town` AS `town`,`viewapplications`.`prmaddress` AS `prmaddress`,`viewapplications`.`prmpcode` AS `prmpcode`,`viewapplications`.`prmtown` AS `prmtown`,`viewapplications`.`prmphone` AS `prmphone`,`viewapplications`.`prmresidence` AS `prmresidence`,`viewapplications`.`secaddress` AS `secaddress`,`viewapplications`.`secpcode` AS `secpcode`,`viewapplications`.`sectown` AS `sectown`,`viewapplications`.`secphone` AS `secphone`,`viewapplications`.`secresidence` AS `secresidence`,`viewapplications`.`empaddress` AS `empaddress`,`viewapplications`.`emppcode` AS `emppcode`,`viewapplications`.`emptown` AS `emptown`,`viewapplications`.`emphone` AS `emphone`,`viewapplications`.`empctncode` AS `empctncode`,`viewapplications`.`docpassport` AS `docpassport`,`viewapplications`.`active` AS `active`,`viewapplications`.`position` AS `position`,`viewapplications`.`applyingas` AS `applyingas`,`viewapplications`.`applyingasname` AS `applyingasname`,`viewapplications`.`orchid` AS `orchid`,`viewapplications`.`researcherid` AS `researcherid`,`viewapplications`.`legalofficername` AS `legalofficername`,`viewapplications`.`legalofficeremail` AS `legalofficeremail`,`viewapplications`.`projecttitle` AS `projecttitle`,`viewapplications`.`startdate` AS `startdate`,`viewapplications`.`enddate` AS `enddate`,`viewapplications`.`researchinstitution` AS `researchinstitution`,`viewapplications`.`institutiondepart` AS `institutiondepart`,`viewapplications`.`conductingresearch` AS `conductingresearch`,`viewapplications`.`resourcetype` AS `resourcetype`,`viewapplications`.`resourcetypename` AS `resourcetypename`,`viewapplications`.`speciesname` AS `speciesname`,`viewapplications`.`scientificname` AS `scientificname`,`viewapplications`.`commonname` AS `commonname`,`viewapplications`.`projectlocation` AS `projectlocation`,`viewapplications`.`projectarea` AS `projectarea`,`viewapplications`.`resourceallocationpurpose` AS `resourceallocationpurpose`,`viewapplications`.`exportanswer` AS `exportanswer`,`viewapplications`.`resourcetypeother` AS `resourcetypeother`,`viewapplications`.`purpose` AS `purpose`,`viewapplications`.`purposeother` AS `purposeother`,`viewapplications`.`documentregistration` AS `documentregistration`,`viewapplications`.`documentresearchproposal` AS `documentresearchproposal`,`viewapplications`.`documentaffiliation` AS `documentaffiliation`,`viewapplications`.`documentresearchbudget` AS `documentresearchbudget`,`viewapplications`.`documentcv` AS `documentcv`,`viewapplications`.`documentpic` AS `documentpic`,`viewapplications`.`documentmat` AS `documentmat`,`viewapplications`.`documentmta` AS `documentmta`,`viewapplications`.`documentip` AS `documentip`,`viewapplications`.`researchtype` AS `researchtype`,`viewapplications`.`researchtypename` AS `researchtypename`,`viewapplications`.`samplesamount` AS `samplesamount`,`viewapplications`.`conservestatus` AS `conservestatus`,`viewapplications`.`conservestatusdesc` AS `conservestatusdesc`,`viewapplications`.`restraditionalknow` AS `restraditionalknow`,`viewapplications`.`exportgeneticresources` AS `exportgeneticresources`,`viewapplications`.`legislationagree` AS `legislationagree`,`viewapplications`.`sampleuom` AS `sampleuom`,`viewapplications`.`sampleuomname` AS `sampleuomname`,`viewapplications`.`apptime` AS `apptime`,`viewapplications`.`approved1` AS `approved1`,`viewapplications`.`approved2` AS `approved2`,`viewapplications`.`approved3` AS `approved3`,`viewapplications`.`approved4` AS `approved4`,`viewapplications`.`approved5` AS `approved5`,`viewapplications`.`approved6` AS `approved6`,`viewapplications`.`approved7` AS `approved7`,`viewapplications`.`approved8` AS `approved8`,`viewapplications`.`approved9` AS `approved9`,`viewapplications`.`approved10` AS `approved10`,`viewapplications`.`aprcomment1` AS `aprcomment1`,`viewapplications`.`aprcomment2` AS `aprcomment2`,`viewapplications`.`aprcomment3` AS `aprcomment3`,`viewapplications`.`aprcomment4` AS `aprcomment4`,`viewapplications`.`aprcomment5` AS `aprcomment5`,`viewapplications`.`aprcomment6` AS `aprcomment6`,`viewapplications`.`aprcomment7` AS `aprcomment7`,`viewapplications`.`aprcomment8` AS `aprcomment8`,`viewapplications`.`aprcomment9` AS `aprcomment9`,`viewapplications`.`aprcomment10` AS `aprcomment10`,`viewapplications`.`discomment1` AS `discomment1`,`viewapplications`.`discomment2` AS `discomment2`,`viewapplications`.`discomment3` AS `discomment3`,`viewapplications`.`discomment4` AS `discomment4`,`viewapplications`.`discomment5` AS `discomment5`,`viewapplications`.`discomment6` AS `discomment6`,`viewapplications`.`discomment7` AS `discomment7`,`viewapplications`.`discomment8` AS `discomment8`,`viewapplications`.`discomment9` AS `discomment9`,`viewapplications`.`discomment10` AS `discomment10`,`viewapplications`.`payamount1` AS `payamount1`,`viewapplications`.`payamount2` AS `payamount2`,`viewapplications`.`payamount3` AS `payamount3`,`viewapplications`.`payamount4` AS `payamount4`,`viewapplications`.`payamount5` AS `payamount5`,`viewapplications`.`payamount6` AS `payamount6`,`viewapplications`.`payamount7` AS `payamount7`,`viewapplications`.`payamount8` AS `payamount8`,`viewapplications`.`payamount9` AS `payamount9`,`viewapplications`.`payamount10` AS `payamount10`,`viewapplications`.`payamtusd1` AS `payamtusd1`,`viewapplications`.`payamtusd2` AS `payamtusd2`,`viewapplications`.`payamtusd3` AS `payamtusd3`,`viewapplications`.`payamtusd4` AS `payamtusd4`,`viewapplications`.`payamtusd5` AS `payamtusd5`,`viewapplications`.`payamtusd6` AS `payamtusd6`,`viewapplications`.`payamtusd7` AS `payamtusd7`,`viewapplications`.`payamtusd8` AS `payamtusd8`,`viewapplications`.`payamtusd9` AS `payamtusd9`,`viewapplications`.`payamtusd10` AS `payamtusd10` from `viewapplications` where (((`viewapplications`.`approved5` = 1) and isnull(`viewapplications`.`approved6`)) or (`viewapplications`.`approved6` = 0));

DROP TABLE IF EXISTS `viewapproved6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewapproved6` AS select `viewapplications`.`id` AS `id`,`viewapplications`.`appno` AS `appno`,`viewapplications`.`email` AS `email`,`viewapplications`.`idpassno` AS `idpassno`,`viewapplications`.`firstname` AS `firstname`,`viewapplications`.`lastname` AS `lastname`,`viewapplications`.`midname` AS `midname`,`viewapplications`.`fullname` AS `fullname`,`viewapplications`.`gender` AS `gender`,`viewapplications`.`ctncode` AS `ctncode`,`viewapplications`.`ctnname` AS `ctnname`,`viewapplications`.`natcode` AS `natcode`,`viewapplications`.`ntnname` AS `ntnname`,`viewapplications`.`regioncode` AS `regioncode`,`viewapplications`.`regionname` AS `regionname`,`viewapplications`.`title` AS `title`,`viewapplications`.`dob` AS `dob`,`viewapplications`.`pinno` AS `pinno`,`viewapplications`.`idpassip` AS `idpassip`,`viewapplications`.`idpassdi` AS `idpassdi`,`viewapplications`.`idpassdx` AS `idpassdx`,`viewapplications`.`institutionname` AS `institutionname`,`viewapplications`.`qualification` AS `qualification`,`viewapplications`.`specarea` AS `specarea`,`viewapplications`.`mobile` AS `mobile`,`viewapplications`.`postaddress` AS `postaddress`,`viewapplications`.`postcode` AS `postcode`,`viewapplications`.`town` AS `town`,`viewapplications`.`prmaddress` AS `prmaddress`,`viewapplications`.`prmpcode` AS `prmpcode`,`viewapplications`.`prmtown` AS `prmtown`,`viewapplications`.`prmphone` AS `prmphone`,`viewapplications`.`prmresidence` AS `prmresidence`,`viewapplications`.`secaddress` AS `secaddress`,`viewapplications`.`secpcode` AS `secpcode`,`viewapplications`.`sectown` AS `sectown`,`viewapplications`.`secphone` AS `secphone`,`viewapplications`.`secresidence` AS `secresidence`,`viewapplications`.`empaddress` AS `empaddress`,`viewapplications`.`emppcode` AS `emppcode`,`viewapplications`.`emptown` AS `emptown`,`viewapplications`.`emphone` AS `emphone`,`viewapplications`.`empctncode` AS `empctncode`,`viewapplications`.`docpassport` AS `docpassport`,`viewapplications`.`active` AS `active`,`viewapplications`.`position` AS `position`,`viewapplications`.`applyingas` AS `applyingas`,`viewapplications`.`applyingasname` AS `applyingasname`,`viewapplications`.`orchid` AS `orchid`,`viewapplications`.`researcherid` AS `researcherid`,`viewapplications`.`legalofficername` AS `legalofficername`,`viewapplications`.`legalofficeremail` AS `legalofficeremail`,`viewapplications`.`projecttitle` AS `projecttitle`,`viewapplications`.`startdate` AS `startdate`,`viewapplications`.`enddate` AS `enddate`,`viewapplications`.`researchinstitution` AS `researchinstitution`,`viewapplications`.`institutiondepart` AS `institutiondepart`,`viewapplications`.`conductingresearch` AS `conductingresearch`,`viewapplications`.`resourcetype` AS `resourcetype`,`viewapplications`.`resourcetypename` AS `resourcetypename`,`viewapplications`.`speciesname` AS `speciesname`,`viewapplications`.`scientificname` AS `scientificname`,`viewapplications`.`commonname` AS `commonname`,`viewapplications`.`projectlocation` AS `projectlocation`,`viewapplications`.`projectarea` AS `projectarea`,`viewapplications`.`resourceallocationpurpose` AS `resourceallocationpurpose`,`viewapplications`.`exportanswer` AS `exportanswer`,`viewapplications`.`resourcetypeother` AS `resourcetypeother`,`viewapplications`.`purpose` AS `purpose`,`viewapplications`.`purposeother` AS `purposeother`,`viewapplications`.`documentregistration` AS `documentregistration`,`viewapplications`.`documentresearchproposal` AS `documentresearchproposal`,`viewapplications`.`documentaffiliation` AS `documentaffiliation`,`viewapplications`.`documentresearchbudget` AS `documentresearchbudget`,`viewapplications`.`documentcv` AS `documentcv`,`viewapplications`.`documentpic` AS `documentpic`,`viewapplications`.`documentmat` AS `documentmat`,`viewapplications`.`documentmta` AS `documentmta`,`viewapplications`.`documentip` AS `documentip`,`viewapplications`.`researchtype` AS `researchtype`,`viewapplications`.`researchtypename` AS `researchtypename`,`viewapplications`.`samplesamount` AS `samplesamount`,`viewapplications`.`conservestatus` AS `conservestatus`,`viewapplications`.`conservestatusdesc` AS `conservestatusdesc`,`viewapplications`.`restraditionalknow` AS `restraditionalknow`,`viewapplications`.`exportgeneticresources` AS `exportgeneticresources`,`viewapplications`.`legislationagree` AS `legislationagree`,`viewapplications`.`sampleuom` AS `sampleuom`,`viewapplications`.`sampleuomname` AS `sampleuomname`,`viewapplications`.`apptime` AS `apptime`,`viewapplications`.`approved1` AS `approved1`,`viewapplications`.`approved2` AS `approved2`,`viewapplications`.`approved3` AS `approved3`,`viewapplications`.`approved4` AS `approved4`,`viewapplications`.`approved5` AS `approved5`,`viewapplications`.`approved6` AS `approved6`,`viewapplications`.`approved7` AS `approved7`,`viewapplications`.`approved8` AS `approved8`,`viewapplications`.`approved9` AS `approved9`,`viewapplications`.`approved10` AS `approved10`,`viewapplications`.`aprcomment1` AS `aprcomment1`,`viewapplications`.`aprcomment2` AS `aprcomment2`,`viewapplications`.`aprcomment3` AS `aprcomment3`,`viewapplications`.`aprcomment4` AS `aprcomment4`,`viewapplications`.`aprcomment5` AS `aprcomment5`,`viewapplications`.`aprcomment6` AS `aprcomment6`,`viewapplications`.`aprcomment7` AS `aprcomment7`,`viewapplications`.`aprcomment8` AS `aprcomment8`,`viewapplications`.`aprcomment9` AS `aprcomment9`,`viewapplications`.`aprcomment10` AS `aprcomment10`,`viewapplications`.`discomment1` AS `discomment1`,`viewapplications`.`discomment2` AS `discomment2`,`viewapplications`.`discomment3` AS `discomment3`,`viewapplications`.`discomment4` AS `discomment4`,`viewapplications`.`discomment5` AS `discomment5`,`viewapplications`.`discomment6` AS `discomment6`,`viewapplications`.`discomment7` AS `discomment7`,`viewapplications`.`discomment8` AS `discomment8`,`viewapplications`.`discomment9` AS `discomment9`,`viewapplications`.`discomment10` AS `discomment10`,`viewapplications`.`payamount1` AS `payamount1`,`viewapplications`.`payamount2` AS `payamount2`,`viewapplications`.`payamount3` AS `payamount3`,`viewapplications`.`payamount4` AS `payamount4`,`viewapplications`.`payamount5` AS `payamount5`,`viewapplications`.`payamount6` AS `payamount6`,`viewapplications`.`payamount7` AS `payamount7`,`viewapplications`.`payamount8` AS `payamount8`,`viewapplications`.`payamount9` AS `payamount9`,`viewapplications`.`payamount10` AS `payamount10`,`viewapplications`.`payamtusd1` AS `payamtusd1`,`viewapplications`.`payamtusd2` AS `payamtusd2`,`viewapplications`.`payamtusd3` AS `payamtusd3`,`viewapplications`.`payamtusd4` AS `payamtusd4`,`viewapplications`.`payamtusd5` AS `payamtusd5`,`viewapplications`.`payamtusd6` AS `payamtusd6`,`viewapplications`.`payamtusd7` AS `payamtusd7`,`viewapplications`.`payamtusd8` AS `payamtusd8`,`viewapplications`.`payamtusd9` AS `payamtusd9`,`viewapplications`.`payamtusd10` AS `payamtusd10` from `viewapplications` where (((`viewapplications`.`approved6` = 1) and isnull(`viewapplications`.`approved7`)) or (`viewapplications`.`approved7` = 0));

DROP TABLE IF EXISTS `viewapprovesteps`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewapprovesteps` AS select `s`.`id` AS `id`,`s`.`stepno` AS `stepno`,`s`.`stepname` AS `stepname`,`s`.`stepdesc` AS `stepdesc`,`s`.`instcode` AS `instcode`,`i`.`instname` AS `instname`,`s`.`emtplaplapr` AS `emtplaplapr`,`s`.`emtplapldsp` AS `emtplapldsp`,`s`.`emtplinsapr` AS `emtplinsapr`,`s`.`emtplinsdsp` AS `emtplinsdsp` from (`approvesteps` `s` left join `institutions` `i` on((`i`.`instcode` = `s`.`instcode`)));

DROP TABLE IF EXISTS `viewbankaccounts`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewbankaccounts` AS select `u`.`id` AS `id`,`u`.`instcode` AS `instcode`,`i`.`instname` AS `instname`,`u`.`currcode` AS `currcode`,`c`.`currname` AS `currname`,`u`.`accountno` AS `accountno`,`u`.`accountname` AS `accountname`,`n`.`bankcode` AS `bankcode`,`g`.`bankname` AS `bankname`,`u`.`branchcode` AS `branchcode`,`n`.`branchname` AS `branchname`,`g`.`swiftcode` AS `swiftcode` from ((((`bankaccounts` `u` left join `institutions` `i` on((`i`.`instcode` = `u`.`instcode`))) left join `bankbranch` `n` on((`n`.`branchcode` = `u`.`branchcode`))) left join `banks` `g` on((`g`.`bankcode` = `n`.`bankcode`))) left join `currencies` `c` on((`c`.`currcode` = `u`.`currcode`)));

DROP TABLE IF EXISTS `viewbankbranches`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewbankbranches` AS select `n`.`id` AS `id`,`n`.`branchcode` AS `branchcode`,`n`.`branchname` AS `branchname`,`n`.`bankcode` AS `bankcode`,`g`.`bankname` AS `bankname`,`g`.`swiftcode` AS `swiftcode`,`g`.`haseft` AS `haseft` from (`bankbranch` `n` left join `banks` `g` on((`g`.`bankcode` = `n`.`bankcode`)));

DROP TABLE IF EXISTS `viewcountries`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewcountries` AS select `v`.`id` AS `id`,`v`.`ctncode` AS `ctncode`,`v`.`ctncodeiso3` AS `ctncodeiso3`,`v`.`ctnname` AS `ctnname`,`v`.`natcode` AS `natcode`,`v`.`ntnname` AS `ntnname`,`v`.`regioncode` AS `regioncode`,`x`.`regionname` AS `regionname`,`v`.`isdefault` AS `isdefault` from (`countries` `v` left join `countryregions` `x` on((`x`.`regioncode` = `v`.`regioncode`)));

DROP TABLE IF EXISTS `viewinstitutions`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewinstitutions` AS select `v`.`id` AS `id`,`v`.`instcode` AS `instcode`,`v`.`instname` AS `instname`,`v`.`instphoto` AS `instphoto`,`v`.`photourl` AS `photourl`,`v`.`thumburl` AS `thumburl`,`v`.`permitdesc` AS `permitdesc`,`v`.`charges` AS `charges`,`v`.`consultemail` AS `consultemail`,`v`.`consultperson` AS `consultperson`,`v`.`paytimecode` AS `paytimecode`,`t`.`paytimename` AS `paytimename`,`t`.`isbfrsub` AS `isbfrsub`,`t`.`isbfrapr` AS `isbfrapr`,`v`.`licmdcode` AS `licmdcode`,`e`.`licmdname` AS `licmdname`,`e`.`isauto` AS `isauto`,`e`.`ismanapp` AS `ismanapp`,`e`.`ismanins` AS `ismanins`,`e`.`isemail` AS `isemail`,`s`.`stepno` AS `stepno`,`s`.`stepname` AS `stepname`,`s`.`stepdesc` AS `stepdesc`,`s`.`emtplaplapr` AS `emtplaplapr`,`s`.`emtplapldsp` AS `emtplapldsp`,`s`.`emtplinsapr` AS `emtplinsapr`,`s`.`emtplinsdsp` AS `emtplinsdsp`,`v`.`api_username` AS `api_username`,`v`.`api_password` AS `api_password`,`v`.`api_baseurl` AS `api_baseurl` from (((`institutions` `v` left join `licmodes` `e` on((`e`.`licmdcode` = `v`.`licmdcode`))) left join `paytimes` `t` on((`t`.`paytimecode` = `v`.`paytimecode`))) left join `approvesteps` `s` on((`s`.`instcode` = `v`.`instcode`)));

DROP TABLE IF EXISTS `viewresearchers`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewresearchers` AS select `s`.`id` AS `id`,`s`.`idpassno` AS `idpassno`,`s`.`orcidid` AS `orcidid`,`s`.`orcidname` AS `orcidname`,`s`.`accesstoken` AS `accesstoken`,`s`.`tokentype` AS `tokentype`,`s`.`refreshtoken` AS `refreshtoken`,`s`.`tokenexpiry` AS `tokenexpiry`,`s`.`tokenscope` AS `tokenscope`,`s`.`firstname` AS `firstname`,`s`.`lastname` AS `lastname`,`s`.`midname` AS `midname`,`s`.`fullname` AS `fullname`,`s`.`gender` AS `gender`,`s`.`ctncode` AS `ctncode`,`s`.`email` AS `email`,`s`.`title` AS `title`,`s`.`dob` AS `dob`,`s`.`idpassip` AS `idpassip`,`s`.`idpassdi` AS `idpassdi`,`s`.`idpassdx` AS `idpassdx`,`s`.`institutionname` AS `institutionname`,`s`.`qualification` AS `qualification`,`s`.`specarea` AS `specarea`,`s`.`mobile` AS `mobile`,`s`.`postaddress` AS `postaddress`,`s`.`postcode` AS `postcode`,`s`.`town` AS `town`,`s`.`prmaddress` AS `prmaddress`,`s`.`prmpcode` AS `prmpcode`,`s`.`prmtown` AS `prmtown`,`s`.`prmphone` AS `prmphone`,`s`.`prmresidence` AS `prmresidence`,`s`.`secaddress` AS `secaddress`,`s`.`secpcode` AS `secpcode`,`s`.`sectown` AS `sectown`,`s`.`secphone` AS `secphone`,`s`.`secresidence` AS `secresidence`,`s`.`empaddress` AS `empaddress`,`s`.`emppcode` AS `emppcode`,`s`.`emppzip` AS `emppzip`,`s`.`emptown` AS `emptown`,`s`.`emphone` AS `emphone`,`s`.`empctncode` AS `empctncode`,`s`.`empcountry` AS `empcountry`,`s`.`password` AS `password`,`s`.`verifycode` AS `verifycode`,`s`.`verifydate` AS `verifydate`,`s`.`verified` AS `verified`,`s`.`hasuploads` AS `hasuploads`,`s`.`docpassport` AS `docpassport`,`s`.`docid` AS `docid`,`s`.`docidpass` AS `docidpass`,`s`.`urlphoto` AS `urlphoto`,`s`.`active` AS `active`,`s`.`setup` AS `setup`,`s`.`regdate` AS `regdate`,`s`.`regtime` AS `regtime`,`s`.`pinno` AS `pinno`,`o`.`ctnname` AS `ctnname`,`o`.`natcode` AS `natcode`,`o`.`ntnname` AS `ntnname` from (`researchers` `s` left join `countries` `o` on((`o`.`ctncode` = `s`.`ctncode`)));

DROP TABLE IF EXISTS `viewusers`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `viewusers` AS select `u`.`id` AS `id`,`u`.`email` AS `email`,`u`.`username` AS `username`,`u`.`mobile` AS `mobile`,`u`.`disabled` AS `disabled`,`u`.`rolecode` AS `rolecode`,`r`.`rolename` AS `rolename`,`u`.`instcode` AS `instcode`,`i`.`instname` AS `instname`,`u`.`audituser` AS `audituser` from ((`sysusers` `u` left join `sysroles` `r` on((`r`.`rolecode` = `u`.`rolecode`))) left join `institutions` `i` on((`i`.`instcode` = `u`.`instcode`)));

-- 2020-04-11 08:35:16
