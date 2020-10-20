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
        for ($i=0; $i < count($this->getIdJurnalAnggaran()); $i++) { 
            $this->db->where('idJurnalAnggaran', $this->getIdJurnalAnggaran()[$i]);
            $this->db->update($this->table, [
                'elemen'    => $this->getElemenJurnalAnggaran()[$i],
                'jenis'     => $this->getJenisAnggaran()[$i],
            ]);
        }
    }

    public function setElemenJurnalAnggaran($elemenJurnalAnggaran)
	{
		$this->elemenJurnalAnggaran	= $elemenJurnalAnggaran;
	}

	public function setJenisAnggaran($jenisAnggaran)
	{
		$this->jenisAnggaran	= $jenisAnggaran;
    }
    
    public function setIdJurnalAnggaran($idJurnalAnggaran)
	{
		$this->idJurnalAnggaran	= $idJurnalAnggaran;
	}
    
    protected function getElemenJurnalAnggaran()
	{
		return $this->elemenJurnalAnggaran;
	}

	protected function getJenisAnggaran()
	{
		return $this->jenisAnggaran;
    }
    
    private function getIdJurnalAnggaran()
    {
        return $this->idJurnalAnggaran;
    }
}

