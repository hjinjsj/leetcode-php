<?php
//给定一个二叉树，返回其按层次遍历的节点值。 （即逐层地，从左到右访问所有节点）。
//
//例如:
//给定二叉树: [3,9,20,null,null,15,7],
//
//    3
//    / \
//    9  20
//  /  \
//15   7
//返回其层次遍历结果：
//
//[
//  [3],
//  [9,20],
//  [15,7]
//]
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/binary-tree-level-order-traversal
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
    public $arr = [];
    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrder($root) {
        $this->bst($root, 0);
        return $this->arr;
    }

    function bst($treeNode, $height) {
        if ($treeNode) {
            $this->arr[$height][] = $treeNode->val;
            $this->bst($treeNode->left, $height + 1);
            $this->bst($treeNode->right, $height + 1);
        }
    }
}