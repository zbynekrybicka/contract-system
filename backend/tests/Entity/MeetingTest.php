<?php
namespace App\Tests\Entity;

use App\Entity\Meeting;
use PHPUnit\Framework\TestCase;

final class MeetingTest extends TestCase
{
    /**
     * @dataProvider dataCreate
     */
    public function testCreate(): void
    {
        $meeting = new Meeting();
        // $this->assertSame($%attribute%, $%entityName%->get%attribute%());
    }

    
    public static function dataCreate(): array
    {
        return [
            []
        ];
    }


}
