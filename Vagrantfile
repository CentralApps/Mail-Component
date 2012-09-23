# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|

  config.vm.box = "precise64"
  config.vm.box_url = "/Volumes/development/Vagrant Boxes/precise64-patched.box"
  
  config.ssh.max_tries = 50
  config.ssh.timeout = 300
  
  config.vm.forward_port 80, 4567
  
  Vagrant::Config.run do |config|
    config.vm.share_folder("v-root", "/vagrant", ".", :extra => 'dmode=777,fmode=777')
    config.vm.provision :shell, :inline => "echo \"Europe/London\" | sudo tee /etc/timezone && dpkg-reconfigure --frontend noninteractive tzdata"
  end
  
  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "provision/manifests"
    puppet.manifest_file  = "default.pp"
    puppet.module_path = "provision/modules"
  end

end