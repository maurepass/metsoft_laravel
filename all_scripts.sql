
-- DETAILS TABLE

-- sql_for_details_table
ALTER TABLE `details` CHANGE `id_offer` `offer_id` INT(11) NOT NULL;
ALTER TABLE `details` CHANGE `id_mat` `mat_id` INT(11) NOT NULL;

-- ERROR TO CHECK
-- ALTER TABLE `details` CHANGE `created_at` `created_at` DATETIME NOT NULL, CHANGE `updated_at` `updated_at` DATETIME NOT NULL;

update details
set machining = Case
when machining like 'brak%' then 5
when machining = 'do wym rys' then 1
when machining = 'na gotowo' then 3
when machining = 'wg uwag' then 2
when machining = 'zgrubna' then 4
else machining
end;

ALTER TABLE `details` CHANGE `machining` `machining_id` INT NULL DEFAULT NULL;


-- sql_for_materials_table
ALTER TABLE `materials` CHANGE `mat_group` `mat_group_id` INT(11) NOT NULL;

update materials
set mat_group_id = Case
    when mat_group_id = '11' then 1
    when mat_group_id = '13' then 2
    when mat_group_id = '15' then 3
    when mat_group_id = '21' then 4
    when mat_group_id = '22' then 5
    when mat_group_id = '23' then 6
    when mat_group_id = '24' then 7
    when mat_group_id = '25' then 8
    when mat_group_id = '26' then 9
    when mat_group_id = '27' then 10
    when mat_group_id = '0' then 11
    when mat_group_id = '99' then 12
    when mat_group_id = '14' then 13
else mat_group_id
end;


-- OFFERS TABLE

DELETE FROM `offers` WHERE `offers`.`id` = 296;
DELETE FROM `offers` WHERE `offers`.`id` = 406;
DELETE FROM `offers` WHERE `offers`.`id` = 455;

-- sql_for_offers_table
update offers
set status = Case
when status = 'W opracowaniu' then 1
when status = 'Odmowa' then 3
when status = 'Odlewy' then 4
when status = 'Modele' then 5
when status = 'Obr. cieplna' then 6
when status = 'Obr. mech.' then 7
when status = 'Kolorki' then 8
else status
end;

UPDATE offers
SET status = CASE
WHEN status = 'obr_mech' THEN 7
WHEN status = 'obr_ciep' THEN 6
ELSE status
END;

update offers
set tech_memb = Case
when tech_memb = 'Ł.Pasek' then 2
when tech_memb = 'P.Żmuda' then 3
when tech_memb = 'M.Oleś' then 4
when tech_memb = 'M.Woźniak' then 5
when tech_memb = 'M.Kasprzyk' then 6
when tech_memb = 'D.Serafin' then 7
when tech_memb = 'T.Muc' then 8
when tech_memb = 'E.Gębala' then 9
when tech_memb = 'R.Niedzielski' then 10
when tech_memb = 'P.Pawlik' then 11
when tech_memb = 'K.Gajoch' then 12
when tech_memb = 'Ł.Kurek' then 13
when tech_memb = 'J.Broś' then 14
when tech_memb = 'P.Czech' then 15
when tech_memb = 'M.Bernaś' then 16
when tech_memb = 'M.Balicki' then 17
when tech_memb = 'S.Łenyk' then 18
when tech_memb = 'Ł.Makuła' then 19
when tech_memb = 'P.Bieniek' then 20
when tech_memb = 'M.W.Tuleja' then 21
when tech_memb = 'M.Dubas' then 22
when tech_memb = 'K.Kwarciak' then 23
when tech_memb = 'M.Biernat' then 24
else tech_memb
end;

