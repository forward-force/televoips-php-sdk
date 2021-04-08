# TeleVoIPs API - PHP SDK

This is a wrapper around [TeleVoIPs API](https://televoips.com/). The API is very minimal, so this implementation is fairly simple.

## Authentication

In order to authenticate you need a token from TeleVoIPs. Head over to the developer portal to read updated procesure as how to
obtain one: https://developer.televoips.com/

TeleVoIPs is likely to give you a toke and a secret, the API requires the token only. 

## Messages API

You can send a message.

#### How to send a message:
```php
$televoips = new \ForwardForce\TeleVoIPs\TeleVoIPs('your-token');

try {
    $message = $televoips->message()
        ->setFrom('19876543210')
        ->setTo('9417264539')
        ->setMessage('Test SMS')
        ->send();
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    var_dump($e->getMessage());
}
```


## Contributions

To run locally, you can use the docker container provided here. You can run it like so:

```
docker-compose up
```

Then you can ssh into the `php-fpm` container. Please note, you need to set your token as
environmental variables `$TELEVOIPS_API_TOKEN`. 

`xdebug` is fully configured to work as cli, hookup your favorite IDE to it and debug away!

There is auto-generated documentation as to how to run this library on local, please  take a look at [phpdocker/README.md](phpdocker/README.md)

*If you find an issue, have a question, or a suggestion, please don't hesitate to open a github issue.*

### Acknowledgments 

Thank you to [phpdocker.io](https://phpdocker.io) for making getting PHP environments effortless! 
