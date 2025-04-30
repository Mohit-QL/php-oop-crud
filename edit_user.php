<?php
session_start();

include 'config/database.php';
$obj = new Query();

$userId = $_GET['id'] ?? null;
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userId) {
    $updateUserData = $_POST;
    $updateUserData['id'] = $userId;

    $updateResult = $obj->editData('users', $updateUserData);

    if ($updateResult) {
        $_SESSION['success'] = "User updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update user.";
    }
    header("Location: index.php");
    exit;
}

$currentUser = null;
if ($userId) {
    $currentUser = $obj->getDataById('users', $userId);
    if (!$currentUser) {
        $message = "<p class='text-danger'>User not found.</p>";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit User</title>
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
                    <h2 class="mb-0">Edit User</h2>
                </div>
            </div>

            <?php if ($message) echo $message; ?>

            <div class="card shadow-sm">
                <div class="card-body">
                    <?php if ($currentUser): ?>
                        <form action="edit_user.php?id=<?php echo $userId; ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" required
                                    value="<?php echo htmlspecialchars($currentUser['name']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                    value="<?php echo htmlspecialchars($currentUser['email']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" required
                                    value="<?php echo htmlspecialchars($currentUser['phone']); ?>">
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="text-start mt-3">
                                    <button type="submit" class="btn btn-success me-3">Update User</button>
                                </div>
                                <div class="mt-3">
                                    <a href="index.php" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>