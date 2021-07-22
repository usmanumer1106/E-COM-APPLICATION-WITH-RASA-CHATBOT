<?php

require_once './config/dbconfig.php';
$db = new dbconfig();

class operationsadmin extends dbconfig
{
    // function for login
    public function login()
    {
        global $db;
        if (isset($_POST['submit'])) {
         
            $username = $db->check($_POST['username']);
            $password = $db->check($_POST['password']);
            $sql = "select * from admin_users where username='$username' and password='$password'";
            $res = mysqli_query($db->connection, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                
                $_SESSION['ADMIN_LOGIN'] = 'yes';
                $_SESSION['ADMIN_USERNAME'] = $username;
                header('location:index.php');
                die();
            } else {
                echo '<div class="alert alert-danger">Please enter correct login details</div>';
            }
        }
    }

    public function show_user()
    {
        global $db;
        $sql = "select * from users order by id desc";
        $result = mysqli_query($db->connection, $sql);
        return $result;
    }

    public function delete_user()
    {
        global $db;
        if (isset($_GET['type']) && $_GET['type'] != '') {
            $type = $db->check($_GET['type']);
            if ($type == 'delete') {
                $id = $db->check($_GET['id']);
                $delete_sql = "delete from users where id='$id'";
                mysqli_query($db->connection, $delete_sql);
            }
        }
    }

    public function contact_us_show()
    {
        global $db;
        $sql = "select * from contact_us order by id desc";
        $result = mysqli_query($db->connection, $sql);
        return $result;
    }
    public function contact_us_delete()
    {
        global $db;

        if (isset($_GET['type']) && $_GET['type'] != '') {
            $type = $db->check( $_GET['type']);
            if ($type == 'delete') {
                $id = $db->check($_GET['id']);
                $delete_sql = "delete from contact_us where id='$id'";
                mysqli_query($db->connection, $delete_sql);
            }
        }
    }

    // function for forgot password
    public function forgotpassword()
    {
        global $db;
        if (isset($_POST['forgot'])) {

            $Email = $_POST['email'];
            $query = "SELECT * FROM `admin` WHERE admin_email='$Email'";

            $result = mysqli_query($db->connection, $query);
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc(($result));

                $to = $data['admin_email'];
                $Password = $data['admin_password'];
                $Subject = " " . "Password Reset";
                $Body = "Hi," . $data['admin_name'] . " Your Paaword for this account is" . $data['admin_password'] . "";

                if (mail($to, $Subject, $Body, $Password)) {
                    echo '<div class="alert alert-danger"> Password reset link sent to your email.</div>';
                }

            } else {

                echo '<div class="alert alert-danger"> No account with this email.</div>';
            }
        }
    }
    public function view_record()
    {
        global $db;
        $query = "SELECT * FROM `admin`";
        $result = mysqli_query($db->connection, $query);
        return $result;
    }
    public function view_user()
    {
        global $db;
        $query = "SELECT * FROM `user`";
        $result = mysqli_query($db->connection, $query);
        return $result;
    }

    // Insert Record in the Database
    public function Store_Record()
    {
        global $db;
        if (isset($_POST['btn_addadmin'])) {
            $Name = $_POST['name'];
            $Email = $_POST['email'];
            $Address = $_POST['address'];
            $Phone = $_POST['phone'];
            $Type = $_POST['type'];

            $Password = md5($_POST['password']);
            $query = "SELECT * FROM `admin` where admin_email='$Email'";
            $result = mysqli_query($db->connection, $query);
            $row = mysqli_num_rows($result);
            if ($row > 0) {
                echo '<div class="alert alert-danger"> User with same email already exsisted </div>';
            } else {

                if ($this->insert_record($Name, $Email, $Address, $Phone, $Type, $Password)) {
                    echo '<div class="alert alert-success"> Your Record Has Been Saved :) </div>';

                } else {
                    echo '<div class="alert alert-danger"> Failed </div>';
                }
            }
        }
    }

    // Insert Record in the Database Using Query
    public function insert_record($Name, $Email, $Address, $Phone, $Type, $Password)
    {
        global $db;
        $query = "INSERT INTO `admin`( `admin_name`, `admin_email`, `admin_password`, `admin_phone`, `admin_type`, `admin_address`)
         VALUES ('$Name','$Email', '$Password', '$Phone', '$Type', '$Address')";
        $result = mysqli_query($db->connection, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    // Delete Record From Database
    public function Delete_Record($id)
    {
        global $db;
        $query = "delete from admin where admin_id='$id'";
        $result = mysqli_query($db->connection, $query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    // Get Particular Record
    public function get_record($id)
    {
        global $db;
        $sql = "SELECT *   FROM `admin` WHERE admin_id='$id' ";
        $data = mysqli_query($db->connection, $sql);
        return $data;

    }

    public function update($id)
    {
        global $db;
        if (isset($_POST['btn_changetype'])) {
            $type = $_POST['type'];
            $sql = "update  `admin` set admin_type='$type' WHERE admin_id='$id' ";
            mysqli_query($db->connection, $sql);
        }

        if (isset($_POST['btn_changestatus'])) {
            $status = $_POST['status'];
            $sql = "update  `admin` set admin_status='$status' WHERE admin_id='$id' ";
            mysqli_query($db->connection, $sql);
        }

    }
    public function changepassword()
    {
        global $db;
        $id = $_SESSION["adminid"];
        if (isset($_POST['btn_change'])) {

            $oldpass = md5($_POST['old_password']);
            $newpass = md5($_POST['new_password']);

            $query = "select * from admin where admin_id=$id and admin_password='$oldpass'";
            $result = mysqli_query($db->connection, $query);

            $no = mysqli_num_rows($result);

            if ($no > 0) {
                $query = "UPDATE `admin` SET `admin_password`= '$newpass' WHERE admin_id='$id'";
                if (mysqli_query($db->connection, $query)) {
                    echo '<div class="alert alert-success"> Password Change Successfuly </div>';
                }

            } else {
                echo '<div class="alert alert-danger"> Wrong Old Password </div>';

            }

        }
    }
}
