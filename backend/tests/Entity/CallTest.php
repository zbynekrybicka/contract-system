<?php
namespace App\Tests\Entity;

use App\Entity\Call;
use PHPUnit\Framework\TestCase;

final class CallTest extends TestCase
{
    /**
     * @dataProvider data%TestName%
     */
    public function test%TestName%($%attribute%): void
    {
        $%entityName% = new Call();
        // $this->assertSame($%attribute%, $%entityName%->get%attribute%());
    }

    
    public static function data%TestName%(): array
    {
        return [
            
        ];
    }


}
