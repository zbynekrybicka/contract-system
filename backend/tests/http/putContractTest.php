<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class PutContractTest extends ApiTestCase {

    /**
     * @dataProvider dataPutContract
     */
    public function testPutContract($id, $price, $paid, $status): void
    {
        $data = [
            'price' => $price,
            'paid' => $paid
        ];

        // HTTP Request
        static::$client->request("PUT", "/contract/" . $id, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        $this->assertSame(static::$client->getResponse()->getStatusCode(), $status);
    }

    public static function dataPutContract(): array 
    {
        return [
            [7, 1000, true, 204]
        ];
    }

}