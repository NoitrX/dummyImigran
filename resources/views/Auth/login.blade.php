
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('auth/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{ asset('auth/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('auth/css/bootstrap.min.css')}}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('auth/css/style.css')}}">

    <title>LOGIN | AMS</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('auth/img/project.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="d-flex justify-content-center"  data-aos="fade-up">
            <img class="mb-5" style="height: 80px" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
          </div>
            <h3 class="text-center"  data-aos="fade-up">Login To<strong> Alroyyan Management System</strong></h3>
            <p class="mb-4 text-center"  data-aos="fade-up">Masukan Email Dan Password Anda</p>
            <form action="{{ route('login.proses')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group first"  data-aos="fade-up" data-aos-duration="1000">
                <label for="email">Email</label>
                <input type="email" class="form-control" placeholder="your-email@gmail.com" id="email" name="email">
              </div>
              <div class="form-group last mb-3"  data-aos="fade-up" data-aos-duration="1100">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Your Password" id="password" name="password">
              </div>
            
              <div>
                <button type="submit" class="btn btn-info btn-block rounded-0"  data-aos="fade-up" data-aos-duration="1150">Log in</button>
                <p class="text-center mt-2"  data-aos="fade-up" data-aos-duration="1200">Ingin Mendaftarkan PMI ? <a href="{{route('register.pmi')}}">Register</a></p>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('auth/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('auth/js/popper.min.js')}}"></script>
    <script src="{{ asset('auth/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('uth/js/main.js')}}"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>