update offers
set mark_memb = Case
when mark_memb = 'Ł.Pasek' then 2
when mark_memb = 'P.Żmuda' then 3
when mark_memb = 'M.Oleś' then 4
when mark_memb = 'M.Woźniak' then 5
when mark_memb = 'M.Kasprzyk' then 6
when mark_memb = 'D.Serafin' then 7
when mark_memb = 'T.Muc' then 8
when mark_memb = 'E.Gębala' then 9
when mark_memb = 'R.Niedzielski' then 10
when mark_memb = 'P.Pawlik' then 11
when mark_memb = 'K.Gajoch' then 12
when mark_memb = 'Ł.Kurek' then 13
when mark_memb = 'J.Broś' then 14
when mark_memb = 'P.Czech' then 15
when mark_memb = 'M.Bernaś' then 16
when mark_memb = 'M.Balicki' then 17
when mark_memb = 'S.Łenyk' then 18
when mark_memb = 'Ł.Makuła' then 19
when mark_memb = 'P.Bieniek' then 20
when mark_memb = 'M.W.Tuleja' then 21
when mark_memb = 'M.Dubas' then 22
when mark_memb = 'K.Kwarciak' then 23
when mark_memb = 'M.Biernat' then 24
else mark_memb
end;

ALTER TABLE `offers` CHANGE `mark_memb` `user_mark_id` INT(11) NOT NULL;
ALTER TABLE `offers` CHANGE `tech_memb` `user_tech_id` INT(11) NULL;
ALTER TABLE `offers` CHANGE `status` `status_id` INT(11) NOT NULL;
ALTER TABLE `offers` modify `offer_no` VARCHAR(20);
ALTER TABLE `offers` modify `client` VARCHAR(100);


-- sql_for_offers_statuses
RENAME TABLE `offers_statuses` TO `offer_statuses`;
ALTER TABLE `offer_statuses` CHANGE `offers_status` `offer_status` VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
ALTER TABLE `offer_statuses` DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;



-- PATTERNS TABLE

DELETE FROM `patterns` WHERE `patterns`.`id` = 12;

-- sql_for_patterns_table
update patterns
set status = Case
when status = 'Przywieziony od klienta' then 1
when status = 'Wydany na odlewnie' then 2
when status = 'Oddany na stan magazynu' then 3
when status = 'Zabrany przez klienta' then 4
when status = 'Zezłomowany' then 5
when status = 'Brak modelu' then 6
when status = 'Wypożyczony przez klienta' then 7
when status is NULL then 99
else status
end;

ALTER TABLE `patterns` CHANGE `status` `status_id` INT NOT NULL;
ALTER TABLE `patterns` CHANGE `updated_at` `updated_at` DATETIME NOT NULL;


-- sql_for_patterns_operations_table

RENAME TABLE `patterns_operations` TO `pattern_statuses`;
ALTER TABLE `pattern_statuses` CHANGE `operation` `status` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NULL DEFAULT NULL;


-- sql_for_patterns_history
update patterns_history
set operation = Case
when operation = 'Przywieziony od klienta' then 1
when operation = 'Wydany na odlewnie' then 2
when operation = 'Oddany na stan magazynu' then 3
when operation = 'Zabrany przez klienta' then 4
when operation = 'Zezłomowany' then 5
when operation = 'Brak modelu' then 6
when operation = 'Wypożyczony przez klienta' then 7
when operation = 'Wypożyczony' then 7
when operation = 'Oddany' then 3
when operation = 'Przywieziony' then 1
when operation = 'Pobrany' then 2
when operation = 'Wywieziony' then 4
else operation
end;

ALTER TABLE `patterns_history` CHANGE `operation` `status_id` INT NOT NULL;
RENAME TABLE `patterns_history` TO `pattern_history`;
ALTER TABLE `pattern_history` ADD `updated_at` DATETIME NOT NULL AFTER `date`;

-- sql_for_orders_statuses_table
RENAME TABLE `orders_statuses` TO `order_statuses`;

-- sql_for_orders_table
ALTER TABLE `orders` CHANGE `status` `status_id` INT(11) NOT NULL;

update orders
set id_tech = Case
when id_tech = 'L_Pasek' then 2
when id_tech = 'P_Zmuda' then 3
when id_tech = 'M_Oles' then 4
when id_tech = 'M_Wozniak' then 5
when id_tech = 'M_Kasprzyk' then 6
when id_tech = 'D_Serafin' then 7
when id_tech = 'R_Niedzielski' then 10
when id_tech = 'P_Pawlik' then 11
when id_tech = 'K_Gajoch' then 12
when id_tech = 'P_Czech' then 15
else id_tech
end;

