<?php

//给定 n 个非负整数，用来表示柱状图中各个柱子的高度。每个柱子彼此相邻，且宽度为 1 。
//
//求在该柱状图中，能够勾勒出来的矩形的最大面积。
//
// 
//
//
//
//以上是柱状图的示例，其中每个柱子的宽度为 1，给定的高度为 [2,1,5,6,2,3]。
//
// 
//
//
//
//图中阴影部分为所能勾勒出的最大矩形面积，其面积为 10 个单位。
//
// 
//
//示例:
//
//输入: [2,1,5,6,2,3]
//输出: 10
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/largest-rectangle-in-histogram
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param Integer[] $heights
     * @return Integer
     */

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


    // 分支方法，极端情况下会很慢
    function largestRectangleArea2($heights) {
        if (empty($heights)) {
            return 0;
        }
        $cnt = count($heights);
        $l = 0;
        $r = $cnt - 1;
        $result = $this->getMaxArea($heights, $l, $r);
        return $result['area'];
    }

    function getMaxArea($heights, $l, $r)
    {
        if ($l == $r) {
            return $this->compute($heights, $l, $r);
        }
        $result = $this->compute($heights, $l, $r);
        if ($l < $result['pos']) {
            $left = $this->getMaxArea($heights, $l, $result['pos'] - 1);
            if ($result['area'] < $left['area']) {
                $result = $left;
            }
        }
        if ($r > $result['pos']) {
            $right = $this->getMaxArea($heights, $result['pos'] + 1, $r);
            if ($result['area'] < $right['area']) {
                $result = $right;
            }
        }

        return $result;
    }

    function compute($heights, $l, $r) {
        $min = $this->findMin($heights, $l, $r);
        $area = $min['val'] * ($r - $l + 1);
        return ['area' => $area, 'pos' => $min['pos']];
    }

    function findMin($heights, $l, $r) {
        $arr = [];
        for ($i = $l; $i <= $r; $i++) {
            $arr[] = [
                'val' => $heights[$i],
                'pos' => $i
            ];
        }
        $cnt = count($arr);
        $mid = intval($cnt/2) - 1;
        for ($i = $mid; $i >= 0; $i--) {
            $this->adjust($arr, $i, $cnt);
        }
        return $arr[0];
    }

    function adjust(&$arr, $mid, $cnt) {
        if ($mid >= $cnt) {
            return;
        }
        $left = $mid * 2 + 1;
        $right = $mid * 2 + 2;
        if ($right < $cnt && $arr[$right]['val'] < $arr[$mid]['val']) {
            $temp = $arr[$mid];
            $arr[$mid] = $arr[$right];
            $arr[$right] = $temp;
            $this->adjust($arr, $right, $cnt);
        }
        if ($left < $cnt && $arr[$left]['val'] < $arr[$mid]['val']) {
            $temp = $arr[$mid];
            $arr[$mid] = $arr[$left];
            $arr[$left] = $temp;
            $this->adjust($arr, $left, $cnt);
        }
    }
}
