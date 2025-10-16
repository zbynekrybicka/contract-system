<?php
namespace App\Tests\Repository;

use App\Entity\Contact;
use App\Entity\User;
use App\Repository\ContactRepository;

final class ContactRepositoryTest extends DatabaseTestCase
{


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

// 
//     
//     /**
//      * @dataProvider dataInsert
//      */
//     public function testInsert(): void
//     {
//         /** @var ContactRepository $contactRepository */
//         $contactRepository = static::getContainer()->get(ContactRepository::class);
// 
//         /** @var ContactEntity $contact */
//         $contact = $contactRepository->insert();
// 
//         // Final check
//         // $this->assertNotNull();
//         // $this->assertSame();
//     }
// 
//     public static function dataInsert(): array
//     {
//         return [
//         ];
//     }
// 
//     
//     /**
//      * @dataProvider dataUpdate
//      */
//     public function testUpdate(): void
//     {
//         /** @var ContactRepository $contactRepository */
//         $contactRepository = static::getContainer()->get(ContactRepository::class);
// 
//         /** @var ContactEntity $contact */
//         $contact = $contactRepository->update();
// 
//         // Final check
//         // $this->assertNotNull();
//         // $this->assertSame();
//     }
// 
//     public static function dataUpdate(): array
//     {
//         return [
//         ];
//     }
// 
//     
//     /**
//      * @dataProvider dataDelete
//      */
//     public function testDelete(): void
//     {
//         /** @var ContactRepository $contactRepository */
//         $contactRepository = static::getContainer()->get(ContactRepository::class);
// 
//         /** @var ContactEntity $contact */
//         $contact = $contactRepository->delete();
// 
//         // Final check
//         // $this->assertNotNull();
//         // $this->assertSame();
//     }
// 
//     public static function dataDelete(): array
//     {
//         return [
//         ];
//     }
// 
//     
//     /**
//      * @dataProvider dataGetCountByUser
//      */
//     public function testGetCountByUser(): void
//     {
//         /** @var ContactRepository $contactRepository */
//         $contactRepository = static::getContainer()->get(ContactRepository::class);
// 
//         /** @var ContactEntity $contact */
//         $contact = $contactRepository->getCountByUser();
// 
//         // Final check
//         // $this->assertNotNull();
//         // $this->assertSame();
//     }
// 
//     public static function dataGetCountByUser(): array
//     {
//         return [
//         ];
//     }
// 
//     
}