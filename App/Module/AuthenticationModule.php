<?php

namespace App\Module;

use App\Model\Auth\Permission;
use App\Model\Auth\User;
use App\Helper\CSRF;

class AuthenticationModule extends Module
{
    private $User;

    public function __construct()
    {
        $this->initUser();
    }

/*
 * get the user variable from the session
 */
    public function initUser()
    {
        if (isset($_SESSION['user'])) {
            $this->User = $_SESSION['user'];
        } else {
            $this->User = array();
        }
    }

/*
 * is user logged in
 */
    public function hasUser()
    {
        if (!empty($this->User)) {
            return true;
        } else {
            return false;
        }
    }

/*
 *
 */
    public function getUser()
    {
        return $this->User;
    }

/*
 *
 */
    public function getUserID()
    {
        return $this->User['idUser'];
    }

/*
 * log user out
 */
    public function logout()
    {
        unset($_SESSION['user']);
        $this->User = array();
    }

/*
 * This is intended to be used as an interface to Permissions::isAuthorized
 *
 */
    public function userAuthorized($objectName, $permission = 'Read')
    {
        if (empty($this->User)) {
            return false;
        }
        return (Permission::get()->isAuthorized($this->User['idUser'], $objectName, $permission));
    }

/*
 * scrub the args to ensure they meet length and type requirements
 */
    public function cleanArgs(&$args)
    {
        //TODO: rigorous arg cleaning here
        foreach ($args as $arg) {
        }

        return true;
    }

/*
 * remove a user
 */
    public function removeUser($idUser = 0)
    {
        return User::get()->delete($idUser);
    }

/*
 * Hash a field
 */
    public function generateHash($value, $salt)
    {
        // This hashes the password with the salt so that it can be stored securely
        // in your database.  The output of this next statement is a 64 byte hex
        // string representing the 32 byte sha256 hash of the password.  The original
        // password cannot be recovered from the hash.  For more information:
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function
        $hash = hash('sha256', $value.$salt);

        // Next we hash the hash value 65536 more times.  The purpose of this is to
        // protect against brute force attacks.  Now an attacker must compute the hash 65537
        // times for each guess they make against a password, whereas if the password
        // were hashed only once the attacker would have been able to make 65537 different
        // guesses in the same amount of time instead of only one.
        for ($round = 0; $round < 65536; $round++) {
            $hash = hash('sha256', $hash.$salt);
        }

        return $hash;
    }

    public function generateSalt()
    {
        // A salt is randomly generated here to protect again brute force attacks
        // and rainbow table attacks.  The following statement generates a hex
        // representation of an 8 byte salt.  Representing this in hex provides
        // no additional security, but makes it easier for humans to read.
        // For more information:
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29
        // http://en.wikipedia.org/wiki/Brute-force_attack
        // http://en.wikipedia.org/wiki/Rainbow_table
        return dechex(mt_rand(0, 2147483647)).dechex(mt_rand(0, 2147483647));
    }

    public function register($args = array())
    {
        if (empty($args)) {
            return false;
        }
        if (!$this->cleanArgs($args)) {
            return false;
        }

        $salt = $this->generateSalt();
        $password = $this->generateHash($args['password'], $salt);

        $User = User::get();
        $User->UserEmail = $args['email'];
        $User->FirstName = $args['firstname'];
        $User->LastName = $args['lastname'];
        $User->Password = $password;
        $User->Salt = $salt;

        return $User->save();
    }

    public function login($args = array())
    {
        if (empty($args)) {
            return false;
        }
        if (!$this->cleanArgs($args)) {
            return false;
        }
        //check csrf token
        $token = $args['token'];
        $formName = $args['formName'];
        if (!CSRF::validateCSRFToken($formName,$token)) {
            return false;
        }

        $login_ok = false;
        // get user from User data Model
        $User = User::get()->fetchByField('UserEmail', $args['email']);
        if ($User) {
            // Using the password submitted by the user and the salt stored in the database,
            // we now check to see whether the passwords match by hashing the submitted password
            // and comparing it to the hashed version already stored in the database.
            $check_password = $this->generateHash($args['password'],$User->Salt);

            if ($check_password === $User->Password) {
                $login_ok = true;
            }
        }

        if ($login_ok) {
            $user = [
                'idUser' => $User->idUser,
                'FirstName' => $User->FirstName,
                'LastName' => $User->LastName,
            ];
            // This stores the user's data into the session at the index 'user'.
            // We will check this index on the private pageis to determine whether
            // or not the user is logged in.  We can also use it to retrieve
            // the user's details.
            $_SESSION['user'] = $user;
            $this->User = $user;
            //success
            return true;
        } else {
            return false;
        }
    }
}
