<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DeleteCallTest extends WebTestCase {

    /**
     * @dataProvider dataDeleteCall
     */
    public function testDeleteCall(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("DELETE", "/call", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataDeleteCall(): array 
    {
        return [

        ];
    }

}