<?php

//给你一个字符串 s 和一个字符规律 p，请你来实现一个支持 '.' 和 '*' 的正则表达式匹配。
//
//'.' 匹配任意单个字符
//'*' 匹配零个或多个前面的那一个元素
//所谓匹配，是要涵盖 整个 字符串 s的，而不是部分字符串。
//
//说明:
//
//s 可能为空，且只包含从 a-z 的小写字母。
//p 可能为空，且只包含从 a-z 的小写字母，以及字符 . 和 *。
//示例 1:
//
//输入:
//s = "aa"
//p = "a"
//输出: false
//解释: "a" 无法匹配 "aa" 整个字符串。
//示例 2:
//
//输入:
//s = "aa"
//p = "a*"
//输出: true
//解释: 因为 '*' 代表可以匹配零个或多个前面的那一个元素, 在这里前面的元素就是 'a'。因此，字符串 "aa" 可被视为 'a' 重复了一次。
//示例 3:
//
//输入:
//s = "ab"
//p = ".*"
//输出: true
//解释: ".*" 表示可匹配零个或多个（'*'）任意字符（'.'）。
//示例 4:
//
//输入:
//s = "aab"
//p = "c*a*b"
//输出: true
//解释: 因为 '*' 表示零个或多个，这里 'c' 为 0 个, 'a' 被重复一次。因此可以匹配字符串 "aab"。
//示例 5:
//
//输入:
//s = "mississippi"
//p = "mis*is*p*."
//输出: false
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/regular-expression-matching
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    public $rArr;
    /**
     * @param String $s
     * @param String $p
     * @return Boolean
     */
    function isMatch($s, $p) {
        $pArr = $this->getPArr($p);
        $cnt = count($pArr);
        $sLen = strlen($s);
        return $this->match($s, 0, $sLen, $pArr, 0, $cnt);
    }

    function match($s, $sStart, $sLen, $pArr, $pStart, $cnt) {
        if (isset($this->rArr[$sStart][$pStart])) {
            return $this->rArr[$sStart][$pStart];
        }
        if ($sStart < $sLen && $pStart >= $cnt) {
            $result = false;
        } elseif ($sStart >= $sLen && $pStart >= $cnt) {
            $result = true;
        } elseif ($sStart >= $sLen && $pStart < $cnt) {
            if (strlen($pArr[$pStart]) == 2) {
                $result = $this->match($s, $sStart, $sLen, $pArr, $pStart + 1, $cnt);
            } else {
                $result = false;
            }
        } else {
            // 都不为空
            $subLen = strlen($pArr[$pStart]);
            $pStr = $pArr[$pStart][0];
            $firstChar = $s[$sStart];
            if ($subLen == 1) {
                if ($pStr == '.' || $firstChar == $pStr) {
                    $result = $this->match($s, $sStart + 1, $sLen, $pArr, $pStart + 1, $cnt);
                } else {
                    $result = false;
                }
            } else {
                if ($pStr == '.' || $firstChar == $pStr) {
                    $result = (
                        // 字符前进一步
                        $this->match($s, $sStart + 1, $sLen, $pArr, $pStart, $cnt)
                        // 字符和表达式都前进一步
                        || $this->match($s, $sStart + 1, $sLen, $pArr, $pStart + 1, $cnt)
                        // 正则表达式前进一步
                        || $this->match($s, $sStart, $sLen, $pArr, $pStart + 1, $cnt)
                    );
                } else {
                    $result = $this->match($s, $sStart, $sLen, $pArr, $pStart + 1, $cnt);
                }
            }
        }
        $this->rArr[$sStart][$pStart] = $result;
        return $result;
    }

    function getPArr($p) {
        // 拆解$p
        $pArr = [];
        $cnt = strlen($p);
        $i = 0;
        while($i < $cnt) {
            $next = $i + 1;
            if ($next >= $cnt || $p[$next] != '*') {
                $pArr[] = $p[$i];
                $i++;
            } else {
                $pArr[] = $p[$i] . $p[$next];
                $i += 2;
            }
        }

        return $pArr;
    }
}