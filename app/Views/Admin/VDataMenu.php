<?= $this->extend('Views\layout.php') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('main') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">

      <div class="row mb-2">

        <!--
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        -->
        <!-- /.col -->
        <!--
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        -->
        <!-- /.col -->

      </div><!-- /.row -->

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h2>Edit Data Menu</h2>
            </div>
            <!-- /.card-header -->
            <?php $session = \Config\Services::session();
            if ($session->getFlashdata('sukses')) { ?>
              <p class="alert alert-success"><?php echo $session->getFlashdata('sukses'); ?></p>
            <?php } ?>
            <div class="card-body">

              <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Data Menu</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo base_url('index.php/menu/tambah/' . $menuAktip . "/" . $moduleAktip) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon3">Module</span>
                          <select name=id_module class="form-control">
                            <?php
                            foreach (listmodule() as $DataMenuk => $DataMenuv) {
                            ?>
                              <option value="<?= $DataMenuv['id_module'] ?>"><?= $DataMenuv['nama_module'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon3">Nama Menu</span>
                          <input name="menu" type="text" class="form-control" id="recipient-name" value="">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon3">Path</span>
                          <input name="path" type="text" class="form-control" id="recipient-name" value="">
                        </div>
                        <div class="input-group mb-3"><span class="input-group-text" id="basic-addon3">icon</span>
                          <input name="icon" type="text" class="form-control" id="recipient-name" value="">

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">save</button>
                        </div>
                      </form>

                    </div>

                  </div>
                </div>
              </div>
              <p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalTambah" data-whatever="@mdo"><i class="fas fa-folder-plus"> New Data</i></button>
              </p>
              <table id="example" class="table table-bordered table-striped">
                <thead></thead>
                <tr>
                  <td></td>
                </tr>
              </table>

              <?php foreach ($DataMenu as $DataMenuv) { ?>
                <!-- Modal Edit  -->
                <div class="modal fade" id="ModalEdit<?php echo $DataMenuv['id_menu']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Siswa</h5>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo base_url('index.php/menu/edit/' . $menuAktip . "/" . $moduleAktip) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                          <?= csrf_field() ?>
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">id_menu</span>
                            <input name="id_menu" type="text" class="form-control" id="recipient-name" value="<?php echo $DataMenuv['id_menu']; ?>">
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">Module</span>
                            <select name=id_module class="form-control">
                              <?php
                              foreach (listmodule() as $DataModulek => $DataModules) {
                                if ($DataModules['id_module'] == $DataModules['nama_module']) {
                                  $selected = "selected";
                                } else {
                                  $selected = "";
                                }
                              ?>
                                <option value="<?= $DataMenuv['id_module'] ?>" <?= $selected ?>><?= $DataModules['nama_module'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">Nama Menu</span>
                            <input name="menu" type="text" class="form-control" id="recipient-name" value="<?php echo $DataMenuv['menu']; ?>">
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">Path</span>
                            <input name="path" type="text" class="form-control" id="recipient-name" value="<?php echo $DataMenuv['path']; ?>">
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">icon</span>
                            <input name="icon" type="text" class="form-control" id="recipient-name" value="<?php echo $DataMenuv['icon']; ?>">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary"><i class="fas fa-save"> Save</i></button>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="modal fade" id="ModalDelete<?php echo $DataMenuv['id_menu']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="card card-danger">
                      <div class="card-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Menu</h5>
                      </div>
                      <div class="modal-body danger">
                        <form action="<?php echo base_url('index.php/menu/delete/' . $menuAktip . "/" . $moduleAktip) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">id_menu</span>
                            <input name="id_menu" type="text" class="form-control" id="recipient-name" value="<?php echo $DataMenuv['id_menu']; ?>">
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-danger"><i class="fas fa-trash"> Delete</i></button>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo BPATH; ?>/asset/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo BPATH; ?>/asset/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo BPATH; ?>/asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo BPATH; ?>/asset/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo BPATH; ?>/asset/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo BPATH; ?>/asset/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo BPATH; ?>/asset/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo BPATH; ?>/asset/plugins/moment/moment.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo BPATH; ?>/asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo BPATH; ?>/asset/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo BPATH; ?>/asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BPATH; ?>/asset/dist/js/adminlte.js"></script>

<script src="<?php echo BPATH; ?>/asset/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php //echo base_url(); 
                  ?>/asset/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo BPATH; ?>/asset/dist/js/pages/dashboard.js"></script>
<!-- Page specific script -->
<script>
  function ftable(url) {
    $('#example').DataTable({
      'processing': true,
      'bVisible': false,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "destroy": true,
      'serverMethod': 'get',
      'ajax': {
        'url': url,
        'dataSrc': "datamodel"
      },
      select: true,
      'columns': [{
          'data': 'id_menu',
          'title': 'ID MENU',
        },
        {
          'data': 'nama_module',
          'title': 'NAMA MODULE',
        },
        {
          'data': 'path',
          'title': 'PATH',
        },
        {
          'data': 'menu',
          'title': 'NAMA MENU',
        },
        {
          'data': 'icon',
          'title': 'ICON',
        },
        {
          'data': null,
          'title': 'command',
          render: function(data, type, row, meta) {
            return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEdit' + data['id_menu'] + '"><i class="fas fa-pencil-alt" title="Edit Data"></i></button>' +
              '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete' + data['id_menu'] + '"><i class="fas fa-trash" title="Delete Data"></i></button>'
          }
        }
      ]
    })
  }
  $(document).ready(function() {
    var url = '<?= base_url('index.php/menu/json/') ?>';
    ftable(url);
  })
  $('#modalButton').click(function() {
    $('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
  });
</script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "paging": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      //"destroy":true,
    });
  });
</script>
<?= $this->endSection() ?>