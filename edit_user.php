<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $work = $_POST['work'];
    $family_members = $_POST['family_members'];

    $query = "UPDATE users SET fullname=?, email=?, role=?, address=?, mobile=?, work=?, family_members=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $fullname, $email, $role, $address, $mobile, $work, $family_members, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User updated successfully!";
        header("Location: manage_users.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update user.";
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Edit User</h2>
        <div class="card p-4 shadow-lg">
            <form action="edit_user.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="fullname" class="form-control" value="<?php echo $user['fullname']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control">
                        <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $user['address']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mobile No</label>
                    <input type="text" name="mobile" class="form-control" value="<?php echo $user['mobile']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Work</label>
                    <input type="text" name="work" class="form-control" value="<?php echo $user['work']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Family Members</label>
                    <input type="number" name="family_members" class="form-control" value="<?php echo $user['family_members']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
            <div class="mt-3 text-center">
                <a href="manage_users.php" class="btn btn-secondary">Back to Manage Users</a>
            </div>
        </div>
    </div>
</body>
</html>
