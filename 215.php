<?php
//在未排序的数组中找到第 k 个最大的元素。请注意，你需要找的是数组排序后的第 k 个最大的元素，而不是第 k 个不同的元素。
//
//示例 1:
//
//输入: [3,2,1,5,6,4] 和 k = 2
//输出: 5
//示例 2:
//
//输入: [3,2,3,1,2,4,5,5,6] 和 k = 4
//输出: 4
//说明:
//
//你可以假设 k 总是有效的，且 1 ≤ k ≤ 数组的长度。
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/kth-largest-element-in-an-array
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest($nums, $k) {
        $cnt = count($nums);
        $i = 0;
        // $k <= $cnt
        if ($k < $cnt/2) {
            while ($i < $k) {
                $this->findMax($nums, $cnt - $i);
                $temp = $nums[$cnt - $i - 1];
                $nums[$cnt - $i - 1] = $nums[0];
                $nums[0] = $temp;
                $i++;
            }
        } else {
            $k = $cnt + 1 - $k;
            while ($i < $k) {
                $this->findMin($nums, $cnt - $i);
                $temp = $nums[$cnt - $i - 1];
                $nums[$cnt - $i - 1] = $nums[0];
                $nums[0] = $temp;
                $i++;
            }
        }
        return $nums[$cnt - $k];
    }

    function findMax(&$nums, $cnt) {
        if ($cnt == 1) {
            return;
        }
        $mid = intval($cnt/2) - 1;
        while ($mid >= 0) {
            $this->adjustMax($nums, $mid, $cnt);
            $mid --;
        }
    }

    /**
     * 递归调整，直到最后
     * @param $nums
     * @param $mid
     * @param $cnt
     */
    function adjustMax(&$nums, $mid, $cnt)
    {
        $left = $mid * 2 + 1;
        $right = $mid * 2 + 2;
        if ($right < $cnt && $nums[$mid] < $nums[$right]) {
            $temp = $nums[$mid];
            $nums[$mid] = $nums[$right];
            $nums[$right] = $temp;
            $this->adjustMax($nums, $right, $cnt);
        }
        if ($left < $cnt && $nums[$mid] < $nums[$left]) {
            $temp = $nums[$mid];
            $nums[$mid] = $nums[$left];
            $nums[$left] = $temp;
            $this->adjustMax($nums, $left, $cnt);
        }
    }

    function findMin(&$nums, $cnt) {
        if ($cnt == 1) {
            return;
        }
        $mid = intval($cnt/2) - 1;
        while ($mid >= 0) {
            $this->adjustMin($nums, $mid, $cnt);
            $mid --;
        }
    }

    /**
     * 递归调整，直到最后
     * @param $nums
     * @param $mid
     * @param $cnt
     */
    function adjustMin(&$nums, $mid, $cnt)
    {
        $left = $mid * 2 + 1;
        $right = $mid * 2 + 2;
        if ($right < $cnt && $nums[$mid] > $nums[$right]) {
            $temp = $nums[$mid];
            $nums[$mid] = $nums[$right];
            $nums[$right] = $temp;
            $this->adjustMin($nums, $right, $cnt);
        }
        if ($left < $cnt && $nums[$mid] > $nums[$left]) {
            $temp = $nums[$mid];
            $nums[$mid] = $nums[$left];
            $nums[$left] = $temp;
            $this->adjustMin($nums, $left, $cnt);
        }
    }
}