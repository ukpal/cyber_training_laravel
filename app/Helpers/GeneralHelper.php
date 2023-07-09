<?php

if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (!function_exists('app_url')) {
    /**
     * Helper to grab the application url.
     *
     * @return mixed
     */
    function app_url()
    {
        return config('app.url');
    }
}

if (!function_exists('createCaptcha')) {
    /**
     * Helper to generate captcha code.
     *
     * @return mixed
     */
    function createCaptcha()
    {
        $image_width = 120;
        $image_height = 40;
        $font_size_min = $image_height * 0.55;
        $font_size_max = $image_height * 0.90;
        $font = public_path() . '/assets/fonts/monofont.ttf';

        $possible_letters = '23456789BCDFGHJKMNPQRSTVWXYZ';

        // initialise image with dimensions
        $image = @imagecreatetruecolor($image_width, $image_height) or die("Cannot Initialize new GD image stream");

        // set background to white and allocate drawing colours
        $background = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
        imagefill($image, 0, 0, $background);
        $linecolor = imagecolorallocate($image, 0xCC, 0xCC, 0xCC);
        $textcolor = imagecolorallocate($image, 0x33, 0x33, 0x33);

        // draw random lines on canvas
        for ($i = 0; $i < 6; $i++) {
            imagesetthickness($image, rand(1, 3));
            imageline($image, 0, rand(0, 30), 120, rand(0, 30), $linecolor);
        }

        // add random digits to canvas
        $digit = '';
        for ($x = 1; $x <= 110; $x += 20) {
            //$digit .= ($num = rand(0, 9));
            $digit .= ($num = substr($possible_letters, mt_rand(0, strlen($possible_letters) - 1), 1));
            //imagechar($image, rand(5, 7), $x, rand(2, 10), $num, $textcolor);
            imagettftext($image, rand($font_size_min, $font_size_max), 0, $x, rand(28, 35), $textcolor, $font, $num);
        }

        // record digits in session variable
        Session::put('captcha', $digit);

        // display image and clean up
        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }
}

if (!function_exists('flash_message')) {
    function flash_message()
    {
        if (Session::has('message')) {
            list($type, $message) = explode('|', Session::get('message'));
            if ($type == 'error') {
                $type = 'danger';
            } elseif ($type == 'message') {
                $type = 'info';
            } elseif ($type == 'success') {
                $type = 'success';
            }

            return '<div class="alert alert-' . $type . ' flash-message">' . $message . '</div>';
        }

        return '';
    }
}

if (!function_exists('convertToMySqlDate')) {
    function convertToMySqlDate($date, $fromFormat = 'd-m-Y', $toFormat = 'Y-m-d')
    {
        $dt = new DateTime();
        $datetime = $dt->createFromFormat($fromFormat, $date)->format($toFormat);
        return $datetime;
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $fromFormat = 'Y-m-d', $toFormat = 'd-M-Y')
    {
        $dt = new DateTime();
        if ($date != null) {
            $datetime = $dt->createFromFormat($fromFormat, $date)->format($toFormat);
            return $datetime;
        } else {
            return '';
        }
    }
}

