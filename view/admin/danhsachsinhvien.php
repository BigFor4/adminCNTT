<div id="wrapper">
  <?php require_once("./view/admin/headeradminLeft.php"); ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php require_once("./view/admin/headeradminTop.php"); ?>
      <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách sinh viên</h1>

        <div class="card shadow mb-4">

          <div class="card-body">
            <div class="table-responsive">
              <a href="?controller=admin&action=themsinhvien" type="button" data-target="#myModal" class="btn-success btn" style="margin-bottom: 10px">Thêm Sinh Viên &nbsp;<span class="glyphicon glyphicon-plus"></span></a>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã SV</th>
                    <th>Họ và Tên</th>
                    <th>Giới tính</th>
                    <th>Điện thoại</th>
                    <th>Ngày sinh</th>
                    <th>Lớp</th>
                    <th>Sửa / Xóa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $stt = 0;
                  if ($listStudent != '') {
                    foreach ($listStudent as $info) {
                      $stt++; ?>
                      <tr>
                        <td><?= $stt ?></td>
                        <td class="item-monhoc"><?= $info['masinhvien'] ?></td>
                        <td class="item-monhoc"><?= $info['hovaten'] ?></td>

                        <td class="item-monhoc"><?= $info['gioitinh'] ?></td>
                        <td class="item-monhoc"><?= $info['dienthoai'] ?></td>
                        <td class="item-monhoc"><?= $info['ngaysinh'] ?></td>
                        <td class="item-monhoc"><?= $info['lop'] ?></td>
                        <td class="item-monhoc">
                          <a class="btn btn-warning" href="?controller=admin&action=suasinhvien&id=<?= $info['id'] ?>">Sửa</a>
                          &nbsp;
                          <a class="btn btn-danger" href="?controller=admin&action=xoasinhvien&id=<?= $info['id'] ?>">Xóa</a>
                        </td>
                      </tr><?php } ?>


                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php require_once("./view/admin/footeradmin.php"); ?>
  </div>
</div>


<div class="modal fade " id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Thêm Sinh Viên</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <!-- <p>Some text in the modal.</p> -->

          <table width="100%">
            <tbody class="table">
              <tr>
              <tr>
                <td class="modal-td" width="30%">Mã Sinh Viên:</td>
                <td class="modal-td">
                  <input id="masinhvien" name="masinhvien" class="form-control" type="text" value="A<?= $getmasv + 1 ?>" readonly />
                </td>
              </tr>
              <tr>
                <td class="modal-td" width="30%">Họ và tên:</td>
                <td class="modal-td">
                  <input id="hovaten" name="hovaten" class="form-control" type="text" />
                </td>
              </tr>
              <td class="modal-td" width="30%">Giới tính:</td>
              <td class="modal-td">
                <select class="form-control" id="gioitinh" name="gioitinh">
                  <option value="Nam">Nam</option>
                  <option value="Nữ">Nữ</option>
                </select>
              </td>
              </tr>
              <tr>
                <td class="modal-td" width="30%">Số CMND/CCCD:</td>
                <td class="modal-td"><input type="text" class="form-control" name="CMND" id="CMND"></td>
              </tr>
              <tr>
                <td class="modal-td" width="30%">Ngày sinh:</td>
                <td class="modal-td">
                  <input class="form-control" type="date" id="ngaysinh" name="ngaysinh" />
                </td>
              </tr>
              <tr>
                <td class="modal-td">Điện thoại:</td>
                <td class="modal-td"><input type="text" class="form-control" id="phone" name="phone"></td>
              </tr>
              <tr>
                <td class="modal-td">Email SV:</td>
                <td class="modal-td"><input type="text" class="form-control" value="A<?= $getmasv + 1 ?>@thanglong.edu.vn" name="email" id="email" readonly></td>
              </tr>

              <tr>
                <td class="modal-td">Địa chỉ hộ khẩu:</td>
                <td class="modal-td">
                  <input type="text" class="form-control" name="diachi" id="diachi">

                </td>
              </tr>

            </tbody>
          </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" id="create" class="btn btn-success" data-dismiss="modal">OK</button>

        </div>
      </form>

    </div>
  </div>

</div>