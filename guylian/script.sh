#!/bin/bash
rm "/var/lib/mysql-files/register.csv"
mysql -u root -pwilly9105 test -B -e "SELECT Email FROM register INTO OUTFILE '/var/lib/mysql-files/register.csv' LINES TERMINATED BY ',';"
cp "/var/lib/mysql-files/register.csv" "/home/Student/register.csv"
