<?php

//给定一个仅包含 0 和 1 的二维二进制矩阵，找出只包含 1 的最大矩形，并返回其面积。
//
//示例:
//
//输入:
//[
//    ["1","0","1","0","0"],
//    ["1","0","1","1","1"],
//    ["1","1","1","1","1"],
//    ["1","0","0","1","0"]
//]
//输出: 6
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/maximal-rectangle
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param String[][] $matrix
     * @return Integer
     */
    function maximalRectangle($matrix) {
        $maxWidth = [];
        foreach ($matrix as $i => $row) {
            foreach ($row as $j => $value) {
                if ($value == 1) {
                    $maxWidth[$i][$j] = ($j == 0 ? 1 : $maxWidth[$i][$j-1] + 1);
                } else {
                    $maxWidth[$i][$j] = 0;
                }
            }
        }

        $rNum = count($maxWidth);
        $cNum = count($maxWidth[0]);
        $maxarea = 0;
        for ($j = 0; $j < $cNum; $j++) {
            $heights = [];
            for ($i = 0; $i < $rNum; $i++) {
                $heights[] = $maxWidth[$i][$j];
            }
            $maxarea = max($maxarea, $this->largestRectangleArea($heights));
        }

        return $maxarea;
    }

    // 转换为求最大矩形，第84题
    function largestRectangleArea($heights) {
        $cnt = count($heights);
        $stack = [];
        array_push($stack, -1);
        $maxarea = 0;
        for ($i = 0; $i < $cnt; ++$i) {
            while ($stack[count($stack) - 1] != -1 && $heights[$stack[count($stack) - 1]] >= $heights[$i]) {
                $maxarea = max($maxarea, $heights[array_pop($stack)] * ($i - $stack[count($stack) - 1] - 1));
            }
            array_push($stack, $i);
        }
        while ($stack[count($stack) - 1] != -1) {
            $maxarea = max($maxarea, $heights[array_pop($stack)] * ($cnt - $stack[count($stack) - 1] - 1));
        }
        return $maxarea;
    }
}

var_dump((new Solution())->maximalRectangle([
    ["1","0","1","0","0"],
    ["1","0","1","1","1"],
    ["1","1","1","1","1"],
    ["1","0","0","1","0"]
]));