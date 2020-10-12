<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model', 'model');
    }

    public function index()
    {
        $data['title'] = lang('dashboard');
        // $data['getChartLabaRugi'] = $this->getChartLabaRugi();
        $data['content'] = 'Dashboard/content';
        $data = array_merge($data, path_info());
        $this->parser->parse('default', $data);
    }

    public function content()
    {
        $data = array_merge(path_info());
        $this->parser->parse('Dashboard/content', $data);
    }

    public function getChartExpense()
    {
        $strQuery = "select
		concat(mnoakun.noakun, ' - ', mnoakun.namaakun) as namaakun,
		sum(tjurnaldetail.debet) as total
		from tjurnaldetail
		inner join tjurnal on tjurnal.id = tjurnaldetail.idjurnal
		inner join mnoakun on mnoakun.noakun = tjurnaldetail.noakun
		where mnoakun.noakun like '551%'
		and date_format(current_date(), '%Y') = date_format(tjurnal.tanggal,'%Y')
		group by mnoakun.noakun";
        $result = $this->db->query($strQuery)->result();
        $this->output->set_content_type('application/json')->set_output(json_encode($result, JSON_PRETTY_PRINT));

    }

    public function getChartLabaRugi()
    {
        $result = array();
        for ($i = 1; $i <= 12; $i++) {
            $data = array();
            if ($i < 10) {

                $dateObj = DateTime::createFromFormat('!m', $i);
                $namaBulan = $dateObj->format('F');
                $data['bulan'] = $namaBulan;
                $data['periode'] = date('Y0' . $i);
                $strQuery = "select * from
				(
					select
					date_format(tanggalwaktu, '%Y%m') as periode,
					sum(kredit)-sum(debet) as total
					from viewjurnaldetail
					where noakuntop = 4 or noakuntop = 5
				) tbl
				where periode =  '" . $data['periode'] . "'";
                $get = $this->db->query($strQuery)->row();
                if ($get) {
                    $data['total'] = $get->total;
                } else {
                    $data['total'] = 0;
                }

            } else {
                $dateObj = DateTime::createFromFormat('!m', $i);
                $namaBulan = $dateObj->format('F');
                $data['bulan'] = $namaBulan;
                $data['periode'] = date('Y' . $i);
                $strQuery = "select * from
				(
					select
					date_format(tanggalwaktu, '%Y%m') as periode,
					sum(kredit)-sum(debet) as total
					from viewjurnaldetail
					where noakuntop = 4 or noakuntop = 5
				) tbl
				where periode =  '" . $data['periode'] . "'";
                $get = $this->db->query($strQuery)->row();
                if ($get) {
                    $data['total'] = $get->total;
                } else {
                    $data['total'] = 0;
                }

            }
            $result[] = $data;
            $this->output->set_content_type('application/json')->set_output(json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    public function getChartProdukLaris()
    {
        $strQuery = "select
		mitem.nama as item,
		(select
		coalesce(sum(tfakturdetail.jumlah),0) as total
		from tfakturdetail
		left join tfaktur on tfakturdetail.idfaktur = tfaktur.id
		where date_format(tfaktur.tanggal, '%m')  = '" . date('m') . "'
		and tfaktur.tipe = '2'
		and tfakturdetail.itemid = mitem.id) as total
		from mitem";
        $get = $this->db->query($strQuery)->result();
        $this->output->set_content_type('application/json')->set_output(json_encode($get, JSON_PRETTY_PRINT));
    }

    public function getChartKas()
    {
        $strQuery = "select
		mnoakun.namaakun,
		(
		select
		coalesce(sum(debet)-sum(kredit))
		from viewjurnaldetail
		where noakun = mnoakun.noakun) as total
		from mnoakun
		where mnoakun.kategoriakun = 'Kas & Bank'
		and mnoakun.stbayar = '1'";
        $get = $this->db->query($strQuery)->result();
        $this->output->set_content_type('application/json')->set_output(json_encode($get, JSON_PRETTY_PRINT));
    }

    public function getChartUtangPiutang()
    {
        $strQuery = "select
		'Utang' as tipe,
		coalesce(sum(tfaktur.sisatagihan),0) as total
		from tfaktur
		where date_format(tfaktur.tanggal, '%Y')  = '" . date('Y') . "'
		and tfaktur.tipe = '1'
		union all
		select
		'Piutang' as tipe,
		coalesce(sum(tfaktur.sisatagihan),0) as total
		from tfaktur
		where date_format(tfaktur.tanggal, '%Y')  = '" . date('Y') . "'
		and tfaktur.tipe = '2'";
        $get = $this->db->query($strQuery)->result();
        $this->output->set_content_type('application/json')->set_output(json_encode($get, JSON_PRETTY_PRINT));
    }

}
