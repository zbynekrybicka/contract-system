<?php
namespace App\Tests\Repository;

use App\Entity\ContactEntity;
use App\Repository\ContactRepository;

final class ContactRepositoryTest extends DatabaseTestCase
{
    /**
     * @dataProvider dataGetByContact
     */
    public function testGetByContact(): void
    {
        /** @var ContactRepository $contactRepository */
        $contactRepository = static::getContainer()->get(ContactRepository::class);

        /** @var ContactEntity $contact */
        $contact = $contactRepository->getByContact();

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
     * @dataProvider dataGetOne
     */
    public function testGetOne(): void
    {
        /** @var ContactRepository $contactRepository */
        $contactRepository = static::getContainer()->get(ContactRepository::class);

        /** @var ContactEntity $contact */
        $contact = $contactRepository->getOne();

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
        /** @var ContactRepository $contactRepository */
        $contactRepository = static::getContainer()->get(ContactRepository::class);

        /** @var ContactEntity $contact */
        $contact = $contactRepository->insert();

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
        /** @var ContactRepository $contactRepository */
        $contactRepository = static::getContainer()->get(ContactRepository::class);

        /** @var ContactEntity $contact */
        $contact = $contactRepository->update();

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
        /** @var ContactRepository $contactRepository */
        $contactRepository = static::getContainer()->get(ContactRepository::class);

        /** @var ContactEntity $contact */
        $contact = $contactRepository->delete();

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
     * @dataProvider dataGetCountByUser
     */
    public function testGetCountByUser(): void
    {
        /** @var ContactRepository $contactRepository */
        $contactRepository = static::getContainer()->get(ContactRepository::class);

        /** @var ContactEntity $contact */
        $contact = $contactRepository->getCountByUser();

        // Final check
        // $this->assertNotNull();
        // $this->assertSame();
    }

    public static function dataGetCountByUser(): array
    {
        return [
        ];
    }

    
}