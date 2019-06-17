<?php

/**
 *
 * 给出两个 非空 的链表用来表示两个非负的整数。其中，它们各自的位数是按照 逆序 的方式存储的，并且它们的每个节点只能存储 一位 数字。
 *
 * 如果，我们将这两个数相加起来，则会返回一个新的链表来表示它们的和。
 *
 * 您可以假设除了数字 0 之外，这两个数都不会以 0 开头。
 *
 * 示例：
 *
 * 输入：(2 -> 4 -> 3) + (5 -> 6 -> 4)
 * 输出：7 -> 0 -> 8
 * 原因：342 + 465 = 807
 *
 * 来源：力扣（LeetCode）
 * 链接：https://leetcode-cn.com/problems/add-two-numbers
 * 著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 *
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {
        if (!$l1 && !$l2) {
            return null;
        } elseif (!$l1 && $l2) {
            return $l2;
        } elseif ($l1 && !$l2) {
            return $l1;
        }
        $nextVal = 0;
        $result = $l1;
        while($l1) {
            $left = $l1->val;
            $right = $l2->val;
            $val = $left + $right + $nextVal;
            $l1->val = ($val % 10);
            $nextVal =  (int)($val / 10);

            if (!$l1->next && $l2->next) {
                $l1->next = new ListNode(0);
            }elseif ($l1->next && !$l2->next) {
                $l2->next = new ListNode(0);
            } elseif ($nextVal > 0 && !$l1->next && !$l2->next) {
                $l1->next = new ListNode(0);
                $l2->next = new ListNode(0);
            }

            $l1 = $l1->next;
            $l2 = $l2->next;
        };
        return $result;
    }
}
