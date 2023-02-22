
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Bootstrap -->
    <link href="{{ url('admin/bootstrap/dist/css/bootstrap.css', []) }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('admin/font-awesome/css/font-awesome.min.css', []) }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ url('admin/nprogress/nprogress.css', []) }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ url('admin/animate.css/animate.min.css', []) }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ url('build/css/custom.css', []) }}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="container px-5">
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{ url('login/proses', []) }}" method="post">
                @csrf
              <h1>Form Login</h1>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username or email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div class="d-block">
                  <a href="{{ url('/', []) }}" class="pull-left" style="font-size: 11pt"><< Kembali</a>
                <button submit class="btn btn-primary px-4 text-white float-right">Log in</button>
              </div>

              <div class="clearfix"></div>

             
            </form>
          </section>
        </div>
      </div>

        
      </div>
    </div>
    @include('sweetalert::alert')
  </body>
</html>
