<?php
$f = fopen("list",'r');

const INIT = "(N/A - no previous measurement)";
const HIGHER = "(increased)";
const LOWER = "(decreased)";
const NONE = "(no change)";

/** @var int $last */
$last = [];
$last[0]=0;
$last[1]=0;
$last[2]=0;
$last[3]=0;
$index = -1;
$higher = 0;
$lower = 0;
$same = 0;

while(($line=fgets($f))!== false){
  $val = intval($line);
  $index++;
  $last[$index%3] = $val;
  if($index < 2){
//    $last[$index%3] = $val;
    echo "$val     " . INIT . "\n";
    continue;
  }
  $A = $last[0] + $last[1] + $last[2];
  if($index == 2){
    $last[3] = $A;
    echo "$val $A " . INIT . "\n";
    continue;
  }
  $line = "$val " . NONE;
  if($last[3] < $A){
    $higher++;
    $line = "$val $A " . HIGHER;
  }
  if($last[3] > $A){
    $lower++;
    $line = "$val $A " . LOWER;
  }
  if($last[3] == $A){
    $same++;
    $line = "$val $A " . NONE;

  }
  echo "$line\n";
  $last[3] = $A;
}

printf(<<<RESULTS

********************
* Processed * %04d *
* Higher    * %04d *
* Lower     * %04d *
* Same      * %04d *
********************
RESULTS , $index +1 , $higher, $lower, $same);
