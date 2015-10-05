<!-- Edit modal -->
<div class="modal fade" id="deleteStudentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete ucenik</h4>
            </div>
            <div class="modal-body">
                <form id="form-delete-student" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                    <div class="form-group">
                        <label>Da li ste sigurni da zelite obrisati ucenika?</label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Ne</button>
                        <button type="button" class="btn btn-primary btn-submit" data-formid="form-delete-student">Da</button>
                    </div>
                    <input type="hidden" name="student_id" id="student_id" value="">
                    <input type="hidden" name="modal_delete" id="modal_delete" value="delete_student">
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->