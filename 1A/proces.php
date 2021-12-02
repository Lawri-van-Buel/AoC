<?php
$f = fopen("list",'r');

const INIT = "(N/A - no previous measurement)";
const HIGHER = "(increased)";
const LOWER = "(decreased)";
const NONE = "(IDLE)";

/** @var int $last */
$last;

$index = -1;
$higher = 0;
$lower = 0;

while(($line=fgets($f))!== false){
  $val = intval($line);
  $index++;
  if(!isset($last)){
    $last = $val;
    echo "$val " . INIT;
    continue;
  }

  $line = "$val " . NONE;
  if($last < $val){
    $higher++;
    $line = "$val " . HIGHER;
  }
  if($last > $val){
    $lower++;
    $line = "$val " . LOWER;
  }
  echo "$line\n";
  $last = $val;
}

printf(<<<RESULTS

********************
* Processed * %04d *
* Higher    * %04d *
* Lower     * %04d *
********************
RESULTS , $index, $higher, $lower);
