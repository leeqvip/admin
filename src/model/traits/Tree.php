<?php

namespace techadmin\model\traits;

trait Tree
{

    /**
     * @var string
     */
    protected $parentColumn = 'parent_id';

    /**
     * @var string
     */
    protected $sortColumn = 'sort';

    /**
     * Format data to tree like array.
     *
     * @return array
     */
    public function toTree()
    {
        return $this->buildNestedArray();
    }

    public function flatTree(array $nodes = [])
    {
        if (empty($nodes)) {
            $nodes = $this->toTree();
        }
        $branch = [];

        foreach ($nodes as $key => $value) {
            $value['prefix'] = '|--' . str_repeat('---', $value['depth']);
            $children        = isset($value['children']) ? $value['children'] : [];
            if ($children) {
                unset($value['children']);
            }

            array_push($branch, $value);
            if ($children) {
                $branch = array_merge($branch, $this->flatTree($children));
            }
        }
        return $branch;
    }

    /**
     * Build Nested array.
     *
     * @param array $nodes
     * @param int   $parentId
     *
     * @return array
     */
    protected function buildNestedArray(array $nodes = [], $parentId = 0, $depth = 0)
    {
        $branch = [];

        if (empty($nodes)) {
            $nodes = $this->allNodes();
        }
        foreach ($nodes as $node) {
            if ($node[$this->parentColumn] == $parentId) {

                $children = $this->buildNestedArray($nodes, $node[$this->pk], $depth + 1);

                if ($children) {
                    $node['children'] = $children;
                }
                $node['depth'] = $depth;
                $branch[]      = $node;
            }
        }

        return $branch;
    }

    protected function allNodes()
    {
        return $this->order($this->sortColumn, 'asc')->order($this->pk, 'desc')->all()->toArray();
    }
}
