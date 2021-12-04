import cv2.cv2 as cv

print('Registration for new ID')

while True:
    img_name = input('Please enter your name(capital letter): ')
    key = input('Please enter Y if your name is entered correctly: ')
    if key == 'Y':
        break

cam = cv.VideoCapture(0)

cv.namedWindow("Python Webcam Screenshot App")
print("Take Picture and Smile! Press Space to take pic! Click Esc after taking photo!")

while True:
    ret, frame = cam.read()

    if not ret:
        print("failed to grab frame")
        break
    cv.imshow("Photo taking frame!", frame)

    k = cv.waitKey(1)
    if k%256 == 27:
        # ESC pressed
        print("Escape hit, closing...")
        break
    elif k%256 == 32:
        # SPACE pressed
        img_name = "{}.png".format(img_name)
        cv.imwrite('imageAttendance/' + img_name, frame)
        print("{} written!".format(img_name))

cam.release()
cv.destroyAllWindows()
