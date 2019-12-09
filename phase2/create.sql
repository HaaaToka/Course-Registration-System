-- MySQL dump 10.13  Distrib 8.0.17, for osx10.14 (x86_64)
--
-- Host: localhost    Database: 471DB
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Class`
--

DROP TABLE IF EXISTS `Class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Class` (
  `classID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `term` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`classID`),
  KEY `courseID_idx` (`courseID`),
  CONSTRAINT `class_courseidFK` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Class`
--

LOCK TABLES `Class` WRITE;
/*!40000 ALTER TABLE `Class` DISABLE KEYS */;
INSERT INTO `Class` VALUES (1,1,2019,'Fall'),(2,1,2019,'Spring'),(3,2,2018,'Spring'),(4,3,2020,'Spring'),(5,3,2019,'Fall'),(6,2,2016,'Spring'),(7,3,2017,'Fall'),(8,4,2017,'Summer'),(9,1,2015,'Fall'),(10,1,2016,'Winter');
/*!40000 ALTER TABLE `Class` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Class_BEFORE_INSERT` BEFORE INSERT ON `class` FOR EACH ROW BEGIN
IF (SELECT count(*) FROM Class) = 0
    THEN
    SET new.classID = 1;
    ELSE
    SET new.classID = (SELECT MAX(classID) + 1 FROM Class);
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Course`
--

DROP TABLE IF EXISTS `Course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Course` (
  `courseID` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `credit` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  PRIMARY KEY (`courseID`),
  KEY `deparmentID_idx` (`departmentID`),
  CONSTRAINT `course_deparmentidFK` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Course`
--

