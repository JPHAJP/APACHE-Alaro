# APACHE-Alaro
Docker instructions and files to create a webservice of apache (PHP)

Install git and clone this repository on your mageia system:
    sudo dnf install git
    cd /path/to/your/project
    git clone https://github.com/JPHAJP/APACHE-Alaro.git


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