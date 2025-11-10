<?php
namespace App\Tests\Controller;

require __DIR__ . '/ApiTestCase.php';

final class PutUserNewPasswordTest extends ApiTestCase {

    /**
     * @dataProvider dataPutUserNewPassword
     */
    public function testPutUserNewPassword($newPassword, $confirmPassword, $result): void
    {
        // Data
        $data = [
            'newPassword' => $newPassword,
            'confirmPassword' => $confirmPassword
        ];

        // HTTP Request
        static::$client->request("PUT", "/user/new-password", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        
        // Response control
        $statusCode = static::$client->getResponse()->getStatusCode();
        $this->assertSame($statusCode, $result);
        if ($statusCode === 204) {
            dump(static::$client->getResponse()->getContent());
        }
    }

    public static function dataPutUserNewPassword(): array 
    {
        return [
            ["newStrongPassword1", "newWeakPassword1", 400],
            ["newStrongPassword1", "newStrongPassword1", 400],
        ];
    }

}