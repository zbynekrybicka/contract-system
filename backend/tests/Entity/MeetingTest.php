<?php
namespace App\Tests\Entity;

use App\Entity\Meeting;
use PHPUnit\Framework\TestCase;

final class MeetingTest extends TestCase
{
    /**
     * @dataProvider data%TestName%
     */
    public function test%TestName%($%attribute%): void
    {
        $%entityName% = new Meeting();
        // $this->assertSame($%attribute%, $%entityName%->get%attribute%());
    }

    
    public static function data%TestName%(): array
    {
        return [
            
        ];
    }


}
