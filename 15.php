<?php
//给定一个包含 n 个整数的数组 nums，判断 nums 中是否存在三个元素 a，b，c ，使得 a + b + c = 0 ？找出所有满足条件且不重复的三元组。
//
//注意：答案中不可以包含重复的三元组。
//
//例如, 给定数组 nums = [-1, 0, 1, 2, -1, -4]，
//
//满足要求的三元组集合为：
//[
//[-1, 0, 1],
//  [-1, -1, 2]
//]
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/3sum
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function threeSum($nums) {
        // 排好序之后打印就不会重复数据了
        sort($nums);
        $cnt = count($nums);
        $res = [];
        if ($nums[0] <= 0 && $nums[$cnt - 1] >= 0) {
            $i = 0;
            while($i < $cnt - 2) {
                if ($nums[$i] > 0) {
                    break;
                }
                $first = $i + 1;
                $last = $cnt - 1;
                do {
                    if ($first >= $last || $nums[$i] * $nums[$last] > 0) {
                        break;
                    }
                    $result = $nums[$i] + $nums[$first] + $nums[$last];
                    if ($result == 0) {
                        $res[] = [$nums[$i], $nums[$first], $nums[$last]];
                    }
                    if ($result <= 0 ) {
                        // 重复的不要
                        //$nums[$first] == $nums[++$first] 不相等first也会后移一位
                        while ($first < $last && $nums[$first] == $nums[++$first]) {
                        }
                    } else {
                        //$nums[$last] == $nums[--$last] 不相等last也会前移一位
                        while ($first < $last && $nums[$last] == $nums[--$last]) {
                        }
                    }
                } while ($first < $last);
                while ($i < $cnt - 2 && $nums[$i] == $nums[++$i]) {
                }
            }
        }
        return $res;
    }
}
