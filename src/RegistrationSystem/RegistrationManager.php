<?php
/**
 * Created by PhpStorm.
 * User: Pot
 * Date: 2014.08.12.
 * Time: 17:29
 */

namespace Kata\RegistrationSystem;


use Kata\RegistrationSystem\Entity\Password;
use Kata\RegistrationSystem\Entity\User;
use Kata\RegistrationSystem\Validator;
use Kata\RegistrationSystem\PasswordHelper;
use Kata\RegistrationSystem\Storage;

class RegistrationManager {

    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var PasswordHelper
     */
    private $passwordHelper;

    /**
     * @var Storage
     */
    private $storage;

    /**
     * Sets parameters into class variables on the same name.
     *
     * @param Validator $validator
     * @param PasswordHelper $passwordHelper
     * @param Storage $storage
     */
    public function __construct(Validator $validator, PasswordHelper $passwordHelper, Storage $storage)
    {
        $this->validator = $validator;
        $this->passwordHelper = $passwordHelper;
        $this->storage = $storage;
    }

    /**
     * Saves a new registration from remote
     *
     * @param string $email
     * @return bool
     */
    public function apiRegistration($email)
    {
        $pwHelper = new PasswordHelper();
        $randomPass = $pwHelper->generateRandomString(rand(1, 64));

        $user = new User();
        $user->email = $email;
        $user->password = $pwHelper->generatePassword($randomPass, rand(1, 64));

        $result = $this->storage->saveUser($user);
        return $result;
    }

    /**
     * Saves a new registration from the reg form.
     *
     * @param string $email
     * @param Password $password
     */
    public function formRegistration($email, Password $password)
    {
        return true;
    }
} 