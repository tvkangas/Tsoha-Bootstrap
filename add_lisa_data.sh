#!/bin/bash

source config/environment.sh

echo "Lisätään testidata..."

ssh $USERNAME@users.cs.helsinki.fi "
cd htdocs/$PROJECT_FOLDER/sql
psql < lisa_data.sql
exit"

echo "Valmis!"
