<?php 

use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model {

    private $_client;
    public function __construct()
    {
        // parent::__construct();
        $this->_client = new Client([
            'base_uri' => 'http://localhost/Rest_api/frizy-rest-server/api/',
            'auth' => ['admin', '1234'],
        ]);
    }

    public function getAllMahasiswa()
    {
        // return $this->db->get('mahasiswa')->result_array();

        $response = $this->_client->request('GET', 'mahasiswa', [
            'query' => [
                'frizy-api-key' => 'frizy123'
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function getMahasiswaById($id)
    {
        // return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
        $client = new Client();

        $response = $this->_client->request('GET', 'mahasiswa', [
            'query' => [
                'frizy-api-key' => 'frizy123',
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'][0];
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            'frizy-api-key' => 'frizy123'
        ];

        // $this->db->insert('mahasiswa', $data);
        $response = $this->_client->request('POST', 'mahasiswa', [
            'form_params' => $data
        ]);
        
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function hapusDataMahasiswa($id)
    {
        $response = $this->_client->request('DELETE', 'mahasiswa',[
            'form_params' => [
                'id' => $id,
                'frizy-api-key' => 'frizy123'
                ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id', true),
            'frizy-api-key' => 'frizy123'
        ];

        $response = $this->_client->request('PUT', 'mahasiswa', [
            'form_params' => $data
        ]);
        
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}