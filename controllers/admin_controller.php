<?php
require_once("./models/dbconfig.php");
class admin_controller
{
    public function run()
    {
        $this->db = new database();
        $this->db->connect();
        $action = filter_input(INPUT_GET, "action");
        if (method_exists($this, $action)) {
            $this->$action();
        } else {
            $this->main();
        }
    }
    function main()
    {
        // if (isset($_SESSION['msv'])) {
        //     $data = $this->db->getinfosinhvien($_SESSION['msv']);
        //     if (isset($_POST['edit_sv'])) {
        //         $image = $_POST['image'];
        //         $gioitinh = $_POST['gioitinh'];
        //         $cmnd = $_POST['cmnd'];
        //         $dienthoai = $_POST['dienthoai'];
        //         $email = $_POST['email'];
        //         $diachi = $_POST['diachi'];
        //         $this->db->updatesinhvien($_SESSION['msv'], $image, $gioitinh, $cmnd, $dienthoai, $email, $diachi);
        //         header("Refresh:0");
        //     }

        //     require_once("./view/sinhvien/ThongTinCaNhan.php");
        // } else {
        //     $data = $this->db->getinfogiangvien($_SESSION['mgv']);
        //     if (isset($_POST['edit_gv'])) {
        //         $image = $_POST['image'];
        //         $gioitinh = $_POST['gioitinh'];
        //         $cmnd = $_POST['cmnd'];
        //         $dienthoai = $_POST['dienthoai'];
        //         $email = $_POST['email'];
        //         $diachi = $_POST['diachi'];
        //         $this->db->updategiangvien($_SESSION['mgv'], $image, $gioitinh, $cmnd, $dienthoai, $email, $diachi);
        //         header("Refresh:0");
        //     }

        //     require_once("./view/giangvien/ThongTinCaNhanGiaoVien.php");
        // }
        require_once("./view/admin/dashboardadmin.php");
    }


