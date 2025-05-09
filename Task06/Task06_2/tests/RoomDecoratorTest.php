<?php

namespace App\Tests;
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\EconomyRoom;
use App\StandardRoom;
use App\LuxuryRoom;
use App\InternetDecorator;
use App\SofaDecorator;
use App\FoodDeliveryDecorator;
use App\BreakfastDecorator;
use App\DinnerDecorator;

class RoomDecoratorTest extends TestCase
{
    public function testEconomyRoom(): void
    {
        $room = new EconomyRoom();
        $this->assertEquals('Эконом', $room->getDescription());
        $this->assertEquals(1000, $room->getPrice());
    }

    public function testStandardRoom(): void
    {
        $room = new StandardRoom();
        $this->assertEquals('Стандарт', $room->getDescription());
        $this->assertEquals(2000, $room->getPrice());
    }

    public function testStandardRoomWithInternet(): void
    {
        $room = new StandardRoom();
        $room = new InternetDecorator($room);
        $this->assertEquals('Стандарт, выделенный Интернет', $room->getDescription());
        $this->assertEquals(2100, $room->getPrice());
    }

    public function testLuxuryRoomWithAllServices(): void
    {
        $room = new LuxuryRoom();
        $room = new InternetDecorator($room);
        $room = new SofaDecorator($room);
        $room = new FoodDeliveryDecorator($room);
        $room = new BreakfastDecorator($room);
        $room = new DinnerDecorator($room);
        $expectedDescription = 'Люкс, выделенный Интернет, дополнительный диван, доставка еды в номер, завтрак "шведский стол", ужин';
        $this->assertEquals($expectedDescription, $room->getDescription());
        $this->assertEquals(5200, $room->getPrice());
    }

    public function testEconomyRoomWithBreakfastAndDinner(): void
    {
        $room = new EconomyRoom();
        $room = new BreakfastDecorator($room);
        $room = new DinnerDecorator($room);
        $this->assertEquals('Эконом, завтрак "шведский стол", ужин', $room->getDescription());
        $this->assertEquals(2300, $room->getPrice());
    }

    public function testLuxuryRoomWithSingleDecorator(): void
    {
        $room = new LuxuryRoom();
        $room = new SofaDecorator($room);
        $this->assertEquals('Люкс, дополнительный диван', $room->getDescription());
        $this->assertEquals(3500, $room->getPrice());
    }
}