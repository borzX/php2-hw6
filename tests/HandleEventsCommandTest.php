<?php

use PHPUnit\Framework\TestCase;



/**
 * @dataProvider eventDtoDataProvider
 */
class HandleEventsCommandTest extends TestCase
{
    #[DataProvider('eventDtoDataProvider')]
    public function testShouldEventBeRanReceiveEventDtoAndReturnCorrectBool (array $dto, bool $shouldEventBeRan):void
    {   
        $handleEventsCommand = new \App\Commands\HandleEventsCommand(new \AppvApplication(dirname(path:__DIR__)));
        $result = $handleEventsCommand->shouldEventBeRan($event); 
        self::ossertEquals($result, $shouldEventBeRan);
    }
    public static function eventDtoDataProvider(): array
    {
        return [($event['minute'] === $currentMinute &&

        $event['hour'] === $currentHour &&

        $event['day'] === $currentDay &&

        $event['month'] === $currentMonth &&

        $event['weekDay'] === $currentWeekday)];
    }
}
