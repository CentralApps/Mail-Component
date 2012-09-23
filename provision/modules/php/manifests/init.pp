class php {

  package { "php5":
    ensure => present,
    require => [ Exec['apt-get update'], Package[apache2] ]
  }

  package { "php5-dev":
    ensure => present, 
    require => [ Exec['apt-get update'], Package[apache2] ] 
  }
  
  package { "php5-curl":
    ensure => present, 
    require => [ Exec['apt-get update'], Package[apache2] ] 
  }
  
  
  package { "php5-cli":
    ensure => present, 
    require => [ Exec['apt-get update'], Package[apache2] ] 
  }
  
  package { "libapache2-mod-php5":
    ensure => present,
    require => Package[php5]
  }
  
  exec { "reload-apache2":
      command => "/etc/init.d/apache2 reload",
      refreshonly => true,
      require => [ Exec['apt-get update'], Package[apache2], File['/etc/apache2/sites-available/default'] ]
  }
  

}