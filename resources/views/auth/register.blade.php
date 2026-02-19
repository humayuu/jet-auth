<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100">
            <div class="col-md-6 col-lg-5 mx-auto">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">

                        <h3 class="text-center text-primary mb-4">User Register</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- Name -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="name@example.com" value="{{ old('name') }}" autofocus>
                                <label for="email">Name</label>
                            </div>

                            <!-- Email -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="name@example.com" value="{{ old('email') }}">
                                <label for="email">Email address</label>
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password"> <label for="password">Password</label>
                            </div>
                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password_confirmation"
                                    placeholder="Confirmed Password" name="password_confirmation"> <label
                                    for="password_confirmation">Confirm
                                    Password</label>
                            </div>
                            <!-- Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Register
                                </button>
                            </div>
                    </div>



                    </form>

                </div>
            </div>

            <p class="text-center mt-4 text-muted">
                © {{ date('Y') }} Your Company
            </p>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
