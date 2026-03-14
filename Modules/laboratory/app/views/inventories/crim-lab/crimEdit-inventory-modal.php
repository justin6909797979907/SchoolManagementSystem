<div class="modal fade" id="crimEditModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit CRIM Equipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form id="editCrimForm">

                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" name="edit_category" id="edit_category">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total</label>
                            <input type="number" class="form-control" name="edit_total" id="edit_total">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Available</label>
                            <input type="number" class="form-control" name="edit_available" id="edit_available">
                        </div>
                        
                        <div class="col-md-6 mb-3" style="pointer-events: none; opacity: 0.5;">
                            <label class="form-label">Change Photo</label>
                            <input type="file" class="form-control" name="photo">
                        </div>

                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>