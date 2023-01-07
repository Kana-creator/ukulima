
<?php

include_once 'ukulima/phpqrcode/qrlib.php';

class Qrcodegenerator
{
    public function generate_qr($serial_number)
    {
        $path =  '../ukulima/phpqrcode/qr_images/';
        $qrcode = $path . $serial_number . '.png';
        QRcode::png($serial_number, $qrcode, 'H', 4, 4);

        return $qrcode;
    }
}