if (!function_exists('getRelativeTime')) {
    function getRelativeTime($datetime)
    {
        //$timestamp = \DateTime::createFromFormat('Y-m-d H:i:s', $datetime)->getTimestamp();
        date_default_timezone_set('Asia/Kolkata');
        $timestamp = strtotime($datetime);
        // Get time difference and setup arrays
        $difference = time() - $timestamp;
        $periods = array("second", "minute", "hour", "day", "week", "month", "years");
        $lengths = array("60", "60", "24", "7", "4.35", "12");

        // Past or present
        if ($difference >= 0) {
            $ending = "ago";
        } else {
            $difference = -$difference;
            $ending = "to go";
        }

        // Figure out difference by looping while less than array length
        // and difference is larger than lengths.
        $arr_len = count($lengths);
        for ($j = 0; $j < $arr_len && $difference >= $lengths[$j]; $j++) {
            $difference /= $lengths[$j];
        }

        // Round up
        $difference = round($difference);

        // Make plural if needed
        if ($difference != 1) {
            $periods[$j] .= "s";
        }

        // Default format
        $text = "$difference $periods[$j] $ending";

        // over 24 hours
        if ($j > 2) {
            // future date over a day formate with year
            if ($ending == "to go") {
                if ($j == 3 && $difference == 1) {
                    $text = "Tomorrow at " . date("g:i a", $timestamp);
                } else {
                    $text = date("F j, Y \a\\t g:i a", $timestamp);
                }
                return $text;
            }

            if ($j == 3 && $difference == 1) { // Yesterday
                $text = "Yesterday at " . date("g:i a", $timestamp);
            } else if ($j == 3) { // Less than a week display -- Monday at 5:28pm
                $text = date("l \a\\t g:i a", $timestamp);
            } else if ($j < 6 && !($j == 5 && $difference == 12)) { // Less than a year display -- June 25 at 5:23am
                $text = date("F j \a\\t g:i a", $timestamp);
            } else { // if over a year or the same month one year ago -- June 30, 2010 at 5:34pm
                $text = date("F j, Y \a\\t g:i a", $timestamp);
            }
        }

        return $text;
    }
}

if (!function_exists('firstNwords')) {
    function firstNwords($text, $length = 160, $dots = true)
    {
        $text = trim(preg_replace('#[\s\n\r\t]{2,}#', ' ', $text));
        $text_temp = $text;
        while (substr($text, $length, 1) != " ") {
            $length++;
            if ($length > strlen($text)) {
                break;
            }
        }
        $text = substr($text, 0, $length);
        return $text . (($dots == true && $text != '' && strlen($text_temp) > $length) ? ' ...' : '');
    }
}

if (!function_exists('firstNletters')) {
    function firstNletters($text, $length = 50, $dots = true)
    {
        $text_temp = substr($text, 0, $length);
        return $text_temp . (($dots == true && $text != '' && strlen($text) > $length) ? ' ...' : '');
    }
}

if (!function_exists('seoUrl')) {
    function seoUrl($phrase, $maxLength = 100000000000000)
    {
        $result = strtolower($phrase);

        $result = preg_replace("~[^A-Za-z0-9-\s]~", "", $result);
        $result = trim(preg_replace("~[\s-]+~", " ", $result));
        $result = trim(substr($result, 0, $maxLength));
        $result = preg_replace("~\s~", "-", $result);

        return $result;
    }
}

if (!function_exists('getGenderTypes')) {
    function getGenderTypes()
    {
        $gender_types = array(
            "" => "",
            "MALE" => "MALE",
            "FEMALE" => "FEMALE",
            "OTHERS" => "OTHERS",
        );

        return $gender_types;
    }
}

if (!function_exists('generateRandomCode')) {
    function generateRandomCode()
    {
        $possible_letters = '23456789BCDFGHJKMNPQRSTVWXYZ';
        $code = '';
        for ($x = 0; $x < 6; $x++) {
            $code .= ($num = substr($possible_letters, mt_rand(0, strlen($possible_letters) - 1), 1));
        }
        return $code;
    }
}

if (!function_exists('generateOTP')) {
    function generateOTP()
    {
        $possible_letters = '1234567890';
        $code = '';
        for ($x = 0; $x < 6; $x++) {
            $code .= ($num = substr($possible_letters, mt_rand(0, strlen($possible_letters) - 1), 1));
        }
        return $code;
    }
}

