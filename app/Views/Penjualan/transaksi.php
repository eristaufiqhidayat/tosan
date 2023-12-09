<?= $this->extend('Views\layout.php') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/vendor/adminlte/plugins/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/vendor/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/vendor/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/vendor/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/vendor/adminlte/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/vendor/adminlte/dist/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo BPATH; ?>/asset/vendor/adminlte/plugins/fontawesome-free/css/all.min.css">
<style>
  @media(max-width: 576px) {
    .nota {
      justify-content: center !important;
      text-align: center !important;
    }
  }
</style>

<?= $this->endSection() ?>
<?= $this->section('main') ?>

<!-- Content Wrapper. Contains page content -->
<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col">
            <h1 class="m-0 text-dark">Transaksi</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Barcode</label>
                  <div class="form-inline">
                    <select id="barcode" class="form-control select2 col-sm-9" onchange="getNama()"></select>
                    <span class="ml-3 text-muted" id="nama_produk"></span>
                  </div>
                  <small class="form-text text-muted" id="sisa"></small>
                </div>
                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="number" class="form-control col-sm-6" placeholder="Jumlah" id="jumlah" onkeyup="checkEmpty()">
                </div>
                <div class="form-group">
                  <button id="tambah" class="btn btn-success" onclick="checkStok()" disabled>Tambah</button>
                  <button id="bayar" class="btn btn-success" data-toggle="modal" data-target="#modal" disabled>Bayar</button>
                </div>
              </div>
              <div class="col-sm-6 d-flex justify-content-end text-right nota">
                <div>
                  <div class="mb-0">
                    <b class="mr-2">Nota</b> <span id="nota"></span>
                  </div>
                  <span id="total" style="font-size: 80px; line-height: 1" class="text-danger">0</span>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table w-100 table-bordered table-hover" id="transaksi">
              <thead>
                <tr>
                  <th>Barcode</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Actions</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>

<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bayar</h5>
        <button class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form">
          <div class="form-group">
            <label>Tanggal</label>
            <input type="text" class="form-control" name="tanggal" id="tanggal" required>
          </div>
          <div class="form-group">
            <label>Pelanggan</label>
            <select name="pelannggan" id="pelanggan" class="form-control select2"></select>
          </div>
          <div class="form-group">
            <label>Jumlah Uang</label>
            <input placeholder="Jumlah Uang" type="number" class="form-control" name="jumlah_uang" onkeyup="kembalian()" required>
          </div>
          <div class="form-group">
            <label>Diskon</label>
            <input placeholder="Diskon" type="number" class="form-control" onkeyup="kembalian()" name="diskon">
          </div>
          <div class="form-group">
            <b>Total Bayar:</b> <span class="total_bayar"></span>
          </div>
          <div class="form-group">
            <b>Kembalian:</b> <span class="kembalian"></span>
          </div>
          <button id="add" class="btn btn-success" type="submit" onclick="bayar()" disabled>Bayar</button>
          <button id="cetak" class="btn btn-success" type="submit" onclick="bayarCetak()" disabled>Bayar Dan Cetak</button>
          <button class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
<script src="<?php echo BPATH; ?>/asset/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/select2/js/select2.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo BPATH; ?>/asset/plugins/moment/moment.min.js"></script>
<script>
  var produkGetNamaUrl = '<?php echo site_url('Penjualan/jsonnamaproduk/Transaksi') ?>';
  var produkGetStokUrl = '<?php echo site_url('Penjualan/jsongetstok/Transaksi') ?>';
  var addUrl = '<?php echo site_url('Penjualan/jsonadd/Transaksi') ?>';
  var getBarcodeUrl = '<?php echo site_url('Penjualan/jsonbarcode/Transaksi') ?>';
  var pelangganSearchUrl = '<?php echo site_url('Pelanggan/jsonsearch') ?>';
  // var cetakUrl = '<?php echo site_url('transaksi/cetak/') ?>';
</script>
<script src="<?php echo BPATH; ?>/asset/js/unminify/transaksi.js"></script>

<?= $this->endSection() ?>