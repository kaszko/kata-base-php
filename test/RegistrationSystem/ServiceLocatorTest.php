<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 8/13/2014
 * Time: 5:38 PM
 */

namespace Kata\Test\RegistrationSystem;


use Kata\RegistrationSystem\PasswordHelper;
use Kata\RegistrationSystem\ServiceLocator;
use Kata\RegistrationSystem\Storage;
use Kata\RegistrationSystem\Validator;

class ServiceLocatorTest extends \PHPUnit_Framework_TestCase {

    private $serviceLocator;

    protected function setUp() {
        $this->serviceLocator = new ServiceLocator();
    }

    public function testGetPasswordHelper() {
        $this->assertTrue($this->serviceLocator->getPasswordHelper() instanceof PasswordHelper);
    }

    public function testGetStorage() {
        $this->assertTrue($this->serviceLocator->getStorage() instanceof Storage);
    }

    public function testGetValidator() {
        $this->assertTrue($this->serviceLocator->getValidator() instanceof Validator);
    }

    public function testGetPdo() {
        $this->assertTrue($this->serviceLocator->getPdo() instanceof \PDO);
    }
}
 