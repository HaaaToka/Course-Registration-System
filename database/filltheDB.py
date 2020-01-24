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
fillGraduation(DB)





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