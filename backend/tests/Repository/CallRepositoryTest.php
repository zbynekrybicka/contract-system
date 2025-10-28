<?php
namespace App\Tests\Repository;

use App\Entity\CallEntity;
use App\Repository\CallRepository;

final class CallRepositoryTest extends DatabaseTestCase
{

    /**
     * @dataProvider dataGetCountBySender
     */
    public function testGetCountBySender() 
    {
        /** @var CallRepository $callRepository */
        $callRepository = static::getContainer()->get(CallRepository::class);

    }
    public static function dataGetCountBySender()
    {
        return [];
    }
    




    
    /**
     * @dataProvider dataCreate
     */
    public function testCreate() 
    {
        /** @var CallRepository $callRepository */
        $callRepository = static::getContainer()->get(CallRepository::class);

    }
    public static function dataCreate()
    {
        return [];
    }
}