project:
  name: winningbet
  domain: winningbet.com
  db:
    name: winningbet
    prefix: wb_
  git: git@bitbucket.org:andrej_griniuk/winningbet.com.git
  apache2:
    mods:
      - rewrite
      - ssl
  php5:
    mods:
      - php-pear
      - php5-cli
      - php5-mysql
      - php5-dev
      - php5-gd
      - php5-curl
      - php-apc
