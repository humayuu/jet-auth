<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="#">Dashboard</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-center gap-2">

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('profile.show') }}">
                                Manage Profile
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">
                                    Logout
                                </button>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <!-- Profile Card -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8 col-md-10">

                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">

                        <h3 class="text-center text-primary fw-bold mb-4">
                            Profile Settings
                        </h3>

                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            <div class="mb-4">
                                @livewire('profile.update-profile-information-form')
                            </div>
                        @endif

                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <hr>
                            <div class="my-4">
                                @livewire('profile.update-password-form')
                            </div>
                        @endif

                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <hr>
                            <div class="my-4">
                                @livewire('profile.two-factor-authentication-form')
                            </div>
                        @endif

                        <hr>
                        <div class="my-4">
                            @livewire('profile.logout-other-browser-sessions-form')
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <hr>
                            <div class="mt-4">
                                @livewire('profile.delete-user-form')
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
