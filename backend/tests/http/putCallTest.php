<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PutCallTest extends WebTestCase {

    /**
     * @dataProvider dataPutCall
     */
    public function testPutCall(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("PUT", "/call", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataPutCall(): array 
    {
        return [

        ];
    }

}