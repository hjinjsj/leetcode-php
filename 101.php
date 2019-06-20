<?php
//给定一个二叉树，检查它是否是镜像对称的。
//
//例如，二叉树 [1,2,2,3,4,4,3] 是对称的。
//
//    1
//    / \
//    2   2
/// \ / \
//3  4 4  3
//但是下面这个 [1,2,2,null,3,null,3] 则不是镜像对称的:
//
//    1
//    / \
//    2   2
//   \   \
//   3    3
//说明:
//
//如果你可以运用递归和迭代两种方法解决这个问题，会很加分。
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/symmetric-tree
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

    /**
     * @param TreeNode $root
     * @return Boolean
     */
    function isSymmetric($root) {
        return $this->isMirror($root->left, $root->right);
    }

    public function isMirror($t1, $t2) {
        if ($t1 == null && $t2 == null) return true;
        if ($t1 == null || $t2 == null) return false;
        return ($t1->val == $t2->val)
            && $this->isMirror($t1->right, $t2->left)
            && $this->isMirror($t1->left, $t2->right);
    }
}