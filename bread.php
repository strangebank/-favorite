<?php
class Bread{
	//面包屑导航数组
	protected $tree   = array();

	//字段id名称
	protected $son    = 'id';

	//父字段的名称
	protected $parent = 'parent';
	/*
    * 构建函数 读取字段与父字段的标识符
    * @param $son string  读取字段标识符
    * @param $parent string 父字段标识符
    *
    */
	public function __construct($son=false,$parent=false){
		$this->son=$son?$son:$this->son;
		$this->parent=$parent?$parent:$this->parent;
	}

	/*
    * 主体函数
    * @param array $arr 查询数据的数组
    * @param int  $id   查询id
    * @return array $this->tree 返回查询最后的结果
    */
	public function breads($arr,$id=0){
		$tree=array();
		while($id>0){
			foreach($arr as $v){
				if($v[$this->son]==$id){
					$this->tree[]=$v;
					$id=$v[$this->parent];
				}
			}
		}
		return $this->tree=array_reverse($this->tree);
	}
	/*
    * 递归查找子孙树
    * @param array $arr 查询数据的数组
    * @param int $id  查询id
    * @param int $lev 级别,默认为1
    * @return array $subs 返回查询的最后结果
    */
	public function findson($arr,$id=0,$lev=1){
		//静态延迟绑定
		static $subs=array();
		foreach($arr as $v) {
			if($v[$this->parent] == $id){
				$v['lev']=$lev;
				$subs[]=$v;
				$this->findson($arr,$v[$this->son],$lev+1);
			}

		}
		return $subs;
	}
}

/////////////////测试代码///////////////////
$breads=array(
	array('id'=>1,'a'=>'action','m'=>'module','c'=>'controller','name'=>'首页','parent'=>0),
	array('id'=>2,'a'=>'action','m'=>'module','c'=>'controller','name'=>'应用中心','parent'=>1),
	array('aa'=>'charge','id'=>3,'a'=>'action','m'=>'module','c'=>'controller','name'=>'佣金推广','parent'=>2),
	array('id'=>4,'a'=>'index','m'=>'charge','c'=>'run','name'=>'佣金组管理','parent'=>3),
	array('id'=>5,'a'=>'action','m'=>'module','c'=>'controller','name'=>'经纪人管理','parent'=>3),
	array('id'=>6,'a'=>'action','m'=>'module','c'=>'controller','name'=>'转发纪录','parent'=>3),
		array('id'=>7,'a'=>'action','m'=>'module','c'=>'controller','name'=>'技术设置','parent'=>6),
		array('id'=>8,'name'=>'河北','parent'=>0),
		array('id'=>9,'name'=>'石家庄','parent'=>8),
		array('id'=>10,'name'=>'邯郸','parent'=>8),
	);
$g_key = 'charge';
function getId($breads,$gkey){
return 7;
echo 'S:'.$gkey;
foreach($breads as $k=>$v){
	echo "\r\n".$k.'::'.$gkey;
	foreach ($v as $ke=>$row){
	echo ' '.$ke."=".$row;
	if($ke == 'charge'){ die('ddddd');}
		if($ke ==$gkey){
				echo 'Find';die;
			return $k;
		}
	}
}
}
$id=getId($breads,$g_key);
echo "id:".$id;

$t=new Bread();
$a=$t->breads($breads,$id);


foreach($a as $v) {
	echo "==>".$v['name'];
} 

