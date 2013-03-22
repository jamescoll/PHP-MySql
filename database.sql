-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2012 at 11:50 AM
-- Server version: 4.1.22
-- PHP Version: 4.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `coja70_kraftwerk`
--

-- --------------------------------------------------------

--
-- Table structure for table `albuminfo`
--

CREATE TABLE `albuminfo` (
  `albumId` int(11) NOT NULL auto_increment,
  `albumTitle` varchar(40) NOT NULL default '',
  `albumReleaseYear` int(11) NOT NULL default '0',
  `albumNoTracks` int(10) NOT NULL default '0',
  `albumLabel` varchar(50) NOT NULL default '',
  `albumReview` varchar(60) NOT NULL default '',
  `albumImage` varchar(60) NOT NULL default '',
  `albumThumbnail` varchar(60) NOT NULL default '',
  `albumRatingAlt` varchar(20) NOT NULL default '',
  `ratingImage` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`albumId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1012 ;

--
-- Dumping data for table `albuminfo`
--

INSERT INTO `albuminfo` (`albumId`, `albumTitle`, `albumReleaseYear`, `albumNoTracks`, `albumLabel`, `albumReview`, `albumImage`, `albumThumbnail`, `albumRatingAlt`, `ratingImage`) VALUES
(1000, 'Kraftwerk', 1970, 4, 'Philips/Vertigo', 'reviews/1.txt', 'images/Covers/1.jpg', 'images/Covers/thumb1.jpg', '3 Stars', 'images/Ratings/3stars.jpg'),
(1001, 'Kraftwerk 2', 1972, 6, 'Philips/Vertigo', 'reviews/2.txt', 'images/Covers/2.jpg', 'images/Covers/thumb2.jpg', '4 Stars', 'images/Ratings/4stars.jpg'),
(1002, 'Ralf and Florian', 1973, 6, 'Philips/Vertigo', 'reviews/3.txt', 'images/Covers/3.jpg', 'images/Covers/thumb3.jpg', '4 Stars', 'images/Ratings/4stars.jpg'),
(1003, 'Autobahn', 1974, 5, 'Philips/Vertigo', 'reviews/4.txt', 'images/Covers/4.jpg', 'images/Covers/thumb4.jpg', '5 Stars', 'images/Ratings/5stars.jpg'),
(1004, 'Radio-Activity', 1975, 12, 'EMI Distribution/Kling Klang', 'reviews/5.txt', 'images/Covers/5.jpg', 'images/Covers/thumb5.jpg', '4 Stars', 'images/Ratings/4stars.jpg'),
(1005, 'Trans-Europe Express', 1977, 7, 'EMI Distribution/Kling Klang', 'reviews/6.txt', 'images/Covers/6.jpg', 'images/Covers/thumb6.jpg', '5 Stars', 'images/Ratings/5stars.jpg'),
(1006, 'The Man Machine', 1978, 6, 'EMI Distribution/Kling Klang', 'reviews/7.txt', 'images/Covers/7.jpg', 'images/Covers/thumb7.jpg', '5 Stars', 'images/Ratings/5stars.jpg'),
(1007, 'Computer World', 1981, 7, 'EMI Distribution/Kling Klang', 'reviews/8.txt', 'images/Covers/8.jpg', 'images/Covers/thumb8.jpg', '5 Stars', 'images/Ratings/5stars.jpg'),
(1008, 'Electric Cafe', 1986, 6, 'EMI Distribution/Kling Klang', 'reviews/9.txt', 'images/Covers/9.jpg', 'images/Covers/thumb9.jpg', '3 Stars', 'images/Ratings/3stars.jpg'),
(1009, 'The Mix', 1991, 11, 'EMI Distribution/Kling Klang', 'reviews/10.txt', 'images/Covers/10.jpg', 'images/Covers/thumb10.jpg', '3 Stars', 'images/Ratings/3stars.jpg'),
(1010, 'Tour De France Soundtracks', 2003, 12, 'EMI Distribution/Kling Klang', 'reviews/11.txt', 'images/Covers/11.jpg', 'images/Covers/thumb11.jpg', '4 Stars', 'images/Ratings/4stars.jpg'),
(1011, 'Minimum-Maximum', 2005, 22, 'EMI Distribution/Kling Klang', 'reviews/12.txt', 'images/Covers/12.jpg', 'images/Covers/thumb12.jpg', '3.5 Stars', 'images/Ratings/35stars.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `commentinfo`
--

CREATE TABLE `commentinfo` (
  `commentId` int(11) NOT NULL auto_increment,
  `trackId` int(11) NOT NULL default '0',
  `userId` int(11) NOT NULL default '0',
  `commentTxt` text NOT NULL,
  `dateAndTime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`commentId`),
  KEY `trackId` (`trackId`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `commentinfo`
--

INSERT INTO `commentinfo` (`commentId`, `trackId`, `userId`, `commentTxt`, `dateAndTime`) VALUES
(1, 100, 1, 'This is proper early Kraftwerk. The driving flute and unusual looping structure is a sign of things to come.', '2012-10-17 00:09:37'),
(2, 100, 9, 'I love this track! Driving and primeval. It has a pulse of its own.', '2012-10-09 00:10:17'),
(5, 177, 10, 'Saw this played live last year in New York... something else. Never realized they were saying ''Sellafield, Tschernobyl...'' - couldn''t make out the words before...', '2012-10-18 01:00:16'),
(6, 123, 1, 'This was the album where they made it. Imagine making an album about driving on the highway... you''d have expected a cheesy US rock group to do this not a German pre-industrial geek-band!', '2012-10-18 08:51:12'),
(7, 177, 1, 'This comes from a joke about well.. you know... radios and activity happening on them... how German! Heh! Music being a radio activity... Quite a sense of humour these guys...', '2012-10-18 08:52:35'),
(8, 185, 12, 'Tour de France, Tour de France! I listened to this track all the way through my final exams in college. Reminded me of cycling in the Cotswolds... except for the rain', '2012-10-18 08:56:21'),
(26, 100, 20, 'I don''t like early Kraftwerk... I don''t think they got good until Autobahn. Sure they were making electronic music very early...but it''s not very good music...', '2012-10-21 20:31:37'),
(10, 109, 12, 'Storm has that distorted guitar part that I really enjoy. This whole album has always been a secret favourite of mine. I hear that it will be re-released soon.', '2012-10-18 18:44:21'),
(11, 134, 12, 'Radioactivity sounds so strange now when you compare it to their modern version of the tracks but I still love turning the lights down and listening to this music.', '2012-10-18 18:45:58'),
(12, 168, 12, 'Wasn''t this on an MTV ad for a while??', '2012-10-18 18:46:45'),
(13, 168, 14, 'Yeah... here''s a cool link to it from one of their recent shows... pretty rare to catch them live now...\r\n\r\nhttp://www.youtube.com/watch?v=tpilbvC5sgI', '2012-10-18 18:47:30'),
(14, 160, 14, 'Heh - I am the operator with my pocket calculator... can''t get much simpler than Kraftwerk lyrics....', '2012-10-18 18:48:54'),
(15, 148, 16, 'In Korea not so many people know about Kraftwerk but my piano teacher used to talk about them many times - i once saw somebody in Seoul playing a piano version of this...for piano!', '2012-10-18 18:50:24'),
(16, 157, 16, 'I saw the version of this in German at the last Zurich open air... they have a great remixed version of it...', '2012-10-18 18:52:34'),
(17, 160, 1, 'I listened to this album while studying for my computer science degree. Not sure if that was a good idea. Does anyone use pocket calculators anymore?', '2012-10-20 00:45:27'),
(18, 160, 1, 'This is an amazing site... I love Kraftwerk!!!  ', '2012-10-20 13:02:44'),
(19, 116, 21, 'Hi Everyone - this means ''Homeland Sounds'' in German.. one of my fave early Kraftwerk tunes... great city - Dusseldorf...', '2012-10-21 12:52:25'),
(20, 185, 21, 'They played in Manchester Velodrome in 2009 that''s how crazy Hutter is about cycling. You can see clips of that show on youtube - here... great show. I was lucky enough to be there....http://www.youtube.com/watch?v=EwL6pRxLHM8..PB', '2012-10-21 20:17:05'),
(21, 168, 21, 'I didn''t like Electric Cafe so much... I thought they ran out of ideas on this album... but then these tunes became staples on radio and on tv...', '2012-10-21 20:18:46'),
(22, 109, 21, 'Yeah this means ''current'' though and not ''storm'' if anyone thought it did...', '2012-10-21 20:19:48'),
(23, 123, 21, 'Everybody talks about how the Autobahn in Germany are crazy because there''s no speed limit...but actually they are incredibly safe... this is mostly because it is against the law to stop on the highway and people are quite respectful of the law...', '2012-10-21 20:20:50'),
(24, 157, 20, 'This movie always make me think of Metropolis which was a big influence on it. If you know about German movies from the 20s and 30s and the history of that time you can see how it comes into this album...', '2012-10-21 20:27:07'),
(25, 134, 20, 'Yeah in German it''s broken into two words... Radio-Aktivität so you can see how they are having fun with the words for Radio and Activity separately...', '2012-10-21 20:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `countryinfo`
--

CREATE TABLE `countryinfo` (
  `iso` char(2) NOT NULL default '',
  `name` varchar(80) NOT NULL default '',
  `printable_name` varchar(80) NOT NULL default '',
  `iso3` char(3) default NULL,
  `numcode` smallint(6) default NULL,
  PRIMARY KEY  (`iso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countryinfo`
--

INSERT INTO `countryinfo` (`iso`, `name`, `printable_name`, `iso3`, `numcode`) VALUES
('AD', 'ANDORRA', 'Andorra', 'AND', 20),
('AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784),
('AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4),
('AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28),
('AI', 'ANGUILLA', 'Anguilla', 'AIA', 660),
('AL', 'ALBANIA', 'Albania', 'ALB', 8),
('AM', 'ARMENIA', 'Armenia', 'ARM', 51),
('AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530),
('AO', 'ANGOLA', 'Angola', 'AGO', 24),
('AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL),
('AR', 'ARGENTINA', 'Argentina', 'ARG', 32),
('AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16),
('AT', 'AUSTRIA', 'Austria', 'AUT', 40),
('AU', 'AUSTRALIA', 'Australia', 'AUS', 36),
('AW', 'ARUBA', 'Aruba', 'ABW', 533),
('AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31),
('BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70),
('BB', 'BARBADOS', 'Barbados', 'BRB', 52),
('BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50),
('BE', 'BELGIUM', 'Belgium', 'BEL', 56),
('BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854),
('BG', 'BULGARIA', 'Bulgaria', 'BGR', 100),
('BH', 'BAHRAIN', 'Bahrain', 'BHR', 48),
('BI', 'BURUNDI', 'Burundi', 'BDI', 108),
('BJ', 'BENIN', 'Benin', 'BEN', 204),
('BM', 'BERMUDA', 'Bermuda', 'BMU', 60),
('BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96),
('BO', 'BOLIVIA', 'Bolivia', 'BOL', 68),
('BR', 'BRAZIL', 'Brazil', 'BRA', 76),
('BS', 'BAHAMAS', 'Bahamas', 'BHS', 44),
('BT', 'BHUTAN', 'Bhutan', 'BTN', 64),
('BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL),
('BW', 'BOTSWANA', 'Botswana', 'BWA', 72),
('BY', 'BELARUS', 'Belarus', 'BLR', 112),
('BZ', 'BELIZE', 'Belize', 'BLZ', 84),
('CA', 'CANADA', 'Canada', 'CAN', 124),
('CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL),
('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo', 'COD', 180),
('CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140),
('CG', 'CONGO', 'Congo', 'COG', 178),
('CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756),
('CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', 384),
('CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184),
('CL', 'CHILE', 'Chile', 'CHL', 152),
('CM', 'CAMEROON', 'Cameroon', 'CMR', 120),
('CN', 'CHINA', 'China', 'CHN', 156),
('CO', 'COLOMBIA', 'Colombia', 'COL', 170),
('CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188),
('CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL),
('CU', 'CUBA', 'Cuba', 'CUB', 192),
('CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132),
('CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL),
('CY', 'CYPRUS', 'Cyprus', 'CYP', 196),
('CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203),
('DE', 'GERMANY', 'Germany', 'DEU', 276),
('DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262),
('DK', 'DENMARK', 'Denmark', 'DNK', 208),
('DM', 'DOMINICA', 'Dominica', 'DMA', 212),
('DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214),
('DZ', 'ALGERIA', 'Algeria', 'DZA', 12),
('EC', 'ECUADOR', 'Ecuador', 'ECU', 218),
('EE', 'ESTONIA', 'Estonia', 'EST', 233),
('EG', 'EGYPT', 'Egypt', 'EGY', 818),
('EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732),
('ER', 'ERITREA', 'Eritrea', 'ERI', 232),
('ES', 'SPAIN', 'Spain', 'ESP', 724),
('ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231),
('FI', 'FINLAND', 'Finland', 'FIN', 246),
('FJ', 'FIJI', 'Fiji', 'FJI', 242),
('FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238),
('FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia', 'FSM', 583),
('FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234),
('FR', 'FRANCE', 'France', 'FRA', 250),
('GA', 'GABON', 'Gabon', 'GAB', 266),
('GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826),
('GD', 'GRENADA', 'Grenada', 'GRD', 308),
('GE', 'GEORGIA', 'Georgia', 'GEO', 268),
('GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254),
('GH', 'GHANA', 'Ghana', 'GHA', 288),
('GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292),
('GL', 'GREENLAND', 'Greenland', 'GRL', 304),
('GM', 'GAMBIA', 'Gambia', 'GMB', 270),
('GN', 'GUINEA', 'Guinea', 'GIN', 324),
('GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312),
('GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226),
('GR', 'GREECE', 'Greece', 'GRC', 300),
('GT', 'GUATEMALA', 'Guatemala', 'GTM', 320),
('GU', 'GUAM', 'Guam', 'GUM', 316),
('GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624),
('GY', 'GUYANA', 'Guyana', 'GUY', 328),
('HK', 'HONG KONG', 'Hong Kong', 'HKG', 344),
('HN', 'HONDURAS', 'Honduras', 'HND', 340),
('HR', 'CROATIA', 'Croatia', 'HRV', 191),
('HT', 'HAITI', 'Haiti', 'HTI', 332),
('HU', 'HUNGARY', 'Hungary', 'HUN', 348),
('ID', 'INDONESIA', 'Indonesia', 'IDN', 360),
('IE', 'IRELAND', 'Ireland', 'IRL', 372),
('IL', 'ISRAEL', 'Israel', 'ISR', 376),
('IN', 'INDIA', 'India', 'IND', 356),
('IQ', 'IRAQ', 'Iraq', 'IRQ', 368),
('IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran', 'IRN', 364),
('IS', 'ICELAND', 'Iceland', 'ISL', 352),
('IT', 'ITALY', 'Italy', 'ITA', 380),
('JM', 'JAMAICA', 'Jamaica', 'JAM', 388),
('JO', 'JORDAN', 'Jordan', 'JOR', 400),
('JP', 'JAPAN', 'Japan', 'JPN', 392),
('KE', 'KENYA', 'Kenya', 'KEN', 404),
('KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417),
('KH', 'CAMBODIA', 'Cambodia', 'KHM', 116),
('KI', 'KIRIBATI', 'Kiribati', 'KIR', 296),
('KM', 'COMOROS', 'Comoros', 'COM', 174),
('KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659),
('KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, North', 'PRK', 408),
('KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410),
('KW', 'KUWAIT', 'Kuwait', 'KWT', 414),
('KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136),
('KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398),
('LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao', 'LAO', 418),
('LB', 'LEBANON', 'Lebanon', 'LBN', 422),
('LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662),
('LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438),
('LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144),
('LR', 'LIBERIA', 'Liberia', 'LBR', 430),
('LS', 'LESOTHO', 'Lesotho', 'LSO', 426),
('LT', 'LITHUANIA', 'Lithuania', 'LTU', 440),
('LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442),
('LV', 'LATVIA', 'Latvia', 'LVA', 428),
('LY', 'LIBYAN ARAB JAMAHIRIYA', 'Jamahiriya', 'LBY', 434),
('MA', 'MOROCCO', 'Morocco', 'MAR', 504),
('MC', 'MONACO', 'Monaco', 'MCO', 492),
('MD', 'MOLDOVA, REPUBLIC OF', 'Moldova', 'MDA', 498),
('MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450),
('MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584),
('MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia', 'MKD', 807),
('ML', 'MALI', 'Mali', 'MLI', 466),
('MM', 'MYANMAR', 'Myanmar', 'MMR', 104),
('MN', 'MONGOLIA', 'Mongolia', 'MNG', 496),
('MO', 'MACAO', 'Macao', 'MAC', 446),
('MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580),
('MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474),
('MR', 'MAURITANIA', 'Mauritania', 'MRT', 478),
('MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500),
('MT', 'MALTA', 'Malta', 'MLT', 470),
('MU', 'MAURITIUS', 'Mauritius', 'MUS', 480),
('MV', 'MALDIVES', 'Maldives', 'MDV', 462),
('MW', 'MALAWI', 'Malawi', 'MWI', 454),
('MX', 'MEXICO', 'Mexico', 'MEX', 484),
('MY', 'MALAYSIA', 'Malaysia', 'MYS', 458),
('MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508),
('NA', 'NAMIBIA', 'Namibia', 'NAM', 516),
('NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540),
('NE', 'NIGER', 'Niger', 'NER', 562),
('NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574),
('NG', 'NIGERIA', 'Nigeria', 'NGA', 566),
('NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558),
('NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528),
('NO', 'NORWAY', 'Norway', 'NOR', 578),
('NP', 'NEPAL', 'Nepal', 'NPL', 524),
('NR', 'NAURU', 'Nauru', 'NRU', 520),
('NU', 'NIUE', 'Niue', 'NIU', 570),
('NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554),
('OM', 'OMAN', 'Oman', 'OMN', 512),
('PA', 'PANAMA', 'Panama', 'PAN', 591),
('PE', 'PERU', 'Peru', 'PER', 604),
('PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258),
('PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598),
('PH', 'PHILIPPINES', 'Philippines', 'PHL', 608),
('PK', 'PAKISTAN', 'Pakistan', 'PAK', 586),
('PL', 'POLAND', 'Poland', 'POL', 616),
('PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612),
('PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630),
('PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestine', NULL, NULL),
('PT', 'PORTUGAL', 'Portugal', 'PRT', 620),
('PW', 'PALAU', 'Palau', 'PLW', 585),
('PY', 'PARAGUAY', 'Paraguay', 'PRY', 600),
('QA', 'QATAR', 'Qatar', 'QAT', 634),
('RE', 'REUNION', 'Reunion', 'REU', 638),
('RO', 'ROMANIA', 'Romania', 'ROM', 642),
('RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643),
('RW', 'RWANDA', 'Rwanda', 'RWA', 646),
('SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682),
('SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90),
('SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690),
('SD', 'SUDAN', 'Sudan', 'SDN', 736),
('SE', 'SWEDEN', 'Sweden', 'SWE', 752),
('SG', 'SINGAPORE', 'Singapore', 'SGP', 702),
('SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654),
('SI', 'SLOVENIA', 'Slovenia', 'SVN', 705),
('SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703),
('SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694),
('SM', 'SAN MARINO', 'San Marino', 'SMR', 674),
('SN', 'SENEGAL', 'Senegal', 'SEN', 686),
('SO', 'SOMALIA', 'Somalia', 'SOM', 706),
('SR', 'SURINAME', 'Suriname', 'SUR', 740),
('ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678),
('SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222),
('SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760),
('SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748),
('TD', 'CHAD', 'Chad', 'TCD', 148),
('TG', 'TOGO', 'Togo', 'TGO', 768),
('TH', 'THAILAND', 'Thailand', 'THA', 764),
('TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762),
('TK', 'TOKELAU', 'Tokelau', 'TKL', 772),
('TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL),
('TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795),
('TN', 'TUNISIA', 'Tunisia', 'TUN', 788),
('TO', 'TONGA', 'Tonga', 'TON', 776),
('TR', 'TURKEY', 'Turkey', 'TUR', 792),
('TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780),
('TV', 'TUVALU', 'Tuvalu', 'TUV', 798),
('TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan', 'TWN', 158),
('TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania', 'TZA', 834),
('UA', 'UKRAINE', 'Ukraine', 'UKR', 804),
('UG', 'UGANDA', 'Uganda', 'UGA', 800),
('US', 'UNITED STATES', 'United States', 'USA', 840),
('UY', 'URUGUAY', 'Uruguay', 'URY', 858),
('UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860),
('VE', 'VENEZUELA', 'Venezuela', 'VEN', 862),
('VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92),
('VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850),
('VN', 'VIET NAM', 'Viet Nam', 'VNM', 704),
('VU', 'VANUATU', 'Vanuatu', 'VUT', 548),
('WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876),
('WS', 'SAMOA', 'Samoa', 'WSM', 882),
('YE', 'YEMEN', 'Yemen', 'YEM', 887),
('YT', 'MAYOTTE', 'Mayotte', NULL, NULL),
('ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710),
('ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894),
('ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716);

-- --------------------------------------------------------

--
-- Table structure for table `linkinfo`
--

CREATE TABLE `linkinfo` (
  `linkId` int(11) NOT NULL auto_increment,
  `linkHeader` varchar(255) NOT NULL default '',
  `linkUrl` varchar(255) NOT NULL default '',
  `linkType` int(11) NOT NULL default '0',
  `linkSource` varchar(100) NOT NULL default '',
  `linkDate` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`linkId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `linkinfo`
--

INSERT INTO `linkinfo` (`linkId`, `linkHeader`, `linkUrl`, `linkType`, `linkSource`, `linkDate`) VALUES
(1, 'Kraftwerk Homepage', 'http://www.kraftwerk.com/', 0, '', '0000-00-00'),
(2, 'Kraftwerk Wiki', 'http://en.wikipedia.org/wiki/Kraftwerk', 0, '', '0000-00-00'),
(3, 'Kraftwerk Youtube', 'http://www.youtube.com/artist/kraftwerk', 0, '', '0000-00-00'),
(4, 'Equipment Guide', 'http://kraftwerkfaq.hu/equipment.html', 0, '', '0000-00-00'),
(5, 'Kraftwerk and Public Enemy among Rock and Roll Hall of Fame nominees.', 'http://www.guardian.co.uk/music/2012/oct/04/kraftwerk-public-enemy-hall-of-fame', 1, 'The Guardian', '2012-10-09'),
(6, 'Why Kraftwerk Make Me Laugh', 'http://blogs.sfweekly.com/shookdown/2012/10/kraftwerk_rock_and_roll_hall_of_fame_make_me_laugh.php', 1, 'SF Weekly', '2012-10-09'),
(7, 'Kraftwerk Reign At Way Out West', 'http://www.mojo4music.com/blog/2012/08/kraftwerk_reign_at_way_out_wes.html', 1, 'Mojo Online', '2012-08-28'),
(8, 'Kraftwerk''s Ralf H&#252;tter says new album due soon', 'http://www.nme.com/news/kraftwerk/63286', 1, 'NME', '2012-04-17'),
(9, 'Kraftwerk Release Limited Edition Boxset at MOMA', 'http://www.rollingstone.com/music/news/kraftwerk-release-limited-edition-box-set-at-moma-20120406', 1, 'Rolling Stone', '2012-04-06'),
(10, 'Kraftwerk To Stage 3D Shows in New York', 'http://www.starpulse.com/news/index.php/2012/02/16/kraftwerk_to_stage_3d_shows_in_new_yor', 1, 'Starpulse.com', '2012-02-16'),
(11, 'Kraftwerk - Beach Boys With Matches', 'http://www.bbc.co.uk/news/magazine-17673212', 1, 'BBC News', '2012-04-12'),
(12, 'Watch - Highlights From MOMA Retrospective', 'http://pitchfork.com/news/46199-watch-highlights-from-kraftwerks-retrospective/', 1, 'Pitchfork.com', '2012-04-18'),
(13, 'Kraftwerk News CZ', 'http://www.kraftwerk.kx.cz/en/news/', 0, '', '0000-00-00'),
(14, 'Kraftwerk @ Last FM', 'http://www.last.fm/music/Kraftwerk', 0, '', '0000-00-00'),
(15, 'Rock and Roll Hall of Fame: Exciting When Rock Is Overlooked', 'http://www.anorak.co.uk/335647/celebrities/music-celebrities/rock-and-roll-hall-of-fame-exiting-when-rock-is-overlooked.html/', 1, 'Anorak', '2012-10-05'),
(16, 'Kraftwerk to guest edit 3D issue of Wallpaper* magazine', 'http://www.nme.com/news/kraftwerk/59199', 1, 'NME', '2011-09-14'),
(17, 'Kraftwerk to reissue eight remastered albums', 'http://www.nme.com/news/kraftwerk/46597', 1, 'NME', '2009-08-10'),
(18, 'Kraftwerk Remasters ''The Catalogue,'' Recoding New Album For 2010', 'http://www.billboard.com/news/kraftwerk-remasters-the-catalogue-recoding-1004019021.story', 1, 'Billboard', '2009-10-06'),
(19, 'Kraftwerk@Twitter', 'https://twitter.com/kraftwerk', 0, '', '0000-00-00'),
(20, 'Facebook Page', 'http://www.facebook.com/KraftwerkOfficial', 0, '', '0000-00-00'),
(21, 'Kraftwerk@MySpace', 'http://www.myspace.com/kraftwerk', 0, '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `trackinfo`
--

CREATE TABLE `trackinfo` (
  `trackId` int(11) NOT NULL auto_increment,
  `albumId` int(11) NOT NULL default '0',
  `trackNo` int(11) NOT NULL default '0',
  `trackTitle` varchar(40) NOT NULL default '',
  `trackComposers` varchar(100) NOT NULL default '',
  `trackLength` varchar(10) NOT NULL default '',
  `sampleTrack` int(1) NOT NULL default '0',
  `samplePath` varchar(75) NOT NULL default '',
  PRIMARY KEY  (`trackId`),
  KEY `trackId` (`trackId`),
  KEY `albumId` (`albumId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=218 ;

--
-- Dumping data for table `trackinfo`
--

INSERT INTO `trackinfo` (`trackId`, `albumId`, `trackNo`, `trackTitle`, `trackComposers`, `trackLength`, `sampleTrack`, `samplePath`) VALUES
(100, 1000, 1, 'Ruckzuck', 'Ralf H&#252;tter | Florian Schneider', '7:47', 1, 'media/01_Ruckzuck.mp3'),
(101, 1000, 2, 'Stratovarius', 'Ralf H&#252;tter | Florian Schneider', '12:10', 0, ''),
(103, 1000, 3, 'Megaherz', 'Ralf H&#252;tter | Florian Schneider', '9:30', 0, ''),
(104, 1000, 4, 'Von Himmel Hoch', 'Ralf H&#252;tter | Florian Schneider', '10:12', 0, ''),
(105, 1001, 1, 'KlingKlang', 'Ralf H&#252;tter | Florian Schneider', '17:36', 0, ''),
(106, 1001, 2, 'Atem', 'Ralf H&#252;tter | Florian Schneider', '2:57', 0, ''),
(109, 1001, 3, 'Strom', 'Ralf H&#252;tter | Florian Schneider', '3:52', 1, 'media/02_Strom.mp3'),
(110, 1001, 4, 'Spule 4', 'Ralf H&#252;tter | Florian Schneider', '5:20', 0, ''),
(111, 1001, 5, 'Wellenlange', 'Ralf H&#252;tter | Florian Schneider', '9:40', 0, ''),
(112, 1001, 6, 'Harmonika', 'Ralf H&#252;tter | Florian Schneider', '3:17', 0, ''),
(113, 1002, 1, 'Elektrisches Roulette', 'Ralf H&#252;tter | Florian Schneider', '4:19', 0, ''),
(114, 1002, 2, 'Tongebirge', 'Ralf H&#252;tter | Florian Schneider', '2:50', 0, ''),
(115, 1002, 3, 'Kristallo', 'Ralf H&#252;tter | Florian Schneider', '6:18', 0, ''),
(116, 1002, 4, 'Heimatkl&#228;nge', 'Ralf H&#252;tter | Florian Schneider', '3:45', 1, 'media/03_Heimatklange.mp3'),
(117, 1002, 5, 'Tanzmusik', 'Ralf H&#252;tter | Florian Schneider', '6:34', 0, ''),
(118, 1002, 6, 'Ananas Symphonie', 'Ralf H&#252;tter | Florian Schneider', '13:55', 0, ''),
(123, 1003, 1, 'Autobahn', 'Ralf H&#252;tter | Florian Schneider | Emil Schult', '22:43', 1, 'media/04_Autobahn.mp3'),
(124, 1003, 2, 'Kometenmelodie 1', 'Ralf H&#252;tter | Florian Schneider', '6:26', 0, ''),
(125, 1003, 3, 'Kometenmelodie 2', 'Ralf H&#252;tter | Florian Schneider', '5:48', 0, ''),
(126, 1003, 4, 'Mitternacht', 'Ralf H&#252;tter | Florian Schneider', '3:43', 0, ''),
(127, 1003, 5, 'Morgenspaziergang', 'Ralf H&#252;tter | Florian Schneider', '4:04', 0, ''),
(128, 1004, 1, 'Geiger Counter', 'Ralf H&#252;tter', '1:07', 0, ''),
(129, 1004, 2, 'Radioactivity', 'Ralf H&#252;tter | Florian Schneider | Emil Schult', '6:42', 0, ''),
(130, 1004, 3, 'Radioland', 'Ralf H&#252;tter | Florian Schneider', '5:50', 0, ''),
(131, 1004, 4, 'Airwaves', 'Ralf H&#252;tter | Florian Schneider', '4:40', 0, ''),
(132, 1004, 5, 'Intermission', 'Ralf H&#252;tter | Florian Schneider', '0:39', 0, ''),
(133, 1004, 6, 'News', 'Ralf H&#252;tter | Florian Schneider', '1:17', 0, ''),
(134, 1004, 7, 'The Voice Of Energy', 'Ralf H&#252;tter | Florian Schneider', '0:55', 1, 'media/05_Die_Stimme_Der_Energie.mp3'),
(135, 1004, 8, 'Antenna', 'Ralf H&#252;tter | Florian Schneider | Emil Schult', '3:43', 0, ''),
(136, 1004, 9, 'Radio Stars', 'Ralf H&#252;tter | Florian Schneider', '3:35', 0, ''),
(140, 1004, 10, 'Uranium', 'Ralf H&#252;tter | Florian Schneider | Emil Schult', '1:26', 0, ''),
(141, 1004, 11, 'Transistor', 'Ralf H&#252;tter | Florian Schneider', '2:15', 0, ''),
(142, 1004, 12, 'Ohm Sweet Ohm', 'Ralf H&#252;tter | Florian Schneider', '5:39', 0, ''),
(143, 1005, 1, 'Europe Endless', 'Ralf H&#252;tter', '9:40', 0, ''),
(144, 1005, 2, 'The Hall Of Mirrors', 'Ralf H&#252;tter | Florian Schneider', '7:56', 0, ''),
(145, 1005, 3, 'Showroom Dummies', 'Ralf H&#252;tter', '6:15', 0, ''),
(146, 1005, 4, 'Trans-Europe Express', 'Ralf H&#252;tter', '6:37', 0, ''),
(147, 1005, 5, 'Metal on Metal', 'Ralf H&#252;tter', '6:52', 0, ''),
(148, 1005, 6, 'Franz Schubert', 'Ralf H&#252;tter', '4:26', 1, 'media/06_Franz_Schubert.mp3'),
(149, 1005, 7, 'Endless Endless', 'Ralf H&#252;tter | Florian Schneider', '0:55', 0, ''),
(150, 1006, 1, 'The Robots', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '6:11', 0, ''),
(151, 1006, 2, 'Spacelab', 'Ralf H&#252;tter | Karl Bartos', '5:51', 0, ''),
(154, 1006, 3, 'Metropolis', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '5:59', 0, ''),
(155, 1006, 4, 'The Model', 'Ralf H&#252;tter | Karl Bartos | Emil Schult', '3:38', 0, ''),
(156, 1006, 5, 'Neon Lights', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '9:03', 0, ''),
(157, 1006, 6, 'The Man-Machine', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '5:28', 1, 'media/07_The_Man-Machine.mp3'),
(159, 1007, 1, 'Computer World', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos | Emil Schult', '5:05', 0, ''),
(160, 1007, 2, 'Pocket Calculator', 'Ralf H&#252;tter | Karl Bartos | Emil Schult', '4:55', 1, 'media/08_Pocket_Calculator.mp3'),
(161, 1007, 3, 'Numbers', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '3:19', 0, ''),
(162, 1007, 4, 'Computer World, Part 2', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '3:21', 0, ''),
(163, 1007, 5, 'Computer Love', 'Ralf H&#252;tter | Karl Bartos | Emil Schult', '7:15', 0, ''),
(164, 1007, 6, 'Home Computer', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '6:17', 0, ''),
(165, 1007, 7, 'It''s More Fun To Compute', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '4:13', 0, ''),
(166, 1008, 1, 'Boing Boom Tschak', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '2:57', 0, ''),
(167, 1008, 2, 'Techno Pop', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos | Emil Schult', '7:42', 0, ''),
(168, 1008, 3, 'Musique Non-Stop', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '5:45', 1, 'media/09_Musique_Non_Stop.mp3'),
(169, 1008, 4, 'Der Telefon-Anruf', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '8:03', 0, ''),
(170, 1008, 5, 'Sex Objekt', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '6:51', 0, ''),
(171, 1008, 6, 'Electric Caf&#233;', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos | Maxime Schmitt', '4:20', 0, ''),
(172, 1009, 1, 'The Robots', 'Ralf H&#252;tter | Florian Schneider | Karl Bartos', '8:56', 0, ''),
(173, 1009, 2, 'Computerlove', 'Ralf H&#252;tter | Karl Bartos | Emil Schult', '6:35', 0, ''),
(174, 1009, 3, 'Pocket Calculator', 'Ralf H&#252;tter| Karl Bartos | Emil Schult', '4:32', 0, ''),
(175, 1009, 4, 'Dentaku', 'Ralf H&#252;tter| Karl Bartos | Emil Schult', '3:27', 0, ''),
(176, 1009, 5, 'Autobahn', 'Ralf H&#252;tter| Florian Schneider | Emil Schult', '9:27', 0, ''),
(177, 1009, 6, 'Radioactivity', 'Ralf H&#252;tter| Florian Schneider | Emil Schult', '6:53', 1, 'media/10_Radioactivity_Remix.mp3'),
(178, 1009, 7, 'Trans-Europe Express', 'Ralf H&#252;tter | Emil Schult', '3:20', 0, ''),
(179, 1009, 8, 'Abzug', 'Ralf H&#252;tter', '2:18', 0, ''),
(180, 1009, 9, 'Metal on Metal', 'Ralf H&#252;tter', '4:58', 0, ''),
(181, 1009, 10, 'Homecomputer', 'Ralf H&#252;tter| Karl Bartos', '8:02', 0, ''),
(182, 1009, 11, 'Music Non Stop', 'Ralf H&#252;tter| Florian Schneider | Karl Bartos', '6:38', 0, ''),
(184, 1010, 1, 'Prologue', 'Ralf H&#252;tter| Florian Schneider | Fritz Hilpert', '0:31', 0, ''),
(185, 1010, 2, 'Tour de France &#201;tape 1', 'Ralf H&#252;tter| Florian Schneider | Fritz Hilpert | Maxime Schmitt', '4:27', 1, 'media/11_Tour_De_France_Etape_1.mp3'),
(186, 1010, 3, 'Tour de France &#201;tape 2', 'Ralf H&#252;tter| Florian Schneider | Fritz Hilpert | Maxime Schmitt', '6:41', 0, ''),
(187, 1010, 4, 'Tour de France &#201;tape 3', 'Ralf H&#252;tter| Florian Schneider | Fritz Hilpert | Maxime Schmitt', '3:56', 0, ''),
(188, 1010, 5, 'Chrono', 'Ralf H&#252;tter| Florian Schneider | Fritz Hilpert | Maxime Schmitt', '3:19', 0, ''),
(189, 1010, 6, 'Vitamin', 'Ralf H&#252;tter| Florian Schneider | Fritz Hilpert', '8:09', 0, ''),
(190, 1010, 7, 'Aerodynamik', 'Ralf H&#252;tter| Florian Schneider | Fritz Hilpert | Maxime Schmitt', '5:04', 0, ''),
(191, 1010, 8, 'Titanium', 'Ralf H&#252;tter| Florian Schneider | Fritz Hilpert | Maxime Schmitt', '3:21', 0, ''),
(192, 1010, 9, 'Elektro Kardiogramm', 'Ralf H&#252;tter| Fritz Hilpert', '5:16', 0, ''),
(193, 1010, 10, 'La Forme', 'Ralf H&#252;tter| Maxime Schmitt', '8:41', 0, ''),
(194, 1010, 11, 'R&#233;g&#233;neration', 'Ralf H&#252;tter | Maxime Schmitt', '1:16', 0, ''),
(195, 1010, 12, 'Tour de France', 'Ralf H&#252;tter| Florian Schneider | Maxime Schmitt | Karl Bartos', '5:12', 0, ''),
(196, 1011, 1, 'The Man-Machine', 'Ralf H&#252;tter| Florian Schneider | Karl Bartos', '7:55', 0, ''),
(197, 1011, 2, 'Planet of Visions', 'Ralf H&#252;tter| Florian Schneider | Fritz Hilpert', '4:45', 0, ''),
(198, 1011, 3, 'Tour de France (&#201;tape 1)', 'Ralf H&#252;tter| Florian Schneider | Maxime Schmitt | Fritz Hilpert', '4:22', 0, ''),
(199, 1011, 4, 'Chrono', 'Ralf H&#252;tter| Florian Schneider | Maxime Schmitt | Fritz Hilpert', '1:29', 0, ''),
(200, 1011, 5, 'Tour de France (&#201;tape 2)', 'Ralf H&#252;tter| Florian Schneider | Maxime Schmitt | Fritz Hilpert', '4:48', 0, ''),
(201, 1011, 6, 'Vitamin', 'Ralf H&#252;tter| Fritz Hilpert', '6:41', 0, ''),
(202, 1011, 7, 'Tour de France', 'Ralf H&#252;tter| Florian Schneider | Maxime Schmitt | Karl Bartos', '6:18', 0, ''),
(203, 1011, 8, 'Autobahn', 'Ralf H&#252;tter| Florian Schneider | Emil Schult', '8:51', 0, ''),
(204, 1011, 9, 'The Model', 'Ralf H&#252;tter| Karl Bartos | Emil Schult', '3:41', 0, ''),
(205, 1011, 10, 'Neon Lights', 'Ralf H&#252;tter| Florian Schneider | Karl Bartos', '5:58', 0, ''),
(206, 1011, 1, 'Radioactivity', 'Ralf H&#252;tter| Florian Schneider | Emil Schult', '7:41', 0, ''),
(207, 1011, 2, 'Trans Europe Express', 'Ralf H&#252;tter| Emil Schult', '5:01', 0, ''),
(208, 1011, 3, 'Metal on Metal', 'Ralf H&#252;tter', '4:28', 0, ''),
(209, 1011, 4, 'Numbers', 'Ralf H&#252;tter| Florian Schneider | Karl Bartos', '4:27', 0, ''),
(210, 1011, 5, 'Computer World', 'Ralf H&#252;tter| Florian Schneider | Karl Bartos', '2:55', 0, ''),
(211, 1011, 6, 'Home Computer', 'Ralf H&#252;tter| Florian Schneider | Karl Bartos', '5:55', 0, ''),
(212, 1011, 7, 'Pocket Calculator', 'Ralf H&#252;tter| Florian Schneider | Karl Bartos', '2:58', 0, ''),
(213, 1011, 8, 'Dentaku', 'Ralf H&#252;tter| Florian Schneider | Karl Bartos', '3:15', 0, ''),
(214, 1011, 9, 'The Robots', 'Ralf H&#252;tter| Florian Schneider | Karl Bartos', '7:23', 0, ''),
(215, 1011, 10, 'Elektro Kardiogramm', 'Ralf H&#252;tter| Fritz Hilpert', '4:41', 0, ''),
(216, 1011, 11, 'A&#233;ro Dynamik', 'Ralf H&#252;tter| Florian Schneider | Maxime Schmitt Fritz Hilpert', '7:14', 0, ''),
(217, 1011, 12, 'Music Non Stop', 'Ralf H&#252;tter| Florian Schneider | Karl Bartos', '9:51', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userId` int(11) NOT NULL auto_increment,
  `userLevel` int(11) NOT NULL default '0',
  `userName` varchar(75) NOT NULL default '',
  `userPass` varchar(75) NOT NULL default '',
  `firstName` varchar(50) NOT NULL default '',
  `lastName` varchar(75) NOT NULL default '',
  `emailAddress` varchar(125) NOT NULL default '',
  `country` char(2) NOT NULL default '',
  PRIMARY KEY  (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userId`, `userLevel`, `userName`, `userPass`, `firstName`, `lastName`, `emailAddress`, `country`) VALUES
(1, 1, 'jekyll', 'kraftwerk', 'James', 'Coll', 'james.evin.coll@gmail.com', 'IE'),
(9, 0, 'Tom', 'admin', 'Tom', 'Smith', 'tom.smith@ireland.gov', 'IE'),
(10, 0, 'Peter', 'asdf', 'Peter', 'Smith', 'p.smith@ireland.gov', 'IE'),
(11, 0, 'James', 'henry', 'James', 'Henry', 'j.henry@blah.org', 'DE'),
(12, 0, 'sWilkins', 'tomboy', 'Sarah', 'Wilkins', 'swilkins@gmail.com', 'Un'),
(13, 0, 'kraftfan', 'Trampoline', 'Ralf', 'Schneider', 'ralf@altran.de', 'DE'),
(14, 0, 'Autobahn25', 'hello', 'Pierre', 'Lamonte', 'plamonte@fr.gov', 'FR'),
(15, 0, 'TrinnyKrautFan', 'helloworld', 'Trinidad', 'La Puentes', 'trinny12@hotmail.es', 'ES'),
(16, 0, 'Daisy', 'hello', 'Kahlen', 'Soong', 'k.song@ln.kr', 'KR'),
(18, 0, 'Damien', 'hirst', 'Damien', 'Hirst', 'd.hirst@altavista.org', 'Un'),
(19, 1, 'Che', 'cuba', 'Che', 'Guevara', 'c.guevara@hastalavista.org', 'Cu'),
(20, 1, 'krautrock99', 'kraftwerk', 'Peter', 'Neils', 'p.neils@caramba.org', 'Ir'),
(21, 0, 'PiotrBerlin', 'house', 'Piotr', 'Schmidt', 'p.schmidt@audi.de', 'Ge'),
(22, 0, 'asdffasdf', 'asdf', 'Asdf', 'Asdf', 'Asdf', 'Un');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trackinfo`
--
ALTER TABLE `trackinfo`
  ADD CONSTRAINT `trackinfo_ibfk_1` FOREIGN KEY (`albumId`) REFERENCES `albuminfo` (`albumId`);
