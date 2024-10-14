# APACHE-Alaro
Docker instructions and files to create a webservice of apache (PHP)

1. Install git and clone this repository on your mageia system:
    sudo dnf install git
    cd /path/to/your/project
    git clone https://github.com/JPHAJP/APACHE-Alaro.git

2. Add all php files and site to the project directory.
    /path/to/project/APACHE-Alaro
    ├── Dockerfile
    ├── index.php
    ├── other-php-files.php
    ├── assets/
    └── ...

3. Instructions to install docker on mageia:
Run the following commands:
    sudo dnf update
    sudo dnf install docker
    sudo systemctl start docker
    sudo systemctl enable docker
    sudo usermod -aG docker $USER
    newgrp docker
    #Check version and functionality
    docker --version
    docker run hello-world

4. Build docker:
    docker build -t php-webservice .

5. Create Certificate directory
    mkdir -p /path/to/certificates

6. Run docker container:
    docker run -d -p 80:80 -p 443:443 \
        -v /path/to/certificates:/etc/letsencrypt \
        --name web-php php-webservice

7. Get an SSL certificate (https):
You will have to chenge example.com and www.example.com with your domain.
    docker exec -it web-php certbot --apache -d example.com

8. Verification
    #Docker running?
        docker ps
    #Volume is mounted?
        docker exec -it web-php ls /etc/letsencrypt
    #Web is on?
    Get into browser and navigate to http://localhost and https://localhost (or the appropriate domain/IP if you're using a remote server).

9. Troubleshot:
    #Docker instalation without internet?
    docker run --rm busybox ping -c 4 google.com
    #then:
    docker run --rm --network host busybox ping -c 4 google.com
    #If ping work must add a DNS conf file:
        sudo nano /etc/docker/daemon.json
        file:
            {
                "dns": ["8.8.8.8", "8.8.4.4"]
            }
        sudo systemctl restart docker
        docker run --rm busybox ping -c 4 google.com
        docker run --rm busybox cat /etc/resolv.conf

10. Docker:
    docker stop web-php
    docker rm web-php
    docker run web-php

11. Free port 80 and 443
    Check port:
        sudo ss -tuln | grep :80
        sudo ss -tuln | grep :443

