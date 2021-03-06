<!-- Modal -->
<div class="modal fade" id="form_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="brand_form" onsubmit="return false">
                    <div class="form-group">
                        <label>Supplier Name</label>
                        <input type="text" class="form-control" name="brand_name" id="brand_name"
                               placeholder="Enter Supplier Name">
                        <small id="brand_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label>Contact No</label>
                        <input type="text" class="form-control" name="s_contactno" id="s_contactno"
                               placeholder="Enter Supplier Contact No">
                        <small id="scn_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" id="address"
                               placeholder="Enter Supplier Address">
                        <small id="adr_error" class="form-text text-muted"></small>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>