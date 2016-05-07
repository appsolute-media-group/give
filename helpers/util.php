<?php

class Util {



	public static function dump($obj) {
	
		echo "<pre>";
		var_dump($obj);
		echo "</pre>";
	
	}




    /**
     * Encrypts a string using bcrypt
     *
     */
    public static function bcryptString($string) {
        $salt = SALT;

        // 2a is the bcrypt algorithm selector, 12 is the workload factor
        $hash = crypt($string, '$2a$12$' . $salt);

        return $hash;
    }




    /**
     * Generate a new token
     *
     */
    public static function generateToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[Util::crypto_rand_secure(0, $max)];
        }
        return $token;
    }


    /**
     * Function to generate random strings
     *
     */

    public static function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

}

?>