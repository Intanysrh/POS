<?php
if (isset($_GET['delete'])) {
    $id_user = isset($_GET['delete']) ? $_GET['delete'] : '';
    $queryDelete = mysqli_query($config, "UPDATE users SET deleted_at=1 WHERE id = $id_user");
    if ($queryDelete) {
        header("location:?page=user&hapus=berhasil");
    } else {
        header("location:?page=user&hapus=gagal");
    }
}

if (isset($_POST['name'])) {
    // jika ada parameter bernama edit, maka jalankan perintah edit/update. Kalo tidak ada, mnaka tambahkan data baru/insert.
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = isset($_POST['password']) ? sha1($_POST['password']) : '';
    $id_user = isset($_GET['edit']) ? $_GET['edit'] : '';

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO users (name, email, password) VALUES('$name','$email','$password')");
        header("location:?page=user&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = '$id_user'");
        header("location:?page=user&ubah=berhasil");
    }
}

$queryRoles = mysqli_query($config, "SELECT * FROM user_roles ORDER BY id DESC");
$rowRoles = mysqli_fetch_all($queryRoles, MYSQLI_ASSOC);

$queryUserRoles = mysqli_query($config, "SELECT user_roles.*, roles.name FROM user_roles LEFT JOIN roles ON user_roles.id_role=roles.id ORDER BY user_roles.id DESC");
$rowUserRoles = mysqli_fetch_all($queryUserRoles, MYSQLI_ASSOC);

$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM users WHERE id='$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['id_role'])) {
    $id_role = $_POST['id_role'];
    $insert = mysqli_query($config, "INSERT INTO user_roles (id_role, id_user) VALUES('$id_role', '$id_user')");
    header("location:?page=tambah-user&add-user-role=" . $id_user . "add-role-berhasil");
}

$queryProducts = mysqli_query($config, "SELECT * FROM products ORDER BY id DESC");
$rowProducts = mysqli_fetch_all($queryProducts, MYSQLI_ASSOC);

// BUAT NO TRANSACTION
$queryNoTrans = mysqli_query($config, "SELECT MAX(id) as id_trans FROM transactions");
$rowNoTrans = mysqli_fetch_assoc($queryNoTrans);
$id_trans = $rowNoTrans['id_trans'];
$id_trans++;

// if(mysqli_num_rows($queryNoTrans)>0){
//     $id_trans=$rowNoTrans['$id_trans']+1;
// } else{
//     $id_trans=1;
// }

$format_no = "TR";
$date = date("dmy");
$increment_number = sprintf("%03s", $id_trans);
$no_transaction = $format_no . "-" . $date . "-" . $increment_number;
// $no_transaction=$format_no."-".$data."-".STR_PAD_LEFT);
$no_transaction = "TR" . "-" . date("dmy") . "-" . $increment_number;

