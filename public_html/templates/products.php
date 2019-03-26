<!-- Modal -->
<div class="modal fade" id="form_products" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="product_form" onsubmit="return false">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Date</label>
                            <label for="added_date"></label><input type="text" class="form-control" name="added_date"
                                                                   id="added_date" value="<?php echo date("Y-m-d"); ?>"
                                                                   readonly/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="product_name" id="product_name"
                                   placeholder="Enter Item Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category </label>
                        <label for="select_cat2"></label><select class="form-control" id="select_cat2"
                                                                 name="select_cat2" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <label for="select_brand2"></label><select class="form-control" id="select_brand2"
                                                                   name="select_brand2" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Item Price</label>
                        <input type="text" class="form-control" id="product_price" name="product_price"
                               placeholder="Enter Price of the item" required/>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" class="form-control" id="product_qty" name="product_qty"
                               placeholder="Enter Quantity" required/>
                    </div>
                    <button type="submit" class="btn btn-success">Add Product</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>