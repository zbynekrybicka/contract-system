<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetContractTest extends WebTestCase {

    /**
     * @dataProvider dataGetContract
     */
    public function testGetContract(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("GET", "/contract", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataGetContract(): array 
    {
        return [

        ];
    }

}