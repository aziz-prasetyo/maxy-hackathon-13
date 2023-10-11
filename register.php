<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container{
            margin-top: 70px;
        }
    </style>
</head>
<body>
    <nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="homepage.html"><img src="img/img.png" alt=""></a> 
    </div>
    </nav>

    <div class="container">
        <center><h1>Form Registrasi Akun</h1></center>
        <br>
        <form>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nama Lengkap">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Password</label>
                <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.">
            </div>
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Confirmation Password</label>
                <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Confirmation Password">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <div class="col text-end">Sudah memliki akun? <a href="login.html">Login</a></div>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</body>
</html>