<?php

require_once './config/dbconfig.php';
$db = new dbconfig();

class operationscategory extends dbconfig
{
    public function get_record()
    {
        global $db;
        $categories = '';
        if (isset($_GET['id']) && $_GET['id'] != '') {

            $id = $db->check($_GET['id']);
            $query = "select * from categories where id='$id'";
            $res = mysqli_query($db->connection, $query);
            $check = mysqli_num_rows($res);
            if ($check > 0) {
                $row = mysqli_fetch_assoc($res);
                $categories = $row['categories'];
                return $categories;
            }
        }
    }
    // Insert Record in the Database
    public function Store_Record()
    {global $db;

        if (isset($_GET['id']) && $_GET['id'] != '') {

            $id = $db->check($_GET['id']);

        } 
        if (isset($_POST['submit'])) {
            $msg = '';
            $categories = $db->check($_POST['categories']);
            $res = mysqli_query($db->connection, "select * from categories where categories='$categories'");
            $check = mysqli_num_rows($res);
            if ($check > 0) {
                if (isset($_GET['id']) && $_GET['id'] != '') {
                    $getData = mysqli_fetch_assoc($res);
                    if ($id == $getData['id']) {

                    } else {
                        $msg = "Categories already exist";
                        echo '<div class="alert alert-danger">Category already existed</div>';
                    }
                } else {
                    $msg = "Categories already exist";
                    echo '<div class="alert alert-danger">Category already existed</div>';
                }
            }
            if ($msg == '') {

                if (isset($_GET['id']) && $_GET['id'] != '') {
                    mysqli_query($db->connection, "update categories set categories='$categories' where id='$id'");
                     ?>
                    <script>
                    window.location.href='categories.php';
                    </script>
                    <?php
                } else {
                    mysqli_query($db->connection, "insert into categories(categories,status) values('$categories','1')");
                    ?>
                    <script>
                    window.location.href='categories.php';
                    </script>
                    <?php
                }

            }
        }

    }

    // Insert Record in the Database Using Query
    public function insert_record($CatName)
    {
        global $db;
        $query = "INSERT INTO `category`(`category_name`) VALUES ('$CatName')";
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
        $sql = "select * from categories order by categories asc";
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
                $update_status_sql = "update categories set status='$status' where id='$id'";
                mysqli_query($db->connection, $update_status_sql);
            }
            if ($type == 'delete') {
                $id = $db->check($_GET['id']);
                $delete_sql = "delete from categories where id='$id'";
                mysqli_query($db->connection, $delete_sql);
            }

        }

    }

    // Delete Record
    public function Delete_Record($id)
    {
        global $db;
        $query = "delete from category where category_id='$id'";
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
                                                    Category Deleted Successfully!
                                                </div>
                                                <div class="modal-footer">
                                                <a  href="showcategory.php" class="btn btn-primary">Okay</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                   <?php

        } else {?>
                <script>
                    $(document).ready(function(){
                        $("#exampleModal").modal('show');
                    });
                   </script>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Failed!</h5>

                                                </div>
                                                <div class="modal-body">
                                                    Failed To Delete Category!
                                                </div>
                                                <div class="modal-footer">
                                                    <a  href="addsubcategory.php" class="btn btn-primary">Okay</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                <?php }
    }

}

?>