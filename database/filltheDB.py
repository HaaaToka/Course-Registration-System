import pymysql
from collections import defaultdict
from functions import *


tables = ['StudentHasGradedClass', 'StudentTakenCourse', 'InstructorGivesCourse', 'Section','Class','PrerequisiteCourses', 'Course', 'Student', 'Instructor','Department', 'Faculty']


DB = pymysql.connect(host='167.71.66.201',
                     user='kole',
                     password='Scrool12*',
                     db='471DB')

# fac_dep = generateFacDep()
# truncateAllTables(tables)
# insertFacDep(fac_dep)
# nsS=list(name_surnameStudent())
# insertStudent(DB,nsS)
# nsI = list(name_surnameInstructor())
# insertInstructor(DB,nsI)
# insertCourse(DB)
# insertClass(DB)
# insertSection(DB)
# insertPre(DB)
# csThings(DB)
# deletecs(DB)
# instructor2klass(DB)
# fillcollectedCreditsGrades(DB)
# matchStudentAdvisor(DB)
# fillGraduation(DB)
# statComp(DB)
# niws=[1004, 1005, 1006, 1007, 1008, 1009, 1010, 1011, 1012, 1013, 1014, 1015, 1016, 1017, 1018, 1019, 1020, 1021, 1022, 1023, 1024, 1025, 1026, 1027, 1028, 1029, 1030, 1031, 1032, 1033, 1034, 1035, 1036, 1037, 1038, 1039, 1040, 1041, 1042, 1043, 1044, 1045, 1046, 1047, 1048, 1049, 1050, 1051, 1052, 1053, 1054, 1055, 1056, 1057, 1058, 1059, 1060, 1061, 1062, 1063, 1064, 1065, 1066, 1067, 1068, 1069, 1070, 1071, 1072, 1073, 1074, 1075, 1076, 1077, 1078, 1079, 1080, 1081, 1082, 1083, 1084, 1085, 1086, 1087, 1088, 1089, 1090, 1091, 1092, 1093, 1094, 1095, 1096, 1097, 1098, 1099, 1100, 1101, 1102, 1103]
# gradeMe(DB,niws)

students=[1004,1113,1158,1160,1161,1281]
deleteStudent(DB,students)

# generateFakeStuComp(DB)

# revert(DB)





DB.close()


"""

/*
A1-4.00
A2-3.75
A3-3.50
B1-3.25
B2-3.00
B3-2.75
C1-2.50
C2-2.25
C3-2.00
D-1.75
F1-0
F2-0
F3-0
*/




CREATE DEFINER=`kole`@`%` TRIGGER `StudentHasGraded_AFTER_INSERT` AFTER INSERT ON `StudentHasGraded` FOR EACH ROW BEGIN
	declare courseCredit int(11);
    declare gradee float;
    
    select credit into courseCredit from Course where courseID=new.courseID;
    update Student set collectedCredits = collectedCredits + courseCredit where studentID=new.studentID;
    
    if(new.grade='A1') then
		set gradee=4.00;
	elseif(new.grade='A2')then
		set gradee=3.75;
	elseif(new.grade='A3')then
		set gradee=3.50;
	elseif(new.grade='B1')then
		set gradee=3.25;
	elseif(new.grade='B2')then
		set gradee=3.00;
	elseif(new.grade='B3')then
		set gradee=2.75;
	elseif(new.grade='C1')then
		set gradee=2.50;
	elseif(new.grade='C2')then
		set gradee=2.25;
	elseif(new.grade='C2')then
		set gradee=2.00;
	elseif(new.grade='C2')then
		set gradee=1.75;
	else
		set grade=0.00;
    end if;
    
END

"""