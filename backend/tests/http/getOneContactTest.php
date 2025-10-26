<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class GetOneContactTest extends ApiTestCase {

    /**
     * @dataProvider dataGetOneContact
     */
    public function testGetOneContact(int $id, int $result): void
    {
        // HTTP Request
        static::$client->request("GET", "/contact/$id", [], [], ['CONTENT_TYPE' => 'application/json']);
        
        // Response control
        $statusCode = static::$client->getResponse()->getStatusCode();
        $this->assertSame($statusCode, $result);
        if ($statusCode === 200) {
            dump(static::$client->getResponse()->getContent());
        }
    }

    public static function dataGetOneContact(): array 
    {
        return [
            [2, 400],
            [6, 200],
        ];
    }

}