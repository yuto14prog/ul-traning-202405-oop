FROM php:8.1-cli

WORKDIR /usr/src/myapp

COPY . .

CMD [ "/bin/bash" ]

# docker run -it --name training-oop -v "$(pwd)"/:/usr/src/myapp training:oop