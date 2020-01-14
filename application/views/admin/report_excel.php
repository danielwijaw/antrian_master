<?php 
    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    require dirname(__DIR__) . '/../../vendor/autoload.php';

    $data = current_url();
    $pecah = explode("/", $data);
    $json = file_get_contents(base_url('/backend/antrian_full_date/'.$pecah[5]));
    $obj = json_decode($json, true);
    $obj = $obj['results'];

    if($pecah[6]=='excel'){
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('Antrian 2020')
            ->setLastModifiedBy('Antrian 2020')
            ->setTitle('Laporan Data '.$pecah[5])
            ->setSubject('Laporan Data '.$pecah[5])
            ->setDescription('Laporan Data '.$pecah[5])
            ->setKeywords('Laporan Data '.$pecah[5])
            ->setCategory('Laporan');

        $no = 1;
        foreach($obj as $key => $value){
            $nomor = $no++;
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$nomor, $value['penjamin_text'])
            ->setCellValue('B'.$nomor, $value['poliklinik_text'])
            ->setCellValue('C'.$nomor, $value['dokter_text'])
            ->setCellValue('D'.$nomor, $value['hari'].','.$value['tanggal'])
            ->setCellValue('E'.$nomor, $value['nomor_rm'])
            ->setCellValue('F'.$nomor, $value['alamat'])
            ->setCellValue('G'.$nomor, $value['nomor_urut'])
            ->setCellValue('H'.$nomor, $value['is_online']);
        };

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Laporan Data ');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Data '.$pecah[5].'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }else{ error_reporting(0); ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>Penjamin</td>
                    <td>Poliklinik</td>
                    <td>Dokter</td>
                    <td>Hari , Tanggal</td>
                    <td>Nomor RM</td>
                    <td>Alamat</td>
                    <td>Nomor Urut</td>
                    <td>Jenis Pendaftaran</td>
                </tr>
                <?php foreach($obj as $key => $value){  ?>
                <tr>
                    <td><?php echo $value['penjamin_text'] ?></td>
                    <td><?php echo $value['poliklinik_text'] ?></td>
                    <td><?php echo $value['dokter_text'] ?></td>
                    <td><?php echo $value['hari'].','.$value['tanggal'] ?></td>
                    <td><?php echo $value['nomor_rm'] ?></td>
                    <td><?php echo $value['alamat'] ?></td>
                    <td><?php echo $value['nomor_urut'] ?></td>
                    <td><?php echo $value['is_online'] ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
<?php } ?>