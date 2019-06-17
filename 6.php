<?php
//将一个给定字符串根据给定的行数，以从上往下、从左到右进行 Z 字形排列。
//
//比如输入字符串为 "LEETCODEISHIRING" 行数为 3 时，排列如下：
//
//L   C   I   R
//E T O E S I I G
//E   D   H   N
//之后，你的输出需要从左往右逐行读取，产生出一个新的字符串，比如："LCIRETOESIIGEDHN"。
//
//请你实现这个将字符串进行指定行数变换的函数：
//
//string convert(string s, int numRows);
//示例 1:
//
//输入: s = "LEETCODEISHIRING", numRows = 3
//输出: "LCIRETOESIIGEDHN"
//示例 2:
//
//输入: s = "LEETCODEISHIRING", numRows = 4
//输出: "LDREOEIIECIHNTSG"
//解释:
//
//L     D     R
//E   O E   I I
//E C   I H   N
//T     S     G
//
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/zigzag-conversion
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param String $s
     * @param Integer $numRows
     * @return String
     */
    function convert($s, $numRows) {
        if ($numRows == 1) {
            return $s;
        }
        $len = strlen($s);
        $zLen = $numRows * 2 - 2;
        $zW = $numRows - 1;

        $mapX = [];
        $mapY = [];
        for ($i = 0; $i < $zLen; $i ++) {
            if ($i < $numRows) {
                $mapX[$i] = $i;
                $mapY[$i] = 0;
            } else {
                $mapX[$i] = $zLen - $i;
                $mapY[$i] = $i - $numRows + 1;
            }
        }

        $height = $numRows;
        $width = (intval($len / $zLen) + 1) * $zW;

        $result = [];
        for ($i=0; $i < $len; $i++) {
            $num = intval($i / $zLen);
            $mod = $i % $zLen;
            $result[$mapX[$mod]][$mapY[$mod] + $zW * $num] = $s[$i];
        }

        $str = '';
        for ($i = 0; $i < $height; $i ++) {
            for ($j = 0; $j < $width; $j ++) {
                if (isset($result[$i][$j])) {
                    $str .= $result[$i][$j];
                }
            }
        }

        return $str;
    }
}
