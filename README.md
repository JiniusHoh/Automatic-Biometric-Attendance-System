# Automatic-Biometric-Attendance-System

### Requirement for software
1. Please install PyCharm, Python 3.8, XAMMP, Visual Studio Code
2. Please install these packages (opencv-python, numpy, cmake version 3.21.4, dlib version 19.19, face_recognition, pymysql) in Python 3.8: 

### Steps to run the system
1. Run Register new ID.py to register information of students
2. Run creating_csvFile.py to create Attendance.csv to record attendance
3. Run AttendanceProject.py to take attendance automatically
4. After taking all attendance of students, press 'q' to stop the software.
5. Run Xammp and and open phpMyAdmin, create a database named attendance and a table attendace within the database. 
6. The table consists of 4 colums which are ID(type=int, auto-increment), name(type=intvarchar, 255), date(type=date), time(type=time)  
7. With opening of phpMyAdmin, run Database.py to upload data from Attendance.csv to database.
