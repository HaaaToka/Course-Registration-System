from itertools import product
from collections import defaultdict
from random import randint,shuffle
from string import ascii_uppercase

goodGrades=["A1","A2","A3","B1","B2","B3","C1","C2","C3","D"]
badGrades=["F1","F2","F3"]
allgradeletters=goodGrades+badGrades

def name_surnameStudent():
    txtN = """
ahmet
mehmet
aydan
emir
serbay
serhat
serkan
altuğ
çiğdem
deliha
göktay
gökhan
aslı
aydın
ayhan
hakan
volkan
mine
mina
ayça
meric
kaan
hasan
murat
    """
    txtS="""
yilmaz
acar
tosun
metrekare
santim
metre
ceg
kapak
kalem
dolma
defter
kaygı
kulak
göz
burunsuz
kör
köroğlu
kılcı
köksal
gelen
    """

    lstN = txtN.split("\n")
    lstN.pop()
    lstN.pop(0)
    lstS=txtS.split("\n")
    lstS.pop()
    lstS.pop(0)

    return product(lstN,lstS)

def insertStudent(dbCon,names):
    out=open("cikti.txt","w")
    sql = "select count(*) from Department"
    cursor = dbCon.cursor()
    cursor.execute(sql)
    countDeparment=cursor.fetchall()[0][0]
    eachCount = len(names)//countDeparment
    stuNu=[x for x in range(len(names))]
    for depid in range(1,countDeparment+1):
        for i in range(eachCount):
            rnd = randint(0,len(stuNu)-1)
            nameNu=stuNu.pop(rnd)
            sql1 = "call insertStudent('"+str(names[nameNu][0])+"','"+str(names[nameNu][1])+"',"+str(randint(2014,2019))+","+str(depid)+");"
            print(sql1,file=out)

def name_surnameInstructor():
    txtN = """
engin
nazlı
gönenç
burak
ahmet
selman
selma
selim
merve
müge
ebru
fuat
harun
kayhan
burcu
pınar
mege
aykut
erkut
lale
adnan
süleyman
sevil
necva
burcu
nebi
    """
    txtS="""
demir
altın
gümüş
bronz
yılmaz
özdeş
dilek
bölücü
asal
sezer
artuner
can
doğan
şahin
kartal
erdem
ikizler
balık
tosun
şen
öz
efe
elmas
zümrüt
yakut
    """

    lstN = txtN.split("\n")
    lstN.pop()
    lstN.pop(0)
    lstS=txtS.split("\n")
    lstS.pop()
    lstS.pop(0)

    return product(lstN,lstS)



def insertInstructor(dbCon,names):
    out=open("cikti.txt","w")
    sql = "select count(*) from Department"
    cursor = dbCon.cursor()
    cursor.execute(sql)
    countDeparment=cursor.fetchall()[0][0]
    eachCount = len(names)//countDeparment
    InstNu=[x for x in range(len(names))]
    for depid in range(1,countDeparment+1):
        for i in range(eachCount):
            rnd = randint(0,len(InstNu)-1)
            nameNu=InstNu.pop(rnd)
            sql1 = "call insertInstructor('"+str(names[nameNu][0])+"','"+str(names[nameNu][1])+"',"+str(depid)+");"
            print(sql1,file=out)

