<?php

//Return [
//    'email' => 'user@email.com',
//    'name' => 'UserName',
//];
Return [
    'email' => env('RECIPIENT_EMAIL'),
    'name' => env('RECIPIENT_NAME'),
];
