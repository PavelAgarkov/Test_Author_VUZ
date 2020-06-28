<?php

namespace SRC;

use SplDoublyLinkedList;

class ArrayPrinter
{
    private array $Array;

    private array $levelList;

    public function __construct(array $array)
    {
        $this->Array = $array;
    }

    public function recursionRound(): object
    {
        $levelList = [];
        $list = $this->get();
        $level = -1;
        $counter = '';

        $recursion = function (array $list) use (&$recursion, &$levelList, &$level, &$counter): void {
            $level++;

            foreach ($list as $key => $value) {

                if ($level == 0) {
                    $counter = $key;
                    $levelList[$counter] = new SplDoublyLinkedList();
                }

                if (is_array($value)) {
                    $recursion($value);
                }

                $levelList[$counter]->unshift($value);
            }

            $level--;
        };

        $recursion($list);

        $this->levelList = $levelList;
        return $this;
    }

    public function get(): array
    {
        return $this->Array;
    }

    public function render(): string
    {
        $string = '';
        $level = 1;

        foreach ($this->levelList as $key => $list) {
            $list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);

            $prev = null;
            $repeat = 0;
            $takeList = [];
            $levelLeaves = [];

            for ($list->rewind(); $list->valid(); $list->next()) {

                if (!is_array($list->current()) && is_array($prev) && !static::validate($takeList)) {

                    krsort($levelLeaves);
                    foreach ($levelLeaves as $lvlKey => $lvlValue) {

                        if (!empty($lvlValue)) {
                            foreach ($lvlValue as $k => $v) {
                                $string .= str_repeat(' ', $lvlKey * 2) . $v . PHP_EOL;
                            }
                        }
                    }

                    $level = 1;
                    continue;
                } else {

                    if ($level == 1 && is_array($list->current())) {
                        $string .= $key . PHP_EOL;
                    }

                    if (is_array($list->current())) {

                        $repeat = $repeat + 2;
                        $takeList = $list->current();
                        $levelLeaves[$level] = [];

                        foreach ($takeList as $keyTake => $valueTake) {
                            if (is_array($valueTake)) {
                                $string .= str_repeat(' ', $repeat) . $keyTake . PHP_EOL;
                            } else {
                                $levelLeaves[$level][] = $valueTake;
                            }
                        }

                        $level++;

                    } else if (empty($takeList)) {
                        $string .= $list->current() . PHP_EOL;
                    }

                }
                $prev = $list->current();
            }
        }

        return $string;
    }

    private static function validate(array $takeList): bool
    {
        if (is_array($takeList)) {
            foreach ($takeList as $key => $item) {
                if (is_array($item)) {
                    return true;
                }
            }
        }
        return false;
    }

}