if (!function_exists('initiateSmsActivation')) {
    function initiateSmsActivation($phone_number, $message, $template = 'AUTH_OTP')
    {
        /* if (env('APP_DEBUG')) {
            return true;
        } */
        $templateid =   '1007560946765778162';

        if ($template == 'AUTH_OTP') {
            $templateid =   '1407162693580244545';
        }
        else if ($template == 'NEW_REG_USR') {
            $templateid =   '1407162394435132018';
        }
        else if ($template == 'NEW_REG_SDC') {
            $templateid =   '1407162394175974590';
        }
        else if ($template == 'REG_APPR') {
            $templateid =   '1407162394455492624';
        }
        else if ($template == 'RAPP_COMP') {
            $templateid =   '1407162394197896729';
        }
        else if ($template == 'RFUN_TEST') {
            $templateid =   '1407162394204961477';
        }
        else if ($template == 'RPER_TEST') {
            $templateid =   '1407162394210945242';
        }
        else if ($template == 'HOST_REQ') {
            $templateid =   '1407162394250423844';
        }
        else if ($template == 'DOM_REQ') {
            $templateid =   '1407162394345420914';
        }
        else if ($template == 'VPN_REQ') {
            $templateid =   '1407162394364743715';
        }
        else if ($template == 'PORT_REQ') {
            $templateid =   '1407162394384297531';
        }
        else if ($template == 'BKP_REQ') {
            $templateid =   '1407162394399135114';
        }
        else if ($template == 'HOST_REQ_APPR') {
            $templateid =   '1407162394328775277';
        }

        $params = array(
            'mobile'    =>  urlencode($phone_number),
            'message'   =>  urlencode($message),
            'templateid' =>  $templateid,
            'passkey'   =>  'sms_wbsdc',
            'extra'     =>  ''
        );
        $params_string = "";
        foreach ($params as $key => $value) {
            $params_string .= $key . '=' . $value . '&';
        }
        rtrim($params_string, '&');

        $smsurl     =     'https://sms.nltr.org/send_sms_wbsdc_dlt.php';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $smsurl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);

        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($status == 200) {
            curl_close($ch);
            return true;
        } else {
            return false;
        }
        return true;
    }
}

//encrypt password
if (!function_exists('encrypt_password')) {
    function encrypt_password($password)
    {
        return hash('sha512', $password);
    }
}

if (!function_exists('maskInfo')) {
    function maskInfo($data, $type)
    {
        $mask_data = '';
        if (strlen($data) > 0) {
            if ($type == 'phone') {
                $mask_data = substr($data, 0, 2) . 'XXXXXX' . substr($data, -2);
            } else if ($type == 'email') {
                if (strpos($data, '@') !== false) {
                    list($first, $last) = explode('@', $data);
                    if (strlen($first) > 3) {
                        $max = strlen($first) > 7 ? 7 : strlen($first);
                        $first = str_replace(substr($first, '3'), str_repeat('x', $max), $first);
                    } else {
                        $n = strlen($first) - 1;
                        $first = str_replace(substr($first, $n), str_repeat('x', strlen($first) - $n), $first);
                    }

                    $last = explode('.', $last);

                    $last_domain = str_replace(substr($last['0'], '1'), str_repeat('x', strlen($last['0']) - 1), $last['0']);

                    $mask_data = $first . '@' . $last_domain . '.' . $last['1'];
                } else {
                    $mask_data = $data;
                }
            } else if ($type == 'linkedin') {
                $url = "";
                $str = strtolower($data);
                if (strpos($str, 'https://www.linkedin.com/in/') !== false) {
                    $url = substr($data, strlen('https://www.linkedin.com/in/'));
                } else if (strpos($str, 'https://linkedin.com/in/') !== false) {
                    $url = substr($data, strlen('https://linkedin.com/in/'));
                } else if (strpos($str, 'http://www.linkedin.com/in/') !== false) {
                    $url = substr($data, strlen('http://www.linkedin.com/in/'));
                } else if (strpos($str, 'http://linkedin.com/in/') !== false) {
                    $url = substr($data, strlen('http://linkedin.com/in/'));
                } else if (strpos($str, 'www.linkedin.com/in/') !== false) {
                    $url = substr($data, strlen('www.linkedin.com/in/'));
                } else if (strpos($str, 'linkedin.com/in/') !== false) {
                    $url = substr($data, strlen('linkedin.com/in/'));
                } else {
                    $url = $data;
                }

                if (strlen($url) > 3) {
                    $max = strlen($url) > 10 ? 7 : strlen($url);
                    $first = str_replace(substr($url, '3'), str_repeat('x', $max), $url);
                } else {
                    $n = strlen($url) - 1;
                    $first = str_replace(substr($url, $n), str_repeat('x', strlen($url) - $n), $url);
                }

                $mask_data = $first;
            } else if ($type == 'github') {
                $mask_data = $data;
            }
        }
        return $mask_data;
    }
}

