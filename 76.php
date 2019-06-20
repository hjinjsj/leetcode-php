<?php
//给你一个字符串 S、一个字符串 T，请在字符串 S 里面找出：包含 T 所有字母的最小子串。
//
//示例：
//
//输入: S = "ADOBECODEBANC", T = "ABC"
//输出: "BANC"
//说明：
//
//如果 S 中不存这样的子串，则返回空字符串 ""。
//如果 S 中存在这样的子串，我们保证它是唯一的答案。
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/minimum-window-substring
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * 1.初始，left指针和right指针都指向S的第一个元素.
     *
     * 2.将 right 指针右移，扩张窗口，直到得到一个可行窗口，亦即包含T的全部字母的窗口。
     *
     * 3.得到可行的窗口后，将 left 指针逐个右移，若得到的窗口依然可行，则更新最小窗口大小。
     *
     * 4.若窗口不再可行，则跳转至 2。
     *
     * @param String $s
     * @param String $t
     * @return String
     */
    function minWindow($s, $t) {
        $tempCountMap = [];
        $countMap = [];

        for($i = 0; $i < strlen($t); $i++) {
            if (empty($countMap[$t[$i]])) {
                $countMap[$t[$i]] = 1;
            } else {
                $countMap[$t[$i]] ++;
            }
            $tempCountMap[$t[$i]] = 0;
        }

        $sLen = strlen($s);
        $left = 0;
        $right = 0;
        $rLeft = 0;
        $minNum = $sLen;
        $isExist = false;
        $isUsed = [];
        while ($left <= $sLen - count($countMap) && $right < $sLen) {
            // 找到第一个满足的right
            while ($this->isNormal($tempCountMap, $countMap) == false && $right < $sLen) {
                if (isset($countMap[$s[$right]]) && !isset($isUsed[$right])) {
                    $tempCountMap[$s[$right]] ++;
                    $isUsed[$right] = 1;
                }
                if ($this->isNormal($tempCountMap, $countMap) == false) {
                    $right++;
                } else {
                    break;
                }
            }

            if ($this->isNormal($tempCountMap, $countMap)) {
                //var_dump(substr($s, $left, $right -  $left +1));
                $isExist = true;
                if ($right - $left + 1 < $minNum) {
                    $minNum = $right - $left + 1;
                    $rLeft = $left;
                }
                // 收缩
                if (isset($tempCountMap[$s[$left]])) {
                    $tempCountMap[$s[$left]] --;
                }
                $left++;
            }
        }

        if ($isExist) {
            return substr($s, $rLeft, $minNum);
        } else {
            return '';
        }
    }

    public function isNormal($tempCountMap, $countMap) {
        $isNormal = true;
        foreach ($tempCountMap as $char => $num) {
            if ($num < $countMap[$char]) {
                $isNormal = false;
                break;
            }
        }
        return $isNormal;
    }
}

var_dump((new Solution())->minWindow("ABA", "AA"));