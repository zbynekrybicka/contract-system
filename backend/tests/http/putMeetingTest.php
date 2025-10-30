<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class PutMeetingTest extends ApiTestCase {

    /**
     * @dataProvider dataPutMeeting
     */
    public function testPutMeeting($id, $res, $type, $price, $nextMeeting, $place, $result): void
    {
        // Data
        $data = [
            'id' => $id,
            'result' => $res,
            'type' => $type,
            'price' => $price,
            'nextMeeting' => $nextMeeting,
            'place' => $place
        ];

        // HTTP Request
        static::$client->request("PUT", "/meeting/$id", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        $statusCode = static::$client->getResponse()->getStatusCode();
        $this->assertSame($statusCode, $result);
        if ($statusCode === 200) {
            dump(static::$client->getResponse()->getContent());
        }
    }

    public static function dataPutMeeting(): array 
    {
        return [
            [1, "Success!", "contract", "1000", null, "", 204],
            [1, "Next Success!", "contract", "2000", "2025-11-01 16:30:00", "The Air Cafe", 204],
        ];
    }

}