if (isset($_POST['save'])) {
    $id_product = $_POST['id_product'];
    $id_user = $_POST['id_user'];
    $grand_total = $_POST['grand_total'];

    $insertTransaction = mysqli_query($config, "INSERT INTO transactions (no_transaction, id_user, sub_total) VALUES ('$no_transaction', '$id_user', '$grand_total')");

    if ($insertTransaction) {
        $last_id = mysqli_insert_id($config);
        $id_products = $_POST['id_product'];
        $qtys = $_POST['qty'];
        $totals = $_POST['total'];
        foreach ($_POST['id_product'] as $key => $value) {
            $id_product = $value;
            $total = $totals[$key];
            // Insert into transaction_details
            mysqli_query($config, "INSERT INTO transaction_details (id_transaction, id_product, qty, total) VALUES ('$last_id', '$id_product', '$qty', '$total')");
        }
        header("location:?page=pos&success=berhasil");
    } else {
        header("location:?page=pos&error=gagal");
    }
}

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <?php if (isset($_GET['add-user-role'])):
                    $title = "Add User Role: ";
                elseif (isset($_GET['edit'])):
                    $title = "Edit User";
                else:
                    $title = "Add User";
                endif; ?>
                <h5 class="card-title"><?php echo $title ?></h5>
                <?php if (isset($_GET['add-user-role'])): ?>
                    <div align="right" class="mb-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Transaction</button>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowUserRoles as $index => $rowUserRole): ?>
                                <tr>
                                    <td><?php echo $index = 1 ?></td>
                                    <td><?php echo $rowUserRole['name'] ?></td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                                        <a onclick="return confirm('Are you sure?')" href="" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="">No Transaction *</label>
                                    <input type="text" class="form-control" name="no_transaction" value="<?= $no_transaction ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Product</label>
                                    <select name="" id="id_product" class="form-control">
                                        <option value="">Select One</option>
                                        <?php foreach ($rowProducts as $key => $data): ?>
                                            <option value="<?php echo $data['id'] ?>" data-price="<?php echo $data['price'] ?>"><?php echo $data['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="">Cashier *</label>
                                    <input value="<?php echo $_SESSION['NAME'] ?>" type="text" class="form-control" readonly>
                                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['ID_USER'] ?>">
                                </div>
                            </div>
                        </div>

                        <div align="right" class="mb-3">
                            <button type="button" class="btn btn-primary addRow">Add Row</button>
                        </div>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <br>
                        <p>
                            <strong>Grand Total : Rp <span id="grandTotal"></span></strong>
                        <div class="mb-3">
                            <input type="hidden" name="grand_total" id="grandTotalInput" value=0>
                        </div>
                        </p>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-success" name="save" value="save">
                        </div>
                    </form>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- 
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
</div> -->

<script>
    const button = document.querySelector('.addRow');
    const tbody = document.querySelector('#myTable tbody');
    const select = document.querySelector('#id_product');

    let no = 1;
    button.addEventListener("click", function() {
        const selectedProduct = select.options[select.selectedIndex];
        const productValue = selectedProduct.value;
        if (!productValue) {
            alert("Please select a product first!");
            return;
        }

        const productName = selectedProduct.textContent;
        const productPrice = selectedProduct.dataset.price;

        const tr = document.createElement('tr');
        tr.innerHTML = `
        <td>${no}</td>
        <td><input type='hidden' name='id_product[]' class='id_products' value='${productValue}'>${productName}</td>
        <td>
            <input type='number' name='qty[]' value='1' class='qtys'>
            <input type='hidden' class='priceInput' name='price[]' value='${productPrice}'>
        </td>
        <td><input type='hidden' name='total[]' class='totals' value='${productPrice}'><span class='totalText'>${productPrice}</span></td>
        <td>
        <button type='button' class='btn btn-danger btn-sm removeRow'>Delete</button>
        </td>
        `;

        tbody.appendChild(tr);
        no++;
        select.value = "";

        updateGrandTotal();

    });

    tbody.addEventListener('click', function(e) {
        if (e.target.classList.contains('removeRow')) {
            e.target.closest("tr").remove();
        }

        updateNumber()

    });

    function updateGrandTotal() {
        const totalCells = tbody.querySelectorAll('.totals');
        let grand = 0;

        totalCells.forEach(function(input) {
            grand += parseInt(input.value) || 0;
        });
        grandTotal.textContent = grand.toLocaleString('id-ID');
        grandTotalInput.value = grand;
    }

    tbody.addEventListener('input', function(e) {
        if (e.target.classList.contains('qtys')) {
            const row = e.target.closest("tr");
            const qty = parseInt(e.target.value) || 0;
            const price = parseInt(row.querySelector('.priceInput').value);

            row.querySelector('.totalText').textContent = price * qty;
            row.querySelector('.totals').value = price * qty;
            updateGrandTotal();
        }
    });

    function updateNumber() {
        const rows = tbody.querySelectorAll("tr");
        console.log(rows);

        rows.forEach(function(row, index) {
            console.log(index);
            row.cells[0].textContent = index + 1;
        });

        no = rows.length + 1;
    }
</script>