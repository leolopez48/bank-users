#!/bin/bash
projects_path=/home/administrador/nginx/apps

folders=$(ls $projects_path)

for folder in $folders
do
    echo "Executing cron for $folder"
    cd "$projects_path/$folder"
    docker compose run artisan schedule:run
done