def generateFacDep():
    txt = """
    Faculty of Communication
    Communication Sciences
    Radio, Television and Cinema
    Faculty of Dentistry
    Dento-Maxillofacial Radiology
    Endodontics
    Oral and Maxillofacial Surgery
    Orthodontics
    Pediatric Dentisty
    Periodontology
    Prosthodontics
    Restorative Dentistry
    Faculty of Economics and Administrative Science
    Economics
    Family and Consumer Sciences
    Health Administration
    International Relations
    Political Science and Public Administration
    Public Finance
    Social Work
    Faculty of Education
    Computer Education and Instructional Technology
    Educational Measurement and Evaluation
    Curriculum and Instruction
    Educational Administration
    Guidance and Psychological Counseling
    Life Long Learning and Adult Education
    Biology Education
    Science Education
    Physics Education
    Chemistry Education
    Mathematics Education
    Mathematics Teaching Program
    Primary Mathematics Teaching Program
    Education of Students with Intellectual Disabilities
    Gifted Education
    Turkish Education
    Preschool Education
    Primary Education
    German Language Education
    French Language Education
    English Language Education
    Faculty of Engineering
    Chemical Engineering
    Civil Engineering
    Computer Engineering
    Artificial Intelligence Engineering
    Electrical and Electronic Engineering
    Enviromental Engineering
    Food Engineering
    Geological Engineering
    Hydrogeology Engineering
    Geomatics Engineering
    Industrial Engineering
    Mechanical Engineering
    Mining Engineering
    Nuclear Engineering
    Physics Engineering
    Faculty of Fine Arts
    Ceramics
    Graphic Design
    Interior Architecture and Environmental Design
    Painting
    Sculpture
    Faculty of Health Sciences
    Nutrition and Dietetics
    Child Development
    Speech and Language Therapy
    Occupational Therapy
    Audiology
    Faculty of Law
    Private Law
    Public Law
    Faculty of Letters
    American Culture and Literature
    Anthropology
    Archaeology
    English Language and Literature
    English Linguistics
    French Language and Literature
    German Language and Literature
    History
    History of Art
    Information Management
    Modern Turkic Languages and Literature
    Philosophy
    Psychology
    Sociology
    German
    French
    English
    Turkish Language and Literature
    Turkish Folklore
    Faculty of Medicine
    Basic Sciences
    Medical Sciences
    Surgical Sciences
    Faculty of Pharmacy
    Pharmaceutical Basic Sciences
    Pharmaceutical Professional Sciences
    Pharmaceutical Technology
    Faculty of Science
    Actuarial Science
    Biology
    Chemistry
    Mathematics
    Statistics
    Faculty of Sport Sciences
    Exercise and Sport Sciences
    Physical Education and Sport Teaching
    Recreation
    """

    lst = txt.split("\n")
    lst.pop()
    lst.pop(0)

    fac_dep = defaultdict(list)

    i = 0
    while (i < len(lst)):
        if "Faculty of" in lst[i]:
            i += 1
            j = i
            while (j < len(lst)):
                if "Faculty of" in lst[j]:
                    i = j - 1
                    break
                else:
                    fac_dep[lst[i - 1][15:]].append(lst[j].lstrip().rstrip())
                    j += 1
        i = i + 1

    # for id, fac in enumerate(fac_dep.keys()):
    #     print(id, fac)
    #     for dep in fac_dep[fac]:
    #         print("\t" + dep)

    return fac_dep

def truncateAllTables(tables):
    print("SET FOREIGN_KEY_CHECKS=0;")
    for table in tables:
        sql ="truncate table "+table+";"
        print(sql)
    # print("SET FOREIGN_KEY_CHECKS=1;")


def insertFacDep(facdepDict):
    for facid,fac in enumerate(facdepDict.keys()):
        sql = "call insertFaculty('"+fac+"');"
        print(sql)
        for dep in facdepDict[fac]:
            sql1 = "call insertDepartment('"+dep+"','Beytepe',"+str(facid+1)+");"
            print(sql1)

def insertCourse(dbCon):
    cn=set() #all generated coursenames
    with dbCon.cursor() as cursor:
        sql = "SELECT * from Department"
        cursor.execute(sql)
        deps=cursor.fetchall()
        cursor.execute("SET FOREIGN_KEY_CHECKS=0")
        noo = ["101", "102", "201", "202", "301", "302", "401", "402"]
        for dep in deps:
            if(dep[0]==41):
                continue
            courseName= (dep[1][:3]).upper()
            while(courseName in cn):
                courseName = (dep[1][:2]).upper()+ascii_uppercase[randint(0,25)]
            cn.add(courseName)
            for nn in noo:
                courseName1=courseName+nn
                credit = randint(1, 10)
                sql1 = "call insertCourse('%s','%s',%d,%d)" #code,name,credit,depid
                # sql1="call insertCourse('"+courseName1+"',"+str(credit)+","+str(dep[0])+");"
                cursor.execute(sql1%(courseName1,courseName1,credit,dep[0]))
                print(sql1)
                # print(sql1%(courseName1,credit,dep[0]),file=out)
    dbCon.commit()


