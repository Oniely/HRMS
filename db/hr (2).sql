# ************************************************************
# Antares - SQL Client
# Version 0.7.22
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: 127.0.0.1 (mariadb.org binary distribution 10.4.32)
# Database: hr
# Generation time: 2024-03-22T00:43:43+08:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin_tbl
# ------------------------------------------------------------

CREATE TABLE `admin_tbl` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `position` varchar(150) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `admin_tbl` WRITE;
/*!40000 ALTER TABLE `admin_tbl` DISABLE KEYS */;

INSERT INTO `admin_tbl` (`admin_id`, `username`, `password`, `fname`, `lname`, `contact`, `position`) VALUES
	(1, "admin", "admin", "Thomas", "Arguelles", "09123456789", "Head Administrator");

/*!40000 ALTER TABLE `admin_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table business_address_tbl
# ------------------------------------------------------------

CREATE TABLE `business_address_tbl` (
  `business_id` int(11) NOT NULL AUTO_INCREMENT,
  `brgy` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  PRIMARY KEY (`business_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of table children_tbl
# ------------------------------------------------------------

CREATE TABLE `children_tbl` (
  `c_id` int(50) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(50) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `children_tbl_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee_tbl` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of table college_tbl
# ------------------------------------------------------------

CREATE TABLE `college_tbl` (
  `employee_id` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_graduate` date NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `college_tbl` WRITE;
/*!40000 ALTER TABLE `college_tbl` DISABLE KEYS */;

INSERT INTO `college_tbl` (`employee_id`, `schoolname`, `address`, `course`, `year_graduate`) VALUES
	(143, "Southland College", "Southland College", "Southland College", "2024-03-22"),
	(823728, "qwe", "qwe", "qwe", "2002-12-22"),
	(20190110, "Southland College", "Kabankalan City", "Kabankalan City", "2024-03-10"),
	(20190111, "Southland College", "Kabankalan City", "Kabankalan City", "2023-12-31"),
	(203298392, "", "", "", "1899-11-30");

/*!40000 ALTER TABLE `college_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table educational_attainment_tbl
# ------------------------------------------------------------

CREATE TABLE `educational_attainment_tbl` (
  `educ_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `elementary_id` int(11) NOT NULL,
  `highschool_id` int(11) NOT NULL,
  `vocational_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `graduate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of table elementary_tbl
# ------------------------------------------------------------

CREATE TABLE `elementary_tbl` (
  `employee_id` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `year_graduate` varchar(255) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `elementary_tbl` WRITE;
/*!40000 ALTER TABLE `elementary_tbl` DISABLE KEYS */;

INSERT INTO `elementary_tbl` (`employee_id`, `schoolname`, `address`, `year_graduate`) VALUES
	(143, "Southland College", "Southland College", "2024-03-16"),
	(823728, "qwe", "qwe", "2002-12-22"),
	(20190110, "Southland College", "Kabankalan City", "2024-03-10"),
	(20190111, "Southland College", "Kabankalan City", "2020-12-31"),
	(203298392, "", "", "");

/*!40000 ALTER TABLE `elementary_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table employee_tbl
# ------------------------------------------------------------

CREATE TABLE `employee_tbl` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `tin_id` varchar(100) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `sss_no` varchar(100) NOT NULL,
  `pagibig_no` varchar(100) NOT NULL,
  `philhealth_no` varchar(100) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `residential_address` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2024989393 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `employee_tbl` WRITE;
/*!40000 ALTER TABLE `employee_tbl` DISABLE KEYS */;

