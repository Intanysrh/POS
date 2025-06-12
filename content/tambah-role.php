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

if (isset($_GET['edit'])) {
    $id_roles = isset($_GET['edit']) ? $_GET['edit'] : '';
    $selectEdit = mysqli_query($config, "SELECT * FROM roles WHERE id=$id_roles");
    $rowEdit = mysqli_fetch_assoc($selectEdit);
}

if (isset($_GET['add-role-menu'])) {
    $id_role = $_GET['add-role-menu'];
    $rowEditRoleMenu = [];
    $rowEdit = [];
    $editRoleMenu = mysqli_query($config, "SELECT * FROM menu_roles WHERE id_roles='$id_role'");
    // $rowEditRoleMenu = mysqli_fetch_all($editRoleMenu, MYSQLI_ASSOC);
    while ($editMenu = mysqli_fetch_assoc($editRoleMenu)) {
        $rowEditRoleMenu[] = $editMenu['id_menu'];
    }
    $menus = mysqli_query($config, "SELECT * FROM menus ORDER BY parent_id, urutan");
    $rowMenu = [];
    while ($m = mysqli_fetch_assoc($menus)) {
        $rowMenu[] = $m;
    }
}

if (isset($_POST['save'])) {
    $id_roles = $_GET['add-role-menu'];
    $id_menus = $_POST['id_menus'] ?? [];
    mysqli_query($config, "DELETE FROM menu_roles WHERE id_roles ='$id_roles'");
    foreach ($id_menus as $m) {
        $id_menu = $m;
        mysqli_query($config, "INSERT INTO menu_roles(id_roles, id_menu) VALUE('$id_role','$id_menu')");
    }
    header("location:?page=tambah-role&add-role-menu=" . $id_role . "&tambah=berhasil");
}

$id_role = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM roles WHERE id='$id_role'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="casrd-title"><?php echo isset($rowEdit['id']) ? 'Edit' : 'Add' ?> Role</h5>
                <?php if (isset($_GET['add-role-menu'])): ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <ul>
                                <?php foreach ($rowMenu as $mainMenu): ?>
                                    <?php if ($mainMenu['parent_id'] == 0 or $mainMenu['parent_id'] == ""): ?>
                                        <li>
                                            <label for=""><input <?php echo in_array($mainMenu['id'], $rowEditRoleMenu) ? 'checked' : '' ?> type="checkbox" name="id_menus[]" value="<?php echo $mainMenu['id'] ?>"><?php echo $mainMenu['name'] ?></label>
                                            <ul>
                                                <?php foreach ($rowMenu as $subMenu): ?>
                                                    <?php if ($subMenu['parent_id'] == $mainMenu['id']): ?>
                                                        <li>
                                                            <label for=""><input type="checkbox" name="id_menus[]" value="<?php echo $subMenu['id'] ?>"><?php echo $subMenu['name'] ?></label>
                                                        </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit" name="save">Save Change</button>
                        </div>
                    </form>
                <?php else: ?>
                    <form action="" method="post">
                        <label for="">Role Name*</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your role" value="<?php echo isset($_GET['edit']) ? ($rowEdit['name']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-success" name="save" value="save">
            </div>
            </form>
        <?php endif ?>
        </div>
    </div>
</div>
</div>