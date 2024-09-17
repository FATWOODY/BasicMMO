--
-- Table structure for table `forum_messages`
--

DROP TABLE IF EXISTS forum_messages;
CREATE TABLE forum_messages (
  mID int(11) NOT NULL auto_increment,
  mDate text NOT NULL,
  mUser text NOT NULL,
  mSubject text NOT NULL,
  mBody text NOT NULL,
  mBelong int(11) NOT NULL default '0',
  mChildren int(11) NOT NULL default '0',
  mAdmin smallint(1) NOT NULL default '0',
  mThread int(11) NOT NULL default '0',
  PRIMARY KEY  (mID)
) ENGINE=MyISAM;

--
-- Dumping data for table `forum_messages`
--



--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS logs;
CREATE TABLE logs (
  lID int(11) NOT NULL auto_increment,
  lType smallint(1) NOT NULL default '1',
  lWinLose smallint(1) NOT NULL default '1',
  lYou int(11) NOT NULL default '0',
  lOther int(11) NOT NULL default '0',
  lOtherLogin text NOT NULL,
  lTurns smallint(10) NOT NULL default '0',
  lGold int(11) NOT NULL default '0',
  lEXP int(11) NOT NULL default '0',
  lTime text NOT NULL,
  lTime2 int(11) NOT NULL default '0',
  PRIMARY KEY  (lID)
) ENGINE=MyISAM;

--
-- Dumping data for table `logs`
--


--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS messages;
CREATE TABLE messages (
  mID int(11) NOT NULL auto_increment,
  mTo int(11) NOT NULL default '0',
  mFrom int(11) NOT NULL default '0',
  mFromLogin text NOT NULL,
  mTitle text NOT NULL,
  mBody text NOT NULL,
  mTime text NOT NULL,
  mTime2 int(11) NOT NULL default '0',
  mRead char(3) NOT NULL default 'no',
  PRIMARY KEY  (mID)
) ENGINE=MyISAM;

--
-- Dumping data for table `messages`
--


--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS news;
CREATE TABLE news (
  nID int(11) NOT NULL auto_increment,
  nDate text NOT NULL,
  nTitle text NOT NULL,
  nBody text NOT NULL,
  PRIMARY KEY  (nID)
) ENGINE=MyISAM;

--
-- Dumping data for table `news`
--

INSERT INTO news (nID, nDate, nTitle, nBody) VALUES (16,'19th June 2004','(8:33pm GMT+11.00):','news item.');

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS polls;
CREATE TABLE polls (
  pID int(11) NOT NULL auto_increment,
  pQuestion varchar(255) default NULL,
  pAnswers text,
  pResults text,
  PRIMARY KEY  (pID),
  KEY pID (pID)
) ENGINE=MyISAM;

--
-- Dumping data for table `polls`
--

INSERT INTO polls (pID, pQuestion, pAnswers, pResults) VALUES (7,'Do you like BasicMMO','Yes;No','0;0');

--
-- Table structure for table `polls_votes`
--

DROP TABLE IF EXISTS polls_votes;
CREATE TABLE polls_votes (
  uID int(11) NOT NULL default '0',
  uLastPoll int(11) NOT NULL default '0',
  PRIMARY KEY  (uID)
) ENGINE=MyISAM;

--
-- Dumping data for table `polls_votes`
--


--
-- Table structure for table `referal_list`
--

DROP TABLE IF EXISTS referal_list;
CREATE TABLE referal_list (
  uReferer int(11) NOT NULL default '0',
  uReferee int(11) NOT NULL default '0'
) ENGINE=MyISAM;

--
-- Dumping data for table `referal_list`
--


--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS settings;
CREATE TABLE settings (
  sID int(11) NOT NULL auto_increment,
  sName text NOT NULL,
  sValue text NOT NULL,
  sDesc text NOT NULL,
  sGroup text NOT NULL,
  PRIMARY KEY  (sID)
) ENGINE=MyISAM;

--
-- Dumping data for table `settings`
--

INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (1,'Number_of_News_Items','1','# of News Items on Front Page','General Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (2,'News_Template','&lt;u&gt;[ndate] [ntitle]&lt;/u&gt;&lt;br&gt;[nbody]&lt;br&gt;&lt;br&gt;','News Template','General Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (3,'Admin_News_Items_Per_Page','10','# of News per Page (admin)','Admin Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (8,'wp_1_dmg','200','Weapon Slot 1: Damage','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (9,'wp_2_dmg','1000','Weapon Slot 2: Damage','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (10,'wp_3_dmg','3000','Weapon Slot 3: Damage','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (11,'wp_4_dmg','6000','Weapon Slot 4: Damage','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (12,'wp_5_dmg','10000','Weapon Slot 5: Damage','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (13,'wp_1_nm','Dagger','Weapon Slot 1: Name','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (14,'wp_2_nm','Morning Star','Weapon Slot 2: Name','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (15,'wp_3_nm','Short Sword','Weapon Slot 3: Name','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (16,'wp_4_nm','Long Sword','Weapon Slot 4: Name','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (17,'wp_5_nm','Battle Axe','Weapon Slot 5: Name','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (18,'wp_1_cst','2000','Weapon Slot 1: Cost','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (19,'wp_2_cst','10000','Weapon Slot 2: Cost','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (20,'wp_3_cst','30000','Weapon Slot 3: Cost','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (21,'wp_4_cst','60000','Weapon Slot 4: Cost','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (22,'wp_5_cst','100000','Weapon Slot 5: Cost','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (23,'wp_1_sll','800','Weapon Slot 1: Sell Price','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (24,'wp_2_sll','4000','Weapon Slot 2: Sell Price','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (25,'wp_3_sll','12000','Weapon Slot 3: Sell Price','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (26,'wp_4_sll','24000','Weapon Slot 4: Sell Price','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (27,'wp_5_sll','40000','Weapon Slot 5: Sell Price','Weapon Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (28,'ar_1_dmg','200','Armour Slot 1: Damage','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (29,'ar_2_dmg','1000','Armour Slot 2: Damage','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (30,'ar_3_dmg','3000','Armour Slot 3: Damage','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (31,'ar_4_dmg','6000','Armour Slot 4: Damage','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (32,'ar_5_dmg','10000','Armour Slot 5: Damage','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (33,'ar_1_nm','Buckler','Armour Slot 1: Name','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (34,'ar_2_nm','Small Shield','Armour Slot 2: Name','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (35,'ar_3_nm','Splint Armour','Armour Slot 3: Name','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (36,'ar_4_nm','Plate Armour','Armour Slot 4: Name','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (37,'ar_5_nm','Full Plate Armour','Armour Slot 5: Name','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (38,'ar_1_cst','2000','Armour Slot 1: Cost','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (39,'ar_2_cst','10000','Armour Slot 2: Cost','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (40,'ar_3_cst','30000','Armour Slot 3: Cost','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (41,'ar_4_cst','60000','Armour Slot 4: Cost','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (42,'ar_5_cst','100000','Armour Slot 5: Cost','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (43,'ar_1_sll','800','Armour Slot 1: Sell Price','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (44,'ar_2_sll','4000','Armour Slot 2: Sell Price','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (45,'ar_3_sll','12000','Armour Slot 3: Sell Price','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (46,'ar_4_sll','24000','Armour Slot 4: Sell Price','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (47,'ar_5_sll','40000','Armour Slot 5: Sell Price','Armour Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (48,'gametitle','BasicMMO','Game\'s Title','General Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (49,'game_url','http://www.basicmmo.com/','Game\'s URL','General Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (50,'off_men_cst','2000','Offensive Men: Cost','Training Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (51,'def_men_cst','2000','Defensive Men: Cost','Training Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (52,'min_men_cst','3000','Miners: Cost','Training Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (53,'lvls_below','3','Max Levels Below for an Attack','Attack Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (54,'lvls_above','5','Max Levels Below for an Attack','Attack Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (55,'attacks_24','5','Max. attacks on a Player in 24 Hours','Attack Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (56,'max_atk_turns','10','Max. attacks turns per Attack','Attack Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (57,'prace_1','Undead','Race Slot 1: Name','Race Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (58,'prace_2','Humans','Race Slot 2: Name','Race Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (59,'prace_3','Goblins','Race Slot 3: Name','Race Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (60,'prace_4','Elves','Race Slot 4: Name','Race Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (61,'prace_5','Orcs','Race Slot 5: Name','Race Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (62,'prace_6','Dwarves','Race Slot 6: Name','Race Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (63,'game_email','admin@yourdomain.com','Game\'s Email','General Settings');
INSERT INTO settings (sID, sName, sValue, sDesc, sGroup) VALUES (64,'game_descr','Your game\'s descsription.','Game Description (for Front Page)','General Settings');

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  uID int(11) NOT NULL auto_increment,
  uEmail text NOT NULL,
  uLogin text NOT NULL,
  uPassword text NOT NULL,
  uFirstName text NOT NULL,
  uLastName text NOT NULL,
  uGender varchar(6) NOT NULL default '',
  uCode text NOT NULL,
  uRace smallint(2) NOT NULL default '1',
  uLevel int(11) NOT NULL default '1',
  uGold bigint(20) NOT NULL default '0',
  uBank bigint(20) NOT NULL default '0',
  uCitizens int(11) NOT NULL default '0',
  uOffensiveMen int(11) NOT NULL default '0',
  uDefensiveMen int(11) NOT NULL default '0',
  uMiners int(11) NOT NULL default '0',
  uType smallint(1) NOT NULL default '1',
  uTypeDays int(11) NOT NULL default '90',
  uRank smallint(1) NOT NULL default '1',
  uProfile text NOT NULL,
  uDeposits int(11) NOT NULL default '5',
  uDepositsMax int(11) NOT NULL default '5',
  uInterestRate smallint(2) NOT NULL default '1',
  uWeapon1 int(11) NOT NULL default '0',
  uWeapon2 int(11) NOT NULL default '0',
  uWeapon3 int(11) NOT NULL default '0',
  uWeapon4 int(11) NOT NULL default '0',
  uWeapon5 int(11) NOT NULL default '0',
  uArmour1 int(11) NOT NULL default '0',
  uArmour2 int(11) NOT NULL default '0',
  uArmour3 int(11) NOT NULL default '0',
  uArmour4 int(11) NOT NULL default '0',
  uArmour5 int(11) NOT NULL default '0',
  uMineLevel smallint(1) NOT NULL default '1',
  uEXP int(11) NOT NULL default '0',
  uNextLevel int(11) NOT NULL default '1000',
  uOffense int(11) NOT NULL default '0',
  uDefense int(11) NOT NULL default '0',
  uWon int(11) NOT NULL default '0',
  uLost int(11) NOT NULL default '0',
  uAttackTurns int(11) NOT NULL default '500',
  uAttackTurnsMax int(11) NOT NULL default '500',
  uRandomEvents int(11) NOT NULL default '5',
  uRandomEventsMax int(11) NOT NULL default '5',
  PRIMARY KEY  (uID)
) ENGINE=MyISAM;

--
-- Dumping data for table `users`
--

INSERT INTO users (uID, uEmail, uLogin, uPassword, uFirstName, uLastName, uGender, uCode, uRace, uLevel, uGold, uBank, uCitizens, uOffensiveMen, uDefensiveMen, uMiners, uType, uTypeDays, uRank, uProfile, uDeposits, uDepositsMax, uInterestRate, uWeapon1, uWeapon2, uWeapon3, uWeapon4, uWeapon5, uArmour1, uArmour2, uArmour3, uArmour4, uArmour5, uMineLevel, uEXP, uNextLevel, uOffense, uDefense, uWon, uLost, uAttackTurns, uAttackTurnsMax, uRandomEvents, uRandomEventsMax) VALUES (1,'admin@yourdomain.com','admin','123456','Site','Admin','Male','done',5,1,800000,553147,0,250,250,20,2,258,5,'',9,10,3,0,0,0,0,0,0,0,0,0,0,2,0,1000,7500,7500,0,23,740,750,2,5);


--
-- Table structure for table `users_online`
--

DROP TABLE IF EXISTS users_online;
CREATE TABLE users_online (
  uID int(11) NOT NULL default '0',
  uCode text NOT NULL,
  uTime int(11) NOT NULL default '0',
  uIPAddress text NOT NULL
) ENGINE=MyISAM;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` VALUES (1, 'l-in859adm265234', 1147698869, '127.0.0.1');