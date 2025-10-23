<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class PostCallTest extends ApiTestCase {

    /**
     * @dataProvider dataPostCall
     */
    public function testPostCall($contactId, $purpose, $successful, $type, $description, $meetingAppointment, $place, $nextCall, $result): void
    {
        // Data
        $data = [
            "contact_id" => $contactId,
            "purpose" => $purpose,
            "successful" => $successful,
            "type" => $type,
            "description" => $description,
            "meetingAppointment" => $meetingAppointment,
            "place" => $place,
            "nextCall" => $nextCall
        ];

        // HTTP Request
        static::$client->request("POST", "/call", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        $this->assertSame(static::$client->getResponse()->getStatusCode(), $result);
    }

    public static function dataPostCall(): array
    {
        return [
            [ 6, "To make an appointment", true, "meeting", "The client is interested in a meeting.", "2030-11-25T13:00", "Time Square", null, 201 ],
            [ 6, "To troll mad neighbor", true, "rejection", "He was very angry", null, "", "2030-12-24T18:00", 201 ],
            [ 6, "To troll mad neighbor and he didn't answer", false, "rejection", "He was very angry", null, "", "2030-12-24T18:00", 201 ],
            [ 6, "", true, "rejection", "", "2024-12-24T18:00", "", null, 201],
            [ 6, "", false, "rejection", "", "2024-12-24T18:00", "", "2030-12-24T18:00", 201],
            [ 6, "", true, "meeting", "", "2024-12-24T18:00", "", null, 400],
            [ 6, "", true, "meeting", "", null, "", null, 400],
            [ 6, "", true, "rejection", "", "2024-12-24T18:00", "", "2024-12-24T18:00", 400],
        ];
    }

}