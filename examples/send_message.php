<?php
require_once __DIR__ . '../../vendor/autoload.php';

use ForwardForce\TeleVoIPs\TeleVoIPs;
use GuzzleHttp\Exception\GuzzleException;

//assumes token is in env var, or you can pass directly
$token = getenv('TELEVOIPS_API_TOKEN');

//instance of the TeleVoIPs client
$televoips = new TeleVoIPs($token);

//get all jobs, paginated - 10 at a time
try {
    $message = $televoips->message()
        ->setFrom('19876543210')
        ->setTo('9417264539')
        ->setMessage('Test SMS')
        ->send();
    var_dump($message);
} catch (GuzzleException $e) {
    var_dump($e->getMessage());
}
