<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $id_instructor = $_GET['id_instructor'];

    $queryDelete = mysqli_query($config, "DELETE FROM instructor_major WHERE id = $id");
    if ($queryDelete) {
        header("location:?page=tambah-instructor-major&id=" . $id_instructor . "&hapus=berhasil");
    } else {
        header("location:?page=tambah-instructor-major&id=" . $id_instructor . "&hapus=berhasil");
    }
}

$edit = isset($_GET['edit']) ? $_GET['edit'] : '';
$id_instructor = isset($_GET['id']) ? $_GET['id'] : '';
if (isset($_POST['id_major'])) {
    $id_major = $_POST['id_major'];
    if (isset($_GET['edit'])) {
        $update = mysqli_query($config, "UPDATE instructor_major SET id_major='$id_major' WHERE id='$edit'");
        header("location:?page=tambah-instructor-major&id=" . $id_instructor . "&ubah=berhasil");
    } else {
        $insert = mysqli_query($config, "INSERT INTO `instructor_major`(`id_major`, `id_instructor`) VALUES ('$id_major', '$id_instructor')");
        header("location:?page=tambah-instructor-major&id=" . $id_instructor . "&tambah=berhasil");
    }
}


$queryMajors = mysqli_query($config, "SELECT * FROM majors ORDER BY id DESC");
$rowMajors = mysqli_fetch_all($queryMajors, MYSQLI_ASSOC);

$queryInstructor = mysqli_query($config, "SELECT * FROM instructors WHERE id='$id_instructor'");
$rowInstructor = mysqli_fetch_assoc($queryInstructor);

$queryInstructorMajor = mysqli_query($config, "SELECT majors.name, instructor_major.id, id_instructor FROM instructor_major LEFT JOIN majors ON majors.id = instructor_major.id_major WHERE id_instructor ='$id_instructor' ORDER BY instructor_major.id DESC");
$rowInstructorMajor = mysqli_fetch_all($queryInstructorMajor, MYSQLI_ASSOC);

$queryEdit = mysqli_query($config, "SELECT * FROM instructor_major WHERE id ='$edit'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> Instructor Major : <?php echo $rowInstructor['name'] ?> </h5>
                <!-- form edit -->
                <?php if (isset($_GET['edit'])): ?>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Major Name</label>
                                <select name="id_major" id="" class="form-control">
                                    <option value="">Select One</option>
                                    <?= (isset($_GET['edit']) && isset($rowEdit['edit']) && $rowEdit['edit'] == 0) ? 'selected' : ''  ?>
                                    <?php foreach ($rowMajors as $rowMajor): ?>
                                        <option <?php echo ($rowMajor['id'] == $rowEdit['id_major']) ? 'selected' : '' ?> value="<?php echo $rowMajor['id'] ?>"><?php echo $rowMajor['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    <!-- end form edit -->
                <?php else: ?>
                    <div align="right">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Instructor Major
                        </button>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Major Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($rowInstructorMajor as $index => $rowInstructorMajors): ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowInstructorMajors['name'] ?></td>
                                    <td> <a href="?page=tambah-instructor-major&id=<?php echo $rowInstructorMajors['id_instructor'] ?>&edit=<?php echo $rowInstructorMajors['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a onclick="return confirm ('Are you sure?')" href="?page=tambah-instructor-major&delete=<?php echo $rowInstructorMajors['id'] ?>&id_instructor=<?php echo $rowInstructorMajors['id_instructor'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php endif ?>

                <!-- listing table -->



                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Instructor Major</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="">Major Name</label>
                                        <select name="id_major" id="" class="form-control">
                                            <option value="">Select One</option>
                                            <?php foreach ($rowMajors as $rowMajor): ?>
                                                <option value="<?php echo $rowMajor['id'] ?>"><?php echo $rowMajor['name'] ?></option>
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
            </div>
        </div>
    </div>
</div>