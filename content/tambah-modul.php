<?php
if (isset($_GET['delete'])) {
    $id_major = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "DELETE FROM majors WHERE id = $id_major");
    if ($queryDelete) {
        header("location:?page=major&hapus=berhasil");
    } else {
        header("location:?page=major&hapus=gagal");
    }
}

if (isset($_POST['name'])) {
    // jika ada parameter bernama edit, maka jalankan perintah edit/update. Kalo tidak ada, mnaka tambahkan data baru/insert.
    $name = $_POST['name'];
    $id_major = isset($_GET['edit']) ? $_GET['edit'] : '';

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO majors (name) VALUES('$name')");
        header("location:?page=major&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE majors SET name = '$name' WHERE id = '$id_major'");
        header("location:?page=major&ubah=berhasil");
    }
}

$id_instructor = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
$queryInstructorMajor = mysqli_query($config, "SELECT majors.name, instructor_major.* FROM instructor_major LEFT JOIN majors ON majors.id = instructor_major.id_major WHERE instructor_major.id_instructor = '$id_instructor'");

$rowInstructorMajors = mysqli_fetch_all($queryInstructorMajor, MYSQLI_ASSOC);
// print_r($rowInstructorMajors);
// die;

$id_major = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM majors WHERE id='$id_major'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="casrd-title" <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?>>Modul</h5>

                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Instructor Name *</label>
                                <input readonly value="<?php echo $_SESSION['NAME'] ?>" type="text" class="form-control">
                                <input type="hidden" name="id_instructor" value="<?php echo $_SESSION['ID_USER'] ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Major Name</label>
                                <select name="id_major" id="" class="form-control">
                                    <option value="">Select One</option>
                                    <?php foreach ($rowInstructorMajors as $row): ?>
                                        <option value="<?php echo $row['id_major'] ?>"><?php echo $row['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save" value="save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>