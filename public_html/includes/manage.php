<?php

class Manage
{

    private $con;

    function __construct()
    {
        include_once("../database/db.php");
        $db = new Database();
        $this->con = $db->connect();
    }

    /**
     * @param $table
     * @param $pno
     * @return array
     */
    public function manageRecordWithPagination($table, $pno)
    {
        $a = $this->pagination($this->con, $table, $pno, 10);
        if ($table == "categories") {
            $sql = "SELECT p.cid,p.category_name as category, c.category_name as parent, p.status FROM categories p LEFT JOIN categories c ON p.parent_cat=c.cid ORDER BY c.cid DESC " . $a["limit"];
        } else if ($table == "products") {
            $sql = "SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_stock,p.added_date,p.p_status FROM products p,brands b,categories c WHERE p.bid = b.bid AND p.cid = c.cid ORDER BY p.pid DESC " . $a["limit"];
        } else if($table == "invoice_details"){
            $sql = "SELECT p.product_name,i_d.price,i_d.qty,b.brand_name,i.order_date,i.sub_total,i.payment_type,i_d.invoice_no
			FROM invoice_details i_d,invoice i,products p,brands b 
			WHERE i_d.invoice_no = i.invoice_no AND i_d.product_name = p.pid AND i.customer_name = b.bid ORDER BY i_d.id DESC ".$a["limit"];
        } else if($table == "sale_details"){
            $sql = "SELECT s_d.id,p.product_name,s_d.price,s_d.qty,u.username,s_i.order_date,s_i.sub_total,s_i.discount,(s_i.sub_total-s_i.discount) AS net_total,s_i.paid,((s_i.sub_total-s_i.discount)-s_i.paid) AS due,s_i.payment_type,s_d.invoice_no
			FROM sale_details s_d,sale_invoice s_i,products p,user u
			WHERE s_d.invoice_no = s_i.invoice_no AND s_d.product_name = p.pid AND s_i.customer_name = u.id ORDER BY s_d.id DESC ".$a["limit"];
        } else if ($table == "user") {
            $sql = "SELECT * FROM " . $table . " ORDER BY " . $table . ".id DESC " . $a["limit"];
        } else if ($table == "brands") {
            $sql = "SELECT * FROM " . $table . " ORDER BY " . $table . ".bid DESC " . $a["limit"];
        }
        $result = $this->con->query($sql) or die($this->con->error);
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return ["rows" => $rows, "pagination" => $a["pagination"]];

    }

    public function manageSummaryWithPagination($stdate, $eddate,  $selectType, $selectOption, $pno)
    {
        //$selectType :- userwise, productwise
        //$selectOption ;- insales , inpurchases

        $a = $this->pagination($this->con, "user", $pno, 10);
        $sql = "";
        $resultType = 0;

        if($selectType == "user_wise" && $selectOption == "in_sales"){
            $sql = "SELECT u.employeeid, u.username, u.contactno, u.usertype,c_t.cash_total, a_t.account_total, SUM(s_i.paid) AS paid 
                        FROM user u
                        LEFT JOIN 
                            (SELECT u.username, SUM(s_i.sub_total) cash_total FROM user u, sale_invoice s_i WHERE u.id = s_i.customer_name AND s_i.payment_type = 'Cash' AND order_date BETWEEN '$stdate' AND '$eddate' GROUP BY u.username ) c_t
                            ON u.username = c_t.username
                        LEFT JOIN 
                            (SELECT u.username, SUM(s_i.sub_total) account_total FROM user u, sale_invoice s_i WHERE u.id = s_i.customer_name AND s_i.payment_type = 'Account' AND order_date BETWEEN '$stdate' AND '$eddate' GROUP BY u.username ) a_t
                            ON u.username = a_t.username
                        LEFT JOIN sale_invoice s_i
                            ON u.id = s_i.customer_name
                         WHERE order_date BETWEEN '$stdate' AND '$eddate'
                         GROUP BY u.username " . $a["limit"];
            $resultType = 1;
        }

        else if($selectType == "user_wise" && $selectOption == "in_purchases"){
            $sql = "SELECT b.brand_name,b.s_contactno,b.address, SUM(i.sub_total) AS sub_total, SUM(i.paid) AS paid 
            FROM brands b,invoice i 
            WHERE b.bid = i.customer_name AND order_date BETWEEN '$stdate' AND '$eddate' AND i.payment_type = 'Cash'
            GROUP BY b.brand_name " . $a["limit"];
            $resultType = 2;
        }

        if($selectType == "product_wise" && $selectOption == "in_sales"){
            $sql = "SELECT p.product_name,c.category_name ,b.brand_name ,SUM(s_d.qty) AS total_sales, p.product_stock 
            FROM products p, categories c , brands b , sale_details s_d , sale_invoice s_i
            WHERE p.cid = c.cid AND p.bid = b.bid AND p.pid = s_d.product_name AND s_d.invoice_no = s_i.invoice_no AND s_i.order_date BETWEEN '$stdate' AND '$eddate'
            GROUP BY p.product_name " . $a["limit"];
            $resultType = 3;
        }

        else if($selectType == "product_wise" && $selectOption == "in_purchases"){
            $sql = "SELECT p.product_name,c.category_name ,b.brand_name ,SUM(i_d.qty) AS total_purchase, p.product_stock 
            FROM products p, categories c , brands b , invoice_details i_d , invoice i
            WHERE p.cid = c.cid AND p.bid = b.bid AND p.pid = i_d.product_name AND i_d.invoice_no = i.invoice_no AND i.order_date BETWEEN '$stdate' AND '$eddate'
            GROUP BY p.product_name " . $a["limit"];
            $resultType = 4;
        }


        $result = $this->con->query($sql) or die($this->con->error);
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return ["rows" => $rows, "pagination" => $a["pagination"], "resultType" => $resultType];

    }

