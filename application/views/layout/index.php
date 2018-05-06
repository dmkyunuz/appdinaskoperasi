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
  
</head>

<body class="fixed-nav sticky-footer bg-default" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-sm navbar-default bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Dinas Koperasi</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
     
      <ul class="navbar-nav navbar-sidenav  animated slideInLeft"  style="overflow: auto" id="exampleAccordion" >

        <li class="nav-item" data-toggle="tooltip" data-placement="right">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#dashboard" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-database"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
          <ul class="sidenav-second-level collapse" id="dashboard">
            <li>
              <a class="nav-link " href="<?= site_url('/dashboard') ?>">Home</a>
            </li>
           
            
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#master" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-database"></i>
            <span class="nav-link-text">Master</span>
          </a>
          <ul class="sidenav-second-level collapse" id="master">
            <li><a class="nav-link " href="<?= site_url('/bentuk-koperasi') ?>">Bentuk Koperasi</a></li>            
            <li><a class="nav-link " href="<?= site_url('/kecamatan') ?>">Kecamatan</a></li>            
            <li><a class="nav-link " href="<?= site_url('/kelurahan') ?>">Kelurahan</a></li>            
            <li><a class="nav-link " href="<?= site_url('/koperasi') ?>">Koperasi</a></li>            
            <li><a class="nav-link " href="<?= site_url('/penilai') ?>">Penilai</a></li>            
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#penilaian" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-database"></i>
            <span class="nav-link-text">Penilaian</span>
          </a>
          <ul class="sidenav-second-level collapse" id="penilaian">
            <li><a class="nav-link " href="<?= site_url('/input-penilaian') ?>">Input Penilaian</a></li>            
            <li><a class="nav-link " href="<?= site_url('/sertifikat') ?>">Sertifikat</a></li>    
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#laporan" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-database"></i>
            <span class="nav-link-text">Laporan</span>
          </a>
          <ul class="sidenav-second-level collapse" id="laporan">
            <li><a class="nav-link " href="<?= site_url('/laporan-brntuk-koperasi') ?>">Laporan Bentuk Koperasi</a></li> 
            <li><a class="nav-link " href="<?= site_url('/laporan-kecamatan') ?>">Laporan Kecamatan</a></li> 
            <li><a class="nav-link " href="<?= site_url('/laporan-kelurahan') ?>">Laporan Kelurahan</a></li> 
            <li><a class="nav-link " href="<?= site_url('/laporan-hasil-penilaian') ?>">Laporan Hasil Penilaian</a></li> 
          </ul>
        </li>        
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('/main/logout')?>">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper" style="" id="main-content">
     
      <?php echo $content_for_layout; ?> 	
    
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    

    <!-- Bootstrap core JavaScript-->
    
    
    
  </div>
  <div class="modal fade" id="form-modal">
      <div class="modal-dialog  modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            Loading ..
          </div>

        </div>
      </div>
    </div>
  <?php  $this->web->Register()->jqueryPlugins(); ?>
  <script type="text/javascript">
    $("body").off("click",".ajax-link").on("click",".ajax-link",function(e){
      var url = $(this).attr('href');
      var title = $(this).text();

      loadPage(url);
      CreateHistory(url,title);
      return false;

    });
    
    function CreateHistory(url, title){
        history.pushState({
        url: url,
        title: title
        }, title, url);

        document.title = title;
    }
    function loadPage(url){
      var screenHeight = $(window).height() +90;
      $("#main-content").css({"min-height": screenHeight+"px"});
      // $("#main-content").load(url);
      $.ajax({
        type : 'GET',
        url : url,
        dataType : 'JSON',
        success : function(response){
          var htmlOutput = response.html;
          $("#main-content").html(htmlOutput);

        }
      })
      $('html, body').animate({
      scrollTop: $("body").offset().top
      }, 100);
    }

    $(window).on('popstate', function (e) {
        var state = e.originalEvent.state;
        if (state !== null) {
        document.title = state.title;
        loadPage(state.url);

    } else {
      var url = '<?= base_url()?>dashboard';
      $("#main-content").load(url,function(){
      title = 'Dashboard';
      history.pushState({
      url: url,
      title: title
      }, title, url);

      document.title = title;

    });
  }
  });
  </script>
</body>

</html>
