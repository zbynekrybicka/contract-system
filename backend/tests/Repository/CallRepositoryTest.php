<?php
namespace App\Tests\Repository;

use App\Entity\CallEntity;
use App\Repository\CallRepository;

final class CallRepositoryTest extends DatabaseTestCase
{
    /**
     * @dataProvider dataGetByContact
     */
    public function testGetByContact(): void
    {
        /** @var CallRepository $callRepository */
        $callRepository = static::getContainer()->get(CallRepository::class);

        /** @var CallEntity $call */
        $call = $callRepository->getByContact();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataGetByContact(): array
    {
        return [
        ];
    }


    /**
     * @dataProvider dataInsert
     */
    public function testInsert(): void
    {
        /** @var CallRepository $callRepository */
        $callRepository = static::getContainer()->get(CallRepository::class);

        /** @var CallEntity $call */
        $call = $callRepository->insert();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataInsert(): array
    {
        return [
        ];
    }


    /**
     * @dataProvider dataUpdate
     */
    public function testUpdate(): void
    {
        /** @var CallRepository $callRepository */
        $callRepository = static::getContainer()->get(CallRepository::class);

        /** @var CallEntity $call */
        $call = $callRepository->update();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataUpdate(): array
    {
        return [
        ];
    }


    /**
     * @dataProvider dataDelete
     */
    public function testDelete(): void
    {
        /** @var CallRepository $callRepository */
        $callRepository = static::getContainer()->get(CallRepository::class);

        /** @var CallEntity $call */
        $call = $callRepository->delete();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataDelete(): array
    {
        return [
        ];
    }

    
}