def insertClass(dbCon):
    with dbCon.cursor() as cursor:
        sql ="select * from Course"
        cursor.execute(sql)
        courses=cursor.fetchall()
        year = [x for x in range(2012,2020)]
        for course in courses:
            for yyyy in year:
                term = "Fall" if course[1][-1]=="1" else "Spring"
                sql1="call insertClass(%d,%d,'%s')"
                cursor.execute(sql1%(course[0],yyyy,term))
                print(sql1)
    dbCon.commit()

def insertSection(dbCon):
    with dbCon.cursor() as cursor:
        sql = "select * from Class"
        cursor.execute(sql)
        classes=cursor.fetchall()
        day=["Monday","Tuesday","Wednesday","Thursday","Friday"]
        time=["9:00-11:00","9:00-12:00","10:00-12:00","10:00-13:00","13:00-15:00","13:00-16:00"]
        for klass in classes:
            countDay=randint(1,2)
            dd=[]
            st=[]
            et=[]
            kota=randint(10,20)
            for cc in range(countDay):
                dd.append(day[randint(0,4)])
                tempTime=time[randint(0,5)].split("-")
                st.append(tempTime[0])
                et.append(tempTime[1])
            for sid in range(randint(1,1)):
                if(countDay==1):
                    sql1 = "call insertSection(%d,%d,%d,'%s','%s','%s','%s','','','','','','')"
                    cursor.execute(sql1%(sid+1,klass[0],kota,"d"+str(kota),dd[0],st[0],et[0]))
                else:
                    sql1="call insertSection(%d,%d,%d,'%s','%s','%s','%s','%s','%s','%s','','','')"
                    cursor.execute(sql1 % (sid+1, klass[0], kota, "d" + str(kota), dd[0], st[0], et[0],dd[1], st[1], et[1]))
                print(klass[0])
    dbCon.commit()

def insertPre(dbCon):
    with dbCon.cursor() as cursor:
        sql="SELECT count(*) from Course"
        cursor.execute(sql)
        countcourses=cursor.fetchall()[0][0]
        for ss in range(1,countcourses,8):
            sql1="call insertPrerequisiteCourses(%d,%d)"
            for i in range(7):
                cursor.execute(sql1%(ss+i,ss+i+1))
            print(sql1)
    dbCon.commit()


