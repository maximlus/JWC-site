#!/bin/bash
aduser="root" #admin username
user="webuser" #new username
adpassword="toor" # admin password
pass="Dave12234" #new user password
database="JWC" # Database name
str="-u ${aduser} -p${adpassword}" # cause this line needed to be written alot and I am lazy.
echo script start
#echo $str #This is used for debug.

createuser () { #Function, woo. Note, function must be declared before being called.
echo "starting user creation";
#create user for the database
mysql $str -e "CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';" #|| echo "MYSQL user cration failed"; exit 2 # Some reason having this causese program to stop :/ 
echo "user created";
#grant privileges to the new user to read and write to database
mysql $str -e "GRANT ALL PRIVILEGES ON $database.* TO '$user'@'localhost';" #|| echo "MYSQL privileges failed"; exit 3
echo "privieleges granted";
#Flush just implements new changes such as grant privieleges
mysql $str -e "FLUSH PRIVILEGES;" #|| echo "MYSQL flush failed"; exit 4

echo "all comands run succesffuly";
}

#check for an exsiting database called JWC
if ! mysql -u "$aduser" -p"$adpassword" -e 'use JWC'; then # ! = not gate. This will return 0 if it can not use the database JWC
#creating database JWC
echo "creating database";
mysql -e "CREATE DATABASE $database;" #|| echo "MYSQL database creation failed"; exit 1
echo "created database";
createuser # calls function
else
while true; do	#will countine unless interpupted by break or exit.
read -p "database JWC already exists do you wish to continue? Y/N" Yn # read is stored in "Yn" and -p means it only stores the first char
case $Yn in # This is really neat and I don't know how to descripe it but it let's this stuff happen.
[Yy]* ) createuser; break;; # if Yn = Y or y then, call createuser and break. must end with ;; and a ; seperate commands.
[Nn]* ) exit 5;; # if YN = N or n then, exit the program.
* ) echo "please enter Y/N";; # if ! Y or y or N or n then do a thing.

esac # end case
done # end while loop
fi # end if statment

exit; # end's the program.