FROM hyperf/hyperf:8.3-alpine-v3.19-swoole

ARG timezone
ARG UID=1000

ENV TIMEZONE=${timezone:-"America/Sao_Paulo"} \
    SCAN_CACHEABLE=(true)

RUN set -ex \
    && apk add --no-cache shadow \
    && addgroup -g ${UID} hyperf \
    && adduser -u ${UID} -G hyperf -h /home/hyperf -s /bin/sh -D hyperf \
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
RUN chown -R hyperf:hyperf /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY start.sh /

USER hyperf
EXPOSE 9501

CMD ["/start.sh"]