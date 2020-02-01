FROM phpstan/phpstan:0.12.8
RUN composer global config minimum-stability dev && composer global config prefer-stable true
RUN composer global require \
    phpstan/phpstan-phpunit:0.12.6 \
    phpstan/phpstan-webmozart-assert:0.12.2

