<?php
//编写一个函数来查找字符串数组中的最长公共前缀。
//
//如果不存在公共前缀，返回空字符串 ""。
//
//示例 1:
//
//输入: ["flower","flow","flight"]
//输出: "fl"
//示例 2:
//
//输入: ["dog","racecar","car"]
//输出: ""
//解释: 输入不存在公共前缀。
//说明:
//
//所有输入只包含小写字母 a-z 。
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/longest-common-prefix
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param String[] $strs
     * @return String
     */
    function longestCommonPrefix($strs) {
        if (empty($strs)) {
            return '';
        }
        $result = [$strs[0]];
        for ($i = 1; $i < count($strs); $i++) {
            if ($result[$i - 1] == '') {
                return '';
            }
            $cnt = strlen($result[$i - 1]);
            $cnt2 = strlen($strs[$i]);
            $min = min($cnt, $cnt2);
            $res = '';
            for ($j = 0; $j < $min; $j++) {
                if ($strs[$i][$j] == $result[$i-1][$j]) {
                    $res .= $strs[$i][$j];
                } else {
                    break;
                }
            }
            $result[] = $res;
        }
        return $result[count($result) - 1];
    }
}
