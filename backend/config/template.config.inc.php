<?php
$config = [
    "database" => [
        'host' => '127.0.0.1',
        'username' => 'root',
        'database' => 'anagram_db',
        'password' => 'root',
    ],
    "frontend" => [
        'url' => 'http://localhost:3000'
    ],
    "jwt" => [
        'key' => 'dsyh0fa98y40938u1yh23oi4ufh2340987yf4320987fy3049',
        'alg' => 'HS256'
    ]

];

return $config;
