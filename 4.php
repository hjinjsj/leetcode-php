<?php
//给定两个大小为 m 和 n 的有序数组 nums1 和 nums2。
//
//请你找出这两个有序数组的中位数，并且要求算法的时间复杂度为 O(log(m + n))。
//
//你可以假设 nums1 和 nums2 不会同时为空。
//
//示例 1:
//
//nums1 = [1, 3]
//nums2 = [2]
//
//则中位数是 2.0
//示例 2:
//
//nums1 = [1, 2]
//nums2 = [3, 4]
//
//则中位数是 (2 + 3)/2 = 2.5
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/median-of-two-sorted-arrays
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Float
     */
    function findMedianSortedArrays($nums1, $nums2) {
        $cnt1 = count($nums1);
        $cnt2 = count($nums2);

        $result = [];
        $i = 0;
        $j = 0;
        while ($i < $cnt1 && $j < $cnt2) {
            if ($nums1[$i] < $nums2[$j]) {
                $result[] = $nums1[$i++];
            } else {
                $result[] = $nums2[$j++];
            }
        }

        while ($i < $cnt1) {
            $result[] = $nums1[$i++];
        }

        while ($j < $cnt2) {
            $result[] = $nums2[$j++];
        }

        $cnt = $cnt1 + $cnt2;
        if ($cnt == 0) {
            return 0;
        }
        if ($cnt % 2) {
            return $result[($cnt-1)/2];
        } else {
            return ($result[($cnt-2)/2] + $result[$cnt/2])/2;
        }
    }
}