def generateCSCourse():
    fullcourse=list()

    labli="""
BBM406	Fundamentals of Machine Learning	Spring	3 0 3	6	English
BBM409	Machine Learning Laboratory	Spring	0 2 1	4	English
BBM412	Computer Graphics	Spring	3 0 3	6	English
BBM413	Fundamentals of Image Processing	Fall	3 0 3	6	English
BBM414	Computer Graphics Laboratory	Spring	0 2 1	4	English
BBM415	Image Processing Laboratory	Fall	0 2 1	4	English
BBM416	Fundamentals of Computer Vision	Spring	3 0 3	6	English
BBM418	Computer Vision Laboratory	Spring	0 2 1	4	English
BBM421	Game Technologies	Fall	3 0 3	6	English
BBM422	Mobile Computing	Spring	3 0 3	6	English
BBM423	Game Technologies Laboratory	Fall	0 2 1	4	English
BBM424	Mobile Computing Laboratory	Spring	0 2 1	4	English
BBM432	Embedded Systems	Spring	3 0 3	6	English
BBM433	Microprocessors	Fall	3 0 3	6	English
BBM434	Embedded Systems Laboratory	Spring	0 2 1	4	English
BBM436	Microprocessors Laboratory	Spring	0 2 1	4	English
BBM444	Fundamentals of Computational Photography	Spring	3 0 3	6	English
BBM446	Computational Photography Laboratory	Spring	0 2 1	4	English
BBM451	Computer Networks	Fall	3 0 3	6	English
BBM452	Data Communications	Spring	3 0 3	6	English
BBM453	Computer Networks Laboratory	Fall	0 2 1	4	English
BBM458	Wireless and Mobil Networks	Fall	3 0 3	6	English
BBM459	Secure Programming Laboratory	Fall	0 2 1	4	English
BBM460	Wireless and Mobil Networks Laboratory	Fall	0 2 1	4	English
BBM463	Information Security	Fall	3 0 3	6	English
BBM465	Information Security Laboratory	Fall	0 2 1	4	English
BBM467	Data Intensive Applications	Fall	3 0 3	6	English
BBM469	Data Intensive Applications Laboratory	Fall	0 2 1	4	English
BBM471	Database Management Systems	Fall	3 0 3	6	English
BBM472	Geographic Information Systems	Spring	3 0 3	6	English
BBM473	Database Laboratory	Spring	0 2 1	4	English
BBM474	Geographic Information Systems Laboratory	Spring	0 2 1	4	English
BBM481	Software Development	Fall	3 0 3	6	English
BBM482	Software Quality Assurance	Spring	3 0 3	6	English
BBM483	Software Development Laboratory	Fall	0 2 1	4	English
BBM484	Software Quality Assurance Laboratory	Spring	0 2 1	4	English
BBM488	Web Services Laboratory	Spring	0 2 1	4	English
BBM490	Fundamentals of Web Architecture	Spring	3 0 3	6	English
BBM491	Personal Software Process	Fall	3 0 3	6	English
BBM492	Team Software Process	Spring	3 0 3	6	English
BBM493	Personal Software Process Laboratory	Fall	0 2 1	4	English
BBM494	Team Software Process Laboratory	Spring	0 2 1	4	English
BBM495	Introduction to Natural Language Processing	Fall/Spring	3 0 3	6	English
    """

    labsiz="""
BBM401	Automata Theory and Formal Languages	Fall	3 0 3	6	English
BBM402	Theory of Computation	Spring	3 0 3	6	English
BBM403	Combinatorics and Graph Theory	Fall	3 0 3	6	English
BBM404	Fundamentals of Compiler Construction	Spring	3 0 3	6	English
BBM405	Fundamentals of Artificial Intelligence	Fall	3 0 3	6	English
BBM407	Fuzzy Logic	Fall	3 0 3	6	English
BBM408	Algorithm Analysis	Spring	3 0 3	6	English
BBM410	Dynamical Systems	Spring	3 0 3	6	English
BBM411	Fundamentals of Bioinformatics	Fall	3 0 3	6	English
BBM420	Design Project II	Spring	0 6 3	6	English
BBM431	Advanced Computer Architectures	Fall	3 0 3	6	English
BBM441	Introduction to High Performance Computing	Fall/Spring	3 0 3	6	English
BBM442	Parallel Processing	Spring	3 0 3	6	English
BBM456	Computer and Network Security	Spring	3 0 3	6	English
BBM461	Secure Programming	Fall	3 0 3	6	English
BBM462	Social and Economic Networks	Fall	3 0 3	6	English
BBM475	Management Information Systems	Fall	3 0 3	6	English
BBM485	Software Architectures	Fall	3 0 3	6	English
BBM486	Design Patterns	Spring	3 0 3	6	English
BBM498	Software Requirements	Fall	3 0 3	6	English
    """

    labli = labli.split("\n")
    labli.pop()
    labli.pop(0)
    for cou in labli:
        line = cou.split()
        code=line[0]
        name=" ".join(line[1:-6])
        if("Laboratory" in name):
            continue
        term=line[-6]
        credit=int(line[-2])+4
        if("Fall" in term and "Spring" in term):
            fullcourse.append([code,name,term.split("/")[0],credit])
            fullcourse.append([code,name,term.split("/")[1],credit])
        else:
            fullcourse.append([code,name,term,credit])

    labsiz = labsiz.split("\n")
    labsiz.pop()
    labsiz.pop(0)
    for cou in labsiz:
        line=cou.split()
        code=line[0]
        name=" ".join(line[1:-6])
        term=line[-6]
        credit=int(line[-2])
        if("Fall" in term and "Spring" in term):
            fullcourse.append([code,name,term.split("/")[0],credit])
            fullcourse.append([code,name,term.split("/")[1],credit])
        else:
            fullcourse.append([code,name,term,credit])


    services="""
1st Semester
Course Code 	Course Name 	Theoretic-Practical-Credit 	ECTS Credit 	Course Language
BBM101	Introduction to Programming I	3 0 3	6	English
BBM103	Introduction to Programming Laboratory I	0 2 1	4	English
MAT123	Mathematics I	4 2 5	6	English
FİZ137	Physics I	4 0 4	5	English
BBM105	Introduction to Computer Engineering	1 0 1	2	English
İNG111	Language Skills I	3 0 3	3	English
TKD103	Turkish I	2 0 2	2	Turkish
BEB 650	Basic Information and Communication Technologies	0 2 1	2	English

2nd Semester
Course Code 	Course Name 	Theoretic-Practical-Credit 	ECTS Credit 	Course Language
BBM102	Introduction to Programming II	3 0 3	8	English
BBM104	Introduction to Programming Laboratory II	0 2 1	4	English
MAT124	Mathematics II	4 2 5	6	English
FİZ138	Physics II	4 0 4	5	English
FİZ117	General Physics Lab.	0 3 1	2	English
İNG112	Language Skills II	3 0 3	3	English
TKD104	Turkish II	2 0 2	2	Turkish

3rd Semester
Course Code	Course Name	Theoretic-Practical-Credit 	ECTS Credit 	Course Language
BBM201	Data Structures	3 0 3	5	English
BBM203	Software Laboratory I	0 2 1	2	English
BBM205	Discrete Structures	3 0 3	5	English
BBM231	Logic Design	3 0 3	7	English
İST299	Probability	3 0 3	5	English
AİT203	Ataturks Princ. And The History of The Revol. I	2 0 2	2	Turkish
HAS222	Occupational Health and Safety I	1 0 1	1	Turkish
    Nontechnical Elective	3 0 3	3	

4th Semester
Course Code 	Course Name 	Theoretic-Practical-Credit 	ECTS Credit 	Course Language
BBM202	Algorithms	3 0 3	4	English
BBM204	Software Laboratory II	0 2 1	2	English
BBM234	Computer Organization	3 0 3	4	English
MAT254	Fundamentals of Linear Algebra	3 0 3	4	English
ELE296	Introduction to Electronic Circ. and Syst.	3 0 3	5	English
İST292	Statistics	3 0 3	5	English
AİT204	Ataturks Princ. And The History of The Revol. II	2 0 2	2	Turkish
HAS223	Occupational Health and Safety II	1 0 1	1	Turkish
    Nontechnical Elective	3 0 3	3	

5th Semester
Course Code 	Course Name 	Theoretic-Practical-Credit 	ECTS Credit 	Course Language
BBM301	Programming Languages	3 0 3	4	English
BBM325	Internship I	0 4 2	5	English
BBM341	Systems Programming	3 0 3	4	English
BBM371	Data Management	3 0 3	4	English
BBM	Technical Elective	3 0 3	6	English
BBM	Technical Elective Lab.	0 2 1	4	English
    Nontechnical Elective	3 0 3	3	

6th Semester
Course Code 	Course Name 	Theoretic-Practical-Credit 	ECTS Credit 	Course Language
BBM342	Operating Systems	3 0 3	5	English
BBM382	Software Engineering	3 0 3	5	English
BBM384	Software Engineering Lab.	0 2 1	4	English
BBM	Technical Elective	3 0 3	6	English
BBM	Technical Elective	3 0 3	6	English
    Nontechnical Elective	3 0 3	4	

7th Semester
Course Code 	Course Name 	Theoretic-Practical-Credit 	ECTS Credit 	Course Language
BBM419	Design Project I	3 2 4	10	English
BBM425	Internship II	0 4 2	5	English
BBM427	Technology Seminars I	0 2 1	1	English
BBM	Technical Elective	3 0 3	6	English
BBM	Technical Elective Lab.	0 2 1	4	English
    Nontechnical Elective	3 0 3	4	

8th Semester
Course Code 	Course Name 	Theoretic-Practical-Credit 	ECTS Credit 	Course Language
BBM428	Technology Seminars II	0 2 1	1	English
BBM	Technical Elective	3 0 3	6	English
BBM	Technical Elective	3 0 3	6	English
BBM	Technical Elective	3 0 3	6	English
BBM	Technical Elective Lab.	0 2 1	4	English
BBM	Technical Elective Lab.	0 2 1	4	English
    Nontechnical Elective	3 0 3	3	
    """
    services=services.split("\n")
    services.pop()
    services.pop(0)

    tt=["Fall","Spring"]
    tc=1
    for cou in services:
        line = cou.split()
        if(len(line)==0 or line[0]=="Course" or line[0]=="BBM" or "Nontec" in line[0]):
            continue
        if(line[1]=="Semester"):
            tc+=1
            continue
        if(line[0]=="BEB"):
            line[0]="BEB650"
            line.pop(1)
        code=line[0].replace("İ","I")
        name=" ".join(line[1:-5])
        term=tt[tc%2]
        credit=int(line[-2])
        if("Lab." in name or "Laboratory" in name):
            temp=fullcourse.pop()
            temp[-1]+=credit
            fullcourse.append(temp)
            continue
        fullcourse.append([code,name,term,credit])

    return fullcourse

