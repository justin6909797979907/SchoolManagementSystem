<?php include '../includes/sidebar.php'; ?>
<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="/SchoolManagementSystem/assets/css/style.css">

<main class="main-content">
    <div class="container-fluid px-4">
        <h1 class="h3 mb-2 text-gray-800">Laboratory</h1>
        <p class="mb-4">Barrowed Equipment</p>

        <div class="card shadow-lg border-0 border-top border-4 border-secondary mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i> Barrowed Equipment
                </div>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDamageModal">
                    <i class="fas fa-plus me-1"></i> Create New
                </button>
            </div>

            <div class="card-body">
                <table id="barrowedTable" class="table table-striped table-bordered table-hover" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Date Created</th>
                            <th>Category</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2024-03-27 14:25</td>
                            <td>Optical</td>
                            <td>OP-001</td>
                            <td>
                                <span class="badge bg-success">Fixed</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="view.php?id=1"><i class="fas fa-eye me-2"></i>View</a></li>
                                        <li><a class="dropdown-item" href="edit.php?id=1"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="delete.php?id=1" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Add New Damage Modal -->
<div class="modal fade" id="addDamageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus-square me-2"></i> Add New Damage
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="store_damage.php" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Item</label>
                        <select class="form-select" name="item_id" required>
                            <option value="">Please select item here</option>
                            <option value="1">Microscope</option>
                            <option value="2">Beaker</option>
                            <option value="3">Test Tube</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="Unfixed" selected>Unfixed</option>
                            <option value="Fixed">Fixed</option>
                        </select>
                    </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>

            </form>

        </div>
    </div>
</div>

<script src="../js/pagination.js"></script>
<?php include '../includes/footer.php'; ?>