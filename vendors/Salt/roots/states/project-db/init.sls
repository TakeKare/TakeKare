project-db:
  mysql_database.present:
    - name: '{{pillar['project']['db']['name']}}'
{% if pillar['env'] != 'dev' %}
  mysql_user.present:
    - name: '{{pillar['project-sensitive']['db']['user']}}'
    - host: localhost
    - password: '{{pillar['project-sensitive']['db']['pass']}}'
    - require:
      - service: mysqld
  mysql_grants:
    - present
    - grant: all
    - database: '{{pillar['project']['db']['name']}}.*'
    - user: '{{pillar['project-sensitive']['db']['user']}}'
    - host: localhost
{% endif %}

project-schema:
  cmd.run:
    - onlyif: test `mysql -Bse "SELECT COUNT(DISTINCT('table_name')) FROM information_schema.columns WHERE table_schema = '{{pillar['project']['db']['name']}}'"` -eq 0
    - name: 'php cake.php schema create --yes && php cake.php schema update --yes'
    - cwd: /var/www/{{pillar['project']['domain']}}/app/Console/
    - require:
      - cmd: project-source
      - mysql_database: project-db
