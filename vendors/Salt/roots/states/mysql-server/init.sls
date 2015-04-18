mysql-server:
  pkg.installed

python-mysqldb:
  pkg.installed

mysqld:
  pkg:
    - installed
    - name: mysql-server
  service:
    - name: mysql
    - running
    - enable: True
    - require:
      - pkg: mysql-server
      - pkg: python-mysqldb

