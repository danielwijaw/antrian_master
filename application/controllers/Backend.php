<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/API_Controller.php';
require FCPATH. '/vendor/autoload.php';

class backend extends API_Controller {

	public function index()
	{
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

		// return data
		$this->api_return(
			[
				'status' => true,
				"result" => "Api Oke",
			],
		200);
    }

	public function jenis_penjamin()
	{
        $this->load->helper('api_helper');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        if(isset($_GET['q'])){
            $query = " and JSON_SEARCH(child_value, 'one', '%".$_GET['q']."%') IS NOT NULL";
        }else{
            $query = "and 1=1";
        };
        
        $query = $this->db->query(
        "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'jenis_penjamin' and
            deleted_by = '0' ".$query."
        "
        );

        $data = [];
        foreach($query->result_array() as $key => $val){
            $data[$key]['id'] = my_simple_crypt($val['id'],'e');
            $data[$key]['text'] = $val['text'];
        }

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $data,
			],
		200);
    }
    
    public function poliklinik()
	{
        $this->load->helper('api_helper');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        if(isset($_GET['q'])){
            $query = " and JSON_SEARCH(child_value, 'one', '%".$_GET['q']."%') IS NOT NULL";
        }else{
            $query = "and 1=1";
        };
        
        $query = $this->db->query(
        "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'poliklinik' and
            deleted_by = '0' ".$query."
        "
        );

        $data = [];
        foreach($query->result_array() as $key => $val){
            $data[$key]['id'] = my_simple_crypt($val['id'],'e');
            $data[$key]['text'] = $val['text'];
        }

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $data,
			],
		200);
    }

    public function hakakses()
	{
        $this->load->helper('api_helper');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        if(isset($_GET['q'])){
            $query = " and JSON_SEARCH(child_value, 'one', '%".$_GET['q']."%') IS NOT NULL";
        }else{
            $query = "and 1=1";
        };
        
        $query = $this->db->query(
        "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'level_user' and
            deleted_by = '0' ".$query."
        "
        );

        $data = [];
        foreach($query->result_array() as $key => $val){
            $data[$key]['id'] = my_simple_crypt($val['id'],'e');
            $data[$key]['text'] = $val['text'];
        }

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $data,
			],
		200);
    }
    
    public function dokter_poli()
	{
        $this->load->helper('api_helper');
        $this->load->helper('cookie');
        $_GET['id_poli'] = my_simple_crypt($_GET['id_poli'], 'd');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        if(isset($_GET['q'])){
            $query = " and JSON_SEARCH(child_value, 'one', '%".$_GET['q']."%') IS NOT NULL";
        }else{
            $query = "and 1=1";
        };
        
        $query = $this->db->query(
        "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k3\")
            ) as poli_id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k4\")
            ) as poli_name
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'dokter' and
            JSON_EXTRACT(child_value, \"$.k3\") = '".$_GET['id_poli']."' and
            deleted_by = '0' ".$query."
        "
        );

        $context = stream_context_create([
            "http" => [
                "method" => "GET",
                "header" => "Accept-languange: en\r\n" .
                "Cookie: cookielogin=".get_cookie("cookielogin")
            ]
        ]);

        $cuti_json = file_get_contents(base_url('backend/hari_tanggal_dokter'), false, $context);
        $cuti_data = json_decode($cuti_json, true);
        $cuti_data = $cuti_data['results'];

        foreach($cuti_data as $keyc => $valc){
            $jadwal_exist[] = my_simple_crypt($valc['doctor_id'], 'd');
        }

        $data = [];
        $number = 0;
		foreach($query->result_array() as $key => $val){
            if(in_array($val['id'], $jadwal_exist)){
                $data[$number]['id'] = my_simple_crypt($val['id'],'e');
                $data[$number]['text'] = $val['text'];
                $data[$number]['attribute'] = $val['poli_name'];
                $number++;
            }
        }

        ksort($data);

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $data,
			],
		200);
    }

    public function dokter()
	{
        $this->load->helper('api_helper');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        if(isset($_GET['q'])){
            $query = " and JSON_SEARCH(child_value, 'one', '%".$_GET['q']."%') IS NOT NULL";
        }else{
            $query = "and 1=1";
        };
        
        $query = $this->db->query(
        "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k3\")
            ) as poli_id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k4\")
            ) as poli_name
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'dokter' and
            deleted_by = '0' ".$query."
        "
        );

        $data = [];
		foreach($query->result_array() as $key => $val){
            $data[$key]['id'] = my_simple_crypt($val['id'],'e');
            $data[$key]['text'] = $val['text']." || ".$val['poli_name'];
        }

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $data,
			],
		200);
    }

    public function get_list_today()
    {
        $this->load->helper('api_helper');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);
        
        $now  = getdate();
        $mday = $now['mday'];
        $mon  = $now['mon'];
        $year = $now['year'];
        $wday = $now['wday'];
        $days = date('t');

        $convert = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        ];

        $query = $this->db->query(
            "SELECT
                child_id as id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k2\")
                ) as date,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k3_count\")
                ) as count,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k3_finish\")
                ) as finish,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k3_mulai\")
                ) as start,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k4\")
                ) as doctor_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k4_text\")
                ) as doctor_detail
            FROM
                tm_data 
            WHERE
                JSON_SEARCH(UPPER(child_value), 'all', UPPER('%".$convert[$wday]."%')) IS NOT NULL and
                JSON_EXTRACT(child_value, \"$.k0\") = 'jadwal_dokter' and
                deleted_by = '0'
            "
            );
    
        $result = $query->result_array();

        $numbering = 0;
        foreach($result as $key => $value){
            $result[$key]['count'] = JSON_DECODE($value['count'], true);
            $result[$key]['finish'] = JSON_DECODE($value['finish'], true);
            $result[$key]['start'] = JSON_DECODE($value['start'], true);
        };
        
        foreach($result as $key2 => $value2){
            foreach($value2['count'] as $keyv => $valv){
                $doctor_jadwal[] = [
                    'id'     => my_simple_crypt($value2['doctor_id'], 'e'),
                    'doctor_detail' => $value2['doctor_detail'],
                    'count'         => $valv,
                    'jam_praktik'   => $value2['start'][$keyv]." - ".$value2['finish'][$keyv]
                ];
            }
        }

        if($result){
            $status = true;
            $json = $doctor_jadwal;
        }else{
            $status = false;
            $json = "Failed Catching Data";
        }

        $this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function dokter_poli_all()
	{
        $this->load->helper('api_helper');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);
        
        $query = $this->db->query(
        "SELECT
            tm_data.child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data.child_value, \"$.k2\")
            ) as text,
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data.child_value, \"$.k3\")
            ) as poli_id,
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data.child_value, \"$.k4\")
            ) as poli_name
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(tm_data.child_value, \"$.k0\") = 'dokter' and
            deleted_by = '0'
        "
        );

		$result = $query->result_array();

        foreach($result as $key => $value){
            $result[$key]['id'] = my_simple_crypt($value['id'], 'e');
            $result[$key]['poli_id'] = my_simple_crypt($value['poli_id'], 'e');
        }

        if($result){
            $status = true;
            $json = $result;
        }else{
            $status = false;
            $json = "Failed Catching Data";
        }

        $this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function hari_tanggal_dokter()
	{
        $this->load->helper('api_helper');
        $this->load->helper('cookie');
        $cookie = get_cookie("cookielogin");
        if(isset($_GET['id_dokter'])){
            $_GET['id_dokter'] = my_simple_crypt($_GET['id_dokter'], 'd');
            $where_q1 = " JSON_EXTRACT(child_value, \"$.k4\") = '".$_GET['id_dokter']."' and ";
            $where_q2 = " JSON_EXTRACT(child_value, \"$.k3\") = '".$_GET['id_dokter']."' and ";
        }else{
            $where_q1 = "";
            $where_q2 = "";
        }
        if($cookie==null){
            $hari_antrian = config_item('day_antrian_online');
        }else{
            $cookie = JSON_DECODE($cookie, true);
            $hari_antrian = config_item('day_antrian_offline');
        }
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        if(isset($_GET['q'])){
            $query = " and JSON_SEARCH(child_value, 'one', '%".$_GET['q']."%') IS NOT NULL";
        }else{
            $query = "and 1=1";
        };
        
        $query = $this->db->query(
        "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k4\")
            ) as doctor_id
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'jadwal_dokter' and
            ".$where_q1."
            deleted_by = '0' ".$query."
        "
        );

        $result = $query->result_array();

        $query_2 = $this->db->query(
            "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k3\")
            ) as doctor_id
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'libur_dokter' and
            ".$where_q2."
            JSON_EXTRACT(child_value, \"$.k1\") > '".date('Y-m-d')."' and
            deleted_by = '0' "
        );
        
        $result_2 = $query_2->result_array();

        $now  = getdate();
        $mday = $now['mday'];
        $mon  = $now['mon'];
        $year = $now['year'];
        $wday = $now['wday'];
        $days = date('t');

        $convert = [
            'Senin'     => 1,
            'Selasa'    => 2,
            'Rabu'      => 3,
            'Kamis'     => 4,
            'Jumat'     => 5,
            'Sabtu'     => 6,
            'Minggu'    => 7
        ];
        

        foreach($result as $key => $value){
            $result[$key]['wday'] = $convert[$value['text']];
            $hari_jadwal[$convert[$value['text']]] = $value['id'];
        }
        
        $hari = [
                'Minggu',
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu'
                ];
        $bulan = [
                '',
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'Nopember',
                'Desember'
                ];
        
        $tanggal = [];

        $liburan = [];
        foreach($result_2 as $key => $value){
            $liburan[$value['doctor_id']][] = $value['text'];
        }

        $n = 0;
        while($n<$hari_antrian){$n++;
            if($mday>$days){
                $mday = 1;
                if($mon>=12){
                    $mon = 1;
                    $year++;
                }else $mon++;
                $days = date('t',mktime(0,0,0,$mon,$mday,$year));
            }
            if($wday>=7)$wday = 0;
            $val = $year.'-';
            if($mon<10)$val.='0';
            $val.= $mon.'-';
            if($mday<10)$val.='0';
            $val.= $mday;
            foreach($result as $rkey => $rvalue){
                error_reporting(0);
                if($cookie==null){
                    if(array_key_exists($wday, $hari_jadwal) && !in_array($val, $liburan[$rvalue['doctor_id']]) && !in_array($val, [date('Y-m-d')])){
                        $tanggal[] =[
                            'id' => my_simple_crypt($val,'e'),
                            'text'  => $hari[$wday].', '.$mday.' '.$bulan[$mon].' '.$year,
                            'child_id' => my_simple_crypt($hari_jadwal[$wday],'e'),
                            'doctor_id' => my_simple_crypt($rvalue['doctor_id'],'e')
                        ];
                    };
                }else{
                    if($cookie['role_user_access']==my_simple_crypt('0','e')){
                        if(array_key_exists($wday, $hari_jadwal) && !in_array($val, $liburan[$rvalue['doctor_id']])){
                            $tanggal[] =[
                                'id' => my_simple_crypt($val,'e'),
                                'text'  => $hari[$wday].', '.$mday.' '.$bulan[$mon].' '.$year,
                                'child_id' => my_simple_crypt($hari_jadwal[$wday],'e'),
                                'doctor_id' => my_simple_crypt($rvalue['doctor_id'],'e')
                            ];
                        };
                    }else{
                        if(array_key_exists($wday, $hari_jadwal) && !in_array($val, $liburan[$rvalue['doctor_id']]) && !in_array($val, [date('Y-m-d')])){
                            $tanggal[] =[
                                'id' => my_simple_crypt($val,'e'),
                                'text'  => $hari[$wday].', '.$mday.' '.$bulan[$mon].' '.$year,
                                'child_id' => my_simple_crypt($hari_jadwal[$wday],'e'),
                                'doctor_id' => my_simple_crypt($rvalue['doctor_id'],'e')
                            ];
                        };
                    }
                }
            }
            $wday++;
            $mday++;
        };

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $tanggal,
			],
		200);
    }
    
    public function hari_tanggal()
	{
        $this->load->helper('api_helper');
        $this->load->helper('cookie');
        $cookie = get_cookie("cookielogin");
        $_GET['id_dokter'] = my_simple_crypt($_GET['id_dokter'], 'd');
        if($cookie==null){
            $hari_antrian = config_item('day_antrian_online');
        }else{
            $cookie = JSON_DECODE($cookie, true);
            $hari_antrian = config_item('day_antrian_offline');
        }
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        if(isset($_GET['q'])){
            $query = " and JSON_SEARCH(child_value, 'one', '%".$_GET['q']."%') IS NOT NULL";
        }else{
            $query = "and 1=1";
        };
        
        $query = $this->db->query(
        "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'jadwal_dokter' and
            JSON_EXTRACT(child_value, \"$.k4\") = '".$_GET['id_dokter']."' and
            deleted_by = '0' ".$query."
        "
        );

        $result = $query->result_array();

        $query_2 = $this->db->query(
            "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'libur_dokter' and
            JSON_EXTRACT(child_value, \"$.k3\") = '".$_GET['id_dokter']."' and
            JSON_EXTRACT(child_value, \"$.k1\") > '".date('Y-m-d')."' and
            deleted_by = '0' "
        );
        
        $result_2 = $query_2->result_array();

        $now  = getdate();
        $mday = $now['mday'];
        $mon  = $now['mon'];
        $year = $now['year'];
        $wday = $now['wday'];
        $days = date('t');

        $convert = [
            'Senin'     => 1,
            'Selasa'    => 2,
            'Rabu'      => 3,
            'Kamis'     => 4,
            'Jumat'     => 5,
            'Sabtu'     => 6,
            'Minggu'    => 7
        ];
        

        foreach($result as $key => $value){
            $result[$key]['wday'] = $convert[$value['text']];
            $hari_jadwal[$convert[$value['text']]] = $value['id'];
        }
        
        $hari = [
                'Minggu',
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu'
                ];
        $bulan = [
                '',
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'Nopember',
                'Desember'
                ];
        
        $tanggal = [];

        $liburan = [];
        foreach($result_2 as $key => $value){
            $liburan[] = $value['text'];
        }

        $n = 0;
        while($n<$hari_antrian){$n++;
            if($mday>$days){
                $mday = 1;
                if($mon>=12){
                    $mon = 1;
                    $year++;
                }else $mon++;
                $days = date('t',mktime(0,0,0,$mon,$mday,$year));
            }
            if($wday>=7)$wday = 0;
            $val = $year.'-';
            if($mon<10)$val.='0';
            $val.= $mon.'-';
            if($mday<10)$val.='0';
            $val.= $mday;
            if($cookie==null){
                if(array_key_exists($wday, $hari_jadwal) && !in_array($val, $liburan) && !in_array($val, [date('Y-m-d')])){
                    $tanggal[] =[
                        'id' => my_simple_crypt($val,'e'),
                        'text'  => $hari[$wday].', '.$mday.' '.$bulan[$mon].' '.$year,
                        'child_id' => my_simple_crypt($hari_jadwal[$wday],'e')
                    ];
                };
            }else{
                if($cookie['role_user_access']==my_simple_crypt('0','e')){
                    if(array_key_exists($wday, $hari_jadwal) && !in_array($val, $liburan)){
                        $tanggal[] =[
                            'id' => my_simple_crypt($val,'e'),
                            'text'  => $hari[$wday].', '.$mday.' '.$bulan[$mon].' '.$year,
                            'child_id' => my_simple_crypt($hari_jadwal[$wday],'e')
                        ];
                    };
                }else{
                    if(array_key_exists($wday, $hari_jadwal) && !in_array($val, $liburan) && !in_array($val, [date('Y-m-d')])){
                        $tanggal[] =[
                            'id' => my_simple_crypt($val,'e'),
                            'text'  => $hari[$wday].', '.$mday.' '.$bulan[$mon].' '.$year,
                            'child_id' => my_simple_crypt($hari_jadwal[$wday],'e')
                        ];
                    };
                }
            }
            $wday++;
            $mday++;
        };

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $tanggal,
			],
		200);
    }

    public function jam_praktik(){
        
        $this->load->helper('api_helper');
        $_GET['id_child'] = my_simple_crypt($_GET['id_child'], 'd');
        header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);
        
        $query = $this->db->query(
            "SELECT
                child_id as id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k3_count\")
                ) as jumlah,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k3_finish\")
                ) as sampai,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k3_mulai\")
                ) as mulai
            FROM
                tm_data 
            WHERE
                child_id = '".$_GET['id_child']."' and
                deleted_by = '0'
            "
            );
    
            $result = $query->row_array();

            $jumlah_antrian = JSON_DECODE($result['jumlah'], true);
            $jam_mulai = JSON_DECODE($result['mulai'], true);
            $jam_selesai = JSON_DECODE($result['sampai'], true);

            foreach($jumlah_antrian as $key => $value){
                $antrian[] = [
                    'id'        => my_simple_crypt($jam_mulai[$key]." - ".$jam_selesai[$key], 'e'),
                    'text'      => $jam_mulai[$key]." - ".$jam_selesai[$key],
                    'jumlah'    => $jumlah_antrian[$key],
                    'child_id'  => my_simple_crypt($_GET['id_child'], 'e')
                ];
            }

        $this->api_return(
			[
				'status' => true,
				"results" => $antrian,
			],
		200);
    }

    public function nomor_urut()
    {
        $this->load->helper('api_helper');
        $_GET['jam_praktik'] = my_simple_crypt($_GET['jam_praktik'], 'd');
        $_GET['id_child'] = my_simple_crypt($_GET['id_child'], 'd');
        header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        $query = $this->db->query(
            "SELECT
                child_id as id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k3_count\")
                ) as jumlah,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k3_finish\")
                ) as sampai,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k3_mulai\")
                ) as mulai
            FROM
                tm_data 
            WHERE
                child_id = '".$_GET['id_child']."' and
                deleted_by = '0'
            "
            );
    
        $result = $query->row_array();

        $jumlah_antrian = JSON_DECODE($result['jumlah'], true);
        $jam_mulai = JSON_DECODE($result['mulai'], true);
        $jam_selesai = JSON_DECODE($result['sampai'], true);

        foreach($jumlah_antrian as $key => $value){
            if($jam_mulai[$key]." - ".$jam_selesai[$key] == $_GET['jam_praktik']){
                $antrian = [
                    'id'        => $jam_mulai[$key]." - ".$jam_selesai[$key],
                    'text'      => $jam_mulai[$key]." - ".$jam_selesai[$key],
                    'jumlah'    => $jumlah_antrian[$key],
                    'child_id'  => my_simple_crypt($_GET['id_child'], 'e')
                ];
            }
        }
        
        $query_2 = $this->db->query(
            "SELECT
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.nomor_urut\")
                ) as nomor_urut
            FROM
                tm_antrian 
            WHERE
                JSON_EXTRACT(antrian_data, \"$.child_id\") = '".$_GET['id_child']."' and
                JSON_EXTRACT(antrian_data, \"$.jam_praktik\") = '".$_GET['jam_praktik']."' and
                deleted_by = '0' "
        );
        
        $result_2 = $query_2->result_array();

        $pesanan = [];
        foreach($result_2 as $key_2 => $val_2){
            $pesanan[] = $val_2['nomor_urut'];
        }

        for($x=1; $x <= $antrian['jumlah']; $x++){
            if(!in_array($x, $pesanan)){
                $data[] = [
                    'id'    => my_simple_crypt($x,'e'),
                    'text'   => $x
                ];
            };
        };

        if(!isset($data)){
            $data[] = [
                'id' => '0',
                'text' => 'Nomor Antrian Tidak Tersedia',
                'disabled' => true
            ];
        }

        // return data
		$this->api_return(
			[
				'status' => true,
				"results" => $data,
			],
		200);
    }

    public function validate_antrian($post)
    {
        $query_validate = $this->db->query(
            "SELECT
            tm_antrian.antrian_id,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.nomor_urut\")
            ) as nomor_urut
            FROM
                tm_antrian
            WHERE
                deleted_by = 0 and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.dokter\")) = '".$post['dokter']."' and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.hari_tanggal\")) = '".$post['hari_tanggal']."' and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.jam_praktik\")) = '".$post['jam_praktik']."' and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.nomor_urut\")) = '".$post['nomor_urut']."'
            "
        );

        $result_validate = $query_validate->row_array();

        if(isset($result_validate)){
            return "0";
        }else{
            return $post['nomor_urut'];
        }
    }
    
    public function antrian_post()
    {
        $this->load->helper('api_helper');
        $this->load->helper('cookie');
        $cookie_login = get_cookie("cookielogin");
        header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['POST'],
        ]);

        $_POST['child_id']                  = my_simple_crypt($_POST['child_id'], 'd');
        $_POST['penjamin']                  = my_simple_crypt($_POST['penjamin'], 'd');
        $_POST['poliklinik']                = my_simple_crypt($_POST['poliklinik'], 'd');
        $_POST['dokter']                    = my_simple_crypt($_POST['dokter'], 'd');
        $_POST['hari_tanggal']              = my_simple_crypt($_POST['hari_tanggal'], 'd');
        $_POST['nomor_urut']                = my_simple_crypt($_POST['nomor_urut'], 'd');
        $_POST['jam_praktik']               = my_simple_crypt($_POST['jam_praktik'], 'd');
        $_POST['dokter_history']            = explode(",",$_POST['dokter_history']);
        $_POST['dokter_history'][1]         = my_simple_crypt($_POST['dokter_history'][1], 'd');
        $_POST['hari_tanggal_history']      = explode(",",$_POST['hari_tanggal_history']);
        $_POST['hari_tanggal_history'][1]   = my_simple_crypt($_POST['hari_tanggal_history'][1], 'd');
        $_POST['hari_tanggal_history'][6]   = my_simple_crypt($_POST['hari_tanggal_history'][6], 'd');
        $_POST['called_antrian']            = '0';
        if($cookie_login==null){
            $_POST['is_online']             = '1';
        }else{
            $cookie_login = JSON_DECODE($cookie_login, true);
            if($cookie_login['role_user_access']==my_simple_crypt('0','e')){
                $_POST['is_online']         = '0';
            }else{
                $_POST['is_online']         = '1';
            }
        }

        $result_validate = $this->validate_antrian($_POST);

        $basic_nomor_urut = $_POST['nomor_urut'];

        if($result_validate=='0'){
            for ($i=$_POST['nomor_urut']; $i < $_POST['max_antrian']; $i++) { 
                $_POST['nomor_urut'] = $_POST['nomor_urut']+1;
                $result_validate = $this->validate_antrian($_POST);
                if($result_validate!='0'){
                    break;
                }
            }
            if($result_validate=='0'){
                for ($i=0; $i < $_POST['nomor_urut']; $i++) { 
                    $_POST['nomor_urut'] = $_POST['nomor_urut']-1;
                    $result_validate = $this->validate_antrian($_POST);
                    if($result_validate!='0'){
                        break;
                    }
                }
                if($result_validate=='0'){
                    $cookie= array(
                        'name'   => 'cookieflashdata',
                        'value'  => 'Pendaftaran Gagal , Antrian '.$_POST['dokter_history'][3].' '.$_POST['dokter_history'][5].' '.$_POST['hari_tanggal_history'][3].', '.$_POST['hari_tanggal_history'][4].' Jam '.$_POST['jam_praktik'].' Sudah Penuh',
                        'expire' => time() + (5 * 1),
                        'path'   => '/',
                        'secure' => FALSE
                    );
                    $setcookie = setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path'], $cookie['secure']);
                    if($setcookie){
                        redirect('/');
                        die();
                    }else{
                        echo $cookie['value'];
                        echo "<br/>";
                        die();
                    }
                }  
            }
        }

        $data = array(
            'antrian_data' => JSON_ENCODE($_POST),
            'created_by' => $_POST['nomor_rm']
        );
    
        $insert = $this->db->insert('tm_antrian', $data);

        if($insert){
            $_POST['child_id']                  = my_simple_crypt($_POST['child_id'], 'e');
            $_POST['penjamin']                  = my_simple_crypt($_POST['penjamin'], 'e');
            $_POST['poliklinik']                = my_simple_crypt($_POST['poliklinik'], 'e');
            $_POST['dokter']                    = my_simple_crypt($_POST['dokter'], 'e');
            $_POST['hari_tanggal']              = $_POST['hari_tanggal'];
            $_POST['jam_praktik']               = $_POST['jam_praktik'];
            $_POST['nomor_urut']                = $_POST['nomor_urut'];
            $_POST['dokter_history'][1]         = my_simple_crypt($_POST['dokter_history'][1], 'e');
            $_POST['hari_tanggal_history'][1]   = my_simple_crypt($_POST['hari_tanggal_history'][1], 'e');
            $_POST['hari_tanggal_history'][6]   = my_simple_crypt($_POST['hari_tanggal_history'][6], 'e');
            $cookie= array(
                'name'   => 'cookiebynomorrm',
                'value'  => JSON_ENCODE($_POST),
                'expire' => time()+(10 * 365 * 24 * 60 * 60),
                'path' => '/',
                'secure' => FALSE
            );
            $setcookie = setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path'], $cookie['secure']);

            if($setcookie){
                $status = true;
                $json = "Success insert cookies";
                $options = array(
                    'cluster' => 'ap1',
                    'useTLS' => true
                );
                $pusher = new Pusher\Pusher(
                    '6da9105f74f8a8d019fc',
                    '4559f03877dfa2b54a58',
                    '932255',
                    $options
                );
                $data = $_POST['poliklinik'];
                // $pusher->trigger('my-channel', 'my-event', $data);
                if($cookie_login==null){
                    redirect('backend/data_antrian_get/'.$_POST['nomor_rm']);
                }else{
                    if($cookie_login['role_user_access']==my_simple_crypt('0','e')){
                        redirect('frontend/cetakantrian');
                    }else{
                        redirect('backend/data_antrian_get/'.$_POST['nomor_rm']);
                    }
                }
            }else{
                $status = false;
                $json = "Failed insert cookies";
            }
        }else{
            $status = false;
            $json = "Failed Inserting Data";
        };

        // return data
		$this->api_return(
			[
				'status' => $status,
				"data" => $json,
			],
		200);
    }

    public function data_antrian_get($nomor_rm){
        $this->load->helper('cookie');
        $this->load->helper('api_helper');
        header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        $query = $this->db->query(
            "SELECT
                tm_antrian.antrian_id as id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.child_id\")
                ) as child_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.penjamin\")
                ) as penjamin_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.poliklinik\")
                ) as poliklinik_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\")
                ) as dokter_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\")
                ) as hari_tanggal,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.jam_praktik\")
                ) as jam_praktik,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.nomor_urut\")
                ) as nomor_urut,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.nomor_rm\")
                ) as nomor_rm,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.tanggal_lahir\")
                ) as tanggal_lahir,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.jk\")
                ) as jk,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tb_penjamin.child_value, \"$.k2\")
                ) as penjamin_text,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tb_poli.child_value, \"$.k2\")
                ) as poli_text,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tb_dokter.child_value, \"$.k2\")
                ) as dokter_text
            FROM
                tm_antrian 
            INNER JOIN tm_data as tb_penjamin on JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.penjamin\")) = tb_penjamin.child_id
            INNER JOIN tm_data as tb_poli on JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.poliklinik\")) = tb_poli.child_id
            INNER JOIN tm_data as tb_dokter on JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\")) = tb_dokter.child_id
            WHERE
                JSON_EXTRACT(tm_antrian.antrian_data, \"$.nomor_rm\") = '".$nomor_rm."' and
                JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") >= '".date('Y-m-d')."' and
                tm_antrian.deleted_by = '0'
            ORDER BY
                tm_antrian.antrian_id DESC
            "
        );

        $result = $query->result_array();

        foreach($result as $key => $value){
            $result[$key]['id'] = my_simple_crypt($value['id'], 'e');
            $result[$key]['child_id'] = my_simple_crypt($value['child_id'], 'e');
            $result[$key]['penjamin_id'] = my_simple_crypt($value['penjamin_id'], 'e');
            $result[$key]['poliklinik_id'] = my_simple_crypt($value['poliklinik_id'], 'e');
            $result[$key]['dokter_id'] = my_simple_crypt($value['dokter_id'], 'e');
        }

        if($result){
            $cookie= array(
                'name'   => 'cookiedataantrian',
                'value'  => JSON_ENCODE($result),
                'expire' => time()+(10 * 365 * 24 * 60 * 60),
                'path' => '/',
                'secure' => FALSE
            );
            $setcookie = setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path'], $cookie['secure']);
            if($setcookie){
                $status = true;
                $json = $result;
                redirect('/frontend/antrian_data/');
            }else{
                $status = false;
                $json = "Failed insert cookies";
            }
        }else{
            $cookie= array(
                'name'   => 'cookiedataantrian',
                'value'  => JSON_ENCODE($result = [0 => ['id'=>'0','dokter_text'=>'DATA','poli_text'=>'KOSONG','nomor_urut'=>'0','jam_praktik'=>'0','hari_tanggal'=>'BELUM MENDAFTAR ANTRIAN']]),
                'expire' => time()+(10 * 365 * 24 * 60 * 60),
                'path' => '/',
                'secure' => FALSE
            );
            $setcookie = setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path'], $cookie['secure']);
            if($setcookie){
                $status = false;
                $json = "Failed Catching Data";
                redirect('/frontend/antrian_data/');
            }else{
                $status = false;
                $json = "Failed insert cookies (Failed Catching Data)";
            }
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"data" => $json,
			],
		200);
    }
    
    public function data_antrian()
    {
        $this->load->helper('cookie');
        $this->load->helper('api_helper');
        header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['POST'],
        ]);

        $query = $this->db->query(
            "SELECT
                tm_antrian.antrian_id as id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.child_id\")
                ) as child_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.penjamin\")
                ) as penjamin_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.poliklinik\")
                ) as poliklinik_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\")
                ) as dokter_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\")
                ) as hari_tanggal,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.jam_praktik\")
                ) as jam_praktik,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.nomor_urut\")
                ) as nomor_urut,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.nomor_rm\")
                ) as nomor_rm,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.tanggal_lahir\")
                ) as tanggal_lahir,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.jk\")
                ) as jk,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tb_penjamin.child_value, \"$.k2\")
                ) as penjamin_text,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tb_poli.child_value, \"$.k2\")
                ) as poli_text,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tb_dokter.child_value, \"$.k2\")
                ) as dokter_text
            FROM
                tm_antrian 
            INNER JOIN tm_data as tb_penjamin on JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.penjamin\")) = tb_penjamin.child_id
            INNER JOIN tm_data as tb_poli on JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.poliklinik\")) = tb_poli.child_id
            INNER JOIN tm_data as tb_dokter on JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\")) = tb_dokter.child_id
            WHERE
                JSON_EXTRACT(tm_antrian.antrian_data, \"$.nomor_rm\") = '".$_POST['nomor_rm']."' and
                JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") >= '".date('Y-m-d')."' and
                tm_antrian.deleted_by = '0'
            ORDER BY
                tm_antrian.antrian_id DESC
            "
        );

        $result = $query->result_array();

        foreach($result as $key => $value){
            $result[$key]['id'] = my_simple_crypt($value['id'], 'e');
            $result[$key]['child_id'] = my_simple_crypt($value['child_id'], 'e');
            $result[$key]['penjamin_id'] = my_simple_crypt($value['penjamin_id'], 'e');
            $result[$key]['poliklinik_id'] = my_simple_crypt($value['poliklinik_id'], 'e');
            $result[$key]['dokter_id'] = my_simple_crypt($value['dokter_id'], 'e');
        }

        if($result){
            $cookie= array(
                'name'   => 'cookiedataantrian',
                'value'  => JSON_ENCODE($result),
                'expire' => time()+(10 * 365 * 24 * 60 * 60),
                'path' => '/',
                'secure' => FALSE
            );
            $setcookie = setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path'], $cookie['secure']);
            if($setcookie){
                $status = true;
                $json = $result;
                redirect('/frontend/antrian_data/');
            }else{
                $status = false;
                $json = "Failed insert cookies";
            }
        }else{
            $cookie= array(
                'name'   => 'cookiedataantrian',
                'value'  => JSON_ENCODE($result = [0 => ['id'=>'0','dokter_text'=>'DATA','poli_text'=>'KOSONG','nomor_urut'=>'0','jam_praktik'=>'0','hari_tanggal'=>'BELUM MENDAFTAR ANTRIAN']]),
                'expire' => time()+(10 * 365 * 24 * 60 * 60),
                'path' => '/',
                'secure' => FALSE
            );
            $setcookie = setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path'], $cookie['secure']);
            if($setcookie){
                $status = false;
                $json = "Failed Catching Data";
                redirect('/frontend/antrian_data/');
            }else{
                $status = false;
                $json = "Failed insert cookies (Failed Catching Data)";
            }
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"data" => $json,
			],
		200);
    }

    public function login_post()
    {
        header("Access-Control-Allow-Origin: *");
        $this->load->helper('cookie');
        $this->load->helper('api_helper');
		// API Configuration
		$this->_apiConfig([
			'methods' => ['POST'],
        ]);

        $query = $this->db->query(
            "SELECT
                tm_data.child_id as id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_data.child_value, \"$.k1\")
                ) as username,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_data.child_value, \"$.k2\")
                ) as name,
                JSON_UNQUOTE(
                    JSON_EXTRACT(tm_data.child_value, \"$.k4\")
                ) as user_access,
                JSON_UNQUOTE(
                    JSON_EXTRACT(role_access.child_value, \"$.k3\")
                ) as role_user_access
            FROM
                tm_data
            INNER JOIN tm_data as role_access on JSON_UNQUOTE(JSON_EXTRACT(tm_data.child_value, \"$.k4\")) = role_access.child_id
            WHERE
                JSON_EXTRACT(tm_data.child_value, \"$.k0\") = 'user_admin' and
                JSON_EXTRACT(tm_data.child_value, \"$.k1\") = '".$_POST['username']."' and
                JSON_EXTRACT(tm_data.child_value, \"$.k3\") = '".my_simple_crypt($_POST['password'], 'e')."' and
                tm_data.deleted_by = '0'
            ORDER BY
                tm_data.child_id DESC
            "
        );

        $result = $query->row_array();

        if($result){
            $result['id'] = my_simple_crypt($result['id'], 'e');
            $result['user_access'] = my_simple_crypt($result['user_access'], 'e');
            $result['role_user_access'] = my_simple_crypt($result['role_user_access'], 'e');
            $cookie= array(
                'name'   => 'cookielogin',
                'value'  => JSON_ENCODE($result),
                'expire' => time()+(10 * 365 * 24 * 60 * 60),
                'path' => '/',
                'secure' => FALSE
            );
            $setcookie = setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path'], $cookie['secure']);
            if($setcookie){
                $status = true;
                $json = "Success insert cookies";
                redirect('/admin', 'refresh');
            }else{
                $status = false;
                $json = "Failed insert cookies";
            }
        }else{
            $status = false;
            $json = "Failed Catching Data";
            redirect('/login', 'refresh');
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"data" => $json,
			],
		200);
    }

	public function category()
	{
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);
        
        $query = $this->db->query(
        "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k1\")
            ) as url
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'category' and
            deleted_by = '0'
        "
        );

		$result = $query->result_array();

        if($result){
            $status = true;
            $json = $result;
        }else{
            $status = false;
            $json = "Failed Catching Data";
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

	public function record_hari_ini()
	{
        $this->load->helper('api_helper');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);
        
        $query = $this->db->query(
        "SELECT
            JSON_UNQUOTE(
                JSON_EXTRACT( antrian_data, \"$.hari_tanggal\" )
            ) as tanggal,
            JSON_UNQUOTE(
                JSON_EXTRACT( antrian_data, \"$.jam_praktik\" )
            ) as jam_praktik,
            JSON_UNQUOTE(
                JSON_EXTRACT( antrian_data, \"$.dokter\" )
            ) as dokter,
            count( antrian_id ) AS total
        FROM
            tm_antrian 
        WHERE
            JSON_EXTRACT(antrian_data, \"$.hari_tanggal\") = '".date('Y-m-d')."' and
            deleted_by = '0'
        GROUP BY
	        JSON_EXTRACT( antrian_data, \"$.hari_tanggal\" ) and
            JSON_EXTRACT( antrian_data, \"$.dokter\" ) and
            JSON_EXTRACT( antrian_data, \"$.jam_praktik\" )
        "
        );

        $result = $query->result_array();
        
        foreach($result as $key => $value){
            $result[$key]['dokter'] = my_simple_crypt($value['dokter'], 'e');
        }

        if($result){
            $status = true;
            $json = $result;
        }else{
            $status = false;
            $json = "Failed Catching Data";
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function logout_post()
    {
        header("Access-Control-Allow-Origin: *");
        $this->load->helper('cookie');
		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        $result = delete_cookie("cookielogin");

        $status = true;
        $json = "Success delete cookies";
        redirect('/login', 'refresh');

        // return data
		$this->api_return(
			[
				'status' => $status,
				"data" => $json,
			],
		200);
    }

    public function get_doctor($id)
    {
        $this->load->helper('api_helper');
        header("Access-Control-Allow-Origin: *");

        $id = my_simple_crypt($id,'d');

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        $query = $this->db->query(
            "SELECT
                child_id as id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k2\")
                ) as doctor_name,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k3\")
                ) as poli_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k4\")
                ) as poli_name
            FROM
                tm_data 
            WHERE
                JSON_EXTRACT(child_value, \"$.k0\") = 'dokter' and
                child_id = '".$id."' and
                deleted_by = '0'
            "
        );

        $result = $query->row_array();

        if($result){
            $result['id'] = my_simple_crypt($result['id'], 'e');
            $result['poli_id'] = my_simple_crypt($result['poli_id'], 'e');
            $status = true;
            $json = $result;
        }else{
            $status = false;
            $json = "Failed Catching Data";
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"data" => $json,
			],
		200);
    }

	public function category_row($url)
	{
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);
        
        $query = $this->db->query(
        "SELECT
            child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k2\")
            ) as text,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k1\")
            ) as url
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'category' and
            JSON_EXTRACT(child_value, \"$.k1\") = '".$url."' and
            deleted_by = '0'
        "
        );

		$result = $query->row_array();

        if($result){
            $status = true;
            $json = $result;
        }else{
            $status = false;
            $json = "Failed Catching Data";
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function datatables_data($category)
	{
        $this->load->helper('api_helper');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        $where = "";
        if($category=='libur_dokter'){
            $where = "JSON_EXTRACT(tm_data.child_value, \"$.k1\") >= '".date('Y-m-d')."' and ";
        }

        if(isset($_GET['search']['value'])){
            $search = "and JSON_SEARCH(UPPER(tm_data.child_value), 'all', UPPER('%".$_GET['search']['value']."%')) IS NOT NULL";
        }else{
            $search = "";
        }

        $query_count = $this->db->query(
            "SELECT 
                count(tm_data.child_id) as recordsTotal
            FROM
                tm_data
            WHERE
                JSON_EXTRACT(tm_data.child_value, \"$.k0\") = '".$category."' and
                ".$where."
                deleted_by = '0'
                ".$search."
            "
        );

        $result_count = $query_count->row_array();

        $data_attribute = "";
        $data_join = "";
        $orderby = "";
        if($category=='dokter'){
            $data_attribute = ",
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data.child_value, \"$.k4\")
            ) as attribute
            ";
            $orderby = "ORDER BY attribute";
        }
        else if($category=='user_admin'){
            $data_attribute = ",
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data_2.child_value, \"$.k2\")
            ) as attribute
            ";
            $data_join = "INNER JOIN tm_data as tm_data_2 on JSON_UNQUOTE(JSON_EXTRACT(tm_data.child_value, \"$.k4\")) = tm_data_2.child_id";
        }
        else if($category=='jadwal_dokter'){
            $data_attribute = ",
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data_2.child_value, \"$.k2\")
            ) as attribute,
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data_2.child_value, \"$.k4\")
            ) as attribute_2
            ";
            $data_join = "INNER JOIN tm_data as tm_data_2 on JSON_UNQUOTE(JSON_EXTRACT(tm_data.child_value, \"$.k4\")) = tm_data_2.child_id";
            $orderby = "ORDER BY attribute, field(text, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')";
        }
        else if($category=='libur_dokter'){
            $data_attribute = ",
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data_2.child_value, \"$.k2\")
            ) as attribute,
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data_2.child_value, \"$.k4\")
            ) as attribute_2
            ";
            $data_join = "INNER JOIN tm_data as tm_data_2 on JSON_UNQUOTE(JSON_EXTRACT(tm_data.child_value, \"$.k3\")) = tm_data_2.child_id";
            $orderby = "ORDER BY text";
        }
        else{
            $data_attribute = "";
            $data_join = "";
            $orderby = "";
        }
        
        $query = $this->db->query(
        "SELECT
            tm_data.child_id as id,
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data.child_value, \"$.k2\")
            ) as text
            ".$data_attribute."
        FROM
            tm_data 
        ".$data_join."
        WHERE
            JSON_EXTRACT(tm_data.child_value, \"$.k0\") = '".$category."' and
            ".$where."
            tm_data.deleted_by = '0'
            ".$search."
        ".$orderby."
        LIMIT 
            ".$_GET['length']."
        OFFSET
            ".$_GET['start']."
        "
        );

		$result = $query->result_array();

        foreach($result as $key => $value){
            if($category == 'dokter'){
                $datatables[$key] = [
                    $value['text'],
                    $value['attribute'],
                    "<a href=\"".base_url('admin/edit/'.$category.'/'.my_simple_crypt($value['id'],'e'))."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".my_simple_crypt($value['id'],'e'))."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
                ];
            }else if($category == 'user_admin'){
                $datatables[$key] = [
                    $value['text'],
                    $value['attribute'],
                    "<a href=\"".base_url('admin/edit/'.$category.'/'.my_simple_crypt($value['id'],'e'))."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".my_simple_crypt($value['id'],'e'))."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
                ];
            }
            else if($category == 'jadwal_dokter'){
                $datatables[$key] = [
                    $value['text'],
                    $value['attribute'],
                    $value['attribute_2'],
                    "<a href=\"".base_url('admin/edit/'.$category.'/'.my_simple_crypt($value['id'],'e'))."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".my_simple_crypt($value['id'],'e'))."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
                ];
            }
            else if($category == 'libur_dokter'){
                $datatables[$key] = [
                    $value['text'],
                    $value['attribute'],
                    $value['attribute_2'],
                    "<a href=\"".base_url('admin/edit/'.$category.'/'.my_simple_crypt($value['id'],'e'))."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".my_simple_crypt($value['id'],'e'))."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
                ];
            }
            else if($category == 'level_user'){
                if($value['text']=="Administrator"){
                    $datatables[$key] = [
                        $value['text'],
                        "&nbsp;"
                    ];
                }else{
                    $datatables[$key] = [
                        $value['text'],
                        "<a href=\"".base_url('admin/edit/'.$category.'/'.my_simple_crypt($value['id'],'e'))."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".my_simple_crypt($value['id'],'e'))."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
                    ];
                }
            }
            else{
                $datatables[$key] = [
                    $value['text'],
                    "<a href=\"".base_url('admin/edit/'.$category.'/'.my_simple_crypt($value['id'],'e'))."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".my_simple_crypt($value['id'],'e'))."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
                ];
            }
        }

        if($result){
            $status = true;
            $json = $datatables;
            $recordsTotal = $result_count['recordsTotal'];
        }else{
            $status = false;
            $json[0] = ["0","Failed Catching Data"];
            if($category == 'dokter'){
                $json[0] = ["0","Failed Catching Data","Failed Catching Data"];
            }
            if($category == 'libur_dokter'){
                $json[0] = ["0","Failed Catching Data","Failed Catching Data","Failed Catching Data","Failed Catching Data"];
            }
            $recordsTotal = "0";
        }

        // return data
		$this->api_return(
			[
                'draw'  => $_GET['draw'],
				'status' => $status,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsTotal,
                'data'  => $json
			],
		200);
    }

    public function deleted($url, $id)
	{
        $this->load->helper('api_helper');
        $this->load->helper('cookie');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);
        
        $cookie = get_cookie("cookielogin");
        $cookie = JSON_DECODE($cookie, true);

        $this->db->set('deleted_by', my_simple_crypt($cookie['id'], 'd'));
        $this->db->set('deleted_at', date('Y-m-d H:i:s'));
        $this->db->where('child_id', my_simple_crypt($id,'d'));
        $result = $this->db->update('tm_data');

        if($result){
            $status = "Delete Data Success";
            $json = $result;
            redirect('/admin/permalink/'.$url);
        }else{
            $status = false;
            $json = "Failed Delete Data";
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function cancel_antrian($url)
    {
        $this->load->helper('api_helper');
        $this->load->helper('cookie');
        $cookies = get_cookie('cookiedataantrian');
        $cookies = JSON_DECODE($cookies, true);
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        $this->db->set('deleted_by', $cookies[0]['nomor_rm']);
        $this->db->set('deleted_at', date('Y-m-d H:i:s'));
        $this->db->where('antrian_id', my_simple_crypt($url,"d"));
        $result = $this->db->update('tm_antrian');

        if($result){
            $status = "Delete Data Success";
            $json = $result;
            redirect('/backend/data_antrian_get/'.$cookies[0]['nomor_rm']);
        }else{
            $status = false;
            $json = "Failed Delete Data";
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function create(){
        header("Access-Control-Allow-Origin: *");
        $this->load->helper('cookie');
        $this->load->helper('api_helper');

		// API Configuration
		$this->_apiConfig([
			'methods' => ['POST'],
        ]);

        $cookie = get_cookie("cookielogin");
        $cookie = JSON_DECODE($cookie, true);

        foreach($_POST as $key => $val){
            $result       = $val;
            if(!isset($result['k1'])){
                $result['k1'] = strtolower($val['k2']);
                $result['k1'] = str_replace(" ","_",$result['k1']);
            }
            $result['k2'] = ucwords($val['k2']);
            if($result['k0']=='dokter'){
                if(preg_match("/Dr./", $result['k2'])) {
                    $result['k2'] = str_replace("Dr.","dr.",$result['k2']);
                }
                if(preg_match("/DR./", $result['k2'])) {
                    $result['k2'] = str_replace("DR.","dr.",$result['k2']);
                }
                if(preg_match("/dR./", $result['k2'])) {
                    $result['k2'] = str_replace("dR.","dr.",$result['k2']);
                }
                $result['k3'] = my_simple_crypt($result['k3'], 'd');
            };
            if($result['k0']=='user_admin'){
                $result['k3'] = my_simple_crypt($result['k3'], 'e');
                $result['k4'] = my_simple_crypt($result['k4'], 'd');
            };
            if($result['k0']=='jadwal_dokter'){
                $result['k4'] = my_simple_crypt($result['k4'], 'd');
            };
            if($result['k0']=='libur_dokter'){
                $result['k3'] = my_simple_crypt($result['k3'], 'd');
            };
            if($result['k0']=='level_user'){
                $result['k3'] = my_simple_crypt($result['k3'], 'd');
            };
        }

        ksort($result);

        $data = array(
            'child_value' => JSON_ENCODE($result),
            'created_by' => my_simple_crypt($cookie['id'], 'd')
        );
    
        $insert = $this->db->insert('tm_data', $data);

        if($insert){
            $status = true;
            $json = "Success Insert Data";
            redirect('/admin/permalink/'.$result['k0']);
        }else{
            $status = false;
            $json = "Failed Inserting Data";
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function edit($id){
        header("Access-Control-Allow-Origin: *");
        $this->load->helper('cookie');
        $this->load->helper('api_helper');

		// API Configuration
		$this->_apiConfig([
			'methods' => ['POST'],
        ]);

        $cookie = get_cookie("cookielogin");
        $cookie = JSON_DECODE($cookie, true);

        foreach($_POST as $key => $val){
            $result       = $val;
            if(!isset($result['k1'])){
                $result['k1'] = strtolower($val['k2']);
                $result['k1'] = str_replace(" ","_",$result['k1']);
            }
            $result['k2'] = ucwords($val['k2']);
            if($result['k0']=='dokter'){
                if(preg_match("/Dr./", $result['k2'])) {
                    $result['k2'] = str_replace("Dr.","dr.",$result['k2']);
                }
                if(preg_match("/DR./", $result['k2'])) {
                    $result['k2'] = str_replace("DR.","dr.",$result['k2']);
                }
                if(preg_match("/dR./", $result['k2'])) {
                    $result['k2'] = str_replace("dR.","dr.",$result['k2']);
                }
                $result['k3'] = my_simple_crypt($result['k3'], 'd');
            };
            if($result['k0']=='user_admin'){
                $result['k3'] = my_simple_crypt($result['k3'], 'e');
                $result['k4'] = my_simple_crypt($result['k4'], 'd');
            };
            if($result['k0']=='jadwal_dokter'){
                $result['k4'] = my_simple_crypt($result['k4'], 'd');
            };
            if($result['k0']=='libur_dokter'){
                $result['k3'] = my_simple_crypt($result['k3'], 'd');
            };
            if($result['k0']=='level_user'){
                $result['k3'] = my_simple_crypt($result['k3'], 'd');
            };
        }

        ksort($result);

        $data = array(
            'child_value' => JSON_ENCODE($result),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => my_simple_crypt($cookie['id'], 'd')
        );
    
        $this->db->where('child_id', my_simple_crypt($id, 'd'));
        $update = $this->db->update('tm_data', $data);

        if($update){
            $status = true;
            $json = "Success Update Data";
            redirect('/admin/permalink/'.$result['k0']);
        }else{
            $status = false;
            $json = "Failed Inserting Data";
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function get_full_data($url, $id)
    {
        $this->load->helper('api_helper');
        header("Access-Control-Allow-Origin: *");

        $id = my_simple_crypt($id,'d');

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        $query = $this->db->query(
            "SELECT
                child_id as id,
                child_value
            FROM
                tm_data 
            WHERE
                child_id = '".$id."' and
                deleted_by = '0'
            "
        );

        $result = $query->row_array();

        $result['id'] = my_simple_crypt($result['id'], 'e');
        $result['child_value'] = JSON_DECODE($result['child_value'], true);

        if($result){
            $status = true;
            $json = $result;
        }else{
            $status = false;
            $json = "Failed Catching Data";
        }

        // return data
		$this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function called_antrian($id){
        $this->load->helper('api_helper');
        header("Access-Control-Allow-Origin: *");

        $id = my_simple_crypt($id,'d');

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        $query = $this->db->query(
            "SELECT
            tm_antrian.antrian_id,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.dokter\")
            ) as dokter_id,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.hari_tanggal\")
            ) as hari_tanggal,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.nomor_urut\")
            ) as nomor_urut,
            f_terbilang(JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.nomor_urut\")
            )) as terbilang,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.called_antrian\")
            ) as called_antrian
            FROM
                tm_antrian
            WHERE
                deleted_by = 0 and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.dokter\")) = '".$id."' and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.hari_tanggal\")) = '".date('Y-m-d')."' and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.called_antrian\")) = '1' and
                    CAST('".date('H:i:s')."' AS time) 
                        BETWEEN 
                            STR_TO_DATE(SUBSTRING_INDEX(JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.jam_praktik\")), ' - ', 1), '%H:%i') and
                            STR_TO_DATE(SUBSTRING_INDEX(JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.jam_praktik\")), ' - ', -1), '%H:%i')
            "
        );

        $result = $query->row_array();


        if($result){
            $result['antrian_id'] = my_simple_crypt($result['antrian_id'], 'e');
            $result['dokter_id'] = my_simple_crypt($result['dokter_id'], 'e');
            $status = true;
            $json = $result;
        }else{
            $status = false;
            $json = "Failed Catching Data";
        }

        $this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function list_antrian($id){
        $this->load->helper('api_helper');
        header("Access-Control-Allow-Origin: *");

        $id = my_simple_crypt($id,'d');

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        $query = $this->db->query(
            "SELECT
            tm_antrian.antrian_id,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.dokter\")
            ) as dokter_id,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.hari_tanggal\")
            ) as hari_tanggal,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.nomor_urut\")
            ) as nomor_urut,
            f_terbilang(JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.nomor_urut\")
            )) as terbilang,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.called_antrian\")
            ) as called_antrian
            FROM
                tm_antrian
            WHERE
                deleted_by = 0 and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.dokter\")) = '".$id."' and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.hari_tanggal\")) = '".date('Y-m-d')."'
            ORDER BY nomor_urut
            "
        );

        $result = $query->result_array();

        foreach($result as $key => $value){
            $result[$key]['antrian_id'] = my_simple_crypt($value['antrian_id'], 'e');
            $result[$key]['dokter_id'] = my_simple_crypt($value['dokter_id'], 'e');
        }


        if($result){
            $status = true;
            $json = $result;
        }else{
            $status = false;
            $json = "Failed Catching Data";
        }

        $this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function update_call_antrian($id, $poli){
        $this->load->helper('api_helper');
        $poli = my_simple_crypt($poli, 'd');
        header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        if($id=='0'){
            $result = $this->db->query(
                "UPDATE tm_antrian 
                SET antrian_data = JSON_SET( antrian_data, \"$.called_antrian\", \"0\" )
                WHERE
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\") = '".$poli."' and
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") = '".date('Y-m-d')."' and
                    CAST('".date('H:i:s')."' AS time) 
                        BETWEEN 
                            STR_TO_DATE(SUBSTRING_INDEX(JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.jam_praktik\")), ' - ', 1), '%H:%i') and
                            STR_TO_DATE(SUBSTRING_INDEX(JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.jam_praktik\")), ' - ', -1), '%H:%i')
                "
            );
        }
        elseif($id=='next'){
            $query_first = $this->db->query(
                "   SELECT antrian_id, 
                    JSON_UNQUOTE(
                        JSON_EXTRACT(
                            tm_antrian.antrian_data,
                        \"$.nomor_urut\")
                    ) as nomor_urut, 
                    JSON_UNQUOTE(
                        JSON_EXTRACT(
                            tm_antrian.antrian_data,
                        \"$.called_antrian\")
                    ) as called_antrian, 
                    JSON_UNQUOTE(
                        JSON_EXTRACT(
                            tm_antrian.antrian_data,
                        \"$.jam_praktik\")
                    ) as jam_praktik
                    FROM tm_antrian
                    WHERE
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\") = '".$poli."' and
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") = '".date('Y-m-d')."' and
                    CAST('".date('H:i:s')."' AS time) 
                        BETWEEN 
                            STR_TO_DATE(SUBSTRING_INDEX(JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.jam_praktik\")), ' - ', 1), '%H:%i') and
                            STR_TO_DATE(SUBSTRING_INDEX(JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.jam_praktik\")), ' - ', -1), '%H:%i')
                    ORDER BY CAST(nomor_urut AS UNSIGNED) ASC
                "
            );
            $result_first = $query_first->result_array();
            $nextrue = "0";
            foreach($result_first as $keyz => $valxc){
                if($valxc['called_antrian']=='1'){
                    $idnya['called'][] = $valxc['nomor_urut'];
                }else{
                    $idnya['iddle'][] = $valxc['nomor_urut'];
                }
            }
            if(!isset($idnya)){
                $result = true;
            }else{
                if(!isset($idnya['called'])){
                    $call_id = $idnya['iddle'][0];
                }else{
                    $called = $idnya['called'][0];
                    $call_idx = array_merge($idnya['called'],$idnya['iddle']);
                    sort($call_idx);
                    foreach($call_idx as $keyx => $valx){
                        if($valx > $called){
                            $call_id = $valx;
                            break;
                        }else{
                            $call_id = $valx;
                        }
                    }
                }
                if($result_first){
                    $query = $this->db->query(
                        "UPDATE tm_antrian 
                        SET antrian_data = JSON_SET( antrian_data, \"$.called_antrian\", \"0\" )
                        WHERE
                            JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\") = '".$poli."' and
                            JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") = '".date('Y-m-d')."' 
                        "
                    );
                }
                if($query){
                    $result = $this->db->query(
                        "UPDATE tm_antrian 
                        SET antrian_data = JSON_SET( antrian_data, \"$.called_antrian\", \"1\" )
                        WHERE
                            JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\") = '".$poli."' and
                            JSON_EXTRACT(tm_antrian.antrian_data, \"$.nomor_urut\") = '".$call_id."' and
                            JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") = '".date('Y-m-d')."'
                        "
                    );
                }
            }
        }elseif($id=='prev'){
            $query_first = $this->db->query(
                "   SELECT antrian_id, 
                    JSON_UNQUOTE(
                        JSON_EXTRACT(
                            tm_antrian.antrian_data,
                        \"$.nomor_urut\")
                    ) as nomor_urut, 
                    JSON_UNQUOTE(
                        JSON_EXTRACT(
                            tm_antrian.antrian_data,
                        \"$.called_antrian\")
                    ) as called_antrian, 
                    JSON_UNQUOTE(
                        JSON_EXTRACT(
                            tm_antrian.antrian_data,
                        \"$.jam_praktik\")
                    ) as jam_praktik
                    FROM tm_antrian
                    WHERE
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\") = '".$poli."' and
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") = '".date('Y-m-d')."' and
                    CAST('".date('H:i:s')."' AS time) 
                        BETWEEN 
                            STR_TO_DATE(SUBSTRING_INDEX(JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.jam_praktik\")), ' - ', 1), '%H:%i') and
                            STR_TO_DATE(SUBSTRING_INDEX(JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.jam_praktik\")), ' - ', -1), '%H:%i')
                    ORDER BY CAST(nomor_urut AS UNSIGNED) ASC
                "
            );
            $result_first = $query_first->result_array();
            $nextrue = "0";
            foreach($result_first as $keyz => $valxc){
                if($valxc['called_antrian']=='1'){
                    $idnya['called'][] = $valxc['nomor_urut'];
                }else{
                    $idnya['iddle'][] = $valxc['nomor_urut'];
                }
            }
            if(!isset($idnya)){
                $result = true;
            }else{
                if(!isset($idnya['called'])){
                    $call_id = $idnya['iddle'][0];
                }else{
                    $called = $idnya['called'][0];
                    $call_idx = array_merge($idnya['called'],$idnya['iddle']);
                    rsort($call_idx);
                    foreach($call_idx as $keyx => $valx){
                        if($valx < $called){
                            $call_id = $valx;
                            break;
                        }else{
                            $call_id = $valx;
                        }
                    }
                }
                if($result_first){
                    $query = $this->db->query(
                        "UPDATE tm_antrian 
                        SET antrian_data = JSON_SET( antrian_data, \"$.called_antrian\", \"0\" )
                        WHERE
                            JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\") = '".$poli."' and
                            JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") = '".date('Y-m-d')."'
                        "
                    );
                }
                if($query){
                    $result = $this->db->query(
                        "UPDATE tm_antrian 
                        SET antrian_data = JSON_SET( antrian_data, \"$.called_antrian\", \"1\" )
                        WHERE
                            JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\") = '".$poli."' and
                            JSON_EXTRACT(tm_antrian.antrian_data, \"$.nomor_urut\") = '".$call_id."' and
                            JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") = '".date('Y-m-d')."'
                        "
                    );
                }
            }
        }elseif($id=='repeat'){
            $result = true;
        }else{
            $query = $this->db->query(
                "UPDATE tm_antrian 
                SET antrian_data = JSON_SET( antrian_data, \"$.called_antrian\", \"0\" )
                WHERE
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\") = '".$poli."' and
                    JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") = '".date('Y-m-d')."'
                "
            );
            if($query){
                $result = $this->db->query(
                    "UPDATE tm_antrian 
                    SET antrian_data = JSON_SET( antrian_data, \"$.called_antrian\", \"1\" )
                    WHERE
                        JSON_EXTRACT(tm_antrian.antrian_data, \"$.dokter\") = '".$poli."' and
                        JSON_EXTRACT(tm_antrian.antrian_data, \"$.nomor_urut\") = '".$id."' and
                        JSON_EXTRACT(tm_antrian.antrian_data, \"$.hari_tanggal\") = '".date('Y-m-d')."'
                    "
                );
            }
        }

        if($result){
            $status = true;
            $json = $result;
            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                '6da9105f74f8a8d019fc',
                '4559f03877dfa2b54a58',
                '932255',
                $options
            );
            $data = my_simple_crypt($poli, 'e');
            $pusher->trigger('my-channel', 'my-event', $data);
        }else{
            $status = false;
            $json = "Failed Update Data";
        }

        $this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }

    public function antrian_full_date($date, $search){
        header("Access-Control-Allow-Origin: *");
        $date = urldecode($date);
        $date = explode(" - ", $date);

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        if($search=="-"){
            $pencarian = "";
        }else{
            $pencarian = "
                and 
                    (
                        JSON_SEARCH(UPPER(tm_antrian.antrian_data), 'all', UPPER('%".$search."%')) IS NOT NULL or
                        JSON_SEARCH(UPPER(penjamin_tb.child_value), 'all', UPPER('%".$search."%')) IS NOT NULL or
                        JSON_SEARCH(UPPER(poliklinik_tb.child_value), 'all', UPPER('%".$search."%')) IS NOT NULL
                    )
            ";
        }

        $query = $this->db->query(
            "SELECT
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    penjamin_tb.child_value,
                 \"$.k2\")
            ) as penjamin_text,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    poliklinik_tb.child_value,
                 \"$.k2\")
            ) as poliklinik_text,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.dokter_history[3]\")
            ) as dokter_text,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.hari_tanggal_history[3]\")
            ) as hari,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.hari_tanggal_history[4]\")
            ) as tanggal,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.jam_praktik\")
            ) as jam_praktik,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.nomor_rm\")
            ) as nomor_rm,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.nama_pasien\")
            ) as nama_pasien,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.alamat\")
            ) as alamat,
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    tm_antrian.antrian_data,
                 \"$.nomor_urut\")
            ) as nomor_urut,
            CASE
                WHEN 
                JSON_UNQUOTE(
                    JSON_EXTRACT(
                        tm_antrian.antrian_data,
                    \"$.nomor_urut\")
                ) = 1 THEN \"Online\"
                ELSE \"Offline\"
            END AS is_online,
            CASE
                WHEN 
                JSON_UNQUOTE(
                    JSON_EXTRACT(
                        tm_antrian.antrian_data,
                    \"$.type_patient\")
                ) = 'baru' THEN \"Baru\"
                ELSE \"Lama\"
            END AS type_patient 
            FROM
                tm_antrian
            INNER JOIN tm_data as penjamin_tb on JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.penjamin\")) = penjamin_tb.child_id
            INNER JOIN tm_data as poliklinik_tb on JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data, \"$.poliklinik\")) = poliklinik_tb.child_id
            WHERE
                tm_antrian.deleted_by = 0 and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.hari_tanggal\")) >= '".$date['0']."' and
                JSON_UNQUOTE(JSON_EXTRACT(tm_antrian.antrian_data,\"$.hari_tanggal\")) <= '".$date['1']."'
                ".$pencarian."
            "
        );

        $result = $query->result_array();

        if($result){
            $status = true;
            $json = $result;
        }else{
            $status = false;
            $json = "Failed Catching Data";
        }

        $this->api_return(
			[
				'status' => $status,
				"results" => $json,
			],
		200);
    }
}
