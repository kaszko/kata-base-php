<?php
/**
 * Created by PhpStorm.
 * User: Pot
 * Date: 8/6/2014
 * Time: 6:11 PM
 */

namespace Kata\RegistrationSystem;
use Kata\RegistrationSystem\Entity\User;

class Storage {

    /**
     * Saves a user
     *
     * @param User $user
     * @return bool
     */
    public function saveUser(User $user)
    {
        return true;
    }

    /**
     * Gives back if a given email exists in the DB.
     *
     * @param $email
     * @return bool
     */
    public function userExistsByEmail($email)
    {
        return true;
    }
} 