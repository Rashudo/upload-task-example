FROM nginx:1.13

ADD ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/vhosts /etc/nginx/vhosts
COPY ./docker/nginx/certs /etc/nginx/certs
COPY ./project /var/www/html

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
