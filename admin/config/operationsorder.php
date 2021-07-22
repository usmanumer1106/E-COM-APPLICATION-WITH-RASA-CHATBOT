<?php
require_once('./config/dbconfig.php');
$db = new dbconfig();

class operationsorder extends dbconfig
{

    public function view_order(){
        global $db;
        $order_id=$db->check($_GET['id']);
        $sql="select distinct(order_detail.id) ,order_detail.*,product.name,product.image,`order`.address,`order`.city,`order`.pincode from order_detail,product ,`order` where order_detail.order_id='$order_id' and  order_detail.product_id=product.id GROUP by order_detail.id";							
        $result=mysqli_query($db->connection,$sql);
        return $result;
    }
    public function user_detail()
    {
        global $db;
        $order_id=$db->check($_GET['id']);
        $sql="select * from `order` where id='$order_id'";
        $result=mysqli_query($db->connection,$sql);
        return $result;
    }
    public function coupon(){
        global $db;
        $order_id=$db->check($_GET['id']);
        $sql="select coupon_value,coupon_code from `order` where id='$order_id'";
        $result=mysqli_query($db->connection,$sql);
        return $result;
    
    }
    public function order_status(){
        global $db;
        $order_id=$db->check($_GET['id']);
        $sql= "select order_status.name,order_status.id as order_status from order_status,`order` where `order`.id='$order_id' and `order`.order_status=order_status.id";
        $result=mysqli_query($db->connection,$sql);
        return $result;      
    }
    public function status(){
        global $db;
        $sql="select * from order_status";
        $result=mysqli_query($db->connection,$sql);
        return $result;
    }
public function change_order_status(){
    global $db;
    $order_id=$db->check($_GET['id']);
if(isset($_POST['update_order_status'])){
	$update_order_status=$_POST['update_order_status'];
	if($update_order_status=='5'){
		mysqli_query($db->connection,"update `order` set order_status='$update_order_status',payment_status='Success' where id='$order_id'");
	}else{
		mysqli_query($db->connection,"update `order` set order_status='$update_order_status' where id='$order_id'");
	}

}
}

    public function view_record()
    {
        global $db;
        	$sql="select `order`.*,order_status.name as order_status_str from `order`,order_status where order_status.id=`order`.order_status order by `order`.id desc";
			$result=mysqli_query($db->connection,$sql);
            return $result;				
    }

 
    public function view_recordnotprocess()
    {
        global $db;
   
        $sql="select * from `order`where order_status=1 order by `order`.id desc";
        $result = mysqli_query($db->connection, $sql);
            return $result;
        
    }


    public function view_recordinprocess()
    {
        global $db;
     
        $sql="select * from `order`where order_status=2 order by `order`.id desc";
           $result = mysqli_query($db->connection, $sql);
            return $result;
      
    }

    public function view_recordshiped()
    {
        global $db;

        $sql="select * from `order`where order_status=3 order by `order`.id desc";
        $result = mysqli_query($db->connection, $sql);
        return $result;
    }
    public function view_recordcanceled()
    {
        global $db;

        $sql="select * from `order`where order_status=4 order by `order`.id desc";
        $result = mysqli_query($db->connection, $sql);
        return $result;
    }
    public function view_recordcompledtd()
    {
        global $db;

        $sql="select * from `order`where order_status=5 order by `order`.id desc";
        $result = mysqli_query($db->connection, $sql);
        return $result;
    }

      // Get Particular Record
      public function get_record($id)
      {
          global $db;
          $sql = "SELECT *   FROM `order` WHERE order_id='$id' ";
          $data = mysqli_query($db->connection, $sql);
          return $data;
      }


}
?>