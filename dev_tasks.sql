/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - dev_tasks
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dev_tasks` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `dev_tasks`;

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `dateCreate` datetime DEFAULT current_timestamp(),
  `dateEdit` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order` */

insert  into `order`(`id`,`userId`,`value`,`dateCreate`,`dateEdit`) values 
(1,1,87500.00,'2026-05-12 12:55:40','2026-05-12 12:55:40'),
(2,2,46500.00,'2026-05-12 12:55:40','2026-05-12 12:55:40'),
(3,3,10500.00,'2026-05-10 12:55:40','2026-05-12 12:55:40'),
(4,4,35000.00,'2026-05-02 12:55:40','2026-05-12 12:55:40'),
(5,5,14500.00,'2026-04-22 12:55:40','2026-05-12 12:55:40'),
(6,1,4500.00,'2026-05-11 12:55:40','2026-05-12 12:55:40'),
(7,2,8000.00,'2026-05-07 12:55:40','2026-05-12 12:55:40');

/*Table structure for table `orderitem` */

DROP TABLE IF EXISTS `orderitem`;

CREATE TABLE `orderitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderId` (`orderId`),
  KEY `productId` (`productId`),
  CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`),
  CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orderitem` */

insert  into `orderitem`(`id`,`orderId`,`productId`,`value`) values 
(1,1,1,85000.00),
(2,1,2,2500.00),
(3,2,4,35000.00),
(4,2,5,8000.00),
(5,2,6,6000.00),
(6,3,2,2500.00),
(7,3,3,4500.00),
(8,3,5,8000.00),
(9,4,4,35000.00),
(10,5,3,4500.00),
(11,5,2,2500.00),
(12,5,6,6000.00),
(13,6,3,4500.00),
(14,7,5,8000.00);

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product` */

insert  into `product`(`id`,`name`,`price`) values 
(1,'Laptop',85000.00),
(2,'Miš',2500.00),
(3,'Tastatura',4500.00),
(4,'Monitor',35000.00),
(5,'Slušalice',8000.00),
(6,'Kamera',6000.00);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `dateCreate` datetime DEFAULT current_timestamp(),
  `dateEdit` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`firstname`,`lastname`,`phone`,`email`,`dateCreate`,`dateEdit`,`username`,`password`,`city`,`postal_code`,`address`) values 
(1,'Marko','Petrović','0641234567','marko@email.com','2026-05-12 12:55:40','2026-05-12 12:55:40',NULL,NULL,NULL,NULL,NULL),
(2,'Ana','Jovanović','0652345678','ana@email.com','2026-05-12 12:55:40','2026-05-12 12:55:40',NULL,NULL,NULL,NULL,NULL),
(3,'Stefan','Nikolić','0663456789','stefan@email.com','2026-05-12 12:55:40','2026-05-12 12:55:40',NULL,NULL,NULL,NULL,NULL),
(4,'Jelena','Đorđević','0674567890','jelena@email.com','2026-05-12 12:55:40','2026-05-12 12:55:40',NULL,NULL,NULL,NULL,NULL),
(5,'Nikola','Stojanović','0685678901','nikola@email.com','2026-05-12 12:55:40','2026-05-12 12:55:40',NULL,NULL,NULL,NULL,NULL),
(6,'Jovana','Milić','0641234567','jovana@email.com','2026-05-13 19:42:51','2026-05-13 19:42:51',NULL,NULL,NULL,NULL,NULL),
(8,'Pera','Perić','0661234567','pera@email.com','2026-05-13 21:00:23','2026-05-13 21:00:23','pera_peric','$2y$10$h8nGQmMW8Ee.In6Gif.sOOVe5D/M5Y4iIT9FD1U8oOlW/C8T0WcyG','Kragujevac','34000','Rudnička 5'),
(9,'Marija','Marić','0651234567','marija@gmail.com','2026-05-14 18:08:04','2026-05-14 21:02:42','maka','$2y$10$0fkmNX2EmORmiPDVcxpIjOwby/Wnz/ozKDawwHwzwHkqmEIFQNYn.','Beograd','11000','Izvorska 8'),
(10,'Anastasija','Stanić','0611234567','anastasija@email.com','2026-05-14 21:18:42','2026-05-14 21:18:42','anastasijas','$2y$10$ldorLBQXEZeY6OcGoSz57O0hIfVbVYrZausOYIQ/rURVLxX/XJbTy','Beograd','11000','Jurija Gagarina 212'),
(11,'Andrija','Ilić','0601234567','andrija@gmail.com','2026-05-14 23:37:04','2026-05-14 23:37:04','andrija','$2y$10$K5iGZbFYEWRpMfDHc5LKBOFr2K3e7piWCkegYIWGi796FzTTYHWJq','Beograd','11000','Kraljice Katarine 50');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
