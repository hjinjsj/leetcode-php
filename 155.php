<?php

class MinStack {

    public $stack;
    public $count;
    public $sortStack;
    public $pos;

    /**
     * initialize your data structure here.
     */
    function __construct() {
        $this->stack = [];
        $this->pos = [];
        $this->sortStack = [];
        $this->count = 0;
    }

    /**
     * @param Integer $x
     * @return NULL
     */
    function push($x) {
        $pos = $this->sort($x);
        $this->stack[$this->count ++] = [ 'val' => $x, 'pos' => $pos];
    }

    /**
     * @return NULL
     */
    function pop() {
        if ($this->count == 0) {
            return null;
        }
        $value = $this->stack[$this->count - 1];
        unset($this->stack[$this->count - 1]);
        $pos = $value['pos'];
        for ($i = $pos; $i < $this->count - 1; $i ++ ){
            $this->sortStack[$i] = $this->sortStack[$i + 1];
        }
        unset($this->sortStack[$this->count - 1]);

        $this->count--;
        return $value['val'];
    }

    /**
     * @return Integer
     */
    function top() {
        return $this->count == 0 ? null : $this->stack[$this->count - 1]['val'];
    }

    /**
     * @return Integer
     */
    function getMin() {
        return $this->count == 0 ? null : $this->sortStack[$this->count - 1];
    }

    function sort($x) {
        if (empty($this->sortStack)) {
            $this->sortStack[0] = $x;
            return 0;
        }

        $pos = $this->find($x, 0, count($this->sortStack) - 1);
        for ($i = count($this->sortStack) - 1; $i >= $pos ; $i--) {
            $this->sortStack[$i + 1] = $this->sortStack[$i];
        }
        $this->sortStack[$pos] = $x;
        return $pos;
    }

    function find($value, $left, $right) {
        if ($left >= $right) {
            if ($value > $this->sortStack[$left]) {
                return $left;
            } else {
                return $left + 1;
            }
        }
        $mid = intval(($left + $right)/2);
        if ($value > $this->sortStack[$mid]) {
            return $this->find($value, $left, $mid - 1);
        } else {
            return $this->find($value, $mid + 1, $right);
        }
    }
}

/**
 * Your MinStack object will be instantiated and called as such:
 * $obj = MinStack();
 * $obj->push($x);
 * $obj->pop();
 * $ret_3 = $obj->top();
 * $ret_4 = $obj->getMin();
 */
