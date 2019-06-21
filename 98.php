<?php

//给定一个整数 n，求以 1 ... n 为节点组成的二叉搜索树有多少种？
//
//示例:
//
//输入: 3
//输出: 5
//解释:
//给定 n = 3, 一共有 5 种不同结构的二叉搜索树:
//
//   1         3     3      2      1
//    \       /     /      / \      \
//     3     2     1      1   3      2
//    /     /       \                 \
//   2     1         2                 3
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/unique-binary-search-trees
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

/**
 * 一定要明确含义，意思是找到中序遍历必须是1->2->3...->n
 * Class Solution
 */
class Solution {

    /**
     * @param Integer $n
     * @return Integer
     */
    function numTrees($n) {
        $dp = [];
        $dp[0] = 1;
        $dp[1] = 1;

        for($i = 2; $i < $n + 1; $i++)
            for($j = 1; $j < $i + 1; $j++)
                $dp[$i] += $dp[$j-1] * $dp[$i-$j];

        return $dp[$n];
    }
}