# vigenere-cipher
A Vigenere Cipher library for CodeIgniter

Intro
=====
Vigenère Cipher is a plain-text form of encoding that uses alphabetical substitution to encode text. The Vigenère Cipher uses something called a "*Tabula Recta*", a grid of alphabetic characters where encoders can shift lines for alphabetic substitution. **The shifting process is done according to a repeating keyword** which serves to make the encryption more complex and more difficult to decode.

Installation
============
Before you initialize the library, the first thing you must do is copy the **`Vigenere.php`** to your CodeIgniter project **`/application/libraries`** directory. After that you can simply initialize the library on your **Controller**. Put it on the `__construct()` function.

```
function __construct(){ 
  parent::__construct();
  
  $this->load->library('vigenere'); 
}
```
After that, you can simply call the function like example below :
```
// For encoding the message
$this->vigenere->encode('<your message>', '<your key>');

// For decoding the message
$this->vigenere->decode('<your message>', '<your key>');
```

Note
----
This library is not completed... yet. There might be some update some time in the future.

The Developer's GitHub :

Ichwanul Fadhli

[@ichwanulf99](https://github.com/ichwanulf99/)

Dhimas Panjie Herlambang

[@DhimasPH](https://github.com/DhimasPH/)

Copyright (c) 2020, Ichwanul Fadhli, Dhimas Panjie Herlambang
