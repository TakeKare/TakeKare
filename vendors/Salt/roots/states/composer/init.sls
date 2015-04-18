get-composer:
  cmd.run:
    - name: /usr/bin/php -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"
    - unless: test -f /usr/local/bin/composer
    - cwd: /root/
    - require:
      - pkg: php5

install-composer:
  cmd.wait:
    - name: mv /root/composer.phar /usr/local/bin/composer && chmod +x /usr/local/bin/composer
    - cwd: /root/
    - watch:
      - cmd: get-composer