INSERT INTO `employee_tbl` (`employee_id`, `fname`, `mname`, `lname`, `date_of_birth`, `place_of_birth`, `sex`, `blood_type`, `civil_status`, `tin_id`, `citizenship`, `sss_no`, `pagibig_no`, `philhealth_no`, `height`, `weight`, `residential_address`, `permanent_address`, `email`, `contact_number`, `status`, `photo_path`) VALUES
	(143, "I", "Love", "You", "2020-02-14", "1, Kabankalan City, Negros Occidental", "Female", "O", "Female", "143", "Filipino", "143", "143", "143", 173, 70, "1, Kabankalan City, Negros Occidental", "1, Kabankalan City, Negros Occidental", "iloveyou3000@gmail.com", "09123456789", "ACTIVE", "images/profiles/photo_65fc477508a131.24228450.png"),
	(20190111, "Tester", "qwe", "asd", "2024-01-01", "1, Kabankalan City, Negros Occidental", "Male", "O", "Male", "123", "Filipino", "123", "123", "123", 165, 80, "1, Kabankalan City, Negros Occidental", "1, Kabankalan City, Negros Occidental", "qwe@gmail.com", "1", "ACTIVE", NULL);

/*!40000 ALTER TABLE `employee_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table faculty_tbl
# ------------------------------------------------------------

CREATE TABLE `faculty_tbl` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `tin_id` varchar(255) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `sss_no` varchar(255) NOT NULL,
  `pagibig_no` varchar(255) NOT NULL,
  `philhealth_no` varchar(255) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `residential_address` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ACTIVE',
  `photo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2147483648 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `faculty_tbl` WRITE;
/*!40000 ALTER TABLE `faculty_tbl` DISABLE KEYS */;

INSERT INTO `faculty_tbl` (`faculty_id`, `fname`, `mname`, `lname`, `date_of_birth`, `place_of_birth`, `sex`, `blood_type`, `civil_status`, `tin_id`, `citizenship`, `sss_no`, `pagibig_no`, `philhealth_no`, `height`, `weight`, `residential_address`, `permanent_address`, `email`, `contact_number`, `status`, `photo_path`) VALUES
	(20190110, "Tester", "qwe", "asd", "1899-11-30", "1, Kabankalan City, Negros Occidental", "Male", "O", "", "123", "Filipino", "123", "123", "123", 165, 80, "1, Kabankalan City, Negros Occidental", "1, Kabankalan City, Negros Occidental", "qwe@gmail.com", "1", "ACTIVE", NULL),
	(20921038, "Dan", "Huy", "Nguyen", "2024-03-02", ", , Vietname", "Male", "O", "Male", "", "Filipino/Vietnamese", "", "", "", 172.2, 60, "Barangay Orong, Kabankalan City, Negros Occidental", "Dalat, DalatLâm , Vietnam", "dan.huy@gmail.com", "098089893", "ACTIVE", NULL);

/*!40000 ALTER TABLE `faculty_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table family_background_tbl
# ------------------------------------------------------------

CREATE TABLE `family_background_tbl` (
  `fb_id` int(50) NOT NULL AUTO_INCREMENT,
  `spouse_id` int(50) DEFAULT NULL,
  `employeers_name` varchar(255) DEFAULT NULL,
  `business_address` varchar(255) DEFAULT NULL,
  `children_id` int(50) DEFAULT NULL,
  `fathers_name_id` int(50) DEFAULT NULL,
  `mothers_name_id` int(50) DEFAULT NULL,
  PRIMARY KEY (`fb_id`),
  KEY `spouse_id` (`spouse_id`),
  KEY `children_id` (`children_id`),
  KEY `fathers_name_id` (`fathers_name_id`),
  KEY `mothers_name_id` (`mothers_name_id`),
  CONSTRAINT `family_background_tbl_ibfk_1` FOREIGN KEY (`spouse_id`) REFERENCES `spouse_tbl` (`s_id`),
  CONSTRAINT `family_background_tbl_ibfk_2` FOREIGN KEY (`children_id`) REFERENCES `children_tbl` (`c_id`),
  CONSTRAINT `family_background_tbl_ibfk_3` FOREIGN KEY (`fathers_name_id`) REFERENCES `fathers_name` (`father_id`),
  CONSTRAINT `family_background_tbl_ibfk_4` FOREIGN KEY (`mothers_name_id`) REFERENCES `mothers_name` (`mother_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of table fathers_name
# ------------------------------------------------------------

CREATE TABLE `fathers_name` (
  `father_id` int(50) NOT NULL AUTO_INCREMENT,
  `employee_id` int(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`father_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `fathers_name` WRITE;
/*!40000 ALTER TABLE `fathers_name` DISABLE KEYS */;

