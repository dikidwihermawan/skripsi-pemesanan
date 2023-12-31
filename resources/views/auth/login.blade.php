<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Samudera - Login</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="{{ asset('pic.jpg') }}" class="img-fluid" alt="Register"
                                    style="height: 392px;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Samudera Login!</h1>
                                        @if (session('success'))
                                            <h6 class="alert alert-success mb-4">You are registered now!</h6>
                                        @endif
                                    </div>
                                    <form action="{{ route('login') }}" method="POST" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="username"
                                                class="@error('username') is-invalid @enderror form-control form-control-user mb-2"
                                                id="exampleInputusername" aria-describedby="usernameHelp"
                                                value="{{ old('username') }}" placeholder="Enter username...">
                                            @error('username')
                                                <h6 class="mx-3 text-danger text-xs">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="@error('password') is-invalid @enderror form-control form-control-user mb-2"
                                                id="exampleInputPassword" placeholder="Password">
                                            @error('password')
                                                <h6 class="mx-3 text-danger text-xs">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            @error('messages')
                                                <h6 class="alert alert-danger text-xs">
                                                    {{ $message }}
                                                </h6>
                                            @enderror
                                            {{-- <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div> --}}
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block mb-2">
                                            Login
                                        </button>
                                    </form>
                                    <div class="d-flex justify-content-end text-xs mx-2">
                                        <a href="{{ route('register') }}" class="">Create a new account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
