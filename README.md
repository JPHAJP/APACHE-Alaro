# APACHE-Alaro
Docker instructions and files to create a webservice of apache (PHP)

Install git and clone this repository on your mageia system:
    sudo dnf install git
    cd /path/to/your/project
    git clone https://github.com/JPHAJP/APACHE-Alaro.git

Add all php files and site to the project directory.
    /path/to/project/APACHE-Alaro
    ├── Dockerfile
    ├── index.php
    ├── other-php-files.php
    ├── assets/
    └── ...

Instructions to install docker on mageia:
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

Build docker:
    docker build -t php-webservice .

Run docker container:
    docker run -d -p 8080:80 --name web-php php-webservice
