<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PutMeetingTest extends WebTestCase {

    /**
     * @dataProvider dataPutMeeting
     */
    public function testPutMeeting(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("PUT", "/meeting", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataPutMeeting(): array 
    {
        return [

        ];
    }

}