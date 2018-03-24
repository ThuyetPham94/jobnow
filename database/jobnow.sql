/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.21-MariaDB : Database - Jobnow
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`Jobnow` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `Jobnow`;

/*Table structure for table `AppliedJob` */

DROP TABLE IF EXISTS `AppliedJob`;

CREATE TABLE `AppliedJob` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `JobSeekerID` bigint(20) unsigned NOT NULL,
  `JobID` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `AppliedJob_JobSeekerid_foreign` (`JobSeekerID`),
  KEY `AppliedJob_Jobid_foreign` (`JobID`),
  CONSTRAINT `AppliedJob_Jobid_foreign` FOREIGN KEY (`JobID`) REFERENCES `Job` (`id`),
  CONSTRAINT `AppliedJob_JobSeekerid_foreign` FOREIGN KEY (`JobSeekerID`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `AppliedJob` */

/*Table structure for table `Category` */

DROP TABLE IF EXISTS `Category`;

CREATE TABLE `Category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CompanyID` bigint(20) unsigned NOT NULL COMMENT 'trong bảng user',
  `Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `company_id_fk_idx` (`CompanyID`),
  CONSTRAINT `company_id_fk` FOREIGN KEY (`CompanyID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `Category` */

/*Table structure for table `CompanyImage` */

DROP TABLE IF EXISTS `CompanyImage`;

CREATE TABLE `CompanyImage` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CompanyID` bigint(20) unsigned NOT NULL,
  `ImageUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ImageTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `CompanyImage_companyid_foreign` (`CompanyID`),
  CONSTRAINT `CompanyImage_companyid_foreign` FOREIGN KEY (`CompanyID`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `CompanyImage` */

/*Table structure for table `CompanyIndustry` */

DROP TABLE IF EXISTS `CompanyIndustry`;

CREATE TABLE `CompanyIndustry` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CompanyID` bigint(20) unsigned NOT NULL,
  `IndustryID` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `CompanyIndustry_companyid_foreign` (`CompanyID`),
  KEY `CompanyIndustry_Industryid_foreign` (`IndustryID`),
  CONSTRAINT `CompanyIndustry_companyid_foreign` FOREIGN KEY (`CompanyID`) REFERENCES `users` (`id`),
  CONSTRAINT `CompanyIndustry_Industryid_foreign` FOREIGN KEY (`IndustryID`) REFERENCES `Industry` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `CompanyIndustry` */

insert  into `CompanyIndustry`(`id`,`CompanyID`,`IndustryID`,`created_at`,`updated_at`) values (2,7,23,'2017-03-24 03:44:20','2017-03-24 03:44:20'),(3,8,6,'2017-03-24 03:58:27','2017-03-24 03:58:27'),(4,9,6,'2017-03-24 04:06:58','2017-03-24 04:06:58');

/*Table structure for table `CompanyProfile` */

DROP TABLE IF EXISTS `CompanyProfile`;

CREATE TABLE `CompanyProfile` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CompanyID` bigint(20) unsigned DEFAULT NULL,
  `Logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CoverImage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Overview` text COLLATE utf8_unicode_ci,
  `WhyJoinUs` text COLLATE utf8_unicode_ci,
  `CompanySizeID` bigint(20) unsigned NOT NULL,
  `ContactName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ContactNumber` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RegistrationNo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WorkingHour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DressCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Benefit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Spoken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Latitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `Longitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `IsActive` tinyint(4) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IsPremium` tinyint(4) DEFAULT '0',
  `FaceBookPage` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EA_Reg` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EA_No` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsShowPhone` int(11) DEFAULT '0' COMMENT '0:khong show,1:show',
  `IsShowEmail` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `CompanyProfile_companyid_foreign` (`CompanyID`),
  KEY `CompanyProfile_CompanySizeid_foreign` (`CompanySizeID`),
  CONSTRAINT `CompanyProfile_companyid_foreign` FOREIGN KEY (`CompanyID`) REFERENCES `users` (`id`),
  CONSTRAINT `CompanyProfile_CompanySizeid_foreign` FOREIGN KEY (`CompanySizeID`) REFERENCES `CompanySize` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `CompanyProfile` */

insert  into `CompanyProfile`(`id`,`CompanyID`,`Logo`,`Name`,`CoverImage`,`Overview`,`WhyJoinUs`,`CompanySizeID`,`ContactName`,`ContactNumber`,`Address`,`RegistrationNo`,`Website`,`WorkingHour`,`DressCode`,`Benefit`,`Spoken`,`Latitude`,`Longitude`,`IsActive`,`created_at`,`updated_at`,`IsPremium`,`FaceBookPage`,`EA_Reg`,`EA_No`,`IsShowPhone`,`IsShowEmail`) values (3,8,NULL,'Redix',NULL,NULL,NULL,2,'','01646322112','',NULL,NULL,NULL,NULL,NULL,NULL,'0','0',1,'2017-03-24 03:58:27','2017-03-24 03:58:27',0,NULL,NULL,NULL,0,0),(4,9,NULL,'VietMT',NULL,NULL,NULL,2,'','01646322445','',NULL,NULL,NULL,NULL,NULL,NULL,'0','0',1,'2017-03-24 04:06:58','2017-03-24 04:06:58',0,NULL,NULL,NULL,0,0),(6,17,NULL,'Liberty Insurance',NULL,NULL,NULL,2,'','6597311383','',NULL,NULL,NULL,NULL,NULL,NULL,'0','0',1,'2017-03-29 08:28:16','2017-03-29 08:28:16',0,NULL,NULL,NULL,0,0);

/*Table structure for table `CompanyReview` */

DROP TABLE IF EXISTS `CompanyReview`;

CREATE TABLE `CompanyReview` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `JobSeekerID` bigint(20) unsigned NOT NULL,
  `CompanyID` bigint(20) unsigned NOT NULL,
  `OverallRating` tinyint(4) NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Review` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `CompanyReview_companyid_foreign` (`CompanyID`),
  KEY `CompanyReview_JobSeekerid_foreign` (`JobSeekerID`),
  CONSTRAINT `CompanyReview_companyid_foreign` FOREIGN KEY (`CompanyID`) REFERENCES `users` (`id`),
  CONSTRAINT `CompanyReview_JobSeekerid_foreign` FOREIGN KEY (`JobSeekerID`) REFERENCES `JobSeeker` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `CompanyReview` */

/*Table structure for table `CompanySize` */

DROP TABLE IF EXISTS `CompanySize`;

CREATE TABLE `CompanySize` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT '0',
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `CompanySize` */

insert  into `CompanySize`(`id`,`Name`,`IsActive`,`Description`,`created_at`,`updated_at`) values (1,'1-50',1,'Từ 1 đến 50 thành viên','2016-12-12 13:25:19','2017-04-14 09:25:58'),(2,'100-499',1,'Từ 100 đến 499 thành viên','2016-12-12 13:25:19','2017-04-14 09:26:15'),(3,'1-10',1,'Từ 1 đến 10 thành viên','2017-02-23 06:28:09','2017-04-14 09:26:33'),(5,'1-20',1,'Từ 10 đến 20 thành viên','2017-02-26 10:16:23','2017-04-14 09:26:47');

/*Table structure for table `Contact` */

DROP TABLE IF EXISTS `Contact`;

CREATE TABLE `Contact` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PhoneNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `Contact` */

/*Table structure for table `Country` */

DROP TABLE IF EXISTS `Country`;

CREATE TABLE `Country` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PostalCode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT '0',
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `Country` */

insert  into `Country`(`id`,`Name`,`PostalCode`,`IsActive`,`Description`,`created_at`,`updated_at`) values (1,'Viet Nam','+84',1,'Capital: Hanoi /  Currency: Vietnamese dong / Population: 89.71 million','2016-12-12 13:25:19','2017-02-26 10:24:31'),(2,'China','+86',1,'Capital: Beijing / Currency: Renminbi / 1.357 billion','2016-12-12 13:25:19','2017-02-26 10:24:50'),(3,'USA',' +1',1,'Capital: Washington, D.C. / Population: 318.9 million ','2016-12-12 13:25:19','2017-02-26 10:24:59'),(4,'Thailand','+66',1,'Capital: Bangkok / Currency: Thai baht / Population: 67.01 million\r\n','2016-12-12 13:25:19','2017-02-26 10:25:16'),(5,'Singapore','+65',1,'Area: 719.1 km² / Population: 5.399 million (2013','2016-12-19 09:19:27','2017-02-26 10:23:26'),(7,'Myanmar',' +95',1,'Capital: Naypyidaw / Currency: Burmese kyat / Population: 53.26 million','2017-02-26 10:17:43','2017-02-26 10:24:11'),(8,'Philippines','+63',1,'Capital: Manila / Currency: Philippine peso / Population: 98.39 million','2017-02-26 10:18:13','2017-02-26 10:24:05'),(9,'India','+91',1,'Capital: New Delhi / Currency: Indian rupee / Population: 1.252 billion (2013)','2017-03-07 04:22:44','2017-03-07 04:22:44');

/*Table structure for table `Currency` */

DROP TABLE IF EXISTS `Currency`;

CREATE TABLE `Currency` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Symbol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT '0',
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `Currency` */

insert  into `Currency`(`id`,`Name`,`Symbol`,`IsActive`,`Description`,`created_at`,`updated_at`) values (1,'VietNam','VNĐ',0,'None Description','2016-12-12 13:25:19','2017-02-26 09:29:55'),(2,'VietNam','VNĐ',1,'None Description','2016-12-12 13:25:19','2016-12-12 13:25:19'),(3,'VietNam','VNĐ',1,'Singapore Dollar','2017-02-23 05:56:13','2017-02-26 10:25:53');

/*Table structure for table `EmploymentType` */

DROP TABLE IF EXISTS `EmploymentType`;

CREATE TABLE `EmploymentType` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `NameType` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `EmploymentType` */

insert  into `EmploymentType`(`id`,`NameType`,`created_at`,`updated_at`) values (1,'Toàn th?i gian','2017-02-22 23:25:19','2017-02-22 23:25:19'),(2,'Bán th?i gian','2017-02-22 23:25:19','2017-02-22 23:25:19'),(3,'Dài h?n','2017-02-22 23:25:19','2017-02-22 23:25:19'),(4,'H?p ??ng','2017-02-22 23:25:19','2017-02-22 23:25:19'),(5,'T?m th?i','2017-02-22 23:25:19','2017-02-22 23:25:19'),(6,'T? do','2017-02-22 23:25:19','2017-02-22 23:25:19'),(7,'Flexi work','2017-02-22 23:25:19','2017-02-22 23:25:19');

/*Table structure for table `Experience` */

DROP TABLE IF EXISTS `Experience`;

CREATE TABLE `Experience` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FromDate` datetime DEFAULT '0000-00-00 00:00:00',
  `ToDate` datetime DEFAULT '0000-00-00 00:00:00',
  `Salary` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `Experience` */

insert  into `Experience`(`id`,`Name`,`created_at`,`updated_at`,`FromDate`,`ToDate`,`Salary`) values (1,'Ít h?n 1 n?m','2017-02-17 17:44:11','2017-02-17 17:44:11','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(2,'2 n?m','2017-02-17 17:44:11','2017-02-17 17:44:11','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(3,'3 n?m','2017-02-17 17:44:11','2017-02-17 17:44:11','0000-00-00 00:00:00','0000-00-00 00:00:00',0),(4,'>5 n?m','2017-02-17 17:44:11','2017-02-17 17:44:11','0000-00-00 00:00:00','0000-00-00 00:00:00',0);

/*Table structure for table `Feedback` */

DROP TABLE IF EXISTS `Feedback`;

CREATE TABLE `Feedback` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) DEFAULT NULL,
  `Message` mediumtext,
  `User_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `Feedback` */

insert  into `Feedback`(`id`,`Title`,`Message`,`User_id`,`created_at`,`updated_at`) values (1,'Test','Test mail',14,'2017-03-27 10:25:19','2017-03-27 10:25:19'),(2,'Test','Test mail',14,'2017-03-27 10:28:35','2017-03-27 10:28:35'),(3,'Test','Test mail',14,'2017-03-27 10:31:16','2017-03-27 10:31:16'),(4,'Test','Test mail',14,'2017-03-27 10:31:42','2017-03-27 10:31:42'),(5,'Test','Test mail',14,'2017-03-27 10:31:57','2017-03-27 10:31:57'),(6,'Test','Test mail',14,'2017-03-27 10:53:19','2017-03-27 10:53:19'),(7,'Test','Test mail',14,'2017-03-27 10:53:58','2017-03-27 10:53:58'),(8,'Test','Test mail',14,'2017-03-27 10:55:45','2017-03-27 10:55:45'),(9,'Test','Test mail',14,'2017-03-27 10:56:55','2017-03-27 10:56:55'),(10,'Fresh/entry level','test',14,'2017-03-27 10:58:07','2017-03-27 10:58:07'),(11,'Fresh/entry level','gdfgfdfd',14,'2017-03-27 10:59:46','2017-03-27 10:59:46'),(12,'Fresh/entry level','dsdsds',14,'2017-03-27 11:07:51','2017-03-27 11:07:51'),(13,'Fresh/entry level','dsdsds',14,'2017-03-27 11:09:42','2017-03-27 11:09:42'),(14,'Test','uhfudsufhus\r\n',14,'2017-03-27 11:10:54','2017-03-27 11:10:54'),(15,'Test','uhfudsufhus\r\n',14,'2017-03-27 11:11:54','2017-03-27 11:11:54'),(16,'Test','uhfudsufhus\r\n',14,'2017-03-27 11:13:40','2017-03-27 11:13:40'),(17,'Test','uhfudsufhus\r\n',14,'2017-03-27 11:23:37','2017-03-27 11:23:37'),(18,'Test','dsdsd',14,'2017-03-27 11:25:28','2017-03-27 11:25:28'),(19,'Fresh/entry level','trtr',14,'2017-03-27 11:26:48','2017-03-27 11:26:48'),(20,'Fresh/entry level','rt',14,'2017-03-27 11:27:28','2017-03-27 11:27:28'),(21,'ds','fdsfds',14,'2017-03-27 11:35:39','2017-03-27 11:35:39');

/*Table structure for table `Industry` */

DROP TABLE IF EXISTS `Industry`;

CREATE TABLE `Industry` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT '0',
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `Industry` */

insert  into `Industry`(`id`,`Name`,`IsActive`,`Description`,`created_at`,`updated_at`) values (1,'Kế toán / Kiểm toán',1,'Good Job','2016-12-12 13:25:19','2017-02-26 09:30:38'),(2,'Hành chính / Thư ký',1,'Good Job','2016-12-12 13:25:19','2016-12-12 13:25:19'),(3,'Quảng cáo, tiếp thị',1,'Good Job','2016-12-12 13:25:19','2016-12-12 13:25:19'),(4,'Ngân hàng / Dịch vụ Tài chính',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(5,'Xây dựng công trình',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(6,'Máy tính / Công nghệ thông tin',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(7,'Dịch vụ khách hàng',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(8,'Thiết kế',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(9,'Giáo dục / Đào tạo',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(10,'Tuyển dụng',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(11,'Kỹ thuật',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(12,'Giải trí',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(13,'Tổ chức sự kiến',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(14,'F&B ',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(15,'Y tế / Dược phẩm',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(16,'Khách sạn / Du lịch',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(17,'Nguồn nhân lực',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(18,'Bảo hiểm',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(19,'Chuỗi cung ứng',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(20,'Chế tạo',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(21,'Chăm sóc sắc đẹp',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(22,'Bán hàng / Bán lẻ',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34'),(23,'Các hoạt động khác',1,'Good Job','2017-02-22 07:11:34','2017-02-22 07:11:34');

/*Table structure for table `Interview` */

DROP TABLE IF EXISTS `Interview`;

CREATE TABLE `Interview` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `JobSeekerID` bigint(20) unsigned NOT NULL,
  `CompanyID` bigint(20) unsigned NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Content` text COLLATE utf8_unicode_ci NOT NULL,
  `InterviewDate` datetime NOT NULL,
  `ContactName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PhoneNumber` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1:Process,2:accept,3:Reject,4:waitting',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Start_time` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `End_time` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Location` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsDeleteCompany` int(11) DEFAULT '0',
  `IsDeleteJobSeeker` int(11) DEFAULT '0',
  `IsReject` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Interview_JobSeekerid_foreign` (`JobSeekerID`),
  KEY `Interview_companyid_foreign` (`CompanyID`),
  CONSTRAINT `Interview_companyid_foreign` FOREIGN KEY (`CompanyID`) REFERENCES `users` (`id`),
  CONSTRAINT `Interview_JobSeekerid_foreign` FOREIGN KEY (`JobSeekerID`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `Interview` */

/*Table structure for table `Invite` */

DROP TABLE IF EXISTS `Invite`;

CREATE TABLE `Invite` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(200) DEFAULT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Status` int(11) DEFAULT NULL COMMENT '0:Invited,1:done.2:reject',
  `User_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `Invite` */

/*Table structure for table `Job` */

DROP TABLE IF EXISTS `Job`;

CREATE TABLE `Job` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CompanyID` bigint(20) unsigned NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Level` tinyint(4) NOT NULL,
  `YearOfExperience` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LocationID` bigint(20) unsigned NOT NULL,
  `IndustryID` bigint(20) unsigned NOT NULL,
  `FromSalary` decimal(30,2) NOT NULL,
  `ToSalary` decimal(30,2) NOT NULL,
  `CurrencyID` bigint(20) unsigned NOT NULL,
  `IsDisplaySalary` tinyint(4) NOT NULL DEFAULT '0',
  `Latitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `Longitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Requirement` text COLLATE utf8_unicode_ci NOT NULL,
  `CreateDate` datetime NOT NULL,
  `IsActive` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Start_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `End_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `JobLevelID` bigint(20) DEFAULT NULL,
  `Location` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SkillList` mediumtext COLLATE utf8_unicode_ci,
  `ExperienceID` bigint(20) DEFAULT NULL,
  `DateExprire` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian hết hạn',
  `EmploymentID` bigint(20) DEFAULT '1',
  `WorkingHours` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Job_companyid_foreign` (`CompanyID`),
  KEY `Job_Locationid_foreign` (`LocationID`),
  KEY `Job_Industryid_foreign` (`IndustryID`),
  KEY `Job_Currencyid_foreign` (`CurrencyID`),
  KEY `Job_ibfk_1` (`JobLevelID`),
  KEY `hg` (`EmploymentID`),
  KEY `fd` (`ExperienceID`),
  CONSTRAINT `Job_ibfk_1` FOREIGN KEY (`JobLevelID`) REFERENCES `JobLevel` (`id`),
  CONSTRAINT `fd` FOREIGN KEY (`ExperienceID`) REFERENCES `Experience` (`id`),
  CONSTRAINT `hg` FOREIGN KEY (`EmploymentID`) REFERENCES `EmploymentType` (`id`),
  CONSTRAINT `Job_companyid_foreign` FOREIGN KEY (`CompanyID`) REFERENCES `users` (`id`),
  CONSTRAINT `Job_Currencyid_foreign` FOREIGN KEY (`CurrencyID`) REFERENCES `Currency` (`id`),
  CONSTRAINT `Job_Industryid_foreign` FOREIGN KEY (`IndustryID`) REFERENCES `Industry` (`id`),
  CONSTRAINT `Job_Locationid_foreign` FOREIGN KEY (`LocationID`) REFERENCES `Location` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `Job` */

/*Table structure for table `JobActstatic` */

DROP TABLE IF EXISTS `JobActstatic`;

CREATE TABLE `JobActstatic` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `JobID` bigint(20) unsigned NOT NULL,
  `Like` bigint(20) NOT NULL DEFAULT '0',
  `View` bigint(20) NOT NULL DEFAULT '0',
  `Share` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `JobActstatic_Jobid_foreign` (`JobID`),
  CONSTRAINT `JobActstatic_Jobid_foreign` FOREIGN KEY (`JobID`) REFERENCES `Job` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `JobActstatic` */

/*Table structure for table `JobLevel` */

DROP TABLE IF EXISTS `JobLevel`;

CREATE TABLE `JobLevel` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `JobLevel` */

insert  into `JobLevel`(`id`,`Name`,`created_at`,`updated_at`) values (2,'T?p s?','2017-05-06 10:20:03','2017-02-23 06:14:12'),(3,'Nhân viên','2017-05-06 10:19:59','2017-02-14 18:53:33'),(4,'?i?u hành','2017-05-06 10:19:29','2017-02-23 11:57:31'),(5,'Giám ??c','2017-05-06 10:19:15','0000-00-00 00:00:00'),(6,'qu?n lý c?p cao','2017-05-06 10:19:08','0000-00-00 00:00:00'),(7,'Chuyên gia','2017-05-06 10:18:59','2017-02-26 17:20:26');

/*Table structure for table `JobSeeker` */

DROP TABLE IF EXISTS `JobSeeker`;

CREATE TABLE `JobSeeker` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `Avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FullName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `BirthDay` date NOT NULL,
  `Gender` tinyint(4) NOT NULL COMMENT '1:male 0:female',
  `PhoneNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PostalCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CountryID` bigint(20) unsigned DEFAULT '5',
  `CurriculumVitae` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IsActive` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `JobSeeker_user_id_foreign` (`user_id`),
  KEY `JobSeeker_Countryid_foreign` (`CountryID`),
  CONSTRAINT `JobSeeker_Countryid_foreign` FOREIGN KEY (`CountryID`) REFERENCES `Country` (`id`),
  CONSTRAINT `JobSeeker_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `JobSeeker` */

insert  into `JobSeeker`(`id`,`user_id`,`Avatar`,`FullName`,`BirthDay`,`Gender`,`PhoneNumber`,`PostalCode`,`CountryID`,`CurriculumVitae`,`Description`,`IsActive`,`created_at`,`updated_at`) values (2,2,'1488826886_ad7bc863acc50ad3b747c51c2f85b431.jpg','JobNow Team','0000-00-00',0,'','',5,'','',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,4,'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/13339473_1308054449221834_6926470104381693513_n.jpg?oh=180db5932daedd7ba7e9e7f3ccce0baf&oe=59723D26','Sze Ling Ng','0000-00-00',0,'','',5,'','',1,'2017-03-23 22:37:20','2017-03-23 22:37:20'),(4,5,'','Dương Nguyễn','0000-00-00',0,'0989819327','',5,'','',0,'2017-03-24 03:39:14','2017-03-24 03:39:14'),(6,10,'','pravin kasekar','0000-00-00',0,'9619441357','',5,'','',0,'2017-03-24 08:55:41','2017-03-24 08:55:41'),(7,11,'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/16386994_132824187229379_8022992299957310962_n.jpg?oh=07da24e9d8a7adf57f30f6ad8b154f27&oe=595CB991','Mike Pacumio','1984-09-16',1,'','',5,'','',1,'2017-03-25 09:07:47','2017-03-25 10:10:20'),(8,12,'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/16865158_1375083092513431_557612351647054384_n.jpg?oh=0e14e2681d18984e0b2ca98a1ba624bf&oe=596B1CF1','Andressa Oliveira','0000-00-00',0,'','',5,'','',1,'2017-03-26 08:13:35','2017-03-26 08:13:35'),(9,13,'https://graph.facebook.com/1140653986080788/picture?width=9999','Steve Stephanopolis','0000-00-00',0,'','',5,'','',1,'2017-03-26 16:32:38','2017-03-26 16:32:38'),(10,15,'https://graph.facebook.com/1289509997804171/picture?width=9999','Delphia Leong Xinlin','0000-00-00',0,'','',5,'','',1,'2017-03-27 20:28:45','2017-03-27 20:28:45'),(11,16,'https://graph.facebook.com/1454429704632511/picture?width=9999','Nikkie Yang','1997-03-19',0,'84236005','',5,'','Willing to work hard',1,'2017-03-29 08:23:11','2017-03-29 08:24:20'),(12,18,'https://graph.facebook.com/1602908196405096/picture?width=9999','Nur Ashykin Mu\'alis','0000-00-00',0,'','',5,'','',1,'2017-03-29 10:32:31','2017-03-29 10:32:31');

/*Table structure for table `JobSeekerExperience` */

DROP TABLE IF EXISTS `JobSeekerExperience`;

CREATE TABLE `JobSeekerExperience` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `JobSeekerID` bigint(20) unsigned NOT NULL,
  `CompanyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PositionName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FromDate` datetime DEFAULT '0000-00-00 00:00:00',
  `ToDate` datetime DEFAULT '0000-00-00 00:00:00',
  `Salary` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `JobSeekerExperience_JobSeekerid_foreign` (`JobSeekerID`),
  CONSTRAINT `JobSeekerExperience_JobSeekerid_foreign` FOREIGN KEY (`JobSeekerID`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `JobSeekerExperience` */

insert  into `JobSeekerExperience`(`id`,`JobSeekerID`,`CompanyName`,`PositionName`,`Description`,`created_at`,`updated_at`,`FromDate`,`ToDate`,`Salary`) values (1,16,'NTBS','Sales Executibe','Doing training exe ','2017-03-29 08:24:59','2017-03-29 08:24:59','2017-01-29 00:00:00','2017-03-29 00:00:00',1400);

/*Table structure for table `JobSeekerSkill` */

DROP TABLE IF EXISTS `JobSeekerSkill`;

CREATE TABLE `JobSeekerSkill` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `JobSeekerID` bigint(20) unsigned NOT NULL,
  `SkillID` bigint(20) unsigned NOT NULL,
  `PositionName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `JobSeekerSkill_JobSeekerid_foreign` (`JobSeekerID`),
  KEY `JobSeekerSkill_Skillid_foreign` (`SkillID`),
  CONSTRAINT `JobSeekerSkill_JobSeekerid_foreign` FOREIGN KEY (`JobSeekerID`) REFERENCES `users` (`id`),
  CONSTRAINT `JobSeekerSkill_Skillid_foreign` FOREIGN KEY (`SkillID`) REFERENCES `Skill` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `JobSeekerSkill` */

insert  into `JobSeekerSkill`(`id`,`JobSeekerID`,`SkillID`,`PositionName`,`Description`,`created_at`,`updated_at`) values (1,11,76,'','','2017-03-25 10:11:39','2017-03-25 10:11:39'),(2,11,56,'','','2017-03-25 10:11:39','2017-03-25 10:11:39'),(3,11,55,'','','2017-03-25 10:11:39','2017-03-25 10:11:39'),(4,11,29,'','','2017-03-25 10:11:39','2017-03-25 10:11:39'),(5,16,104,'','','2017-03-29 08:25:08','2017-03-29 08:25:08'),(6,16,102,'','','2017-03-29 08:25:08','2017-03-29 08:25:08'),(7,16,100,'','','2017-03-29 08:25:08','2017-03-29 08:25:08'),(8,16,96,'','','2017-03-29 08:25:08','2017-03-29 08:25:08'),(9,16,93,'','','2017-03-29 08:25:08','2017-03-29 08:25:08'),(10,16,92,'','','2017-03-29 08:25:08','2017-03-29 08:25:08');

/*Table structure for table `JobSkill` */

DROP TABLE IF EXISTS `JobSkill`;

CREATE TABLE `JobSkill` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `JobID` bigint(20) unsigned NOT NULL,
  `SkillID` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `JobSkill_Jobid_foreign` (`JobID`),
  KEY `JobSkill_Skillid_foreign` (`SkillID`),
  CONSTRAINT `JobSkill_Jobid_foreign` FOREIGN KEY (`JobID`) REFERENCES `Job` (`id`),
  CONSTRAINT `JobSkill_Skillid_foreign` FOREIGN KEY (`SkillID`) REFERENCES `Skill` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `JobSkill` */

/*Table structure for table `Location` */

DROP TABLE IF EXISTS `Location`;

CREATE TABLE `Location` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ZipCode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CountryID` bigint(20) unsigned NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT '0',
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `Location_Countryid_foreign` (`CountryID`),
  CONSTRAINT `Location_Countryid_foreign` FOREIGN KEY (`CountryID`) REFERENCES `Country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `Location` */

insert  into `Location`(`id`,`Name`,`ZipCode`,`CountryID`,`IsActive`,`Description`,`created_at`,`updated_at`) values (1,'Thành phố Hồ Chí Minh','100000',1,1,'Thành phố Hồ Chí Minh','2016-12-12 13:25:19','2017-02-26 09:23:07'),(2,'Hà Nội','400000',1,1,'Hà Nội','2016-12-12 13:25:19','2016-12-12 13:25:19'),(3,'An Giang','500000',1,1,'An Giang','2016-12-12 13:25:19','2016-12-12 13:25:19'),(4,'Bà Rịa - Vũng Tàu','500000',2,1,'Bà Rịa - Vũng Tàu','2016-12-12 13:25:19','2016-12-12 13:25:19'),(6,'Bạc Liêu','500000',1,1,'Bạc Liêu','2017-02-23 12:05:46','0000-00-00 00:00:00'),(7,'Bắc Giang','500000',1,1,'Bắc Giang','2017-02-23 12:05:49','0000-00-00 00:00:00'),(8,'Bắc Kạn','500000',1,1,'Bắc Kạn','2017-02-23 12:05:51','0000-00-00 00:00:00'),(9,'Bắc Ninh','500000',1,1,'Bắc Ninh','0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'Bến Tre','500000',1,1,'Bến Tre','0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,'Bình Dương','500000',1,1,'Bình Dương','0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,'Bình Định','500000',1,1,'Bình Định','0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,'Bình Phước','500000',1,1,'Bình Phước','0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,'Bình Thuận','500000',1,1,'Bình Thuận','0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,'Cà Mau','500000',1,1,'Cà Mau','0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,'Cao Bằng','500000',1,1,'Cao Bằng','0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,'Cần Thơ','500000',1,1,'Cần Thơ','0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,'Đà Nẵng','500000',1,1,'Đà Nẵng','0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,'Đắk Lắk','500000',1,1,'Đắk Lắk','0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,'Đắk Nông','500000',1,1,'Đắk Nông','0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,'Hải Dương','500000',1,1,'Hải Dương','0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,'Hải Phòng','500000',1,1,'Hải Phòng','0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,'Hưng Yên','500000',1,1,'Hưng Yên','0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,'Nam Định','500000',1,1,'Nam Định','0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,'Nghệ An','500000',1,1,'Nghệ An','0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,'Thái Bình','500000',1,1,'Thái Bình','0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,'Thái Nguyên','500000',1,1,'Thái Nguyên','0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,'Thừa Thiên - Huế','500000',1,1,'Thừa Thiên - Huế','0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,'Vĩnh Long','799768',1,1,'Vĩnh Long','0000-00-00 00:00:00','2017-02-23 06:12:51');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_08_06_163129_create_Country_table',1),('2016_08_06_163210_create_Location_table',1),('2016_08_06_163402_create_Currency_table',1),('2016_08_06_163449_create_Industry_table',1),('2016_08_06_171418_create_CompanySize_table',1),('2016_08_11_141527_create_Skill_table',1),('2016_08_11_142107_create_JobSeeker_table',1),('2016_08_11_143127_create_JobSeekerExperience_table',1),('2016_08_11_143353_create_JobSeekerSkill_table',1),('2016_08_11_143613_create_CompanyProfile_table',1),('2016_08_11_143954_create_CompanyIndustry_table',1),('2016_08_11_144155_create_CompanyImage_table',1),('2016_08_11_144240_create_CompanyReview_table',1),('2016_08_11_144426_create_Job_table',1),('2016_08_11_145031_create_JobSkill_table',1),('2016_08_11_145203_create_SavedJob_table',1),('2016_08_11_145316_create_AppliedJob_table',1),('2016_08_11_145404_create_Notification_table',1),('2016_09_16_123047_create_JobActstatic_table',1),('2016_09_16_123955_create_Interview_table',1),('2016_10_04_154009_add_is_premium_to_CompanyProfile_table',1),('2016_10_06_024504_Contact',1),('2017_02_10_190424_update_Job_table',2),('2017_02_10_191608_update_Job_table',3),('2017_02_10_192707_add_phone_to_users_table',4);

/*Table structure for table `Notification` */

DROP TABLE IF EXISTS `Notification`;

CREATE TABLE `Notification` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CompanyID` bigint(20) unsigned NOT NULL,
  `JobSeekerID` bigint(20) unsigned NOT NULL,
  `Title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Content` text COLLATE utf8_unicode_ci NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `KeyScreen` int(11) DEFAULT NULL COMMENT '1: Display list Interview in JobSeeker(When login as a JobSeeker)\n2. Display list Interview of Employer(When login as an Employer)',
  `JobID` bigint(20) unsigned NOT NULL,
  `isCompany` int(11) DEFAULT '0' COMMENT '=0: Notify to JobSeeker\n=1: Notify to Employer',
  `InterviewID` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_JobSeeker_idx` (`JobSeekerID`),
  KEY `id_company` (`CompanyID`),
  CONSTRAINT `id_company` FOREIGN KEY (`CompanyID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_JobSeeker` FOREIGN KEY (`JobSeekerID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `Notification` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `Privacy` */

DROP TABLE IF EXISTS `Privacy`;

CREATE TABLE `Privacy` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) DEFAULT NULL,
  `Description` mediumtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `Privacy` */

insert  into `Privacy`(`id`,`Title`,`Description`,`created_at`,`updated_at`) values (1,'Thông tin b?n chia s?','<P> Nhi?u d?ch v? c?a chúng tôi cho phép b?n chia s? thông tin v?i ng??i khác. Hãy nh? r?ng khi b?n chia s? thông tin công khai, nó có th? ???c các công c? tìm ki?m l?p ch? m?c, k? c? Google. D?ch v? c?a chúng tôi cung c?p cho b?n các tùy ch?n khác nhau v? chia s? và xóa n?i dung c?a b?n. </ P>','2017-05-06 10:27:56','2017-02-14 17:25:03'),(2,'Tính minh b?ch và s? l?a ch?n','<P> M?i ng??i có nh?ng lo ng?i riêng t? khác nhau. M?c tiêu c?a chúng tôi là ph?i rõ ràng v? thông tin mà chúng tôi thu th?p ?? b?n có th? ??a ra các l?a ch?n có ý ngh?a v? cách s? d?ng thông tin. </ P>\r\n\r\n<P> B?n c?ng có th? thi?t l?p trình duy?t c?a b?n ?? ch?n t?t c? cookie, bao g?m các cookie liên quan ??n các d?ch v? c?a chúng tôi, ho?c ch? ra khi cookie ???c chúng tôi thi?t l?p. Tuy nhiên, ?i?u quan tr?ng c?n nh? là nhi?u d?ch v? c?a chúng tôi có th? không ho?t ??ng ?úng ch?c n?ng & nbsp; n?u cookie c?a b?n b? vô hi?u. Ví d?: chúng tôi có th? không nh? tùy ch?n ngôn ng? c?a b?n. </ P>','2017-05-06 10:28:25','0000-00-00 00:00:00'),(3,'Cách chúng tôi s? d?ng thông tin mà chúng tôi thu th?p ???c','<P> Chúng tôi s? d?ng thông tin mà chúng tôi thu th?p ???c t? t?t c? các d?ch v? c?a chúng tôi ?? cung c?p, duy trì, b?o v? và c?i ti?n chúng, phát tri?n các thông tin m?i và ?? b?o v? Google và ng??i dùng c?a chúng tôi. Chúng tôi c?ng s? d?ng thông tin này ?? cung c?p cho b?n n?i dung phù h?p nh? cung c?p cho b?n nhi?u k?t qu? tìm ki?m và qu?ng cáo có liên quan h?n. </ P>\r\n\r\n<P> Chúng tôi có th? s? d?ng tên b?n cung c?p cho Ti?u s? trên Google c?a b?n trên t?t c? các d?ch v? mà chúng tôi cung c?p yêu c?u Tài kho?n Google. Ngoài ra, chúng tôi có th? thay th? các tên c? ???c liên k?t v?i Tài kho?n Google c?a b?n ?? b?n ???c ??i di?n m?t cách nh?t quán trong t?t c? các d?ch v? c?a chúng tôi. N?u nh?ng ng??i dùng khác ?ã có email c?a b?n ho?c thông tin khác nh?n d?ng b?n, chúng tôi có th? hi?n th? cho h? thông tin Ti?u s? công khai c?a b?n, ch?ng h?n nh? tên và ?nh c?a b?n. </ P>','2017-05-06 10:28:37','0000-00-00 00:00:00');

/*Table structure for table `SavedJob` */

DROP TABLE IF EXISTS `SavedJob`;

CREATE TABLE `SavedJob` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `JobSeekerID` bigint(20) unsigned NOT NULL,
  `JobID` bigint(20) unsigned NOT NULL,
  `CreateDate` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `SavedJob_JobSeekerid_foreign` (`JobSeekerID`),
  KEY `SavedJob_Jobid_foreign` (`JobID`),
  CONSTRAINT `SavedJob_Jobid_foreign` FOREIGN KEY (`JobID`) REFERENCES `Job` (`id`),
  CONSTRAINT `SavedJob_JobSeekerid_foreign` FOREIGN KEY (`JobSeekerID`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `SavedJob` */

/*Table structure for table `ShortList` */

DROP TABLE IF EXISTS `ShortList`;

CREATE TABLE `ShortList` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `CategoryID` bigint(20) unsigned NOT NULL,
  `UserID` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `JobID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Category_FK_idx` (`CategoryID`),
  KEY `USER_FK_idx` (`UserID`),
  CONSTRAINT `USER_FK` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ShortList_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `Category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ShortList` */

/*Table structure for table `Skill` */

DROP TABLE IF EXISTS `Skill`;

CREATE TABLE `Skill` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IndustryID` bigint(20) unsigned NOT NULL,
  `IsActive` tinyint(4) NOT NULL DEFAULT '0',
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `Skill_Industryid_foreign` (`IndustryID`),
  CONSTRAINT `Skill_Industryid_foreign` FOREIGN KEY (`IndustryID`) REFERENCES `Industry` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `Skill` */

insert  into `Skill`(`id`,`Name`,`IndustryID`,`IsActive`,`Description`,`created_at`,`updated_at`) values (1,'Kế toán',1,1,'Good Skill','2017-02-22 17:04:39','2017-02-26 11:21:39'),(2,'Kiểm toán / Kiểm toán Cao cấp / Trợ lý Kiểm toán',1,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(3,'Quản lý Tài chính Cao cấp',1,1,'Good Skill','2017-02-22 17:04:39','2017-02-26 12:48:40'),(5,'Lương / Nợ / Thuế',1,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(6,'Kỹ năng Hành chính',2,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(7,'Gọi khách hàng / Trả lời điện thoại',2,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(8,'Appointment Setting ',2,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(9,'Cán bộ quản lý nhập dữ liệu',2,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(10,'Quản trị thương hiệu',3,1,'Good Skill','2017-02-22 17:04:39','2017-02-26 12:46:48'),(11,'Quản lý Tiếp thị',3,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(12,'Phát triển kinh doanh',3,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(13,'Quản trị Ngân hàng',4,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(14,'Quản lý tín dụng',4,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(15,'Cố vấn tài chính',4,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(16,'Điều phối viên giám sát và đánh giá',5,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(17,'Xây dựng',5,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(18,'Thợ mộc',5,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(19,'Lắp đặt điện',5,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(20,'Hệ thống nước',5,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(21,'Chuyên viên Hỗ trợ CNTT',6,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(22,'Nhà phát triển cơ sở dữ liệu',6,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(23,'Kỹ sư máy tính để bàn',6,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(24,'Nhà phát triển',6,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(25,'Quản trị Khách hàng',7,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(26,'Quản lý Dịch vụ Khách hàng',7,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(27,'Tiếp tân',7,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(28,'Adobe Illustrator',8,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(29,'Adobe Photoshop',8,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(30,'Kiến trúc',8,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(31,'Thiết kế',8,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(32,'Thiết kế đồ họa',8,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(33,'Thiết kế nội thất',8,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(35,'Education Officer  ',9,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(36,'Giáo viên',9,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(37,'Đào tạo điều hành',9,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(38,'Tư vấn tuyển dụng',10,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(39,'Điều hành hoạt động',10,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(40,'Kỹ sư dịch vụ',11,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(41,'Kỹ thuật hóa học',11,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(42,'Kỹ thuật điện',11,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(43,'Kĩ thuật điện tử',11,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(44,'Kỹ thuật môi trường',11,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(45,'Cơ khí / Ô tô',11,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(46,'Kỹ thuật Dầu khí',11,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(47,'Bình luận game',12,1,'Good Skill','2017-02-22 17:04:39','2017-02-26 12:31:26'),(48,'Trợ lý sản xuất truyền hình',12,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(49,'Nhạc sĩ',12,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(50,'Nghiên cứu thị trường',13,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(51,'Creative Executive',13,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(52,'Quản lý Sự kiện / Dự án',13,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(53,'Bartender',14,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(54,'Chef / Head Chef / Executive Chef',14,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(55,'Service Crew',14,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(56,'Kitchen Assistant / Kitchen Helper ',14,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(57,'F&B Supervisor / Manager',14,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(58,'Y tá',15,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(59,'Kỹ thuật viên dược',15,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(60,'Đại diện bán hàng y tế',15,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(61,'Chủ nhà / người phục vụ',16,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(62,'Quản lý đặt chỗ',16,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(63,'Giám sát Dịch vụ ăn uống',16,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(64,'Trợ lý Quản trị Nhân sự',17,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(65,'Junior Executive/Executive',18,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(66,'Bảo hiểm',18,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(67,'Nhân viên Yêu cầu',18,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(68,'Kho',19,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(69,'Cán bộ Mua / Điều hành',19,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(70,'Kỹ thuật viên bảo trì / giám sát viên',20,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(71,'Trợ lý kỹ thuật / quản lý',20,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(72,'Người hướng dẫn',21,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(74,'Điều phối viên Bán hàng / Liên kết / Điều phối viên',22,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(75,'Quản lý kinh doanh',22,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(76,'Doanh số bán lẻ',22,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(77,'Thu ngân',22,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(78,'Lái xe hạng 3/4 /',23,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(79,'Nhà điều hành sản xuất',23,1,'Good Skill','2017-02-22 17:04:39','2017-02-22 17:04:55'),(80,'Phân phát tờ Flyer',23,1,'','2017-02-26 10:27:38','2017-02-26 10:27:38'),(81,'Nhân viên an ninh',23,1,'','2017-02-26 10:27:55','2017-02-26 10:27:55'),(82,'Người dọn dẹp',23,1,'','2017-02-26 10:28:14','2017-02-26 10:28:14'),(83,'Công nhân nói chung',23,1,'','2017-02-26 10:28:26','2017-02-26 10:28:26'),(84,'Đảm bảo chất lượng',23,1,'','2017-02-26 10:28:37','2017-02-26 10:28:37'),(85,'Người đóng hàng hóa',23,1,'','2017-02-26 10:28:50','2017-02-26 10:28:50'),(86,'Trợ lý sản xuất',23,1,'','2017-02-26 10:29:00','2017-02-26 10:29:00'),(87,'Nhà sản xuất',23,1,'','2017-02-26 10:29:16','2017-02-26 10:29:16'),(88,'Lái xe cá nhân',23,1,'','2017-02-26 10:29:27','2017-02-26 10:29:27'),(89,'Giao hàng kiêm trợ lý',23,1,'','2017-02-26 10:29:39','2017-02-26 10:29:39'),(90,'Lái xe hạng 4',23,1,'','2017-02-26 10:29:56','2017-02-26 10:29:56'),(91,'Lái xe hạng 3',23,1,'','2017-02-26 10:30:10','2017-02-26 10:30:10'),(92,'Rửa Xe',23,1,'','2017-02-26 10:30:21','2017-02-26 10:30:21'),(93,'Trợ lý / kỹ thuật viên lắp ráp',23,1,'','2017-02-26 10:30:32','2017-02-26 10:30:32'),(94,'Tóc thời trang',21,1,'','2017-02-26 10:31:34','2017-02-26 10:31:34'),(95,'Người giữ kho ',19,1,'','2017-02-26 10:32:41','2017-02-26 10:32:41'),(96,'Junior Executive / Executive',18,1,'','2017-02-26 10:33:31','2017-02-26 10:33:31'),(97,'Quản lý nhân sự',17,1,'','2017-02-26 11:10:06','2017-02-26 11:10:06'),(99,'Nhân sự & Quản trị',17,1,'','2017-02-26 12:23:11','2017-02-26 12:23:11'),(100,'Nấu ăn',14,1,'','2017-02-26 12:26:03','2017-02-26 12:26:03'),(101,'Người ủng hộ',13,1,'','2017-02-26 12:26:20','2017-02-26 12:26:20'),(102,'Sự kiện Roadshow',13,1,'','2017-02-26 12:27:20','2017-02-26 12:27:20'),(103,'Giám đốc phát triển kinh doanh',10,1,'','2017-02-26 12:32:55','2017-02-26 12:32:55'),(104,'Giáo viên',9,1,'','2017-02-26 12:33:30','2017-02-26 12:33:30'),(105,'Quản trị Thương hiệu Cao cấp',3,1,'','2017-02-26 12:46:59','2017-02-26 12:46:59'),(106,'Quản lý tài chính',1,1,'','2017-02-26 12:49:01','2017-02-26 12:49:01');

/*Table structure for table `Term` */

DROP TABLE IF EXISTS `Term`;

CREATE TABLE `Term` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) DEFAULT NULL,
  `Description` mediumtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `Term` */

insert  into `Term`(`id`,`Title`,`Description`,`created_at`,`updated_at`) values (4,'Chung','Trang web này ???c s? h?u và ?i?u hành b?i JobNow.Com. Vi?c b?n s? d?ng trang web này và thông tin bên trong s? ph?i tuân theo các ?i?u kho?n và ?i?u ki?n ???c ?? c?p ? ?ây. B?ng cách truy c?p và s? d?ng trang web này, chúng tôi th?a nh?n r?ng b?n ?ã ??c, hi?u và ??ng ý v?i các ?i?u kho?n và ?i?u ki?n sau.','2017-05-06 10:23:36','2017-03-31 07:15:02'),(5,'B?o v? d? li?u','Trong khi JobNow th?c hi?n t?t c? các bi?n pháp h?p lý ?? ??m b?o tính b?o m?t và b?o v? d? li?u ???c g?i b?i ng??i dùng ?ã ??ng ký c?a chúng tôi, chúng tôi không cung c?p b?t k? b?o ??m nào v? tính bí m?t c?a thông tin do b?n g?i.\r\nChúng tôi không chia s?, ti?t l?, ho?c phân ph?i thông tin nh?n d?ng cá nhân do ng??i dùng g?i cho bên th? ba. Tuy nhiên, JobNow có th? g?i cho b?n b?n tin và tài li?u qu?ng cáo khác cho b?n n?u b?n cho phép chúng tôi làm nh? v?y khi ??ng ký d??i d?ng ng??i dùng.','2017-05-06 10:24:01','2017-02-17 18:40:35'),(6,'S? d?ng Website','Thông tin ???c xu?t b?n trên trang web ???c cung c?p v?i m?c ?ích duy nh?t là giúp ?? nh?ng ng??i tìm ki?m vi?c làm tìm ki?m c? h?i ngh? nghi?p t?t và ?? giúp các nhà tuy?n d?ng tuy?n d?ng nh?ng cá nhân tài n?ng. Không th? in, s? d?ng và / ho?c t?i xu?ng thông tin này cho b?t k? m?c ?ích cá nhân ho?c th??ng m?i nào ngoài m?c ?ích này.\r\nB?ng cách truy c?p và s? d?ng trang web và d?ch v? c?a chúng tôi, b?n c?ng ??ng ý r?ng b?n s? không sao chép, phân ph?i ho?c chuy?n t?i b?t k? tài li?u nào ???c xu?t b?n trên trang web mà không có s? ch?p thu?n tr??c b?ng v?n b?n c?a công ty. N?u b?n b? phát hi?n vi ph?m các quy t?c này, công ty có th? ch?m d?t ??ng ký c?a b?n ngay l?p t?c mà không g?i cho b?n thông báo tr??c và / ho?c ?? ngh? b?n hoàn l?i ti?n.\r\nT?t c? các tài li?u, bao g?m n?i dung v?n b?n, ?? h?a, bi?u tr?ng, nhãn hi?u, ph?n m?m, vv là tài s?n c?a JobNow.Com ho?c các ??i tác kinh doanh c?a nó. Vi?c b?n s? d?ng trang web không cung c?p cho b?n b?t k? lo?i quy?n nào ??i v?i các tài li?u này.','2017-05-06 10:24:36','2017-02-17 18:40:49'),(7,'H? s? xin vi?c và qu?ng cáo vi?c làm','Các h? s? xin vi?c và qu?ng cáo vi?c làm là m?t ph?n c?a c? s? d? li?u c?a JobNow ???c cung c?p b?i các ?ng c? viên và công ty và không ???c các chuyên gia c?a chúng tôi xem xét l?i. Vì v?y, chúng tôi không cung c?p b?t k? b?o ??m nào v? tính chính xác và / ho?c ??y ?? c?a thông tin ???c xu?t b?n trên trang web c?a chúng tôi và không ch?p nh?n b?t k? trách nhi?m nào ??i v?i nh?ng thi?t h?i x?y ra do vi?c s? d?ng các thông tin ?ó. B?n nên ti?n hành quá trình xác minh ?? tránh b?t k? trách nhi?m pháp lý ho?c thi?t h?i nào.','2017-05-06 10:25:00','2017-02-17 18:41:05'),(8,'Tính s?n có c?a d?ch v?','D?ch v? c?a JobNow có s?n ? các c? s? \"theo nguyên t?c\" và \"s?n có\". Chúng tôi không cung c?p cho b?n b?t k? b?o ??m nào r?ng d?ch v? s? ???c cung c?p cho b?n m?t cách nh?t quán, không b? gián ?o?n và không ch?p nh?n b?t k? trách nhi?m ??i v?i thi?t h?i phát sinh do gián ?o?n ho?c s? ch?m tr? trong các d?ch v?.','2017-05-06 10:25:48','2017-02-17 18:41:19');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IsCompany` tinyint(4) NOT NULL,
  `IsEmailConfirmed` tinyint(4) NOT NULL DEFAULT '0',
  `Password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `PasswordSalt` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `fb_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `IsTrial` tinyint(4) DEFAULT '1' COMMENT '0:đăng ký rồi,1:chưa đăng ký',
  `CreditNumber` float DEFAULT '1',
  `TokenFirebase` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`Username`,`Email`,`IsCompany`,`IsEmailConfirmed`,`Password`,`PasswordSalt`,`fb_id`,`google_id`,`remember_token`,`created_at`,`updated_at`,`Phone`,`IsTrial`,`CreditNumber`,`TokenFirebase`) values (2,'','admin_JobSeeker',2,0,'$2y$10$BdBbjX61pPhbACRgn9ExTe2XAfTH1Z9A9VOoU6/RQ0ZeayxUr6pMi','','','',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','',1,1,NULL),(3,'admin','admin@Jobnow.com.sg',2,0,'$2y$10$w5Eqf6iXsrLduz1ctHve6OTTnzRQMuox98QK9hRpGPLPAaYEPStom','','','','GY5f76GVlog4aOPPBliVDVhMvnHOxvEOKWxlwuccyYGxgKYbgROd1Y2ggo0e','2016-12-12 13:25:19','2017-05-10 08:49:39','0',1,3,NULL),(4,'','iris_you3@hotmail.com',0,0,'','','1608843242476285','','z5e6NRazdQEScprsryeCCcrgTkVDGXzdjjhMlCWrnN3d4u4x3HTDA96P9uSo','2017-03-23 22:37:20','2017-03-23 22:37:20','',1,1,NULL),(5,'','duongnartist@yahoo.com',0,0,'$2y$10$X8I.xdKwaIBGhvCGP5MoEeeguBtwh/uOdcqqnNiZLf5SBDHTSq5be','','','','','2017-03-24 03:39:14','2017-03-24 03:48:08','',1,1,''),(7,'','duongnartist@outlook.com',1,0,'$2y$10$tu60atPM5qp3mHOVglEdgefsSVy.wthzsL7PMbT0S.D.Pk4nxFXs.','','','','','2017-03-24 03:44:20','2017-03-24 03:46:50','',1,1,''),(8,'','viet.ptit.18@gmail.com',1,0,'$2y$10$bTTtTYI5AyKH0u9SXXWSr.RXW6QC49Jy0.hc9qpjOM6yr6tXduXO.','','','','kor1THTEVUu2NV6uH6FywuQhHqdFQQGjmd4XTjfMux27pj5LfxhMO4dEP2Na','2017-03-24 03:58:27','2017-03-24 04:06:30','',1,0,NULL),(9,'','viet.ptit.17@gmail.com',1,0,'$2y$10$JT7rCQvc5rbjA1nHD8cPKuWwH1XtPuVQenlfDFcBRwavwVw4hVeB6','','','','TQXw6Lgzq8Q3HczjwHdRmEqVoxAyFhEk9wLrSbBXmBbDkQ9J6qjlTVQ2kIMs','2017-03-24 04:06:58','2017-03-27 10:21:05','',1,1,NULL),(10,'','pavukasekar@gmail.com',0,0,'$2y$10$.OqvUuueLvIlOzHvjw0fm.B6KCPnZGKAJOW9sOPhtiVrsAZKmK7se','','','',NULL,'2017-03-24 08:55:41','2017-03-24 08:55:41','',1,1,NULL),(11,'','mikepacumio@gmail.com',0,0,'','','173963213115476','','','2017-03-25 09:07:47','2017-03-25 10:12:02','',1,1,''),(12,'','itsninjafreak@hotmail.com',0,0,'','','1378324722189268','','mgnjdL7NmfNVh0B4A6FSU9GVL6jctXrwGjKbws0HakjkjukfROPYHyxnLfpT','2017-03-26 08:13:35','2017-03-26 08:13:35','',1,1,NULL),(13,'','scubasteveo12345@gmail.com',0,0,'','','1140653986080788','','sojhIjWOWXEaVBLRftUuzOgxLC3t7E921GZeJDzWmyjy8nQHe7FlVt4MowSk','2017-03-26 16:32:38','2017-03-26 16:32:38','',1,1,'e1aeUnO1q8g:APA91bF-APYAwwnUTZWIcssynQEM0eb_9Nvz6Nbi5sC7N7QQtoRDEozyXF9IMY4mvJUWDhqyLk8eULMsLJQ8KJ4PrnOaWkzukipvjXKKehCULL8UeU3PgHVNAcIC6Cb5cUg836ucTMDT'),(15,'','capriciousladys@gmail.com',0,0,'','','1289509997804171','','AdxI0qgKUey68y5Zqzlrc2EM1kqNhBKLzUF9GVPIGkXlCsnsP8uuz29YFySW','2017-03-27 20:28:45','2017-03-27 20:28:45','',1,1,'cs3l7GbsIpg:APA91bEVlxQJ0H9f_lWzLN6yj2GXEvhhIdnl69gIa1yjy8AYcMka9jOeOqotSFUh-nILkpIdRcK2NIthij6BY2XyPk-Vg-QtkWoCA6pifwHwst_wJ1799Bn9W7bB08xMkF5-tLRBz6vc'),(16,'','milkstar01@yahoo.com',0,0,'','','1454429704632511','','','2017-03-29 08:23:11','2017-03-29 08:25:59','',1,1,''),(17,'','ronson.liberty@gmail.com',1,0,'$2y$10$vb34hhvxfFCZFle0zdTPt.fxerOVMXE1I1y52VXv.LbgxO9/Ot4Mq','','','',NULL,'2017-03-29 08:28:16','2017-03-29 08:28:16','',1,1,NULL),(18,'','ikin_anamuslim@yahoo.com',0,0,'','','1602908196405096','','Nje6jcQclkmzaA7dmf2PwJmh7Zq7yYUtg8B7FMVpTiDqhcobHfRdTqjO1BpF','2017-03-29 10:32:31','2017-03-29 10:32:31','',1,1,'d_fSt8C9Zz8:APA91bFCywGn7t2RX8j8TH_buhhRTxJxVUCCUuMbZh4mqHcIWXaSNJMdW8oZdr0XN0KoEumSGSpdSOyih_Dxn3B1hblyB_rJzhBwFKITqn_Hr06qeZFdYP8DnDgvvjN2C0MN-9U0mvoM');

/* Function  structure for function  `checkAppliedJob` */

/*!50003 DROP FUNCTION IF EXISTS `checkAppliedJob` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `checkAppliedJob`(
	JobSeekerID BIGINT(20),
    CompanyID BIGINT(20)
) RETURNS int(11)
BEGIN
	DECLARE result BIGINT(20);
	SET result =(SELECT ab.id FROM AppliedJob ab 
    INNER JOIN Job Job ON Job.id = ab.JobID
    WHERE Job.CompanyID = CompanyID AND ab.JobSeekerID = JobSeekerID LIMIT 1);
    IF result > 0 THEN
		RETURN result;
	ELSE 
		RETURN 0;
	END IF;
END */$$
DELIMITER ;

/* Function  structure for function  `func_checkAddedShortList` */

/*!50003 DROP FUNCTION IF EXISTS `func_checkAddedShortList` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `func_checkAddedShortList`(
	CategoryID BIGINT(20),
    UserID BIGINT(20)
) RETURNS int(11)
BEGIN
	RETURN (SELECT sh.id FROM ShortList sh WHERE sh.CategoryID = CategoryID AND sh.UserID = UserID LIMIT 1);
END */$$
DELIMITER ;

/* Function  structure for function  `func_checkAddedShortListWeb` */

/*!50003 DROP FUNCTION IF EXISTS `func_checkAddedShortListWeb` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `func_checkAddedShortListWeb`(
	CategoryID BIGINT(20),
	UserID BIGINT(20),
	JobID BIGINT(20)
) RETURNS int(11)
BEGIN
	RETURN (SELECT sh.id FROM ShortList sh WHERE sh.CategoryID = CategoryID AND sh.UserID = UserID and sh.JobID = JobID LIMIT 1);
END */$$
DELIMITER ;

/* Function  structure for function  `func_GetNumberOfShortList` */

/*!50003 DROP FUNCTION IF EXISTS `func_GetNumberOfShortList` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `func_GetNumberOfShortList`(
	CategoryID_ BIGINT(20)
) RETURNS int(11)
BEGIN
RETURN (SELECT count(id) FROM ShortList WHERE CategoryID = CategoryID_ );
END */$$
DELIMITER ;

/* Function  structure for function  `func_setTime` */

/*!50003 DROP FUNCTION IF EXISTS `func_setTime` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `func_setTime`(
	day_check VARCHAR(50),
    hour_check VARCHAR(50)
) RETURNS int(11)
BEGIN
	DECLARE result BIGINT(20);
    SET result = UNIX_TIMESTAMP(CONCAT(SUBSTRING(day_check,1,11),STR_TO_DATE(hour_check, '%l:%i %p')));
    
RETURN result;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_getCategoryByCompanyID` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_getCategoryByCompanyID` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getCategoryByCompanyID`(
	IN CompanyID BIGINT(20)
)
BEGIN
	SELECT c.*,IFNULL(func_GetNumberOfShortList(id),0) as number_ShortList FROM Category c WHERE c.CompanyID = CompanyID ORDER BY c.id DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_getCompanyProfile` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_getCompanyProfile` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getCompanyProfile`(
	IN CompanyID BIGINT(20)
)
BEGIN
	SELECT cp.*,u.Email,cs.Name as CompanySizeName,ind.Name as IndustryName FROM users u
    INNER JOIN CompanyProfile cp ON cp.CompanyID = u.id
    INNER JOIN CompanySize cs ON cs.id = cp.CompanySizeID
    INNER JOIN CompanyIndustry ci ON ci.CompanyID = CompanyID
    INNER JOIN Industry ind ON ind.id = ci.IndustryID
    WHERE u.id = CompanyID;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_getDetailInterview` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_getDetailInterview` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getDetailInterview`(
	IN InterviewID BIGINT(20)
)
BEGIN
	SELECT inter.*,cp.Name as CompanyName,cp.Logo as CompanyAvatar,u.Email as CompanyEmail,
		func_setTime(inter.InterviewDate,inter.End_time) as InterviewDate_int
		FROM Interview inter 		
        INNER JOIN CompanyProfile cp ON cp.CompanyID = inter.CompanyID
        INNER JOIN users u ON u.id = inter.CompanyID 
		WHERE inter.id = InterviewID;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_getListInterview` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_getListInterview` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getListInterview`(
	IN CompanyID BIGINT(20),
    IN JobSeekerID BIGINT(20)
)
BEGIN
	IF CompanyID <> 0 THEN
		SELECT inter.*,Job.Avatar,Job.FullName,coun.Name as CountryName,
		func_setTime(inter.InterviewDate,inter.End_time) as InterviewDate_int,u.Email
		FROM Interview inter 
		INNER JOIN JobSeeker Job ON Job.user_id = inter.JobSeekerID
        INNER JOIN users u ON u.id = inter.JobSeekerID 
		LEFT JOIN Country coun ON coun.id = Job.CountryID        
		WHERE inter.CompanyID = CompanyID AND inter.IsDeleteCompany = 0 AND inter.Status <> 4
        GROUP BY inter.id
		ORDER BY inter.id DESC;
	ELSE 
		SELECT inter.*,Job.Avatar,Job.FullName,coun.Name as CountryName,cp.Name as CompanyName,cp.Logo as CompanyAvatar,u.Email as CompanyEmail,
		func_setTime(inter.InterviewDate,inter.End_time) as InterviewDate_int
		FROM Interview inter 
		INNER JOIN JobSeeker Job ON Job.user_id = inter.JobSeekerID
		LEFT JOIN Country coun ON coun.id = Job.CountryID
        INNER JOIN CompanyProfile cp ON cp.CompanyID = inter.CompanyID
        INNER JOIN users u ON u.id = inter.CompanyID 
		WHERE inter.JobSeekerID = JobSeekerID AND inter.IsDeleteJobSeeker = 0 AND inter.Status <> 4         
		ORDER BY inter.id DESC;
	END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_getShortList` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_getShortList` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getShortList`(
    IN CategoryID BIGINT(20)
)
BEGIN
	
    DECLARE CompanyID BIGINT(20);
	SET CompanyID = (SELECT sh1.CompanyID FROM Category sh1 WHERE sh1.id = CategoryID LIMIT 1);
    
	SELECT sh.*,ca.CompanyID,Job.*  FROM ShortList sh 
    INNER JOIN Category ca ON ca.id = sh.CategoryID
    INNER JOIN JobSeeker Job ON Job.user_id = sh.UserID
    
    WHERE sh.CategoryID = CategoryID;
	#INNER JOIN Notification noti ON noti.JobSeekerID = sh.UserID
    #INNER JOIN Job Job ON Job.id = noti.JobID
    #WHERE noti.CompanyID = CompanyID AND noti.isCompany = 1 AND noti.JobID <> 0 AND sh.CategoryID = CategoryID
    #GROUP BY noti.JobID ;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_searchEmployee` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_searchEmployee` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_searchEmployee`(
	IN FullName VARCHAR(255),
    IN CategoryID BIGINT(20),
    IN CompanyID BIGINT(20)
)
BEGIN
	IF CompanyID = 0 THEN
		SELECT Job.*,coun.*,IFNULL(func_checkAddedShortList(CategoryID,Job.user_id),0) as is_added
		FROM JobSeeker Job
		INNER JOIN Country coun ON coun.ID = Job.CountryID
		WHERE Job.FullName like CONCAT('%',FullName ,'%');
	ELSE 
		SELECT Job.*,coun.*,IFNULL(func_checkAddedShortList(CategoryID,Job.user_id),0) as is_added
		FROM JobSeeker Job
		INNER JOIN Country coun ON coun.ID = Job.CountryID
		WHERE Job.FullName like CONCAT('%',FullName ,'%') AND checkAppliedJob(Job.user_id,CompanyID) > 0 GROUP BY Job.user_id;
	END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_searchEmployeeWeb` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_searchEmployeeWeb` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_searchEmployeeWeb`(
	IN FullName VARCHAR(255),
	IN CompanyID BIGINT(20)	
)
BEGIN
	select `JobSeeker`.`Avatar`,`Notification`.`JobID`,`JobSeeker`.`FullName`,`JobSeeker`.`user_id`,`Notification`.`InterviewID`,`Notification`.`created_at`,`Job`.`Title`,`Country`.`Name`
	from `Notification`	
	inner join `JobSeeker` on `JobSeeker`.`user_id` = `Notification`.`JobSeekerID`
	inner Join `Country` on `Country`.`id` = `JobSeeker`.`CountryID`
	inner join `Job` on `Job`.`id` = `Notification`.`JobID`
	WHERE `Notification`.`CompanyID` = `CompanyID` AND `Notification`.`isCompany` = 1 AND `Notification`.`JobID` > 0
	And `JobSeeker`.`FullName` LIKE CONCAT('%',FullName ,'%');
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
