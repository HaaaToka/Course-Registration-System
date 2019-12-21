import pymysql

DB = pymysql.connect(host='localhost',
                     user='jotpot',
                     password='JotForm1-',
                     db='471DB')

try:
    sql = "show tables"
    cursor = DB.cursor()
    cursor.execute(sql)
    data = cursor.fetchall()
    for d in data:
        print(d)
    DB.close()

except:
    print("!!!!!!!!!!!!!!")
