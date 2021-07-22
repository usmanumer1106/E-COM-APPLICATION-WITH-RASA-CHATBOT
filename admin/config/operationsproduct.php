<?php

require_once './config/dbconfig.php';
$db = new dbconfig();
class operationsproduct extends dbconfig
{

    public function view_check()
    {
        global $db;
        if (isset($_GET['id']) && $_GET['id'] != '') {

            $id = $db->check($_GET['id']);
            $result = mysqli_query($db->connection, "select * from product where id='$id'");
            return $result;

        }

    }
    public function add_stock()
    {
        global $db;
        if (isset($_POST['addstock']) && isset($_GET['id']) ) {

            $id = $db->check($_GET['id']);
            $qty=$db->check($_POST['qty']);
            $result = mysqli_query($db->connection, "UPDATE `product` SET `qty`=`qty`+$qty WHERE id=$id;");
            echo $result;
            return $result;

        }

    }
    // Insert Record in the Database
    public function Store_Record()
    {
        global $db;
        $msg = '';
        if (isset($_GET['id']) && $_GET['id'] != '') {

            $id = $db->check($_GET['id']);
            $res = mysqli_query($db->connection, "select * from product where id='$id'");
            $check = mysqli_num_rows($res);
            if ($check > 0) {
                $row = mysqli_fetch_assoc($res);
                $categories_id = $row['categories_id'];
                $sub_categories_id = $row['sub_categories_id'];
                $name = $row['name'];
                $mrp = $row['mrp'];
                $price = $row['price'];
                $qty = $row['qty'];
                $short_desc = $row['short_desc'];
                $description = $row['description'];
                $best_seller = $row['best_seller'];
            } else {
                header('location:product.php');
                die();
            }
        }

        if (isset($_POST['submit'])) {
            $categories_id = $db->check($_POST['categories_id']);
            $sub_categories_id = $db->check($_POST['sub_categories_id']);
            $name = $db->check($_POST['name']);
            $mrp = $db->check($_POST['mrp']);
            $price = $db->check($_POST['price']);
            $qty = $db->check($_POST['qty']);
            $short_desc = $db->check($_POST['short_desc']);
            $description = $db->check($_POST['description']);          
            $best_seller = $db->check($_POST['best_seller']);
            $res = mysqli_query($db->connection, "select * from product where name='$name'");
            $check = mysqli_num_rows($res);
            if ($check > 0) {
                if (isset($_GET['id']) && $_GET['id'] != '') {
                    $getData = mysqli_fetch_assoc($res);
                    if ($id == $getData['id']) {

                    } else {
                        $msg = "Product already exist";
                    }
                } else {
                    $msg = "Product already exist";
                }
            }

            if (isset($_GET['id']) && $_GET['id'] == 0) {
                if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
                    echo '<div class"alert danger">Please select only png,jpg and jpeg image formate</div>';
                }
            } else {
                if ($_FILES['image']['type'] != '') {
                    if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
                        echo '<div class"alert danger">Please select only png,jpg and jpeg image formate</div>';
                    }
                }
            }
//fro multiple images check type
            if(isset($_FILES['product_images'])){
                foreach($_FILES['product_images']['type'] as $key=>$val){
                    if($_FILES['product_images']['type'][$key]!=''){
                        if($_FILES['product_images']['type'][$key]!='image/png' && $_FILES['product_images']['type'][$key]!='image/jpg' && $_FILES['product_images']['type'][$key]!='image/jpeg'){
                            $msg="Please select only png,jpg and jpeg image formate in multipel product images";
                        }
                    }
                }
            }

          if ($msg == '') {
                if (isset($_GET['id']) && $_GET['id'] != '') {
                    if ($_FILES['image']['name'] != '') {
                        $temp = $_FILES['image']['name'];
                        $newfilename = rand(1111111111, 9999999999) . $temp;
                        $storepath = "../media/product/" . $newfilename;
                        $image = "media/product/" . $newfilename;
                        move_uploaded_file($_FILES['image']['tmp_name'], $storepath);
                        $update_sql = "update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',image='$image',best_seller='$best_seller',sub_categories_id='$sub_categories_id' where id='$id'";
                    } else {
                        $update_sql = "update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',best_seller='$best_seller',sub_categories_id='$sub_categories_id' where id='$id'";
                    }
                    mysqli_query($db->connection, $update_sql);
                    ?>
                            <script>
                            window.location.href='product.php';
                            </script>
                            <?php
                } else {
                    $temp = $_FILES['image']['name'];
                    $newfilename = rand(1111111111, 9999999999) . $temp;
                    $storepath = "../media/product/" . $newfilename;
                    $image = "media/product/" . $newfilename;
                    move_uploaded_file($_FILES['image']['tmp_name'], $storepath);
                    mysqli_query($db->connection, "insert into product(categories_id,name,mrp,price,qty,short_desc,description,status,image,best_seller,sub_categories_id) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description',1,'$image','$best_seller','$sub_categories_id')");
                    if(isset($_GET['id']) && $_GET['id']!=''){
                    $id=mysqli_insert_id($db->connection);}
                    else{
                        ?>
                            <script>
                            window.location.href='product.php';
                            </script>
                            <?php
                    }
                }

            }

