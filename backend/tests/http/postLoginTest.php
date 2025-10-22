<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class PostLoginTest extends ApiTestCase {

    /**
     * @dataProvider dataPostLogin
     */
    public function testPostLogin(string $email, string $password, int $result): void
    {
        // Data
        $data = [
            'email'=> $email,
            'password'=> $password
        ];

        // HTTP Request
        static::$client->request("POST", "/login", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        $this->assertSame(static::$client->getResponse()->getStatusCode(), $result);
    }

    public static function dataPostLogin(): array 
    {
        return [
            [ "", "admin", 400],
            [ "admin", "", 400],
            [ "admin", "admin", 401],
            [ "admin@admin", "admin", 401],
            [ "@admin.cz", "admin", 401],
            [ "x@x.cz", "x", 401],
            [ "test@demo.cz", "pass000", 401],
            [ "test@demo.cz", "password123", 200]
        ];
    }

}