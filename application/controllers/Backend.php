<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/API_Controller.php';

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

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $query->result_array(),
			],
		200);
    }
    
    public function poliklinik()
	{
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

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $query->result_array(),
			],
		200);
    }
    
    public function dokter_poli()
	{
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

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $query->result_array(),
			],
		200);
    }

    public function dokter_poli_all()
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
                JSON_EXTRACT(child_value, \"$.k3\")
            ) as poli_id,
            JSON_UNQUOTE(
                JSON_EXTRACT(child_value, \"$.k4\")
            ) as poli_name
        FROM
            tm_data 
        WHERE
            JSON_EXTRACT(child_value, \"$.k0\") = 'dokter' and
            deleted_by = '0'
        "
        );

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $query->result_array(),
			],
		200);
    }
    
    public function hari_tanggal()
	{
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
            JSON_EXTRACT(child_value, \"$.k6\") = '".$_GET['id_dokter']."' and
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

        foreach($result_2 as $key => $value){
            $liburan[] = $value['text'];
        }

        $n = 0;
        while($n<30){$n++;
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
            if(array_key_exists($wday, $hari_jadwal) && !in_array($val, $liburan)){
                $tanggal[] =[
                    'id' => $val,
                    'text'  => $hari[$wday].', '.$mday.' '.$bulan[$mon].' '.$year,
                    'child_id' => $hari_jadwal[$wday]
                ];
            };
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
    
    public function jam_periksa()
	{
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

        $query = $this->db->get_where('tm_data', array('child_id' => $_GET['id_child']));
        
        $result = $query->row_array();

        $json = JSON_DECODE($result['child_value'], true);

        $query_2 = $this->db->query(
            "SELECT
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.jam_periksa\")
                ) as jam_periksa
            FROM
                tm_antrian 
            WHERE
                JSON_EXTRACT(antrian_data, \"$.child_id\") = '".$_GET['id_child']."' and
                deleted_by = '0' "
        );
        
        $result_2 = $query_2->result_array();

        $start_jam['db'] = $json['k3'];
        $start_jam['str'] = strtotime($json['k3']);
        $end_jam['db'] = $json['k4'];
        $end_jam['str'] = strtotime($json['k4']);

        $diff   = $end_jam['str'] - $start_jam['str'];
        $menit  = floor($diff / (60));
        $pecah_waktu_awal = explode(":",$start_jam['db'] );
        $pecah_waktu_akhir = explode(":",$end_jam['db'] );

        foreach($result_2 as $key => $value){
            $pesanan[] = $value['jam_periksa'];
        }

        for($x=0; $x <= $menit; $x++){
            $pecah_waktu_awal[1] = (int)$pecah_waktu_awal[1]+$json['k5'];
            if($pecah_waktu_awal[1]>=60){
                $pecah_waktu_awal[0] = $pecah_waktu_awal[0]+1;
                $explode = str_split($pecah_waktu_awal[1]);
                $pecah_waktu_awal[1] = $explode[1];
            }
            if($pecah_waktu_awal[1]<10){
                $pecah_waktu_awal[1] = "0".$pecah_waktu_awal[1];
            }
            if($pecah_waktu_awal[0]>=$pecah_waktu_akhir[0] and $pecah_waktu_awal[1]>=$pecah_waktu_akhir[1]){
                break;
            }
            if($pecah_waktu_awal[0].$pecah_waktu_awal[1]>date("Hi") && !in_array($pecah_waktu_awal[0].":".$pecah_waktu_awal[1], $pesanan)){
                $jam[] = [
                    'id'=>$pecah_waktu_awal[0].":".$pecah_waktu_awal[1],
                    'text'=>$pecah_waktu_awal[0].":".$pecah_waktu_awal[1]
                ];
            }
        }

        if(!isset($jam)){
            $jam[] = [
                'id' => '0',
                'text' => 'Waktu Praktek Sudah Terlewat',
                'disabled' => true
            ];
        }

		// return data
		$this->api_return(
			[
				'status' => true,
				"results" => $jam,
			],
		200);
    }
    
    public function antrian_post()
    {

        header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['POST'],
        ]);

        $this->load->helper('cookie');

        $data = array(
            'antrian_data' => JSON_ENCODE($_POST),
            'created_by' => $_POST['nomor_rm']
        );
    
        $insert = $this->db->insert('tm_antrian', $data);

        if($insert){
            $cookie= array(
                'name'   => 'cookiebynomorrm',
                'value'  => JSON_ENCODE($_POST),
                'expire' => time()+1000,
                'path' => '/',
                'secure' => FALSE
            );
            $setcookie = setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path'], $cookie['secure']);

            if($setcookie){
                $status = true;
                $json = "Success insert cookies";
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
    
    public function data_antrian()
    {
        header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['POST'],
        ]);

        $query = $this->db->query(
            "SELECT
                antrian_id as id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.child_id\")
                ) as child_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.penjamin\")
                ) as penjamin_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.poliklinik\")
                ) as poliklinik_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.dokter\")
                ) as dokter_id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.hari_tanggal\")
                ) as hari_tanggal,
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.jam_periksa\")
                ) as jam_periksa,
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.nomor_rm\")
                ) as nomor_rm,
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.tanggal_lahir\")
                ) as tanggal_lahir,
                JSON_UNQUOTE(
                    JSON_EXTRACT(antrian_data, \"$.jk\")
                ) as jk
            FROM
                tm_antrian 
            WHERE
                JSON_EXTRACT(antrian_data, \"$.nomor_rm\") = '".$_POST['nomor_rm']."' and
                deleted_by = '0'
            ORDER BY
                antrian_id DESC
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
				"data" => $json,
			],
		200);
    }

    public function login_post()
    {
        header("Access-Control-Allow-Origin: *");
        $this->load->helper('cookie');
		// API Configuration
		$this->_apiConfig([
			'methods' => ['POST'],
        ]);

        $query = $this->db->query(
            "SELECT
                child_id as id,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k1\")
                ) as username,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k2\")
                ) as name,
                JSON_UNQUOTE(
                    JSON_EXTRACT(child_value, \"$.k4\")
                ) as user_access
            FROM
                tm_data 
            WHERE
                JSON_EXTRACT(child_value, \"$.k0\") = 'user_admin' and
                JSON_EXTRACT(child_value, \"$.k1\") = '".$_POST['username']."' and
                JSON_EXTRACT(child_value, \"$.k3\") = '".md5($_POST['password'])."' and
                deleted_by = '0'
            ORDER BY
                child_id DESC
            "
        );

        $result = $query->row_array();

        if($result){
            $cookie= array(
                'name'   => 'cookielogin',
                'value'  => JSON_ENCODE($result),
                'expire' => time()+1000,
                'path' => '/',
                'secure' => FALSE
            );
            $setcookie = setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path'], $cookie['secure']);
            if($setcookie){
                $status = true;
                $json = "Success insert cookies";
            }else{
                $status = false;
                $json = "Failed insert cookies";
            }
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
}
