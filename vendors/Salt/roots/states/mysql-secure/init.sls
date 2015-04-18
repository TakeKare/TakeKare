mysql-secure:
  cmd.script:
    - source: salt://mysql-secure/mysql-secure.sh.jinja
    - template: jinja
    - context:
      root_pass: {{ pillar['project-sensitive']['db']['root_pass'] }}
    - onlyif: '/usr/bin/env HOME=/ mysql -u root -Bse "show databases"'
    - require:
      - service: mysql
      - pkg: mysql-server
      - pkg: expect

/root/.my.cnf:
  file.managed:
    - source: salt://mysql-secure/root.my.cnf.jinja
    - template: jinja
    - context:
      root_pass: {{ pillar['project-sensitive']['db']['root_pass'] }}
    - user: root
    - group: root
    - mode: 600
    - require:
      - cmd: mysql-secure
