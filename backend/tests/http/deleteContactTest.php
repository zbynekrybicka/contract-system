<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class DeleteContactTest extends ApiTestCase {

    /**
     * @dataProvider dataDeleteContact
     */
    public function testDeleteContact(int $id, int $status): void
    {
        // HTTP Request
        static::$client->request("DELETE", "/contact/" . $id, [], [], ['CONTENT_TYPE' => 'application/json']);
        
        // Response control
        $this->assertSame(static::$client->getResponse()->getStatusCode(), $status);
    }

    public static function dataDeleteContact(): array 
    {
        return [
            [2, 400],
            [5, 204]
        ];
    }

}