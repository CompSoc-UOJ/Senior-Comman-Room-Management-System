<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");

//For Registration Processsing
if (isset($_POST["employeeid"]) AND isset($_POST["email"])) {
    $user = new User();
    $result = $user->createUserAccount($_POST["title"], $_POST["firstname"], $_POST["lastname"], $_POST["employeeid"], $_POST["email"], $_POST["contactno"], $_POST["password1"], $_POST["usertype"], $_POST["status"]);
    echo $result;
    exit();
}

//For Login Processing
if (isset($_POST["log_email"]) AND isset($_POST["log_password"])) {
    $user = new User();
    $result = $user->userLogin($_POST["log_email"], $_POST["log_password"]);
    echo $result;
    exit();
}

//Fetch People
if (isset($_POST["getPeople"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("user");
    foreach ($rows as $row) {
        if ($row["status"] == 1) {
            echo "<option value='" . $row["id"] . "'>" . $row["employeeid"] . "</option>";
        }
    }
    exit();
}

//To get Category
if (isset($_POST["getCategory"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("categories");
    foreach ($rows as $row) {
        echo "<option value='" . $row["cid"] . "'>" . $row["category_name"] . "</option>";
    }
    exit();
}

//Fetch Brand
if (isset($_POST["getBrand"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("brands");
    foreach ($rows as $row) {
        echo "<option value='" . $row["bid"] . "'>" . $row["brand_name"] . "</option>";
    }
    exit();
}

//Add Category
if (isset($_POST["category_name"]) AND isset($_POST["parent_cat2"])) {
    $obj = new DBOperation();
    $result = $obj->addCategory($_POST["parent_cat2"], $_POST["category_name"]);
    echo $result;
    exit();
}

//Add Brand
if (isset($_POST["address"])) {
    $obj = new DBOperation();
    $result = $obj->addBrand($_POST["brand_name"],
        $_POST["s_contactno"],
        $_POST["address"]);
    echo $result;
    exit();
}

//Add Product
if (isset($_POST["added_date"]) AND isset($_POST["product_name"])) {
    $obj = new DBOperation();
    $result = $obj->addProduct($_POST["select_cat2"],
        $_POST["select_brand2"],
        $_POST["product_name"],
        $_POST["product_price"],
        $_POST["product_qty"],
        $_POST["added_date"]);
    echo $result;
    exit();
}

//Manage Category
if (isset($_POST["manageCategory"])) {
    $m = new Manage();
    $result = $m->manageRecordWithPagination("categories", $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10) + 1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["category"]; ?></td>
                <td><?php echo $row["parent"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
                    <a href="#" eid="<?php echo $row['cid']; ?>" data-toggle="modal" data-target="#form_update_category"
                       class="btn btn-info btn-sm edit_cat">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr>
            <td colspan="5"><?php echo $pagination; ?></td>
        </tr>
        <?php
        exit();
    }
}


//Delete Category
if (isset($_POST["deleteCategory"])) {
    $m = new Manage();
    $result = $m->deleteRecord("categories", "cid", $_POST["id"]);
    echo $result;
}

//Update Category
if (isset($_POST["updateCategory"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("categories", "cid", $_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update Record after getting data
if (isset($_POST["update_category"])) {
    $m = new Manage();
    $id = $_POST["cid"];
    $name = $_POST["update_category"];
    $parent = $_POST["parent_cat"];
    $result = $m->update_record("categories", ["cid" => $id], ["parent_cat" => $parent, "category_name" => $name, "status" => 1]);
    echo $result;
}

//------------------Brand---------------------

//Manage Brand
if (isset($_POST["manageBrand"])) {
    $m = new Manage();
    $result = $m->manageRecordWithPagination("brands", $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10) + 1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td><?php echo $row["s_contactno"]; ?></td>
                <td><?php echo $row["address"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm del_brand">Delete</a>
                    <a href="#" eid="<?php echo $row['bid']; ?>" data-toggle="modal" data-target="#form_update_brand"
                       class="btn btn-info btn-sm edit_brand">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr>
            <td colspan="5"><?php echo $pagination; ?></td>
        </tr>
        <?php
        exit();
    }
}

//Delete
if (isset($_POST["deleteBrand"])) {
    $m = new Manage();
    $result = $m->deleteRecord("brands", "bid", $_POST["id"]);
    echo $result;
}

//Update Brand
if (isset($_POST["updateBrand"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("brands", "bid", $_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update Record after getting data
if (isset($_POST["update_brand"])) {
    $m = new Manage();
    $id = $_POST["bid"];
    $name = $_POST["update_brand"];
    $s_contactno = $_POST["update_s_contactno"];
    $address = $_POST["update_address"];
    $result = $m->update_record("brands", ["bid" => $id], ["brand_name" => $name, "s_contactno" => $s_contactno, "address" => $address, "status" => 1]);
    echo $result;
}

//----------------Products---------------------

if (isset($_POST["manageProduct"])) {
    $m = new Manage();
    $result = $m->manageRecordWithPagination("products", $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10) + 1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["category_name"]; ?></td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td><?php echo $row["product_price"]; ?></td>
                <td><?php echo $row["product_stock"]; ?></td>
                <td><?php echo $row["added_date"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
                    <a href="#" eid="<?php echo $row['pid']; ?>" data-toggle="modal" data-target="#update_product_form"
                       class="btn btn-info btn-sm edit_product">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr>
            <td colspan="5"><?php echo $pagination; ?></td>
        </tr>
        <?php
        exit();
    }
}

//Delete
if (isset($_POST["deleteProduct"])) {
    $m = new Manage();
    $result = $m->deleteRecord("products", "pid", $_POST["id"]);
    echo $result;
}

//Update Product
if (isset($_POST["updateProduct"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("products", "pid", $_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update Record after getting data
if (isset($_POST["update_product"])) {
    $m = new Manage();
    $id = $_POST["pid"];
    $name = $_POST["update_product"];
    $cat = $_POST["select_cat"];
    $brand = $_POST["select_brand"];
    $price = $_POST["product_price"];
    $qty = $_POST["product_qty"];
    $date = $_POST["added_date"];
    $result = $m->update_record("products", ["pid" => $id], ["cid" => $cat, "bid" => $brand, "product_name" => $name, "product_price" => $price, "product_stock" => $qty, "added_date" => $date]);
    echo $result;
}

//-------------------------Order Processing--------------

if (isset($_POST["getNewOrderItem"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("products");
    ?>
    <tr>
        <td><b class="number">1</b></td>
        <td>
            <select class="form-control form-control-sm pid" name="pid[]" required>
                <option value="">Choose Item</option>
                <?php
                foreach ($rows as $row) {
                    ?>
                    <option value="<?php echo $row['pid']; ?>"><?php echo $row["product_name"]; ?></option><?php
                }
                ?>
            </select>
        </td>
        <td>
            <input class="form-control form-control-sm tqty" name="tqty[]" readonly type="text">
        </td>
        <td>
            <input class="form-control form-control-sm qty" name="qty[]" required type="number">
        </td>
        <td>
            <input class="form-control form-control-sm price" name="price[]" readonly type="text">
        </td>
        <td>
            <input class="form-control form-control-sm amt" name="amt[]" readonly type="text">
        </td>
        <td><input class="form-control form-control-sm tpid" name="tpid[]" type="hidden"></td>
        <td><input class="form-control form-control-sm pro_name" name="pro_name[]" type="hidden"></td>
    </tr>
    <?php
    exit();
}

if (isset($_POST["manageOrder"])) {
    $m = new Manage();
    $result = $m->manageRecordWithPagination("sale_details", $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10) + 1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["price"]; ?></td>
                <td><?php echo $row["qty"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["order_date"]; ?></td>
                <td><?php echo $row["payment_type"]; ?></td>
                <td><?php echo $row["invoice_no"]; ?></td>

                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_order">Delete</a>
                    <a href="#" eid="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#"
                       class="btn btn-info btn-sm edit_order">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr>
            <td colspan="5"><?php echo $pagination; ?></td>
        </tr>
        <?php
        exit();
    }
}

//Delete Sale
if (isset($_POST["deleteOrder"])) {
    $m = new Manage();
    $result = $m->deleteRecord("sale_details", "id", $_POST["id"]);
    echo $result;
}

//-------------------------Order and Purchase Processing--------------

//Get price and qty of one item
if (isset($_POST["getPriceAndQty"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("products", "pid", $_POST["id"]);
    echo json_encode($result);
    exit();
}

if (isset($_POST["order_date"]) AND isset($_POST["cust_name"])) {

    //Now getting array from order_form
    $orderdate = $_POST["order_date"];
    $cust_name = $_POST["cust_name"]; // supplierID or saleID
    $ar_tpid = $_POST["tpid"];
    $ar_pro_name = $_POST["pro_name"]; //will not use
    $ar_tqty = $_POST["tqty"];
    $ar_qty = $_POST["qty"];
    $ar_price = $_POST["price"];
    $sub_total = $_POST["sub_total"];
    // $gst = $_POST["gst"];
    $discount = $_POST["discount"];
    // $net_total = $_POST["net_total"];
    $paid = $_POST["paid"];
    // $due = $_POST["due"];
    $payment_type = $_POST["payment_type"];
    $cashier = $_POST["cashier"];
    $typ = $_POST["typ"];
    $m = new Manage();
    echo $result = $m->storeCustomerOrderInvoice($orderdate, $cust_name, $ar_tqty, $ar_qty, $ar_price, $ar_tpid, $sub_total, $discount, $paid, $payment_type, $cashier, $typ);

}

//----------------People---------------------

if (isset($_POST["managePeople"])) {
    $m = new Manage();
    $result = $m->manageRecordWithPagination("user", $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10) + 1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["employeeid"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["contactno"]; ?></td>
                <td><?php echo $row["usertype"]; ?></td>
                <td><?php echo $row["register_date"]; ?></td>
                <td><?php echo $row["last_login"]; ?></td>
                <td>
                    <?php
                    if ($row["status"] == '1') {
                        ?>
                        <a href='#' eid='<?php echo $row['id']; ?>' class='btn btn-success btn-sm active'>Active</a>
                        <?php
                    } else if ($row["status"] == '0') {
                        ?>
                        <a href='#' eid='<?php echo $row['id']; ?>' class='btn btn-warning btn-sm pending'>Pending</a>
                        <?php
                    }
                    ?>
                </td>
                <td><?php echo $row["notes"]; ?></td>
                <td>
                    <a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_people">Delete</a>
                    <a href="#" eid="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#form_update_people"
                       class="btn btn-info btn-sm edit_people">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr>
            <td colspan="5"><?php echo $pagination; ?></td>
        </tr>
        <?php
        exit();
    }
}

//Delete People
if (isset($_POST["deletePeople"])) {
    $m = new Manage();
    $result = $m->deleteRecord("user", "id", $_POST["id"]);
    echo $result;
}

//Update People status
if (isset($_POST["updatePeopleStatus"])) {
    $m = new Manage();
    $st = $_POST["updatePeopleStatus"];
    $id = $_POST["id"];
    $result = $m->update_record("user", ["id" => $id], ["status" => $st]);
    echo $result;
}

//Update People
if (isset($_POST["updatePeople"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("user", "id", $_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update Record after getting data
if (isset($_POST["update_name_people"]) AND isset($_POST["update_usertype"])) {
    $m = new User();
    $n = new Manage();
    $id = $_POST["id"];
    $name = $_POST["update_name_people"];
    $employeeid = $_POST["update_employeeid"];
    $cat = $_POST["update_email"];
    $contactno = $_POST["update_contactno"];
    $password = $_POST["password1"];
    $price = $_POST["update_usertype"];
    $date = date("Y-m-d");
    $qty = $_POST["update_notes"];
    $status = $_POST["update_status"];

    if($password !== ""){
        $pass_hash = $m->passwordEncrypt($password);
        $result = $n->update_record("user",["id" => $id], ["username" => $name, "employeeid" => $employeeid,"email" => $cat, "contactno" => $contactno, "password" => $pass_hash, "usertype" => $price,"register_date" => $date, "status" => $status, "notes" => $qty]);
        echo $result;
    } else {
        $result = $n->update_record("user",["id" => $id], ["username" => $name, "employeeid" => $employeeid,"email" => $cat, "contactno" => $contactno, "usertype" => $price,"register_date" => $date, "status" => $status, "notes" => $qty]);
        echo $result;
    }
}

//Update Me after getting data
if (isset($_POST["update_name_me"])) {
    $m = new User();
    $n = new Manage();
    $id = $_POST["id"];
    $name = $_POST["update_name_me"];
    $employeeid = $_POST["update_employeeid"];
    $cat = $_POST["update_email"];
    $contactno = $_POST["update_contactno"];
    $oldpassword = $_POST["oldPassword"];
    $password = $_POST["password1"];
    $date = date("Y-m-d");
    $qty = $_POST["update_notes"];
    $status = $_POST["update_status"];

    if($oldpassword !== "" || $password !== ""){
        if($m->passwordCheck($id, $oldpassword)){
            $pass_hash = $m->passwordEncrypt($password);
            $result = $n->update_record("user",["id" => $id], ["username" => $name, "employeeid" => $employeeid,"email" => $cat, "contactno" => $contactno, "password" => $pass_hash, "register_date" => $date, "status" => $status, "notes" => $qty]);
            echo $result;
        } else echo "old password does not match";
    } else {
        $result = $n->update_record("user",["id" => $id], ["username" => $name, "employeeid" => $employeeid,"email" => $cat, "contactno" => $contactno,"register_date" => $date, "status" => $status, "notes" => $qty]);
        echo $result;
    }
}

//----------------Purchase---------------------
if (isset($_POST["getNewPurchaseItem"]) AND isset($_POST["supplierID"])) {
    $supplierID = $_POST["supplierID"];
    $obj = new DBOperation();
    $rows = $obj->getAllItemsOfSupplier($supplierID);
    ?>
    <tr>
        <td><b class="number">1</b></td>
        <td>
            <select name="pid[]" class="form-control form-control-sm pid" required>
                <option value="">Choose Product</option>
                <?php
                foreach ($rows as $row) {
                    ?>
                    <option value="<?php echo $row['pid']; ?>"><?php echo $row["product_name"]; ?></option><?php
                }
                ?>
            </select>
        </td>
        <td>
            <input class="form-control form-control-sm tqty" name="tqty[]" readonly type="text">
        </td>
        <td>
            <input class="form-control form-control-sm qty" name="qty[]" onfocus="this.value=''" required
                   type="number">
        </td>
        <td>
            <input class="form-control form-control-sm price" name="price[]" onfocus="this.value=''" type="text">
        </td>
        <td>
            <input class="form-control form-control-sm amt" name="amt[]" readonly type="text">
        </td>
        <td><input class="form-control form-control-sm tpid" name="tpid[]" type="hidden"></td>
        <td><input class="form-control form-control-sm pro_name" name="pro_name[]" type="hidden"></td>
    </tr>
    <?php
    exit();
}

if (isset($_POST["managePurchase"])) {
    $m = new Manage();
    $result = $m->manageRecordWithPagination("invoice_details", $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10) + 1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["price"]; ?></td>
                <td><?php echo $row["qty"]; ?></td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td><?php echo $row["order_date"]; ?></td>
                <td><?php echo $row["payment_type"]; ?></td>
                <td><?php echo $row["invoice_no"]; ?></td>

                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_purchase">Delete</a>
                    <a href="#" eid="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#"
                       class="btn btn-info btn-sm edit_purchase">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr>
            <td colspan="5"><?php echo $pagination; ?></td>
        </tr>
        <?php
        exit();
    }
}

//Delete Purchase
if (isset($_POST["deletePurchase"])) {
    $m = new Manage();
    $result = $m->deleteRecord("invoice_details", "id", $_POST["id"]);
    echo $result;
}

//----------------Manage Summary---------------------
if (isset($_POST["manageSummary"])) {
    $m = new Manage();
    $result = $m->manageSummaryWithPagination($_POST["stdate"], $_POST["eddate"], $_POST["selectType"], $_POST["selectOption"], $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    $resultType = $result["resultType"];
    if($resultType == 1){
        ?>
        <thead>
        <tr>
            <th>#</th>
            <th>Employee ID</th>
            <th>Full Name</th>
            <th>Contact-No</th>
            <th>User Type</th>
            <th>Cash Total</th>
            <th>Account Total</th>
            <th>Total Pay</th>
        </tr>
        </thead>
        <?php
        if (count($rows) > 0) {
            $n = (($_POST["pageno"] - 1) * 10) + 1;
            foreach ($rows as $row) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $row["employeeid"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["contactno"]; ?></td>
                    <td><?php echo $row["usertype"]; ?></td>
                    <td><?php echo $row["cash_total"]; ?></td>
                    <td><?php echo $row["account_total"]; ?></td>
                    <td><?php echo $row["paid"]; ?></td>
                </tr>
                </tbody>

                <?php
                $n++;
            }
            ?>
            <tr>
                <td colspan="5"><?php echo $pagination; ?></td>
            </tr>
            <?php
            exit();
        }
    }
    if($resultType == 2){
        ?>
        <thead>
        <tr>
            <th>#</th>
            <th>Supplier Name</th>
            <th>Contact-No</th>
            <th>Address</th>
            <th>Total Cost</th>
            <th>Total Pay</th>
        </tr>
        </thead>
        <?php
        if (count($rows) > 0) {
            $n = (($_POST["pageno"] - 1) * 10) + 1;
            foreach ($rows as $row) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $row["brand_name"]; ?></td>
                    <td><?php echo $row["s_contactno"]; ?></td>
                    <td><?php echo $row["address"]; ?></td>
                    <td><?php echo $row["sub_total"]; ?></td>
                    <td><?php echo $row["paid"]; ?></td>
                </tr>
                </tbody>

                <?php
                $n++;
            }
            ?>
            <tr>
                <td colspan="5"><?php echo $pagination; ?></td>
            </tr>
            <?php
            exit();
        }
    }

    if($resultType == 3){
        ?>
        <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product Category</th>
            <th>Supplier</th>
            <th>Sale Qty</th>
            <th>In Stock</th>
        </tr>
        </thead>
        <?php
        if (count($rows) > 0) {
            $n = (($_POST["pageno"] - 1) * 10) + 1;
            foreach ($rows as $row) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["category_name"]; ?></td>
                    <td><?php echo $row["brand_name"]; ?></td>
                    <td><?php echo $row["total_sales"]; ?></td>
                    <td><?php echo $row["product_stock"]; ?></td>
                </tr>
                </tbody>

                <?php
                $n++;
            }
            ?>
            <tr>
                <td colspan="5"><?php echo $pagination; ?></td>
            </tr>
            <?php
            exit();
        }
    }

    if($resultType == 4){
        ?>
        <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product Category</th>
            <th>Supplier</th>
            <th>Purchased Qty</th>
            <th>In Stock</th>
        </tr>
        </thead>
        <?php
        if (count($rows) > 0) {
            $n = (($_POST["pageno"] - 1) * 10) + 1;
            foreach ($rows as $row) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["category_name"]; ?></td>
                    <td><?php echo $row["brand_name"]; ?></td>
                    <td><?php echo $row["total_purchase"]; ?></td>
                    <td><?php echo $row["product_stock"]; ?></td>
                </tr>
                </tbody>

                <?php
                $n++;
            }
            ?>
            <tr>
                <td colspan="5"><?php echo $pagination; ?></td>
            </tr>
            <?php
            exit();
        }
    }
}

//----------------View Summary---------------------
if (isset($_POST["viewSummary"])) {
    $m = new Manage();
    $result = $m->viewSummaryWithPagination($_POST["stdate"], $_POST["eddate"], $_POST["userid"], $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10) + 1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["invoice_no"]; ?></td>
                <td><?php echo $row["order_date"]; ?></td>
                <td><?php echo $row["sub_total"]; ?></td>
                <td><?php echo $row["discount"]; ?></td>
                <td><?php echo $row["paid"]; ?></td>
                <td><?php echo $row["payment_type"]; ?></td>
                <td><?php echo $row["employeeid"]; ?></td>
            </tr>
            <?php
            $n++;
        }
        ?>
        <tr>
            <td colspan="5"><?php echo $pagination; ?></td>
        </tr>
        <?php
        exit();
    }
}

//----------------Search---------------------
if (isset($_POST["query"]) AND isset($_POST["search_type"])) {
    $m = new Manage();
    $result = $m->searchWithPagination($_POST["query"], $_POST["search_type"], $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    $resultType = $result["resultType"];

    if($resultType == 1){ // categories
        ?>
        <thead>
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <?php
        if (count($rows) > 0) {
            $n = (($_POST["pageno"] - 1) * 10) + 1;
            foreach ($rows as $row) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $row["category"]; ?></td>
                    <td><?php echo $row["parent"]; ?></td>
                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
                        <a href="#" eid="<?php echo $row['cid']; ?>" data-toggle="modal" data-target="#form_update_category"
                           class="btn btn-info btn-sm edit_cat">Edit</a>
                    </td>
                </tr>
                </tbody>

                <?php
                $n++;
            }
            ?>
            <tr>
                <td colspan="5"><?php echo $pagination; ?></td>
            </tr>
            <?php
            exit();
        }
    }
    if($resultType == 2){ //products
        ?>
        <thead>
        <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Selling Price</th>
            <th>Available Stock</th>
            <th>Added Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <?php
        if (count($rows) > 0) {
            $n = (($_POST["pageno"] - 1) * 10) + 1;
            foreach ($rows as $row) {
                ?>
                <tbody>
                <tr>
                    <<td><?php echo $n; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["category_name"]; ?></td>
                    <td><?php echo $row["brand_name"]; ?></td>
                    <td><?php echo $row["product_price"]; ?></td>
                    <td><?php echo $row["product_stock"]; ?></td>
                    <td><?php echo $row["added_date"]; ?></td>
                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
                        <a href="#" eid="<?php echo $row['pid']; ?>" data-toggle="modal" data-target="#update_product_form"
                           class="btn btn-info btn-sm edit_product">Edit</a>
                    </td>
                </tr>
                </tbody>

                <?php
                $n++;
            }
            ?>
            <tr>
                <td colspan="5"><?php echo $pagination; ?></td>
            </tr>
            <?php
            exit();
        }
    }

    if($resultType == 3){ //invoice_details
        ?>
        <thead>
        <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Buying Price</th>
            <th>Buy Quantity</th>
            <th>Supplier Name</th>
            <th>Order Date</th>
            <!-- <th>Sub Total</th>
                    <th>Discount</th>
                    <th>Net Total</th>
                    <th>Paid</th>
                    <th>Due</th> -->
            <th>Payment Method</th>
            <th>Invoice ID</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <?php
        if (count($rows) > 0) {
            $n = (($_POST["pageno"] - 1) * 10) + 1;
            foreach ($rows as $row) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["qty"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["order_date"]; ?></td>
                    <td><?php echo $row["payment_type"]; ?></td>
                    <td><?php echo $row["invoice_no"]; ?></td>

                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_order">Delete</a>
                        <a href="#" eid="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#"
                           class="btn btn-info btn-sm edit_order">Edit</a>
                    </td>
                </tr>
                </tbody>

                <?php
                $n++;
            }
            ?>
            <tr>
                <td colspan="5"><?php echo $pagination; ?></td>
            </tr>
            <?php
            exit();
        }
    }

    if($resultType == 4){ //sale_details
        ?>
        <thead>
        <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Selling Price</th>
            <th>Sale Quantity</th>
            <th>Customer Name</th>
            <th>Sale Date</th>
            <!-- <th>Sub Total</th>
                    <th>Discount</th>
                    <th>Net Total</th>
                    <th>Paid</th>
                    <th>Due</th> -->
            <th>Payment Method</th>
            <th>Invoice ID</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <?php
        if (count($rows) > 0) {
            $n = (($_POST["pageno"] - 1) * 10) + 1;
            foreach ($rows as $row) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["qty"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["order_date"]; ?></td>
                    <td><?php echo $row["payment_type"]; ?></td>
                    <td><?php echo $row["invoice_no"]; ?></td>

                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_order">Delete</a>
                        <a href="#" eid="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#"
                           class="btn btn-info btn-sm edit_order">Edit</a>
                    </td>
                </tr>
                </tbody>

                <?php
                $n++;
            }
            ?>
            <tr>
                <td colspan="5"><?php echo $pagination; ?></td>
            </tr>
            <?php
            exit();
        }
    }

    if($resultType == 5){ //user
        ?>
        <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Employee ID</th>
            <th>Email</th>
            <th>Contact-No</th>
            <th>User Type</th>
            <th>Register Date</th>
            <th>Last Login</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>
        </thead>
        <?php
        if (count($rows) > 0) {
            $n = (($_POST["pageno"] - 1) * 10) + 1;
            foreach ($rows as $row) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["employeeid"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["contactno"]; ?></td>
                    <td><?php echo $row["usertype"]; ?></td>
                    <td><?php echo $row["register_date"]; ?></td>
                    <td><?php echo $row["last_login"]; ?></td>
                    <td>
                        <?php
                        if ($row["status"] == '1') {
                            ?>
                            <a href='#' eid='<?php echo $row['id']; ?>' class='btn btn-success btn-sm active'>Active</a>
                            <?php
                        } else if ($row["status"] == '0') {
                            ?>
                            <a href='#' eid='<?php echo $row['id']; ?>' class='btn btn-warning btn-sm pending'>Pending</a>
                            <?php
                        }
                        ?>
                    </td>
                    <td><?php echo $row["notes"]; ?></td>
                    <td>
                        <a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_people">Delete</a>
                        <a href="#" eid="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#form_update_people"
                           class="btn btn-info btn-sm edit_people">Edit</a>
                    </td>
                </tr>
                </tbody>

                <?php
                $n++;
            }
            ?>
            <tr>
                <td colspan="5"><?php echo $pagination; ?></td>
            </tr>
            <?php
            exit();
        }
    }

    if($resultType == 6){ //brands
        ?>
        <thead>
        <tr>
            <th>#</th>
            <th>Supplier Name</th>
            <th>Contact No</th>
            <th>Address</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <?php
        if (count($rows) > 0) {
            $n = (($_POST["pageno"] - 1) * 10) + 1;
            foreach ($rows as $row) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $row["brand_name"]; ?></td>
                    <td><?php echo $row["s_contactno"]; ?></td>
                    <td><?php echo $row["address"]; ?></td>
                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <a href="#" did="<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm del_brand">Delete</a>
                        <a href="#" eid="<?php echo $row['bid']; ?>" data-toggle="modal" data-target="#form_update_brand"
                           class="btn btn-info btn-sm edit_brand">Edit</a>
                    </td>
                </tr>
                </tbody>

                <?php
                $n++;
            }
            ?>
            <tr>
                <td colspan="5"><?php echo $pagination; ?></td>
            </tr>
            <?php
            exit();
        }
    }
}
?>
