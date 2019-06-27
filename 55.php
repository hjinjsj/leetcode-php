<?php
//给定一个非负整数数组，你最初位于数组的第一个位置。
//
//数组中的每个元素代表你在该位置可以跳跃的最大长度。
//
//判断你是否能够到达最后一个位置。
//
//示例 1:
//
//输入: [2,3,1,1,4]
//输出: true
//解释: 从位置 0 到 1 跳 1 步, 然后跳 3 步到达最后一个位置。
//示例 2:
//
//输入: [3,2,1,0,4]
//输出: false
//解释: 无论怎样，你总会到达索引为 3 的位置。但该位置的最大跳跃长度是 0 ， 所以你永远不可能到达最后一个位置。
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/jump-game
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function canJump($nums) {
        $cnt = count($nums);
        $i = 0;
        while ($i < $cnt ) {
            $maxStep = $i + $nums[$i];
            $max = $i;
            for ($j = $i + 1; $j <= $i + $nums[$i]; $j ++) {
                if ($j + $nums[$j] >= $maxStep) {
                    $maxStep = $j + $nums[$j];
                    $max = $j;
                }
            }

            if ($maxStep >= $cnt -1) {
                return true;
            }
            if ($i == $max) {
                return false;
            }
            $i = $max;
        }
        return false;
    }
}

var_dump((new Solution())->canJump([1,0]));