{% for mod in pillar['project']['apache2']['mods'] %}
a2enmod-{{mod}}:
  cmd.run:
    - unless: test -f /etc/apache2/mods-enabled/{{mod}}.load
    - name: a2enmod {{mod}}
    - require:
      - pkg: apache2
    - watch_in:
      - service: apache2
{% endfor %}

