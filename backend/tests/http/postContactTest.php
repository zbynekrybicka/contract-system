<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';


final class PostContactTest extends ApiTestCase {

    /**
     * @dataProvider dataPostContact
     */
    public function testPostContact(array $data, int $status): void
    {
        // HTTP Request
        static::$client->request("POST", "/contact", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        $this->assertSame(static::$client->getResponse()->getStatusCode(), $status);
    }

    public static function dataPostContact(): array 
    {
        return [
            [
                [
                    "firstName" => "Zbynek", 
                    "middleName" => "Kossai", 
                    "lastName" => "Rybicka", 
                    "dialNumber" => 420, 
                    "phoneNumber" => "727815483", 
                    "email" => "zbynek.rybicka" . time(). "@gmail.com"
                ], 
                201]
        ];
    }

}