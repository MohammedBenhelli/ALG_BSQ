<?php

function readTest(string $name): array
{
    $file = file_get_contents($name);
    $tab = explode("\n", $file);
    array_shift($tab);
    array_pop($tab);
    return $tab;
}

function getSquare(array &$tab, int $x, int $y): int
{
    $sq = 0;
    $j = $x;
    $i = $y;
    while (true) {
        if (isset($tab[$y][$x + 1]) && isset($tab[$y + 1][$x]) && $tab[$y][$x + 1] === "." && $tab[$y + 1][$x] === ".") {
            for ($nx = $j; $nx < $x + 2; $nx++)
                if ($tab[$y + 1][$nx] === "o") return $sq;
            for ($ny = $i; $ny < $y + 2; $ny++)
                if ($tab[$ny][$x + 1] === "o") return $sq;
            $sq++;
            $x++;
            $y++;
        } else return $sq;
    }
}

function printResult(array &$tab): void
{
    foreach ($tab as $value)
        echo $value . "\n";
}

function secuDeLaSecu(array $argv): bool
{
    if (count($argv) < 2) {
        echo "\e[31mVeuillez indiquer le fichier en argument!\n";
        return false;
    }
    if (!is_file($argv[1])) {
        echo "\e[31mVeuillez indiquer un fichier valide!\n";
        return false;
    }
    return true;
}

function cas1(array $tab): bool
{
    if (count($tab) === 1 || strlen($tab[0]) === 1) {
        $secu = 0;
        if (strlen($tab[0]) === 1)
            foreach ($tab as $key => $line)
                if ($line === "." && $secu === 0) {
                    $tab[$key] = "X";
                    $secu++;
                }
        if (count($tab) === 1)
            for ($i = 0; $i < strlen($tab[0]); $i++)
                if ($tab[0][$i] === "." && $secu === 0) {
                    $tab[0][$i] = "X";
                    $secu++;
                }
        printResult($tab);
        return false;
    }
    return true;
}

function bsq(array $argv, int $argc)
{
    if (secuDeLaSecu($argv)) {
        $tab = readTest($argv[1]);
        if (cas1($tab)) {
            $best = 0;
            $x = 0;
            $y = 0;
            for ($i = 0; $i < count($tab); $i++)
                for ($j = 0; $j < strlen($tab[$i]); $j++)
                    if ($tab[$i][$j] === ".") {
                        $max = getSquare($tab, $j, $i);
                        if ($max > $best) {
                            $x = $j;
                            $y = $i;
                            $best = $max + 1;
                        }
                    }
            for ($i = 0; $i < $best; $i++)
                for ($j = 0; $j < $best; $j++)
                    $tab[$y + $i][$x + $j] = "X";
            printResult($tab);
        }
    }
}

bsq($argv, $argc);