def csThings(dbCon):
    courses = generateCSCourse()
    depid=41
    year = [x for x in range(2012,2020)]
    day=["Monday","Tuesday","Wednesday","Thursday","Friday"]
    time=["9:00-11:00","9:00-12:00","10:00-12:00","10:00-13:00","13:00-15:00","13:00-16:00"]


    with dbCon.cursor() as cursor:
        cursor.execute("SET FOREIGN_KEY_CHECKS=0")
        cursor.execute("select count(*) from Course")
        courseid=cursor.fetchall()[0][0]+1
        #print(courseid)
        cursor.execute("select count(*) from Class")
        klassid=cursor.fetchall()[0][0]+1
        #print(klassid)

        #['BBM202', 'Algorithms', 'Spring', 6]
        for course in courses:
            #print(course)

            sqlCourse = "call insertCourse('%s','%s',%d,%d)" #code,name,credit,depid
            cursor.execute(sqlCourse%(course[0],course[1],course[3],41))

            for yyyy in year:
                sqlKlass = "call insertClass(%d,%d,'%s')" # courseid,year,term
                cursor.execute(sqlKlass%(courseid,yyyy,course[2]))
                klassid+=1

                countDay=randint(1,2)
                dd=[]
                st=[]
                et=[]
                kota=randint(5,15)
                for _ in range(countDay):
                    dd.append(day[randint(0,4)])
                    tempTime=time[randint(0,5)].split("-")
                    st.append(tempTime[0])
                    et.append(tempTime[1])
                for sid in range(randint(1,2)):
                    if(countDay==1):
                        sqlSection = "call insertSection(%d,%d,%d,'%s','%s','%s','%s','','','','','','')" #sectionid,classid,quota,location,day,start,end
                        cursor.execute(sqlSection%(sid+1,klassid,kota,"d"+str(kota),dd[0],st[0],et[0]))
                    else:
                        sqlSection="call insertSection(%d,%d,%d,'%s','%s','%s','%s','%s','%s','%s','','','')"
                        cursor.execute(sqlSection % (sid+1, klassid, kota, "d" + str(kota), dd[0], st[0], et[0],dd[1], st[1], et[1]))
                    #print("\t\tsec-",sid)
                #print("\tkla-",klassid)
            print("cou-",courseid)
            courseid+=1
    dbCon.commit()
