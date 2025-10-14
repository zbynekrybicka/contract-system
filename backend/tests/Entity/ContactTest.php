<?php
namespace App\Tests\Entity;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

final class ContactTest extends TestCase
{
    /**
     * @dataProvider data%TestName%
     */
    public function test%TestName%($%attribute%): void
    {
        $%entityName% = new Contact();
        // $this->assertSame($%attribute%, $%entityName%->get%attribute%());
    }

    
    public static function data%TestName%(): array
    {
        return [
            
        ];
    }


}