if (!function_exists('encryptInfo')) {
    function encryptInfo($data, $ciphering = "AES-128-CBC")
    {
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = env('ENC_IV');
        $encryption_key = openssl_digest(env('HASH_SALT'), 'MD5', TRUE);

        $encryption = openssl_encrypt(
            $data,
            $ciphering,
            $encryption_key,
            $options,
            $encryption_iv
        );

        return $encryption;
    }
}

if (!function_exists('decryptInfo')) {
    function decryptInfo($data, $ciphering = "AES-128-CBC")
    {
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        $decryption_iv = env('ENC_IV');
        $decryption_key = openssl_digest(env('HASH_SALT'), 'MD5', TRUE);

        $decryption = openssl_decrypt(
            $data,
            $ciphering,
            $decryption_key,
            $options,
            $decryption_iv
        );

        return $decryption;
    }
}

if (!function_exists('getTimeDiffInMinute')) {
    function getTimeDiffInMinute($time1, $time2)
    {
        $minutes = (strtotime($time1) - strtotime($time2)) / 60;

        return $minutes;
    }
}

if (!function_exists('getTimeDiffInSecond')) {
    function getTimeDiffInSecond($time1, $time2)
    {
        $seconds = (strtotime($time1) - strtotime($time2));

        return $seconds;
    }
}

if (!function_exists('isDomainAvailible')) {
    function isDomainAvailible($domain)
    {
        //check, if a valid url is provided
        if (!filter_var($domain, FILTER_VALIDATE_URL)) {
            return false;
        }

        //initialize curl
        $curlInit = curl_init($domain);
        curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlInit, CURLOPT_HEADER, true);
        curl_setopt($curlInit, CURLOPT_NOBODY, true);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

        //get answer
        $response = curl_exec($curlInit);

        curl_close($curlInit);
		return true;
        if ($response) return true;

        return false;
    }
}

if (!function_exists('isValidGovtEmail')) {
    function isValidGovtEmail($str)
    {
        //return true;

        if( (strpos($str, 'gov.in') !== false)
            || (strpos($str, 'nic.in') !== false)
            || (strpos($str, 'wtl.co.in') !== false) ){
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('validMimeType')) {
    function validMimeType($file)
    {
        $file_mime = $file->getMimeType();

        $is_valid_mime = false;
        if ($file_mime == 'application/pdf') {
            $is_valid_mime = true;
        }
        return $is_valid_mime;
    }
}

// Function to get the client IP address
if (!function_exists('get_client_ip')) {
    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}

if (!function_exists('getHitCount')) {
    function getHitCount()
    {
        DB::table('hit_counter')->increment('count');

        $count = DB::table('hit_counter')->select('count')->first();

        return ""; //$count->count;
    }
}

if (!function_exists('printFullname')) {
    function printFullname($fullname)
    {
        return ucwords(strtolower($fullname));
    }
}    

if (!function_exists('printActiveStatus')) {
    function printActiveStatus($val)
    {
        if($val == 0) {
            return '<span class="badge badge-danger">In-active</span>';
        }
        else {
            return '<span class="badge badge-success">Active</span>';
        }
    }
} 

if (!function_exists('printYoddhaStatus')) {
    function printYoddhaStatus($val)
    {
        if($val == 'pending') {
            return '<span class="badge badge-warning">Pending</span>';
        }
        elseif ($val == 'rejected') {
            return '<span class="badge badge-danger">' . $val . '</span>';
        }
        else {
            return '<span class="badge badge-success">' . $val . '</span>';
        }
    }
} 