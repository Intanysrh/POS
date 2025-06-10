<?php
include 'config/koneksi.php';
$id_user = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
$id_role = isset($_SESSION['ID_ROLE']) ? $_SESSION['ID_ROLE'] : '';

$rowStudent = mysqli_fetch_assoc(mysqli_query($config, "SELECT * FROM students WHERE id='$id_user'"));
$id_major = $rowStudent['id_major'];

if ($id_role == 2) {
    $where = "WHERE moduls.id_major='$id_major'";
} elseif ($id_role == 1) {
    $where = "WHERE moduls.id_instructor='$id_user'";
   
}
$query = mysqli_query($config, "SELECT majors.name as major_name, instructors.name as instructor_name, moduls.* FROM moduls LEFT JOIN majors ON majors.id = moduls.id_major LEFT JOIN instructors ON instructors.id = moduls.id_instructor $where ORDER BY moduls.id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Modul</h5>
                <?php if ($id_role == 1): ?>
                    <div class="mb-3" align="right">
                        <a href="?page=tambah-modul" class="btn btn-primary">Add Modul</a>
                    </div>
                <?php endif ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Instructor</th>
                                <th>Major</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($row as $index => $data): ?>
                                <tr>
                                    <td><?php echo $index += 1; ?></td>
                                    <td><a href="?page=tambah-modul&detail=<?php echo $data['id'] ?>">
                                            <i class="bi bi-link"></i>
                                            <?php echo $data['name'] ?>
                                        </a></td>
                                    <td><?php echo $data['instructor_name'] ?></td>
                                    <td><?php echo $data['major_name'] ?></td>
                                    <td>
                                        <a href="?page=tambah-modul&edit=<?php echo $data['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a onclick="return confirm ('Are you sure?')" href="?page=tambah-modul&delete=<?php echo $data['id'] ?>" class="btn btn-warning btn-sm">Delete</a>
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