{% for pkg in pillar['project']['php5']['mods'] %}
{{pkg}}:
  pkg:
    - installed
    - require:
      - pkg: php5
    - watch_in:
      - service: apache2
{% endfor %}

