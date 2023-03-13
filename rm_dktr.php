<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Dokter";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $namadokter = $_POST['namadokter'];
    $sip = $_POST['sip'];
    $tgllhir = $_POST['tgllhir'];
    $notelp = $_POST['no_telp'];
    $spesialis = $_POST['spesialis'];
    $alamat = $_POST['alamat'];
    

    $up2 = mysqli_query($conn, "UPDATE rm_dktr SET nama_dokter='$namadokter', sip='$sip', tgl_lhir='$tgllhir', no_telp='$notelp', spesialis='$spesialis', alamat='$alamat' WHERE id='$id'");
    echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Dokter berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
  }

  if (isset($_POST['submit2'])) {
    $namadokter = $_POST['namadokter'];
    $sip = $_POST['sip'];
    $tgllhir = $_POST['tgl_lhir'];
    $notelp = $_POST['no_telp'];
    $spesialis = $_POST['spesialis'];
    $alamat = $_POST['alamat'];

    $add = mysqli_query($conn, "INSERT INTO rm_dktr (nama_dokter, sip, tgl_lhir, no_telp, spesialis, alamat) VALUES ('$namadokter', '$sip', '$tgllhir', '$notelp', '$spesialis', '$alamat')");
    echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Data Dokter Baru Berhasil Terdaftar",
						icon: "success"
						});
					}, 500);
			</script>';
  }
  ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
      include 'part/navbar.php';
      include 'part/sidebar.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $page; ?></h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $page; ?></h4>
                    <div class="card-header-action">
                      <a href="#" class="btn btn-primary" data-target="#addDokter" data-toggle="modal">Tambahkan Data Dokter</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>Nama Dokter</th>
                            <th>Surat Izin Prakterk</th>
                            <th>Tanggal Lahir</th>
                            <th>No Telepon</th>
                            <th>Spesialis</th>
                            <th>Alamat</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM rm_dktr");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $i++;
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td style="display:none;"><?php echo $row['id'] ?></td>
                              <td><?php echo $row['nama_dokter'] ?></td>
                              <td><?php echo $row['sip'] ?></td>
                              <td><?php echo $row['tgl_lhir'] ?></td>
                              <td><?php echo $row['no_telp'] ?></td>
                              <td><?php echo $row['spesialis'] ?></td>
                              <td><?php echo $row['alamat'] ?></td>
                              <td align="center">
                                <span data-target="#editDokter" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-namadokter="<?php echo $row['nama_dokter']; ?>" data-sip="<?php echo $row['sip']; ?>" data-tgllhir="<?php echo $row['tgl_lhir']; ?>" data-no_telp="<?php echo $row['no_telp']; ?>" data-spesialis="<?php echo $row['spesialis']; ?>" data-alamat="<?php echo $row['alamat']; ?>" >
                                  <a class="btn btn-primary btn-action mr-1" title="Edit Data Dokter" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                </span>
                                <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=rm_dktr&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="addDokter">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Data Dokter</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="" autocomplete="off">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Dokter</label>
                  <div class="col-sm-9">
                  <input id="myInput" type="text" class="form-control" name="namadokter" placeholder="" id="getNamadokter">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row align-items-center">
                <label class="col-sm-3 col-form-label">Surat Izin Praktek</label>
                <div class="col-sm-9">
                     <input id="myInput" type="text" class="form-control" name="sip" placeholder="" id="getSip">
                        <div class="invalid-feedback">
                          Mohon data diisi!
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="tgl_lhir" required="" id="getTgl_lhir">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row align-items-center">
                  <label class="col-sm-3 col-form-label">No Telepon</label>
                  <div class="form-group col-sm-9">
                    <input id="myInput" type="text" class="form-control" name="no_telp" placeholder="" id="getNo_telp">
                      <div class="invalid-feedback">
                        Mohon data diisi!
                      </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Spesialis</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control" name="spesialis" required="" id="getSpesialis">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Alamat</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control" name="alamat" required="" id="getAlamat">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit2">Tambah</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="editDokter">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data Dokter</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Dokter</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id" required="" id="getId">
                    <input type="text" class="form-control" name="namadokter" required="" id="getNamadokter">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Surat Izin Praktek</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control" name="sip" required="" id="getSip">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                  <div class="input-group col-sm-9">
                    <input type="date" class="form-control" name="tgllhir" required="" id="getTgllhir">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">No Telepon</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="no_telp" required="" id="getNo_telp">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Spesialis</label>
                  <div class="input-group col-sm-9">
                  <input type="text" class="form-control" name="spesialis" required="" id="getSpesialis">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Alamat</label>
                  <div class="input-group col-sm-9">
                    <input type="text" class="form-control" name="alamat" required="" id="getAlamat">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit">Edit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include 'part/footer.php'; ?>
    </div>
  </div>
  <?php include "part/all-js.php"; ?>

  <script>
    $('#editDokter').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var namadokter = button.data('namadokter')
      var sip = button.data('sip')
      var tgllhir = button.data('tgllhir')
      var notelp = button.data('no_telp')
      var spesialis = button.data('spesialis')
      var alamat = button.data('alamat')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getNamadokter').val(namadokter)
      modal.find('#getSip').val(sip)
      modal.find('#getTgllhir').val(tgllhir)
      modal.find('#getNo_telp').val(notelp)
      modal.find('#getSpesialis').val(spesialis)
      modal.find('#getAlamat').val(alamat)
    })
  </script>
</body>

</html>