<?php
/**
 * 
 */
namespace Home\Controller;
use Think\Controller;

class ExcelController extends Controller {

        function index(){
                vendor("Excel.PHPExcel");
                //vendor("Excel.PHPExcel.IOFactory");
                $phpexcel = new \PHPExcel();
                $activeSheetIndex = $phpexcel->getActiveSheetIndex();
                //var_dump($activeSheetIndex);
                $activeSHeet = $phpexcel->getActiveSheet();
                
                $activeSHeet->setCellValueExplicit("A1","掉落ID");
                 $activeSHeet->setCellValueExplicit("B1","掉落ID");

                $objWriter = \PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment; filename=test.xls');
                header('Pragma: no-cache');
                header('Expires: 0');
                $objWriter->save("php://output");
        }
}