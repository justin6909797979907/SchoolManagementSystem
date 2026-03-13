<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Equipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form action="update.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="1">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" value="Optical">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total</label>
                            <input type="number" class="form-control" name="total" value="10">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Available</label>
                            <input type="number" class="form-control" name="available" value="5">
                        </div>

                        <div class="col-md-6 mb-3">
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