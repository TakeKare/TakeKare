apache2:
  pkg:
    - installed
  service:
    - running
    - enable: True
    - watch:
      - pkg: apache2
#      - file: /etc/apache2/apache2.conf
      - user: www-data
www-data:
  user.present:
    - uid: 33
    - gid: 33
    - home: /var/www
    - shell: /bin/sh
    - require:
      - group: www-data
  group.present:
    - gid: 33
    - require:
      - pkg: apache2
