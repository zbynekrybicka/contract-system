<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DeleteContactTest extends WebTestCase {

    /**
     * @dataProvider dataDeleteContact
     */
    public function testDeleteContact(): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
        ];

        // HTTP Request
        $client->request("DELETE", "/contact", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        // $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataDeleteContact(): array 
    {
        return [

        ];
    }

}