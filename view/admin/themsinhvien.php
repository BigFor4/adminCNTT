<div id="wrapper">
    <?php require_once("./view/admin/headeradminLeft.php"); ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php require_once("./view/admin/headeradminTop.php"); ?>
            <div class="container-fluid">



                <div class="modal-header">

                    <h4 class="modal-title">Thêm Sinh Viên</h4>
                    <a href="?controller=admin&action=danhsachsinhvien" type="button" class="close">&times;</a>
                </div>
                <form id="createStudent" method="POST">
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
                                <td class="modal-td">Lớp:</td>
                                <td class="modal-td">
                                    <select class="form-control" id="lop" name="lop">
                                        <option value="">Chọn lớp</option>
                                        <?php foreach ($listLopCN as $infoCN) {
                                            echo '<option value="' . $infoCN['malop'] . '">' . $infoCN['tenlop'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="modal-td">Chuyên Ngành:</td>
                                <td class="modal-td">
                                    <select class="form-control" id="chuyennganh" name="chuyennganh">
                                        <option value="">Chọn chuyên ngành</option>
                                        <?php foreach ($listCN as $infoCN) {
                                            echo '<option value="' . $infoCN['machuyennganh'] . '">' . $infoCN['tenchuyennganh'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="modal-td">Giáo viên CN:</td>
                                <td class="modal-td">
                                    <select class="form-control" id="giaovien" name="giaovien">
                                        <option value="">Chọn giáo viên</option>
                                        <?php foreach ($listGVCN as $infoCN) {
                                                echo '<option value="' . $infoCN['magiangvien'] . '">' . $infoCN['hovaten'] . '</option>';
                                        }
                                        ?>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="modal-td">Địa chỉ hộ khẩu:</td>
                                <td class="modal-td">
                                    <input type="text" class="form-control" name="diachi" id="diachi">

                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <a href="?controller=admin&action=danhsachsinhvien" type="button" class="btn btn-default">Close</a>
                        <input type="submit"  class="btn btn-success" name="addstudent" value="oke">
                    </div>
                </form>

            </div>
        </div>
        <?php require_once("./view/admin/footeradmin.php"); ?>
    </div>
</div>
