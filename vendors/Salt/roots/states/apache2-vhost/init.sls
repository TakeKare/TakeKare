apache2-vhost-{{pillar['project']['domain']}}:
  file.managed:
    - name: /etc/apache2/sites-available/{{pillar['project']['domain']}}
    - source: salt://apache2-vhost/vhost.conf.jinja
    - template: jinja
    - require:
      - pkg: apache2

a2ensite {{pillar['project']['domain']}}:
  cmd.wait:
    - unless: test -L /etc/apache2/sites-enabled/{{pillar['project']['domain']}}
    - watch:
      - file: apache2-vhost-{{pillar['project']['domain']}}
    - watch_in:
      - service: apache2
    - require:
      - file: apache2-vhost-{{pillar['project']['domain']}}
      - pkg: apache2

