Vagrant.configure("2") do |config|

  config.vm.box = "quantal64"
  config.vm.box_url = "https://github.com/downloads/roderik/VagrantQuantal64Box/quantal64.box"

  config.vm.network :private_network, ip: "10.10.10.30"

  #config.cache.auto_detect = true

  #config.vm.provider :virtualbox do |v|
  #  v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  #  v.customize ["modifyvm", :id, "--memory", 256]
  #  v.customize ["modifyvm", :id, "--name", "my-first-box"]
  #end

  ## For masterless, mount your salt file root
  config.vm.synced_folder "./", "/var/www/yambuild.com", id: "vagrant-root",
    owner: "vagrant",
    group: "www-data",
    mount_options: ["dmode=775,fmode=664"]
  config.vm.synced_folder "./vendors/Salt/roots", "/srv/salt"
  config.vm.synced_folder "../winningbet.com", "/var/www/winningbet.com"

  ## Use all the defaults:
  config.vm.provision :salt do |salt|

    salt.minion_config = "vendors/Salt/minion"
    salt.run_highstate = true
    salt.verbose = true

  end

end
