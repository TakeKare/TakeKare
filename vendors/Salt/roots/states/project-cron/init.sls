/etc/cron.d/{{ pillar['project']['name'] }}:
  file.managed:
    - source: salt://{{ pillar['project']['name'] }}/cron.jinja
    - template: jinja
{% if pillar['env'] == 'dev' %}
    - replace: False
{% endif %}
