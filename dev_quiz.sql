-- MariaDB dump 10.19  Distrib 10.5.10-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dev_quiz
-- ------------------------------------------------------
-- Server version	10.5.10-MariaDB-1:10.5.10+maria~focal-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questions_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DADD4A25BCB134CE` (`questions_id`),
  CONSTRAINT `FK_DADD4A25BCB134CE` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=788 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` VALUES (691,80,'Parce que c\'est une bonne pratique',0),(692,80,'Pour toucher un public plus large et permettre à tout le monde d\'utiliser le site',1),(693,81,'C\'est de rendre le site accessible ',0),(694,81,'L’ensemble des techniques et bonnes pratiques ayant pour objectif de rendre un site internet accessible à tous',1),(695,82,'Les handicaps physiques ',0),(696,82,'Les handicaps mentaux',0),(697,82,'Les handicaps physiques, mentaux, cognitifs, ainsi que les personnes souffrants de troubles \'Dys\'',1),(698,83,'ben j\'en sais rien moi, je suis pas UX designer mais développeur',0),(699,83,'Pour faire de beaux contenus',0),(700,83,'L\'UX design prend en compte tous ces handicaps et troubles afin d\'avoir un design adapté',1),(701,84,'Euh l\'UI design ? ',0),(702,84,'Je ne sais pas',0),(703,84,'SEO',1),(704,85,'changer le nom de domaine',0),(705,85,'changer les les liens',1),(706,85,'utiliser le certificat SSL',1),(707,85,'configurer le serveur',1),(708,86,'ce n\'est pas une bonne pratique mais une obligation',0),(709,86,'protège la confidentialité des utilisateurs',1),(710,86,'protège le site contre les intrusions',1),(711,86,'bénéficie d\'un meilleur référencement \"SEO\"',1),(712,87,'vrai',0),(713,87,'faux',1),(714,88,'1 an',1),(715,88,'2 ans',0),(716,88,'13 mois',0),(717,89,'le TSL est un protocole alors que le SSL est un certificat',0),(718,89,'y en a pas, ce sont tous les deux des protocoles',1),(719,90,'FTP',0),(720,90,'TCP',1),(721,90,'SMTP',0),(722,91,'HTTP + SSH',0),(723,91,'HTTP + SSL',1),(724,91,'HTTP + FTPS + SSL',0),(725,92,'vrai',1),(726,92,'faux',0),(727,93,'se connecter aux sites web de façon sécurisé',0),(728,93,'se connecter à distance à un ordinateur pour ouvrir un shell',1),(729,94,'un outil de modélisation de BDD',0),(730,94,'un outil de methode agile/scrum',0),(731,94,'norme de communication de tous les systèmes informatiques',1),(732,95,'vrai',0),(733,95,'faux',1),(734,96,'envoyer des objets par une route',0),(735,96,'construire des routes',0),(736,96,'acheminer des données dans un réseau',1),(737,97,'administre et réparti les fonctions d’impression',0),(738,97,'délivre des adresses ip aux périphériques sur le réseau',1),(739,97,'conversion de noms de domaines en adresses IP',0),(740,98,'télécharger illégalement des médias',0),(741,98,'partage de fichiers',1),(742,99,'une norme de sécurité',0),(743,99,'une norme de transfert de données',1),(744,100,'npm install -g @angular/cli',1),(745,100,'npm @angular/cli install',0),(746,100,'npm @angular/cli -g install',0),(747,101,'ng serve mon-projet --open',0),(748,101,'ng cat mon-projet',0),(749,101,'ng new mon-projet',1),(750,102,'liquid',0),(751,102,'haml',0),(752,102,'twig',1),(753,103,'composer create-project symfony/website-skeleton my_project_name',1),(754,103,'composer create-project symfony/skeleton my_project_name',0),(755,104,'vrai',1),(756,104,'faux',0),(757,105,'less',0),(758,105,'cat',1),(759,105,'more',0),(760,107,'vrai',0),(761,107,'faux',1),(762,108,'systemctl start mysql',0),(763,108,'mysql',1),(764,109,'truncate  table `table`',0),(765,109,'drop  table `table`',1),(766,109,'delete from `table`',0),(767,110,'show tables',0),(768,110,'show create `table`',0),(769,110,'show create table `table`',1),(770,111,'grant all privileges on DATABASE_NAME TO \'USER_NAME\'@\'localhost\' identified by \'PASSWORD\';',0),(771,111,'grant all privileges on DATABASE_NAME.* TO \'USER_NAME\'@\'localhost\' identified by \'PASSWORD\';',1),(772,112,'insert values into `table` (\'valeur 1\', \'valeur 2\', ...);',0),(773,112,'insert into `tale` values (\'valeur 1\', \'valeur 2\', ...);',1),(774,112,'insert values (\'valeur 1\', \'valeur 2\', ...) into `table`;',0),(775,113,'truncate  table `table`',1),(776,113,'drop table `table`',0),(777,113,'delete from `table`',0),(778,114,'le langage de script a besoin d\'être compilé',0),(779,114,'y a pas de différence, c\'est la même chose',1),(780,115,'faux',0),(781,115,'vrai',1),(782,116,'vrai',0),(783,116,'faux',1),(784,117,'modifiables',0),(785,117,'immuables',1),(786,118,'vrai',1),(787,118,'faux',0);
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icone` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64C19C1A76ED395` (`user_id`),
  CONSTRAINT `FK_64C19C1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Accessibilité','accessibilité-48.png','L\'accessibilité web nécessite de mettre à la disposition des personnes handicapées des moyens techniques adaptés. Les technologies d\'assistance leur permettent d\'utiliser leur ordinateur et d\'accéder plus facilement aux différents contenus.',50),(2,'Sécurité','bouclier-48.png','La sécurité des sites web est l\'acte de protéger les sites web contre l\'accès, l\'utilisation, la modification, la destruction ou la perturbation non autorisée.',50),(3,'Protocole','protocol-48.png','Le World Wide Web est un système mettant en relation différents documents reliés les uns aux autres par des hyperliens. L’échange de données sur le Web est possible grâce au protocole HTTP, HyperText Transfer Protocol.',50),(4,'Internet','internet-48.png','Internet est le plus grand réseau informatique mondial. Il regroupe en fait un grand nombre de réseaux reliant entre eux des millions d\'ordinateurs à travers le monde.',50),(5,'Langage web','code-48.png','Il n’existe que quelques langages par défaut que tous les navigateur Web sont capable d’interpréter. Mais il existe des langages de programmation qui permettent de rendre un site web dynamique.',50),(6,'Frameworks','frameworks-48.png','L’objectif d’un framework est généralement de simplifier le travail des développeurs informatiques, en leur offrant une architecture “prête à l’emploi” et qui leur permette de ne pas repartir de zéro à chaque nouveau projet.',50),(7,'Terminal','terminal-48.png','Le shell ou terminal ou console (interface système) est un programme qui reçoit des commandes informatiques données par un utilisateur pour les envoyer au système d’exploitation qui se chargera de les exécuter.',50),(8,'Base de données','bdd-48.png','Une base de données permet d\'enregistrer des données de façon organisée et hiérarchisée.',50);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20210610160758','2021-06-23 08:49:57',916),('DoctrineMigrations\\Version20210615085656','2021-06-23 08:49:58',708),('DoctrineMigrations\\Version20210615131723','2021-06-23 08:49:59',20),('DoctrineMigrations\\Version20210615133039','2021-06-23 08:49:59',18),('DoctrineMigrations\\Version20210617092053','2021-06-23 08:49:59',20),('DoctrineMigrations\\Version20210617093024','2021-06-23 08:49:59',11),('DoctrineMigrations\\Version20210617115944','2021-06-23 08:49:59',139),('DoctrineMigrations\\Version20210623110935','2021-06-23 13:09:46',23),('DoctrineMigrations\\Version20210623111145','2021-06-23 13:11:50',22),('DoctrineMigrations\\Version20210630220108','2021-07-01 00:01:19',120),('DoctrineMigrations\\Version20210630220302','2021-07-01 00:03:08',430),('DoctrineMigrations\\Version20210701012032','2021-07-01 03:20:42',114),('DoctrineMigrations\\Version20210705090415','2021-07-05 11:04:23',755),('DoctrineMigrations\\Version20210715090345','2021-07-15 11:03:59',154),('DoctrineMigrations\\Version20210715141336','2021-07-15 16:13:47',16),('DoctrineMigrations\\Version20210722121315','2021-07-22 14:13:22',40),('DoctrineMigrations\\Version20210722122430','2021-07-22 14:24:40',25),('DoctrineMigrations\\Version20210722130310','2021-07-22 15:03:18',21),('DoctrineMigrations\\Version20210722134720','2021-07-22 15:47:23',163),('DoctrineMigrations\\Version20210727111903','2021-07-27 13:19:13',252);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `play`
--

DROP TABLE IF EXISTS `play`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `play` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E89DEBA853CD175` (`quiz_id`),
  KEY `IDX_5E89DEBAA76ED395` (`user_id`),
  CONSTRAINT `FK_5E89DEBA853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5E89DEBAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `play`
--

LOCK TABLES `play` WRITE;
/*!40000 ALTER TABLE `play` DISABLE KEYS */;
INSERT INTO `play` VALUES (14,184,50,1),(18,187,55,5),(22,186,55,1),(23,185,55,2);
/*!40000 ALTER TABLE `play` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `infoplus` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8ADC54D5853CD175` (`quiz_id`),
  CONSTRAINT `FK_8ADC54D5853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (80,'Pourquoi améliorer l\'accessibilité du site web est-elle importante ?',184,'En France, plus de 20% de la population est \n                            touchée par un handicap permanent. Il est du devoir des webdesigners, développeurs et plus \n                            largement des concepteurs de s\'assurer que le plus de personnes soit en mesure d\'accéder aux services, quel que soit le contexte d\'utilisation, \n                            afin de proposer la meilleure expérience utilisateur possible.'),(81,'Que désigne l\'accessibilité web ?',184,'Un site internet designé, développé et rédigé avec l’accessibilité web en tête offre à tous un accès égal au site, à l’offre et au contenu qu’il propose.Rendre son site facile d\'accès permet de montrer à tous les internautes \n                        que vous veillez à garantir un accès égal pour tout le monde sans discriminations et d\'élargir l\'audience du site. '),(82,'Quels sont les handicaps à prendre en compte ?',184,'Les troubles \'Dys\' recouvrent un panel de fonctions cognitives : du langage écrit au langage oral en passant par la concentration et la mémoire ainsi que les capacités motrices. Les handicaps physiques peuvent être visuel,\n                        auditif, moteur (c\'est à dire à se déplacer ou à mouvoir une partie du corps.'),(83,'En quoi l\'UX design joue un rôle majeur dans l\'accessibilité web ? ',184,'L’objectif de l’UX Design est de concevoir, ou d’offrir, une expérience utilisateur optimale : la meilleure expérience possible. Dans la conception, le choix de la disposition des visuels, les contrastes, choix iconographiques \n                            ou des couleurs, sont autant d\'éléments qui peuvent faciliter ou empêcher la lecture et la compréhension'),(84,'Alliée à l\'UX design, elle aide à avoir un contenu clair et hiérarchisé, de qui s\'agit-il ?',184,'L\'UI designer s\'occupe plus particulièrement de faire en sorte que le design de l\'interface utilisateur corresponde aux attentes de son commanditaire et réponde aux besoins des utilisateurs. Alors que l\'UX designer sera plutôt sur l\'architecture et l\'ergonomie du site. Le \'SEO\' (Search Engine Optimisation) ou le référencement naturel défini l\'ensemble des techniques mises en oeuvre pour améliorer la position d\'un site web sur les pages de résultats des moteurs de recherches. Ce qui facilite aussi la navigation des internautes malvoyants ou aveugles qui surfent grâce à des lecteurs d\'écrans. \n'),(85,'Que doit-on faire pour passer un site en HTTPS ?',185,' Effectivement pour passer un site web en http, en https il faut acquérir un certificat ssl, l\'installer, configurer le serveur, mettre en place les bonnes redirections, afin d’éviter les duplicatas de contenus et vérifier les liens internes et externes : même si des redirections 301, ou .htaccess, permettent de cacher des liens défectueux, il convient de changer tous les liens internes après le passage au protocole HTTPS. Pour plus de détails, vous pouvez consulter ce lien : https://www.ionos.fr/digitalguide/sites-internet/creation-de-sites-internet/comment-passer-un-site-web-en-ssl-et-https/ \n'),(86,'Pourquoi le HTTPS est une bonne pratique ?',185,'Le certificat SSL permet d’instaurer la confiance en authentifiant un site, en chiffrant l’ensemble des informations (personnelles, bancaires, etc.) entre ce site et la personne qui s’y connecte. Il garantit ainsi la confidentialité des échanges. Les visiteurs peuvent ainsi laisser en toute sécurité et confiance leur numéro de carte bancaire ainsi que des informations personnelles. Ce certificat SSL permet en outre de sécuriser les transactions en ligne ; les informations données par le client ne peuvent pas être interceptées, détournées ou déchiffrées par une autre personne. Plus de détails sur https://www.certeurope.fr/blog/tout-savoir-sur-les-certificats-ssl/\n'),(87,'Tous les certificats SSL sont payants',185,'À une époque où le nombre de tentatives de piratage et d’activités frauduleuses augmente chaque jour, les propriétaires de sites Web et les utilisateurs en ligne sont de plus en plus préoccupés par leur sécurité. En conséquence, l’installation d’un certificat SSL est devenue une condition préalable à tout site Web. Il existe deux types de certificat SSL. Le premier est \"Free SSL Certificate\", qui, comme son nom l’indique, est disponible gratuitement. L’autre qui est payé est simplement appelé «certificat SSL». Plus de détails sur https://02system.com/quelle-est-la-difference-entre-un-certificat-ssl-libre-et-un-certificat-ssl-paye/\n'),(88,'Quelle est la durée de validité d\'un certificat SSL ?',185,'Suite à une décision des principaux navigateurs, et ce dans un souci d’accroître la sécurité du web, la validité maximale des certificats SSL sera réduite à 12 mois à compter du 1er septembre 2020. Les certificats fait avant cette date qui ont une durée plus longue, ne sont pas impactés par cette loi : https://news.gandi.net/fr/2020/08/la-validite-des-certificats-ssl-est-officiellement-limitee-a-1-an/\n'),(89,'Quelle est la différence entre le TSL et le SSL ?',185,'SSL (« Secure Socket Layer ») ou TLS (« Transport Layer Security ») : sont deux versions de protocoles destinés à sécuriser les données et surtout les échanges sur Internet grâce à des systèmes de chiffrement et des vérifications avancées gérées à partir de clés publiques et privées. Plus de détails sur https://www.source-de-creation.fr/http-vers-https-etapes-et-check-list/\n'),(90,'Quel protocole est utilisé pour découper les données à transmettre en un ensemble de paquets ?',186,'La plupart des informations que l’on souhaite faire circuler sur Internet (courriers électroniques, pages Web) dépassent largement les tailles maximales autorisées par les paquets IP. Elles doivent donc être découpées en plusieurs paquets de taille appropriée par l’ordinateur expéditeur et reconstituées par l’ordinateur destinataire. Pour rendre cela possible, le protocole TCP découpe les données à transmettre en un ensemble de paquets IP. Plus de détails sur https://lewebpedagogique.com/presencesenligne/2015/01/16/les-protocoles-dinternet-et-du-web/\n'),(91,'Avec quels protocoles on obtient un site en https ?',186,'En utilisant le protocol http et en utilisant le protocol SSL/TLS on obtient un site en HTTPS qui permet de consulter un site web de manière sécurisé (HTTPS = Hypertext Transfer Protocol Secure).\n'),(92,'Le protocole FTPS est une extension de FTPS (file transfert protocol) utilisant SSL',186,'Effectivement il s\'agit d\'une extension de FTP qui utilise le protocole SSL. Le SSL permet la sécurisation des échanges par réseau informatique : https://fr.wikipedia.org/wiki/Transport_Layer_Security\n'),(93,'Quelle est l\'utilisation du protocole ssh ?',186,'Habituellement le protocole SSH utilise le port TCP 22. Il est particulièrement utilisé pour ouvrir un shell sur un ordinateur distant. Peu utilisé sur les stations Windows (quoiqu\'on puisse l\'utiliser avec PuTTY, mRemote, cygwin ou encore OpenSSH), SSH fait référence pour l\'accès distant sur les stations Linux et Unix. (ssh = Secure Shell) : https://fr.wikipedia.org/wiki/Secure_Shell\n'),(94,'Qu\'est ce que le modèle OSI ?',186,'Le modèle OSI (Open Systems Interconnection) a été créé par le ISO pour aider à normaliser la communication entre les systèmes informatiques. Il divise les communications en sept couches différentes, chacune comprenant plusieurs normes matérielles, protocoles, ou d’autres types de services. Plus de détails sur ces liens : https://www.reseaux-telecoms.net/actualites/lire-les-7-couches-du-modele-osi-28083.html et https://techlib.fr/definition/osi_model.html\n'),(95,'Internet et le web sont deux mots qui désignent la même chose',187,'Internet est un réseau informatique (interconnexion de réseau) que le Web utilise (selon le protocole HTTP) mais d’autres applications l’utilisent aussi, par exemple le courrier électronique (protocole SMTP) et le transfert de fichiers (protocole FTP) : https://www.lumni.fr/article/ne-pas-confondre-le-web-et-internet\n'),(96,'C\'est quoi le routage ?',187,'Lorsqu\'un routeur reçoit un paquet, il lit les en-têtes du paquet pour voir la destination prévue, il détermine ensuite où acheminer le paquet en fonction des informations contenues dans ses tables de routage : https://www.cloudflare.com/fr-fr/learning/network-layer/what-is-routing/\n'),(97,'Quel est le rôle du serveur DHCP ?',187,'Un serveur DHCP (ou service DHCP) est un serveur (ou service) qui délivre des adresses IP aux équipements qui se connectent sur le réseau : https://culture-informatique.net/cest-quoi-un-serveur-dhcp-niv1/\n'),(98,'Le réseau peer to peer est utilisé pour :',187,'Le pair-à-pair, peer-to-peer ou P2P (les trois termes désignent la même chose), définit un modèle de réseau informatique d\'égal à égal entre ordinateurs, qui distribuent et reçoivent des données ou des fichiers. L\'une de ses utilisation est la partage de fichier. Plus de détails ici https://www.journaldunet.fr/web-tech/dictionnaire-du-webmastering/1203399-p2p-peer-to-peer-definition-traduction-et-acteurs/ et https://interstices.info/les-reseaux-de-pair-a-pair/\n'),(99,'Le TCP/IP c\'est quoi ?',187,'TCP veut dire Transmission Control Protocole (Langage qui va contrôler le transport des données). TCP/IP c’est la norme qui va servir de support pour transporter les données d’un ordinateur à un autre, en s’appuyant sur les adresses IP des ordinateurs : https://culture-informatique.net/c-est-quoi-une-adresse-ip-niv1/\n'),(100,'Pour utiliser le CLI d\'angular il faut utiliser la commande :',188,'Pour installer le CLI d’Angular il faut utiliser la commande suivante : \"npm install -g @angular/cli\" , à partir de là, la commande  \"ng\"  est disponible depuis la ligne de commande depuis n’importe quel dossier de l’ordinateur : https://openclassrooms.com/fr/courses/4668271-developpez-des-applications-web-avec-angular/5086918-installez-les-outils-et-creez-votre-projet\n'),(101,'Avec Angular pour créer un nouveau projet, j\'utilise la commande :',188,'Pour créer un nouveau projet, il faut utiliser la commande \"ng new mon-projet\" : https://openclassrooms.com/fr/courses/4668271-developpez-des-applications-web-avec-angular/5086918-installez-les-outils-et-creez-votre-projet\n'),(102,'Quel moteur de template est utilisé pour symfony ?',188,'Twig est un moteur de templates pour le langage de programmation PHP, utilisé par défaut par le framework Symfony. : https://symfony.com/doc/current/templates.html#twig-templating-language\n'),(103,'Pour créer une nouvelle application web avec symfony j\'utilise la commande :',188,'La commande \"composer create-project symfony/skeleton my_project_name\" est à utiliser pour créer des microservices, des api ou des applications console mais pas pour une application web : https://symfony.com/doc/current/setup.html\n'),(104,'Avec symfony il est possible d\'utiliser \"maker\" pour créer rapidement des controlleurs, entités..',188,'Le MakerBundle de Symfony permet effectivement de créer des commandes, des controlleurs, des formulaires et bien plus : https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html\n'),(105,'Quelle commande permet de lire le contenu d\'un fichier ?',189,'La commande \"cat\" affiche le contenu d\'un fichier : https://doc.ubuntu-fr.org/tutoriel/console_commandes_de_base#cat\n'),(106,'Laquelle de ces commandes est utilisé pour changer les droits d\'accès aux fichiers ?',189,'La commande \"chmod\" modifie les permissions d\'accès à un fichier ou à un répertoire : https://doc.ubuntu-fr.org/tutoriel/console_commandes_de_base#cat\n'),(107,'Pour créer une nouvelle branche avec git j\'utilise la commande : git checkout',189,'On utilise la commande \"git checkout -b\" pour créer une nouvelle branche et on swtitch aussi tôt sur cette dernière : https://git-scm.com/book/fr/v2/Les-branches-avec-Git-Branches-et-fusions%C2%A0%3A-les-bases\n'),(108,'Avec quelle commande je lance mysql ?',189,'La première commande lance le serveur Mysql. Pour la seconde commande, elle est utilisable à partir de la version Ubuntu 18.04 Bionic, l\'utilisateur root de MySQL est authentifié par son compte système (plugin auth_socket) et non plus par un mot de passe (plugin mysql_native_password) : https://doc.ubuntu-fr.org/mysql\n'),(109,'Quelle est la commande pour supprimer une table ?',190,'Pour supprimer une table “nom_table” il suffit simplement d’utiliser la syntaxe suivante : \'drop table `table`\', il faut faire attention quand on l\'utilise car une fois supprimée, les données sont perdues : https://sql.sh/cours/drop-table\n'),(110,'Pour savoir comment une table est créer j\'utilise quelle commande ?',190,'La dernière réponse est la bonne réponse : https://sql.sh/cours/drop-table\n'),(111,'Laquelle de ces commandes a la bonne syntaxe pour ajouter des privilèges à un utilisateur ?',190,'La dernière réponse a la bonne syntaxe : https://dev.mysql.com/doc/refman/8.0/en/grant.html\n'),(112,'Laquelle de ces commandes a la bonne syntaxe pour insérer une nouvelle ligne ?',190,'La bonne syntaxe est la suivante : \'insert into table values(\'valeur 1\', \'valeur 2\', ...)\' : https://sql.sh/cours/insert-into\n'),(113,'Avec quelle commande je vide une table :',190,'En SQL, la commande TRUNCATE permet de supprimer toutes les données d’une table sans supprimer la table en elle-même : https://sql.sh/cours/truncate-table\n'),(114,'Quelle différence entre le langage de script et le langage interprété ?',192,'En informatique, un interprète est un outil ayant pour tâche d\'analyser, de traduire et d\'exécuter un programme écrit dans un langage informatique. De tels langages sont dits langages interprétés. L\'interprète est capable de lire le code source d\'un langage sous forme de script, habituellement un fichier texte, et d\'en exécuter les instructions après une analyse syntaxique du contenu : https://www.techno-science.net/definition/5322.html\n'),(115,'PHP et python sont des langages de script',192,'PHP est un langage de script, spécialement conçu pour le développement d\'applications web. Il peut être intégré facilement au HTML. C\'est ce que l\'on appelle un langage de programmation interprété, ce qui signifie que votre machine lit le code et l’interprète au fur et à mesure de la lecture du fichier. Plus de détails ici https://www.techno-science.net/glossaire-definition/PHP-page-2.html et ici https://www.subteno.com/blog/langages-de-programmation-2/de-php-a-python-1\n'),(116,'Les tableaux s\'appelent-ils des tableaux en python ?',192,'Les concepteurs de python ont choisi de ne pas appeler les tableaux, des tableaux dans leur langage mais plutôt des \"lists\" et des \"tuples\" qui sont dans python des structures de données. D\'ailleurs dans la documentation de python on parle de \"structure de données\" et non pas de tableaux. Ici https://pixees.fr/informatiquelycee/n_site/nsi_prem_pythonSequence.html et ici https://docs.python.org/fr/3.6/tutorial/datastructures.html\n'),(117,'Les tuples en python sont :',192,'Il n\'est pas possible de modifier un tuple après sa création (on parle d\'objets \"immuables\"), si vous essayez de modifier un tuple existant, l\'interpréteur Python vous renverra une erreur. Les tableaux sont, comme les tuples, des séquences, mais à la différence des tuples, ils sont modifiables (on parle d\'objets \"muables\"). Ici https://pixees.fr/informatiquelycee/n_site/nsi_prem_pythonSequence.html et ici https://docs.python.org/fr/3/tutorial/datastructures.html#\n'),(118,'Sous java, il est nécessaire de préciser le type de donnée lors de la déclaration de variable ?',192,'Une variable possède un nom, un type et une valeur. La déclaration d\'une variable doit donc contenir deux choses : un nom et le type de données qu\'elle peut contenir. Une variable est utilisable dans le bloc où elle est définie : https://jmdoudoux.developpez.com/cours/developpons/java\n');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A412FA92A76ED395` (`user_id`),
  KEY `IDX_A412FA9212469DE2` (`category_id`),
  CONSTRAINT `FK_A412FA9212469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_A412FA92A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz`