INSERT INTO `fathers_name` (`father_id`, `employee_id`, `fname`, `mname`, `lname`) VALUES
	(1, 2024998824, "He", "A.", "Eledia"),
	(2, 2024998824, "He", "A.", "Eledia"),
	(3, 298049209, "He", "A.", "Eledia"),
	(4, 2024985994, "Mario", "Osiya", "Llaya"),
	(5, 2029489839, "Rancha", "D.", "Loriat"),
	(6, 2024989392, "George", "E.", "Geronimo"),
	(7, 2090984, "Jack", "E.", "Rodriguez"),
	(8, 209894892, "Tristan", "E.", "Arguello"),
	(9, 2019489839, "Ben", "James", "Parker"),
	(10, 2090989, "Ben", "Alyano", "Parker"),
	(11, 20921038, "Mark", "Huy", "Nguyen"),
	(12, 2022819839, "qwe", "qwe", "qwe"),
	(13, 203298392, "qwe", "qwe", "2002-12-22"),
	(14, 823728, "qwe", "qwe", "2002-12-22"),
	(15, 20190111, "Roniel", "Jabagat", "Gencaya"),
	(16, 20190111, "Roniel", "Jabagat", "Gencaya"),
	(17, 20190111, "Roniel", "Jabagat", "Gencaya"),
	(18, 20190110, "Roniel", "Jabagat", "Gencaya"),
	(19, 143, "BU", "TO", "DAKU"),
	(20, 143, "BU", "TO", "DAKU");

/*!40000 ALTER TABLE `fathers_name` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table graduate_tbl
# ------------------------------------------------------------

CREATE TABLE `graduate_tbl` (
  `employee_id` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_graduate` date NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `graduate_tbl` WRITE;
/*!40000 ALTER TABLE `graduate_tbl` DISABLE KEYS */;

INSERT INTO `graduate_tbl` (`employee_id`, `schoolname`, `address`, `course`, `year_graduate`) VALUES
	(143, "Southland College", "Southland College", "Southland College", "2024-03-22"),
	(823728, "qwe", "qwe", "qwe", "2002-12-22"),
	(20190110, "Southland College", "Kabankalan City", "Kabankalan City", "2024-03-10"),
	(20190111, "Southland College", "Kabankalan City", "Kabankalan City", "2024-12-01"),
	(203298392, "", "", "", "1899-11-30");

/*!40000 ALTER TABLE `graduate_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table highschool_tbl
# ------------------------------------------------------------

CREATE TABLE `highschool_tbl` (
  `employee_id` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_graduate` date NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `highschool_tbl` WRITE;
/*!40000 ALTER TABLE `highschool_tbl` DISABLE KEYS */;

INSERT INTO `highschool_tbl` (`employee_id`, `schoolname`, `address`, `course`, `year_graduate`) VALUES
	(143, "Southland College", "Southland College", "STEM", "2024-03-14"),
	(823728, "qwe", "qwe", "qwe", "2002-12-22"),
	(20190110, "Southland College", "Kabankalan City", "Kabankalan City", "2024-03-10"),
	(20190111, "Southland College", "Kabankalan City", "Kabankalan City", "2021-12-30"),
	(203298392, "", "", "", "1899-11-30");

