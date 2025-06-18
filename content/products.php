<?php
include 'config/koneksi.php';
$query = mysqli_query($config, "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON categories.id = products.id_category ORDER BY id DESC");
// $query = mysqli_query($config, "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON categories.id = products.id_category ORDER BY products.id DESC");

$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!-- name	gender	education	phone	email	address	 -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Products</h5>
                <div class="mb-3" align="right">
                    <a href="?page=tambah-products" class="btn btn-primary">Add Product</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($row as $index => $data): ?>
                                <tr>
                                    <td><?php echo $index += 1; ?></td>
                                    <td><?php echo $data['category_name'] ?></td>
                                    <td><?php echo $data['name'] ?></td>
                                    <td><?php echo $data['price'] ?></td>
                                    <td><?php echo $data['qty'] ?></td>
                                    <td><?php echo $data['description'] ?></td>
                                    <td>
                                        <a href="?page=tambah-products&id=<?php echo $data['id'] ?>" class="btn btn-warning btn-sm">Add Product</a>
                                        <a href="?page=tambah-products&edit=<?php echo $data['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a onclick="return confirm ('Are you sure?')" href="?page=tambah-products&delete=<?php echo $data['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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