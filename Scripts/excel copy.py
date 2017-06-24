#!/usr/bin/python
import openpyxl  # if this program dose not work, make sure you have openpyxl
# installed.
import os
os.getcwd()  # find current directory
os.chdir()  # change current directory

wb = openpyxl.load_workbook('japan world cup.xlsx')
maxHorse = 8
y = 0
z = 1


def setMaxHorse(e):
    y = 1
    if e = "Main Game":
        maxHorse = 8
    if e = "Steeplechase ?-Box":
        maxHorse = 5
    if e = "Cosplay Stakes":
        maxHorse = 6
    if e = "Haribo Memorial":
        maxHorse = 8
    if e = "Animal International":
        maxHorse = 8
    return
file = open("test.txt", "w")
for x in range(1, 3):
    sheet = wb.get_sheet_by_name('JWC'+x)
    e = sheet['S2']
    for counter in range(2, sheet.max_row):
        n = sheet['P'+counter]
        s = sheet['Q'counter]
        y = y + 1
        if y > maxHours:
                setMaxHorse(e)
                z = z + 1
                if z > 4:
                    z = 2
                    e = sheet['S'z]
        file.write(
            "INSERT INTO hourse (name,disk,event,score,number)\
         VALUES ("n.value","x","e","s.value","y");\n")
file.close()