ALTER TABLE `orders` CHANGE `id_tech` `tech_memb_id` INT(11) NULL;
alter table `orders` modify `working_time` int(11);
alter table `orders` modify `important` int(11);


--
-- Table structure for table `material_groups`
--

DROP TABLE IF EXISTS `material_groups`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mat_group` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_groups`
--

/*!40000 ALTER TABLE `material_groups` DISABLE KEYS */;
INSERT INTO `material_groups` VALUES (1,11,'Żeliwo szare','2019-03-28 08:00:41.664057','2019-03-28 08:00:29.176459'),(2,13,'Żeliwo sferoidalne perlityczne','2019-03-28 08:02:18.081486','2019-03-28 08:02:18.081535'),(3,15,'Żeliwo sferoidalne ferrytyczne','2019-03-28 08:02:31.050114','2019-03-28 08:02:31.050175'),(4,21,'Staliwo węglowe','2019-03-28 08:02:43.191125','2019-03-28 08:02:43.191190'),(5,22,'< dodaj opis >','2019-03-28 08:02:56.939608','2019-03-28 08:02:56.939668'),(6,23,'< dodaj opis >','2019-03-28 08:03:00.077395','2019-03-28 08:03:00.077447'),(7,24,'< dodaj opis >','2019-03-28 08:03:03.288954','2019-03-28 08:03:03.288996'),(8,25,'< dodaj opis >','2019-03-28 08:03:06.739903','2019-03-28 08:03:06.739947'),(9,26,'< dodaj opis >','2019-03-28 08:03:09.949085','2019-03-28 08:03:09.949429'),(10,27,'< dodaj opis >','2019-03-28 08:03:13.862177','2019-03-28 08:03:13.862233'),(11,0,'< dodaj opis >','2019-03-28 08:03:18.204692','2019-03-28 08:03:18.204735'),(12,99,'< dodaj opis >','2019-03-28 08:03:22.988091','2019-03-28 08:03:22.988136'),(13,14,'< dodaj opis >','2019-06-16 14:35:57.865293','2019-06-16 14:35:57.865293');
/*!40000 ALTER TABLE `material_groups` ENABLE KEYS */;


--
-- Table structure for table `machinings`
--

DROP TABLE IF EXISTS `machinings`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `machinings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machining` varchar(50) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `machinings`
--

/*!40000 ALTER TABLE `machinings` DISABLE KEYS */;
INSERT INTO `machinings` VALUES (1,'do wym rys','2019-03-28 08:09:01.454042','2019-03-28 08:09:01.454087'),(2,'wg uwag','2019-03-28 08:09:14.965009','2019-03-28 08:09:14.965061'),(3,'na gotowo','2019-03-28 08:09:19.416528','2019-03-28 08:09:19.416573'),(4,'zgrubna','2019-03-28 08:09:32.785058','2019-03-28 08:09:32.785103'),(5,'brak','2019-03-28 08:09:35.893983','2019-03-28 08:09:35.894033');
/*!40000 ALTER TABLE `machinings` ENABLE KEYS */;


-- Create tabel offer_pattern_statuses

