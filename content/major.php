<?php
include 'config/koneksi.php';
$query = mysqli_query($config, "SELECT * FROM majors ORDER BY id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Major</h5>
                <div class="mb-3" align="right">
                    <a href="?page=tambah-major" class="btn btn-primary">Add Major</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Major</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($row as $index => $data): ?>
                                <tr>
                                    <td><?php echo $index += 1; ?></td>
                                    <td><?php echo $data['name'] ?></td>
                                    <td>
                                        <a href="?page=tambah-major&edit=<?php echo $data['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a onclick="return confirm ('Are you sure?')" href="?page=tambah-major&delete=<?php echo $data['id'] ?>" class="btn btn-warning btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>