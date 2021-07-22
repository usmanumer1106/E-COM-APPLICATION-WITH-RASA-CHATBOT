<?php

require_once './config/dbconfig.php';
$db = new dbconfig();

class operationssubcategory extends dbconfig
{
    public function get_record()
    {
        global $db;
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $id = $db->check($_GET['id']);
            $res = mysqli_query($db->connection, "select * from sub_categories where id='$id'");
           return $res;
        }
    }
    // Insert Record in the Database
    public function Store_Record()
    {
        global $db;
        $msg = '';
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $id = $db->check($_GET['id']);
        }
        if (isset($_POST['submit'])) {
            $categories = $db->check($_POST['categories_id']);
            $sub_categories = $db->check($_POST['sub_categories']);
            $res = mysqli_query($db->connection, "select * from sub_categories where categories_id='$categories' and sub_categories='$sub_categories'");
            $check = mysqli_num_rows($res);
            if ($check > 0) {
                if (isset($_GET['id']) && $_GET['id'] != '') {
                    $getData = mysqli_fetch_assoc($res);
                    if ($id == $getData['id']) {

                    } else {
                        $msg = "Sub Categories already exist";
                        echo '<div class="alert alert-danger">Category already existed</div>';

                    }
                } else {
                    $msg = "Sub Categories already exist";
                    echo '<div class="alert alert-danger">Category already existed</div>';

                }
            }

            if ($msg == '') {
                if (isset($_GET['id']) && $_GET['id'] != '') {
                    mysqli_query($db->connection, "update sub_categories set categories_id='$categories',sub_categories='$sub_categories' where id='$id'");
                    ?>
                    <script>
                    window.location.href='sub_categories.php';
                    </script>
                    <?php
                } else {

                    mysqli_query($db->connection, "insert into sub_categories(categories_id,sub_categories,status) values('$categories','$sub_categories','1')");
                    ?>
                    <script>
                    window.location.href='sub_categories.php';
                    </script>
                    <?php
                }
               
            }
        }

    }

    public function subcategory_status()
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
                $update_status_sql = "update sub_categories set status='$status' where id='$id'";
                mysqli_query($db->connection, $update_status_sql);
            }

            if ($type == 'delete') {
                $id = $db->check($_GET['id']);
                $delete_sql = "delete from sub_categories where id='$id'";
                mysqli_query($db->connection, $delete_sql);
            }
        }

    }

    // View Database Record
    public function view_record()
    {
        global $db;
        $sql = "select sub_categories.*,categories.categories from sub_categories,categories where categories.id=sub_categories.categories_id order by sub_categories.sub_categories asc";
        $result = mysqli_query($db->connection, $sql);
        return $result;
    }
    public function view_record_active()
    {
        global $db;
        $sql="select * from categories where status='1'";
          $result = mysqli_query($db->connection, $sql);
        return $result;
    }
  
    
}
?>