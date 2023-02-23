<?php
require_once(__DIR__ . "/BaseModel.php");
class Product extends BaseModel
{
    public function getPageProducts( $number_page,$from)
    {
        $sql = "SELECT * FROM tbl_sp ORDER BY id ASC LIMIT $from, $number_page";
        $products = $this->getData($sql);
        return $products;
    }

    public function createProduct(){
        $sql = "SELECT * FROM tbl_nsx";
        return $this->getData($sql);
    }

    public function postProduct($ten_sp, $ma_sp,$ngay_sx,$ma_nsx) {
        $sql = "INSERT INTO `tbl_sp` (`ten_sp`,`ma_sp`,`ngay_sx`,`ma_nsx`) VALUE ('$ten_sp','$ma_sp','$ngay_sx','$ma_nsx')";
        return $this->execute($sql);
    }

    public function getProduct($id)
    {
        $sql = "SELECT * FROM tbl_sp WHERE id = $id";
        return $this->getData($sql);
    }

    public function updateProduct($id, $ten_sp, $ma_sp, $ngay_sx)
    {
        $sql = "UPDATE `tbl_sp` SET ten_sp = '$ten_sp', ma_sp = '$ma_sp', ngay_sx = '$ngay_sx' WHERE id = '$id' ";
        return $this->execute($sql);
    }

    public function getCodeProduct($ma_sp, $id)
    {
        $sql = "SELECT * FROM tbl_sp WHERE ma_sp = '$ma_sp' AND id != $id";
        return $this->getData($sql);
    }
     public function checkCodeProduct($ma_sp)
    {
        $sql = "SELECT * FROM tbl_sp WHERE ma_sp = '$ma_sp'";
        return $this->getData($sql);
    }

    public function deleteProduct ($id)
    {
        $sql = "DELETE FROM tbl_sp WHERE id = $id";
        return $this->delete($sql);
    }

}