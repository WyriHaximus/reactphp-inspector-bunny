<?php declare(strict_types=1);

namespace WyriHaximus\React\Tests\Inspector\Bunny;

use PHPUnit\Framework\TestCase;
use Bunny;
use WyriHaximus\React\Inspector\GlobalState;

final class FunctionsTest extends TestCase
{
    public function testFread()
    {
        GlobalState::clear();
        $handle = fopen('php://memory', 'a+');
        fwrite($handle, 'abc', 3);
        self::assertSame([], GlobalState::get());
        Bunny\fread($handle, 3);
        self::assertSame(['eventloop.io.read' => 0.0], GlobalState::get());
        rewind($handle);
        Bunny\fread($handle, 3);
        self::assertSame(['eventloop.io.read' => 3.0], GlobalState::get());
        fclose($handle);
    }

    public function testFwrite()
    {
        GlobalState::clear();
        $handle = fopen('php://memory', 'a+');
        self::assertSame([], GlobalState::get());
        Bunny\fwrite($handle, 'abc', 3);
        self::assertSame(['eventloop.io.write' => 3.0], GlobalState::get());
        fclose($handle);
    }
}
