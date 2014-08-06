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
     * @var \PDO
     */
    private $pdo;

    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Saves a user
     *
     * @param User $user
     * @return bool
     */
    public function saveUser(User $user)
    {
        $statement = $this->pdo->prepare(
        "INSERT INTO users (
            email, password, salt
        ) VALUES (
            :_email, :_password, :_salt
        )
        ");
        $password = $user->password->hashedPassword;
        $salt = $user->password->salt;
        $statement->bindParam(':_email', $user->email, \PDO::PARAM_STR);
        $statement->bindParam(':_password', $password, \PDO::PARAM_STR);
        $statement->bindParam(':_salt', $salt, \PDO::PARAM_STR);
        $result = $statement->execute();

        return $result;
    }

    /**
     * Gives back if a given email exists in the DB.
     *
     * @param $email
     * @return bool
     */
    public function userExistsByEmail($email)
    {
        $statement = $this->pdo->prepare("SELECT 1 FROM users WHERE email = :_email");
        $statement->bindParam(':_email', $email, \PDO::PARAM_STR);
        $result = $statement->execute();

        return $result;
    }
} 