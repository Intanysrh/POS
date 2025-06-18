<?php
if (isset($_GET['delete'])) {
    $id_categories = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "DELETE FROM categories WHERE id = $id_categories");
    if ($queryDelete) {
        header("location:?page=categories&hapus=berhasil");
    } else {
        header("location:?page=categories&hapus=gagal");
    }
}

if (isset($_POST['name'])) {
    // jika ada parameter bernama edit, maka jalankan perintah edit/update. Kalo tidak ada, mnaka tambahkan data baru/insert.
    $name = $_POST['name'];
    $id_categories = isset($_GET['edit']) ? $_GET['edit'] : '';

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO categories (name) VALUES('$name')");
        header("location:?page=categories&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE categories SET name = '$name' WHERE id = '$id_categories'");
        header("location:?page=categories&ubah=berhasil");
    }
}

$id_categories = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM categories WHERE id='$id_categories'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="casrd-title">Add Category</h5>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Category *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter category" value="<?php echo isset($rowEdit['name']) ? ($rowEdit['name']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save" value="save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>