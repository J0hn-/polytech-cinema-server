FROM pluie/alpine-symfony

COPY . /app
COPY ./app/config/parameters.yml.docker /app/app/config/parameters.yml

WORKDIR /app
