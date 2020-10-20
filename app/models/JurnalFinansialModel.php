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


class JurnalFinansialModel extends SetUpJurnal_Model {

    private $idJurnalFinansial;
    private $elemenJurnalFinansial;
    private $jenisFinansial;
    private $table  = 'tJurnalFinansial';

    public function save()
    {
        for ($i=0; $i < count($this->getIdJurnalFinansial()); $i++) { 
            $this->db->where('idJurnalFinansial', $this->getIdJurnalFinansial()[$i]);
            $this->db->update($this->table, [
                'elemen'    => $this->getElemenJurnalFinansial()[$i],
                'jenis'     => $this->getJenisFinansial()[$i],
            ]);
        }
    }
    
	public function setElemenJurnalFinansial($elemenJurnalFinansial)
	{
		$this->elemenJurnalFinansial	= $elemenJurnalFinansial;
    }
    
	public function setJenisFinansial($jenisFinansial)
	{
		$this->jenisFinansial	= $jenisFinansial;
    }

    public function setIdJurnalFinansial($idJurnalFinansial)
	{
		$this->idJurnalFinansial	= $idJurnalFinansial;
	}

	protected function getElemenJurnalFinansial()
	{
		return $this->elemenJurnalFinansial;
	}

	protected function getJenisFinansial()
	{
		return $this->jenisFinansial;
    }
    
    private function getIdJurnalFinansial()
    {
        return $this->idJurnalFinansial;
    }
}

