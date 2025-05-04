<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-12/assets/css/login-12.css">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
      <div class="row justify-content-center align-items-center">

        <!-- Logo -->
        <div class="col-md-4 text-center mb-4 mb-md-0">
          <img src="{{ asset('Asset/logoPtGraha.png') }}" alt="Logo PT Graha" class="img-fluid" style="max-height: 150px;">
        </div>

        <!-- Login Form -->
        <div class="col-md-4 col-lg-4"> <!-- Mengurangi lebar kolom -->
          <div class="border p-4 shadow-sm rounded bg-white">
            <h2 class="text-center mb-4">Login</h2>
            <form action="" method="POST">
              @csrf
              <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                <label for="email">Email</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required>
                <label for="password">Password</label>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-dark btn-lg rounded-0">Sign in</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
</body>
</html>
