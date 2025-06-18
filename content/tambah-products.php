<?php
if (isset($_GET['delete'])) {
    $id_products = $_GET['id_product'];
    $queryDelete = mysqli_query($config, "DELETE FROM products WHERE id = $id_products");
    if ($queryDelete) {
        header("location:?page=product&hapus=berhasil");
    } else {
        header("location:?page=product&hapus=gagal");
    }
}

$id_products = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM products WHERE id='$id_products'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $id_category = $_POST['id_category'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO products (id_category, name, price, qty, description) VALUES ('$id_category', '$name', '$price', '$qty', '$description')");
        header("location:?page=products&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE products SET id_category='$id_category', name='$name', price='$price', qty='$qty', description='$description' WHERE id='$id_products'");
        header("location:?page=products&ubah=berhasil");
    }
}

$queryCategory = mysqli_query($config, "SELECT * FROM categories");
$rowCategories = mysqli_fetch_all($queryCategory, MYSQLI_ASSOC);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'Edit products' : 'Add products' ?> </h5>
                <form action="" method="post">
                    <!-- Category -->
                    <div class="mb-3">
                        <label for="" class="form-label">Category</label>
                        <select name="id_category" id="" class="form-control">
                            <option value="">Select One</option>
                            <?php foreach ($rowCategories as $key => $data): ?>
                                <option value="<?= $data['id'] ?>"
                                    <?= (isset($_GET['edit']) && $rowEdit['id_category'] == $data['id']) ? 'selected' : '' ?>>
                                    <?= $data['name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="">Name *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name" value="<?php echo isset($rowEdit['name']) ? ($rowEdit['name']) : ''; ?>" required>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="">Price *</label>
                        <input type="number" class="form-control" name="price" placeholder="Enter price" value="<?php echo isset($rowEdit['price']) ? ($rowEdit['price']) : ''; ?>" required>
                    </div>

                    <!-- QTY -->
                    <div class="mb-3">
                        <label for="">Qty *</label>
                        <input type="number" class="form-control" name="qty" placeholder="Enter quantity" value="<?php echo isset($rowEdit['qty']) ? ($rowEdit['qty']) : ''; ?>" required>
                    </div>
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control"><?= isset($_GET['edit']) ? $rowEdit['description'] : '' ?></textarea>
                    </div>
                    <!-- Submit Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>