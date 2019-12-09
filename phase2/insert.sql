INSERT INTO `Class` VALUES (1,1,2019,'Fall'),(2,1,2019,'Spring'),(3,2,2018,'Spring'),(4,3,2020,'Spring'),(5,3,2019,'Fall'),(6,2,2016,'Spring'),(7,3,2017,'Fall'),(8,4,2017,'Summer'),(9,1,2015,'Fall'),(10,1,2016,'Winter');

INSERT INTO `Course` VALUES (1,'BBM101',5,1),(2,'FUT101',10,2),(3,'BBM201',10,1),(4,'ELE101',6,7),(5,'ELE102',5,10),(6,'BES101',1,3),(7,'BBM471',10,1),(8,'BBM371',7,1),(9,'BBM301',5,1),(10,'ASD123',4,4);

INSERT INTO `Department` VALUES (1,'computer','beytepe',1),(2,'futbol','sihhiye',2),(3,'chemistery','beytepe',1),(4,'turkce','beytepe',5),(5,'ingiliz dil ve tarih','beytepe',4),(6,'fransizca','beytepe',3),(7,'bote','sihhiye',3),(8,'endustri tasarimi','sihhiye',6),(9,'ucak teknisyeni','sincan',6),(10,'electric','beytepe',1);

INSERT INTO `Faculty` VALUES (1,'ENGINEERING'),(2,'sport'),(3,'ydyo'),(4,'edebiyat'),(5,'egitim'),(6,'myo'),(7,'faculty7'),(8,'faculty8'),(9,'faculty9'),(10,'faculty10');

INSERT INTO `Instructor` VALUES (1,'engin','demir',1),(2,'engin','altin',2),(3,'nuray','esendemir',3),(4,'ogr1','ogr11',7),(5,'ogr4','ogr44',9),(6,'ogr5','ogr55',8),(7,'ogr6','ogr66',2),(8,'ogr7','ogr77',4),(9,'ogr8','ogr88',5),(10,'ogr9','ogr99',1),(11,'ogr10','ogr1010',1);

INSERT INTO `InstructorGivesCourse` VALUES (1,1,1),(2,1,2),(3,1,1),(2,3,1),(1,4,1),(2,4,2),(3,4,1),(3,4,2),(2,5,2),(2,6,2);

INSERT INTO `PrerequisiteCourses` VALUES (2,1),(5,1),(6,1),(3,2),(6,2),(7,2),(4,3),(5,3),(7,3),(6,4),(8,4);

INSERT INTO `Section` VALUES (1,1,48,'Beytepe','Monday','10:00:00','12:00:00','','00:00:00','00:00:00','','00:00:00','00:00:00'),(1,2,18,'Beytepe','Friday','12:00:00','15:00:00','','00:00:00','00:00:00','','00:00:00','00:00:00'),(1,3,19,'yildizAmfi','Tuesday','17:00:00','19:30:00','','00:00:00','00:00:00','','00:00:00','00:00:00'),(1,4,98,'beytepe','Wednesday','09:00:00','12:00:00','Friday','12:00:00','15:00:00','','00:00:00','00:00:00'),(1,5,-1,'d2','Monday','13:00:00','15:00:00','Monday','16:00:00','17:00:00','Monday','18:00:00','20:00:00'),(1,6,1,'d2','Friday','13:00:00','15:00:00','Friday','16:00:00','17:00:00','Friday','18:00:00','20:00:00'),(2,1,50,'Beytepe','Monday','10:00:00','12:00:00','','00:00:00','00:00:00','','00:00:00','00:00:00'),(2,2,1,'d1','Monday','13:00:00','15:00:00','Monday','16:00:00','17:00:00','Monday','18:00:00','20:00:00'),(2,4,1,'d2','Monday','13:00:00','15:00:00','Monday','16:00:00','17:00:00','Monday','18:00:00','20:00:00'),(2,5,1,'d2','Monday','13:00:00','15:00:00','Monday','16:00:00','17:00:00','Monday','18:00:00','20:00:00'),(2,6,1,'d2','Friday','13:00:00','15:00:00','Friday','16:00:00','17:00:00','Friday','18:00:00','20:00:00');

INSERT INTO `Student` VALUES (1,'kaan','mersin',60,2015,1),(2,'meric','celik',60,2016,2),(3,'okan','alan',100,2015,1),(4,'emre','kocan',10,2018,2),(5,'batuhan','mete',78,2017,5),(6,'bilge','cimen',45,2014,4),(7,'oguz','bakir',45,2016,3),(8,'baran','burasli',55,2015,1),(9,'onur fatih','demir',75,2017,6),(10,'akif','baysal',34,2018,5);

INSERT INTO `StudentHasGradedClass` VALUES (1,1,'A1'),(1,2,'A1'),(1,3,'A1'),(1,4,'A1'),(1,5,'A1'),(1,6,'A1'),(1,7,'A1'),(2,1,'A1'),(3,1,'A1'),(4,1,'A1');

INSERT INTO `StudentTakenCourse` VALUES (1,1,1),(2,1,1),(1,2,1),(2,2,1),(1,3,1),(2,3,1),(1,4,1),(2,4,1),(1,5,1),(2,5,1);
