<?php

function path_info()
{

    $ci = &get_instance();

    $data = array(
        'base_url' => base_url(),
        'site_url' => site_url(),
        'assets_path' => base_url('assets/'),
        'js_path' => base_url('assets/js/'),
        'css_path' => base_url('assets/css/'),
        'img_path' => base_url('assets/img/'),
        'uploads_path' => base_url('uploads/'),
    );
    $data = array_merge($data, color_template());
    return $data;
}

function color_template()
{
    $color = parse_ini_file(FCPATH . 'color.ini');
    $data = array(
        'bg_header' => $color['bg_header'],
        'bg_navbar' => $color['bg_navbar'],
    );
    return $data;
}

function get_pengaturan($kode)
{
    $ci = &get_instance();
    $ci->db->select('deskripsi');
    $ci->db->where('kode', $kode);
    $get = $ci->db->get('mpengaturan')->row_array();
    if ($get) {
        return $get['deskripsi'];
    } else {
        return $kode;
    }

}

function get_pengaturan_akun($id)
{
    $ci = &get_instance();
    $ci->db->select('noakun');
    $ci->db->where('id', $id);
    $get = $ci->db->get('mnoakunpengaturan')->row_array();
    if ($get) {
        return $get['noakun'];
    } else {
        return $katakunci;
    }

}

function formatdateslash($tanggal)
{
    $date = date('d/m/Y', strtotime($tanggal));
    return $date;
}

function formatdatemonthname($tanggal)
{
    $date = date('d F Y', strtotime($tanggal));
    return $date;
}

function formatnumberakunting($number)
{
    if ($number > 0) {
        return number_format($number);
    }

    if ($number < 0) {
        return '(' . number_format(abs($number)) . ')';
    } else {
        return number_format($number);
    }

}

function lang($kode)
{
    $ci = &get_instance();
    $ci->db->select('mbahasadetail.kode, mbahasadetail.deskripsi');
    $ci->db->where('mbahasadetail.kode', $kode);
    $ci->db->join('mbahasa', 'mbahasa.id = mbahasadetail.idbahasa');
    $ci->db->join('mpengaturan', 'mbahasa.kode = mpengaturan.deskripsi');
    $get = $ci->db->get('mbahasadetail')->row_array();
    if ($get) {
        return $get['deskripsi'];
    } else {
        return str_replace('_', ' ', $kode);
    }

}

function get_user($field)
{
    $ci = &get_instance();
    $ci->db->select($field);
    $ci->db->where('id', $ci->session->userdata('userid'));
    $get = $ci->db->get('z_user')->row_array();
    if ($get) {
        return $get[$field];
    } else {
        return null;
    }

}

function get_pegawai($field)
{
    $ci = &get_instance();
    $ci->load->library('ian_user');
    $pegawai = $ci->ian_user->get_user();
    return $pegawai[$field];
}

function get_setting($key)
{
    $ci = &get_instance();
    $ci->db->where('key', $key);
    $get = $ci->db->get('mpengaturan')->row_array();
    return $get['value'];
}

function remove_comma($number, $delimiter = ',')
{
    return str_replace($delimiter, '', $number);
}

function permission_access($uri)
{
    $ci = &get_instance();
    $idhakakses = get_pegawai('idhakakses');
    $hakakses_pegawai = $ci->general->hakakses_pegawai($idhakakses);
    if ($hakakses_pegawai) {
        foreach ($hakakses_pegawai as $key) {
            $url[] = strtolower($key['url']);
        }

        $uri_allow = array(
            'forbidden',
            'notfound',
            'dashboard',
            'ajaxselect',
            'akun_setting',
            'change_language',
        );

        $uri = strtolower($uri);
        if (in_array($uri, $url) || in_array($uri, $uri_allow)) {
            return true;
        } else {
            return false;
        }
    }
}

function menu_is_active($url)
{
    $ci = &get_instance();
    $uri = $ci->uri->segment(1);
    if (strtolower($uri) == strtolower($url)) {
        return 'active';
    }

}

function menu_is_open($menu = array())
{
    $ci = &get_instance();
    $uri = $ci->uri->segment(1);
    if (is_array($menu)) {
        if (in_array(strtolower($uri), $menu)) {
            return 'nav-item-expanded nav-item-open';
        }

    }
}

function get_idjurnal($tipe = null, $refid = null)
{
    $ci = &get_instance();
    if ($tipe && $refid) {
        $ci->db->select('id');
        $ci->db->where('tipe', $tipe);
        $ci->db->where('refid', $refid);
        $get = $ci->db->get('tjurnal');
        if ($get->num_rows() > 0) {
            return $get->row()->id;
        }
    }
}

function redirectjurnal($tipe, $id)
{
    $link = site_url();
    if ($tipe == '1') {
        $link .= 'pengiriman_pembelian/detail/' . $id;
    } else if ($tipe == '2') {
        $link .= 'faktur_pembelian/detail/' . $id;
    } else if ($tipe == '3') {
        $link .= 'pembayaran_pembelian/detail/' . $id;
    } else if ($tipe == '4') {
        $link .= 'jurnal/detail/' . $id;
    } else if ($tipe == '5') {
        $link .= 'jurnal_penyesuaian/detail/' . $id;
    } else if ($tipe == '6') {
        $link .= 'retur_pembelian/detail/' . $id;
    } else {
        $link .= 'memo/detail/' . $id;
    }
    return $link;
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return ucwords($temp);
}

function jsonOutputSuccess($message = null)
{
    $ci = &get_instance();
    if ($message == null) {
        $message = 'Data berhasil disimpan.';
    }
    $data['status'] = 'success';
    $data['message'] = $message;
    $ci->output->set_content_type('application/json')->set_output(json_encode($data));
}

function jsonOutputError($message = null)
{
    $ci = &get_instance();
    if ($message == null) {
        $message = 'Data gagal disimpan.';
    }
    $data['status'] = 'error';
    $data['message'] = $message;
    $ci->output->set_content_type('application/json')->set_output(json_encode($data));
}

function jsonOutputDeleteSuccess($message = null)
{
    $ci = &get_instance();
    if ($message == null) {
        $message = 'Data berhasil dihapus.';
    }
    $data['status'] = 'success';
    $data['message'] = $message;
    $ci->output->set_content_type('application/json')->set_output(json_encode($data));
}

function jsonOutputDeleteError($message = null)
{
    $ci = &get_instance();
    if ($message == null) {
        $message = 'Data gagal dihapus.';
    }
    $data['status'] = 'error';
    $data['message'] = $message;
    $ci->output->set_content_type('application/json')->set_output(json_encode($data));
}
