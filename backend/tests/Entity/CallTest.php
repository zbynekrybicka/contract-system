<?php
namespace App\Tests\Entity;

use App\Entity\Call;
use PHPUnit\Framework\TestCase;

final class CallTest extends TestCase
{
    /**
     * @dataProvider dataCreate
     */
    public function testCreate(): void
    {
        $call = new Call();
        // $this->assertSame($%attribute%, $%entityName%->get%attribute%());
    }

    
    public static function dataCreate(): array
    {
        return [
            []
        ];
    }


}
