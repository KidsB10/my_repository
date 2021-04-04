<?php
function encode_advanced_rle(string $input_path, string $output_path)
{   
    $str = bmp_to_hex($input_path);

    $first_couple = "";
    $next_couple = "";
    $how_much = 0;
    $unique_patterns = "";
    $result = "";

    for ($i = 0; $i < strlen($str); $i += 2) {
        $first_couple = substr($str, $i, 2);
        $next_couple = substr($str, $i + 2, 2);
        $how_much = 1;
        $unique_patterns = "";

        if ($first_couple == $next_couple) { 
            while ($first_couple == $next_couple) {
                $how_much++;
                $i += 2;
                $first_couple = substr($str, $i, 2);
                $next_couple = substr($str, $i + 2, 2);
            }
            if ($how_much < 10)
                $how_much = "0" . $how_much;
            $result .= $how_much . $first_couple;

        } else { 
            while($first_couple != $next_couple) {
                $how_much++;
                $unique_patterns .= $first_couple;
                $i += 2;
                $first_couple = substr($str, $i, 2);
                $next_couple = substr($str, $i + 2, 2);
            }
            $how_much--;
            if ($how_much < 10)
                $how_much = "0" . $how_much;
            $result .= "00" . $how_much . $unique_patterns;
            $i -= 2;
        }
    }

    file_put_contents($output_path, $result);
    
    return 0;
}

function decode_advanced_rle(string $input_path, string $output_path) 
{
    $str = bmp_to_hex($input_path);
        
        $first_couple = "";
        $next_couple = "";
        $how_much = 0;
        $result = "";
        $compteur = 0;
        
        if (!ctype_alnum($str))
            return "$$$";

        for ($i = 0; $i < strlen($str); $i += 4) {
            $first_couple = substr($str, $i, 2);
            $next_couple = substr($str, $i + 2, 2);
            if (!ctype_digit($first_couple))
                return "$$$";
            if ($first_couple == "00") {
                $compteur = 0;
                for($j = 0; $j < $next_couple; $j++) {
                    $result .= substr($str, $i + $j + 4 + $compteur, 2);
                    $compteur += 1;
                }
                $i += $next_couple * 2;
            } else 
                $result .= str_repeat($next_couple, $first_couple);
        }

        file_put_contents($output_path, $result);
    
    return 0;
}

function bmp_to_hex($path) {
    $string = file_get_contents($path);
    $output = "";
    for ($i = 0; $i < strlen($string); $i++) {
        $tempo_hex = strtoupper(dechex(ord(substr($string, $i, 1))));
        if (strlen($tempo_hex) == 1)
            $tempo_hex = "0" . $tempo_hex;
        $output .= $tempo_hex;
    }
    return $output;
}

function hex_to_bmp($path) {
    $string = file_get_contents($path);
    $output = "";
    for ($i = 0; $i < strlen($path); $i += 2) {
        $tempo_bmp = chr(hexdec(substr($path, $i, 2)));
        $output .= $tempo_bmp;
    }
    return $output;
}

if (empty($argv[1]) || empty($argv[2]) || empty($argv[3]) || ($argv[1] != "encode") && ($argv[1] != "decode")) {
    echo "One or more argument are missing\n";
}

if(($argv[1] == "encode")) {
    $code = encode_advanced_rle($argv[2], $argv[3]);
    echo "OK\n";
}
else if(($argv[1] == "decode")) {
    $code = decode_advanced_rle($argv[2], $argv[3]);
    echo "OK\n";
}
else {
    return 1;
    echo "KO\n";
}
?>