    function danhsachsinhvien()
    {
        $listStudent = $this->db->getAllData('sinhvien');
        require_once("./view/admin/danhsachsinhvien.php");
    }
    function danhsachgiangvien()
    {
        $listGiangvien = $this->db->getAllData('giangvien');
        require_once("./view/admin/danhsachgiangvien.php");
    }
    function danhsachnhanvien()
    {
        $listNhanVien = $this->db->getAllData('giangvien');
        require_once("./view/admin/danhsachnhanvien.php");
    }
    function dashboardadmin()
    {

        $countsSV =$this->db->countsSV();
        $countsGV =$this->db->countsGV();
        $countsNV =$this->db->countsNV();
        $countsSVNam =$this->db->countsSVNam();
        $countsGVNam =$this->db->countsGVNam();
        $countsGVNu =$this->db->countsGVNu();
        $countsSVNu =$this->db->countsSVNu();
        


        $giangvienSL =$this->db->giangvienSL();
        $chuyennganhSL =$this->db->chuyennganhSL();
        $monhocSL =$this->db->monhocSL();
        require_once("./view/admin/dashboardadmin.php");
    }
    function themsinhvien()
    {   
        $masinhvien=$this->db->masinhvien();
        $getmasv = substr($masinhvien['masinhvien'], 1); 
        $listCN = $this->db->getAllData('chuyennganh');
        $listLopCN = $this->db->getAllData('lopcn');
        $listGVCN = $this->db->getAllData('giangvien');
        if(isset($_POST['addstudent'])){
            if(isset($_POST['masinhvien']) && isset($_POST['hovaten'])){
                $data=$this->db->createstudent($_POST['masinhvien'], $_POST['hovaten'], $_POST['gioitinh'], $_POST['CMND'], $_POST['ngaysinh'], $_POST['phone'], $_POST['email'], $_POST['chuyennganh'], $_POST['giaovien'], $_POST['diachi'], $_POST['lop']);
                $listStudent = $this->db->getAllData('sinhvien');
                header('location: index.php?controller=admin&action=danhsachsinhvien');
            }
           
        }
        require_once("./view/admin/themsinhvien.php");

    }
    function suasinhvien()
    {   
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $svid = $this->db->editsvid($id);
            $listCN = $this->db->getAllData('chuyennganh');
            $listLopCN = $this->db->getAllData('lopcn');
            $listGVCN = $this->db->getAllData('giangvien');
            if(isset($_POST['suastudent']) ){
                if(isset($_POST['masinhvien']) && isset($_POST['hovaten'])){
                    $data=$this->db->updatestudent($_POST['masinhvien'], $_POST['hovaten'], $_POST['gioitinh'], $_POST['CMND'], $_POST['ngaysinh'], $_POST['phone'], $_POST['email'], $_POST['chuyennganh'], $_POST['giaovien'], $_POST['diachi'], $_POST['lop'],$id);
                    $listStudent = $this->db->getAllData('sinhvien');
                    header('location: index.php?controller=admin&action=danhsachsinhvien');
                }
                
            }
            require_once("./view/admin/suasinhvien.php");
        }
        header('location: index.php?controller=admin&action=danhsachsinhvien');
    }
    function suagiangvien()
    {   
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $gvid = $this->db->editgiangvienid($id);
            $listChuyenNganh = $this->db->getAllData('chuyennganh');
            if(isset($_POST['suagiangvien'])){
                if(isset($_POST['magiangvien']) && isset($_POST['hovaten'])){
                    $data=$this->db->editgiangvien($_POST['magiangvien'], $_POST['hovaten'], $_POST['gioitinh'], $_POST['CMND'], $_POST['ngaysinh'], $_POST['phone'], $_POST['email'], $_POST['chuyennganh'], $_POST['diachi'],$id);
                    $listNhanVien = $this->db->getAllData('giangvien');
                    header('location: index.php?controller=admin&action=danhsachgiangvien');
                }
                
            }
            require_once("./view/admin/suagiangvien.php");
        }
        header('location: index.php?controller=admin&action=danhsachgiangvien');
    }
    function suanhanvien()
    {   
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $gvid = $this->db->editgiangvienid($id);
            $listChuyenNganh = $this->db->getAllData('chuyennganh');
            if(isset($_POST['suanhanvien'])){
                if(isset($_POST['magiangvien']) && isset($_POST['hovaten'])){
                    $data=$this->db->editgiangvien($_POST['magiangvien'], $_POST['hovaten'], $_POST['gioitinh'], $_POST['CMND'], $_POST['ngaysinh'], $_POST['phone'], $_POST['email'], $_POST['chuyennganh'], $_POST['diachi'],$id);
                    $listNhanVien = $this->db->getAllData('giangvien');
                    header('location: index.php?controller=admin&action=danhsachnhanvien');
                }
                
            }
            require_once("./view/admin/suanhanvien.php");
        }
        header('location: index.php?controller=admin&action=danhsachnhanvien');
    }
    function xoasinhvien()
    {   
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data=$this->db->deletestudent($id);
        }
        header('location: index.php?controller=admin&action=danhsachsinhvien');
    }

    function themgiangvien()
    {   
        $magiangvien=$this->db->magiangvien();
        $getmgv = substr($magiangvien['magiangvien'], 2); 
        $listChuyenNganh = $this->db->getAllData('chuyennganh');
        if(isset($_POST['addgiangvien'])){
            if(isset($_POST['magiangvien']) && isset($_POST['hovaten'])){
                $data=$this->db->creategiangvien($_POST['magiangvien'], $_POST['hovaten'], $_POST['gioitinh'], $_POST['CMND'], $_POST['ngaysinh'], $_POST['phone'], $_POST['email'], $_POST['chuyennganh'], $_POST['diachi'], $_POST['lop']);
                $listNhanVien = $this->db->getAllData('giangvien');
                header('location: index.php?controller=admin&action=danhsachgiangvien');
            }
            
        }
        require_once("./view/admin/themgiangvien.php");

    }
    function themnhanvien()
    {   
        $magiangvien=$this->db->magiangvien();
        $getmgv = substr($magiangvien['magiangvien'], 2); 
        $listChuyenNganh = $this->db->getAllData('chuyennganh');
        if(isset($_POST['addnhanvien'])){
            if(isset($_POST['magiangvien']) && isset($_POST['hovaten'])){
                $role_id = 3;
                $data=$this->db->createnhanvien($_POST['magiangvien'], $_POST['hovaten'], $role_id, $_POST['gioitinh'], $_POST['CMND'], $_POST['ngaysinh'], $_POST['phone'], $_POST['email'], $_POST['chuyennganh'], $_POST['diachi'], $_POST['lop']);
                $listNhanVien = $this->db->getAllData('giangvien');
                header('location: index.php?controller=admin&action=danhsachnhanvien');
            }
            
        }
        require_once("./view/admin/themnhanvien.php");

    }
    function xoagiangvien()
    {   
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data=$this->db->deletegiangvien($id);
        }
        header('location: index.php?controller=admin&action=danhsachgiangvien');
    }
    
    function xoanhanvien()
    {   
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data=$this->db->deletegiangvien($id);
        }
        header('location: index.php?controller=admin&action=danhsachnhanvien');
    }
}
