INSERT INTO etairia VALUES 
('E001','Toyota','Japan','123456789'),
('E002','Ford','USA','987654321'),
('E003','BMW','Germany','456789123'),
('E004','Honda','Japan','852369741'),
('E005','Mercedes','Germany','741852963');

INSERT INTO thlefono_etairias VALUES
('2100000001','E001'),
('2100000002','E002'),
('2100000003','E003'),
('2100000004','E004'),
('2100000005','E005');

INSERT INTO montelo VALUES
('M001','Corolla','E001'),
('M002','Yaris','E001'),
('M003','Mustang','E002'),
('M004','Focus','E002'),
('M005','X5','E003'),
('M006','320i','E003'),
('M007','Civic','E004'),
('M008','Accord','E004'),
('M009','C200','E005'),
('M010','E350','E005');

INSERT INTO autokinhto VALUES
('VIN00000000000001','M001','ENG001','2018','Benzine',1600,'Manual',45000,'Red',15000,'poulhmeno'),
('VIN00000000000002','M002','ENG002','2020','Hybrid',1500,'Automatic',20000,'Blue',18000,'dia8eshmo'),
('VIN00000000000003','M003','ENG003','2019','Benzine',5000,'Manual',35000,'Black',35000,'poulhmeno'),
('VIN00000000000004','M004','ENG004','2017','Diesel',2000,'Automatic',60000,'White',12000,'poulhmeno'),
('VIN00000000000005','M005','ENG005','2021','Diesel',3000,'Automatic',15000,'Silver',55000,'poulhmeno'),
('VIN00000000000006','M006','ENG006','2016','Benzine',2000,'Manual',80000,'Gray',17000,'dia8eshmo'),
('VIN00000000000007','M007','ENG007','2018','Hybrid',1800,'Automatic',30000,'Blue',20000,'dia8eshmo'),
('VIN00000000000008','M008','ENG008','2019','Benzine',2000,'Manual',25000,'Black',22000,'dia8eshmo'),
('VIN00000000000009','M009','ENG009','2020','Diesel',2200,'Automatic',10000,'White',42000,'poulhmeno'),
('VIN00000000000010','M010','ENG010','2022','Hybrid',2500,'Automatic',5000,'Gray',60000,'dia8eshmo');

INSERT INTO pelates VALUES
('100000001','Giannis','Papadopoulos','giannis@mail.com','6900000001','6901000001'),
('100000002','Maria','Nikolaou','maria@mail.com','6900000002',''),
('100000003','Kostas','Georgiou','kostas@mail.com','6900000003',''),
('100000004','Eleni','Dimitriou','eleni@mail.com','6900000004','6901000004'),
('100000005','Petros','Ioannou','petros@mail.com','6900000005',''),
('100000006','Nikos','Christou','nikos@mail.com','6900000006','6901000006'),
('100000007','Anna','Petsi','anna@mail.com','6900000007',''),
('100000008','Sofia','Kola','sofia@mail.com','6900000008','6901000008'),
('100000009','Dimitris','Raptis','dimitris@mail.com','6900000009',''),
('100000010','Olga','Markou','olga@mail.com','6900000010','');

INSERT INTO upallhloi VALUES
('U001','Giorgos','Papas','2101111111',NULL,'2020-01-10','poliths'),
('U002','Katerina','Loizou','2101111112','2102222222','2021-03-12','poliths'),
('U003','Markos','Stathis','2101111113',NULL,'2019-05-20','mhxanikos'),
('U004','Dionysis','Karas','2101111114',NULL,'2022-07-15','mhxanikos'),
('U005','Eirini','Lada','2101111115',NULL,'2018-12-03','manager'),
('U006','Giota','Manou','2101111116',NULL,'2023-04-09','ka8arisths');

INSERT INTO poliseis VALUES
('P00000000000001','2023-01-10',16000,'VIN00000000000001','100000001','U001'),
('P00000000000002','2023-02-15',35000,'VIN00000000000003','100000003','U002'),
('P00000000000003','2023-03-01',12000,'VIN00000000000004','100000004','U001'),
('P00000000000004','2023-04-20',55000,'VIN00000000000005','100000005','U002'),
('P00000000000005','2023-05-10',42000,'VIN00000000000009','100000006','U001');

INSERT INTO syntirish VALUES
('S00000000000001','2023-01-05','Allagi elaiwn','U003','ΙΒΧ1234','oloklhrw8hke'),
('S00000000000002','2023-01-25','Elegxos frenwn','U004','KYZ5678','oloklhrw8hke'),
('S00000000000003','2023-02-10','Service 20.000km','U003','XKP2345','ekremh'),
('S00000000000004','2023-03-18','Allagi batarias','U004','MAZ8901','akurw8hke'),
('S00000000000005','2023-04-22','Elegxos klima','U003','PNO3456','oloklhrw8hke');

INSERT INTO login VALUES
('admin','admin123','True'),
('user1','pass1','False'),
('user2','pass2','False'),
('manager','boss123','True'),
('tech','service1','False');