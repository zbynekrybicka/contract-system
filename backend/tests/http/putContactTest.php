<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class PutContactTest extends ApiTestCase {

    /**
     * @dataProvider dataPutContact
     */
    public function testPutContact($id, $data, $status): void
    {
        // HTTP Request
        static::$client->request("PUT", "/contact/" . $id, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        $this->assertSame(static::$client->getResponse()->getStatusCode(), $status);
    }

    public static function dataPutContact(): array 
    {
        return [
            [
                4,
                [
                    "email" => "vaclav.tomanec" . time(). "@gmail.com",
                    "firstName" => "Vaclav", 
                    "lastName" => "Tomanec", 
                    "middleName" => "Byznys", 
                    "dialNumber" => 420, 
                    "phoneNumber" => "123456789", 
                ], 204
            ],
            [
                1,
                [
                    "firstName" => "Vaclav", 
                    "middleName" => "Byznys", 
                    "lastName" => "Tomanec", 
                    "dialNumber" => 420, 
                    "phoneNumber" => "123456789", 
                    "email" => "vaclav.tomanec" . time(). "@gmail.com"
                ], 401
            ]
        ];
    }

}