    public function viewSummaryWithPagination($stdate, $eddate, $id, $pno)
    {
        $a = $this->pagination($this->con, "sale_invoice", $pno, 10);

        $sql = "SELECT s_i.invoice_no,s_i.order_date,s_i.sub_total,s_i.discount,s_i.paid,s_i.payment_type,u.employeeid
		FROM user u,sale_invoice s_i 
		WHERE s_i.customer_name = '$id' AND u.id = s_i.cashier AND order_date BETWEEN '$stdate' AND '$eddate'  ORDER BY s_i.invoice_no DESC " . $a["limit"];

        $result = $this->con->query($sql) or die($this->con->error);
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return ["rows" => $rows, "pagination" => $a["pagination"]];

    }

    private function pagination($con, $table, $pno, $n)
    {
        $query = $con->query("SELECT COUNT(*) as rows FROM " . $table);
        $row = mysqli_fetch_assoc($query);
        //$totalRecords = 100000;
        $pageno = $pno;
        $numberOfRecordsPerPage = $n;

        $last = ceil($row["rows"] / $numberOfRecordsPerPage);

        $pagination = "<ul class='pagination'>";

        if ($last != 1) {
            if ($pageno > 1) {
                $previous = $pageno - 1;
                $pagination .= "<li class='page-item'><a class='page-link' pn='" . $previous . "' href='#' style='color:#333;'> Previous </a></li></li>";
            }
            for ($i = $pageno - 5; $i < $pageno; $i++) {
                if ($i > 0) {
                    $pagination .= "<li class='page-item'><a class='page-link' pn='" . $i . "' href='#'> " . $i . " </a></li>";
                }

            }
            $pagination .= "<li class='page-item'><a class='page-link' pn='" . $pageno . "' href='#' style='color:#333;'> $pageno </a></li>";
            for ($i = $pageno + 1; $i <= $last; $i++) {
                $pagination .= "<li class='page-item'><a class='page-link' pn='" . $i . "' href='#'> " . $i . " </a></li>";
                if ($i > $pageno + 4) {
                    break;
                }
            }
            if ($last > $pageno) {
                $next = $pageno + 1;
                $pagination .= "<li class='page-item'><a class='page-link' pn='" . $next . "' href='#' style='color:#333;'> Next </a></li></ul>";
            }
        }
        //LIMIT 0,10
        //LIMIT 20,10
        $limit = "LIMIT " . ($pageno - 1) * $numberOfRecordsPerPage . "," . $numberOfRecordsPerPage;

        return ["pagination" => $pagination, "limit" => $limit];
    }

    public function deleteRecord($table, $pk, $id)
    {
        if ($table == "categories") {
            $pre_stmt = $this->con->prepare("SELECT " . $id . " FROM categories WHERE parent_cat = ?");
            $pre_stmt->bind_param("i", $id);
            $pre_stmt->execute();
            $result = $pre_stmt->get_result() or die($this->con->error);
            if ($result->num_rows > 0) {
                return "DEPENDENT_CATEGORY";
            } else {
                $pre_stmt = $this->con->prepare("DELETE FROM " . $table . " WHERE " . $pk . " = ?");
                $pre_stmt->bind_param("i", $id);
                $result = $pre_stmt->execute() or die($this->con->error);
                if ($result) {
                    return "CATEGORY_DELETED";
                }
            }
        } else {
            $pre_stmt = $this->con->prepare("DELETE FROM " . $table . " WHERE " . $pk . " = ?");
            $pre_stmt->bind_param("i", $id);
            $result = $pre_stmt->execute() or die($this->con->error);
            if ($result) {
                return "DELETED";
            }
        }
        return "Something went Wrong";
    }


