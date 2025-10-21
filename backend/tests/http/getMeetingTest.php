<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetMeetingTest extends WebTestCase {

    /**
     * @dataProvider dataGetMeeting
     */
    public function testGetMeeting(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("GET", "/meeting", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataGetMeeting(): array 
    {
        return [

        ];
    }

}