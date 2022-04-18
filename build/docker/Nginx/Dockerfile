FROM nginx:1.21

RUN apt-get update && apt-get install -y nano && \
    groupadd -g 1000 afroze && useradd -r -u 1000 -g afroze afroze && usermod -aG www-data afroze
