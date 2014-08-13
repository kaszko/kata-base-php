<?php
/**
 * Created by PhpStorm.
 * User: kaszko
 * Date: 8/13/2014
 * Time: 5:37 PM
 */

namespace Kata\RegistrationSystem;


class ServiceLocator {
    public function getPasswordHelper() {
        return new PasswordHelper();
    }

    public function getPdo() {
        return new \PDO('sqlite::memory:');
    }

    public function getStorage() {
        return new Storage($this->getPdo());
    }

    public function getValidator() {
        return new Validator();
    }
} 