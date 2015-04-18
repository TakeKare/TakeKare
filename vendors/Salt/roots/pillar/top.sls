base:
  '*':
    - default

  'winningbet*':
    - winningbet

  '* and not *dev':
    - match: compound
    - env_prod
    - winningbet-sensitive

  '*dev':
    - env_dev
