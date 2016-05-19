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
     * compares values for drop down lists
     *
     */
    public static function isSelected($val1,$val2) {
      $result = "";


      if((string)$val1 == (string)$val2){
        $result = "selected='selected'";
      }

      return $result;
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

    /**
     * Function to create the information for drop down lists, with group sections
     *
     */
    public static function get_group_dd_items($array, $selected_id="") 
    {
    
      $select_txt = "";       
      $cur_grp    = "";
    
      if (is_array($array)) {    
        foreach ($array as $id => $val) {
             // has the group name changed
          if ($cur_grp != $val['grp']) {
             // if not first time thru, add the closing optgroup tag
            if ($cur_grp != "") {
              $select_txt .= '</optgroup>';
            }
            // add option group opening tag
            $select_txt .= '<optgroup label="'.$val['grp'].'">';
            $cur_grp = $val['grp'];
          } 
        
          if ($selected_id == $id) {
            $select_txt .= '<option value="'.$id.'" selected >'.stripslashes($val['name']).'</option>';
          } else {
            $select_txt .= '<option value="'.$id.'">'.stripslashes($val['name']).'</option>';
          }             
        }
        $select_txt .= '</optgroup>';
      }      
      return $select_txt;
    }   

    /**
     * Function to create the information for drop down lists
     *
     */
    public static function get_dropdown_items($array, $selected_id="") 
    {
    
      $select_txt = "";     
      if (is_array($array)) {    
        foreach ($array as $id => $val) { 
          if ($selected_id == $id) {
            $select_txt .= '<option value="'.$id.'" selected >'.stripslashes($val).'</option>';
          } else {
            $select_txt .= '<option value="'.$id.'">'.stripslashes($val).'</option>';
          }
        }   
      }      
      return $select_txt;
    }   

}

?>