<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class GetMeetingTest extends ApiTestCase {

    /**
     * @dataProvider dataGetMeeting
     */
    public function testGetMeeting($result): void
    {
        // HTTP Request
        static::$client->request("GET", "/meeting", [], [], ['CONTENT_TYPE' => 'application/json']);
        
        // Response control
        $statusCode = static::$client->getResponse()->getStatusCode();
        $this->assertSame($statusCode, $result);
        if ($statusCode === 200) {
            // dump(static::$client->getResponse()->getContent());
        }
    }

    public static function dataGetMeeting(): array 
    {
        return [
            [200]
        ];
    }

}