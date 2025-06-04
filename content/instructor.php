<?php
include 'config/koneksi.php';
$query = mysqli_query($config, "SELECT * FROM instructors ORDER BY id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!-- name	gender	education	phone	email	address	 -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Instructors</h5>
                <div class="mb-3" align="right">
                    <a href="?page=tambah-instructor" class="btn btn-primary">Add Instructor</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Education</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($row as $index => $data): ?>
                                <tr>
                                    <td><?php echo $index += 1; ?></td>
                                    <td><?php echo $data['name'] ?></td>
                                    <td><?php echo $data['gender'] == 1 ? 'Women' : 'Man' ?></td>
                                    <td><?php echo $data['education'] ?></td>
                                    <td><?php echo $data['phone'] ?></td>
                                    <td><?php echo $data['email'] ?></td>
                                    <td><?php echo $data['address'] ?></td>
                                    <td>
                                        <a href="?page=tambah-instructor-major&id=<?php echo $data['id'] ?>" class="btn btn-warning btn-sm">Add Major</a>
                                        <a href="?page=tambah-instructor&edit=<?php echo $data['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a onclick="return confirm ('Are you sure?')" href="?page=tambah-instructor&delete=<?php echo $data['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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