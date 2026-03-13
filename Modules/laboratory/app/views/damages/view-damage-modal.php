
<div class="modal fade" tabindex="-1" id="viewDamageModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-th-large me-2"></i>Damage Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">

                <img src="projector.png" class="img-fluid mb-4" style="max-width:180px;">

                <div class="text-start px-3">

                    <p class="mb-2">
                        <strong class="text-secondary" id="damage_id">Code</strong><br>
                    </p>

                    <p class="mb-2">
                        <strong class="text-secondary" id="damage_category">Category</strong><br>
                        
                    </p>

                    <p class="mb-2">
                        <strong class="text-secondary" id="damage_code">Item Code</strong><br>
                    </p>

                    <p class="mb-2">
                        <strong class="text-secondary" id="damage_description">Description</strong><br>
                    </p>

                    <p class="mb-2">
                        <strong class="text-secondary">Status</strong><br>
                        <span class="badge bg-danger">Unfixed</span>
                    </p>

                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>

        </div>
    </div>
</div>