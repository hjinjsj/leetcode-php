<?php
//给定一个只包含 '(' 和 ')' 的字符串，找出最长的包含有效括号的子串的长度。
//
//示例 1:
//
//输入: "(()"
//输出: 2
//解释: 最长有效括号子串为 "()"
//示例 2:
//
//输入: ")()())"
//输出: 4
//解释: 最长有效括号子串为 "()()"
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/longest-valid-parentheses
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function longestValidParentheses($s) {
        $arr = [];
        array_push($arr, [ 'v' => '-1', 'p' => -1]);

        $max = 0;
        $left = 0;
        $right = 0;

        $res = [];
        while($left < strlen($s) && $right < strlen($s) && $left <= $right) {
            $c = $s[$right];
            $top = count($arr) - 1;
            if ($s[$right] == '(') {
                array_push($arr, ['v' => $c, 'p' => $right]);
                $right++;
            } elseif ($s[$right] == ')') {
                if ($arr[$top]['v'] == '(') {
                    $res[$arr[$top]['p']] = 1;
                    $res[$right] = 1;
                    array_pop($arr);
                    $right++;
                } else {
                    $right++;
                    $left = $right;
                }
            }
        }

        $sum = [];
        $max = 0;
        for ($i = 0; $i < strlen($s); $i++) {
            if (isset($res[$i])) {
                if ($i == 0) {
                    $sum[$i] = $res[$i];
                } else {
                    $sum[$i] = $sum[$i - 1] + $res[$i];
                }
            } else {
                $sum[$i] = 0;
            }

            $max = max($sum[$i], $max);
        }
        return $max;
    }
}
