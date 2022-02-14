<div id="wrapper">
<?php require_once("./view/admin/headeradminLeft.php"); ?>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php require_once("./view/admin/headeradminTop.php"); ?>
      <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách giảng viên</h1>
      
        <div class="card shadow mb-4">

          <div class="card-body">
            <div class="table-responsive">
            <a class="btn btn-success" href="?controller=admin&action=themgiangvien"style="margin-bottom: 1rem;">Thêm Giảng Viên</a>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã SV</th>
                    <th>Họ và Tên</th>
                    <th>Giới tính</th>
                    <th>Điện thoại</th>
                    <th>Ngày sinh</th>
                    <th>Chuyên ngành</th>
                    <th>Sửa / Xóa</th>
                  </tr>
                </thead>
                <tbody>
                <?php $gv=0; 
                    if($listGiangvien != '')
                    {
                        foreach ($listGiangvien as $info){ 
                          if($info['role_id'] == 2){
                            $gv++;
                          
                        ?>
                          
                            <tr>
                              <td><?= $gv?></td>
                              <td class="item-monhoc"><?= $info['magiangvien']?></td>
                              <td class="item-monhoc"><?= $info['hovaten']?></td>
                              
                              <td class="item-monhoc"><?= $info['gioitinh']?></td>
                              <td class="item-monhoc"><?= $info['dienthoai']?></td>
                              <td class="item-monhoc"><?= $info['ngaysinh']?></td>
                              <td class="item-monhoc"><?= $info['chuyennganh']?></td>
                              <td class="item-monhoc">
                              <a class="btn btn-warning" href="?controller=admin&action=suagiangvien&id=<?= $info['id'] ?>">Sửa</a>
                              &nbsp;
                              <a class="btn btn-danger" href="?controller=admin&action=xoagiangvien&id=<?= $info['id'] ?>">Xóa</a>
                              </td>
                            </tr><?php }} ?>
                    
                    
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