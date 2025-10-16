<?php
namespace App\Tests\Entity;

use App\Entity\Contract;
use PHPUnit\Framework\TestCase;

final class ContractTest extends TestCase
{
    /**
     * @dataProvider dataCreate
     */
    public function testCreate(): void
    {
        $contract = new Contract();
        // $this->assertSame($%attribute%, $%entityName%->get%attribute%());
    }

    
    public static function dataCreate(): array
    {
        return [
            []
        ];
    }


}