/*!40000 ALTER TABLE `highschool_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table leave_tbl
# ------------------------------------------------------------

CREATE TABLE `leave_tbl` (
  `sick_leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `date_applied` datetime NOT NULL,
  `reason` varchar(255) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `total_days_leave` int(11) NOT NULL,
  `application_status` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `accompany_with` varchar(255) NOT NULL,
  `balance_days` varchar(100) NOT NULL,
  PRIMARY KEY (`sick_leave_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;





# Dump of table membership_organization_tbl
# ------------------------------------------------------------

CREATE TABLE `membership_organization_tbl` (
  `membership_organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `inclusive_dates` datetime NOT NULL,
  PRIMARY KEY (`membership_organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of table mothers_name
# ------------------------------------------------------------

CREATE TABLE `mothers_name` (
  `mother_id` int(50) NOT NULL AUTO_INCREMENT,
  `employee_id` int(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  PRIMARY KEY (`mother_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `mothers_name` WRITE;
/*!40000 ALTER TABLE `mothers_name` DISABLE KEYS */;

INSERT INTO `mothers_name` (`mother_id`, `employee_id`, `fname`, `mname`, `lname`) VALUES
	(1, 2024998824, "She", "T.", "Eledia"),
	(2, 2024998824, "She", "T.", "Eledia"),
	(3, 298049209, "Gwen", "S.", "Eledia"),
	(4, 2024985994, "Hermosa", "Diora", "Robilo"),
	(5, 2029489839, "Ruby", "A.", "Corza"),
	(6, 2024989392, "", "", ""),
	(7, 2090984, "Winnie Rose", "T.", "Rodriguez"),
	(8, 209894892, "Shania", "R.", "Arguello"),
	(9, 2019489839, "Petra", "Alohina", "Parker"),
	(10, 2090989, "Lanaya", "Gomez", "Parker"),
	(11, 20921038, "Isabel", "Lorien", "Nguyen"),
	(12, 2022819839, "qwe", "qwe", "qwe"),
	(13, 203298392, "qwe", "qwe", "2002-12-22"),
	(14, 823728, "qwe", "qwe", "2002-12-22"),
	(15, 20190111, "May-An ", "Jabagat", "Gencaya"),
	(16, 20190111, "May-An ", "Jabagat", "Gencaya"),
	(17, 20190111, "May-An ", "Jabagat", "Gencaya"),
	(18, 20190110, "May-An ", "Jabagat", "Gencaya"),
	(19, 143, "MO", "NAY", "MO"),
	(20, 143, "MO", "NAY", "MO");

/*!40000 ALTER TABLE `mothers_name` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table other_information_tbl
# ------------------------------------------------------------

CREATE TABLE `other_information_tbl` (
  `other_information_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `special_skills_hobbies` varchar(255) NOT NULL,
  `non_academic_distinctions` varchar(255) NOT NULL,
  PRIMARY KEY (`other_information_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of table permanent_address_tbl
# ------------------------------------------------------------

CREATE TABLE `permanent_address_tbl` (
  `employee_id` int(50) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality_city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `permanent_address_tbl` WRITE;
/*!40000 ALTER TABLE `permanent_address_tbl` DISABLE KEYS */;

