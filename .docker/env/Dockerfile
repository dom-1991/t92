FROM ubuntu:latest

ENV TZ=Asia/Ho_Chi_Minh
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update -y && apt-get upgrade -y

###########################################################################
# Install php
###########################################################################

RUN apt install -y lsb-release ca-certificates apt-transport-https software-properties-common
RUN apt install -y procps cron curl nano
RUN add-apt-repository ppa:ondrej/php

RUN apt-get update -y

RUN apt install -y php8.1-fpm php8.1-intl php8.1-cli php8.1-opcache php8.1-cgi php8.1-bz2 php8.1-bcmath php8.1-mbstring
RUN apt install -y php8.1-xml php8.1-mysql php8.1-pgsql php8.1-zip php8.1-ldap php8.1-gd php8.1-curl php8.1-soap php8.1-imagick

RUN curl -o composer-setup.php https://getcomposer.org/installer
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

###########################################################################
# Install nginx
###########################################################################

RUN apt install -y nginx

###########################################################################
# Install nvm & node & npm & yarn & pm2
###########################################################################

# Replace shell with bash so we can source files
#RUN rm /bin/sh && ln -s /bin/bash /bin/sh
#
## nvm environment variables
#ENV NODE_VERSION 14.17.1
#ENV NVM_DIR=/root/.nvm
#
#RUN apt-get update && apt-get install wget curl ca-certificates rsync -y
#RUN wget -qO- https://raw.githubusercontent.com/creationix/nvm/v0.33.2/install.sh | bash
#
#RUN source "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
#RUN source "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
#RUN source "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
#RUN cp /root/.nvm/versions/node/v${NODE_VERSION}/bin/node /usr/bin/
#RUN cp /root/.nvm/versions/node/v${NODE_VERSION}/bin/npm /usr/bin/
#
#RUN /root/.nvm/versions/node/v${NODE_VERSION}/bin/npm install yarn --global

RUN curl -sL https://deb.nodesource.com/setup_16.x  | bash -
RUN apt-get -y install nodejs
#RUN npm upgrade
RUN npm install yarn --global
#RUN yarn global add pm2

###########################################################################
# Install common util
###########################################################################

#RUN apt-get install -y certbot python3-certbot-nginx

ENTRYPOINT ["/startup.sh"]
