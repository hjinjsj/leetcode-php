<?php
//编写一个程序，通过已填充的空格来解决数独问题。
//
//一个数独的解法需遵循如下规则：
//
//数字 1-9 在每一行只能出现一次。
//数字 1-9 在每一列只能出现一次。
//数字 1-9 在每一个以粗实线分隔的 3x3 宫内只能出现一次。
//空白格用 '.' 表示。
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/sudoku-solver
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    public $result = null;
    /**
     * @param String[][] $board
     * @return NULL
     */
    function solveSudoku(&$board) {
        $rows = [];
        $cols = [];
        $buckets = [];// 0, 1, 2, 3, 4, 5, 6, 7, 8

        for ($i = 0; $i < 9; $i++) {
            for ($j = 1; $j < 10; $j ++) {
                $rows[$i][$j] = 0;
                $cols[$i][$j] = 0;
                $buckets[$i][$j] = 0;
            }
        }

        foreach ($board as $i => $row) {
            foreach ($row as $j => $val) {
                if ($val != '.') {
                    $rows[$i][$val] = 1;
                    $cols[$j][$val] = 1;
                    $bucket = ((int)($i / 3)) * 3 + ((int)($j / 3)) ;
                    $buckets[$bucket][$val] = 1;
                }
            }
        }
        $this->compute($board, 0, 0, $rows, $cols, $buckets);
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 9; $j ++) {
                $this->result[$i][$j] = strval($this->result[$i][$j]);
            }
        }
        $board = $this->result;
    }

    function compute($board, $i, $j, $rows, $cols, $buckets) {
        if ($this->result != null) {
            return;
        }
        if ($i >= 9) {
            $this->result = $board;
            return;
        }

        if ($board[$i][$j] == '.') {
            foreach ($rows[$i] as $val => $isHas) {
                if ($isHas == 0) {
                    $bucket = ((int)($i / 3)) * 3 + ((int)($j / 3)) ;
                    if ($cols[$j][$val] == 0
                        && $buckets[$bucket][$val] == 0) {
                        $board[$i][$j] = $val;
                        $rows[$i][$val] = 1;
                        $cols[$j][$val] = 1;
                        $buckets[$bucket][$val] = 1;
                        if ($j == 8) {
                            $this->compute($board, $i+1, 0, $rows, $cols, $buckets);
                        } else {
                            $this->compute($board, $i, $j+1, $rows, $cols, $buckets);
                        }
                        $board[$i][$j] = '.';
                        $rows[$i][$val] = 0;
                        $cols[$j][$val] = 0;
                        $buckets[$bucket][$val] = 0;
                    }
                }
            }
        } else {
            if ($j == 8) {
                $this->compute($board, $i+1, 0, $rows, $cols, $buckets);
            } else {
                $this->compute($board, $i, $j+1, $rows, $cols, $buckets);
            }
        }
    }
}

$board = [
    ['5', '3', '.', '.', '7', '.', '.', '.', '.'],
    ['6', '.', '.', '1', '9', '5', '.', '.', '.'],
    ['.', '9', '8', '.', '.', '.', '.', '6', '.'],
    ['8', '.', '.', '.', '6', '.', '.', '.', '3'],
    ['4', '.', '.', '8', '.', '3', '.', '.', '1'],
    ['7', '.', '.', '.', '2', '.', '.', '.', '6'],
    ['.', '6', '.', '.', '.', '.', '2', '8', '.'],
    ['.', '.', '.', '4', '1', '9', '.', '.', '5'],
    ['.', '.', '.', '.', '8', '.', '.', '7', '9']
];
var_dump((new Solution())->solveSudoku($board));