            //multiple image
            if(isset($_GET['id']) && $_GET['id']!=''){
                foreach($_FILES['product_images']['name'] as $key=>$val){
                    if($_FILES['product_images']['name'][$key]!=''){
                        if(isset($_POST['product_images_id'][$key])){
                            $temp = $_FILES['product_images']['name'][$key];
                    $newfilename = rand(1111111111, 9999999999) . $temp;
                    $storepath = "../media/product/" . $newfilename;
                    $image = "media/product/".$newfilename;

                           
                            move_uploaded_file($_FILES['product_images']['tmp_name'][$key],"../".$image);
                            echo $_FILES['product_images']['tmp_name'][$key];
                            mysqli_query($db->connection,"update product_images set product_images='$image' where id='".$_POST['product_images_id'][$key]."'");
                            ?>
                            <script>
                            window.location.href='product.php';
                            </script>
                            <?php

                        }else{
                            $temp = $_FILES['product_images']['name'][$key];
                    $newfilename = rand(1111111111, 9999999999) . $temp;
                    $storepath = "../media/product/" . $newfilename;
                    $image = "media/product/" . $newfilename;   
                    move_uploaded_file($_FILES['product_images']['tmp_name'][$key],"../".$image);
                            mysqli_query($db->connection,"insert into product_images(product_id,product_images) values('$id','$image')");
                            ?>
                            <script>
                            window.location.href='product.php';
                            </script>
                            <?php
                        }
                        
                    }
                }
            }else{
                if(isset($_FILES['product_images']['name'])){
                    foreach($_FILES['product_images']['name'] as $key=>$val){
                        if($_FILES['product_images']['name'][$key]!=''){
                            $temp = $_FILES['product_images']['name'][$key];
                            $newfilename = rand(1111111111, 9999999999) . $temp;
                            $storepath = "../media/product/" . $newfilename;
                            $image = "media/product/" . $newfilename; 
                             move_uploaded_file($_FILES['product_images']['tmp_name'][$key],"../".$image);
                            mysqli_query($db->connection,"insert into product_images(product_id,product_images) values('$id','$image')");
                            ?>
                            <script>
                            window.location.href='product.php';
                            </script>
                            <?php
                        }
                    }
                }
            }
            //end multiple images
           




        }
    }

    public function multipleimage(){
        global $db;
        if(isset($_GET['id']) && $_GET['id']!=''){
            $id=$db->check($_GET['id']);
        $result=mysqli_query($db->connection,"select id,product_images from product_images where product_id='$id'");
        return $result;
        }
    }

    public function product_status()
    {

        global $db;

        if (isset($_GET['type']) && $_GET['type'] != '') {
            $type = $db->check($_GET['type']);
            if ($type == 'status') {
                $operation = $db->check($_GET['operation']);
                $id = $db->check($_GET['id']);
                if ($operation == 'active') {
                    $status = '1';
                } else {
                    $status = '0';
                }
                $update_status_sql = "update product set status='$status' where id='$id'";
                mysqli_query($db->connection, $update_status_sql);
            }

            if ($type == 'delete') {
                $id = $db->check($_GET['id']);
                $delete_sql = "delete from product where id='$id'";
                mysqli_query($db->connection, $delete_sql);
            }
        }
    }
    public function productSoldQtyByProductId($pid)
    {
        global $db;
        $sql = "select sum(order_detail.qty) as qty from order_detail,`order` where `order`.id=order_detail.order_id and order_detail.product_id=$pid and `order`.order_status!=4";
        $res = mysqli_query($db->connection, $sql);
        $row = mysqli_fetch_assoc($res);
       
        return $row['qty'];
    }

    // View Database Record
    public function view_record()
    {
        global $db;
        
        $sql = "select product.*,categories.categories from product,categories where product.categories_id=categories.id order by product.id desc";
        $result = mysqli_query($db->connection, $sql);
        return $result;
    }
    public function deleteimg(){
        global $db;
if(isset($_GET['pi']) && $_GET['pi']>0){
	$pi=$db->check($_GET['pi']);
	$sql="delete from product_images where id='$pi'";
	mysqli_query($db->connection,$sql);
}
    }
    public function view_record_active()
    {
        global $db;
        $sql = "select * from categories where status='1'";
        $result = mysqli_query($db->connection, $sql);
        return $result;
    }

}
