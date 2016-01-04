FROM php:7.0

EXPOSE 9090

CMD ["php", "-S", "0.0.0.0:9090", "php/index.php"]