--

LOCK TABLES `quiz` WRITE;
/*!40000 ALTER TABLE `quiz` DISABLE KEYS */;
INSERT INTO `quiz` VALUES (184,50,'L\'accessibilité',1),(185,50,'Sécurité avec https',2),(186,50,'Types de protocoles',3),(187,50,'Fonctionnement global d\'internet',4),(188,50,'Frameworks côté client et côté back',6),(189,50,'Lignes de commande',7),(190,50,'Base de données : commandes les plus utilisées',8),(192,50,'Quelques langages de programmation pour le web',5);
/*!40000 ALTER TABLE `quiz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`),
  CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_password_request`
--

LOCK TABLES `reset_password_request` WRITE;
/*!40000 ALTER TABLE `reset_password_request` DISABLE KEYS */;
INSERT INTO `reset_password_request` VALUES (1,55,'mMHgB5WxAGLjECrvAWfl','54aTvQmSB1Igmlav+3AmZtiqyHkiQPKmkH9zQ5bWjg0=','2021-07-15 11:09:38','2021-07-15 12:09:38'),(2,55,'Xe6HmphHivv1yfXXbAlz','mWarQKxz8K1J42t2bc4rXj8SzGXQCeXULdpDn6UQj8c=','2021-07-15 12:13:56','2021-07-15 13:13:56'),(3,55,'5m3aGcRP6aGlS1VhGy1e','30rl7emS+RQI8g5JWeKIzMI4QP8+sQVJpeVmTDz8gfE=','2021-07-15 13:24:49','2021-07-15 14:24:49'),(4,55,'1fs5xirx7tWacB9cagca','6NjeiGUibozBmRCH+/UsEYHASipKGVlbkkYLPj+FXgc=','2021-07-15 14:54:27','2021-07-15 15:09:27'),(5,55,'kEwN32SJhFEmDVnCrtyT','vawdz+AG9QyyCDJHvKJDJqu5RneX1hnoJiGRhPTW28M=','2021-07-15 15:13:50','2021-07-15 15:28:50'),(6,55,'pq7W1EAAqv1C6zdXq3LZ','7R/kf4R+NnTJNQNAlE1EAnfj5XWJyeTQb8SC0DvsScI=','2021-07-15 15:29:59','2021-07-15 15:44:59'),(7,55,'gPGHAPnfF9EXiCKBP3Ri','bBctR+H/RbbTIkoTPWPFCdYr1wkBLAWF6tTiCEcrIeI=','2021-07-15 15:52:48','2021-07-15 15:59:28');
/*!40000 ALTER TABLE `reset_password_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (50,'mathildenatsuki@gmail.com','[\"ROLE_USER\"]','$argon2i$v=19$m=65536,t=4,p=1$cThRVG80a0JvVkJrOEFrcw$SI75Kktw20PEmFUxvXtqgm874YUGpC5LvVDvfC+DQbA','60dd913d3a397.jpg','alucard'),(55,'mathilde.chaneto@gmail.com','[\"ROLE_USER\"]','$argon2i$v=19$m=65536,t=4,p=1$SVU4LlAuUzBOckVFVFouOA$Fx9dsd+K/N+tRc6aEO/1UXPnjyOlncTNWZ3OTSn8X6s','icons8-utilisateur-48.png','nyx');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-06 16:47:41