"""
'823', '830'
'826', '832'
'821', '828'
'828', '833'
'833', '840'
'825', '831'
'848', '854'
PRerquites
"""


def deletecs(dbCon):
    courseS=777
    klassS=6209

    with dbCon.cursor() as cursor:
        cursor.execute("SET FOREIGN_KEY_CHECKS=0")
        sqlDelSec = "delete from Section where classID>=%d"
        cursor.execute(sqlDelSec%(klassS))

        sqlDelKlas="delete from Class where classID>=%d"
        cursor.execute(sqlDelKlas%(klassS))

        sqlDelCourse="delete from Course where courseID>=%d"
        cursor.execute(sqlDelCourse%(courseS))
    
    dbCon.commit()


def student2klass(dbCon):
    
    with dbCon.cursor() as cursor:

        cursor.execute()

def instructor2klass(dbCon):
    
    with dbCon.cursor() as cursor:
        cursor.execute("select count(*) from Department")
        depCount = cursor.fetchall()[0][0]+1
        #print(depCount)  joincourseclasssection

        for i in range(1,depCount+1):
            cursor.execute("select * from Instructor where departmentID="+str(i))
            instructorsFrom_ithDep =  cursor.fetchall() #0 insid
            lni=len(instructorsFrom_ithDep)

            cursor.execute("select * from joincourseclasssection where departmentID="+str(i))
            courses_ithDep = cursor.fetchall()# 5->klass 8->section
            lnc=len(courses_ithDep)
            
            sql2matchinstructorandsection="call insertInstructorGivesCourse(%d,%d,%d)"
            for k in range(lnc):
                cursor.execute(sql2matchinstructorandsection%(instructorsFrom_ithDep[k%lni][0],courses_ithDep[k][5],courses_ithDep[k][8]))

            print(i)
    
    dbCon.commit()


