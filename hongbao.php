<?php
$total=10;//红包总金额   
$num=10;// 分成10个红包，支持10人随机领取   
$min=0.01;//每个人最少能收到0.01元   
 $redpack = new redpack($total,$num,$min);
 $jieguo = $redpack->getPack();
 foreach($jieguo as $key=>$val){
     $n = $key+1;
     echo '第'.$n.'个红包：'.$val['money'].' 元，余额：'.$val['balance'].' 元<br>'."\r\n";   
 }
 
class redpack{
    //总金额
    private $total=0;
    //红包数量
    private $num=0;
    //最小红包金额
    private $min=0.01;
     
    public function __construct($total,$num,$min)
    {
        $this->total = $total;
        $this->num = $num;
        $this->min = $min;
    }
    //红包结果
    public function getPack()
    {
        $total = $this->total;
        $num = $this->num;
        $min = $this->min;
        for ($i=1;$i<$num;$i++)   
        {   
            $safe_total=($total-($num-$i)*$min)/($num-$i);//随机安全上限   
            $money=mt_rand($min*100,$safe_total*100)/100;   
            $total=$total-$money;  
            //红包数据
            $readPack[]= [
                'money'=>$money,
                'balance'=>$total,
            ];
        }
        //最后一个红包，不用随机       
        $readPack[] = [
            'money'=>$total,
            'balance'=>0,
        ];
        //返回结果
        return $readPack;
    }
     
}

?>




<?php
die;
	$params = "action=count&sid=2015_bj_starteachers&name=%E7%AC%A6%E6%89%AC%E6%89%AC&guid=ABB0A26769EF4594AE484F60
2326C876";  
	$ch = curl_init();  
	curl_setopt($ch, CURLOPT_URL, "http://vc.koouoo.com/li.php");  
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:8.8.8.8', 'CLIENT-IP:8.8.8.8'));  //构造IP  
	curl_setopt($ch, CURLOPT_REFERER, "http://www.baidu.com/ ");   //构造来路  
	curl_setopt($ch, CURLOPT_HEADER, 1);  
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	$out = curl_exec($ch);  
	curl_close($ch); 
?>
