<?php

namespace Bunny;

use WyriHaximus\React\Inspector\GlobalState;

function fread($handle, $length)
{
    $data = \fread($handle, $length);
    GlobalState::incr('eventloop.io.read', (float)strlen($data));
    return $data;
}

function fwrite($handle, $data)
{
    $writtenLength = \fwrite($handle, $data);
    GlobalState::incr('eventloop.io.write', (float)$writtenLength);
    return $writtenLength;
}
