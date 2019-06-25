<?php
//罗马数字包含以下七种字符: I， V， X， L，C，D 和 M。
//
//字符          数值
//I             1
//V             5
//X             10
//L             50
//C             100
//D             500
//M             1000
//例如， 罗马数字 2 写做 II ，即为两个并列的 1。12 写做 XII ，即为 X + II 。 27 写做  XXVII, 即为 XX + V + II 。
//
//通常情况下，罗马数字中小的数字在大的数字的右边。但也存在特例，例如 4 不写做 IIII，而是 IV。数字 1 在数字 5 的左边，所表示的数等于大数 5 减小数 1 得到的数值 4 。同样地，数字 9 表示为 IX。这个特殊的规则只适用于以下六种情况：
//
//I 可以放在 V (5) 和 X (10) 的左边，来表示 4 和 9。
//X 可以放在 L (50) 和 C (100) 的左边，来表示 40 和 90。 
//C 可以放在 D (500) 和 M (1000) 的左边，来表示 400 和 900。
//给定一个罗马数字，将其转换成整数。输入确保在 1 到 3999 的范围内。
//
//示例 1:
//
//输入: "III"
//输出: 3
//示例 2:
//
//输入: "IV"
//输出: 4
//示例 3:
//
//输入: "IX"
//输出: 9
//示例 4:
//
//输入: "LVIII"
//输出: 58
//解释: L = 50, V= 5, III = 3.
//示例 5:
//
//输入: "MCMXCIV"
//输出: 1994
//解释: M = 1000, CM = 900, XC = 90, IV = 4.
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/roman-to-integer
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function romanToInt($s) {
        $levels = [
            ['I', 'V', 'X'],
            ['X', 'L', 'C'],
            ['C', 'D', 'M'],
            ['M', 'Y', 'Z']
        ];

        $val = [1, 10, 100, 1000];
        $i = 0;
        $res = 0;
        while ($s) {
            $temp = $s;
            if (($s = $this->endWith($temp, $levels[$i][1].$levels[$i][0].$levels[$i][0].$levels[$i][0])) !== false) {
                $res += 8 * $val[$i];
            } elseif (($s = $this->endWith($temp, $levels[$i][1].$levels[$i][0].$levels[$i][0])) !== false) {
                $res += 7 * $val[$i];
            } elseif (($s = $this->endWith($temp, $levels[$i][0].$levels[$i][0].$levels[$i][0])) !== false) {
                $res += 3 * $val[$i];
            } elseif (($s = $this->endWith($temp, $levels[$i][0].$levels[$i][2])) !== false) {
                $res += 9 * $val[$i];
            } elseif (($s = $this->endWith($temp, $levels[$i][1].$levels[$i][0])) !== false) {
                $res += 6 * $val[$i];
            } elseif (($s = $this->endWith($temp, $levels[$i][0].$levels[$i][1])) !== false) {
                $res += 4 * $val[$i];
            } elseif (($s = $this->endWith($temp, $levels[$i][0].$levels[$i][0])) !== false) {
                $res += 2 * $val[$i];
            } elseif (($s = $this->endWith($temp, $levels[$i][1])) !== false) {
                $res += 5 * $val[$i];
            } elseif (($s = $this->endWith($temp, $levels[$i][0])) !== false) {
                $res += 1 * $val[$i];
            } else {
                $s = $temp;// 没匹配上字符串不变
            }
            $i++;
        }
        return $res;
    }

    function endWith($s, $substr)
    {
        if ($substr == '') {
            return false;
        }
        $len = strlen($s);
        $len2 = strlen($substr);
        if ($len < $len2) {
            return false;
        }
        $res = substr($s, $len - $len2, $len);
        if ($res == $substr) {
            return substr($s, 0, $len - $len2);
        }
        return false;
    }
}
