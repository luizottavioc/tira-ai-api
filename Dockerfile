FROM hyperf/hyperf:8.3-alpine-v3.19-swoole

ARG timezone

ENV TIMEZONE=${timezone:-"America/Sao_Paulo"} \
    SCAN_CACHEABLE=(true)

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

COPY start.sh /

EXPOSE 9501

CMD ["/start.sh"]