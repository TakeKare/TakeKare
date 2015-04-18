base:
  '*':
    - bash-aliases
    - timezone
    - ntp
    - saltstack-ppa

  'winningbet*':
    - expect
    - git-core
    - apache2
    - apache2-mods
    - apache2-vhost
    - mysql-server
    - php5
    - php5-mods
    - composer
    - project-source
    - project-db
    - project-cron

  'winningbet':
    - mysql-secure

  'winningbet-dev':
    - phpmyadmin
    - phpmyadmin-dev-config
    - xdebug
