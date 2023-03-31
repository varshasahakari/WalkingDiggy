<?php
const MOVE_DIRECTION = [
    'EAST' => ['L' => 'NORTH', 'R' => 'SOUTH'],
    'NORTH' => ['L' => 'WEST', 'R' => 'EAST'],
    'WEST' => ['L' => 'SOUTH', 'R' => 'NORTH'],
    'SOUTH' => ['R' => 'WEST', 'L' => 'EAST'],
];
class Diggy
{
    private string $current_direction;
    private int $x;
    private int $y;

    public function __construct($x, $y, $current_direction)
    {
        $this->x = (int)$x;
        $this->y = (int)$y;
        $this->current_direction = strtoupper($current_direction);
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     * @return Diggy
     */
    public function setX($x)
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param mixed $y
     * @return Diggy
     */
    public function setY($y)
    {
        $this->y = $y;
        return $this;
    }

    public function runWalkString($walk_string)
    {
        for ($index = 0; $index < strlen($walk_string); $index++) {
            if ($walk_string[$index] == "R" || $walk_string[$index] == "L") {
                $this->turn($walk_string[$index]);
            }
            if ($walk_string[$index] == "W") {
                $this->walk($walk_string[++$index]);
            }
        }
    }

    public function turn(string $left_right)
    {
        $this->setCurrentDirection(MOVE_DIRECTION[$this->getCurrentDirection()][$left_right]);
    }

    /**
     * @return string
     */
    public function getCurrentDirection(): string
    {
        return $this->current_direction;
    }

    /**
     * @param string $current_direction
     * @return Diggy
     */
    public function setCurrentDirection(string $current_direction): Diggy
    {
        $this->current_direction = $current_direction;
        return $this;
    }

    public function walk($units)
    {
        switch ($this->current_direction) {
            case "EAST":
                $this->setX($this->x + $units);
                break;
            case "NORTH":
                $this->setY($this->y + $units);
                break;
            case "WEST":
                $this->setX($this->x - $units);
                break;
            case "SOUTH":
                $this->setY($this->y - $units);
                break;
        }
    }

    public function printOutput()
    {
        echo "Output : ";
        echo "$this->x $this->y $this->current_direction";
    }


}

$diggy = new Diggy($argv[1], $argv[2], $argv[3]);
$diggy->runWalkString($argv[4]);
$diggy->printOutput();
