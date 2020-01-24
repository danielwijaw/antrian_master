<?php 
    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    require FCPATH. '/vendor/autoload.php';

    $data = current_url();
    $pecah = explode("/", $data);
    $json = file_get_contents(base_url('/backend/antrian_full_date/'.$pecah[5]."/".$pecah[7]));
    $obj = json_decode($json, true);
    $obj = $obj['results'];

    if($pecah[6]=='excel'){
        $this->load->helper('download');
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
            ->setCellValue('A'.$nomor, $value['type_patient'])
            ->setCellValue('B'.$nomor, $value['penjamin_text'])
            ->setCellValue('C'.$nomor, $value['poliklinik_text'])
            ->setCellValue('D'.$nomor, $value['dokter_text'])
            ->setCellValue('E'.$nomor, $value['hari'].','.$value['tanggal'])
            ->setCellValue('F'.$nomor, $value['nomor_rm'])
            ->setCellValue('G'.$nomor, $value['nama_pasien'])
            ->setCellValue('H'.$nomor, $value['alamat'])
            ->setCellValue('I'.$nomor, $value['nomor_urut'])
            ->setCellValue('J'.$nomor, $value['is_online']);
        };

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Laporan Data ');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $fileName = "Laporan Data".$pecah[5].'.xlsx';

        $this->output->set_header('Content-Type: application/vnd.ms-excel');
        $this->output->set_header("Content-type: application/csv");
        $this->output->set_header('Cache-Control: max-age=0');
        $writer->save(FCPATH."/xlsx/".$fileName); 
        //redirect(HTTP_UPLOAD_PATH.$fileName); 
        $filepath = file_get_contents(FCPATH."/xlsx/".$fileName);
        force_download($fileName, $filepath);
        exit;
    }else{ error_reporting(0); ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>Jenis Pasien</td>
                    <td>Penjamin</td>
                    <td>Poliklinik</td>
                    <td>Dokter</td>
                    <td>Hari , Tanggal</td>
                    <td>Nomor RM</td>
                    <td>Nama Pasien</td>
                    <td>Alamat</td>
                    <td>Nomor Urut</td>
                    <td>Jenis Pendaftaran</td>
                </tr>
                <?php foreach($obj as $key => $value){  ?>
                <tr>
                    <td><?php echo $value['type_patient'] ?></td>
                    <td><?php echo $value['penjamin_text'] ?></td>
                    <td><?php echo $value['poliklinik_text'] ?></td>
                    <td><?php echo $value['dokter_text'] ?></td>
                    <td><?php echo $value['hari'].','.$value['tanggal'].' ('.$value['jam_praktik'].' )'; ?></td>
                    <td><?php echo $value['nomor_rm'] ?></td>
                    <td><?php echo $value['nama_pasien'] ?></td>
                    <td><?php echo $value['alamat'] ?></td>
                    <td><?php echo $value['nomor_urut'] ?></td>
                    <td><?php echo $value['is_online'] ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
<?php } ?>