INSERT INTO `permanent_address_tbl` (`employee_id`, `barangay`, `municipality_city`, `province`) VALUES
	(2024200923, "Mambugsay", "Sipalay City", "Negros Occidental"),
	(20249032, "Salong", "Kabankalan City", "Negros Occidental"),
	(202409384, "Punta Rojas St., Barangay 6", "Kabankalan City", "Negros Occidental"),
	(2024975792, "Orong", "Kabankalan City", "Negros Occidental"),
	(2024998824, "Crossing", "Pontevedra", "Negros Occidental"),
	(2024985983, "Punta Rojas St., Barangay 6", "Kabankalan City", "Negros Occidental"),
	(2147483647, "Crossing", "Pontevedra", "Negros Occidental"),
	(2024998824, "Crossing", "Pontevedra", "Negros Occidental"),
	(2024998824, "Crossing", "Pontevedra", "Negros Occidental"),
	(298049209, "Punta Rojas St., Barangay 6", "Pontevedra", "Negros Occidental"),
	(2024985994, "Aguisan", "Himamaylan City", "Negros Occidental"),
	(2029489839, "Punta Rojas St., Barangay 6", "Kabankalan City", "Negros Occidental"),
	(2024989392, "Taculing", "Bacolod City", "Negros Occidental"),
	(209784892, "Crossing", "Pontevedra", "Negros Occidental"),
	(2090984, "Punta Rojas St., Barangay 6", "Kabankalan City", "Negros Occidental"),
	(209894892, "Punta Rojas St., Barangay 6", "Kabankalan City", "Negros Occidental"),
	(2019489839, "Punta Rojas St., Barangay 6", "Kabankalan City", "Negros Occidental"),
	(2090989, "Street 64, Green Hills", "Texas", "USA"),
	(20921038, "Dalat", "DalatLâm ", "Vietnam"),
	(2022819839, "qwe", "qwe", "qwe"),
	(203298392, "qwe", "qwe", "qwe"),
	(823728, "qwe", "qwe", "qwe"),
	(20190111, "1", "Kabankalan City", "Negros Occidental"),
	(20190111, "1", "Kabankalan City", "Negros Occidental"),
	(20190111, "1", "Kabankalan City", "Negros Occidental"),
	(20190110, "1", "Kabankalan City", "Negros Occidental"),
	(143, "1", "Kabankalan City", "Negros Occidental"),
	(143, "1", "Kabankalan City", "Negros Occidental");

/*!40000 ALTER TABLE `permanent_address_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table place_of_birth_tbl
# ------------------------------------------------------------

CREATE TABLE `place_of_birth_tbl` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `employee_id` int(50) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality_city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `place_of_birth_tbl` WRITE;
/*!40000 ALTER TABLE `place_of_birth_tbl` DISABLE KEYS */;

INSERT INTO `place_of_birth_tbl` (`id`, `employee_id`, `barangay`, `municipality_city`, `province`) VALUES
	(1, 2090984, "Orong", "Kabankalan City", "Negros Occidental"),
	(2, 209894892, "Mundo", "Kabankalan City", "Negros Occidental"),
	(3, 298049209, "Barangay 5", "Kabankalan City", "Negros Occidental"),
	(4, 2019489839, "Barangay 5", "Kabankalan City", "Negros Occidental"),
	(5, 2090989, "Barangay 5", "Kabankalan City", "Negros Occidental"),
	(6, 20921038, "", "", "Vietname"),
	(7, 2022819839, "1", "qwe city", "qwe"),
	(8, 203298392, "1", "qwe city", "qwe"),
	(9, 823728, "1", "qwe city", "qwe"),
	(10, 20190111, "1", "Kabankalan City", "Negros Occidental"),
	(11, 20190111, "1", "Kabankalan City", "Negros Occidental"),
	(12, 20190111, "1", "Kabankalan City", "Negros Occidental"),
	(13, 20190110, "1", "Kabankalan City", "Negros Occidental"),
	(14, 143, "1", "Kabankalan City", "Negros Occidental"),
	(15, 143, "1", "Kabankalan City", "Negros Occidental");

/*!40000 ALTER TABLE `place_of_birth_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table resedential_address_tbl
# ------------------------------------------------------------

CREATE TABLE `resedential_address_tbl` (
  `employee_id` int(50) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality_city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `resedential_address_tbl` WRITE;
/*!40000 ALTER TABLE `resedential_address_tbl` DISABLE KEYS */;

