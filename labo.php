<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Laboratorium";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $pasien = $_POST['pasien'];
    $hasil = $_POST['hasil'];
    $ktg = $_POST['ktg'];

    
    

    $up2 = mysqli_query($conn, "UPDATE labo SET  nm_pasien='$pasien', hasil_lab='$hasil', ket='$ktg' WHERE id='$id'");
    echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data lab berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
  }

  if (isset($_POST['submit2'])) {
    $pasien = $_POST['nm_pasien'];
    $hasil = $_POST['hasil_lab'];
    $ktg = $_POST['ket'];
    

    $add = mysqli_query($conn, "INSERT INTO labo (nm_pasien, hasil_lab, ket) VALUES ('$pasien', '$hasil', '$ktg')");
    echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Data lab Baru Berhasil Terdaftar",
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
                      <a href="#" class="btn btn-primary" data-target="#addLaboratorium" data-toggle="modal">Tambahkan Data Lab</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>Nama Pasien</th>
                            <th>Hasil Lab</th>
                            <th>Keterangan</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM labo");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $i++;
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td style="display:none;"><?php echo $row['id'] ?></td>
                              <td><?php echo $row['nm_pasien'] ?></td>
                              <td><?php echo $row['hasil_lab'] ?></td>
                              <td><?php echo $row['ket'] ?></td>
                              <td align="center">
                                <span data-target="#editLaboratorium" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-pasien="<?php echo $row['nm_pasien']; ?>" data-hasil="<?php echo $row['hasil_lab']; ?>" data-ktg="<?php echo $row['ket']; ?>" >
                                  <a class="btn btn-primary btn-action mr-1" title="Edit Data Lab" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
                                </span>
                                <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=labo&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
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

      <div class="modal fade" tabindex="-1" role="dialog" id="addLaboratorium">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Data Lab</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="" autocomplete="off">
              <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Pasien</label>
                  <div class="col-sm-9">
                  <input id="myInput" type="text" class="form-control" name="nm_pasien" placeholder="" id="getNm_pasien">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Hasil Laboratorium</label>
                  <div class="col-sm-9">
                  <input id="myInput" type="text" class="form-control" name="hasil_lab" placeholder="" id="getHasil_lab">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row align-items-center">
                <label class="col-sm-3 col-form-label">Keterangan</label>
                <div class="col-sm-9">
                     <input id="myInput" type="text" class="form-control" name="ket" placeholder="" id="getKet">
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

      <div class="modal fade" tabindex="-1" role="dialog" id="editLaboratorium">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data Laboratorium</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST" class="needs-validation" novalidate="">
              <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Pasien</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control" name="pasien" required="" id="getPasien">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Hasil Lab</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" name="id" required="" id="getId">
                    <input type="text" class="form-control" name="hasil" required="" id="getHasil">
                    <div class="invalid-feedback">
                      Mohon data diisi!
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keterangan</label>
                  <div class="form-group col-sm-9">
                    <input type="text" class="form-control" name="ktg" required="" id="getKtg">
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
    $('#editLaboratorium').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var pasien = button.data('pasien')
      var hasil = button.data('hasil')
      var ktg = button.data('ktg')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getPasien').val(pasien)
      modal.find('#getHasil').val(hasil)
      modal.find('#getKtg').val(ktg)
    })
  </script>
</body>

</html>