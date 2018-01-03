#!/bin/bash
sudo docker run -v /home/shadowvzs/php:/var/www/html -it -p 80:80 devos:7 /bin/bash