<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** Vigenère Cipher
 * 
 * Vigenère Cipher is a method of encrypting alphabetic text. It uses a simple
 * form of polyalphabetic substitution. A polyalphabetic cipher is any cipher 
 * based on substitution, using multiple substitution alphabets .
 * The encryption of the original text is done using the 
 * Vigenère square or Vigenère table.
 * 
 * @author Ichwanul Fadhli, Dhimas Panjie Herlambang
 * @copyright Copyright (c) 2020, Ichwanul Fadhli, Dhimas Panjie Herlambang
 */
class Vigenere {
    // The alphabet lookup variable.
	private static $alphabet = array(
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 
		'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 
		'u', 'v', 'w', 'x', 'y', 'z'
	);

    /** Vigenère Encode
     * 
     * The encode function which turns the plaintext message to the 
     * secret message.
     * 
     * @param string $message
     * The message.
     * 
     * Notice the message must only an alphabetic character, 
     * and cannot contain any spaces.
     * 
     * @param string $key
     * The key.
     * 
     * Notice the key must only an alphabetic character, 
     * and cannot contain any spaces.
     * 
     * @return $output
     * 
     */
    public function encode($message, $key){
        // If the key contain spaces, then it will throw a new exception.
        if(strpos($message, ' ') !== false || strpos($key, ' ') !== false){
            throw new Exception('The message or the key must not contain any spaces!');
        }
        // If the key is not an alphabetic, then it will throw a new exception.
        elseif(!ctype_alpha($message) || !ctype_alpha($key)){
            throw new Exception('The message or the key cannot contain characters other than an alphabet!');
        }
        // If all the conditions fail to met, then this is the final cycle.
        else{
            // The output variable declared as empty variable.
            $output = '';
             
            // Looping to do the ciphering. The loop is based on
            // the length of the message.
            for($i = 0; $i < strlen($message); $i++){
    
                if($i == strlen($key) || $i > strlen($key)){
                    // This variable will contain the shifting index for the key.
                    $a = $i % strlen($key);
        
                    // $x is the vigenère cipher calculation.
                    // the "array_search()" is a process to get
                    // the alphabet number.
                    $x = (int)array_search($message[$i], self::$alphabet) + (int)array_search($key[$a], self::$alphabet);
        
                    // $y is the length of the alphabet which is 26.
                    $y = 26;
        
                    // $c is the final calculation of vigenère
                    $c = fmod($x, $y);
        
                    // If the result from modulo is smaller than 0, then $c will be 
                    // added with $y where $y is an absolute (positive) value.
                    if($c < 0){
                        $c += abs($y);
                    }
                }
                else{
                    // $x is the vigenère cipher calculation.
                    // the "array_search()" is a process to get
                    // the alphabet number.
                    $x = (int)array_search($message[$i], self::$alphabet) + (int)array_search($key[$i], self::$alphabet);
                    
                    // $y is the length of the alphabet which is 26.
                    $y = 26;
                    
                    // $c is the final calculation of vigenère
                    $c = fmod($x, $y);
                    
                    // If the result from modulo is smaller than 0, then $c will be 
                    // added with $y where $y is an absolute (positive) value.
                    if($c < 0){
                        $c += abs($y);
                    }
                }
                
                // Checking if the value is exist on the alphabet lookup.
                if(isset(self::$alphabet[$c])){
                    $output .= self::$alphabet[$c];
                }
            }
     
            // Returning the result.
            return $output;
        }
    }

    /** Vigenère Decode
     * 
     * The decode function which turns the encoded message to the 
     * plaintext message.
     * 
     * @param string $message
     * The message.
     * 
     * Notice the message must only an alphabetic character, 
     * and cannot contain any spaces.
     * 
     * @param string $key
     * The key.
     * 
     * Notice the key must only an alphabetic character, 
     * and cannot contain any spaces.
     * 
     * @return $output
     * 
     */
    public function decode($message, $key){
        // If the key contain spaces, then it will throw a new exception.
        if(strpos($message, ' ') !== false || strpos($key, ' ') !== false){
            throw new Exception('The message or the key must not contain any spaces!');
        }
        // If the key is not an alphabetic, then it will throw a new exception.
        elseif(!ctype_alpha($message) || !ctype_alpha($key)){
            throw new Exception('The message or the key cannot contain characters other than an alphabet!');
        }
        // If all the conditions fail to met, then this is the final cycle.
        else{
            // The output variable declared as empty variable.
            $output = '';
             
            // Looping to do the ciphering. The loop is based on
            // the length of the message.
            for($i = 0; $i < strlen($message); $i++){
    
                if($i == strlen($key) || $i > strlen($key)){
                    // This variable will contain the shifting index for the key.
                    $a = $i % strlen($key);
        
                    // $x is the vigenère cipher calculation.
                    // the "array_search()" is a process to get
                    // the alphabet number.
                    $x = (int)array_search($message[$i], self::$alphabet) - (int)array_search($key[$a], self::$alphabet);
        
                    // $y is the length of the alphabet which is 26.
                    $y = 26;
        
                    // $c is the final calculation of vigenère
                    $c = fmod($x, $y);
        
                    // If the result from modulo is smaller than 0, then $c will be 
                    // added with $y where $y is an absolute (positive) value.
                    if($c < 0){
                        $c += abs($y);
                    }
                }
                else{
                    // $x is the vigenère cipher calculation.
                    // the "array_search()" is a process to get
                    // the alphabet number.
                    $x = (int)array_search($message[$i], self::$alphabet) - (int)array_search($key[$i], self::$alphabet);
                    
                    // $y is the length of the alphabet which is 26.
                    $y = 26;
                    
                    // $c is the final calculation of vigenère
                    $c = fmod($x, $y);
                    
                    // If the result from modulo is smaller than 0, then $c will be 
                    // added with $y where $y is an absolute (positive) value.
                    if($c < 0){
                        $c += abs($y);
                    }
                }
                
                // Checking if the value is exist on the alphabet lookup.
                if(isset(self::$alphabet[$c])){
                    $output .= self::$alphabet[$c];
                }
            }
     
            // Returning the result.
            return $output;
        }
    }
}