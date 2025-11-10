<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class PostUserTest extends ApiTestCase {

    /**
     * @dataProvider dataPostUser
     */
    public function testPostUser(int $contactId, int $result): void
    {
        // Data
        $data = [
            'contactId'=> $contactId
        ];

        // HTTP Request
        static::$client->request("POST", "/user", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        $this->assertSame(static::$client->getResponse()->getStatusCode(), $result);
    }

    public static function dataPostUser(): array 
    {
        return [
            [ 3, 201 ]
        ];
    }

}