def fillcollectedCreditsGrades(dbCon):

    with dbCon.cursor() as cursor:
        cursor.execute("select studentID from Student")
        stuNos=cursor.fetchall()
        #print(stuNos)

        sql="UPDATE Student SET collectedCredits = 0, collectedGrade = 0 WHERE (studentID = %s)"
        for stuid in stuNos:
            cursor.execute(sql%stuid[0])
            #print(sql%stuid[0])
            print(stuid[0])
            
    dbCon.commit()

def matchStudentAdvisor(dbCon):

    with dbCon.cursor() as cursor:

        cursor.execute("select departmentID from Department")
        depNos=cursor.fetchall()
        #print(depNos)

        for dep in depNos:
            depid = dep[0]
            
            cursor.execute("select studentID from Student where departmentID=%s and advisor is null"%depid)
            stuNos=cursor.fetchall()
            #print(stuNos)

            cursor.execute("select instructorID from Instructor where departmentID=%s"%depid)
            insNos = cursor.fetchall()
            lni=len(insNos)
            #print(insNos)

            i=0
            for stu in stuNos:
                stuid = stu[0]
                sql = "UPDATE Student SET advisor = %s WHERE studentID=%s"
                cursor.execute(sql%(insNos[i%lni][0],stuid))
                i+=1


            print(depid)
    
    dbCon.commit()
        

def fillGraduation(dbCon):

    with dbCon.cursor() as cursor:

        cursor.execute("select studentID from Student where startYear<2015")
        stuNos=cursor.fetchall()

        sql="UPDATE Student SET graduate = 1 WHERE (studentID = %s)"
        for stuid in stuNos:
            cursor.execute(sql%stuid[0])
            print(stuid[0],"+")
        

        cursor.execute("select studentID from Student where startYear>=2015")
        stuNos=cursor.fetchall()

        sql="UPDATE Student SET graduate = 0 WHERE (studentID = %s)"
        for stuid in stuNos:
            cursor.execute(sql%stuid[0])
            print(stuid[0],"-")

            
    dbCon.commit()



def passYear(dbCon,studentNo,lessons):

    with dbCon.cursor() as cursor:
        failerChance=randint(0,10)
        if(failerChance<3):#bad
            for les in lessons:
                cursor.execute("call insertStudentHasGradedCourse(%s,%s,%s,'%s')"%(studentNo,les[0],les[1],badGrades[randint(0,2)]))
            return studentNo
        else:#good
            for les in lessons:
                cursor.execute("call insertStudentHasGradedCourse(%s,%s,%s,'%s')"%(studentNo,les[0],les[1],goodGrades[randint(0,9)]))
            return 0
    
    dbCon.commit()

def takeYear(dbCon,studentNo,lessons):
    
    with dbCon.cursor() as cursor:
        for les in lessons:
            cursor.execute("call insertStudentTakenCourse(%s,%s,%s)"%(studentNo,les[1],1))
    dbCon.commit()



