<?php
namespace App\Tests\Entity;

use App\Entity\Contract;
use PHPUnit\Framework\TestCase;

final class ContractTest extends TestCase
{
    /**
     * @dataProvider data%TestName%
     */
    public function test%TestName%($%attribute%): void
    {
        $%entityName% = new Contract();
        // $this->assertSame($%attribute%, $%entityName%->get%attribute%());
    }

    
    public static function data%TestName%(): array
    {
        return [
            
        ];
    }


}
