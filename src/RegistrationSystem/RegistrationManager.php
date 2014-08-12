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
        $randomPass = $this->passwordHelper->generateRandomString(rand(1, 64));


        return $this->formRegistration($email, $randomPass);
    }

    /**
     * Saves a new registration from the reg form.
     *
     * @param string $email
     * @param string $plainPassword
     * @return bool
     */
    public function formRegistration($email, $plainPassword)
    {
        $password = $this->passwordHelper->generatePassword($plainPassword, rand(1, 64));

        $user = new User();
        $user->email = $email;
        $user->password = $password;

        $result = $this->storage->saveUser($user);
        return $result;
    }
} 