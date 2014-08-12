<?php
/**
 * Created by PhpStorm.
 * User: Pot
 * Date: 2014.08.12.
 * Time: 17:29
 */

namespace Kata\RegistrationSystem;


use Kata\RegistrationSystem\Entity\Password;

class RegistrationManager {

    public function __construct()
    {
    }

    /**
     *
     * @param $email
     * @return bool
     */
    public function apiRegistration($email)
    {
        return true;
    }

    /**
     * @param string $email
     * @param Password $password
     */
    public function formRegistration($email, Password $password)
    {
        return true;
    }
} 