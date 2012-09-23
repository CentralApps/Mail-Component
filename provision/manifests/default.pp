stage { 'first': before => Stage[main] }
stage { 'ppa': before => Stage['first'] }
stage {'veryfirst': before => Stage['ppa'] }
stage { 'last': require => Stage[main] }
group { 'puppet': ensure => 'present' }
class {'apache': stage => first}
class {'modrewrite': stage => last}
class {'dns': stage => veryfirst }
class {'misc': stage => ppa }

import "dns"
include dns
import "apache"
include apache
import "php"
include php
import "mail"
include mail