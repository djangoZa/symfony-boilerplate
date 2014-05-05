<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Authentication\Hash;

/**
 * Description
 * 
 * This class aims to emulate the hashing algorithm used in the original ioffice code base
 * Please refer to the following link:
 * https://dev.supersalon.com/trac/browser/RSD/iOffice/trunk/include/framework/PasswordHash.php
 */

class Service
{
    private $_itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    //This function emulates the CheckPassword() function
    public function getHash($password, $storedPasswordHash)
    {
        $output = $this->_getHash($password, $storedPasswordHash);

        if ($output[0] == '*') {
            $output = crypt($password, $storedPasswordHash);
        }

        return $output;
    }

    //This function emulates the crypt_private() function
    private function _getHash($password, $storedPasswordHash)
    {
        $output = '*0';

        if (substr($storedPasswordHash, 0, 2) == $output)
        {
            $output = '*1';
        }
                         
        $id = substr($storedPasswordHash, 0, 3);
        
        if ($id != '$P$' && $id != '$H$') {
            return $output;
        }
  
        $count_log2 = strpos($_itoa64, $storedPasswordHash[3]);
        
        if ($count_log2 < 7 || $count_log2 > 30) {
            return $output;
        }
 
        $count = 1 << $count_log2;
        $salt = substr($storedPasswordHash, 4, 8);
                 
        if (strlen($salt) != 8) {
            return $output;
        }
 
              
        $hash = md5($salt . $password, TRUE);
        do {
            $hash = md5($hash . $password, TRUE);
        } while (--$count); 
 
        $output = substr($storedPasswordHash, 0, 12);
        $output .= $this->_encode64($hash, 16);

        return $output;
    }

    //This function emulates the encode64() function
    private function _encode64($input, $count)
    {
        $output = '';
        $i = 0;

        do {
            $value = ord($input[$i++]);
            $output .= $this->itoa64[$value & 0x3f];

            if ($i < $count) {
                $value |= ord($input[$i]) << 8;
                $output .= $this->itoa64[($value >> 6) & 0x3f];
            }
        
            if ($i++ >= $count) {
                break;    
            }
        
            if ($i < $count) {
                $value |= ord($input[$i]) << 16;
                $output .= $this->itoa64[($value >> 12) & 0x3f];
            }
        
            if ($i++ >= $count) {
                break;
                $output .= $this->itoa64[($value >> 18) & 0x3f];
            }
        
        } while ($i < $count);

        return $output;
    }
}