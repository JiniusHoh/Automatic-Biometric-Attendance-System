import cv2.cv2 as cv
import numpy as np
import face_recognition as f_r

imgElon = f_r.load_image_file('imageBasics\Elon Musk.jpg')
imgElon = cv.cvtColor(imgElon, cv.COLOR_BGR2RGB)
imgTest = f_r.load_image_file('imageBasics\Steve Jobs.jpg')
imgTest = cv.cvtColor(imgTest, cv.COLOR_BGR2RGB)

faceLoc = f_r.face_locations(imgElon)[0]
encodeElon = f_r.face_encodings(imgElon)[0]
cv.rectangle(imgElon, (faceLoc[3], faceLoc[0]), (faceLoc[1], faceLoc[2]), (255, 0, 0), 2)
# print(faceLoc)
faceLocTest = f_r.face_locations(imgTest)[0]
encodeTest = f_r.face_encodings(imgTest)[0]
cv.rectangle(imgTest, (faceLocTest[3], faceLocTest[0]), (faceLocTest[1], faceLocTest[2]), (255, 0, 0), 2)

results = f_r.compare_faces([encodeElon], encodeTest)
faceDis = f_r.face_distance([encodeElon], encodeTest)
# the lower the distance the better than match is
print(results, faceDis)
cv.putText(imgTest, f'{results} {round(faceDis[0],2)}', (50, 50), cv.FONT_HERSHEY_COMPLEX, 1, (255, 0, 0), 2)

cv.imshow('Elon Musk', imgElon)
cv.imshow('Elon Test', imgTest)
cv.waitKey(0)
