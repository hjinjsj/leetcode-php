<?php
//
//给定一个字符串 s，找到 s 中最长的回文子串。你可以假设 s 的最大长度为 1000。
//
//示例 1：
//
//输入: "babad"
//输出: "bab"
//注意: "aba" 也是一个有效答案。
//示例 2：
//
//输入: "cbbd"
//输出: "bb"
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/longest-palindromic-substring
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param String $s
     * @return String
     */
    function longestPalindrome($s) {
        $cnt = strlen($s);
        if ($cnt == 0) {
            return '';
        }
        $result = [];

        $maxBegin = 0;
        $maxLen = 1;
        for ($step = 0; $step < $cnt; $step ++) {
            for ($i = 0; $i < $cnt - $step; $i++) {
                $j = $i + $step;
                if ($step == 0) {
                    $result[$i][$j] = true;
                } elseif ($s[$i] == $s[$j]
                    && ($step == 1 || isset($result[$i+1][$j-1]))) {
                    $result[$i][$j] = true;
                    if ($step + 1 > $maxLen) {
                        $maxBegin = $i;
                        $maxLen = $step + 1;
                    }
                }
            }
        }

        return substr($s, $maxBegin, $maxLen);
    }
}
