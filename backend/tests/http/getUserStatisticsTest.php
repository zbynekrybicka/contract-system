<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class GetUserStatisticsTest extends ApiTestCase {

    /**
     * @dataProvider dataGetUserStatistics
     */
    public function testGetUserStatistics(int $result): void
    {
        // HTTP Request
        static::$client->request("GET", "/user/statistics", [], [], ['CONTENT_TYPE' => 'application/json']);
        
        // Response control
        $statusCode = static::$client->getResponse()->getStatusCode();
        $this->assertSame($statusCode, $result);
        if ($statusCode === 200) {
            dump(static::$client->getResponse()->getContent());
        }
    }

    public static function dataGetUserStatistics(): array 
    {
        return [
            [200]
        ];
    }

}