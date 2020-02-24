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

    /** Vigenère Encrypt
     * 
     * The encrypt function which turns a plaintext message to a 
     * secret message.
     * 
     * @param string $message
     * The message.
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
    public function encrypt($message, $key = NULL){
        // Bunch of errors handling.
        //
        // If the key is empty, then it will throw an error.
        if(empty($key) || $key === NULL){
            throw new Error('The key cannot be empty!');
        }
        // If the length of the key is less than 2, then it will throw an error.
        elseif(trim(strlen($key)) < 2){
            throw new Error('The key must be at least 2 characters long!');
        }
        // If the key is more than 1 word, then it will throw an error.
        elseif(count(explode(" ", $key)) > 1){
            throw new Error('The key must only 1 word!');
        }
        // If the key contins any non-alphabetic character, then it will throw an error.
        elseif(preg_match('/[0-9\W_]/', $key)){
            throw new Error('The key cannot contain any non-alphabetic characters such as numbers, and symbols!');
        }
        // Else, do a normal procedure.
        else{
            // Output variable defined as empty.
            $output = '';
            // Encrypted variable defined as empty.
            $encrypted = '';
            // The length of the original message.
            $messageSize = strlen($message);
            // The length of the key.
            $keySize = strlen($key);
    
            // Detecting if the message contains 
            // a non-aplhabetic characters.
            if(preg_match('/[a-z0-9\W\s_]/', $message)){
                // Replacing those non-alphabetic characters with '', and converting the message
                // to the lowercase letter.
                $editedMessage = strtolower(preg_replace("/[0-9\W\s_]/", '', $message));
    
                // The length of the edited message.
                $messageSize = strlen($editedMessage);
    
                // Looping to do the encipher based on how long of the message is.
                for($i = 0; $i < $messageSize; $i++){
                    // If the value of $i is equal to the length of the key or greater, 
                    // then the key will be reset to the beginning.
                    if($i == $keySize || $i > $keySize){
                        // This variable will contain the shifting index for the key.
                        $a = $i % $keySize;
    
                        // $x is the vigenère cipher calculation.
                        // the "array_search()" is a process to get
                        // the alphabet number.
                        $x = (int)array_search($editedMessage[$i], self::$alphabet) + array_search(strtolower($key[$a]), self::$alphabet);
                        // The length of the alphabet which is 26.
                        $y = 26;
    
                        // The final process of the calculation.
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
                        $x = (int)array_search($editedMessage[$i], self::$alphabet) + array_search(strtolower($key[$i]), self::$alphabet);
                        // The length of the alphabet which is 26.
                        $y = 26;
    
                        // The final process of the calculation.
                        $c = fmod($x, $y);
    
                        // If the result from modulo is smaller than 0, then $c will be 
                        // added with $y where $y is an absolute (positive) value.
                        if($c < 0){
                            $c += abs($y);
                        }
                    }
                    
                    // Checking if the value is exist on the alphabet lookup.
                    if(isset(self::$alphabet[$c])){
                        $encrypted .= self::$alphabet[$c];
                    }
                }
            }
    
            // Counter for the position of the encrypted message.
            $k = 0;
    
            // This loop has a purpose to reconstruct the encrypted message based on
            // the length of the original messsage itself.
            for($j = 0; $j < strlen($message); $j++){
                // If the message on index $j is an alphabetic, then it will return
                // the encrypted message on position $k.
                if(ctype_alpha($message[$j])){
                    // If the letter on message index $j is an uppercase letter,
                    // then the output will be converted from lowercase to uppercase.
                    if(ctype_upper($message[$j])){
                        // Appending the output.
                        $output .= strtoupper($encrypted[$k]);
        
                        // Adding the position counter.
                        $k += 1;
                    }
                    // Else, just append the encrypted message to the output.
                    else{
                        // Appending the output.
                        $output .= $encrypted[$k];
        
                        // Adding the position counter.
                        $k += 1;
                    }
                }
                // Otherwise, it will return the original message on index $j.
                else{
                    // Appending the output.
                    $output .= $message[($j)];
                }
            }
    
            // return $output;
            return $output;
        }
    }

    /** Vigenère decrypt
     * 
     * The decrypt function which turns an encrypted message to a 
     * plaintext message.
     * 
     * @param string $message
     * The message.
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
    public function decrypt($message, $key){
        // Bunch of errors handling.
        //
        // If the key is empty, then it will throw an error.
        if(empty($key) || $key === NULL){
            throw new Error('The key cannot be empty!');
        }
        // If the length of the key is less than 2, then it will throw an error.
        elseif(trim(strlen($key)) < 2){
            throw new Error('The key must be at least 2 characters long!');
        }
        // If the key is more than 1 word, then it will throw an error.
        elseif(count(explode(" ", $key)) > 1){
            throw new Error('The key must only 1 word!');
        }
        // If the key contins any non-alphabetic character, then it will throw an error.
        elseif(preg_match('/[0-9\W_]/', $key)){
            throw new Error('The key cannot contain any non-alphabetic characters such as numbers, and symbols!');
        }
        // Else, do a normal procedure.
        else{
            // Output variable defined as empty.
            $output = '';
            // Decrypted variable defined as empty.
            $decrypted = '';
            // The length of the original message.
            $messageSize = strlen($message);
            // The length of the key.
            $keySize = strlen($key);
    
            // Detecting if the message contains 
            // a non-aplhabetic characters.
            if(preg_match('/[a-z0-9\W\s_]/', $message)){
                // Replacing those non-alphabetic characters with '', and converting the message
                // to the lowercase letter.
                $editedMessage = strtolower(preg_replace("/[0-9\W\s_]/", '', $message));
    
                // The length of the edited message.
                $messageSize = strlen($editedMessage);
    
                // Looping to do the decipher based on how long of the message is.
                for($i = 0; $i < $messageSize; $i++){
                    // If the value of $i is equal to the length of the key or greater, 
                    // then the key will be reset to the beginning.
                    if($i == $keySize || $i > $keySize){
                        // This variable will contain the shifting index for the key.
                        $a = $i % $keySize;
    
                        // $x is the vigenère cipher calculation.
                        // the "array_search()" is a process to get
                        // the alphabet number.
                        $x = (int)array_search($editedMessage[$i], self::$alphabet) - array_search(strtolower($key[$a]), self::$alphabet);
                        // The length of the alphabet which is 26.
                        $y = 26;
    
                        // The final process of the calculation.
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
                        $x = (int)array_search($editedMessage[$i], self::$alphabet) - array_search(strtolower($key[$i]), self::$alphabet);
                        // The length of the alphabet which is 26.
                        $y = 26;
    
                        // The final process of the calculation.
                        $c = fmod($x, $y);
    
                        // If the result from modulo is smaller than 0, then $c will be 
                        // added with $y where $y is an absolute (positive) value.
                        if($c < 0){
                            $c += abs($y);
                        }
                    }
                    
                    // Checking if the value is exist on the alphabet lookup.
                    if(isset(self::$alphabet[$c])){
                        $decrypted .= self::$alphabet[$c];
                    }
                }
            }
    
            // Counter for the position of the decrypted message.
            $k = 0;
    
            // This loop has a purpose to reconstruct the decrypted message based on
            // the length of the original messsage itself.
            for($j = 0; $j < strlen($message); $j++){
                // If the message on index $j is an alphabetic, then it will return
                // the decrypted message on position $k.
                if(ctype_alpha($message[$j])){
                    // If the letter on message index $j is an uppercase letter,
                    // then the output will be converted from lowercase to uppercase.
                    if(ctype_upper($message[$j])){
                        // Appending the output.
                        $output .= strtoupper($decrypted[$k]);
        
                        // Adding the position counter.
                        $k += 1;
                    }
                    // Else, just append the decrypted message to the output.
                    else{
                        // Appending the output.
                        $output .= $decrypted[$k];
        
                        // Adding the position counter.
                        $k += 1;
                    }
                }
                // Otherwise, it will return the original message on index $j.
                else{
                    // Appending the output.
                    $output .= $message[($j)];
                }
            }
    
            // return $output;
            return $output;
        }
    }

}
