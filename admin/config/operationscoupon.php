<?php

require_once './config/dbconfig.php';
$db = new dbconfig();

class operationscoupon extends dbconfig
{
    public function get_record(){
        global $db;
    
        if(isset($_GET['id']) && $_GET['id']!=''){
          
            $id=$db->check($_GET['id']);
            $result=mysqli_query($db->connection,"select * from coupon_master where id='$id'");
          return $result;
           
        }

    }
    // Insert Record in the Database
    public function Store_Record()
    {
        global $db;
        $msg='';
        if(isset($_GET['id']) && $_GET['id']!=''){
            $id=$db->check($_GET['id']);
        }
        if(isset($_POST['submit'])){
            $coupon_code=$db->check($_POST['coupon_code']);
            $coupon_type=$db->check($_POST['coupon_type']);
            $coupon_value=$db->check($_POST['coupon_value']);
            $cart_min_value=$db->check($_POST['cart_min_value']);   
            $res=mysqli_query($db->connection,"select * from coupon_master where coupon_code='$coupon_code'");
            $check=mysqli_num_rows($res);
            if($check>0){
                if(isset($_GET['id']) && $_GET['id']!=''){
                    $getData=mysqli_fetch_assoc($res);
                    if($id==$getData['id']){
                    
                    }else{
                        $msg="Coupon code already exist";
                        echo '<div class="alert alert-danger">Coupon already exits</div>';
                    }
                }else{
                    $msg="Coupon code already exist";
                    echo '<div class="alert alert-danger">Coupon already exits</div>';
                }
            }
            
            
            if($msg==''){
                if(isset($_GET['id']) && $_GET['id']!=''){
                    $update_sql="update coupon_master set coupon_code='$coupon_code',coupon_value='$coupon_value',coupon_type='$coupon_type',cart_min_value='$cart_min_value' where id='$id'";
                    mysqli_query($db->connection,$update_sql);
                }else{
                    mysqli_query($db->connection,"insert into coupon_master(coupon_code,coupon_value,coupon_type,cart_min_value,status) values('$coupon_code','$coupon_value','$coupon_type','$cart_min_value',1)");
                }
       
            }
        }
    }

    public function coupon_status()
    {

        global $db;

        if (isset($_GET['type']) && $_GET['type'] != '') {
            $type = $db->check( $_GET['type']);
            if ($type == 'status') {
                $operation = $db->check($_GET['operation']);
                $id = $db->check( $_GET['id']);
                if ($operation == 'active') {
                    $status = '1';
                } else {
                    $status = '0';
                }
                $update_status_sql = "update coupon_master set status='$status' where id='$id'";
                mysqli_query($db->connection, $update_status_sql);
            }

            if ($type == 'delete') {
                $id = $db->check($_GET['id']);
                $delete_sql = "delete from coupon_master where id='$id'";
                mysqli_query($db->connection, $delete_sql);
            }
        }

    }

    // Insert Record in the Database Using Query
    public function insert_record($SubCatName, $MainCatId)
    {
        global $db;
        $query = "INSERT INTO `subcategory`(`subcategory_name`, `category_id`) VALUES ('$SubCatName','$MainCatId')";
        $result = mysqli_query($db->connection, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // View Database Record
    public function view_record()
    {
        global $db;
        $sql="select * from coupon_master order by id desc";
         $result = mysqli_query($db->connection, $sql);
        return $result;
    }
    public function view_record_active()
    {
        global $db;
        $sql = "select * from categories where status='1'";
        $result = mysqli_query($db->connection, $sql);
        return $result;
    }

    // Get Particular Record
    public function get_recor($id)
    {
        global $db;
        $sql = "select * from subcategory where subcategory_id='$id'";
        $data = mysqli_query($db->connection, $sql);
        return $data;

    }

    // Delete Record
    public function Delete_Record($id)
    {
        global $db;
        $query = "delete from subcategory where subcategory_id='$id'";
        $result = mysqli_query($db->connection, $query);
        if ($result) {
            ?> <script>
                $(document).ready(function(){
                    $("#exampleModal").modal('show');
                });
               </script>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Success!</h5>

                                            </div>
                                            <div class="modal-body">
                                                Subategory Deleted Successfully!
                                            </div>
                                            <div class="modal-footer">
                                            <a  href="showsubcategory.php" class="btn btn-primary">Okay</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
               <?php

        } else {?>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Failed!</h5>

                                            </div>
                                            <div class="modal-body">
                                                Failed To Delete Subategory!
                                            </div>
                                            <div class="modal-footer">
                                                <a  href="showsubcategory.php" class="btn btn-primary">Okay</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            <?php }
    }

}
?>