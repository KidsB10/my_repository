<?php

function encode_rle(string $str)
{
    $counter = 1;
    $result = "";

    for ($i = 1; $i <= strlen($str); $i++) {
        if($i == strlen($str)) {
            if($str[$i-1] == $str[$i-2]) {
                $result .= ($counter >= 1 ? $counter : "") . $str[$i-1];
            } else {
                $result .= $counter . $str[$i-1];
            }
        } else if($str[$i-1] != $str[$i]) {
            $result .= ($counter >= 1 ? $counter : "") . $str[$i-1];
            $counter = 0;
        }
        $counter++;
    }
    return $result;
}

function decode_rle(string $str)
{
    $number = null;
    $result = "";

    for ($i = 0; $i < strlen($str); $i++) {
        if (is_numeric($str[$i])) {
            $number .= $str[$i];
        } else {
            if ($number != null) {
                $result .= str_repeat($str[$i], intval($number));
            } else {
                $result .= $str[$i];
            }
            $number = null;
        }
    }
    return $result;
}

function isAlphaNumeric(string $str)
{
    $i = 0;
    while ($i < strlen($str)) {
        if (($str[$i] >= 'a' && $str[$i] <= 'z') || ($str[$i] >=  'A' && $str[$i] <= 'Z') || ($str[$i] >=  '0' && $str[$i] <= '9')) {
            ++$i;
        } else {
            return 0;
        }
    }
    return 1;
}

if (empty($argv[2])) {

    exit("\n");
}

if(($argv[1] == "encode") && (isAlphaNumeric($argv[2]) == 1)) {
    $code = encode_rle($argv[2]);
}
else if(($argv[1] == "decode") && (isAlphaNumeric($argv[2]) == 1) && (ctype_alpha($argv[2][-1]))) {
    $code = decode_rle($argv[2]);
}
else {
    exit("$$$\n");
}
echo $code."\n";

?>