def gradeMe(dbCon,news):
    
    getStu="select * from Student where studentID=%s"
    with dbCon.cursor() as cursor:

        cursor.execute("select distinct courseID,classID from joincourseclasssection where departmentID=41 and term='Fall' and year=2018 and CourseCode LIKE '___1%'")
        klass2018=cursor.fetchall()

        cursor.execute("select distinct courseID,classID from joincourseclasssection where departmentID=41 and term='Fall' and year=2019 and CourseCode LIKE '___1%'")
        klass2019=cursor.fetchall()

        failedguys=[]
        for stu in news:
            cursor.execute(getStu%stu)
            stu=list(cursor.fetchall()[0])
            print(stu)
            
            if(stu[4]==2019):
                takeYear(dbCon,stu[0],klass2019)
            elif(stu[4]==2018):
                failedguys.append(passYear(dbCon,stu[0],klass2018))

            
        for stuNo in failedguys:
            print("failed->",stuNo)
            if stuNo!=0:
                takeYear(dbCon,stuNo,klass2019)

    dbCon.commit()

def statComp(dbCon):

    students=list(name_surnameStudent())
    shuffle(students)
    students=students[:100]
    news=[]

    with dbCon.cursor() as cursor:

        regStuSQL="call registration('%s','%s',%s)"
        for stu in list(students):
            yyyy = randint(2018,2019)
            print(regStuSQL%(stu[0],stu[1],yyyy))

            cursor.execute(regStuSQL%(stu[0],stu[1],yyyy))
            stuNo = cursor.fetchall()[0][0]
            #print(stuNo)
            news.append(stuNo)
    
    dbCon.commit()
    print(list(news))



def revert(dbCon):

    with dbCon.cursor() as cursor:

        cursor.execute("select classID,sectionID from joincourseclasssection where year=2019 and departmentID=41")
        
        sec = cursor.fetchall()

        for s in sec:
            sql = "update Section set quota=%s where classID=%s and sectionID=%s"%(randint(60,70),s[0],s[1])
            print(sql)
            cursor.execute(sql)

    dbCon.commit()


def deleteStudent(dbCon,students):

    with dbCon.cursor() as cursor:
        
        deluserSQL = "delete from UsersStudent where userid=%s"
        deltakenCourse = "delete from StudentTakenCourse where studentID=%s"
        deltgraded = "delete from StudentHasGraded where studentID=%s"
        delstu = "delete from Student where studentID=%s"

        for stu in students:
            print(deluserSQL%(stu))
            print(deltakenCourse%(stu))
            print(deltgraded%(stu))
            print(delstu%(stu))

            cursor.execute(deluserSQL%(stu))
            cursor.fetchall()
            cursor.execute(deltakenCourse%(stu))
            cursor.fetchall()
            cursor.execute(deltgraded%(stu))
            cursor.fetchall()
            cursor.execute(delstu%(stu))
            cursor.fetchall()
    
    dbCon.commit()


def generateFakeStuComp(dbCon):

    gnc=50
    ns=list(name_surnameStudent())
    shuffle(ns)
    ns=ns[:gnc]
    # print(ns)

    with dbCon.cursor() as cursor:

        for i in range(gnc):
            print(ns[i])
            name=ns[i][0]
            surname=ns[i][1]

            insertStuSQL="call insertStudent('%s','%s',%s,%s)"
            cursor.execute(insertStuSQL%(name,surname,randint(2012,2015),41))
            dbCon.commit()

            cursor.execute("select max(studentID) as maxi from Student")
            stuID=cursor.fetchall()[0][0]
            # print(stuID)

            cursor.execute("update Student set graduate=1 where studentID=%s"%stuID)

            cursor.execute("SELECT * FROM joincourseclasssection where departmentID=41 and year<2019 and sectionID=1")
            ccs = cursor.fetchall() 

            gradeKlass="insert into StudentHasGraded values(%s,%s,%s,'%s');"
            for klass in ccs:
                cursor.execute(gradeKlass%(stuID,klass[0],klass[5],allgradeletters[randint(0,12)]))
                # print(gradeKlass%(stuID,klass[0],klass[5],allgradeletters[randint(0,12)]))
    
            dbCon.commit()



