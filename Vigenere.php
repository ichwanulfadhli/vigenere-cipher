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
     * Notice the message must only an alphabetic character.
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
        // Output variable defined as empty.
        $output = '';
        // Encrypted variable defined as empty.
        $encrypted = '';
        // The length of the original message.
        $messageSize = strlen($message);
        // The length of the key.
        $keySize = strlen($key);

        // If the message contains whitespaces, then 
        // it will follow the first procedure.
        if(strpos($message, ' ')){
            // Erasing the whitespaces from the message.
            $editedMessage = str_replace(' ', '', $message);

            // Splitting the message into a several pieces
            // with whitespace as a seperator.
            $messageChunk = explode(' ', $message);
            
            // The previous length is modified with the new one.
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
                    $x = (int)array_search($editedMessage[$i], self::$alphabet) + array_search($key[$a], self::$alphabet);
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
                    $x = (int)array_search($editedMessage[$i], self::$alphabet) + array_search($key[$i], self::$alphabet);
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
            // Counter for the position of the encrypted message.
            $o = 0;

            // This loop has a purpose to reconstruct the encrypted message based on 
            // how many words which has been seperated from the whitespaces.
            for($j = 0; $j < count($messageChunk); $j++){
                for($k = 0; $k < strlen($messageChunk[$j]); $k++){
                    // Reconstructing the output.
                    $output .= $encrypted[$o];
                    // Adding the counter to 1.
                    $o += 1;
                }
                // Adding the spaces.
                $output .= ' ';
            }
        }
        // If not, then it will follow the second procedure.
        else{
            // The length of the modified message.
            $messageSize = strlen($message);
            
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
                    $x = (int)array_search($message[$i], self::$alphabet) + array_search($key[$a], self::$alphabet);
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
                    $x = (int)array_search($message[$i], self::$alphabet) + array_search($key[$i], self::$alphabet);
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
                    $output .= self::$alphabet[$c];
                }
            }
        }
        
        // Returning the result.
        return $output;
    }

    /** Vigenère Decode
     * 
     * The encode function which turns the encoded message to the 
     * plaintext message.
     * 
     * @param string $message
     * The message.
     * 
     * Notice the message must only an alphabetic character.
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
        // Output variable defined as empty.
        $output = '';
        // Encrypted variable defined as empty.
        $encrypted = '';
        // The length of the original message.
        $messageSize = strlen($message);
        // The length of the key.
        $keySize = strlen($key);

        // If the message contains whitespaces, then 
        // it will follow the first procedure.
        if(strpos($message, ' ')){
            // Erasing the whitespaces from the message.
            $editedMessage = str_replace(' ', '', $message);

            // Splitting the message into a several pieces
            // with whitespace as a seperator.
            $messageChunk = explode(' ', $message);
            
            // The previous length is modified with the new one.
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
                    $x = (int)array_search($editedMessage[$i], self::$alphabet) - array_search($key[$a], self::$alphabet);
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
                    $x = (int)array_search($editedMessage[$i], self::$alphabet) - array_search($key[$i], self::$alphabet);
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
            // Counter for the position of the encrypted message.
            $o = 0;

            // This loop has a purpose to reconstruct the encrypted message based on 
            // how many words which has been seperated from the whitespaces.
            for($j = 0; $j < count($messageChunk); $j++){
                for($k = 0; $k < strlen($messageChunk[$j]); $k++){
                    // Reconstructing the output.
                    $output .= $encrypted[$o];
                    // Adding the counter to 1.
                    $o += 1;
                }
                // Adding the spaces.
                $output .= ' ';
            }
        }
        // If not, then it will follow the second procedure.
        else{
            // The length of the modified message.
            $messageSize = strlen($message);
            
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
                    $x = (int)array_search($message[$i], self::$alphabet) - array_search($key[$a], self::$alphabet);
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
                    $x = (int)array_search($message[$i], self::$alphabet) - array_search($key[$i], self::$alphabet);
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
                    $output .= self::$alphabet[$c];
                }
            }
        }
        
        // Returning the result.
        return $output;
    }
    
}
