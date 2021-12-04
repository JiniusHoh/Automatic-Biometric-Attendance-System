import cv2 as cv
import numpy as np
import face_recognition as f_r
import os
from datetime import datetime

path = 'imageAttendance'
images = []
classNames = []
myList = os.listdir(path)
print(myList)
for cl in myList:
    curImg = cv.imread(f'{path}/{cl}')
    images.append(curImg)
    classNames.append(os.path.splitext(cl)[0])
print(classNames)

def findEncodings(images):
    encodeList = []
    for img in images:
        img = cv.cvtColor(img, cv.COLOR_BGR2RGB)
        encode = f_r.face_encodings(img)[0]
        encodeList.append(encode)
    return encodeList

def markAttendance(name):
    with open('Attendance.csv', 'r+') as f:
        myDataList = f.readlines()
        print(myDataList)
        nameList = []

        for line in myDataList:
            entry = line.split(',')
            nameList.append(entry[0])
        if name not in nameList:
            now = datetime.now()
            dtString = now.strftime('%Y-%m-%d,%H:%M:%S')
            f.writelines(f'{name},{dtString}\n')
encodeListKnown = findEncodings(images)
# print(len(encodeListKnown))
print('Encoding Complete')

cap = cv.VideoCapture(0)

while True:
    success, img = cap.read()
    imgS = cv.resize(img, (0, 0), None, 0.25, 0.25)
    imgS = cv.cvtColor(img, cv.COLOR_BGR2RGB)

    facesCurFrame = f_r.face_locations(imgS)
    encodesCurFrame = f_r.face_encodings(imgS, facesCurFrame)

    for encodeFace, faceLoc in zip(encodesCurFrame, facesCurFrame):
        matches = f_r.compare_faces(encodeListKnown, encodeFace)
        faceDis = f_r.face_distance(encodeListKnown, encodeFace)
        print(faceDis)
        matchIndex = np.argmin(faceDis)

        if matches[matchIndex]:
            name = classNames[matchIndex].upper()
            print(name)
            y1, x2, y2, x1 = faceLoc
            # y1, x2, y2, x1 = x1*4, x2*4, y2*4, x1*4
            cv.rectangle(img, (x1, y1), (x2, y2), (0, 255, 0), 2)
            cv.rectangle(img, (x1, y2-35), (x2, y2), (0, 255, 0), cv.FILLED)
            cv.putText(img, name, (x1+6, y2+6), cv.FONT_HERSHEY_COMPLEX, 1, (255, 255, 255), 2)
            markAttendance(name)


    cv.imshow('Taking attendance... Long-press q to exit', img)
    cv.waitKey(1)

    if cv.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv.destroyAllWindows()

# faceLoc = f_r.face_locations(imgElon)[0]
# encodeElon = f_r.face_encodings(imgElon)[0]
# cv.rectangle(imgElon, (faceLoc[3], faceLoc[0]), (faceLoc[1], faceLoc[2]), (255, 0, 0), 2)
# # print(faceLoc)
# faceLocTest = f_r.face_locations(imgTest)[0]
# encodeTest = f_r.face_encodings(imgTest)[0]
# cv.rectangle(imgTest, (faceLocTest[3], faceLocTest[0]), (faceLocTest[1], faceLocTest[2]), (255, 0, 0), 2)
#
# results = f_r.compare_faces([encodeElon], encodeTest)
# faceDis = f_r.face_distance([encodeElon], encodeTest)
