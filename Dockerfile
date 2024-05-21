FROM php:8.1-cli

WORKDIR /usr/src/myapp

COPY . .

CMD [ "/bin/bash" ]