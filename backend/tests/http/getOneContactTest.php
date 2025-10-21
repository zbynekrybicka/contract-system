<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetOneContactTest extends WebTestCase {

    /**
     * @dataProvider dataGetOneContact
     */
    public function testGetOneContact(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("GET", "/contact/$id", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataGetOneContact(): array 
    {
        return [

        ];
    }

}