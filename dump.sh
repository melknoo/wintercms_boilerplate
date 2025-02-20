#!/bin/bash

d=$(date +%Y_%m_%d_%H_%M_%S)
db_name=db

docker exec -i $db_name mysqldump -uroot -proot stage > $d.sql

