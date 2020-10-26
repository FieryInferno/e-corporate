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
        if ($this->idJurnalFinansial) {
            for ($i=0; $i < count($this->idJurnalFinansial); $i++) { 
                $this->db->where('idJurnalFinansial', $this->idJurnalFinansial[$i]);
                $this->db->update($this->table, [
                    'elemen'    => $this->setGet('elemenJurnalFinansial')[$i],
                    'jenis'     => $this->setGet('jenisFinansial')[$i],
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

