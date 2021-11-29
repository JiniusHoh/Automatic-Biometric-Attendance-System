import csv
from datetime import datetime

# current date and time
now = datetime.now()
date = now.strftime('%Y-%m-%d')
time = now.strftime('%H:%M:%S')

headers = ["Lecturer", date, time]
# student_list = [["Student", date, time],
#                 ["Student2", date, time],
#                 ["Student3", date, time]]


with open("Attendance.csv", "w", newline="") as stud:
    student = csv.writer(stud)
    student.writerow(headers)
    # student.writerows(student_list)
