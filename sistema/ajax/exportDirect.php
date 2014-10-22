<?php     
/**
 * Export CSV or XLSX direct to browser
**/

require_once '../classes/dbClass.php';
$db = new DB;
require_once '../classes/logging.php';
$log = new Log($dbPre);

$type = $_POST['type'];

$sql = "select c.*, ls.sourceName, lst.statusName, lt.typeName"
     . " from {$dbPre}contacts c, {$dbPre}leadSource ls, {$dbPre}leadStatus lst, {$dbPre}leadType lt"
     . " where c.leadType=lt.typeID and c.leadSource=ls.sourceID and c.lStatus=lst.id"
     . " order by lastName asc";
$contacts = $db->extQuery($sql);

$sql = "select * from {$dbPre}siteSettings";
$siteSettings = $db->extQueryRowObj($sql);

$columns = array(
         'Id', 
         'First Name',
         'Last Name',
         $siteSettings->Phone,
         $siteSettings->secondaryPhone,
         $siteSettings->Fax,
         'Email',
         'Secondary Email1',
         'Secondary Email2',
         'Secondary Email3',
         $siteSettings->Address,
         $siteSettings->City,
         $siteSettings->State,
         $siteSettings->Country,
         $siteSettings->Zip,
         'Source',
         'Type',
         'Status',
    'Motivo',
    // necessidades 
    
    
         "Desejo Informacoes",
         "Quant. de linhas",
         "Plano Atual",
         "falarsobrenecessidade",
         "melhorhoracontato",
       
    
    
         "$siteSettings->customField1",
         "$siteSettings->customField2",
         "$siteSettings->customField3",
         "$siteSettings->customField4",
         "$siteSettings->customField5",
         "$siteSettings->customField6",
         "$siteSettings->customField7",
         "$siteSettings->customField8",
         "$siteSettings->customField9",
         "$siteSettings->customField10",
         "$siteSettings->customField11",
    
         "$siteSettings->customField12",
         "$siteSettings->customField13",
         "$siteSettings->customField14",
         "$siteSettings->customField15",
         "$siteSettings->customField16",
         "$siteSettings->customField17",
         "$siteSettings->customField18",
         "$siteSettings->customField19",
         "$siteSettings->customField20",
         "$siteSettings->customField21",
    
    
         "$siteSettings->customField22",
         "$siteSettings->customField23",
         "$siteSettings->customField24",
         "$siteSettings->customField25",
         "$siteSettings->customField26",
         "$siteSettings->customField27",
         "$siteSettings->customField28",
         "$siteSettings->customField29",
         "$siteSettings->customField30",
     "$siteSettings->idade",
    
         'Notes',
    
      'Data de Entrada',
    'Data de Envio',
         'Enviadospara'
);

// PHPExcel_IOFactory
include_once '../classes/PHPExcel/Classes/PHPExcel.php';
// PHPExcel_Writer_Excel2007
include_once '../classes/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
PHPExcel_Settings::setCacheStorageMethod($cacheMethod);
//Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("CPTarget");
$objPHPExcel->getProperties()->setLastModifiedBy("CPTarget");
$objPHPExcel->getProperties()->setTitle("Exportação - CPTarget");
$objPHPExcel->getProperties()->setSubject("Exportação de leads");
$objPHPExcel->getProperties()->setDescription("Export from LCM of Leads and Contacts.");

// Sheet 0 //
$objPHPExcel->setActiveSheetIndex(0);
// Header Row
$row = 1;
$col = 0;
foreach ($columns as $val) {
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val);
    $col++;
}



/*
// Entries
$row = 2;
foreach ($contacts as $key => $val) {
    $noteMerge = '';
    $sql = "select * from {$dbPre}otherEmails where contact='$val->id'";
    $emails = $db->extQuery($sql);
    $sql = "select * from {$dbPre}leadNotes where leadID='$val->id'";
    $notes = $db->extQuery($sql);
    foreach ($notes as $line => $note) {
        $newNote = strip_tags($note->Note);
        $noteMerge = $noteMerge . '--' . $newNote . "\r\n";
    }
    $email1 = isset($emails[0]->email) ? $emails[0]->email : '';
    $email2 = isset($emails[1]->email) ? $emails[1]->email : '';
    $email3 = isset($emails[2]->email) ? $emails[2]->email : '';
    //$col = 0;
 * 
 * 
 * 
 */