INSERT INTO `resedential_address_tbl` (`employee_id`, `barangay`, `municipality_city`, `province`) VALUES
	(9903201, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(2024010203, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(2024200923, "Barangay 1 ", "Kabankalan City", "Negros Occidental"),
	(20249032, "Barangay 9", "Kabankalan City", "Negros Occidental"),
	(202409384, "Binicuil", "Kabankalan City", "Negros Occidental"),
	(2024975792, "Orong", "Kabankalan City", "Negros Occidental"),
	(2024998824, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(2024985983, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(2147483647, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(2024998824, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(2024998824, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(298049209, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(2024985994, "Barangay 9", "Kabankalan City", "Negros Occidental"),
	(2029489839, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(2024989392, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(209784892, "Binicuil", "Kabankalan City", "Negros Occidental"),
	(2090984, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(209894892, "Barangay 3", "Kabankalan City", "Negros Occidental"),
	(2019489839, "Barangay 9", "Kabankalan City", "Negros Occidental"),
	(2090989, "Barangay 9", "Kabankalan City", "Negros Occidental"),
	(20921038, "Barangay Orong", "Kabankalan City", "Negros Occidental"),
	(2022819839, "1", "qwe", "qwe"),
	(203298392, "1", "qwe", "qwe"),
	(823728, "1", "qwe", "qwe"),
	(20190111, "1", "Kabankalan City", "Negros Occidental"),
	(20190111, "1", "Kabankalan City", "Negros Occidental"),
	(20190111, "1", "Kabankalan City", "Negros Occidental"),
	(20190110, "1", "Kabankalan City", "Negros Occidental"),
	(143, "1", "Kabankalan City", "Negros Occidental"),
	(143, "1", "Kabankalan City", "Negros Occidental");

/*!40000 ALTER TABLE `resedential_address_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table spouse_tbl
# ------------------------------------------------------------

CREATE TABLE `spouse_tbl` (
  `s_id` int(50) NOT NULL AUTO_INCREMENT,
  `bussiness_id` int(50) NOT NULL,
  `employee_id` int(50) NOT NULL,
  `s_fname` varchar(255) NOT NULL,
  `s_mname` varchar(255) NOT NULL,
  `s_lname` varchar(255) NOT NULL,
  `s_occupation` varchar(255) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `employee_id` (`employee_id`),
  KEY `bussiness_id` (`bussiness_id`),
  CONSTRAINT `spouse_tbl_ibfk_1` FOREIGN KEY (`bussiness_id`) REFERENCES `business_address_tbl` (`business_id`),
  CONSTRAINT `spouse_tbl_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee_tbl` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of table training_and_study_tbl
# ------------------------------------------------------------

CREATE TABLE `training_and_study_tbl` (
  `training_and_study_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `training_study_name` varchar(255) NOT NULL,
  `inclusive_dates` datetime NOT NULL,
  `number_of_hours` varchar(255) NOT NULL,
  `sponsoring_agency` varchar(255) NOT NULL,
  PRIMARY KEY (`training_and_study_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





# Dump of table vocational_tbl
# ------------------------------------------------------------

CREATE TABLE `vocational_tbl` (
  `employee_id` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_graduate` date NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `vocational_tbl` WRITE;
/*!40000 ALTER TABLE `vocational_tbl` DISABLE KEYS */;

INSERT INTO `vocational_tbl` (`employee_id`, `schoolname`, `address`, `course`, `year_graduate`) VALUES
	(0, "Southland College", "Kabankalan City", "Kabankalan City", "1899-11-30"),
	(143, "Southland College", "Southland College", "STEM", "2024-03-15"),
	(823728, "qwe", "qwe", "qwe", "2002-12-22"),
	(20190110, "Southland College", "Kabankalan City", "Kabankalan City", "2024-03-10"),
	(203298392, "", "", "", "1899-11-30");

/*!40000 ALTER TABLE `vocational_tbl` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table work_experience_tbl
# ------------------------------------------------------------

CREATE TABLE `work_experience_tbl` (
  `experience_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `incluside_dates` datetime NOT NULL,
  `name_company/address` varchar(255) NOT NULL,
  `position/title` varchar(255) NOT NULL,
  `status_of_appointment` varchar(255) NOT NULL,
  PRIMARY KEY (`experience_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;





# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2024-03-22T00:43:45+08:00
