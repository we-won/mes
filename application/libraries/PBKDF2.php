<?php
/*
 * Password hashing with PBKDF2.
 * Author: havoc AT defuse.ca
 * www: https://defuse.ca/php-pbkdf2.htm
 */
class PBKDF2 {
    const PBKDF2_HASH_ALGORITHM = "sha512";
    const PBKDF2_ITERATIONS = 1000;
    const PBKDF2_SALT_BYTES = 24;
    const PBKDF2_HASH_BYTES = 24;
    const HASH_SECTIONS = 4;
    const HASH_ALGORITHM_INDEX = 0;
    const HASH_ITERATION_INDEX = 1;
    const HASH_SALT_INDEX = 2;
    const HASH_PBKDF2_INDEX = 3;

    public function createHash($password) {
        $salt = $this->generateSalt();
        return self::PBKDF2_HASH_ALGORITHM . ":" . self::PBKDF2_ITERATIONS . ":" .  $salt . ":" .
            base64_encode($this->_pbkdf2(
                self::PBKDF2_HASH_ALGORITHM,
                $password,
                $salt,
                self::PBKDF2_ITERATIONS,
                self::PBKDF2_HASH_BYTES,
                true
            ));
    }

    public function validatePassword($password, $good_hash) {
        $params = explode(":", $good_hash);
        if (count($params) < self::HASH_SECTIONS) {
            return false;
        }
        $pbkdf2 = base64_decode($params[self::HASH_PBKDF2_INDEX]);
        return $this->slow_equals(
            $pbkdf2,
            $this->_pbkdf2(
                $params[self::HASH_ALGORITHM_INDEX],
                $password,
                $params[self::HASH_SALT_INDEX],
                (int) $params[self::HASH_ITERATION_INDEX],
                strlen($pbkdf2),
                true
            )
        );
    }

    private function slow_equals($a, $b) {
        $diff = strlen($a) ^ strlen($b);
        for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
        {
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $diff === 0;
    }

    public function generateSalt() {
        return base64_encode(mcrypt_create_iv(self::PBKDF2_SALT_BYTES, MCRYPT_DEV_URANDOM));
    }

    private function _pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false) {
        $algorithm = strtolower($algorithm);
        if (!in_array($algorithm, hash_algos(), true)) {
            die('PBKDF2 ERROR: Invalid hash algorithm.');
        }
        if ($count <= 0 || $key_length <= 0) {
            die('PBKDF2 ERROR: Invalid parameters.');
        }

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for ($i = 1; $i <= $block_count; $i++) {
            // $i encoded as 4 bytes, big endian.
            $last = $salt . pack("N", $i);
            // first iteration
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            // perform the other $count - 1 iterations
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if($raw_output) {
            return substr($output, 0, $key_length);
        } else {
            return bin2hex(substr($output, 0, $key_length));
        }
    }
}