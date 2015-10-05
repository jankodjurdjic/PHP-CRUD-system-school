<!-- Edit school  -->

<div class="modal fade" id="editSchoolModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit skola</h4>
            </div>
            <div class="modal-body">
                <form id="form-edit-school" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                    <div class="form-group">
                        <input class="form-control" type="text" id="name-edit" name="name" value="" placeholder="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="jib-edit" name="jib" value="" placeholder="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="address-edit" name="address" value="" placeholder="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="phone-edit" name="phone" value="" placeholder="">
                    </div>
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="modal_edit" id="modal_edit" value="edit_school">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- ATTENTION ON NEXT COMMENT LINE SIMANIC!!!! -->
                <!-- Here is the new thing, this button has class btn-submit and click event on that class selector in myScript.js file written in jquery and that event make submit of form which is included in modal, I forgot how to do that in javascript -->
                <button type="button" class="btn btn-primary btn-submit" data-formid="form-edit-school">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>