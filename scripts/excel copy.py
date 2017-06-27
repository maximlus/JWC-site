#!/usr/bin/python
import os
from openpyxl import load_workbook
path = "C:\\Users\\jack\\Documents\\JWC site"
os.chdir(path)  # change current directory
wb = load_workbook(filename = 'japan world cup.xlsx', data_only=True)
maxHorse = 8
y = 0
z = 2
s = 0.1
e = ""
maxRow = 0

def setMaxHorse():
    global y
    global maxHorse
    y = 1
    if e == "Main Game":
        if x == 3:
            maxHorse = 9
        else:
            maxHorse = 8
    if e == "Steeplechase ?-Box":
         maxHorse = 5
    if e == "Cosplay Stakes":
         maxHorse = 6
    if e == "Haribo Memorial":
         maxHorse = 8
    if e == "Animal International":
         maxHorse = 8
    return maxHorse
def columLength():
    i = 0
    global maxRow
    while (maxRow == 0):
        i = i + 1
        if sheet['P%d' % i].value is None:
            maxRow = i-1
    return maxRow
file = open("test.txt", "w")
for x in range(1, 4):
    print("start loop %d" % x)
    #  print("we are in outter loop %d" % x)
    sheet = wb.get_sheet_by_name('JWC%d'% x)
    e = sheet['S2'].value
    maxRow = 0
    maxRow = columLength()
    for counter in range(2, maxRow+1):
        #  print("inner loop %d" % counter)
        n = sheet['P%d'% counter].value
        s = sheet['Q%d'% counter].value
        y = y + 1
        if y > maxHorse:
                z = z + 1
                if z > 4:
                    z = 2
                e = sheet['S%d'% z].value
                maxHorse = setMaxHorse()
        file.write(
            "INSERT INTO hourse (name,disk,event,score,number)\
         VALUES (%s,%d,%s,%g,%d);\n" % (n,x,e,s,y))
file.close()
