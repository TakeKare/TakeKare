php5:
  pkg:
    - installed

#/etc/apache2/mods-enabled/php5.load:
#  file.symlink:
#    - target: /etc/apache2/mods-available/php5.load
#    - watch_in:
#      - service: apache2
#    - require:
#      - pkg: apache2
#      - pkg: php5

php5-enmod:
  cmd.run:
    - unless: test -f /etc/apache2/mods-enabled/php5.load
    - name: a2enmod php5
    - watch_in:
      - service: apache2
    - require:
      - pkg: apache2
      - pkg: php5