<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PostMeetingTest extends WebTestCase {

    /**
     * @dataProvider dataPostMeeting
     */
    public function testPostMeeting(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("POST", "/meeting", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataPostMeeting(): array 
    {
        return [

        ];
    }

}