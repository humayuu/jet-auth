<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">

            <h3 class="text-center mb-4">Profile Info</h3>

            <form method="POST" action="{{ route('admin.profile.update') }}">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="name"
                        placeholder="Enter full name" autofocus value="{{ $admin->name }}">
                </div>

                <div class="mb-4">
                    <label for="emailAddress" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="emailAddress" name="email"
                        placeholder="Enter email" value="{{ $admin->email }}">
                </div>

                <div class="mb-4">
                    <label for="" class="form-label">User Image</label>
                    <input type="file" class="form-control" name="image">
                    <img src="{{ asset('images/' . $admin->profile_photo_path) }}" alt="">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark px-4">Back</a>
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                </div>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
