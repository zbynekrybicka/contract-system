<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';
final class GetUserTokenTest extends ApiTestCase {

    /**
     * @dataProvider dataGetUserToken
     */
    public function testGetUserToken(int $userId, int $result): void
    {
        // HTTP Request
        static::$client->request("GET", "/user/$userId/token", [], [], ['CONTENT_TYPE' => 'application/json']);
        
        // Response control
        $statusCode = static::$client->getResponse()->getStatusCode();
        $this->assertSame($statusCode, $result);
        if ($statusCode === 200) {
            dump(static::$client->getResponse()->getContent());
        }
    }

    public static function dataGetUserToken(): array 
    {
        return [
            [3, 200]
        ];
    }

}