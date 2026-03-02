<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/header.php'; ?>


<main class="main-content">
    <div class="container-fluid px-4">
        <h1 class="h3 mb-2 text-gray-800">IT Laboratory</h1>
        <p class="mb-4">Equipment List</p>

        <div class="card shadow-lg border-0 border-top border-4 border-secondary mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <i class="fas fa-table me-1"></i>
                Laboratory Equipment
            </div>
            <div class="card-body">
                <table id="labEquipmentTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Microscope</td>
                            <td>Optical</td>
                            <td>10</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Centrifuge</td>
                            <td>Mechanical</td>
                            <td>5</td>
                            <td>In Use</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<script>
    $(document).ready(function() {
        $('#labEquipmentTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 30, 40],
        });
    });
</script>
<?php include 'includes/footer.php'; ?>