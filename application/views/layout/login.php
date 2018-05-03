<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo Web::getTitle() ?></title>
    <?= $this->web->getMeta(); ?>
    <link rel="icon" href="<?= site_url('public/favicon.ico')?>">
    <?php
         $this->web->Register()->css();
         $this->web->Register()->js();
    ?>
  <style type="text/css">
    legend.header{
      padding: 5px;
      text-align: center;
      background: #B0BEC5;
      background-image:
        linear-gradient(
          to bottom, 
          #ECEFF1, 
          #f5f5f5, 
          #f5f5f5,
          #ECEFF1
        );
      color: ;
    }
    body.bg-default{
      background: #455A64 !important;
    }

    .content-wrapper{
      background: #01579B !important;
    }
    fieldset .login-layout{
      background: white;
      border: 1px solid #CFD8DC !important;
    }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-default" id="page-top">
  <!-- Navigation-->
  
  <div class="container">

        <form class="form-horizontal" role="form" method="POST" autocomplete="off" id="loginForm" action="<?= site_url('/login') ?>"> 
          <fieldset>
              <div class="col-4 mx-auto login-layout">
                <div class="row">
                  <legend class="header">Login</legend>
                </div>
                
                <label>Username</label>
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="Masukkan username">
                </div>

                <label>Password</label>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Masukkan password">
                </div>
                <div id="login-result" style="color: red; margin-top: -10px; font-size: 14px; text-align: left"></div>
                <div class="checkbox">
                  <input type="checkbox" name="remember">
                  <label for="remember">
                   Biarkan saya tetap masuk </label>
                </div>
                <button class="btn btn-success btn-block">Login</button>
                <div class="clearfix">&nbsp;</div>
                
             </div>
   
              
          
          </fieldset>
        </form>
    </div>
  <?php    $this->web->Register()->jqueryPlugins(); ?>
  <script type="text/javascript">
    $("body").off("click",".ajax-link").on("click",".ajax-link",function(e){
      var url = $(this).attr('href');
      var title = $(this).text();

      loadPage(url);
      CreateHistory(url,title);
      return false;

    });

    var loginForm = $("#loginForm");
    loginForm.validate({
      rules : {
        username : {
          required : true,
        },
        password : {
          required : true,
        }
      },
      messages : {
        username : {
          required : 'Username tidak boleh kosong',
        },
        password : {
          required : 'Password tidak boleh kosong',
        }
      },
      submitHandler : function(forms)
      {
        login();

      }
    });


    function login(){
      $("#login-result").html('');
      $.ajax({
        type : 'POST',
        dataType : 'JSON',
        data : $("#loginForm").serialize(),
        url : '<?= site_url('/main/login') ?>',
        success : function(response){
          if(response.status == 'success'){
            window.location.replace(response.redirect);
          }else{
            $("#login-result").html(response.message);
          }
        },error : function(){
          alert('error');
        }
      });
      return false;
    }
  </script>
</body>

</html>