// Entries
$row = 2;
foreach ($contacts as $key => $val) {
   $enviado['email']= ''; 
    $noteMerge = '';
    $sql = "select * from {$dbPre}otherEmails where contact='$val->id'";
    $emails = $db->extQuery($sql);
    $sql = "select * from {$dbPre}leadNotes where leadID='$val->id'";
    $notes = $db->extQuery($sql);
  //select dos enviados 
  //   echo' executou uma query nos enviados  ->>>>>  id do lead pesquisado  '. $val->id;
    $sql = "select * from enviados where leadid={$val->id} limit 1 ";
   $enviado = $db->extQuery($sql);
  //  print_r($enviado);
   
    // $caralho = $enviado[0]->email;
   
 $buceta = $enviado[0]->dataenvio;
    foreach ($notes as $line => $note) {
        $newNote = strip_tags($note->Note);
        $noteMerge = $noteMerge . '--' . $newNote . "\r\n";
    }
    $email1 = isset($emails[0]->email) ? $emails[0]->email : '';
    $email2 = isset($emails[1]->email) ? $emails[1]->email : '';
    $email3 = isset($emails[2]->email) ? $emails[2]->email : '';
    
    

    $caralho = isset($enviado[0]->email) ? $enviado[0]->email : 'N/A'; 
          
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $val->id);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $val->firstName);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $val->lastName);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $val->Phone);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $val->secondaryPhone);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $val->Fax);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $val->Email);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $email1);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $email2);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $email3);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $val->Address);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $val->City);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $val->State);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $val->Country);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $val->Zip);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $val->sourceName);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $val->typeName);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $val->statusName);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $val->motivo);
    
    
    // necessidades e e tc 
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $val->desejoinfode);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $val->quantlinhas);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $row, $val->planopjatual);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, $row, $val->falarsobrenecessidade);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, $row, $val->melhorhoracontato);
    
    
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(24, $row, $val->customField);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(25, $row, $val->customField2);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26, $row, $val->customField3);
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(27, $row, $val->customField4);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(28, $row, $val->customField5);
        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(29, $row, $val->customField6);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(30, $row, $val->customField7);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(31, $row, $val->customField8);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(32, $row, $val->customField9);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(33, $row, $val->customField10);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(34, $row, $val->customField11);
        
        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(35, $row, $val->customField12);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(36, $row, $val->customField13);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(37, $row, $val->customField14);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(38, $row, $val->customField15);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(39, $row, $val->customField16);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(40, $row, $val->customField17);
        
        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(41, $row, $val->customField18);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(42, $row, $val->customField19);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(43, $row, $val->customField20);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(44, $row, $val->customField21);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(45, $row, $val->customField22);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(46, $row, $val->customField23);
        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(47, $row, $val->customField24);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(48, $row, $val->customField25);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(49, $row, $val->customField26);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(50, $row, $val->customField27);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(51, $row, $val->customField28);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(52, $row, $val->customField29);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(53, $row, $val->customField30);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(54, $row, $val->idade);  
        
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(55, $row, $noteMerge);
  
    
     $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(56, $row, $val->dateAdded);
 $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(56)->setAutoSize(true);    
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(57, $row, $buceta);
$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(57)->setAutoSize(true);  
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(58, $row,$caralho);
$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(58)->setAutoSize(true);      
    
    $colStr = PHPExcel_Cell::stringFromColumnIndex(58);     
    $objPHPExcel->getActiveSheet()->getStyle($colStr . $row)->getAlignment()->setWrapText(true);
    $row++;
}

// Choose output format 
if ($type == 'csv') {    // Save csv FILE

    $objWriter = new PHPExcel_Writer_CSV($objPHPExcel);
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename=CPTarget-Export.csv');
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
                $objWriter->save('php://output');

} elseif ($type == 'excel') {  // Save Excel 2007 file
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename=CPTarget-Export.xlsx');
                $objWriter->save('php://output');
}


