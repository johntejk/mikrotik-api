# mikrotik-api


Instalation
----

Via composer:
```
composer require anovob/mikrotik-api
```

Or manually insert this block into your composer.json in require section:
```
"require": {
    "anovob/mikrotik-api": "dev-master", // <- this line
}
```


Basic Usage:
----

```$php
use MikrotikAPI\Roar\Roar;

// create a connection with Mikrotik Router

$conn = Roar::connect(['<host_ip>', '<username', '<password>']);
 
if($conn->isConnected()) {
    // you have access to Commands
    // and can call from here...
}
```

Getting interfaces:
---
```$php
use MikrotikAPI\Roar\Roar;
use MikrotikAPI\Commands\Interfaces;

$conn = Mikrokit::connect(['<host_ip>', '<username', '<password>']);
 
if($conn->isConnected()) {
    $iComm = new Interfaces($conn);
    $interfaces = $iComm->getAll() // returns all interfaces as array
    
    // you can send it to view 
    return view("<some_view>", [
        'interfaces' => $interfaces
    ]);
}
```



##### Created by anovob (A S M Saief)
##### (cc) 2018
##### License: MIT