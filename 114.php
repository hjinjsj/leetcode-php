<?php
//给定一个二叉树，原地将它展开为链表。
//
//例如，给定二叉树
//
//    1
//    / \
//    2   5
/// \   \
//3   4   6
//将其展开为：
//
//1
// \
// 2
//   \
//   3
//     \
//     4
//       \
//       5
//         \
//         6
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/flatten-binary-tree-to-linked-list
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
    public $curr = null;
    public $pre = null;

    /**
     * @param TreeNode $root
     * @return NULL
     */
    function flatten($root) {
        $this->curr = $root;
        $this->modify($root);
    }

    // 前序遍历
    function modify($tree) {
        if($tree != null){
            $this->curr = $tree;
            if($this->pre != null){
                $this->pre->right = $this->curr;
                $this->pre->left = null;
                $this->pre = $this->curr;
            }else{
                $this->pre = $this->curr;
            }
            $left = $tree->left;
            $right = $tree->right;
            $this->modify($left);
            $this->modify($right);
        }
    }
}