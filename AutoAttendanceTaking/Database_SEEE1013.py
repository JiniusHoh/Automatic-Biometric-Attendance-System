import csv
import pymysql
import os

con = pymysql.connect(host="127.0.0.1", user="root", password="", database="attendance")


file = 'Attendance.csv'
# first check whether file exists or not
n = 0

if (os.path.exists(file) and os.path.isfile(file)):
    # read the values row by row
    with open('Attendance.csv') as csv_file:
        csvfile = csv.reader(csv_file, delimiter=',')
        all_value = []
        for value in csvfile:
            value = (value[0], value[1], value[2])
            all_value.append(value)

            with con.cursor() as cur:

                cur.execute('INSERT INTO seee1013(name,date,time) VALUES(%s,%s,%s)', (value[0], value[1], value[2]))
                con.commit()

            print('new attendance inserted')
            n += 1

        con.close()

    print(str(n) + ' attendance records are inserted')

else:
    print("file not found")

# Python program to delete a csv file
# csv file present in same directory

# first check whether file exists or not
# calling remove method to delete the csv file
# in remove method you need to pass file name and type
# file = 'Attendance.csv'
if (os.path.exists(file) and os.path.isfile(file)):
    os.remove(file)
    print("file deleted")
else:
    print("file not found")




