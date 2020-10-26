<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/


class JurnalAnggaranModel extends SetUpJurnal_Model {

    private $idJurnalAnggaran;
    private $elemenJurnalAnggaran;
    private $jenisAnggaran;
    private $table  = 'tJurnalAnggaran';
    
    public function save()
    {
        if ($this->idJurnalAnggaran !== null) {
            for ($i=0; $i < count($this->idJurnalAnggaran); $i++) { 
                $this->db->where('idJurnalAnggaran', $this->idJurnalAnggaran[$i]);
                $this->db->update($this->table, [
                    'elemen'    => $this->setGet('elemenJurnalAnggaran')[$i],
                    'jenis'     => $this->setGet('jenisAnggaran')[$i],
                ]);
            }
        }
    }

    public function setGet($jenis = null, $isi = null)
	{
		if ($isi) {
			$this->$jenis	= $isi;
		} else {
			return $this->$jenis;
		}
	}
}

