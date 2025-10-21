<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetOneContractTest extends WebTestCase {

    /**
     * @dataProvider dataGetOneContract
     */
    public function testGetOneContract(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("GET", "/contract/$id", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataGetOneContract(): array 
    {
        return [

        ];
    }

}