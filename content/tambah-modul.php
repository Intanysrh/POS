<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $queryModulsDetails = mysqli_query($config, "SELECT file FROM moduls_details WHERE id_modul='$id'");
    $rowModulsDetails = mysqli_fetch_assoc($queryModulsDetails);
    unlink("upload/" . $rowModulsDetails['file']);

    $queryDelete = mysqli_query($config, "DELETE FROM moduls_details WHERE id_modul = '$id'");
    $queryDelete = mysqli_query($config, "DELETE FROM moduls WHERE id = '$id'");
    if ($queryDelete) {
        header("location:?page=moduls&hapus=berhasil");
    } else {
        header("location:?page=moduls&hapus=gagal");
    }
}

// if (isset($_POST['name'])) { // jika ada parameter bernama edit, maka jalankan perintah edit/update. Kalo tidak ada, mnaka tambahkan data baru/insert.
//     $name = $_POST['name'];
//     $id_major = isset($_GET['edit']) ? $_GET['edit'] : '';

//     if (!isset($_GET['edit'])) {
//         $insert = mysqli_query($config, "INSERT INTO majors (name) VALUES('$name')");
//         header("location:?page=major&tambah=berhasil");
//     } else {
//         $update = mysqli_query($config, "UPDATE majors SET name = '$name' WHERE id = '$id_major'");
//         header("location:?page=major&ubah=berhasil");
//     }
// }

$id_instructor = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
$queryInstructorMajor = mysqli_query($config, "SELECT majors.name, instructor_major.* FROM instructor_major LEFT JOIN majors ON majors.id = instructor_major.id_major WHERE instructor_major.id_instructor = '$id_instructor'");

$rowInstructorMajors = mysqli_fetch_all($queryInstructorMajor, MYSQLI_ASSOC);
// print_r($rowInstructorMajors);
// die;

$id_major = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM majors WHERE id='$id_major'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

$id_modul = isset($_GET['detail']) ? $_GET['detail'] : '';
$queryModul = mysqli_query($config, "SELECT majors.name as major_name, instructors.name as instructor_name, moduls.* FROM moduls LEFT JOIN majors ON majors.id = moduls.id_major LEFT JOIN instructors ON instructors.id = moduls.id_instructor WHERE moduls.id='$id_modul'");
$rowModul = mysqli_fetch_assoc($queryModul);

// query ke table detai modul
$queryDetailModul = mysqli_query($config, "SELECT * FROM moduls_details WHERE id_modul = '$id_modul'");
$rowDetailModul = mysqli_fetch_all($queryDetailModul, MYSQLI_ASSOC);

if (isset($_GET['download'])) {
    $file = $_GET['download'];
    $filePath = "uploads/" . $file;
    if (file_exists($filePath)) {
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . basename($filePath) . "");
        header("Expires:0");
        header("Cache-Control: must-revalidate");
        header("Progma: public");
        header("Content-Length:" . filesize($filePath) . "");
        ob_clean();
        flush();
        readfile($filePath);
        exit;
    }
}

if (isset($_POST['save'])) {
    $id_instructor = $_POST['id_instructor'];
    $id_major = $_POST['id_major'];
    $name = $_POST['name'];

    $insert = mysqli_query($config, "INSERT INTO moduls (id_instructor, id_major, name) VALUES('$id_instructor','$id_major','$name')");

    if ($insert) {
        $id_modul = mysqli_insert_id($config);
        foreach ($_FILES['file']['name'] as $index => $file) {
            // print_r($id_modul);
            // die;
            if ($_FILES['file']['error'][$index] == 0) {
                $name = basename($_FILES['file']['name'][$index]);
                $fileName = uniqid() . "-" . $name;
                $path = "uploads/";
                $targetPath = $path . $fileName;
                if (move_uploaded_file($_FILES['file']['tmp_name'][$index], $targetPath)) {
                    $insertModulDetail = mysqli_query($config, "INSERT INTO moduls_details (id_modul, file) VALUES ('$id_modul','$fileName')");
                }
            }
        }
        header("location:?page=moduls&tambah=berhasil");
    }
}

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="casrd-title" <?php echo isset($_GET['detail']) ? 'Edit' : 'Add' ?>>Modul</h5>

                <?php if (isset($_GET['detail'])): ?>
                    <!-- detail modul -->
                    <table class="table table-stripped">
                        <tr>
                            <th>Modul Name</th>
                            <th>:</th>
                            <td><?php echo $rowModul['name'] ?></td>
                            <th>Major</th>
                            <th>:</th>
                            <td><?php echo $rowModul['major_name'] ?></td>
                        </tr>
                        <th>Instructor</th>
                        <th>:</th>
                        <td><?php echo $rowModul['instructor_name'] ?></td>
                    </table>
                    <br>
                    <br>
                    <table class="table table-b">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rowDetailModul as $index => $rowDetailModul): ?>
                                <tr>
                                    <td><?php echo $index += 1; ?></td>
                                    <td><a target="_blank" href="?page=tambah-modul&download=<?php echo urlencode($rowDetailModul['file']) ?>">
                                            <?php echo $rowDetailModul['file'] ?>
                                            <i class="bi bi-download"></i>
                                        </a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <!-- form tambah modul -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Instructor Name *</label>
                                    <input readonly value="<?php echo $_SESSION['NAME'] ?>" type="text" class="form-control">
                                    <input type="hidden" name="id_instructor" value="<?php echo $_SESSION['ID_USER'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Modul Name *</label>
                                    <input type="text" name="name" id="" value="" placeholder="Enter Modul Name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Major Name</label>
                                    <select name="id_major" id="" class="form-control" required>'
                                        <option value="">Select One</option>
                                        <?php foreach ($rowInstructorMajors as $data): ?>
                                            <option value="<?= $data['id_major'] ?>"><?= $data['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div align="right" class="mb-3">
                                <button type="button" class="btn btn-primary addRow">Add Row</button>
                            </div>
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

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

<script>
    // var, let, const, var: ketika nilainya tidak ada tidak error, kalo let harus mempunyai nilai.
    // const: nilai tidak boleh berubah. ex: 
    // const name = bambang;
    // name = reza;
    //  ini tuh salah karena nilai nya beda.

    // const button = document.getElementById('addRow');
    // const button = document.getElementsByClassName('addRow');
    const button = document.querySelector('.addRow');
    const tbody = document.querySelector('#myTable tbody');
    // const button = document.querySelector('#button');
    // button.textContent = "Duarrr";
    // button.style.color = "red";

    button.addEventListener("click", function() {
        // alert('duar');
        const tr = document.createElement('tr');
        tr.innerHTML = `<td><input type='file' name='file[]'></td><td>Delete</td>`;

        tbody.appendChild(tr);
    });
</script>