LOCK TABLES `Course` WRITE;
/*!40000 ALTER TABLE `Course` DISABLE KEYS */;
INSERT INTO `Course` VALUES (1,'BBM101',5,1),(2,'FUT101',10,2),(3,'BBM201',10,1),(4,'ELE101',6,7),(5,'ELE102',5,10),(6,'BES101',1,3),(7,'BBM471',10,1),(8,'BBM371',7,1),(9,'BBM301',5,1),(10,'ASD123',4,4);
/*!40000 ALTER TABLE `Course` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Course_BEFORE_INSERT` BEFORE INSERT ON `course` FOR EACH ROW BEGIN
IF (SELECT count(*) FROM Course) = 0
    THEN
    SET new.courseID = 1;
    ELSE
    SET new.courseID = (SELECT MAX(courseID) + 1 FROM Course);
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Department`
--

DROP TABLE IF EXISTS `Department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Department` (
  `departmentID` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facultyID` int(11) DEFAULT NULL,
  PRIMARY KEY (`departmentID`),
  KEY `facultyID_idx` (`facultyID`),
  CONSTRAINT `department_facultyidFK` FOREIGN KEY (`facultyID`) REFERENCES `faculty` (`facultyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Department`
--

LOCK TABLES `Department` WRITE;
/*!40000 ALTER TABLE `Department` DISABLE KEYS */;
INSERT INTO `Department` VALUES (1,'computer','beytepe',1),(2,'futbol','sihhiye',2),(3,'chemistery','beytepe',1),(4,'turkce','beytepe',5),(5,'ingiliz dil ve tarih','beytepe',4),(6,'fransizca','beytepe',3),(7,'bote','sihhiye',3),(8,'endustri tasarimi','sihhiye',6),(9,'ucak teknisyeni','sincan',6),(10,'electric','beytepe',1);
/*!40000 ALTER TABLE `Department` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Department_BEFORE_INSERT` BEFORE INSERT ON `department` FOR EACH ROW BEGIN
IF (SELECT count(*) FROM Department) = 0
    THEN
    SET new.departmentID = 1;
    ELSE
    SET new.departmentID = (SELECT MAX(departmentID) + 1 FROM Department);
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Faculty`
--

DROP TABLE IF EXISTS `Faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Faculty` (
  `facultyID` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`facultyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Faculty`
--

LOCK TABLES `Faculty` WRITE;
/*!40000 ALTER TABLE `Faculty` DISABLE KEYS */;
INSERT INTO `Faculty` VALUES (1,'ENGINEERING'),(2,'sport'),(3,'ydyo'),(4,'edebiyat'),(5,'egitim'),(6,'myo'),(7,'faculty7'),(8,'faculty8'),(9,'faculty9'),(10,'faculty10');
/*!40000 ALTER TABLE `Faculty` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Faculty_BEFORE_INSERT` BEFORE INSERT ON `faculty` FOR EACH ROW BEGIN
IF (SELECT count(*) FROM Faculty) = 0
    THEN
    SET new.facultyID = 1;
    ELSE
    SET new.facultyID = (SELECT MAX(facultyID) + 1 FROM Faculty);
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Instructor`
--

DROP TABLE IF EXISTS `Instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Instructor` (
  `instructorID` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `departmentID` int(11) NOT NULL,
  PRIMARY KEY (`instructorID`),
  KEY `departmentID_idx` (`departmentID`),
  CONSTRAINT `instructor_departmentidFK` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Instructor`
--

LOCK TABLES `Instructor` WRITE;
/*!40000 ALTER TABLE `Instructor` DISABLE KEYS */;
INSERT INTO `Instructor` VALUES (1,'engin','demir',1),(2,'engin','altin',2),(3,'nuray','esendemir',3),(4,'ogr1','ogr11',7),(5,'ogr4','ogr44',9),(6,'ogr5','ogr55',8),(7,'ogr6','ogr66',2),(8,'ogr7','ogr77',4),(9,'ogr8','ogr88',5),(10,'ogr9','ogr99',1),(11,'ogr10','ogr1010',1);
/*!40000 ALTER TABLE `Instructor` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Instructor_BEFORE_INSERT` BEFORE INSERT ON `instructor` FOR EACH ROW BEGIN
IF (SELECT count(*) FROM Instructor) = 0
    THEN
    SET new.instructorID = 1;
    ELSE
    SET new.instructorID = (SELECT MAX(instructorID) + 1 FROM Instructor);
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `InstructorGivesCourse`
--

DROP TABLE IF EXISTS `InstructorGivesCourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `InstructorGivesCourse` (
  `instructorID` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  PRIMARY KEY (`instructorID`,`classID`,`sectionID`),
  KEY `instructorgivescourse_classidFK_idx` (`classID`),
  KEY `instrcutorgivescourse_sectionidFK_idx` (`sectionID`),
  CONSTRAINT `instrcutorgivescourse_sectionidFK` FOREIGN KEY (`sectionID`) REFERENCES `section` (`sectionID`),
  CONSTRAINT `instructorgivescourse_classidFK` FOREIGN KEY (`classID`) REFERENCES `class` (`classID`),
  CONSTRAINT `instructorgivescourse_instructoridFK` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InstructorGivesCourse`
--

LOCK TABLES `InstructorGivesCourse` WRITE;
/*!40000 ALTER TABLE `InstructorGivesCourse` DISABLE KEYS */;
INSERT INTO `InstructorGivesCourse` VALUES (1,1,1),(2,1,2),(3,1,1),(2,3,1),(1,4,1),(2,4,2),(3,4,1),(3,4,2),(2,5,2),(2,6,2);
/*!40000 ALTER TABLE `InstructorGivesCourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `joinclassinstructor`
--

DROP TABLE IF EXISTS `joinclassinstructor`;
/*!50001 DROP VIEW IF EXISTS `joinclassinstructor`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `joinclassinstructor` AS SELECT 
 1 AS `instructorID`,
 1 AS `InstructorName`,
 1 AS `InstructorSurname`,
 1 AS `courseID`,
 1 AS `CourseName`,
 1 AS `classID`,
 1 AS `sectionID`,
 1 AS `year`,
 1 AS `term`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `joincourseclasssection`
--

DROP TABLE IF EXISTS `joincourseclasssection`;
/*!50001 DROP VIEW IF EXISTS `joincourseclasssection`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `joincourseclasssection` AS SELECT 
 1 AS `courseID`,
 1 AS `CourseName`,
 1 AS `credit`,
 1 AS `classID`,
 1 AS `year`,
 1 AS `term`,
 1 AS `sectionID`,
 1 AS `quota`,
 1 AS `SectionLocation`,
 1 AS `day1`,
 1 AS `startTime1`,
 1 AS `endTime1`,
 1 AS `day2`,
 1 AS `startTime2`,
 1 AS `endTime2`,
 1 AS `day3`,
 1 AS `startTime3`,
 1 AS `endTime3`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `joininstructordepartment`
--

DROP TABLE IF EXISTS `joininstructordepartment`;
/*!50001 DROP VIEW IF EXISTS `joininstructordepartment`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `joininstructordepartment` AS SELECT 
 1 AS `InstructorName`,
 1 AS `InstructorSurname`,
 1 AS `DepartmentName`,
 1 AS `departmentID`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `joinstudentdepartment`
--

DROP TABLE IF EXISTS `joinstudentdepartment`;
/*!50001 DROP VIEW IF EXISTS `joinstudentdepartment`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `joinstudentdepartment` AS SELECT 
 1 AS `studentID`,
 1 AS `StudentName`,
 1 AS `StudentSurname`,
 1 AS `creditLimit`,
 1 AS `startYear`,
 1 AS `DepartmentName`,
 1 AS `departmentID`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `PrerequisiteCourses`
--

DROP TABLE IF EXISTS `PrerequisiteCourses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PrerequisiteCourses` (
  `prerequisiteCourseID` int(11) NOT NULL,
  `mainCourseID` int(11) NOT NULL,
  PRIMARY KEY (`prerequisiteCourseID`,`mainCourseID`),
  KEY `prerequisitecourses_fk1_idx` (`mainCourseID`),
  CONSTRAINT `prerequisitecourses_fk1` FOREIGN KEY (`prerequisiteCourseID`) REFERENCES `course` (`courseID`),
  CONSTRAINT `prerequisitecourses_fk2` FOREIGN KEY (`mainCourseID`) REFERENCES `course` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PrerequisiteCourses`
--

LOCK TABLES `PrerequisiteCourses` WRITE;
/*!40000 ALTER TABLE `PrerequisiteCourses` DISABLE KEYS */;
INSERT INTO `PrerequisiteCourses` VALUES (2,1),(5,1),(6,1),(3,2),(6,2),(7,2),(4,3),(5,3),(7,3),(6,4),(8,4);
/*!40000 ALTER TABLE `PrerequisiteCourses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Section`
--

DROP TABLE IF EXISTS `Section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Section` (
  `sectionID` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `quota` int(11) NOT NULL,
  `location` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `day1` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `startTime1` time NOT NULL,
  `endTime1` time NOT NULL,
  `day2` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `startTime2` time DEFAULT NULL,
  `endTime2` time DEFAULT NULL,
  `day3` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `startTime3` time DEFAULT NULL,
  `endTime3` time DEFAULT NULL,
  PRIMARY KEY (`sectionID`,`classID`),
  KEY `classID_idx` (`classID`),
  CONSTRAINT `section_classidFK` FOREIGN KEY (`classID`) REFERENCES `class` (`classID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Section`
--

LOCK TABLES `Section` WRITE;
/*!40000 ALTER TABLE `Section` DISABLE KEYS */;
INSERT INTO `Section` VALUES (1,1,48,'Beytepe','Monday','10:00:00','12:00:00','','00:00:00','00:00:00','','00:00:00','00:00:00'),(1,2,18,'Beytepe','Friday','12:00:00','15:00:00','','00:00:00','00:00:00','','00:00:00','00:00:00'),(1,3,19,'yildizAmfi','Tuesday','17:00:00','19:30:00','','00:00:00','00:00:00','','00:00:00','00:00:00'),(1,4,98,'beytepe','Wednesday','09:00:00','12:00:00','Friday','12:00:00','15:00:00','','00:00:00','00:00:00'),(1,5,-1,'d2','Monday','13:00:00','15:00:00','Monday','16:00:00','17:00:00','Monday','18:00:00','20:00:00'),(1,6,1,'d2','Friday','13:00:00','15:00:00','Friday','16:00:00','17:00:00','Friday','18:00:00','20:00:00'),(2,1,50,'Beytepe','Monday','10:00:00','12:00:00','','00:00:00','00:00:00','','00:00:00','00:00:00'),(2,2,1,'d1','Monday','13:00:00','15:00:00','Monday','16:00:00','17:00:00','Monday','18:00:00','20:00:00'),(2,4,1,'d2','Monday','13:00:00','15:00:00','Monday','16:00:00','17:00:00','Monday','18:00:00','20:00:00'),(2,5,1,'d2','Monday','13:00:00','15:00:00','Monday','16:00:00','17:00:00','Monday','18:00:00','20:00:00'),(2,6,1,'d2','Friday','13:00:00','15:00:00','Friday','16:00:00','17:00:00','Friday','18:00:00','20:00:00');
/*!40000 ALTER TABLE `Section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Student` (
  `studentID` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `creditLimit` int(11) NOT NULL,
  `startYear` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  PRIMARY KEY (`studentID`),
  KEY `departmentID_idx` (`departmentID`),
  CONSTRAINT `student_departmentidFK` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student`
--

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
INSERT INTO `Student` VALUES (1,'kaan','mersin',60,2015,1),(2,'meric','celik',60,2016,2),(3,'okan','alan',100,2015,1),(4,'emre','kocan',10,2018,2),(5,'batuhan','mete',78,2017,5),(6,'bilge','cimen',45,2014,4),(7,'oguz','bakir',45,2016,3),(8,'baran','burasli',55,2015,1),(9,'onur fatih','demir',75,2017,6),(10,'akif','baysal',34,2018,5);
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Student_BEFORE_INSERT` BEFORE INSERT ON `student` FOR EACH ROW BEGIN
IF (SELECT count(*) FROM Student) = 0
    THEN
    SET new.studentID = 1;
    ELSE
    SET new.studentID = (SELECT MAX(studentID) + 1 FROM Student);
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary view structure for view `studentgradedcourse`
--

DROP TABLE IF EXISTS `studentgradedcourse`;
/*!50001 DROP VIEW IF EXISTS `studentgradedcourse`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `studentgradedcourse` AS SELECT 
 1 AS `studentID`,
 1 AS `StudentName`,
 1 AS `StudentSurname`,
 1 AS `CourseName`,
 1 AS `grade`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `StudentHasGradedClass`
--

DROP TABLE IF EXISTS `StudentHasGradedClass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `StudentHasGradedClass` (
  `studentID` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `grade` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`studentID`,`classID`),
  KEY `studenthasgradedclass_studentidFK_idx` (`studentID`),
  KEY `studenthasgradedclass_classidFK_idx` (`classID`),
  CONSTRAINT `studenthasgradedclass_classidFK` FOREIGN KEY (`classID`) REFERENCES `class` (`classID`),
  CONSTRAINT `studenthasgradedclass_studentidFK` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StudentHasGradedClass`
--

LOCK TABLES `StudentHasGradedClass` WRITE;
/*!40000 ALTER TABLE `StudentHasGradedClass` DISABLE KEYS */;
INSERT INTO `StudentHasGradedClass` VALUES (1,1,'A1'),(1,2,'A1'),(1,3,'A1'),(1,4,'A1'),(1,5,'A1'),(1,6,'A1'),(1,7,'A1'),(2,1,'A1'),(3,1,'A1'),(4,1,'A1');
/*!40000 ALTER TABLE `StudentHasGradedClass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `studenttakecourse`
--

DROP TABLE IF EXISTS `studenttakecourse`;
/*!50001 DROP VIEW IF EXISTS `studenttakecourse`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `studenttakecourse` AS SELECT 
 1 AS `studentID`,
 1 AS `StudentName`,
 1 AS `StudentSurname`,
 1 AS `CourseName`,
 1 AS `credit`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `StudentTakenCourse`
--

DROP TABLE IF EXISTS `StudentTakenCourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `StudentTakenCourse` (
  `studentID` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  PRIMARY KEY (`studentID`,`classID`,`sectionID`),
  KEY `studenttakencourse_classidFK` (`classID`),
  KEY `studenttakencourse_sectionidFK` (`sectionID`),
  CONSTRAINT `studenttakencourse_classidFK` FOREIGN KEY (`classID`) REFERENCES `class` (`classID`),
  CONSTRAINT `studenttakencourse_sectionidFK` FOREIGN KEY (`sectionID`) REFERENCES `section` (`sectionID`),
  CONSTRAINT `studenttakencourse_studentidFK` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StudentTakenCourse`
--

LOCK TABLES `StudentTakenCourse` WRITE;
/*!40000 ALTER TABLE `StudentTakenCourse` DISABLE KEYS */;
INSERT INTO `StudentTakenCourse` VALUES (1,1,1),(2,1,1),(1,2,1),(2,2,1),(1,3,1),(2,3,1),(1,4,1),(2,4,1),(1,5,1),(2,5,1);
/*!40000 ALTER TABLE `StudentTakenCourse` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `StudentTakenCourse_AFTER_INSERT` AFTER INSERT ON `studenttakencourse` FOR EACH ROW BEGIN
	UPDATE Student 
	SET creditLimit = creditLimit - (Select credit from Course Co,Class Cl Where Co.courseID=Cl.courseID and Cl.classID=new.classID )
	WHERE studentID = new.studentID;
	
	UPDATE Section 
	SET quota = quota - 1
	WHERE sectionID = new.sectionID AND classID = new.classID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `StudentTakenCourse_AFTER_DELETE` AFTER DELETE ON `studenttakencourse` FOR EACH ROW BEGIN
	UPDATE Student 
	SET creditLimit = creditLimit + (Select Credit from Course Where courseID=(Select courseID from class Where classID=old.classID))
	WHERE studentID = old.StudentID;
	
	UPDATE Section 
       SET quota = quota + 1
       WHERE sectionID = old.sectionID AND classID = old.classID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `joinclassinstructor`
--

/*!50001 DROP VIEW IF EXISTS `joinclassinstructor`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `joinclassinstructor` AS select `I`.`instructorID` AS `instructorID`,`I`.`name` AS `InstructorName`,`I`.`surname` AS `InstructorSurname`,`CO`.`courseID` AS `courseID`,`CO`.`name` AS `CourseName`,`CL`.`classID` AS `classID`,`IGC`.`sectionID` AS `sectionID`,`CL`.`year` AS `year`,`CL`.`term` AS `term` from (((`instructor` `I` join `course` `CO`) join `class` `CL`) join `instructorgivescourse` `IGC`) where ((`I`.`instructorID` = `IGC`.`instructorID`) and (`IGC`.`classID` = `CL`.`classID`) and (`CO`.`courseID` = `CL`.`courseID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `joincourseclasssection`
--

/*!50001 DROP VIEW IF EXISTS `joincourseclasssection`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `joincourseclasssection` AS select `CO`.`courseID` AS `courseID`,`CO`.`name` AS `CourseName`,`CO`.`credit` AS `credit`,`CL`.`classID` AS `classID`,`CL`.`year` AS `year`,`CL`.`term` AS `term`,`S`.`sectionID` AS `sectionID`,`S`.`quota` AS `quota`,`S`.`location` AS `SectionLocation`,`S`.`day1` AS `day1`,`S`.`startTime1` AS `startTime1`,`S`.`endTime1` AS `endTime1`,`S`.`day2` AS `day2`,`S`.`startTime2` AS `startTime2`,`S`.`endTime2` AS `endTime2`,`S`.`day3` AS `day3`,`S`.`startTime3` AS `startTime3`,`S`.`endTime3` AS `endTime3` from ((`course` `CO` join `class` `CL`) join `section` `S`) where ((`CO`.`courseID` = `CL`.`courseID`) and (`S`.`classID` = `CL`.`classID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `joininstructordepartment`
--

/*!50001 DROP VIEW IF EXISTS `joininstructordepartment`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `joininstructordepartment` AS select `I`.`name` AS `InstructorName`,`I`.`surname` AS `InstructorSurname`,`D`.`name` AS `DepartmentName`,`D`.`departmentID` AS `departmentID` from (`instructor` `I` join `department` `D` on((`I`.`departmentID` = `D`.`departmentID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `joinstudentdepartment`
--

/*!50001 DROP VIEW IF EXISTS `joinstudentdepartment`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `joinstudentdepartment` AS select `S`.`studentID` AS `studentID`,`S`.`name` AS `StudentName`,`S`.`surname` AS `StudentSurname`,`S`.`creditLimit` AS `creditLimit`,`S`.`startYear` AS `startYear`,`D`.`name` AS `DepartmentName`,`D`.`departmentID` AS `departmentID` from (`student` `S` join `department` `D` on((`S`.`departmentID` = `D`.`departmentID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `studentgradedcourse`
--

/*!50001 DROP VIEW IF EXISTS `studentgradedcourse`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `studentgradedcourse` AS select distinct `S`.`studentID` AS `studentID`,`S`.`name` AS `StudentName`,`S`.`surname` AS `StudentSurname`,`ccs`.`CourseName` AS `CourseName`,`SGC`.`grade` AS `grade` from ((`student` `S` join `joincourseclasssection` `CCS`) join `studenthasgradedclass` `SGC`) where ((`S`.`studentID` = `SGC`.`studentID`) and (`ccs`.`classID` = `SGC`.`classID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `studenttakecourse`
--

/*!50001 DROP VIEW IF EXISTS `studenttakecourse`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `studenttakecourse` AS select `S`.`studentID` AS `studentID`,`S`.`name` AS `StudentName`,`S`.`surname` AS `StudentSurname`,`ccs`.`CourseName` AS `CourseName`,`ccs`.`credit` AS `credit` from ((`student` `S` join `joincourseclasssection` `CCS`) join `studenttakencourse` `STC`) where ((`STC`.`studentID` = `S`.`studentID`) and (`STC`.`classID` = `ccs`.`classID`) and (`STC`.`sectionID` = `ccs`.`sectionID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-09 23:48:31
