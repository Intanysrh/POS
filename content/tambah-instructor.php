<?php
if (isset($_GET['delete'])) {
    $id_instructor = $_GET['delete'];
    $queryDelete = mysqli_query($config, "DELETE FROM instructors WHERE id = $id_instructor");
    if ($queryDelete) {
        header("location:?page=instructor&hapus=berhasil");
    } else {
        header("location:?page=instructor&hapus=gagal");
    }
}

if (isset($_POST['name'])) {
    // jika ada parameter bernama edit, maka jalankan perintah edit/update. Kalo tidak ada, maka tambahkan data baru/insert.
    $name = $_POST['name'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : 0;
    $education = $_POST['education'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = isset($_POST['password']) ? sha1($_POST['password']) : '';
    $id_role = 5;
    $id_instructor = isset($_GET['edit']) ? $_GET['edit'] : '';

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO instructors (id_role, name, gender, education, phone, email, address, password) VALUES('$id_role', '$name', '$gender', '$education', '$phone', '$email', '$address', '$password')");
        header("location:?page=instructor&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE instructors SET id_role='$id_role',  name = '$name', gender = '$gender', education = '$education', phone = '$phone', email = '$email', address = '$address', password='$password' WHERE id = '$id_instructor'");
        header("location:?page=instructor&ubah=berhasil");
    }
}

$id_instructor = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM instructors WHERE id='$id_instructor'");
$rowEdit = mysqli_fetch_assoc($queryEdit);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Instructor</h5>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Full Name *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?php echo isset($rowEdit['name']) ? ($rowEdit['name']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Gender *</label>
                        <br>
                        <input type="radio" name="gender" value="0" <?= (isset($_GET['edit']) && isset($rowEdit['gender']) && $rowEdit['gender'] == 0) ? 'checked' : ''  ?> required>
                        <label for="male">Man</label>
                        <input type="radio" name="gender" value="1" <?= (isset($_GET['edit']) && isset($rowEdit['gender']) && $rowEdit['gender'] == 1) ? 'checked' : ''  ?> required>
                        <label for="female">Women</label>
                    </div>
                    <div class="mb-3">
                        <label for="">Education *</label>
                        <input type="text" class="form-control" name="education" placeholder="Enter your education" value="<?php echo isset($rowEdit['education']) ? ($rowEdit['education']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Phone *</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter your phone number" value="<?php echo isset($rowEdit['phone']) ? ($rowEdit['phone']) : ''; ?>" required>
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
                        <label for="">Address *</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter your address" value="<?php echo isset($rowEdit['address']) ? ($rowEdit['address']) : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save" value="save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>