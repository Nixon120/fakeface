# FIS Library

This is the AllDigitalRewards FIS A2A API Wrapper  

## Install

Via Composer

``` bash
composer config repositories.rap vcs git@bitbucket.org:alldigitalrewards/fis.git
composer require alldigitalrewards/fis
```

## Usage

Create a Person
``` php
<?php
require __DIR__ . '/vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();
$parameters = [
    'userid' => 'FIS_USER',
    'pwd' => 'FIS_PASSWORD',
    'sourceid' => 'FIS_SOURCE_ID',
    'fisCertificate' => 'FIS_CERTIFICATE_FILEPATH',
    'fisCerticatePassword' => 'FIS_CERTIFICATE_PASSWORD'
];
$development = true;

# Connect
$client = new \AllDigitalRewards\FIS\Client(
    $httpClient,
    $parameters, 
    $development
);

# Hydrate a PersonRequest Object.

$personRequest = new PersonRequest;
$personRequest->setFirstname('John');
$personRequest->setLastname('Smith');
$personRequest->setAddr1('123 Acme Dr.');
$personRequest->setAddr2('');
$personRequest->setCity('Beverly Hills');
$personRequest->setState('CA');
$personRequest->setZip('90210');
$personRequest->setCountrycode(840);

if($personRequest->isValid()) {
    return $this->fis->createPerson($personRequest);
}
```

## Testing

``` bash
$ composer test
```