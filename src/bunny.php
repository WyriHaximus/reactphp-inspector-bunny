<?php

namespace Bunny;

use WyriHaximus\React\Inspector\F42\GlobalState;

function fread($handle, $length)
{
    $data = \fread($handle, $length);
    GlobalState::incr('read', strlen($data));
    return $data;
}

function fwrite($handle, $data)
{
    $writtenLength = \fwrite($handle, $data);
    GlobalState::incr('write', $writtenLength);
    return $writtenLength;
}
