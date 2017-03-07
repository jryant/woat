<?php
// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$debug = require( 'vendor/autoload.php' );

$groupsApi = (new MailerLiteApi\MailerLite("f7808fae03657e871f6e70fbd6ff4970"))->groups();

$subscriber = [
    'email' => 'test@email.com',
    'fields' => [
        'name' => 'John',
        'last_name' => 'Doe',
        'company' => 'John Doe Co.'
    ]
];

$debug = $groupsApi->addSubscriber(5560834, $subscriber); // Change GROUP_ID with ID of group you want to add subscriber to

echo "<pre>";
var_dump($debug);
echo "</pre>";

?>
