<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DeleteMeetingTest extends WebTestCase {

    /**
     * @dataProvider dataDeleteMeeting
     */
    public function testDeleteMeeting(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("DELETE", "/meeting", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataDeleteMeeting(): array 
    {
        return [

        ];
    }

}