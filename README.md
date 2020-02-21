# vigenere-cipher
A Vigenere Cipher library for CodeIgniter

Intro
=====
Vigenère Cipher is a plain-text form of encryption that uses alphabetical substitution to encrypt text. The Vigenère Cipher uses something called a "*Tabula Recta*", a grid of alphabetic characters where you can shift lines for alphabetic substitution. **The shifting process is done according to a repeating keyword** which serves to make the encryption more complex and more difficult to decrypt. For instance :

Plaintext = BLUE SKY

Key = SKY

Shifting Process :

B   L   U   E   S   K   Y

S   K   Y   S   K   Y   S

The Result = TVSW CIQ

Here's the illustration.

![](https://media.giphy.com/media/jOVoVsBNlwdJr6Y0zX/giphy.gif "Vigenère Cipher Key Shifting")

**Notice : The top section of the grid is for the message, while the left section is for the key.*

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
// For encrypting the message
$this->vigenere->encrypt('<your message>', '<your key>');

// For decrypting the message
$this->vigenere->decrypt('<your message>', '<your key>');
```

The Developers
--------------
**Ichwanul Fadhli**

GitHub    : [@ichwanulfadhli](https://github.com/ichwanulfadhli/)

Instagram : [@ichwa_nf](https://www.instagram.com/ichwa_nf/)

**Dhimas Panjie Herlambang**

GitHub    : [@DhimasPH](https://github.com/DhimasPH/)

Instagram : [@dhimas_herlambang](https://www.instagram.com/dhimas_herlambang/)

Note
----
There might be some update for the improvement some time in the future.

Copyright (c) 2020 Ichwanul Fadhli & Dhimas Panjie Herlambang
