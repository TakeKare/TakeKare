{% if pillar['env'] != 'dev' %}

/root/.ssh/id_rsa:
  file.managed:
    - source: salt://{{pillar['project']['name']}}/id_rsa
    - mode: 600

/root/.ssh/known_hosts:
  cmd.run:
    - unless: test -e /root/.ssh/known_hosts
    - name: ssh-keyscan -t rsa bitbucket.org > known_hosts
    - cwd: /root/.ssh

project-source:
  cmd.run:
    - unless: test -d /var/www/{{pillar['project']['domain']}}
    - name: git clone {{pillar['project']['git']}}
    - cwd: /var/www/
    - require:
      - pkg: git-core
      - file: /root/.ssh/id_rsa
      - cmd: /root/.ssh/known_hosts

{% else %}

project-source:
  cmd.run:
    - name: test -d /var/www/{{pillar['project']['domain']}}

{% endif %}

{% for app in ['app'] %}

/var/www/{{pillar['project']['domain']}}/{{app}}/Config/database.php:
  file.managed:
    - source: salt://{{pillar['project']['name']}}/database.php.jinja
    - mode: 777
    - template: jinja
    - context:
      db_name: '{{ pillar['project']['db']['name'] }}'
      db_prefix: '{{ pillar['project']['db']['prefix'] }}'
{% if pillar['env'] != 'dev' %}
      db_user: '{{ pillar['project-sensitive']['db']['user'] }}'
      db_pass: '{{ pillar['project-sensitive']['db']['pass'] }}'
{% else %}
      db_user: 'root'
      db_pass: ''
    - replace: False
{% endif %}
    - require:
      - cmd: project-source
{% if pillar['env'] == 'dev' %}
    - replace: False
{% endif %}

/var/www/{{pillar['project']['domain']}}/{{app}}/tmp:
  file.directory:
    - makedirs: True
    - recurse:
      - mode
    - require:
      - cmd: project-source

/var/www/{{pillar['project']['domain']}}/{{app}}/tmp/cache:
  file.directory:
    - makedirs: True
    - require:
      - cmd: project-source

/var/www/{{pillar['project']['domain']}}/{{app}}/tmp/cache/models:
  file.directory:
    - makedirs: True
    - require:
      - cmd: project-source

/var/www/{{pillar['project']['domain']}}/{{app}}/tmp/cache/persistent:
  file.directory:
    - makedirs: True
    - require:
      - cmd: project-source

project-config-local:
  cmd.run:
    - name: cp app_local.php.default app_local.php
    - unless: test -f app_local.php
    - cwd: /var/www/{{pillar['project']['domain']}}/{{app}}/Config
    - require:
      - cmd: project-source

{% endfor %}

project-composer:
  cmd.run:
{% if pillar['env'] != 'dev' %}
    - name: composer install --no-dev
{% else %}
    - name: composer install
{% endif %}
    - cwd: /var/www/{{pillar['project']['domain']}}
    - require:
      - cmd: project-source
      - cmd: install-composer