<?php

require_once './config/dbconfig.php';
$db = new dbconfig();

class operationsreviews extends dbconfig
{
    // View Database Record
    public function view_record()
    {
        global $db;
        $query = "select users.name,users.email,product_review.id,product_review.rating,product_review.review,product_review.added_on,product_review.status,product.name as pname from users,product_review,product where product_review.user_id=users.id and product_review.product_id=product.id  order by product_review.added_on desc";
        $result = mysqli_query($db->connection, $query);
        return $result;
    }

    public function category_status()
    {
        global $db;

        if (isset($_GET['type']) && $_GET['type'] != '') {
            global $db;
            $type = $db->check($_GET['type']);
            if ($type == 'status') {
                $operation = $db->check($_GET['operation']);
                $id = $db->check($_GET['id']);
                if ($operation == 'active') {
                    $status = '1';
                } else {
                    $status = '0';
                }
                $sql = "update product_review set status='$status' where id='$id'";
                mysqli_query($db->connection, $sql);
            }
            if ($type == 'delete') {
                $id = $db->check($_GET['id']);
                $sql = "delete from product_review where id='$id'";
                mysqli_query($db->connection, $sql);
            }
        }

    }

}
