<?php
if (isset($_GET['delete'])) {
    $id_role = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "DELETE FROM roles WHERE id = $id_role");
    if ($queryDelete) {
        header("location:?page=role&hapus=berhasil");
    } else {
        header("location:?page=role&hapus=gagal");
    }
}

if (isset($_POST['name'])) {
    // jika ada parameter bernama edit, maka jalankan perintah edit/update. Kalo tidak ada, mnaka tambahkan data baru/insert.
    $name = $_POST['name'];
    $id_role = isset($_GET['edit']) ? $_GET['edit'] : '';

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO roles (name) VALUES('$name')");
        header("location:?page=role&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE roles SET name = '$name' WHERE id = '$id_role'");
        header("location:?page=role&ubah=berhasil");
    }
}

$id_role = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM roles WHERE id='$id_role'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="casrd-title">Add Role</h5>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Role *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your role" value="<?php echo isset($rowEdit['name']) ? ($rowEdit['name']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save" value="save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>