    public function getSingleRecord($table, $pk, $id)
    {
        $pre_stmt = $this->con->prepare("SELECT * FROM " . $table . " WHERE " . $pk . "= ? LIMIT 1");
        $pre_stmt->bind_param("i", $id);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        $row = 0;
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        }
        return $row;
    }

    /**
     * @param $table
     * @param $where
     * @param $fields
     * @return string
     */
    public function update_record($table, $where, $fields)
    {
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            // id = '5' AND m_name = 'something'
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        foreach ($fields as $key => $value) {
            //UPDATE table SET m_name = '' , qty = '' WHERE id = '';
            $sql .= $key . "='" . $value . "', ";
        }
        $sql = substr($sql, 0, -2);
        $sql = "UPDATE " . $table . " SET " . $sql . " WHERE " . $condition;
        if (mysqli_query($this->con, $sql)) {
            return "UPDATED";
        }
        else return "Something went Wrong";
    }


    public function storeCustomerOrderInvoice($orderdate, $cust_name, $ar_tqty, $ar_qty, $ar_price, $ar_tpid, $sub_total, $discount, $paid, $payment_type, $cashier, $typ)
    {

        if ($typ == "purchase") {
            $pre_stmt = $this->con->prepare("INSERT INTO 
			`invoice`(`customer_name`, `order_date`, `sub_total`,
			 `discount`, `paid`, `payment_type`,`cashier`) VALUES (?,?,?,?,?,?,?)");
            $pre_stmt->bind_param("ssdddss", $cust_name, $orderdate, $sub_total, $discount, $paid, $payment_type, $cashier);
            $pre_stmt->execute() or die($this->con->error);
            $invoice_no = $pre_stmt->insert_id;
            if ($invoice_no != null) {
                for ($i = 0; $i < count($ar_price); $i++) {

                    //Here we are finding the remaining quantity after buying from supplier
                    $rem_qty = $ar_tqty[$i] + $ar_qty[$i]; //purchase increased

                    $insert_product = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`)
					VALUES (?,?,?,?)");
                    $insert_product->bind_param("isdd", $invoice_no, $ar_tpid[$i], $ar_price[$i], $ar_qty[$i]);
                    $insert_product->execute() or die($this->con->error);

                    if ($rem_qty < 0) {
                        return "ORDER_FAIL_TO_COMPLETE";
                    } else {
                        //Update Product stock
                        $sql = "UPDATE products SET product_stock = '$rem_qty' WHERE pid = '" . $ar_tpid[$i] . "'";
                        $this->con->query($sql);
                    }
                }
                return $invoice_no;
            }
        }
        if ($typ == "sale") {
            $pre_stmt = $this->con->prepare("INSERT INTO 
			`sale_invoice`(`customer_name`, `order_date`, `sub_total`,
			 `discount`, `paid`, `payment_type`,`cashier`) VALUES (?,?,?,?,?,?,?)");
            $pre_stmt->bind_param("ssdddss", $cust_name, $orderdate, $sub_total, $discount, $paid, $payment_type, $cashier);
            $pre_stmt->execute() or die($this->con->error);
            $invoice_no = $pre_stmt->insert_id;
            if ($invoice_no != null) {
                for ($i = 0; $i < count($ar_price); $i++) {

                    //Here we are finding the remaining quantity after giving customer
                    $rem_qty = $ar_tqty[$i] - $ar_qty[$i]; //sale decreased

                    $insert_product = $this->con->prepare("INSERT INTO `sale_details`(`invoice_no`, `product_name`, `price`, `qty`)
					VALUES (?,?,?,?)");
                    $insert_product->bind_param("isdd", $invoice_no, $ar_tpid[$i], $ar_price[$i], $ar_qty[$i]);
                    $insert_product->execute() or die($this->con->error);

                    if ($rem_qty < 0) {
                        return "ORDER_FAIL_TO_COMPLETE";
                    } else {
                        //Update Product stock
                        $sql = "UPDATE products SET product_stock = '$rem_qty' WHERE pid = '" . $ar_tpid[$i] . "'";
                        $this->con->query($sql);
                    }
                }
                return $invoice_no;
            }
        }
        return "Something went Wrong";
    }
}

//$obj = new Manage();
//echo "<pre>";
//print_r($obj->manageRecordWithPagination("categories",1));
//echo $obj->deleteRecord("categories","cid",14);
//print_r($obj->getSingleRecord("categories","cid",1));
//echo $obj->update_record("categories",["cid"=>1],["parent_cat"=>0,"category_name"=>"Electro","status"=>1]);
