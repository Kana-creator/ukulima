<?php


function encrypt_data($data){
    $ciphering = "AES-128-CTR";  
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;  
    $encryption_iv = '1234567891011121';  
    $encryption_key = "vu-bit-2022-anny-1991-*#";
    
    $encryption = openssl_encrypt($data, $ciphering,
                $encryption_key, $options, $encryption_iv);

    return $encryption;

}


function decrypt_data($data){
    $ciphering = "AES-128-CTR";  
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;  
    $encryption_iv = '1234567891011121';  
    $encryption_key = "vu-bit-2022-anny-1991-*#";
    
    $encryption = openssl_decrypt($data, $ciphering,
                $encryption_key, $options, $encryption_iv);

    return $encryption;

}

