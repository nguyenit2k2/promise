<?php
$startAt = (new DateTime)->format('H:i:s.u');
$sleepSeconds = random_int(1, 5);
sleep($sleepSeconds);

$endAt = (new DateTime)->format('H:i:s.u');
echo sprintf(
    "Request: %s, start at: %s, end at: %s, sleep: %s<br>",
    $_GET['idx'],
    $startAt,
    $endAt,
    $sleepSeconds
);
