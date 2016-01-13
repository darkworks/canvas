#!/bin/sh

rm -rf /var/www/canvas.local/www/*
cp -R /home/pavel/PROJECTS/canvas/* /var/www/canvas.local/www/
chown canvas.local:canvas.local -R /var/www/canvas.local/www/


