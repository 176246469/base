<?php
namespace app\admin\model;

class TreeModel {
    private $data = null;
    private $fdata = null;
    private $level = null;
    private $children = null;
    private $prefix = null;
    private $parents = array();
    private $final = null;
    public function __construct($data) {
        foreach ($data as $value) {
            $line = $value;
            $this->fdata[$value['pid']][$value['id']] = $line;
            $this->data[$value['id']] = $line;
        }
    }

    /**
     * 获取所有父级
     * now为当前id
     * level为要获取的级数，如果为空表示一直找到顶端
     */
    public function getParents($now, $level = '', $prefix = '') {
        $this->parents = array();
        if ($level > 0) {
            $this->level = $level;
        }
        $this->findParents($now);
          if ($prefix != '') {
            foreach($this->parents as $key=>$value){
                $this->parents[$key]['prefix']=$prefix;
            }
          }

        return $this->parents;
    }

    /**
     * 递归查找所有父级，将每次找出的父级放到parent内
     */
    private function findParents($now) {
        if (isset($this->data[$now])) {
            if (empty($this->level)) {
                $this->parents[] = $this->data[$now];
                $this->findParents($this->data[$now]['pid']);
            } else {
                if (count($this->parents) <= $this->level) {
                    $this->parents[] = $this->data[$now];
                    $this->findParents($this->data[$now]['pid']);
                }
            }
        } else {
            return;
        }
    }

    /**
     * 获取所有子孙
     * top为当前id
     * level为要获取的级数
     * prefix为树标识的前缀，默认为⊢∟∣
     */
    public function getChildren($top, $level = '', $prefix = '') {
        $this->children = array();
        if ($level > 0) {
            $this->level = $level;
        }
        $this->findChildren($top);
        if ($prefix !== false) {
            if ($prefix == '') {
                $this->prefix['right'] = '<b>　├</b>';
                $this->prefix['line'] = '<b>　│</b>';
                $this->prefix['final'] = '<b>　└</b>';
            } else {
                $this->prefix['right'] = $prefix;
                $this->prefix['line'] = $prefix;
                $this->prefix['final'] = $prefix;
            }       
            foreach ($this->children as $key => $value) {
                $node = explode('_', trim($this->getFnode($top, $this->children[$key]['id']), '_'));
                krsort($node);
                if (count($node) > $this->level && !empty($this->level)) {
                    unset($this->children[$key]);
                } else {
                    $this->children[$key]['level'] = count($node);
                    $this->children[$key]['children'] = isset($this->fdata[$value['id']]) ? count($this->fdata[$value['id']]) :0;
                    $this->children[$key]['brother'] = isset($this->fdata[$this->children[$key]['pid']]) ? count($this->fdata[$this->children[$key]['pid']]) : 0;
                    $this->children[$key]['path']=$node; //implode('_',$node);
                    $this->children[$key]['position'] = $this->getPosition($value['id']);
                }

            }
        }

        foreach ($this->children as $key => $value) {
            //if ($top !== $this->children[$key]['pid']) {
                $prefix = '';
                foreach ($value['path'] as $val) {
                    if($val!=$value['id']){
                            $prefix .= (($this->children[$val]['position']!=$this->children[$val]['brother']) ?$this->prefix['line']:  '　' );                        
                    }
                }
                if ($this->children[$key]['brother'] > 1) {
                    if ($this->children[$key]['position'] == 1) {
                        $this->children[$key]['prefix'] = $prefix . $this->prefix['right'];
                    } elseif ($this->children[$key]['position'] == $this->children[$key]['brother']) {
                        $this->children[$key]['prefix'] = $prefix . $this->prefix['final'];
                    } else {
                        $this->children[$key]['prefix'] = $prefix . $this->prefix['right'];
                    }
                } else {
                    $this->children[$key]['prefix'] = $prefix . $this->prefix['final'];
                }
        }

        return $this->children;
    }

    /**
     * 递归查找所有子节点，将每次找出的子节点放到children内
     */
    private function findChildren($top) {
        if (isset($this->fdata[$top])) {
            foreach ($this->fdata[$top] as $value) {
                $this->children[$value['id']] = $value;
                $this->findChildren($value['id']);
            }
        } else {
            return;
        }
    }
    /**
     * 获取所有最终节点
     * top为定点id
     * 当前id
     */
    private function getFnode($top, $id) {
        if (isset($this->data[$id]) && $id !== $top) {
            return $this->data[$id]['id'] . '_' . $this->getFnode($top, $this->data[$id]['pid']);
        } else {
            return;
        }
    }
    /**
     * 获取节点位置
     * top为定点id
     * 当前id
     */
    private function getPosition($id) {
        $i = 1;
        foreach ($this->fdata[$this->data[$id]['pid']] as $value) {
            if ($value['id'] == $id) {
                return $i;
            }
            $i++;
        }

    }
    /**
     * 获取所有最终节点
     * top为当前id
     */
    public function getFinal($top) {
        $this->final = array();
        $this->findFinal($top);
        return $this->final;
    }

    /**
     * 递归查找所有最终节点，将每次找出的最终节点放到final内
     */
    private function findFinal($top) {
        $this->findChildren($top, '', false);
        foreach ($this->children as $value) {
            if (!isset($this->fdata[$value['id']])) {
                $this->final[] = $value;
            }
        }
    }
}
