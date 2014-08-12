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
use Kata\RegistrationSystem\Exception\ExistingEmailException;
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
        $randomPass = $this->passwordHelper->generateRandomString(rand(1, Validator::MAX_PLAIN_PASS_LEN));
        return $this->formRegistration($email, $randomPass);
    }

    /**
     * Saves a new registration from the reg form.
     *
     * @param string $email
     * @param string $plainPassword
     * @throws ExistingEmailException
     * @return bool
     */
    public function formRegistration($email, $plainPassword)
    {
        $this->validateFormData($email, $plainPassword);
        $password = $this->passwordHelper->generatePassword($plainPassword, rand(12, 33));
        $user = new User();
        $user->email = $email;
        $user->password = $password;

        $result = $this->storage->saveUser($user);
        return $result;
    }

    /**
     * Validates form inputs.
     *
     * @param $email
     * @param $plainPassword
     * @throws Exception\ExistingEmailException | \InvalidArgumentException
     */
    private function validateFormData($email, $plainPassword)
    {
        if (false === $this->validator->isValidEmail($email))
        {
            throw new \InvalidArgumentException;
        }

        if (true === $this->storage->userExistsByEmail($email))
        {
            throw new ExistingEmailException;
        }

        if (false === $this->validator->isValidPlainPassword($plainPassword))
        {
            throw new \InvalidArgumentException;
        }

    }
} 