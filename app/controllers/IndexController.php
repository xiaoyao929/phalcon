<?php
class IndexController extends \Phalcon\Mvc\Controller
{

    public function indexAction(){
    	$str = file_get_contents("a.txt");
    	$file_data = explode(",", $str);
    	//update products
    	$sql1 = "UPDATE hg_products SET marketable = 0  WHERE bn IN (\"".implode('","', $file_data)."\")";
    	$sql = "select hg_goods.id, hg_products.id as product_id from hg_goods left join hg_products on hg_goods.id = hg_products.goods_id where hg_goods.id in (SELECT goods_id FROM hg_products WHERE bn IN (\"".implode('","', $file_data)."\") GROUP BY goods_id)";


    	print_r($sql);die;
    		
    }



}
