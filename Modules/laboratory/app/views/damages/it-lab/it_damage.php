<?php include __DIR__ . '/../../includes/sidebar.php'; ?>
<?php include __DIR__ . '/../../includes/header.php'; ?>



<main class="main-content">
    <div class="container-fluid px-4">
        <h1 class="h3 mb-2 text-gray-800">Damages</h1>
        <p class="mb-4">IT Lab 1 Laboratory</p>

        <div class="card mb-4 card shadow-sm border-0 border-top border-4 border-secondary shadow-lg p-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Damage Equipment
                </div>

                <a href="create.php" class="btn btn-primary btn-sm" id="crimAddDamageBtn" data-bs-toggle="modal" data-bs-target="#crimAddDamageModal">
                    <i class="fas fa-plus me-1"></i> Create New
                </a>
            </div>
            <div class="card-body">
                <table id="labEquipmentTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Laboratory</th>
                            <th>Issue</th>
                            <th>Reported By</th>
                            <th>Date Reported</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mouse</td>
                            <td>IT Lab 1</td>
                            <td>
                                <span class="badge bg-danger">Damaged</span>
                            </td>
                            <td>John Doe</td>
                            <td>2023-10-01</td>
                            <td>Item is not working properly.</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="view.php?id=1" id="psychoViewDamageBtn" data-bs-toggle="modal" data-bs-target="#crimViewDamageModal">
                                                <i class="fas fa-eye me-2"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="edit.php?id=1" id="psychoEditDamageBtn" data-bs-toggle="modal" data-bs-target="#crimEditDamageModal">
                                                <i class="fas fa-edit me-2"></i> Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="delete.php?id=1"
                                                onclick="return confirm('Are you sure you want to delete this record?')">
                                                <i class="fas fa-trash me-2"></i> Delete
                                            </a>
                                        </li>
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



<script>
    $(document).ready(function() {
        $('#labEquipmentTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
        });
    });
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>