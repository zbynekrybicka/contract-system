<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DeleteContractTest extends WebTestCase {

    /**
     * @dataProvider dataDeleteContract
     */
    public function testDeleteContract(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("DELETE", "/contract", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataDeleteContract(): array 
    {
        return [

        ];
    }

}