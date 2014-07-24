<?php

namespace Kata\Test\Bergmann\CommonCsrfToken;

use Kata\Bergmann\CommonCsrfToken\CommonCsrfTokenBo;

class CommonCsrfTokenBoTest extends \PHPUnit_Framework_TestCase
{
    private $session;

    /**
     * @var CommonCsrfTokenBo
     */
    private $bo;

    protected function setUp()
    {
        $this->session = $this->getMock('Kata\\Bergmann\\CommonCsrfToken\\Session');
        $this->bo      = new CommonCsrfTokenBo($this->session);
    }

    public function testTokenCanBeGeneratedAndStored()
    {
        $this->session->expects($this->once())
                      ->method('set');

        $token = $this->bo->generateAndStoreToken('test');

        $this->assertInternalType('string', $token);
    }

    public function testValidTokenIsAccepted()
    {
        $this->session->expects($this->any())
                      ->method('get')
                      ->willReturn('token');

        $this->assertTrue($this->bo->isValidToken('test', 'token'));
    }
}