DROP TABLE IF EXISTS `offer_pattern_statuses`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_pattern_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_pattern_statuses`
--

/*!40000 ALTER TABLE `offer_pattern_statuses` DISABLE KEYS */;
INSERT INTO `offer_pattern_statuses` VALUES (1,'wg wyceny','2019-03-28 08:17:10.166124','2019-03-28 08:17:10.166171'),(2,'dostarcza klient','2019-03-28 08:17:15.229270','2019-03-28 08:17:15.229313'),(3,'na magazynie','2019-03-28 08:17:19.006620','2019-03-28 08:17:19.006663'),(4,'wg uwag','2019-03-28 08:17:22.151956','2019-03-28 08:17:22.152000');
/*!40000 ALTER TABLE `offer_pattern_statuses` ENABLE KEYS */;


--
-- Table structure for table `heat_treatments`
--

DROP TABLE IF EXISTS `heat_treatments`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `heat_treatments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term` varchar(50) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `heat_treatments`
--

/*!40000 ALTER TABLE `heat_treatments` DISABLE KEYS */;
INSERT INTO `heat_treatments` VALUES (1,'brak','2019-03-28 08:04:54.253670','2019-03-28 08:04:54.253737'),(2,'normalizacja','2019-03-28 08:04:58.689174','2019-03-28 08:04:58.689225'),(3,'ulepszanie cieplne','2019-03-28 08:05:17.849092','2019-03-28 08:05:17.849144'),(4,'przesycanie','2019-03-28 08:05:22.105516','2019-03-28 08:05:22.105560'),(5,'odprężanie','2019-03-28 08:05:29.282170','2019-03-28 08:05:29.282222'),(6,'wg uwag','2019-03-28 08:05:48.046077','2019-03-28 08:05:48.046122');
/*!40000 ALTER TABLE `heat_treatments` ENABLE KEYS */;


--
-- Table structure for table `pattern_tapers`
--

DROP TABLE IF EXISTS `pattern_tapers`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pattern_tapers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taper` varchar(50) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pattern_tapers`
--

/*!40000 ALTER TABLE `pattern_tapers` DISABLE KEYS */;
INSERT INTO `pattern_tapers` VALUES (1,'wg PN-EN 12890','2019-03-28 12:28:44.344644','2019-03-28 12:28:44.344693'),(2,'wg modelu','2019-03-28 12:30:58.366843','2019-03-28 12:30:58.366896'),(3,'wg uwag','2019-03-28 12:56:57.502261','2019-03-28 12:56:57.502310');
/*!40000 ALTER TABLE `pattern_tapers` ENABLE KEYS */;


--
-- Table structure for table `atest_types`
--

DROP TABLE IF EXISTS `atest_types`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atest_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atest` varchar(50) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atest_types`
--

/*!40000 ALTER TABLE `atest_types` DISABLE KEYS */;
INSERT INTO `atest_types` VALUES (1,'3.1 wg PN-EN 10204','2019-05-27 11:31:37.671179','2019-05-27 11:31:37.671179'),(2,'3.2 (DNV) wg PN-EN 10204','2019-05-27 11:32:00.324755','2019-05-27 11:32:00.324755'),(3,'3.2 (LRS) wg PN-EN 10204','2019-05-27 11:32:17.698520','2019-05-27 11:32:17.698520'),(4,'3.2 (ABS) wg PN-EN 10204','2019-05-27 11:32:26.802332','2019-05-27 11:32:26.802332'),(5,'3.2 (TUV) wg PN-EN 10204','2019-05-27 11:32:36.317696','2019-05-27 11:32:36.318700'),(6,'3.2 (klienta) wg PN-EN 10204','2019-05-27 11:32:46.614463','2019-05-27 11:32:46.614463'),(7,'wg uwag','2019-05-27 11:32:58.500028','2019-05-27 11:32:58.500028');
/*!40000 ALTER TABLE `atest_types` ENABLE KEYS */;


DROP TABLE IF EXISTS `auth_group`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_group`
--

/*!40000 ALTER TABLE `auth_group` DISABLE KEYS */;
INSERT INTO `auth_group` VALUES (1,'marketing'),(2,'technologia');
/*!40000 ALTER TABLE `auth_group` ENABLE KEYS */;

--
-- Table structure for table `auth_user`
--

