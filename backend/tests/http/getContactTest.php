<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';


final class GetContactTest extends ApiTestCase {

    /**
     * @dataProvider dataGetContact
     */
    public function testGetContact($id): void
    {
        // HTTP Request
        self::$client->request("GET", "/contact?id=" . $id, [], [], [
            'CONTENT-TYPE' => 'application/json',
        ]);
        // Response control
        $this->assertSame(self::$client->getResponse()->getStatusCode(), 200);
    }

    public static function dataGetContact(): array 
    {
        return [
            [1], [3]
        ];
    }

}