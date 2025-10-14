<?php
namespace App\Tests\Repository;

use App\Entity\ContractEntity;
use App\Repository\ContractRepository;

final class ContractRepositoryTest extends DatabaseTestCase
{
    /**
     * @dataProvider dataGetByContact
     */
    public function testGetByContact(): void
    {
        /** @var ContractRepository $contractRepository */
        $contractRepository = static::getContainer()->get(ContractRepository::class);

        /** @var ContractEntity $contract */
        $contract = $contractRepository->getByContact();

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
     * @dataProvider dataGetAll
     */
    public function testGetAll(): void
    {
        /** @var ContractRepository $contractRepository */
        $contractRepository = static::getContainer()->get(ContractRepository::class);

        /** @var ContractEntity $contract */
        $contract = $contractRepository->getAll();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataGetAll(): array
    {
        return [
        ];
    }

    
    /**
     * @dataProvider dataGetOne
     */
    public function testGetOne(): void
    {
        /** @var ContractRepository $contractRepository */
        $contractRepository = static::getContainer()->get(ContractRepository::class);

        /** @var ContractEntity $contract */
        $contract = $contractRepository->getOne();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataGetOne(): array
    {
        return [
        ];
    }

    
    /**
     * @dataProvider dataInsert
     */
    public function testInsert(): void
    {
        /** @var ContractRepository $contractRepository */
        $contractRepository = static::getContainer()->get(ContractRepository::class);

        /** @var ContractEntity $contract */
        $contract = $contractRepository->insert();

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
        /** @var ContractRepository $contractRepository */
        $contractRepository = static::getContainer()->get(ContractRepository::class);

        /** @var ContractEntity $contract */
        $contract = $contractRepository->update();

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
        /** @var ContractRepository $contractRepository */
        $contractRepository = static::getContainer()->get(ContractRepository::class);

        /** @var ContractEntity $contract */
        $contract = $contractRepository->dalete();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataDelete(): array
    {
        return [
        ];
    }

    
    /**
     * @dataProvider dataGetSumByUser
     */
    public function testGetSumByUser(): void
    {
        /** @var ContractRepository $contractRepository */
        $contractRepository = static::getContainer()->get(ContractRepository::class);

        /** @var ContractEntity $contract */
        $contract = $contractRepository->getSumByUser();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataGetSumByUser(): array
    {
        return [
        ];
    }

    
}