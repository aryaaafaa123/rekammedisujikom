<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Data Kunjungan Pasien";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $namapasien = $_POST['nama_pasien'];
    $tglknj = $_POST['tgl_knj'];
    $ruanginap = $_POST['ruang_inap'];
    $jamknj = $_POST['jam_knj'];
    

    $up2 = mysqli_query($conn, "UPDATE rm_knj SET nama_pasien='$namapasien', tgl_knj='$tglknj', ruang_inap='$ruanginap', jam_knj='$jamknj' WHERE id='$id'");
    echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Kunjungan berhasil diubah!",
					icon: "success"
					});
					}, 500);rm
				</script>';
  }

  if (isset($_POST['submit2'])) {
    $namapasien = $_POST['nama_pasien'];
    $tglknj = $_POST['tgl_knj'];
    $ruanginap = $_POST['ruang_inap'];
    $jamknj = $_POST['jam_knj'];

    $add = mysqli_query($conn, "INSERT INTO rm_knj (nama_pasien, tgl_knj, ruang_inap, jam_knj) VALUES ('$namapasien', '$tglknj', '$ruanginap', '$jamknj')");
    echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Data Kunjungan Baru Berhasil Terdaftar",
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
                      <a href="#" class="btn btn-primary" data-target="#addKunjungan" data-toggle="modal">Tambahkan Data Kunjungan</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>Nama Pengunjung</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Ruang Inap</th>
                            <th>Jam Kunjungan</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM rm_knj");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $i++;
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td style="display:none;"><?php echo $row['id'] ?></td>
                              <td><?php echo $row['nama_pasien'] ?></td>
                              <td><?php echo $row['tgl_knj'] ?></td>
                              <td><?php echo $row['ruang_inap'] ?></td>
                              <td><?php echo $row['jam_knj'] ?></td>
                              <td align="center">
                                <span data-target="#editKunjungan" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-namapasien="<?php echo $row['nama_pasien']; ?>" data-tglknj="<?php echo $row['tgl_knj']; ?>" data-ruanginap="<?php echo $row['ruang_inap']; ?>" data-jamknj="<?php echo $row['jam_knj']; ?>">
                                  <a class="btn btn-primary btn-action mr-1" title="Edit Data Kunjungan" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                </span>
                                <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=rm_knj&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
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

      <div class="modal fade" tabindex="-1" role="dialog" id="addKunjungan">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Data Kunjungan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="" autocomplete="off">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Pengunjung</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama_pasien" required="" id="getNamapasien">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal Kunjungan</label>
                  <div class="form-group col-sm-9">
                    <input type="date" class="form-control" name="tgl_knj" required="">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Ruang Inap</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control" name="ruang_inap" required="">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jam Kunjungan</label>
                  <div class="form-group col-sm-9">
                    <input type="time" class="form-control" name="jam_knj" required="" id="getjamknj" >
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

      <div class="modal fade" tabindex="-1" role="dialog" id="editKunjungan">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data Kunjungan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Pengunjung</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id" required="" id="getId">
                    <input type="text" class="form-control" name="nama_pasien" required="" id="getNamapasien">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal Kunjungan</label>
                  <div class="form-group col-sm-9">
                    <input type="date" class="form-control" name="tgl_knj" required="" id="getTglknj">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Ruang Inap</label>
                  <div class="input-group col-sm-9">
                    <input type="text" class="form-control" name="ruang_inap" required="" id="getRuanginap">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jam Kujungan</label>
                  <div class="col-sm-9">
                    <input type="time" class="form-control" name="jam_knj" required="" id="getJamknj">
                    
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
    $('#editKunjungan').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var namapasien = button.data('namapasien')
      var tglknj = button.data('tglknj')
      var ruanginap = button.data('ruanginap')
      var jamknj = button.data('jamknj')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getNamapasien').val(namapasien)
      modal.find('#getTglknj').val(tglknj)
      modal.find('#getRuanginap').val(ruanginap)
      modal.find('#getJamknj').val(jamknj)
    })
  </script>
</body>

</html>