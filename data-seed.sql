-- MySQL dump 10.13  Distrib 5.7.44, for Linux (x86_64)
--
-- Host: localhost    Database: jarvis
-- ------------------------------------------------------
-- Server version	5.7.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `aliment`
--

LOCK TABLES `aliment` WRITE;
/*!40000 ALTER TABLE `aliment` DISABLE KEYS */;
INSERT INTO `aliment` VALUES (1541,83,64,23,'Aubergine','Aubergine (unité)'),(1542,83,64,23,'Courgette','Courgette (unité)'),(1543,83,64,23,'Tomate','Tomate (unité)'),(1544,83,64,23,'Poivron vert','Poivron vert (unité)'),(1545,83,64,23,'Poivron rouge','Poivron rouge (unité)'),(1546,83,64,23,'Poivron jaune','Poivron jaune (unité)'),(1547,83,64,23,'Ail (gousses)','Ail (gousses) (unité)'),(1548,83,64,22,'Avocat','Avocat (unité)'),(1549,83,64,22,'Citron vert','Citron vert (unité)'),(1550,83,64,22,'Citron jaune','Citron jaune (unité)'),(1551,83,64,23,'Oignon','Oignon (unité)'),(1552,83,64,23,'Oignon rouge','Oignon rouge (unité)'),(1553,83,64,23,'Concombre','Concombre (unité)'),(1554,83,65,24,'Tomate cerise','Tomate cerise (g)'),(1555,83,64,23,'Carotte','Carotte (unité)'),(1556,83,64,23,'Poireau','Poireau (unité)'),(1557,83,64,23,'Patate douce','Patate douce (unité)'),(1558,83,64,23,'Pomme de terre','Pomme de terre (unité)'),(1559,83,64,23,'Navet','Navet (unité)'),(1560,83,64,23,'Panais','Panais (unité)'),(1561,83,64,23,'Butternut','Butternut (unité)'),(1562,83,64,23,'Potimarron','Potimarron (unité)'),(1563,83,64,23,'Potiron','Potiron (unité)'),(1564,83,64,23,'Broccoli','Broccoli (unité)'),(1565,84,65,22,'Broccolis surgelés','Broccolis surgelés (g)'),(1566,84,65,22,'Haricots verts surgelés','Haricots verts surgelés (g)'),(1567,84,65,22,'Petits pois surgelés','Petits pois surgelés (g)'),(1568,83,64,23,'Échalote','Échalote (unité)'),(1569,83,64,22,'Betterave','Betterave (unité)'),(1570,83,65,24,'Champignon frais','Champignon frais (g)'),(1571,83,65,24,'Cèpe','Cèpe (g)'),(1572,83,65,24,'Asperge blanche fraîche','Asperge blanche fraîche (g)'),(1573,83,65,22,'Asperge blanche','Asperge blanche (g)'),(1574,83,65,22,'Asperge verte','Asperge verte (g)'),(1575,83,64,23,'Chou fleur','Chou fleur (unité)'),(1576,83,64,23,'Chou vert','Chou vert (unité)'),(1577,83,64,23,'Chou','Chou (unité)'),(1578,83,64,23,'Chou chinois','Chou chinois (unité)'),(1579,83,72,24,'Gingembre','Gingembre (cm)'),(1580,83,65,22,'Tomates séchées','Tomates séchées (g)'),(1581,84,65,22,'Champignons surgelés','Champignons surgelés (g)'),(1582,83,64,24,'Salade','Salade (unité)'),(1583,83,64,22,'Mâche (sachet)','Mâche (sachet) (unité)'),(1584,83,64,22,'Roquette (sachet)','Roquette (sachet) (unité)'),(1585,83,64,24,'Feuilles de Basilic','Feuilles de Basilic (unité)'),(1586,83,65,24,'Graines de courge','Graines de courge (g)'),(1587,83,65,22,'Pistaches','Pistaches (g)'),(1588,83,64,22,'Ciboulette thaï (bouquet)','Ciboulette thaï (bouquet) (unité)'),(1589,88,65,22,'Chocolat','Chocolat (g)'),(1590,88,65,22,'Beurre doux','Beurre doux (g)'),(1591,88,65,22,'Beurre demi-sel','Beurre demi-sel (g)'),(1592,88,67,22,'Sucre vanillé','Sucre vanillé (cc)'),(1593,88,67,22,'Vanille liquide','Vanille liquide (cc)'),(1594,82,70,22,'Crème semi-épaisse','Crème semi-épaisse (cl)'),(1595,82,70,22,'Crème liquide','Crème liquide (cl)'),(1596,82,70,22,'Crème soja','Crème soja (cl)'),(1597,82,65,22,'Crème fraîche','Crème fraîche (g)'),(1598,83,65,22,'Lentilles vertes','Lentilles vertes (g)'),(1599,83,65,22,'Lentilles corail','Lentilles corail (g)'),(1600,83,65,22,'Châtaignes','Châtaignes (g)'),(1601,79,65,22,'Persil','Persil (g)'),(1602,79,65,22,'Basilic','Basilic (g)'),(1603,79,65,22,'Coriandre fraîche','Coriandre fraîche (g)'),(1604,79,65,22,'Ciboulette','Ciboulette (g)'),(1605,79,64,22,'Menthe (feuilles)','Menthe (feuilles) (unité)'),(1606,88,65,22,'Farine de sarrasin','Farine de sarrasin (g)'),(1607,83,65,24,'Tofu fumé amande et sésame','Tofu fumé amande et sésame (g)'),(1608,83,65,24,'Tofu ail des ours','Tofu ail des ours (g)'),(1609,83,65,24,'Hâché végé','Hâché végé (g)'),(1610,83,64,22,'Steak végé','Steak végé (unité)'),(1611,83,65,22,'Maïs','Maïs (g)'),(1612,82,65,22,'Fromage râpé','Fromage râpé (g)'),(1613,82,65,22,'Fromage à raclette','Fromage à raclette (g)'),(1614,82,64,22,'Chèvre (tranches)','Chèvre (tranches) (unité)'),(1615,82,64,22,'Cheddar (tranches)','Cheddar (tranches) (unité)'),(1616,82,65,22,'Cheddar râpé','Cheddar râpé (g)'),(1617,87,65,22,'Croûtons','Croûtons (g)'),(1618,87,65,22,'Pâtes Penne','Pâtes Penne (g)'),(1619,87,65,22,'Pâtes Farfalle','Pâtes Farfalle (g)'),(1620,87,65,22,'Pâtes Coudes rayés','Pâtes Coudes rayés (g)'),(1621,87,65,22,'Pâtes Macaroni','Pâtes Macaroni (g)'),(1622,87,65,22,'Pâtes Coquillettes','Pâtes Coquillettes (g)'),(1623,87,65,22,'Pâtes Spaghetti','Pâtes Spaghetti (g)'),(1624,87,65,22,'Pâtes Tagliatelles','Pâtes Tagliatelles (g)'),(1625,87,64,22,'Pâtes à Lasagne','Pâtes à Lasagne (unité)'),(1626,87,65,22,'Vermicelles de riz','Vermicelles de riz (g)'),(1627,87,65,22,'Haricots rouges','Haricots rouges (g)'),(1628,87,65,22,'Haricots blancs','Haricots blancs (g)'),(1629,79,68,22,'Tahin','Tahin (cs)'),(1630,80,69,22,'Jus de citron jaune','Jus de citron jaune (ml)'),(1631,80,69,22,'Jus de citron vert','Jus de citron vert (ml)'),(1632,79,70,24,'Huile d\'olive','Huile d\'olive (cl)'),(1633,79,70,24,'Huile de sésame','Huile de sésame (cl)'),(1634,79,70,24,'Huile de lin','Huile de lin (cl)'),(1635,79,70,22,'Huile de tournesol','Huile de tournesol (cl)'),(1636,79,70,22,'Vinaigre balsamique','Vinaigre balsamique (cl)'),(1637,79,70,24,'Vinaigre de cidre','Vinaigre de cidre (cl)'),(1638,79,70,24,'Vinaigre de riz','Vinaigre de riz (cl)'),(1639,87,65,22,'Riz basmati','Riz basmati (g)'),(1640,87,65,22,'Riz complet','Riz complet (g)'),(1641,87,65,22,'Riz rond à risotto','Riz rond à risotto (g)'),(1642,87,65,22,'Riz rond à sushi','Riz rond à sushi (g)'),(1643,87,65,22,'Pois chiches','Pois chiches (g)'),(1644,87,65,22,'Quinoa','Quinoa (g)'),(1645,87,65,22,'Épeautre','Épeautre (g)'),(1646,87,65,22,'Boulgour','Boulgour (g)'),(1647,87,65,22,'Blé','Blé (g)'),(1648,87,65,22,'Nouilles chinoises','Nouilles chinoises (g)'),(1649,87,65,22,'Semoule','Semoule (g)'),(1650,87,65,22,'Polenta','Polenta (g)'),(1651,87,64,22,'Feuilles de riz','Feuilles de riz (unité)'),(1652,87,64,22,'Fajitas','Fajitas (unité)'),(1653,87,64,22,'Pâte à gyoza','Pâte à gyoza (unité)'),(1654,79,65,22,'Graines de sésame','Graines de sésame (g)'),(1655,79,65,22,'Tomates concassées','Tomates concassées (g)'),(1656,79,65,22,'Tomates en dés','Tomates en dés (g)'),(1657,79,64,22,'Concentré de tomates (boîte)','Concentré de tomates (boîte) (unité)'),(1658,79,70,22,'Tomacouli nature','Tomacouli nature (cl)'),(1659,79,70,22,'Tomacouli basilic','Tomacouli basilic (cl)'),(1660,82,64,22,'Mozzarella (boule)','Mozzarella (boule) (unité)'),(1661,82,65,22,'Chèvre frais','Chèvre frais (g)'),(1662,82,64,22,'Bûche de chèvre','Bûche de chèvre (unité)'),(1663,82,65,22,'Chavroux','Chavroux (g)'),(1664,88,65,22,'Maïzena','Maïzena (g)'),(1665,88,64,22,'Bouchon de rhum','Bouchon de rhum (unité)'),(1666,82,64,22,'Yaourt grec','Yaourt grec (unité)'),(1667,85,64,22,'Oeuf','Oeuf (unité)'),(1668,85,64,22,'Filet de poulet','Filet de poulet (unité)'),(1669,85,65,22,'Rôti de dinde','Rôti de dinde (g)'),(1670,85,65,22,'Rôti de porc','Rôti de porc (g)'),(1671,85,64,22,'Filet de dinde','Filet de dinde (unité)'),(1672,85,64,22,'Escalope de poulet','Escalope de poulet (unité)'),(1673,85,64,22,'Escalope de dinde','Escalope de dinde (unité)'),(1674,85,64,22,'Jambon blanc','Jambon blanc (unité)'),(1675,85,64,22,'Jambon cru','Jambon cru (unité)'),(1676,85,65,22,'Lardons','Lardons (g)'),(1677,85,65,22,'Boeuf hâché','Boeuf hâché (g)'),(1678,85,64,22,'Steak hâché','Steak hâché (unité)'),(1679,85,64,22,'Knacki','Knacki (unité)'),(1680,85,64,22,'Merguez','Merguez (unité)'),(1681,85,65,22,'Carpaccio de boeuf','Carpaccio de boeuf (g)'),(1682,79,64,22,'Bouillon de légumes','Bouillon de légumes (unité)'),(1683,79,64,22,'Bouillon de boeuf','Bouillon de boeuf (unité)'),(1684,79,64,22,'Bouillon de volaille','Bouillon de volaille (unité)'),(1685,79,64,22,'Bouillon pot-au-feu','Bouillon pot-au-feu (unité)'),(1686,79,64,22,'Jus de rôti','Jus de rôti (unité)'),(1687,79,70,22,'Lait de coco','Lait de coco (cl)'),(1688,79,67,22,'Harissa','Harissa (cc)'),(1689,79,65,22,'Pesto vert','Pesto vert (g)'),(1690,79,65,22,'Pesto rouge','Pesto rouge (g)'),(1691,79,68,22,'Miel','Miel (cs)'),(1692,79,67,22,'Moutarde','Moutarde (cc)'),(1693,79,65,22,'Pignons de pin','Pignons de pin (g)'),(1694,79,67,24,'Sel','Sel (cc)'),(1695,79,67,24,'Gros sel','Gros sel (cc)'),(1696,79,67,24,'Poivre','Poivre (cc)'),(1697,79,67,22,'Paprika','Paprika (cc)'),(1698,79,67,22,'Paprika fumé','Paprika fumé (cc)'),(1699,79,67,22,'Ras el hanout','Ras el hanout (cc)'),(1700,79,67,22,'Sel au céleri','Sel au céleri (cc)'),(1701,79,67,22,'Tandoori','Tandoori (cc)'),(1702,86,65,23,'Crevettes','Crevettes (g)'),(1703,86,65,23,'Noix de St-Jacques','Noix de St-Jacques (g)'),(1704,86,65,23,'Saumon','Saumon (g)'),(1705,86,64,22,'Saumon fumé (tranches)','Saumon fumé (tranches) (unité)'),(1706,86,64,22,'Truite fumée (tranches)','Truite fumée (tranches) (unité)'),(1707,86,65,23,'Thon','Thon (g)'),(1708,86,65,23,'Poisson blanc (loup, aigle fin, merlu)','Poisson blanc (loup, aigle fin, merlu) (g)'),(1709,86,65,22,'Thon en boîte','Thon en boîte (g)'),(1710,85,64,22,'Bacon (tranches)','Bacon (tranches) (unité)'),(1711,79,67,22,'Curry','Curry (cc)'),(1712,88,67,22,'Cannelle','Cannelle (cc)'),(1713,79,67,22,'Coriandre en poudre','Coriandre en poudre (cc)'),(1714,79,67,22,'4 épices','4 épices (cc)'),(1715,79,67,22,'Gingembre en poudre','Gingembre en poudre (cc)'),(1716,79,67,22,'Piment de cayenne','Piment de cayenne (cc)'),(1717,79,67,22,'Muscade','Muscade (cc)'),(1718,79,67,22,'Épices méxicaines','Épices méxicaines (cc)'),(1719,79,67,22,'Épices italiennes','Épices italiennes (cc)'),(1720,79,67,22,'Épices chinoises','Épices chinoises (cc)'),(1721,79,67,22,'Épices espagnoles','Épices espagnoles (cc)'),(1722,79,67,22,'Aneth','Aneth (cc)'),(1723,79,67,22,'Colombo','Colombo (cc)'),(1724,79,67,22,'Cumin','Cumin (cc)'),(1725,79,67,22,'Curcuma','Curcuma (cc)'),(1726,79,68,24,'Sauce soja salée','Sauce soja salée (cs)'),(1727,79,68,22,'Sauce soja sucrée','Sauce soja sucrée (cs)'),(1728,79,68,22,'Sauce yakitori','Sauce yakitori (cs)'),(1729,79,68,22,'Sauce teriyaki','Sauce teriyaki (cs)'),(1730,79,68,22,'Sauce nuoc-mâm','Sauce nuoc-mâm (cs)'),(1731,82,65,22,'Parmesan râpé','Parmesan râpé (g)'),(1732,82,65,22,'Parmesan à râper','Parmesan à râper (g)'),(1733,82,65,22,'Féta','Féta (g)'),(1734,82,65,22,'Ricotta','Ricotta (g)'),(1735,82,65,22,'Mascarpone','Mascarpone (g)'),(1736,79,65,22,'Chapelure','Chapelure (g)'),(1737,79,67,22,'Huile piquante','Huile piquante (cc)'),(1738,79,65,22,'Miso rouge','Miso rouge (g)'),(1739,88,65,24,'Sucre blanc','Sucre blanc (g)'),(1740,88,65,24,'Purée d\'amandes','Purée d\'amandes (g)'),(1741,88,65,24,'Purée de cacahuètes','Purée de cacahuètes (g)'),(1742,88,65,24,'Sucre roux','Sucre roux (g)'),(1743,88,66,24,'Farine','Farine (kg)'),(1744,88,65,22,'Levure chimique','Levure chimique (g)'),(1745,87,64,22,'Pain de mie (tranches)','Pain de mie (tranches) (unité)'),(1746,87,64,24,'Pain (tranches)','Pain (tranches) (unité)'),(1747,87,64,22,'Pâte à tarte ronde','Pâte à tarte ronde (unité)'),(1748,87,64,22,'Pâte à tarte carrée','Pâte à tarte carrée (unité)'),(1749,87,64,22,'Pâte feuilletée','Pâte feuilletée (unité)'),(1750,88,65,22,'Pépites de chocolat','Pépites de chocolat (g)'),(1751,88,65,24,'Levure boulangère','Levure boulangère (g)'),(1752,88,65,24,'Bicarbonate alimentaire','Bicarbonate alimentaire (g)'),(1753,85,65,22,'Chorizo','Chorizo (g)'),(1754,82,65,22,'Fromage','Fromage (g)'),(1755,78,71,22,'Eau','Eau (L)'),(1756,78,70,22,'Vin blanc de cuisine','Vin blanc de cuisine (cl)'),(1757,82,71,22,'Lait demi-écrémé','Lait demi-écrémé (L)'),(1758,82,71,22,'Lait entier','Lait entier (L)'),(1759,84,65,22,'Frites','Frites (g)'),(1760,84,65,22,'Potatoes','Potatoes (g)');
/*!40000 ALTER TABLE `aliment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (78,'Boisson'),(79,'Condiment'),(80,'Fruit'),(81,'Gâteaux'),(82,'Laitage'),(83,'Légume'),(84,'Surgelé'),(85,'Viande'),(86,'Poisson'),(87,'Féculent'),(88,'Pâtisserie');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `recipe_type`
--

LOCK TABLES `recipe_type` WRITE;
/*!40000 ALTER TABLE `recipe_type` DISABLE KEYS */;
INSERT INTO `recipe_type` VALUES (50,'Entrée'),(51,'Plat'),(52,'Plat trash'),(53,'Dessert'),(54,'Snack'),(55,'Apéro'),(56,'Petit déj\'');
/*!40000 ALTER TABLE `recipe_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `season`
--

LOCK TABLES `season` WRITE;
/*!40000 ALTER TABLE `season` DISABLE KEYS */;
INSERT INTO `season` VALUES (36,'? Printemps','2022-03-02','2022-06-01'),(37,'☀️ Été','2022-06-02','2022-09-01'),(38,'? Automne','2022-09-02','2022-12-01'),(39,'❄️ Hiver','2022-12-02','2023-03-01'),(40,'? Toutes saisons','2022-01-01','2022-12-31');
/*!40000 ALTER TABLE `season` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (64,'unité'),(65,'g'),(66,'kg'),(67,'cc'),(68,'cs'),(69,'ml'),(70,'cl'),(71,'L'),(72,'cm');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `shop_place`
--

LOCK TABLES `shop_place` WRITE;
/*!40000 ALTER TABLE `shop_place` DISABLE KEYS */;
INSERT INTO `shop_place` VALUES (22,'Supermarché'),(23,'Marché'),(24,'Bio / Vrac');
/*!40000 ALTER TABLE `shop_place` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-19  6:57:31
