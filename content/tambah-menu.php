<?php
if (isset($_GET['delete'])) {
    $id = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "DELETE FROM menus WHERE id = $id");
    if ($queryDelete) {
        header("location:?page=menu&hapus=berhasil");
    } else {
        header("location:?page=menu&hapus=gagal");
    }
}

if (isset($_POST['name'])) {
    // jika ada parameter bernama edit, maka jalankan perintah edit/update. Kalo tidak ada, mnaka tambahkan data baru/insert.
    $name = $_POST['name'];
    $icon = $_POST['icon'];
    $urutan = $_POST['urutan'];
    $url = $_POST['url'];
    $parent_id = $_POST['parent_id'];

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO menus (parent_id, name, icon, url, urutan) VALUES('$parent_id', '$name', '$icon', '$url', '$urutan')");
        header("location:?page=menu&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE menus SET name = '$name', parent_id='$parent_id', icon='$icon', urutan='$urutan', url='$url'  WHERE id = '$id'");
        header("location:?page=menu&ubah=berhasil");
    }
}

$queryParentId = mysqli_query($config, "SELECT * FROM menus WHERE parent_id = 0 OR parent_id=''");
$rowParentId = mysqli_fetch_all($queryParentId, MYSQLI_ASSOC);

// $id = isset($_GET['edit']) ? $_GET['edit'] : '';
// $queryEdit = mysqli_query($config, "SELECT * FROM mneus WHERE id='$id'");
// $rowEdit = mysqli_fetch_assoc($queryEdit);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="casrd-title">Add Menu</h5>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Name *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your menu" value="<?php echo isset($rowEdit['name']) ? ($rowEdit['name']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Parent Id</label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="">Select One</option>
                            <?php foreach ($rowParentId as $parentId): ?>
                                <option value="<?php echo $parentId['id'] ?>"><?php echo $parentId['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Icon *</label>
                        <input type="text" class="form-control" name="icon" placeholder="Enter your icon" value="<?php echo isset($rowEdit['icon']) ? ($rowEdit['icon']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="">URL</label>
                        <input type="text" class="form-control" name="url" placeholder="Enter your url" value="<?php echo isset($rowEdit['url']) ? ($rowEdit['url']) : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Order</label>
                        <input type="number" class="form-control" name="urutan" placeholder="Enter your order" value="<?php echo isset($rowEdit['urutan']) ? ($rowEdit['urutan']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save" value="save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>