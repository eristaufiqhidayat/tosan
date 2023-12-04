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

  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <?php if (session('error')) : ?>
    <div class="alert alert-danger">
      <?= session('error') ?>
      <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    </div>
  <?php endif ?>
  <?php if (session('msg')) : ?>
    <div class="alert alert-success">
      <?= session('msg') ?>
      <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
    </div>
  <?php endif ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h2>Edit Data Group User</h2>
            </div>
            <!-- /.card-header -->
            <?php $session = \Config\Services::session();
            if ($session->getFlashdata('sukses')) { ?>
              <p class="alert alert-success"><?php echo $session->getFlashdata('sukses'); ?></p>
            <?php } ?>
            <div class="card-body">
              <table id="example1" class="table table-striped table-bordered table-sm">
                <thead>
                  <tr>
                    <th scope="col">Action</th>
                    <th scope="col">Id</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Group</th>
                    <!-- <th scope="col">COCOK</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $Datav) { ?>
                    <tr>
                      <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#Modal<?php echo $Datav['username']; ?>" type="button" class="btn btn-primary"><i class="fa fa-address-book"></i></button> Edit Group

                      </td>
                      <td><?php echo $Datav['id']; ?></td>
                      <td><?php echo $Datav['username']; ?></td>
                      <td><?php echo $Datav['email']; ?></td>
                      <td>
                        <table>
                          <tr>
                            <td>
                              <?php
                              $groupsname = groupsname($Datav['username']);
                              $groupsval = "";
                              foreach ($groupsname as $groupsv) {
                                $groupsval .=  $groupsv['description'] . ",";
                              }
                              $groupsval = substr($groupsval, 0, -1);
                              echo $groupsval;
                              ?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <div class="modal fade" id="Modal<?php echo $Datav['username']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pilih Group</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="<?php echo base_url('index.php/groupsusers/edit/' . $menuAktip . "/" . $moduleAktip) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

                              <div class="input-group mb-1">
                                <span class="input-group-text" id="basic-addon3">Cek Group</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
                                $groupsname2 = groupsall();
                                foreach ($groupsname2 as $groupsv2) {
                                  $cekgroup = cekgroupsname($Datav['id'], $groupsv2['id']);
                                  if (isset($cekgroup['group_id']) == $groupsv2['id']) $checkedG = "checked";
                                  else $checkedG = "";
                                ?>

                                  <div class="form-check form-check-inline">
                                    <input name="group_id[<?php echo $groupsv2['id']; ?>]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?php echo $groupsv2['id']; ?>" <?php echo $checkedG; ?>>
                                    <label class="form-check-label" for="inlineCheckbox1"><?php echo $groupsv2['description']; ?></label>
                                  </div>

                                <?php
                                }
                                ?>
                              </div>
                              <input name="user_id" type=hidden value="<?php echo $Datav['id']; ?>">
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary"><i class="fas fa-save"> Save</i></button>
                              </div>
                            </form>
                          </div>

                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </tbody>
              </table>
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