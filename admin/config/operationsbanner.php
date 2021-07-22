<?php

require_once './config/dbconfig.php';
$db = new dbconfig();

class operationsbanner extends dbconfig
{
    public function get_record()
    {
        global $db;     
        if (isset($_GET['id']) && $_GET['id'] != '') {

            $id = $db->check($_GET['id']);
            $query = "select * from banner where id='$id'";
            $res = mysqli_query($db->connection, $query);
            $check = mysqli_num_rows($res);
            if ($check > 0) {
                $row = mysqli_fetch_assoc($res);
                $banner = $row;
                return $banner;
            }
        }
    }
    // Insert Record in the Database
    public function Store_Record()
    {
        global $db;

        if (isset($_GET['id']) && $_GET['id'] != '') {

            $id = $db->check($_GET['id']);
            
        } 
        if (isset($_POST['submit'])) {
            $msg = '';
            $heading1 = $db->check($_POST['heading1']);
            $heading2 = $db->check($_POST['heading2']);
            $btn_txt = $db->check($_POST['btn_txt']);
            $btn_link = $db->check($_POST['btn_link']);
          
            if (isset($_GET['id']) && $_GET['id'] == 0) {
                if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
                    echo '<div class"alert danger">Please select only png,jpg and jpeg image formate</div>';
                    $msg="1";
                }
            } else {
                if ($_FILES['image']['type'] != '') {
                    if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
                        echo '<div class"alert danger">Please select only png,jpg and jpeg image formate</div>';
                        $msg="1";
                    }
                }
            }
            if ($msg == '') {
                if (isset($_GET['id']) && $_GET['id'] != '') {
                    if ($_FILES['image']['name'] != '') {
                        $temp = $_FILES['image']['name'];
                        $newfilename = rand(1111111111, 9999999999) . $temp;
                        $storepath = "../media/banner/" . $newfilename;
                        $image = "media/banner/" . $newfilename;
                        move_uploaded_file($_FILES['image']['tmp_name'], $storepath);
                   
                        $update_sql = "update banner set heading1='$heading1',heading2='$heading2',btn_txt='$btn_txt',btn_link='$btn_link',image='$image' where id='$id'";
                    } else {
                      
                        $update_sql = "update banner set heading1='$heading1',heading2='$heading2',btn_txt='$btn_txt',btn_link='$btn_link' where id='$id'";
                    }
                    mysqli_query($db->connection, $update_sql);
                } else {
                    $temp = $_FILES['image']['name'];
                    $newfilename = rand(1111111111, 9999999999) . $temp;
                    $storepath = "../media/banner/" . $newfilename;
                    $image = "media/banner/" . $newfilename;
                    move_uploaded_file($_FILES['image']['tmp_name'], $storepath);
                    mysqli_query($db->connection, "insert into banner(heading1,heading2,btn_txt,btn_link,image,status) values('$heading1','$heading2','$btn_txt','$btn_link','$image','1')");
                }

            }
        }
        

    }
    // View Database Record
    public function view_record()
    {
        global $db;
        $sql = "select * from banner order by id asc";
        $result = mysqli_query($db->connection, $sql);
        return $result;
    }

    public function category_status()
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
                $update_status_sql = "update banner set status='$status' where id='$id'";
                mysqli_query($db->connection, $update_status_sql);
            }
            if ($type == 'delete') {
                $id = $db->check($_GET['id']);
                $delete_sql = "delete from banner where id='$id'";
                mysqli_query($db->connection, $delete_sql);
            }

        }

    }

}


?>