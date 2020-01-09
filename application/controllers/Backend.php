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

        $query = $this->db->get_where('tm_data', array('child_id' => $_GET['id_child'], 'deleted_by' => '0'));
        
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
                'expire' => time()+7200,
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
            JSON_EXTRACT( antrian_data, \"$.dokter\" )
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
                ) as doctor_name,
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
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);

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
                deleted_by = '0'
                ".$search."
            "
        );

        $result_count = $query_count->row_array();

        $data_attribute = "";
        $data_join = "";
        if($category=='dokter'){
            $data_attribute = ",
            JSON_UNQUOTE(
                JSON_EXTRACT(tm_data.child_value, \"$.k4\")
            ) as attribute
            ";
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
            $data_join = "INNER JOIN tm_data as tm_data_2 on JSON_UNQUOTE(JSON_EXTRACT(tm_data.child_value, \"$.k6\")) = tm_data_2.child_id";
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
        }
        else{
            $data_attribute = "";
            $data_join = "";
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
            tm_data.deleted_by = '0'
            ".$search."
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
                    $value['id'], 
                    $value['text'],
                    $value['attribute'],
                    "<a href=\"".base_url('admin/edit/'.$category.'/'.$value['id'])."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".$value['id'])."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
                ];
            }else if($category == 'user_admin'){
                $datatables[$key] = [
                    $value['id'], 
                    $value['text'],
                    $value['attribute'],
                    "<a href=\"".base_url('admin/edit/'.$category.'/'.$value['id'])."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".$value['id'])."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
                ];
            }
            else if($category == 'jadwal_dokter'){
                $datatables[$key] = [
                    $value['id'], 
                    $value['text'],
                    $value['attribute'],
                    $value['attribute_2'],
                    "<a href=\"".base_url('admin/edit/'.$category.'/'.$value['id'])."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".$value['id'])."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
                ];
            }
            else if($category == 'libur_dokter'){
                $datatables[$key] = [
                    $value['id'], 
                    $value['text'],
                    $value['attribute'],
                    $value['attribute_2'],
                    "<a href=\"".base_url('admin/edit/'.$category.'/'.$value['id'])."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".$value['id'])."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
                ];
            }
            else{
                $datatables[$key] = [
                    $value['id'], 
                    $value['text'],
                    "<a href=\"".base_url('admin/edit/'.$category.'/'.$value['id'])."\"<button class=\"btn btn-primary btn-sm\">Edit</button></a> <a href=\"".base_url('backend/deleted/'.$category."/".$value['id'])."\" onclick=\"return confirm('Anda Yakin Menghapus Data ".$value['text']."?')\"><button class=\"btn btn-primary btn-sm\">Delete</button></a>"
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
        $this->load->helper('cookie');
		header("Access-Control-Allow-Origin: *");

		// API Configuration
		$this->_apiConfig([
			'methods' => ['GET'],
        ]);
        
        $cookie = get_cookie("cookielogin");
        $cookie = JSON_DECODE($cookie, true);

        $this->db->set('deleted_by', $cookie['id']);
        $this->db->set('deleted_at', date('Y-m-d H:i:s'));
        $this->db->where('child_id', $id);
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
}
