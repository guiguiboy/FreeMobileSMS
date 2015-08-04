<?php
/**
 * Created by PhpStorm.
 * User: gbretou
 * Date: 04/08/2015
 * Time: 13:55
 */

namespace tests\FreeMobileSMS;

use FreeMobileSMS\Client;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;


class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public static function sendMessageDataProvider()
    {
        return [
            [
                'actualStatus' => 200,
                'expectedStatus' => true,
                'expectedMessage' => ''
            ],
            [
                'actualStatus'    => 400,
                'expectedStatus'  => false,
                'expectedMessage' => '[status code] 400 [reason phrase] Bad Request'
            ],
            [
                'actualStatus'    => 402,
                'expectedStatus'  => false,
                'expectedMessage' => '[status code] 402 [reason phrase] Payment Required'
            ],
            [
                'actualStatus'    => 403,
                'expectedStatus'  => false,
                'expectedMessage' => '[status code] 403 [reason phrase] Forbidden'
            ],
            [
                'actualStatus'    => 500,
                'expectedStatus'  => false,
                'expectedMessage' => '[status code] 500 [reason phrase] Internal Server Error'
            ],
        ];
    }

    /**
     * Tests message sending (stubbed)
     *
     * @param integer $actualStatus
     * @param boolean $expectedStatus
     * @param string  $expectedMessage
     *
     * @dataProvider sendMessageDataProvider
     */
    public function testSendMessage($actualStatus, $expectedStatus, $expectedMessage)
    {
        $login    = 'login';
        $password = 'password';

        $driver = new GuzzleClient();
        $mock   = new Mock([
            new Response($actualStatus),
        ]);
        $driver->getEmitter()->attach($mock);

        $fMobileClient = new Client($login, $password);
        $fMobileClient->setDriver($driver);
        $result = $fMobileClient->send('Hello you !');

        $this->assertEquals($expectedStatus, $result->getStatus());
        if (!$result->getStatus())
            $this->assertContains($expectedMessage, $result->getMessage());
    }
}