DROP TABLE IF EXISTS `auth_user`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(128) NOT NULL,
  `last_login` datetime(6) DEFAULT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `username` varchar(150) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(254) NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_joined` datetime(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;


--
-- Dumping data for table `auth_user`
--
/*!40000 ALTER TABLE `auth_user` DISABLE KEYS */;
INSERT INTO `auth_user` VALUES (1,'pbkdf2_sha256$150000$O0HLCXbhPEao$j6es2kfdsWYF6fQ+gWSsKUQ/ffIXkK71B4/nmgxt8Kk=','2019-07-12 06:58:59.879212',1,'admin','','','',1,1,'2019-03-24 13:37:48.112088'),(2,'pbkdf2_sha256$120000$26MnE33MNxJx$av9QHMqr30GAp+J1X9anij3cs6hY26KtmWbM+2zI6E4=',NULL,0,'L_Pasek','Ł.Pasek','','',0,1,'2019-03-24 18:57:22.000000'),(3,'pbkdf2_sha256$120000$oGMkKkv9L8rL$ZGP8Qdamk6wqPMCtITD/pwcaT6jHdOskJpDPyzJWRp4=',NULL,0,'P_Zmuda','P.Żmuda','','',0,1,'2019-03-24 18:57:45.000000'),(4,'pbkdf2_sha256$150000$yPh7dg2ElaoW$chLW/JNNjnfRCndCpd7dbEYqyqjrQJIReidPoWGnWcU=','2019-05-13 08:15:44.223967',0,'M_Oles','M.Oleś','','',0,1,'2019-03-24 18:58:03.000000'),(5,'pbkdf2_sha256$120000$saa1I3nTtHRS$JgWwNi4nzy/f78/ToInidAvBgtHH4JrKdPkL2G9BQWI=',NULL,0,'M_Wozniak','M.Woźniak','','',0,1,'2019-03-24 18:58:19.000000'),(6,'pbkdf2_sha256$120000$4BOI2CNRTnEC$GD7fPn7/m0ySXD5K8/ake2dM+rHzBFW/cAReV8OxYek=',NULL,0,'M_Kasprzyk','M.Kasprzyk','','',0,1,'2019-03-24 18:58:36.000000'),(7,'pbkdf2_sha256$120000$fKcBZ8G89BxC$w3tmfuaaLLrJ3e3WGGB3nv0TQu0HFDMx4Dp8qMCu8UU=',NULL,0,'D_Serafin','D.Serafin','','',0,1,'2019-03-24 18:58:46.000000'),(8,'pbkdf2_sha256$120000$r53KtIoGbtPc$KlSRJ1uT4iAZGF6RedNGR0w5AXC3Soz4inQOKZvIXBI=',NULL,0,'T_Muc','T.Muc','','',0,0,'2019-03-24 18:58:56.000000'),(9,'pbkdf2_sha256$120000$PKFJh2BZt0XL$rEaES1C+W30egoc7SPHHMzh0d78rC43TuIUHIPvYMkA=',NULL,0,'E_Gebala','E.Gębala','','',0,0,'2019-03-24 18:59:08.000000'),(10,'pbkdf2_sha256$120000$G1IxjVsVMswv$Pq28xVodJEPn3WCI4ULpPN0o0SgkkAzs6cmSI27zb1I=',NULL,0,'R_Niedzielski','R.Niedzielski','','',0,1,'2019-03-24 18:59:22.000000'),(11,'pbkdf2_sha256$120000$PF4gLZejfovZ$RU8+byRX6ix5P39581GCJhZTNeL5TVq6nbb45KwZ8jY=',NULL,0,'P_Pawlik','P.Pawlik','','',0,1,'2019-03-24 18:59:32.000000'),(12,'pbkdf2_sha256$120000$Q4930RSb7kKz$GCoekZEOGReMxtmjlO9oEHM1/W5Yo8p4gJF7m0lNv0I=',NULL,0,'K_Gajoch','K.Gajoch','','',0,1,'2019-03-24 18:59:43.000000'),(13,'pbkdf2_sha256$120000$W0OU4lxwZ09h$UVdECVTXLtfWycKeXJy4jgfocIGaLQBG6lHzMzErPEw=',NULL,0,'L_Kurek','Ł.Kurek','','',0,0,'2019-03-24 18:59:58.000000'),(14,'pbkdf2_sha256$120000$MUHmgTff5FBW$MnL/VBceNsqniBeKN3BBVumIk7UE3nxecGKSLDsDXdw=',NULL,0,'J_Bros','J.Broś','','',0,0,'2019-03-24 19:00:10.000000'),(15,'pbkdf2_sha256$120000$yyy9yzAm7qkz$ITydJjYADJMqIzf0syKfODuwlHVCTg/iwG7inlOqFGE=',NULL,0,'P_Czech','P.Czech','','',0,1,'2019-03-24 19:00:20.000000'),(16,'pbkdf2_sha256$120000$YGgS7d7LvydO$USOzxoGIOQIQJVfD7+HoAXR9HUAyXcBxvOSdlOvvAXs=',NULL,0,'M_Bernas','M.Bernaś','','',0,1,'2019-03-24 19:04:37.000000'),(17,'pbkdf2_sha256$120000$Oj1HIfytpkDR$9ZxUeDOMO0KsFT1GmLESMfReLCZGXvhAhJZmA/Yuuqw=',NULL,0,'M_Balicki','M.Balicki','','',0,1,'2019-03-24 19:04:49.000000'),(18,'pbkdf2_sha256$120000$8FQGkl72if55$Gi0e8QxNvrGXu537nLuovBFLP0GGER6SAVv3Cz6Mcf0=',NULL,0,'S_Lenyk','S.Łenyk','','',0,1,'2019-03-24 19:05:04.000000'),(19,'pbkdf2_sha256$120000$lmXqReoEq59P$fr09T+Kx2UTfmIYh7mlQOEWAkth+ln3pwxrFtB4m7Bg=',NULL,0,'L_Makula','Ł.Makuła','','',0,1,'2019-03-24 19:05:21.000000'),(20,'pbkdf2_sha256$120000$MgGhb9tHYdI3$/2+uADD+Nys11suwoYjDQPLsOQLMg6B6smNRm6hc3JY=',NULL,0,'P_Bieniek','P.Bieniek','','',0,1,'2019-03-24 19:05:32.000000'),(21,'pbkdf2_sha256$120000$ZNG7CjgZdRPW$DpDiVhYwjctPB4lnTiTNapqwmPQS7YJYNp45cvTBZ/g=',NULL,0,'M_Tuleja','M.W.Tuleja','','',0,0,'2019-03-24 19:07:08.000000'),(22,'pbkdf2_sha256$120000$wkkqZYaaHXGJ$Guirz+ZW2c+BZib4N5QzcdhxL2xkhpTIsMbuRyoX1FM=',NULL,0,'M_Dubas','M.Dubas','','',0,1,'2019-03-24 19:07:19.000000'),(23,'pbkdf2_sha256$120000$s8rqPSXPpMP6$FeftwymcqvO5eWrwh9nBBvYqpVOK4bga+nHyqwUsdIM=',NULL,0,'K_Kwarciak','K.Kwarciak','','',0,1,'2019-03-24 19:07:28.000000'),(24,'pbkdf2_sha256$120000$9prYeb4S02NM$Zfs57l7OLY6VQchaHUQx+H1wmtGu01V7sJhKA5FT1cw=',NULL,0,'M_Biernat','M.Biernat','','',0,1,'2019-03-24 19:07:46.000000'),(25,'pbkdf2_sha256$150000$J1TmZQE9XubH$OTaomwSLidn6bSZRbgSbLN09mIKasnxIeeGO9iP+AKY=','2019-07-12 07:26:08.635808',0,'modelarnia','','','',0,1,'2019-07-03 16:31:31.129067');
/*!40000 ALTER TABLE `auth_user` ENABLE KEYS */;


--
-- Table structure for table `auth_user_groups`
--

DROP TABLE IF EXISTS `auth_user_groups`;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_user_groups_user_id_group_id_94350c0c_uniq` (`user_id`,`group_id`),
  KEY `auth_user_groups_group_id_97559544_fk_auth_group_id` (`group_id`),
  CONSTRAINT `auth_user_groups_group_id_97559544_fk_auth_group_id` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`),
  CONSTRAINT `auth_user_groups_user_id_6a12ed8b_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;



--
-- Dumping data for table `auth_user_groups`
--
/*!40000 ALTER TABLE `auth_user_groups` DISABLE KEYS */;
INSERT INTO `auth_user_groups` VALUES (13,2,2),(3,3,2),(7,4,2),(6,5,2),(8,6,2),(2,10,2),(17,11,2),(16,12,2),(4,15,2),(11,16,1),(12,17,1),(1,18,1),(14,19,1),(5,20,1),(9,22,1),(15,23,1),(10,24,1);
/*!40000 ALTER TABLE `auth_user_groups` ENABLE KEYS */;
