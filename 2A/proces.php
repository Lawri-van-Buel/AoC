<?php
const DEBUG    = false;
const none     = -1;
const forward  = 0;
const down     = 1;
const up       = 2;
const backward = 3;

$distance = 0;
$depth    = 0;


if(DEBUG) {
  $a = -2;
  echo $a;
  echo "\n";
  $a += false;
  echo $a;
  echo "\n";
  $a += false;
  echo $a;
  echo "\n";
  $a += false;
  echo $a;
  echo "\n";
  $index = 6;
  $higher = 1;
  $lower = 2;
  $same = 3;
  printResults($index + 1, ["Higher" => $higher, "Lower" => $lower, "Same" => $same]);
  var_dump(NameToMotion("forward"));
  var_dump(NameToMotion("down"));
  var_dump(NameToMotion("up"));
  var_dump(NameToMotion("backward"));
  var_dump(NameToMotion("none"));
  var_dump(NameToMotion("bogus"));

  var_dump(MotionToName(NameToMotion("forward")));
  var_dump(MotionToName(NameToMotion("down")));
  var_dump(MotionToName(NameToMotion("up")));
  var_dump(MotionToName(NameToMotion("backward")));
  var_dump(MotionToName(NameToMotion("none")));
  var_dump(MotionToName(NameToMotion("bogus")));
}

function mainLoop($file = "list"): int{
  $f = fopen($file,'r');
///** @var int $last */
//$last = [];
//$last[0]=0;
//$last[1]=0;
//$last[2]=0;
//$last[3]=0;
//$index = -1;
//$higher = 0;
//$lower = 0;
//$same = 0;
//
//while(($line=fgets($f))!== false){
//  $val = intval($line);
//  $index++;
//  $last[$index%3] = $val;
//  if($index < 2){
////    $last[$index%3] = $val;
//    echo "$val     " . INIT . "\n";
//    continue;
//  }
//  $A = $last[0] + $last[1] + $last[2];
//  if($index == 2){
//    $last[3] = $A;
//    echo "$val $A " . INIT . "\n";
//    continue;
//  }
//  $line = "$val " . NONE;
//  if($last[3] < $A){
//    $higher++;
//    $line = "$val $A " . HIGHER;
//  }
//  if($last[3] > $A){
//    $lower++;
//    $line = "$val $A " . LOWER;
//  }
//  if($last[3] == $A){
//    $same++;
//    $line = "$val $A " . NONE;
//
//  }
//  echo "$line\n";
//  $last[3] = $A;
//}

  return 123;
}

//
//
//$f = fopen("list",'r');
//
////const INIT = "(N/A - no previous measurement)";
////const HIGHER = "(increased)";
////const LOWER = "(decreased)";
////const NONE = "(no change)";
//
//
//
//$distance = 0;
//$depth    = 0;
//

function printResults(int $index,array $values, $target = STDOUT): int{
  $a = 0;
  $a += fwrite($target,"********************\n");
  $a += fwrite($target,sprintf("* %-9s * %04d *\n","Processed",$index));
  $a += fwrite($target,"*##################*\n");
  foreach ($values as $name => $value){
    $a += fwrite($target,sprintf("* %-9s * %04d *\n",$name,$value));
  }
  $a += fwrite($target,"********************\n");
  return $a;
}

function NameToMotion(string $input): int {
//  $val = null;
//  if (defined($input)) {
//    $val = @constant($input);
//  }
//  if(is_null($val)){
//    return -1;
//  }
//  return $val;
  return match ($input) {
    default => none,
    "forward" => forward,
    "down" => down,
    "up" => up,
    "backward" => backward,
  };

}

function MotionToName(int $input): string {
  return match ($input) {
    default => "none",
    forward => "forward",
    down => "down",
    up => "up",
    backward => "backward",
  };
}

exit(mainLoop());