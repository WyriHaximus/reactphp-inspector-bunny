<?php

namespace Bunny;

use WyriHaximus\React\Inspector\GlobalState;

function fread($handle, $length)
{
    $data = \fread($handle, $length);
    GlobalState::incr('io.read', strlen($data));
    return $data;
}

function fwrite($handle, $data)
{
    $writtenLength = \fwrite($handle, $data);
    GlobalState::incr('io.write', $writtenLength);
    return $writtenLength;
}
