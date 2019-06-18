<?php
//运用你所掌握的数据结构，设计和实现一个  LRU (最近最少使用) 缓存机制。它应该支持以下操作： 获取数据 get 和 写入数据 put 。
//
//获取数据 get(key) - 如果密钥 (key) 存在于缓存中，则获取密钥的值（总是正数），否则返回 -1。
//写入数据 put(key, value) - 如果密钥不存在，则写入其数据值。当缓存容量达到上限时，它应该在写入新数据之前删除最近最少使用的数据值，从而为新的数据值留出空间。
//
//进阶:
//
//你是否可以在 O(1) 时间复杂度内完成这两种操作？
//
//示例:
//
//LRUCache cache = new LRUCache( 2 /* 缓存容量 */ );
//
//cache.put(1, 1);
//cache.put(2, 2);
//cache.get(1);       // 返回  1
//cache.put(3, 3);    // 该操作会使得密钥 2 作废
//cache.get(2);       // 返回 -1 (未找到)
//cache.put(4, 4);    // 该操作会使得密钥 1 作废
//cache.get(1);       // 返回 -1 (未找到)
//cache.get(3);       // 返回  3
//cache.get(4);       // 返回  4
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/lru-cache
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Node {
    public $key;
    public $value;
    public $prev;
    public $next;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->prev = null;
        $this->next = null;
    }
}

class LRUCache {

    /**
     * @var Node
     */
    public $head = null;
    /**
     * @var Node
     */
    public $tail = null;
    public $usedCapacity = 0;
    public $dict = [];
    public $capacity;

    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->capacity = $capacity;
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        if (isset($this->dict[$key])) {
            // 如果是头结点则需要调整到尾巴节点，非头结点的话也需要放到尾巴节点
            $this->adjustToTail($key);
            return $this->dict[$key]->value;
        }
        return -1;
    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        // 取模找出索引位置
        if (!isset($this->dict[$key])) {
            $this->dict[$key] = new Node($key, $value);

            if (!$this->head && !$this->tail) {
                $this->head = $this->dict[$key];
                $this->tail = $this->dict[$key];
            } else {
                // 追加新的尾部节点
                $this->dict[$key]->prev = $this->tail;
                $this->tail->next = $this->dict[$key];
                $this->tail = $this->dict[$key];
            }

            if ($this->usedCapacity == $this->capacity) {
                // 移除头结点
                $key = $this->head->key;

                $this->head = $this->head->next;
                if (!$this->head) {
                    $this->tail = null;
                } else {
                    $this->head->prev = null;
                }
                unset($this->dict[$key]);

            } else {
                $this->usedCapacity ++;
            }
        } else {
            $item = $this->dict[$key];
            $item->value = $value;
            // 也需要调整到尾巴
            $this->adjustToTail($key);
        }
    }

    function adjustToTail($key)
    {
        // 如果是头结点则需要调整到尾巴节点，非头结点的话也需要放到尾巴节点
        $node = $this->dict[$key];
        if ($node->next) {
            $node->next->prev = $node->prev;
            if (!$node->prev) {
                $this->head = $node->next;
            } else {
                $node->prev->next = $node->next;
            }

            $node->prev = $this->tail;
            $node->next = null;
            $this->tail->next = $node;
            $this->tail = $node;
        }
    }
}

/**
 * Your LRUCache object will be instantiated and called as such:
 * $obj = LRUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */

//$obj = new LRUCache(2);
//$obj->put(1, 1);
//$obj->put(2, 2);
//$ret_1 = $obj->get(1);
//var_dump($ret_1);
//$obj->put(3, 3);
//$ret_1 = $obj->get(2);
//var_dump($ret_1);
//$obj->put(4, 4);
//$ret_1 = $obj->get(1);
//var_dump($ret_1);
//$ret_1 = $obj->get(3);
//var_dump($ret_1);
//$ret_1 = $obj->get(4);
//var_dump($ret_1);

//$obj = new LRUCache(2);
//$obj->put(2, 1);
//$obj->put(1, 2);
//$obj->put(2, 3);
//$obj->put(4, 1);
//$ret_1 = $obj->get(1);
//var_dump($ret_1);
//$ret_1 = $obj->get(2);
//var_dump($ret_1);