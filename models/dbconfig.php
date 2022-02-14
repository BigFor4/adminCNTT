<?php

    class database{
        private $hostname = 'localhost';
        private $username = 'root';
        private $pass = '';
        private $dbname = 'pointmanagement';

        private $conn = null;
        private $result = null;

        public function connect()
        {
           $this->conn = new mysqli($this->hostname, $this->username, $this->pass, $this->dbname);
           if(!$this->conn){
               echo "Kết nối thất bại";
                exit();
           }else{
               mysqli_set_charset($this->conn,'utf8');
           }
           return $this->conn;
        }

        function executeResult($sql){
            $conn = mysqli_connect($this->hostname, $this->username, $this->pass, $this->dbname);
            
            $result = mysqli_query($conn, $sql);
            $list = [];
            while ($row = mysqli_fetch_array($result, 1)) {
                $list[] = $row;
            }
            mysqli_close($conn);
            
            return $list;
        }
        //thực hiện truy vấn
        public function execute($sql){
            $this->result = $this->conn->query($sql);
            return $this->result;
        }
        //thực hiện lấy dữ liệu
        public function getData(){
                   
            if($this->result){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }
        public function dem(){
            if($this->result){
                $num = mysqli_num_rows($this->result);
            }
            else{
                $num = 0;
            }
            return $num;
        }
        public function getAllData($table){
            $sql = "select * from $table";
            return $this->execute($sql);
        }



        // / Sinh vien
        public function getinfosinhvien($msv){
            $sql = "select `sinhvien`.*, `giangvien`.hovaten as `hvt` from `sinhvien` inner join `giangvien` on `sinhvien`.GVCN=`giangvien`.magiangvien WHERE masinhvien='$msv'";
            $this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }       
        public function updatesinhvien($msv,$img,$gioitinh,$cmnd,$dienthoai,$email,$diachi){
            $sql="UPDATE sinhvien SET `image`='$img', gioitinh='$gioitinh', cmnd='$cmnd', dienthoai='$dienthoai', email='$email', diachi='$diachi' WHERE masinhvien='$msv'";
            return $this->execute($sql);
        }  

        public function updatestudent($masinhvien,$hovaten,$gioitinh,$CMND,$ngaysinh,$phone,$email,$chuyennganh,$giaovien,$diachi,$lop,$id){
            $sql="UPDATE `sinhvien` SET `masinhvien` = '$masinhvien', `hovaten` = '$hovaten', `gioitinh`= '$gioitinh', `diachi` ='$diachi', `email`='$email', `dienthoai`= '$phone', 
            `cmnd` ='$CMND', `ngaysinh` ='$ngaysinh', `GVCN` ='$giaovien', `chuyennganh`= '$chuyennganh' ,`lop`='$lop' WHERE id='$id'";
            
            return $this->execute($sql);
        }
        public function editgiangvienid($id){
            $sql = "select * from giangvien where `id`='$id' ";
            $data=$this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }

        public function editgiangvien($mgv,$hovaten,$gioitinh,$cmnd,$ngaysinh,$dienthoai,$email,$cn,$diachi,$id){
            $sql="UPDATE `giangvien` SET `magiangvien` = '$mgv' ,`hovaten`='$hovaten' , gioitinh='$gioitinh', chuyennganh = '$cn' ,ngaysinh = '$ngaysinh', cmnd='$cmnd', dienthoai='$dienthoai', email='$email', diachi='$diachi' WHERE id='$id'";
            return $this->execute($sql);
        }
        public function deletestudent($id){
            $sql="DELETE FROM sinhvien WHere id = '$id'";
            
            return $this->execute($sql);
        }
        public function deletegiangvien($id){
            $sql="DELETE FROM giangvien WHere id = '$id'";
            
            return $this->execute($sql);
        }
        public function getinfopoint($msv){
            $sql = "select * from `sinhvien-diemmon` inner join `monhoc` on `sinhvien-diemmon`.mamon=`monhoc`.mamon WHERE masinhvien='$msv'";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }

        public function tongtin($msv){
            $sql = "select SUM(sotinchi) as tongtin from `sinhvien-diemmon` inner join `monhoc` on `sinhvien-diemmon`.mamon=`monhoc`.mamon WHERE masinhvien='$msv'";
            $this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }
        
        public function tongdiem($msv){
            $sql = "select sum(sotinchi*diemtongket) as tongdiem from `sinhvien-diemmon` inner join `monhoc` on `sinhvien-diemmon`.mamon=`monhoc`.mamon WHERE masinhvien='$msv'";
            $this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }


        
        ///// LOGIN
        public function mkchecksinhvien($tk,$pass){
            $sql = "select * from `sinhvien` where `masinhvien`='$tk' and `password`='$pass'";
            $data=$this->execute($sql);
            return $data;
        }

        public function getinfosinhvien1($tk){
            $sql = "select * from sinhvien where `masinhvien`='$tk' ";
            echo $sql;
            $data=$this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }

        public function updatemksinhvien($msv,$mk){
            $sql="UPDATE dangnhap SET matkhau='$mk' WHERE taikhoan='$msv'";
            return $this->execute($sql);
        }



        //GV
        public function getinfogiangvien($tk){
            $sql = "select * from giangvien where `magiangvien`='$tk' ";
            $data=$this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }

        public function mkcheckgiangvien($tk,$pass){
            $sql = "select * from `giangvien` where `magiangvien`='$tk' and `password`='$pass'";
            $data=$this->execute($sql);
            return $data;
        }

        public function updategiangvien($mgv,$img,$gioitinh,$cmnd,$dienthoai,$email,$diachi){
            $sql="UPDATE giangvien SET `image`='$img', gioitinh='$gioitinh', cmnd='$cmnd', dienthoai='$dienthoai', email='$email', diachi='$diachi' WHERE magiangvien='$mgv'";
            return $this->execute($sql);
        }  

       
        public function updatemkgiangvien($mgv,$mk){
            $sql="UPDATE giangvien SET password='$mk' WHERE magiangvien='$mgv'";
            return $this->execute($sql);
        }
        public function getinfo_mon($mgv){
            $sql = "select DISTINCT tenmon from `gv-sv-lop` inner join monhoc on `gv-sv-lop`.mamon=monhoc.mamon where `magiangvien`='$mgv' ";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }
        public function getinfo_svl($mgv){
            $sql = "select DISTINCT * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 ORDER BY diemtongket ASC ";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }
        public function getinfo_svl_tt($mgv,$mm,$tt){
            if($tt=="Tất cả" && $mm=="Tất cả")
            {
                $sql = "select DISTINCT * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' ";
            }
            if($tt=="Tất cả" && $mm!="Tất cả")
            {
                $sql = "select DISTINCT * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.mamon='$mm'";
            }
            if($tt!="Tất cả" && $mm=="Tất cả")
            {
                if($tt=="Đang Học"){
                    $sql = "select DISTINCT * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.trangthai=1 ";
                }
                else{
                    $sql = "select DISTINCT * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.trangthai=0  ";
                }
            }
            if($tt!="Tất cả" && $mm!="Tất cả")
            {
                if($tt=="Đang Học"){
                    $sql = "select DISTINCT * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.trangthai=1 and gv.mamon='$mm'";
                }
                else{
                    $sql = "select DISTINCT * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.trangthai=0 and gv.mamon='$mm' ";
                }
            }

            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }
        public function getinfo_svmon($mgv,$mamon){
            $sql = "select DISTINCT * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien 
            INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon 
            where gv.`magiangvien`='$mgv' 
            AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 and gv.mamon='$mamon' ";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }
        public function getinfo_svmon_tt($mgv,$mamon,$tt){
            if($tt=="Tất cả")
            {
                $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien 
            INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv'
            and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien`";
            }
            else{
                if($tt=="Đang Học"){
                    $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien 
                    INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv'
                    and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1";
                }
                else{
                    $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien 
                    INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv'
                    and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=0";
                }
            }
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }
        public function getinfo_mamon($tm){
            $sql = "select * from monhoc where `tenmon`='$tm' ";
            $data=$this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }

        public function editsvid($id){
            $sql = "select * from sinhvien where `id`='$id' ";
            $data=$this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }
        public function getinfo_thapcao($mgv,$mamon){
            if($mamon=="Tất cả")
            {
                $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 ORDER BY diemtongket ASC";
            }
            else{
                $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 ORDER BY diemtongket ASC";
            }
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }
        
        public function getinfo_caothap($mgv,$mamon){
            if($mamon=="Tất cả")
            {
                $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 ORDER BY diemtongket DESC";
            }
            else{
                $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 ORDER BY diemtongket DESC";
            }
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }
        public function getinfo_tkcaothap($mgv,$mamon,$info){
            $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 and (gv.masinhvien LIKE '%$info%' or sv.hovaten LIKE '%$info%') ORDER BY diemtongket DESC";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }

        public function getinfo_tkthapcao($mgv,$mamon,$info){
            $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 and (gv.masinhvien LIKE '%$info%' or sv.hovaten LIKE '%$info%')";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }

        public function updiem($mm,$msv,$dqt,$dck,$dtk){
            $sql="UPDATE `sinhvien-diemmon` SET `diemquatrinh`='$dqt',`diemcuoiky`='$dck',`diemtongket`='$dtk' WHERE `masinhvien`='$msv'and `mamon`='$mm'";
            return $this->execute($sql);
        }
        public function capnhattt($msv,$mm,$tt){
            if($tt=='Đang học')
            {
                $sql="UPDATE `gv-sv-lop` SET `trangthai`=1 WHERE masinhvien='$msv'and mamon='$mm'";
            }
            else{
                $sql="UPDATE `gv-sv-lop` SET `trangthai`=0 WHERE masinhvien='$msv'and mamon='$mm'";
            }

            return $this->execute($sql);
        } 
        // public function getinfo_all($mgv,$mamon,$info){
        //     if($info=="Tất cả" && $mamon=="Tất cả")
        //     {
        //         $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien`";
        //     }
        //     else{
        //         if($mamon=="Tất cả"){
        //             if($info=="Đang Học"){
        //                 $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 ";
        //             }
        //             else{
        //                 $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=0 ";
        //             }
        //         }
        //         else{
        //             if($info=="Đang Học"){
        //                 $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 ";
        //             }
        //             else{
        //                 $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=0 ";
        //             }
        //         }
        //     }
        //     $this->execute($sql);
        //     if($this->dem()==0){
        //         $data=0;
        //     }
        //     else{
        //         while($datas = $this->getData()) {
        //             $data[] = $datas;
        //         }
        //     }
        //     return $data;
        // }
        public function getinfo_tk($mgv,$mamon,$info,$info_tt){
            if($info_tt=="Tất cả" && $mamon=="Tất cả")
            {
                $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` and (gv.masinhvien LIKE '%$info%' or sv.hovaten LIKE '%$info%')";
            }
            else{
                if($mamon=="Tất cả"){
                    if($info_tt=="Đang Học"){
                        $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 and (gv.masinhvien LIKE '%$info%' or sv.hovaten LIKE '%$info%')";
                    }
                    else{
                        $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=0 and (gv.masinhvien LIKE '%$info%' or sv.hovaten LIKE '%$info%')";
                    }
                }
                else{
                    if($info_tt=="Đang Học"){
                        $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=1 and (gv.masinhvien LIKE '%$info%' or sv.hovaten LIKE '%$info%')";
                    }
                    else{
                        $sql = "select * from  `gv-sv-lop` as gv INNER join sinhvien sv on gv.masinhvien = sv.masinhvien INNER join `sinhvien-diemmon` on `sinhvien-diemmon`.`mamon` = gv.mamon INNER JOIN monhoc on gv.mamon=monhoc.mamon where gv.`magiangvien`='$mgv' and gv.mamon='$mamon' AND gv.masinhvien=`sinhvien-diemmon`.`masinhvien` AND gv.trangthai=0 and (gv.masinhvien LIKE '%$info%' or sv.hovaten LIKE '%$info%')";
                    }
                }
            }
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }

        //daotao
        public function masinhvien()
        {
            $sql = "SELECT  masinhvien FROM `sinhvien` where id=(select MAX(id) from `sinhvien`)";
            $data=$this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }

        // public function listKQSV()
        // {
        //     $sql = "SELECT sv.masinhvien as masinhvien,sv.hovaten as hovaten,sum(mh.sotinchi) as sotinchi,ROUND(AVG(svdm.diemtongket),2) as diemtongket FROM `sinhvien` sv INNER join `sinhvien-diemmon` svdm on sv.masinhvien = svdm.masinhvien INNER join monhoc mh on mh.mamon = svdm.mamon GROUP BY sv.masinhvien";
        //     $this->execute($sql);
        //     if($this->dem()==0){
        //         $data=0;
        //     }
        //     else{
        //         while($datas = $this->getData()) {
        //             $data[] = $datas;
        //         }
        //     }
        //     return $data;
        // }

        public function getGiaoVienCN($machuyennganh)
        {
            $sql = "select magiangvien,hovaten from giangvien where chuyennganh = '$machuyennganh'";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;;
        }

        public function createstudent($masinhvien,$hovaten,$gioitinh,$CMND,$ngaysinh,$phone,$email,$chuyennganh,$giaovien,$diachi,$lop){
            $sql="INSERT INTO `sinhvien`(`masinhvien`, `hovaten`, `gioitinh`, `diachi`, `email`, `dienthoai`, `cmnd`, `ngaysinh`, `GVCN`, `chuyennganh`,  `password`,`lop`) 
            VALUES ('$masinhvien','$hovaten','$gioitinh','$diachi','$email','$phone','$CMND','$ngaysinh','$giaovien','$chuyennganh','$masinhvien','$lop')";
            
            return $this->execute($sql);
        }

        public function timkiemsinhvien($masinhvien){
            $sql = "select * from  `sinhvien`  where  masinhvien LIKE '%$masinhvien%' ";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }

        public function timkiemsinhvientheochuyennganh($machuyennganh){
            $sql = "select * from  `sinhvien`  where  chuyennganh = '$machuyennganh' ";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }

        public function timkiemmonhoctheomachuyennganh($machuyennganh){
            $sql = "select * from  `monhoc`  where  chuyennganh = '$machuyennganh' ";
           
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }


        public function giaovienmonhoc()
        {
            $sql="SELECT DISTINCT(giangvien.hovaten) FROM `giangvien` INNER JOIN chuyennganh on giangvien.chuyennganh=chuyennganh.machuyennganh INNER JOIN `gv-sv-lop` as gv on giangvien.magiangvien=gv.magiangvien INNER JOIN monhoc on gv.mamon=monhoc.mamon";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }

        public function timkiemmonhoc($timkiem)
        {
            $sql = "select * from  `monhoc`  where  (mamon like '%$timkiem%' or tenmon like '%$timkiem%') ";
           
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }

        public function timkiemgiangvientheochuyennganh($timkiem)
        {
            $sql = "select * from  `giangvien`  where  chuyennganh = '$timkiem' ";
           
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }

        public function timkiemgiangvien($timkiem)
        {
            $sql = "select * from  `giangvien`  where  (magiangvien like '%$timkiem%' or hovaten like '%$timkiem%') ";
           
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;
        }

        public function magiangvien()
        {
            $sql = "SELECT  magiangvien FROM `giangvien` where id=(select MAX(id) from `giangvien`)";
            $data=$this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }

        public function getLop($machuyennganh)
        {
            $sql = "select * from lopcn where chuyennganh = '$machuyennganh'";
            $this->execute($sql);
            if($this->dem()==0){
                $data=0;
            }
            else{
                while($datas = $this->getData()) {
                    $data[] = $datas;
                }
            }
            return $data;;
        }
        public function createnhanvien($magiangvien,$hovaten, $role_id,$gioitinh,$CMND,$ngaysinh,$phone,$email,$chuyennganh,$diachi,$lop){
            $sql="INSERT INTO `giangvien`(`magiangvien`, `hovaten`,`role_id`, `gioitinh`, `diachi`, `email`, `dienthoai`, `cmnd`, `ngaysinh`, `chuyennganh`,  `password`,`ChuNhiem`) 
            VALUES ('$magiangvien','$hovaten', $role_id,'$gioitinh','$diachi','$email','$phone','$CMND','$ngaysinh','$chuyennganh','$magiangvien','$lop')";
           
            return $this->execute($sql);
        }
        public function creategiangvien($magiangvien,$hovaten,$gioitinh,$CMND,$ngaysinh,$phone,$email,$chuyennganh,$diachi,$lop){
            $sql="INSERT INTO `giangvien`(`magiangvien`, `hovaten`, `gioitinh`, `diachi`, `email`, `dienthoai`, `cmnd`, `ngaysinh`, `chuyennganh`,  `password`,`ChuNhiem`) 
            VALUES ('$magiangvien','$hovaten','$gioitinh','$diachi','$email','$phone','$CMND','$ngaysinh','$chuyennganh','$magiangvien','$lop')";
           
            return $this->execute($sql);
        }
        
        public function countsSV(){
            $sql = 'SELECT count(*) as sl  from sinhvien';
            return $this->executeResult($sql);
        }
        public function countsGV(){
            $sql = 'SELECT count(*) as sl  from giangvien where role_id = 2';
            return $this->executeResult($sql);
        }
        public function countsNV(){
            $sql = 'SELECT count(*) as sl  from giangvien where role_id = 3';
            return $this->executeResult($sql);
        }
        public function countsSVNam(){
            $sql = 'SELECT count(*) as sl  from sinhvien  where gioitinh = "Nam"';
            return $this->executeResult($sql);
        }
        public function countsGVNam(){
            $sql = 'SELECT count(*) as sl  from giangvien where gioitinh = "Nam"';
            return $this->executeResult($sql);
        }
        public function monhocSL(){
            $sql = 'SELECT count(*) as sl  from monhoc';
            return $this->executeResult($sql);
        }
        public function chuyennganhSL(){
            $sql = 'SELECT count(*) as sl  from chuyennganh';
            return $this->executeResult($sql);
        }
        public function giangvienSL(){
            $sql = 'SELECT count(*) as sl  from giangvien';
            return $this->executeResult($sql);
        }
        public function countsSVNu(){
            $sql = 'SELECT count(*) as sl  from sinhvien  where gioitinh = "Nữ"';
            return $this->executeResult($sql);
        }
        public function countsGVNu(){
            $sql = 'SELECT count(*) as sl  from giangvien  where gioitinh = "Nữ"';
            return $this->executeResult($sql);
        }
        public function capnhattt_gv($mgv,$tt){
            if($tt=='Đang dạy')
            {
                $sql="UPDATE `giangvien` SET `trangthai`=1 WHERE magiangvien='$mgv'";
            }
            else{
                $sql="UPDATE `giangvien` SET `trangthai`=0 WHERE magiangvien='$mgv'";
            }
            echo  $sql;
            return $this->execute($sql);
        }
        public function getinfo_gvtt($tt){
            if($tt=="Tất cả"){
                $sql = "select * from giangvien";
            }
            else{
                if($tt=="Đang dạy"){
                    $sql = "select * from giangvien where trangthai=1";
                }
                else{
                    $sql = "select * from giangvien where trangthai=0";
                }
            }
            return $this->execute($sql);
        }
        
        public function uptrangthai($msv,$tt){
            $sql="UPDATE `sinhvien` SET `trangthai_sv`='$tt' WHERE masinhvien='$msv'";
            echo $sql;
            return $this->execute($sql);
        }
        public function getmcn($tcn){
            $sql="select * from chuyennganh where tenchuyennganh='$tcn'";
            $data=$this->execute($sql);
            if($this->dem()!=0){
                $data = mysqli_fetch_array($this->result);
            }
            else{
                $data = 0;
            }
            return $data;
        }

        public function themmon($mm,$tm,$stc,$ca,$thu,$cn){
            $sql="INSERT INTO `monhoc`( `mamon`, `tenmon`, `sotinchi`, `chuyennganh`, `thu`, `ca`) 
            VALUES ('$mm','$tm','$stc','$cn','$thu','$ca')";
            return $this->execute($sql);
        }
        public function tkb(){
            $sql=" SELECT DISTINCT(monhoc.mamon), monhoc.tenmon, monhoc.sotinchi, monhoc.thu, monhoc.ca, giangvien.hovaten FROM monhoc INNER JOIN `gv-sv-lop` as gv on monhoc.mamon=gv.mamon INNER JOIN giangvien on gv.magiangvien= giangvien.magiangvien ";
            return $this->execute($sql);
        }
        
    }