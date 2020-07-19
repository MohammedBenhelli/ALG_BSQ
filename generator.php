<?php

function genererator(array $argv, int $argc){
    $file = "$argv[2]\n";
    for($i = 0; $i < $argv[2]; $i++){
        for($j = 0; $j < $argv[1]; $j++){
            rand(0, $argv[2] * 2) < $argv[3] ? $file.="o" : $file.=".";
        }
        $file.="\n";
    }
    file_put_contents("test.txt", $file);
}

genererator($argv, $argc);