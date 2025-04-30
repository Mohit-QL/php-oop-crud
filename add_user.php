<?php
session_start();

include 'config/database.php';
$obj = new Query();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [];

    foreach ($_POST as $key => $value) {
        $data[$key] = trim($value);
    }

    $insert = $obj->insertData('users', $data);

    if ($insert) {
        $_SESSION['success'] = "User added successfully!";
    } else {
        $_SESSION['error'] = "Failed to add user.";
    }
    header("Location: index.php");
    exit;
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <div class="my-5 px-3">
        <?php if (!empty($message)): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= $message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h2 class="mb-0">Add User</h2>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="index.php" class="btn btn-primary">View Users</a>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="add_user.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="phone" name="phone" id="phone" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add User</button>
                    </form>

                </div>


                </form>
            </div>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>