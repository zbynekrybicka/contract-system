<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetUserStatisticsTest extends WebTestCase {

    /**
     * @dataProvider dataGetUserStatistics
     */
    public function testGetUserStatistics(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("GET", "/user/statistics", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataGetUserStatistics(): array 
    {
        return [

        ];
    }

}