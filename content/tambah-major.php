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

$id_major = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM majors WHERE id='$id_major'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="casrd-title">Add Major</h5>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Major *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your major" value="<?php echo isset($rowEdit['name']) ? ($rowEdit['name']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save" value="save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>