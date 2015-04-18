/home/vagrant/.bash_aliases:
  file.managed:
    - source: salt://bash-aliases/.bash_aliases
    - user: root
    - group: root
    - mode: 644
