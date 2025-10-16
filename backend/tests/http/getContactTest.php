<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';


final class GetContactTest extends ApiTestCase {

    /**
     * @dataProvider dataGetContact
     */
    public function testGetContact(): void
    {
        // HTTP Request
        self::$client->request("GET", "/contact", [], [], [
            'CONTENT-TYPE' => 'application/json',
        ]);
        // Response control
        $this->assertSame(self::$client->getResponse()->getStatusCode(), 200);
    }

    public static function dataGetContact(): array 
    {
        return [
            []
        ];
    }

}