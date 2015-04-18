/etc/timezone:
  file.managed:
    - source: salt://timezone/timezone
    - user: root
    - group: root
    - mode: 644

/etc/localtime:
  file.managed:
    - source: salt://timezone/localtime
    - user: root
    - group: root
    - mode: 644

