<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 7/24/2014
 * Time: 4:27 PM
 */

namespace Kata\Test\Bergmann\CommonCsrfToken;


use Kata\Bergmann\CommonCsrfToken\Session;

class SessionTest extends \PHPUnit_Framework_TestCase {

    private $session;
    private $sessionHandler;

    protected function setUp() {
        $this->session = new Session();
        $this->sessionHandler = $this->getMock('Kata\\Bergmann\\CommonCsrfToken\\SessionHandlerInterface');
    }

    public function testAddSessionHandler() {


        $this->session->addSessionHandler('test', $this->sessionHandler);

        $this->assertTrue($this->session->hasSessionHandler('test'));
        $this->assertFalse($this->session->hasSessionHandler('testNotAdded'));

        return array('session' => $this->session, 'sessionHandler' => $this->sessionHandler);
    }

    /**
     * @param $session
     * @depends testAddSessionHandler
     * @expectedException \Exception
     */
    public function testAddSessionHandlerAgain(array $sessionGroup) {
        $sessionGroup['session']->addSessionHandler('test', $this->sessionHandler);
    }

    /**
     * @param Session $session
     * @depends testAddSessionHandler
     * @throws \Kata\Bergmann\CommonCsrfToken\Exception
     */
    public function testAddSessionHandlerAgainForced(array $sessionGroup) {
        $sessionGroup['session']->addSessionHandler('test', $this->sessionHandler, true);
        $this->assertTrue($sessionGroup['session']->hasSessionHandler('test'));
    }

    /**
     * @depends testAddSessionHandler
     */
    public function testSuccessfulSet(array $sessionGroup) {

        //$this->session->addSessionHandler('test', $this->sessionHandler);
        $sessionGroup['sessionHandler']
            ->expects($this->once())
            ->method('set')
            ->with('testKey', 'testValue');

        $sessionGroup['session']->set('testKey', 'testValue', 'test');

    }

    /**
     * @expectedException \Exception
     */
    public function testFailToSet() {
        $this->session->set('testKey', 'testValue', 'test');
    }

    /**
     * @depends testAddSessionHandler
     */
    public function testSuccessfulGet(array $sessionGroup) {


        $sessionGroup['sessionHandler']->expects($this->once())
            ->method('set')
            ->with('testKey', 'testValue');

        $sessionGroup['session']->get('testKey', 'test');
    }

    /**
     * @expectedException \Exception
     */
    public function testFailToGet() {
        $this->session->get('testKey', 'testValue', 'test');
    }

    public function testWrite() {
        $sessionHandlers = array();
        for ($x=0; $x<10; $x++) {
            $sessionHandlers[$x] = $this->getMock('Kata\\Bergmann\\CommonCsrfToken\\SessionHandlerInterface');
            $this->session->addSessionHandler('test_' . $x, $sessionHandlers[$x]);
            $sessionHandlers[$x]
                ->expects($this->once())
                ->method('write');
        }

        $this->session->write();
    }
}
 