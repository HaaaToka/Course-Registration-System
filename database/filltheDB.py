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
instructor2klass(DB)




DB.close()