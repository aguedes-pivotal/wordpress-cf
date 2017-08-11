#!/bin/bash

APP_NAME=wpblog
MYSQL_SERVICE_NAME=wpblogdb
MYSQL_PLAN=100mb
NFS_SERVICE_NAME=wpblognfs
NFS_SERVER_IP=10.0.2.4
NFS_SERVER_PATH=/export/nfs10
NFS_CLIENT_MOUNT=/var/vcap/data/nfs10

cf push ${APP_NAME}
cf create-service nfs Existing ${NFS_SERVICE_NAME} -c "{\"share\":\"${NFS_SERVER_IP}${NFS_SERVER_PATH}\"}"
cf create-service p-mysql ${MYSQL_PLAN} ${MYSQL_SERVICE_NAME}
cf bind-service ${APP_NAME} ${MYSQL_SERVICE_NAME}
cf bind-service ${APP_NAME} ${NFS_SERVICE_NAME} -c "{\"uid\":\"0\",\"gid\":\"0\",\"mount\":\"${NFS_CLIENT_MOUNT}\"}"
cf restart ${APP_NAME}
cf ssh ${APP_NAME} -c "cd /tmp && wget https://wordpress.org/latest.tar.gz && tar xf latest.tar.gz && cp -R ./wordpress/wp-content/* ${NFS_CLIENT_MOUNT}/ && mkdir -p ${NFS_CLIENT_MOUNT}/uploads"
cf ssh ${APP_NAME} -c "ln -s ${NFS_CLIENT_MOUNT}/index.php /home/vcap/app/htdocs/wp-content/index.php"
cf ssh ${APP_NAME} -c "ln -s ${NFS_CLIENT_MOUNT}/plugins /home/vcap/app/htdocs/wp-content/plugins"
cf ssh ${APP_NAME} -c "ln -s ${NFS_CLIENT_MOUNT}/themes /home/vcap/app/htdocs/wp-content/themes"
cf ssh ${APP_NAME} -c "ln -s ${NFS_CLIENT_MOUNT}/uploads /home/vcap/app/htdocs/wp-content/uploads"