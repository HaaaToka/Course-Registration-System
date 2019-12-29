from itertools import product
from collections import defaultdict
from random import randint
from string import ascii_uppercase

def name_surnameStudent():
    txtN = """
onur
akif
bilge
batu
batuhan
mete
metehan
cemil
burak
furkan
çağlar
yahya
güney
ali
berat
faruk
ömer
bilal
miraç
bahar
aslı
esra
zeliha
ayşe
burhan
didem
damla
tuğçe
yağmur
müge
şeyma
buse
gizem
aslan
simge
hatice
fevzi
    """
    txtS="""
erek
erim erkoç
erol
çınar
kaya
taş
çiftçi
kumru
kul
maden
özer
özbey
teker
lastik
top
toka
acar
adıgüzel
ağaç
kütük
koçak
yağlıca
hamsi
aslan
kaplan
kedi
köpek
kuş
keçi
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
                sql1 = "call insertCourse('%s','%s',%d,%d)" #name,credit,depid
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
                    cursor.execute(sql1%(klass[1],klass[0],kota,"d"+str(kota),dd[0],st[0],et[0]))
                else:
                    sql1="call insertSection(%d,%d,%d,'%s','%s','%s','%s','%s','%s','%s','','','')"
                    cursor.execute(sql1 % (klass[1], klass[0], kota, "d" + str(kota), dd[0], st[0], et[0],dd[1], st[1], et[1]))
                print(sql1)
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


def csThings(dbCoc):
    print("okk")
