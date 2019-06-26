<?php
//将两个有序链表合并为一个新的有序链表并返回。新链表是通过拼接给定的两个链表的所有节点组成的。 
//
//示例：
//
//输入：1->2->4, 1->3->4
//输出：1->1->2->3->4->4
//
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/merge-two-sorted-lists
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}
class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function mergeTwoLists($l1, $l2) {
        $res = null;
        $tail = null;
        while ($l1 && $l2) {
            if ($l1->val > $l2->val) {
                $temp = new ListNode($l2->val);
                if ($tail == null) {
                    $tail = $temp;
                    $res = $tail;
                } else {
                    $tail->next = $temp;
                    $tail = $temp;
                }
                $l2 = $l2->next;
            } else {
                $temp = new ListNode($l1->val);
                if ($tail == null) {
                    $tail = $temp;
                    $res = $tail;
                } else {
                    $tail->next = $temp;
                    $tail = $temp;
                }
                $l1 = $l1->next;
            }
        }

        if ($l1) {
            if ($tail == null) {
                $tail = $l1;
                $res = $tail;
            } else {
                $tail->next = $l1;
            }
        }
        if ($l2) {
            if ($tail == null) {
                $tail = $l2;
                $res = $tail;
            } else {
                $tail->next = $l2;
            }
        }
        return $res;
    }
}
