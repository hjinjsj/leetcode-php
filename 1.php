<?php
#########################################################################
# File Name: 1.php
# Desc:
# Author: Huang Jin
# mail: huangj@xiaopeng.com
# Created Time: 一  6/17 09:53:36 2019
#########################################################################

/**
 *
 * 给定一个整数数组 nums 和一个目标值 target，请你在该数组中找出和为目标值的那 两个 整数，并返回他们的数组下标。
 *
 * 你可以假设每种输入只会对应一个答案。但是，你不能重复利用这个数组中同样的元素。
 *
 * 示例:
 *
 * 给定 nums = [2, 7, 11, 15], target = 9
 *
 * 因为 nums[0] + nums[1] = 2 + 7 = 9
 *
 * 所以返回 [0, 1]
 *
 * 来源：力扣（LeetCode）
 *
 * 链接：https://leetcode-cn.com/problems/two-sum
 *
 * 著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 *
 */
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $result = [];
        $cnt = count($nums);
        for ($i = 0; $i < $cnt - 1; $i++) {
            for ( $j = $i + 1; $j < $cnt; $j ++) {
                $value = $nums[$i] + $nums[$j];
                if ($value == $target && !isset($result[$i]) && !isset($result[$j])) {
                    $result[$i] = 1;
                    $result[$j] = 1;
                }
            }
        }
        return array_keys($result);
    }
}


