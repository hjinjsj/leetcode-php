<?php
//实现一个 Trie (前缀树)，包含 insert, search, 和 startsWith 这三个操作。
//
//示例:
//
//Trie trie = new Trie();
//
//trie.insert("apple");
//trie.search("apple");   // 返回 true
//trie.search("app");     // 返回 false
//trie.startsWith("app"); // 返回 true
//trie.insert("app");
//trie.search("app");     // 返回 true
//说明:
//
//你可以假设所有的输入都是由小写字母 a-z 构成的。
//保证所有输入均为非空字符串。
//
//来源：力扣（LeetCode）
//链接：https://leetcode-cn.com/problems/implement-trie-prefix-tree
//著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。

class Node {
    const NODE_NUM = 26;
    public $nodeList = null;
    public $value = '';
    public $num = 0;
    function __construct($val) {
        $this->value = $val;
        for ($i = 0; $i < self::NODE_NUM; $i++) {
            $this->nodeList[$i] = null;
        }
    }
}

class Trie {
    public $charNumMap = null;

    public $head = null;
    /**
     * Initialize your data structure here.
     */
    function __construct() {
        $this->head = new Node('');
        $this->charNumMap = array_flip([
            'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'
        ]);
    }

    /**
     * Inserts a word into the trie.
     * @param String $word
     * @return NULL
     */
    function insert($word) {
        $node = $this->head;
        $len = strlen($word);
        for ($i = 0; $i < $len; $i++) {
            if ($node->nodeList[$this->charNumMap[$word[$i]]] == null) {
                $node->nodeList[$this->charNumMap[$word[$i]]] = new Node($word[$i]);
            }
            $node = $node->nodeList[$this->charNumMap[$word[$i]]];
        }
        $node->num ++;
    }

    /**
     * Returns if the word is in the trie.
     * @param String $word
     * @return Boolean
     */
    function search($word) {
        $node = $this->head;
        $len = strlen($word);
        for ($i = 0; $i < $len; $i++) {
            if ($node->nodeList[$this->charNumMap[$word[$i]]] == null) {
                return false;
            }
            $node = $node->nodeList[$this->charNumMap[$word[$i]]];
        }

        if ($node->num > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns if there is any word in the trie that starts with the given prefix.
     * @param String $prefix
     * @return Boolean
     */
    function startsWith($prefix) {
        $node = $this->head;
        $len = strlen($prefix);
        for ($i = 0; $i < $len; $i++) {
            if ($node->nodeList[$this->charNumMap[$prefix[$i]]] == null) {
                return false;
            }
            $node = $node->nodeList[$this->charNumMap[$prefix[$i]]];
        }
        return true;
    }
}

/**
 * Your Trie object will be instantiated and called as such:
 * $obj = Trie();
 * $obj->insert($word);
 * $ret_2 = $obj->search($word);
 * $ret_3 = $obj->startsWith($prefix);
 */
$word = 'apple';
$obj = new Trie();
$obj->insert($word);
$ret_2 = $obj->search($word);
$prefix = 'apps';
$obj->insert('app');
$ret_3 = $obj->startsWith($prefix);
$ret_4 = $obj->search('app');
var_dump($ret_2, $ret_3, $ret_4);