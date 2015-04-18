php5-xdebug:
  pkg:
    - installed
    - require:
      - pkg: php5
      - pkg: apache2

/etc/php5/mods-available/xdebug.ini:
  file.managed:
    - source: salt://xdebug/xdebug.ini
    - require:
      - pkg: php5-xdebug
  cmd.run:
    - name: php5enmod xdebug
    - unless: test "xdebug" = $(php -m | egrep xdebug)
    - watch_in:
      - service: apache2