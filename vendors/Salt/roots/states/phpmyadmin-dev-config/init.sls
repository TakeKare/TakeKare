phpmyadmin-apache-config:
  file.append:
    - name: /etc/apache2/apache2.conf
    - text: Include /etc/phpmyadmin/apache.conf
    - require:
      - pkg: phpmyadmin
      - pkg: apache2
    - watch_in:
      - service: apache2

/etc/phpmyadmin/config.inc.php:
  file.append:
    - text:
      - $cfg['Servers'][1]['AllowNoPassword'] = TRUE;
      - $cfg['Servers'][1]['auth_type'] = 'config';
      - $cfg['Servers'][1]['user'] = 'root';
    - require:
      - pkg: phpmyadmin

