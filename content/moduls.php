<?php
include 'config/koneksi.php';
$query = mysqli_query($config, "SELECT majors.name as major_name, instructors.name as instructor_name, moduls.* FROM moduls LEFT JOIN majors ON majors.id = moduls.id_major LEFT JOIN instructors ON instructors.id = moduls.id_instructor ORDER BY moduls.id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Modul</h5>
                <div class="mb-3" align="right">
                    <a href="?page=tambah-modul" class="btn btn-primary">Add Modul</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Instructor</th>
                                <th>Major</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($row as $index => $data): ?>
                                <tr>
                                    <td><?php echo $index += 1; ?></td>
                                    <td><?php echo $data['name'] ?></td>
                                    <td><?php echo $data['email'] ?></td>
                                    <td>
                                        <a href="?page=tambah-user&edit=<?php echo $data['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a onclick="return confirm ('Are you sure?')" href="?page=tambah-user&delete=<?php echo $data['id'] ?>" class="btn btn-warning btn-sm">Delete</a>
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