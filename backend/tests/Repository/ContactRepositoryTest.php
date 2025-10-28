<?php
namespace App\Tests\Repository;

use App\Entity\Contact;
use App\Entity\User;
use App\Repository\ContactRepository;

final class ContactRepositoryTest extends DatabaseTestCase
{
    /**
     * @dataProvider dataGetBySuperior
     */
    public function testGetBySuperior() 
    {
        /** @var ContactRepository $contactRepository */
        $contactRepository = static::getContainer()->get(ContactRepository::class);

    }
    public static function dataGetBySuperior()
    {
        return [];
    }






    /**
     * @dataProvider dataFindWithSuperior
     */
    public function testFindWithSuperior(int $superiorId, int $contactId, bool $exists): void
    {
        /** @var ContactRepository $contactRepository */
        $contactRepository = static::getContainer()->get(ContactRepository::class);

        $superior = $contactRepository->find($superiorId);
        /** @var ContactEntity $contact */
        $contact = $contactRepository->findWithSuperior($superior, $contactId);

        // Final check
        if ($exists) {
            $this->assertNotNull($contact); 
        } else {
            $this->assertNull($contact);
        }
    }

    public static function dataFindWithSuperior(): array
    {
        return [
            [1, 4, true],
            [1, 2, false]
        ];
    }

    





    

    /**
     * @dataProvider dataGetCountByContact
     */
    public function testGetCountByContact() 
    {
        /** @var ContactRepository $contactRepository */
        $contactRepository = static::getContainer()->get(ContactRepository::class);

    }
    public static function dataGetCountByContact()
    {
        return [];
    }
   





    

    /**
     * @dataProvider dataCreate
     */
    public function testCreate() 
    {
        /** @var ContactRepository $contactRepository */
        $contactRepository = static::getContainer()->get(ContactRepository::class);

    }
    public static function dataCreate()
    {
        return [];
    }







}