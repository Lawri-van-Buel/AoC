<?php

class aoc_2b {
  const DEBUG    = false;
  const none     = -1;
  const forward  = 0;
  const down     = 1;
  const up       = 2;
  const backward = 3;

  public int   $distance;
  public int   $depth;
  public int   $aim;
  public array $stepCounter;
  public int   $index;
  public bool  $planeMode;

public function __construct() {
  $this->distance = 0;
  $this->depth = 0;
  $this->stepCounter = [];
  $this->stepCounter[self::forward] = 0;
  $this->stepCounter[self::down] = 0;
  $this->stepCounter[self::up] = 0;
  $this->stepCounter[self::backward] = 0;
  $this->index = -1;
  $this->aim = 0;
  $this->planeMode = false;

}

function mainLoop($file = "list"): int
{
  $f = fopen($file, 'r');
  while (($line = fgets($f)) !== false) {
    $this->index++;
    $elements = explode(" ",$line,2);
    $command = self::NameToMotion($elements[0]);
    $val = intval($elements[1]);
    $this->stepCounter[$command]++;
    switch($command) {
      default:
        fprintf(STDERR, "Unknown Command Detected [$line]\n");
        break;
      case self::forward:
        $this->distance = $this->distance + $val;
        $this->depth = $this->depth + ($val * $this->aim);
        break;
//      case self::backward:
//        $this->distance = $this->distance - $val;
//        break;
      case self::down:
        $this->aim = $this->aim + $val;
        break;
      case self::up:
        $this->aim = $this->aim - $val;
        if ($this->depth < 0) {
          $this->planeMode = true;
          fprintf(STDERR, "Transformed into a Plane [$this->depth]\n");
        }
        break;
    }
  }
  $this->printResults($this->index,[
    "Forward"  => $this->stepCounter[self::forward],
    "Backward" => $this->stepCounter[self::backward],
    "Down" => $this->stepCounter[self::down],
    "Up" => $this->stepCounter[self::up],
    "*********" => 0,
    "Distance" => $this->distance,
    "Depth" => $this->depth,
    "Aim" => $this->aim,
    "Vector" => $this->depth * $this->distance,
  ]);
  if($this->planeMode){
    return 5;
  }
  return 0;
}

function printResults(int $index, array $values, $target = STDOUT): int
{
  $a = 0;
  $a += fwrite($target, "********************\n");
  $a += fwrite($target, sprintf("* %-9s * %04d *\n", "Processed", $index));
  $a += fwrite($target, "*##################*\n");
  foreach ($values as $name => $value) {
    $a += fwrite($target, sprintf("* %-9s * %04d *\n", $name, $value));
  }
  $a += fwrite($target, "********************\n");
  return $a;
}

public static function NameToMotion(string $input): int {
  return match ($input) {
    default => self::none,
    "forward" => self::forward,
    "down" => self::down,
    "up" => self::up,
    "backward" => self::backward,
  };
}

public static function MotionToName(int $input): string {
  return match ($input) {
    default => "none",
    self::forward => "forward",
    self::down => "down",
    self::up => "up",
    self::backward => "backward",
  };
}

}
$task = new aoc_2b();

exit($task->mainLoop());