<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Novi ucenik</h4>
            </div>
            <div class="modal-body">
                <form id="form-edit-student" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                    <div class="form-group">
                        <input class="form-control" type="text" id="name" name="name" value="" placeholder="Upisite ime ucenika">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="surname" name="surname" value="" placeholder="Upisite prezime ucenika">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="years" name="years" value="" placeholder="Upisite staros ucenika">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="schools" name="schools">
                            <? foreach($schools as $school) : ?>
                                <option value="<?=$school['skola_id'] ?>"><?=$school['skola_naziv']; ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="modal_new" id="modal_new" value="new_student">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- ATTENTION ON NEXT COMMENT LINE SIMANIC!!!! -->
                <!-- Here is the new thing, this button has class btn-submit and click event on that class selector in myScript.js
                 file written in jquery and that event make submit of form which is included in modal, I forgot how to do that in javascript -->
                <button type="button" class="btn btn-primary btn-submit" data-formid="form-edit-student">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->