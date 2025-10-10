<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PostLoginTest extends WebTestCase {

    /**
     * @dataProvider dataPostLogin
     */
    public function testPostLogin(string $email, string $password, int $result): void
    {
        // HTTP client
        $client = static::createClient();

        // Data
        $data = [
            'email'=> $email,
            'password'=> $password
        ];

        // HTTP Request
        $client->request("POST", "/login", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        $this->assertContains($client->getResponse()->getStatusCode(), [401]);
    }

    public static function dataPostLogin(): array 
    {
        return [
            [ "", "ahoj", 400],
            [ "admin", "admin", 400],
            [ "admin@admin", "admin", 400],
            [ "@admin.cz", "admin", 400],
            [ "x@x.cz", "x", 401],
            [ "test@demo.cz", "pass000", 401],
            [ "test@demo.cz", "pass123", 200]
        ];
    }

}