FROM hyperf/hyperf:8.3-alpine-v3.19-swoole

ARG timezone

ENV TIMEZONE=${timezone:-"America/Sao_Paulo"} \
    SCAN_CACHEABLE=(true)

# RUN apk update && apk add --no-cache zip unzip curl openssh-client wget git
# RUN mkdir /root/.ssh && chmod 0700 /root/.ssh
# RUN ssh-keyscan bitbucket.org > /root/.ssh/known_hosts

RUN set -ex \
    && php --ri swoole \
    && cd /etc/php* \
    && { \
        echo "upload_max_filesize=128M"; \
        echo "post_max_size=128M"; \
        echo "memory_limit=1G"; \
        echo "date.timezone=${TIMEZONE}"; \
    } | tee conf.d/99_overrides.ini \
    && ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man

WORKDIR /var/www
COPY . /var/www

RUN composer install --no-dev -o

EXPOSE 9501

CMD ["/bin/sh", "-c" , "php bin/hyperf.php start"]