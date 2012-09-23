class apache {

  package { "apache2":
    ensure => present,
    require => Exec['apt-get update']
  }
  
  file { '/var/www/src':
       ensure => 'link',
       target => '/vagrant/src',
       require => Package['apache2']
    }
    
    file { '/var/www/vendor':
       ensure => 'link',
       target => '/vagrant/vendor',
       require => Package['apache2']
    }
    
    file { '/etc/apache2/sites-available/default':
        source => '/vagrant/provision/modules/apache/files/default',
        owner => 'root',
        group => 'root'
    }

  service { "apache2":
    ensure => running,
    require => Package["apache2"]
  }
}