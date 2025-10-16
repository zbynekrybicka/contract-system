<?php
namespace App\Tests\Entity;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

final class ContactTest extends TestCase
{
    /**
     * @dataProvider dataCreate
     */
    public function testCreate(Contact $superior, string $firstName, string $middleName, string $lastName, int $dialNumber, string $phoneNumber, string $email): void
    {
        $contact = new Contact($superior, $firstName, $middleName, $lastName, $dialNumber, $phoneNumber, $email);
        $this->assertSame($contact->getFirstName(), $firstName);
        $this->assertSame($contact->getMiddleName(), $middleName);
        $this->assertSame($contact->getLastName(), $lastName);
        $this->assertSame($contact->getDialNumber(), $dialNumber);
        $this->assertSame($contact->getPhoneNumber(), $phoneNumber);
        $this->assertSame($contact->getEmail(), $email);
    }

    
    public static function dataCreate(): array
    {
        $superior = new Contact(null, "Martin", "Olej", "Olejar", 420, "727815483", "martin.olejar@gmail.com");
        return [
            [$superior, "Zbynek", "Kossai", "Rybicka", 420, "727815483", "zbynek.rybicka@gmail.com"],
            [$superior, "", "", "", 0, "", ""]
        ];
    }


    /**
     * @dataProvider dataHydrate
     */
    public function testHydrate(Contact $superior, string $firstName, string $middleName, string $lastName, int $dialNumber, string $phoneNumber, string $email,
        string $newFirstName, string $newMiddleName, string $newLastName, int $newDialNumber, string $newPhoneNumber, string $newEmail): void
    {
        $contact = new Contact($superior, $firstName, $middleName, $lastName, $dialNumber, $phoneNumber, $email);
        $this->assertSame($contact->getFirstName(), $firstName);
        $this->assertSame($contact->getMiddleName(), $middleName);
        $this->assertSame($contact->getLastName(), $lastName);
        $this->assertSame($contact->getDialNumber(), $dialNumber);
        $this->assertSame($contact->getPhoneNumber(), $phoneNumber);
        $this->assertSame($contact->getEmail(), $email);
        
        $contact->hydrate($newFirstName, $newMiddleName, $newLastName, $newDialNumber, $newPhoneNumber, $newEmail);
        $this->assertSame($contact->getFirstName(), $newFirstName);
        $this->assertSame($contact->getMiddleName(), $newMiddleName);
        $this->assertSame($contact->getLastName(), $newLastName);
        $this->assertSame($contact->getDialNumber(), $newDialNumber);
        $this->assertSame($contact->getPhoneNumber(), $newPhoneNumber);
        $this->assertSame($contact->getEmail(), $newEmail);
    }

    
    public static function dataHydrate(): array
    {
        $superior = new Contact(null, "Martin", "Olej", "Olejar", 420, "727815483", "martin.olejar@gmail.com");
        return [
            [$superior, "Zbynek", "Kossai", "Rybicka", 420, "727815483", "zbynek.rybicka@gmail.com", 
                "Martin", "Mikyr", "Mikyska", 421, "731584333", "mikyr@wonderfull-internet-travel.com"]
        ];
    }



}
