<?php

namespace App\View\Helper;
use Cake\View\Helper;
use App\Controller\AppController;
use Cake\View\Helper\UrlHelper;
use Cake\Utility\Security;

class CustomHelper extends Helper
{
    public function initialize(array $config)
    {
    }

    
    public function ctpEncryptData($value)
    {
        $key=ENCY_KEY;
        $plaintext =$value;
        $cipher = "aes-128-ctr";
        if (in_array($cipher, openssl_get_cipher_methods()))
        {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv ='3237567841016626';
            $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
        }
        return $ciphertext;
    }
    public function ctpDecryptData($value)
    {
        $key=ENCY_KEY;
        $ciphertext =$value;
        $cipher = "aes-128-ctr";
        if (in_array($cipher, openssl_get_cipher_methods()))
        {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv ='3237567841016626';

            $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
        }
        return $original_plaintext;
    }
}

