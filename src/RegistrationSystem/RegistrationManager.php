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
     * @param User $user
     * @return bool
     */
    public function apiRegistration(User $user)
    {
        $randomPass = $this->passwordHelper->generateRandomString(rand(1, 64));
        $password = $this->passwordHelper->generatePassword($randomPass, rand(1, 64));
        $user->password = $password;

        return $this->formRegistration($user);
    }

    /**
     * Saves a new registration from the reg form.
     *
     * @param User $user
     * @return bool
     */
    public function formRegistration(User $user)
    {
        $result = $this->storage->saveUser($user);
        return $result;
    }
} 