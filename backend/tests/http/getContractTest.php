<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class GetContractTest extends ApiTestCase {

    /**
     * @dataProvider dataGetContract
     */
    public function testGetContract($result): void
    {
        // HTTP Request
        static::$client->request("GET", "/contract", [], [], ['CONTENT_TYPE' => 'application/json']);
        
        // Response control
        $statusCode = static::$client->getResponse()->getStatusCode();
        $this->assertSame($statusCode, $result);
        if ($statusCode === 200) {
            dump(static::$client->getResponse()->getContent());
        }
    }

    public static function dataGetContract(): array 
    {
        return [
            [200]
        ];
    }

}