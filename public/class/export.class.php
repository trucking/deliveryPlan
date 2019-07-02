<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17-6-13
 * Time: 涓嬪崍2:41
 */
/*
ob_clean();
include 'PHPExcel.php';
include 'PHPExcel/Writer/Excel2007.php';
//鎴栬?include 'PHPExcel/Writer/Excel5.php'; 鐢ㄤ簬杈撳嚭.xls鐨?
//鍒涘缓涓?釜excel
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'String');
$objPHPExcel->getActiveSheet()->setCellValue('A2', 12);
$objPHPExcel->getActiveSheet()->setCellValue('A3', true);
$objPHPExcel->getActiveSheet()->setCellValue('C5', '=SUM(C2:C4)');
$objPHPExcel->getActiveSheet()->setCellValue('B8', '=MIN(B2:C5)');
// 杈撳嚭Excel琛ㄦ牸鍒版祻瑙堝櫒涓嬭浇
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="abc.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);

$objWriter->save('php://output');
*/
include 'PHPExcel.php';
include 'PHPExcel/Writer/Excel2007.php';
include 'PHPExcel/Writer/Excel5.php';
class export
{
    private $objPHPExcel;

    public function __construct($fileName,$title,$value)
    {
        ob_clean();
        $this->objPHPExcel = new PHPExcel();

        $this->objPHPExcel->setActiveSheetIndex(0);
        $this->setTitle($title);
        $this->setValue($value);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = new PHPExcel_Writer_Excel5($this->objPHPExcel);

        $objWriter->save('php://output');
    }

    private function setTitle(array $arr)
    {
        $column = 65;
        $rower = 1;
        foreach($arr as $v)
        {
            $cell = chr($column).$rower;
            $this->objPHPExcel->getActiveSheet()->setCellValue($cell,$this->transStr($v));
            $column++;
        }
    }

    private function setValue(array $arr)
    {
        $column = 65;
        $rower = 1;
        foreach($arr as $v)
        {
            $column = 65;
            $rower++;
            foreach($v as $val)
            {
                $cell = chr($column).$rower;
                $this->objPHPExcel->getActiveSheet()->setCellValue($cell,$this->transStr($val));
                $column++;
            }
        }
    }

    private function transStr($str)
    {
        return iconv("GB2312","UTF-8//IGNORE",$str);
    }
}