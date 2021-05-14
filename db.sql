/*
SQLyog Ultimate v8.55 
MySQL - 5.5.16 : Database - sales
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sales` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sales`;

/*Table structure for table `dtfr` */

DROP TABLE IF EXISTS `dtfr`;

CREATE TABLE `dtfr` (
  `Nofak` varchar(10) DEFAULT NULL,
  `Kdbrg` varchar(4) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `discn` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dtfr` */

insert  into `dtfr`(`Nofak`,`Kdbrg`,`qty`,`harga`,`discn`) values ('FAK1910001','0001',1,10000,'1000'),('FAK1910001','0002',1,20000,'0'),('FAK1910002','0001',2,10000,'1000'),('FAK1910003','0001',3,10000,'1000'),('FAK1910003','0002',1,20000,'0');

/*Table structure for table `hdfr` */

DROP TABLE IF EXISTS `hdfr`;

CREATE TABLE `hdfr` (
  `Nofak` varchar(10) NOT NULL,
  `Tgfak` date DEFAULT NULL,
  `Ttlfak` double DEFAULT NULL,
  PRIMARY KEY (`Nofak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `hdfr` */

insert  into `hdfr`(`Nofak`,`Tgfak`,`Ttlfak`) values ('FAK1910001','2019-10-17',29000),('FAK1910002','2019-10-15',18000),('FAK1910003','2019-10-17',47000);

/*Table structure for table `mbrg` */

DROP TABLE IF EXISTS `mbrg`;

CREATE TABLE `mbrg` (
  `KDBRG` varchar(4) NOT NULL,
  `NMBRG` varchar(20) DEFAULT NULL,
  `KEMAS` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`KDBRG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mbrg` */

insert  into `mbrg`(`KDBRG`,`NMBRG`,`KEMAS`) values ('0001','BARANG1','1 KG'),('0002','BARANG2','5 KG'),('0003','BARANG3','10 KG'),('0004','BARANG4','30 KG');

/*Table structure for table `mdis` */

DROP TABLE IF EXISTS `mdis`;

CREATE TABLE `mdis` (
  `KDBRG` varchar(4) NOT NULL,
  `DISCN` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`KDBRG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mdis` */

insert  into `mdis`(`KDBRG`,`DISCN`) values ('0001','10.00'),('0002','0.00'),('0003','2.50'),('0004','5.00');

/*Table structure for table `mhrg` */

DROP TABLE IF EXISTS `mhrg`;

CREATE TABLE `mhrg` (
  `KDBRG` varchar(4) NOT NULL,
  `HARGA` double DEFAULT NULL,
  PRIMARY KEY (`KDBRG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mhrg` */

insert  into `mhrg`(`KDBRG`,`HARGA`) values ('0001',10000),('0002',20000),('0003',30000),('0004',40000);

/*Table structure for table `ttmp` */

DROP TABLE IF EXISTS `ttmp`;

CREATE TABLE `ttmp` (
  `Kdbrg` varchar(4) DEFAULT NULL,
  `Nmbrg` varchar(20) DEFAULT NULL,
  `Kemas` varchar(5) DEFAULT NULL,
  `Qty` int(11) DEFAULT NULL,
  `Harga` double DEFAULT NULL,
  `Discn` decimal(10,0) DEFAULT NULL,
  `HrgDisc` decimal(10,0) DEFAULT NULL,
  `Total` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ttmp` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(11) NOT NULL,
  `pwd` varchar(11) DEFAULT NULL,
  `level` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`pwd`,`level`) values (1,'Admin','12345','Administrator');

/*Table structure for table `vw_barang` */

DROP TABLE IF EXISTS `vw_barang`;

/*!50001 DROP VIEW IF EXISTS `vw_barang` */;
/*!50001 DROP TABLE IF EXISTS `vw_barang` */;

/*!50001 CREATE TABLE  `vw_barang`(
 `KDBRG` varchar(4) ,
 `NMBRG` varchar(20) ,
 `KEMAS` varchar(5) ,
 `HARGA` double ,
 `DISCN` decimal(10,2) 
)*/;

/*Table structure for table `vw_sales` */

DROP TABLE IF EXISTS `vw_sales`;

/*!50001 DROP VIEW IF EXISTS `vw_sales` */;
/*!50001 DROP TABLE IF EXISTS `vw_sales` */;

/*!50001 CREATE TABLE  `vw_sales`(
 `Nofak` varchar(10) ,
 `Tgfak` date ,
 `NMBRG` varchar(20) ,
 `qty` int(11) ,
 `HARGA` double ,
 `discn` decimal(10,0) ,
 `SubTotal` double ,
 `Ttlfak` double 
)*/;

/*View structure for view vw_barang */

/*!50001 DROP TABLE IF EXISTS `vw_barang` */;
/*!50001 DROP VIEW IF EXISTS `vw_barang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_barang` AS (select `a0`.`KDBRG` AS `KDBRG`,`a0`.`NMBRG` AS `NMBRG`,`a0`.`KEMAS` AS `KEMAS`,`b0`.`HARGA` AS `HARGA`,`c0`.`DISCN` AS `DISCN` from ((`mbrg` `a0` left join `mhrg` `b0` on((`b0`.`KDBRG` = `a0`.`KDBRG`))) left join `mdis` `c0` on((`c0`.`KDBRG` = `a0`.`KDBRG`)))) */;

/*View structure for view vw_sales */

/*!50001 DROP TABLE IF EXISTS `vw_sales` */;
/*!50001 DROP VIEW IF EXISTS `vw_sales` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_sales` AS (select `a0`.`Nofak` AS `Nofak`,`a0`.`Tgfak` AS `Tgfak`,`c0`.`NMBRG` AS `NMBRG`,`b0`.`qty` AS `qty`,`c0`.`HARGA` AS `HARGA`,`b0`.`discn` AS `discn`,((`c0`.`HARGA` - `b0`.`discn`) * `b0`.`qty`) AS `SubTotal`,`a0`.`Ttlfak` AS `Ttlfak` from ((`hdfr` `a0` left join `dtfr` `b0` on((`b0`.`Nofak` = `a0`.`Nofak`))) left join `vw_barang` `c0` on((`c0`.`KDBRG` = `b0`.`Kdbrg`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
