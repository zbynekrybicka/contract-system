<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTestCase extends WebTestCase {

    public static $client;

    public function setUp(): void
    {
        self::$client = static::createClient();
        self::$client->request("POST", "/login", [], [], ['CONTENT-TYPE' => 'application/json'], json_encode([
            'email'=> 'test@demo.cz',
            'password'=> 'password123'
        ]));
        $this->assertSame(self::$client->getResponse()->getStatusCode(), 200);
        $token = self::$client->getResponse()->getContent();
        self::$client->setServerParameter('HTTP_Authorization', 'Bearer '. json_decode($token));
    }


    protected static function getKernelClass(): string
    {  
        return \App\Kernel::class;
    }

}