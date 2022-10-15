FROM alpine

ENV LANG=zh_CN.UTF-8 \
    TZ=Asia/Shanghai \
    WORKDIR=/var/www \
    PS1="\u@\h:\w \$ "

RUN apk update \
    && apk upgrade -a || apk fix \
    && apk add --no-cache \
    bash \
    busybox-suid \
    caddy \
    git \
    php8 \
    php8-curl \
    php8-fpm \
    php8-gd \
    php8-json \
    php8-mbstring \
    php8-mysqli \
    php8-session \
    php8-zip \
    s6-overlay \
    shadow \
    tzdata \
    && caddy upgrade \
    && ln -sf /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo -e "${TZ}" > /etc/timezone \
    && rm -rf $WORKDIR/* /var/cache/apk/* /tmp/* \
    && git config --global pull.ff only \
    && git clone --depth=1 -b master https://github.com/0A0A0A0/Tieba-Cloud-Sign $WORKDIR \
    && cp -r /var/www/docker/s6-overlay/etc/* /etc/

ENTRYPOINT ["/init"]
