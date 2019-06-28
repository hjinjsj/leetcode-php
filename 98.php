<?php
//给定一个二叉树，判断其是否是一个有效的二叉搜索树。
//
//假设一个二叉搜索树具有如下特征：
//
//节点的左子树只包含小于当前节点的数。
//节点的右子树只包含大于当前节点的数。
//所有左子树和右子树自身必须也是二叉搜索树。
//示例 1:
//
//输入:
//    2
//    / \
//    1   3
//输出: true
//示例 2:
//
//输入:
//    5
//    / \
//    1   4
//     / \
//    3   6
//输出: false
//解释: 输入为: [5,1,4,null,null,3,6]。
//     根节点的值为 5 ，但是其右子节点值为 4 。
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/validate-binary-search-tree
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class Solution {
    public $arr;
    public $nums;
    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isValidBST($root) {
        if (!$root) {
            return true;
        }
        $this->arr = [];
        $this->nums = 0;
        $this->bst($root, 0);
        $pre = $this->arr[0];
        for ($i = 1; $i < $this->nums; $i++) {
            if ($this->arr[$i] <= $pre) {
                return false;
            }
            $pre = $this->arr[$i];
        }
        return true;
    }

    //中序遍历
    function bst($tree, $pos) {
        if ($tree) {
            $this->bst($tree->left, $pos * 2 + 1);
            $this->arr[$this->nums++] = $tree->val;
            $this->bst($tree->right, $pos * 2 + 2);
        }
    }
}