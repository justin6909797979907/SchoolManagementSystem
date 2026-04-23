<?php include  __DIR__ . '/../../../includes/sidebar.php'; ?>
<?php include  __DIR__ . '/../../../includes/header.php'; ?>


<main class="main-content">
    <div class="container-fluid px-4">
        <h1 class="h3 mb-2 text-gray-800">Monitoring</h1>
        <p class="mb-4">IT Laboratory 3</p>

        <div class="card mb-4 card shadow-sm border-0 border-top border-4 border-secondary shadow-lg p-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Monitoring
                </div>

                <a href="#" class="btn btn-primary btn-sm" id="crimInventoryBtn">
                    <i class="fas fa-plus me-1"></i> Create New
                </a>
            </div>
            <div class="card-body">
                <table id="crimEquipmentTable" class="table table-striped table-bordered" style="width:100%">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item</th>
                            <th>Laboratory</th>
                            <th>Condition</th>
                            <th>Last Checked</th>
                            <th>Checked By</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody> 
                        <tr>
                            <td>1</td>
                            <td>Test</td>
                            <td>IT Laboratory 3</td>
                            <td>Working</td>
                            <td>April 1, 2026</td>
                            <td>John Doe</td>
                            <td>Item is functioning properly.</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button class="dropdown-item crimViewBtn" data-id="<?= $inventory['id'] ?>">
                                                 <i class="fas fa-eye me-2"></i> View
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item crimEdit" data-id="<?= $inventory['id'] ?>">
                                                <i class="fas fa-edit me-2"></i> Edit
                                            </button>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <li><a class="dropdown-item text-danger deleteBtn" data-id="<?= $inventory['id'] ?>"><i class="fas fa-trash me-2"></i>Delete</a></li>
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



<script>
    $(document).ready(function() {
        $('#crimEquipmentTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
        });
    });
</script>

<!-- <?php require __DIR__ . '/crimAdd-inventory-modal.php'; ?>
<?php require __DIR__ . '/crimView-inventory-modal.php'; ?>
<?php require __DIR__ . '/crimEdit-inventory-modal.php'; ?> -->


<?php include  __DIR__ . '/../../../includes/footer.php'; ?>