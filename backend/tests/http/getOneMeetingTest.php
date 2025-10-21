<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetOneMeetingTest extends WebTestCase {

    /**
     * @dataProvider dataGetOneMeeting
     */
    public function testGetOneMeeting(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("GET", "/meeting/$id", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataGetOneMeeting(): array 
    {
        return [

        ];
    }

}