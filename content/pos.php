<?php
$query = mysqli_query($config, "SELECT users.name, transactions.* FROM transactions LEFT JOIN users ON users.id=transactions.id_user ORDER BY id DESC");

$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $idDel = $_GET['delete'];

    $del = mysqli_query($config, "DELETE FROM transactions WHERE id='$idDel'");
    if ($del) {
        header("location:?page=pos");
        exit();
    }
}

if (isset($_POST['add_transaction'])) {
    header("location:?page=tambah-pos");
}

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Transaction</h5>
                <div align="right" class="mb-3">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="add_transaction">Add Transaction</button>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No Transaction</th>
                            <th>Cashier Name</th>
                            <th>Sub Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $index => $row): ?>
                            <tr>
                                <td><?php echo $index = 1 ?></td>
                                <td><?php echo $row['no_transaction'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo "Rp " . $row['sub_total'] ?></td>
                                <td>
                                    <a href="?page=print-pos&print=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Print</a>
                                    <a onclick="return confirm('Are you sure?')" href="?page=pos&delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm" name="delete">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <!-- <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Full Name *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?php echo isset($rowEdit['name']) ? ($rowEdit['name']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Email *</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php echo isset($rowEdit['email']) ? ($rowEdit['email']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Password *</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password" <?php echo empty($_GET['edit']) ? 'required' : '' ?>>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save" value="save">
                    </div>
                </form> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Role : </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Role Name</label>
                        <select name="id_role" id="" class="form-control">
                            <option value="">Select One</option>
                            <?php foreach ($rowRoles as $rowRole): ?>
                                <option value="<?php echo $rowRole['id'] ?>"><?php echo $rowRole['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>