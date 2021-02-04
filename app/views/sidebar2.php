<?php $uri = $this->uri->segment(1)?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url()?>" class="brand-link">
    <img src="<?= base_url('adminlte')?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">PT ABB</span>
  </a>

    <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('adminlte')?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"> <?php echo get_user('name') ?></a>
      </div>
    </div>

<!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
        <a href="{site_url}dashboard" class="nav-link <?php echo menu_is_active('dashboard') ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
            <?php echo lang('Dashboard') ?>
            </p>
          </a>
        </li>

        <li class="nav-header">MASTER DATA</li>       

        <?php $menu = array('item', 'kategori', 'satuan')?>  
          <li class="nav-item has-treeview  <?php echo menu_is_open($menu) ?>">
            <a href="#" class="nav-link
            <?php
              if (in_array($this->uri->segment(1), $menu)) {
                echo 'active';
              }
            ?>"><i class="nav-icon fas fa-list"></i>
              <p><?php echo lang('item') ?><i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('item') ?>">
              <li class="nav-item">
                <a href="{site_url}item" class="nav-link <?php echo menu_is_active('item') ?>">
                  <i class="far fa-circle nav-icon"></i>                  
                  <p><?php echo lang('item') ?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{site_url}kategori" class="nav-link <?php echo menu_is_active('kategori') ?>">
                  <i class="far fa-circle nav-icon"></i>                  
                  <p><?php echo lang('category') ?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{site_url}satuan" class="nav-link <?php echo menu_is_active('satuan') ?>">
                  <i class="far fa-circle nav-icon"></i>                  
                  <p><?php echo lang('unit') ?></p>
                </a>
              </li>             
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{site_url}gudang" class="nav-link <?php echo menu_is_active('gudang') ?>">
              <i class="nav-icon fas fa-warehouse"></i><p><?php echo lang('warehouse') ?></p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{site_url}kontak" class="nav-link <?php echo menu_is_active('kontak') ?>">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                <?php echo lang('contact') ?>
              </p>
            </a>
          </li>
      <?php $menuPengelolaanUser = ['user', 'user_akses', 'user_hak_akses', 'perusahaan', 'departemen', 'tahun_anggaran', 'multi_curency', 'cabang']; ?>
      <li class="nav-item has-treeview  <?php echo menu_is_open($menuPengelolaanUser) ?>">
        <a href="#" class="nav-link
          <?php
            if (in_array($this->uri->segment(1), $menuPengelolaanUser)) {
              echo 'active';
            }
          ?>"><i class="nav-icon fas fa-users"></i>
          <p><?php echo lang('user_management') ?><i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('user_management') ?>">
          <li class="nav-item">
            <a href="{site_url}user" class="nav-link <?php echo menu_is_active('user') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('user') ?></p></a>
          </li>
          <li class="nav-item">
            <a href="{site_url}perusahaan" class="nav-link <?php echo menu_is_active('perusahaan') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('perusahaan') ?></p></a>
          </li>
          <li class="nav-item">
            <a href="{site_url}departemen" class="nav-link <?php echo menu_is_active('departemen') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('departemen') ?></p></a>
          </li>
          <li class="nav-item">
            <a href="{site_url}cabang" class="nav-link <?php echo menu_is_active('cabang') ?>"><i class="far fa-circle nav-icon"></i><p>Cabang</p></a>
          </li>             
          <li class="nav-item">
            <a href="{site_url}tahun_anggaran" class="nav-link <?php echo menu_is_active('tahun_anggaran') ?>"><i class="far fa-circle nav-icon"></i><p>Tahun Anggaran</p></a>
          </li>
          <li class="nav-item">
            <a href="{site_url}multi_curency" class="nav-link <?php echo menu_is_active('multi_curency') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('multi_curency') ?></p></a>
          </li>
          <li class="nav-item">
            <a href="{site_url}rekening" class="nav-link <?php echo menu_is_active('rekening') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('rekening') ?></p></a>
          </li>             
          <li class="nav-item">
            <a href="{site_url}user_akses" class="nav-link <?php echo menu_is_active('user_akses') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('user_akses') ?></p></a>
          </li>
          <li class="nav-item">
            <a href="{site_url}user_hak_akses" class="nav-link <?php echo menu_is_active('user_hak_akses') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('user_hak_akses') ?></p></a>
          </li>             
        </ul>
      </li>
      <li class="nav-item">
        <a href="{site_url}pajak" class="nav-link <?php echo menu_is_active('pajak') ?>">
          <i class="nav-icon fas fa-balance-scale"></i>
          <p>Pajak</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{site_url}sistem_penomoran" class="nav-link <?php echo menu_is_active('sistem_penomoran') ?>">
          <i class="nav-icon fas fa-list-ol"></i>
          <p>Sistem Penomoran</p>
        </a>
      </li>
      <li class="nav-header">TRANSAKSI</li>  
      <?php $menuAnggaran = ['anggaran_pendapatan', 'anggaran_belanja', 'validasi_anggaran_pendapatan', 'validasi_anggaran_belanja']; ?>
			<li class="nav-item has-treeview  <?php echo menu_is_open($menuAnggaran) ?>">
        <a href="#" class="nav-link
          <?php
            if (in_array($this->uri->segment(1), $menuAnggaran)) {
              echo 'active';
            }
          ?>">
          <i class="nav-icon fas fa-comments-dollar"></i>
          <p><?php echo lang('Anggaran') ?><i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('anggaran') ?>">
          <li class="nav-item">
          <a href="{site_url}anggaran_pendapatan" class="nav-link <?php echo menu_is_active('anggaran_pendapatan') ?>"><i class="far fa-circle nav-icon"></i><p>Anggaran Pendapatan</p></a>
          </li>
          <li class="nav-item">
          <a href="{site_url}anggaran_belanja" class="nav-link <?php echo menu_is_active('anggaran_belanja') ?>"><i class="far fa-circle nav-icon"></i><p>Anggaran Belanja</p></a>
          </li>
          <li class="nav-item">
          <a href="{site_url}validasi_anggaran_pendapatan" class="nav-link <?php echo menu_is_active('validasi_anggaran_pendapatan') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('validasi_anggaran_pendapatan') ?></p></a>
          </li>            
          <li class="nav-item">
          <a href="{site_url}validasi_anggaran_belanja" class="nav-link <?php echo menu_is_active('validasi_anggaran_belanja') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('validasi_anggaran_belanja') ?></p></a>
          </li>    
        </ul>
      </li>	

      <?php $menuPembelian = array('requiremen', 'pemesanan_pembelian', 'pengiriman_pembelian', 'faktur_pembelian', 'pembayaran_pembelian', 'retur_pembelian')?>
      <li class="nav-item has-treeview  <?php echo menu_is_open($menuPembelian) ?>">
        <a href="#" class="nav-link
          <?php
            if (in_array($this->uri->segment(1), $menuPembelian)) {
              echo 'active';
            }
          ?>"><i class="nav-icon fas fa-clipboard-list"></i>
          <p><?php echo lang('purchasing') ?><i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('purchasing') ?>">
          <li class="nav-item">
            <a href="{site_url}requiremen" class="nav-link <?php echo menu_is_active('requiremen') ?>"><i class="far fa-circle nav-icon"></i><p>Permintaan Pembelian</p></a>
          </li>
          <li class="nav-item">
            <a href="{site_url}pemesanan_pembelian" class="nav-link <?php echo menu_is_active('pemesanan_pembelian') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('purchase_order') ?></p></a>
          </li>
          <li class="nav-item">
            <a href="{site_url}pengiriman_pembelian" class="nav-link <?php echo menu_is_active('pengiriman_pembelian') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('goods_receipt') ?></p></a>
          </li>            
          <li class="nav-item">
            <a href="{site_url}faktur_pembelian" class="nav-link <?php echo menu_is_active('faktur_pembelian') ?>">
          <i class="far fa-circle nav-icon"></i><p><?php echo lang('invoice') ?></p></a>
          </li>          
          <li class="nav-item">
            <a href="{site_url}retur_pembelian" class="nav-link <?php echo menu_is_active('retur_pembelian') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('return') ?></p></a>
          </li>    
        </ul>
      </li>	

      <?php $menuPenjualan = array('pemesanan_penjualan', 'pengiriman_penjualan', 'faktur_penjualan', 'pembayaran_penjualan', 'retur_penjualan', 'project'); ?>
      <li class="nav-item has-treeview  <?php echo menu_is_open($menuPenjualan) ?>">
        <a href="#" class="nav-link 
          <?php
            if (in_array($this->uri->segment(1), $menuPenjualan)) {
              echo 'active';
            }
          ?>"><i class="nav-icon fas fa-shopping-cart"></i>
          <p><?php echo lang('selling') ?><i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('selling') ?>">
          <li class="nav-item">
            <a href="{site_url}project" class="nav-link <?php echo menu_is_active('project') ?>">
            <i class="far fa-circle nav-icon"></i><p>Project</p></a>
          </li>                        
          <li class="nav-item">
            <a href="{site_url}pemesanan_penjualan" class="nav-link <?php echo menu_is_active('pemesanan_penjualan') ?>">
            <i class="far fa-circle nav-icon"></i><p><?php echo lang('sales_order') ?></p></a>
          </li>            
          <li class="nav-item">
            <a href="{site_url}pengiriman_penjualan" class="nav-link <?php echo menu_is_active('pengiriman_penjualan') ?>">
            <i class="far fa-circle nav-icon"></i><p><?php echo lang('delivery') ?></p></a>
          </li>            
          <li class="nav-item">
            <a href="{site_url}faktur_penjualan" class="nav-link <?php echo menu_is_active('faktur_penjualan') ?>">
            <i class="far fa-circle nav-icon"></i><p><?php echo lang('invoice') ?></p></a>
          </li>            
          <li class="nav-item">
            <a href="{site_url}SetorPajak" class="nav-link <?php echo menu_is_active('SetorPajak') ?>">
            <i class="far fa-circle nav-icon"></i><p>Setor Pajak</p></a>
          </li>            
          <li class="nav-item">
            <a href="{site_url}retur_penjualan" class="nav-link <?php echo menu_is_active('retur_penjualan') ?>">
            <i class="far fa-circle nav-icon"></i><p><?php echo lang('return') ?></p></a>
          </li>        
        </ul>
      </li>	   

        <?php $menu = array('kas_bank', 'pemindahbukuan', 'pengeluaran_kas_kecil', 'setor_kas_kecil', 'pengajuan_kas_kecil'); ?>
          <li class="nav-item has-treeview  <?php echo menu_is_open($menu) ?>">
            <a href="#" class="nav-link
              <?php
                if (in_array($this->uri->segment(1), $menu)) {
                  echo 'active';
                }
              ?>"><i class="nav-icon fas fa-coins"></i>
              <p><?php echo lang('finance') ?><i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('finance') ?>">                        
              <li class="nav-item">
                <a href="{site_url}kas_bank" class="nav-link <?php echo menu_is_active('kas_bank') ?>">
                <i class="far fa-circle nav-icon"></i><p><?php echo lang('bank_cash') ?></p></a>
              </li>
              <?php $menu1 = array('pengajuan_kas_kecil', 'pemindahbukuan', 'pengeluaran_kas_kecil', 'setor_kas_kecil'); ?>
              <li class="nav-item has-treeview  <?php echo menu_is_open($menu1) ?>">
                <a href="#" class="nav-link"><i class="nav-icon far fa-circle"></i>
                  <p><?php echo lang('petty_cash') ?><i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('petty_cash') ?>">                        
                  <li class="nav-item">
                    <a href="{site_url}pengajuan_kas_kecil" class="nav-link <?php echo menu_is_active('pengajuan_kas_kecil') ?>">
                    <i class="far fa-circle nav-icon"></i><p><?php echo lang('petty_cash_submission') ?></p></a>
                  </li>          
                  <li class="nav-item">
                    <a href="{site_url}pemindahbukuan" class="nav-link <?php echo menu_is_active('pemindahbukuan') ?>">
                    <i class="far fa-circle nav-icon"></i><p><?php echo lang('book-entry') ?></p></a>
                  </li>          
                  <li class="nav-item">
                    <a href="{site_url}pengeluaran_kas_kecil" class="nav-link <?php echo menu_is_active('pengeluaran_kas_kecil') ?>">
                    <i class="far fa-circle nav-icon"></i><p><?php echo lang('petty_cash_outlay') ?></p></a>
                  </li>          
                  <li class="nav-item">
                    <a href="{site_url}setor_kas_kecil" class="nav-link <?php echo menu_is_active('setor_kas_kecil') ?>">
                    <i class="far fa-circle nav-icon"></i><p><?php echo lang('petty_cash_deposit') ?></p></a>
                  </li>          
                </ul>
              </li>	          
            </ul>
          </li>	
          <li class="nav-item has-treeview">
            <a href="{site_url}persediaan" class="nav-link <?php echo menu_is_active('persediaan') ?>">
              <i class="nav-icon fas fa-business-time"></i>
              <p>Persediaan</p>
            </a>
          </li>

      <?php $menuInventaris = ['inventaris', 'pemeliharaan_aset', 'mutasi_aset', 'penghapusan_aset', 'penyusutan', 'konfigurasi_penyusutan']; ?>
      <li class="nav-item has-treeview <?php echo menu_is_open($menuInventaris) ?>">
        <a href="#" class="nav-link
          <?php
            if (in_array($this->uri->segment(1), $menuInventaris)) {
              echo 'active';
            }
          ?>">
          <i class="nav-icon fas fa-dolly"></i>
          <p>Inventaris<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview" data-submenu-title="inventaris">                        
          <li class="nav-item">
            <a href="{site_url}inventaris" class="nav-link <?php echo menu_is_active('inventaris') ?>">
            <i class="far fa-circle nav-icon"></i><p>Daftar Inventaris</p></a>
          </li>          
          <li class="nav-item">
            <a href="{site_url}pemeliharaan_aset" class="nav-link <?php echo menu_is_active('pemeliharaan_aset') ?>">
            <i class="far fa-circle nav-icon"></i><p>Pemeliharaan Aset</p></a>
          </li>          
          <li class="nav-item">
            <a href="{site_url}mutasi_aset" class="nav-link <?php echo menu_is_active('mutasi_aset') ?>">
            <i class="far fa-circle nav-icon"></i><p>Mutasi Aset</p></a>
          </li>          
          <li class="nav-item">
            <a href="{site_url}penghapusan_aset" class="nav-link <?php echo menu_is_active('penghapusan_aset') ?>">
            <i class="far fa-circle nav-icon"></i><p>Penghapusan Aset</p></a>
          </li>          
          <li class="nav-item">
            <a href="{site_url}konfigurasi_penyusutan" class="nav-link <?php echo menu_is_active('konfigurasi_penyusutan') ?>">
            <i class="far fa-circle nav-icon"></i><p>Konfigurasi Penyusutan</p></a>
          </li>           
          <li class="nav-item">
            <a href="#" class="nav-link <?php echo menu_is_active('penyusutan') ?>">
            <i class="far fa-circle nav-icon"></i><p>Penyusutan</p></a>
          </li>          
        </ul>
      </li>

          <li class="nav-item has-treeview">
          <a href="{site_url}memo" class="nav-link <?php echo menu_is_active('memo') ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i><p><?php echo lang('memos') ?></p></a>
          </li>
          <li class="nav-item has-treeview">
          <a href="{site_url}stokopname" class="nav-link <?php echo menu_is_active('stokopname') ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i><p><?php echo lang('Stock_Opname') ?></p></a>
          </li>

        <?php $menuLaporan = array('laporan_pembelian', 'laporan_penjualan', 'laporan_retur_pembelian', 'laporan_retur_penjualan', 'laporan_stok', 'laporan_stok_akhir_barang', 'laporan_kas_bank', 'laporan_buku_pembantu_kas_kecil', 'outstanding_invoice', 'outstanding_payable', 'project_list', 'laporan_neraca_multi_period', 'laporan_labarugi_standar', 'laporan_labarugi_multi_period', 'laporan_labarugi_compare_period', 'sales_receipts_detail', 'purchase_payment_detail'); ?>
        <li class="nav-item has-treeview  <?php echo menu_is_open($menuLaporan) ?>">
          <a href="#" class="nav-link
          <?php
            if (in_array($this->uri->segment(1), $menuLaporan)) {
              echo 'active';
            }
          ?>"><i class="nav-icon fas fa-copy"></i>
            <p><?php echo lang('report') ?><i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('report') ?>">  
            <?php $menuLaporanKeuangan  = ['laporan_kas_bank', 'outstanding_invoice', 'outstanding_payable', 'project_list']; ?>
            <li class="nav-item has-treeview  <?php echo menu_is_open($menuLaporanKeuangan) ?>">
              <a href="#" class="nav-link"><i class="nav-icon far fa-circle"></i>
                <p>Laporan Keuangan<i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview" data-submenu-title="Laporan Keuangan"> 
                <li class="nav-item">
                  <a href="{site_url}laporan_kas_bank" class="nav-link <?php echo menu_is_active('laporan_kas_bank') ?>">
                  <i class="far fa-circle nav-icon"></i><p>laporan Kas Bank</p></a>
                </li>
                <li class="nav-item">
                  <a href="{site_url}outstanding_invoice" class="nav-link <?php echo menu_is_active('outstanding_invoice') ?>">
                  <i class="far fa-circle nav-icon"></i><p>Outstanding Invoice Report</p></a>
                </li>
                <li class="nav-item">
                  <a href="{site_url}outstanding_payable" class="nav-link <?php echo menu_is_active('outstanding_payable') ?>">
                  <i class="far fa-circle nav-icon"></i><p>Outstanding Payable Report</p></a>
                </li>
                <li class="nav-item">
                  <a href="{site_url}project_list" class="nav-link <?php echo menu_is_active('project_list') ?>">
                  <i class="far fa-circle nav-icon"></i><p>Project List</p></a>
                </li>
              </ul>
            </li>                      
            <li class="nav-item has-treeview  <?php echo menu_is_open($menuLaporanKeuangan) ?>">
              <a href="#" class="nav-link"><i class="nav-icon far fa-circle"></i>
                <p>Laporan Akuntansi<i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview" data-submenu-title="Laporan Keuangan"> 
                <li class="nav-item">
                  <a href="{site_url}laporan_kas_bank" class="nav-link <?php echo menu_is_active('laporan_kas_bank') ?>">
                  <i class="far fa-circle nav-icon"></i><p>laporan Kas Bank</p></a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link <?php echo menu_is_active('') ?>">
                  <i class="far fa-circle nav-icon"></i><p>Outstanding Invoice Report</p></a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link <?php echo menu_is_active('') ?>">
                  <i class="far fa-circle nav-icon"></i><p>Outstanding Payable Report</p></a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link <?php echo menu_is_active('') ?>">
                  <i class="far fa-circle nav-icon"></i><p>Project List</p></a>
                </li>
              </ul>
            </li>                      
            <li class="nav-item">
              <a href="{site_url}laporan_pembelian" class="nav-link <?php echo menu_is_active('laporan_pembelian') ?>">
              <i class="far fa-circle nav-icon"></i><p><?php echo lang('purchasing_report') ?></p></a>
            </li>            
            <li class="nav-item">
              <a href="{site_url}laporan_penjualan" class="nav-link <?php echo menu_is_active('laporan_penjualan') ?>">
              <i class="far fa-circle nav-icon"></i><p><?php echo lang('selling_report') ?></p></a>
            </li>            
            <li class="nav-item">
              <a href="{site_url}laporan_retur_pembelian" class="nav-link <?php echo menu_is_active('laporan_retur_pembelian') ?>">
              <i class="far fa-circle nav-icon"></i><p><?php echo lang('Laporan Retur') ?></p></a>
            </li>            
            <li class="nav-item">
              <a href="{site_url}laporan_retur_penjualan" class="nav-link <?php echo menu_is_active('laporan_retur_penjualan') ?>">
              <i class="far fa-circle nav-icon"></i><p><?php echo lang('sales_return_report') ?></p></a>
            </li>            
            <li class="nav-item">
              <a href="{site_url}laporan_stok" class="nav-link <?php echo menu_is_active('laporan_stok') ?>">
              <i class="far fa-circle nav-icon"></i><p><?php echo lang('stock_report') ?> (In/Out)</p></a>
            </li>            
            <li class="nav-item">
              <a href="{site_url}laporan_stok_akhir_barang" class="nav-link <?php echo menu_is_active('laporan_stok_akhir_barang') ?>">
              <i class="far fa-circle nav-icon"></i><p><?php echo lang('Lap Stok Akhir Barang') ?></p></a>
            </li>  
            <li class="nav-item">
              <a href="{site_url}laporan_buku_pembantu_kas_kecil" class="nav-link <?php echo menu_is_active('laporan_buku_pembantu_kas_kecil') ?>">
              <i class="far fa-circle nav-icon"></i><p>Laporan Buku Pembantu Kas Kecil</p></a>
            </li>
            <li class="nav-item">
              <a href="{site_url}laporan_utang" class="nav-link <?php echo menu_is_active('laporan_utang') ?>">
              <i class="far fa-circle nav-icon"></i><p>Laporan Utang Usaha</p></a>
            </li>   
            <li class="nav-item">
              <a href="{site_url}laporan_piutang" class="nav-link <?php echo menu_is_active('laporan_piutang') ?>">
              <i class="far fa-circle nav-icon"></i><p>Laporan Piutang Usaha</p></a>
            </li>
            <li class="nav-item">
              <a href="{site_url}laporan_neraca" class="nav-link <?php echo menu_is_active('laporan_neraca') ?>">
              <i class="far fa-circle nav-icon"></i><p>Laporan Neraca (Compare Month)</p></a>
            </li>   
            <li class="nav-item">
              <a href="{site_url}laporan_neraca_multi_period" class="nav-link <?php echo menu_is_active('laporan_neraca_multi_period') ?>">
              <i class="far fa-circle nav-icon"></i><p>Laporan Neraca (Multi Period)</p></a>
            </li> 
            <li class="nav-item">
              <a href="{site_url}laporan_neraca_standar" class="nav-link <?php echo menu_is_active('laporan_neraca_standar') ?>">
              <i class="far fa-circle nav-icon"></i><p>Laporan Neraca (Standard)</p></a>
            </li>  
            <!-- <li class="nav-item">
              <a href="" class="nav-link <?php echo menu_is_active('') ?>">
              <i class="far fa-circle nav-icon"></i><p>Audit Trails Detail</p></a>
            </li>       -->
            <!-- <li class="nav-item">
              <a href="" class="nav-link <?php echo menu_is_active('') ?>">
              <i class="far fa-circle nav-icon"></i><p>Cash Flow by Account</p></a>
            </li>       -->
            <!-- <li class="nav-item">
              <a href="" class="nav-link <?php echo menu_is_active('') ?>">
              <i class="far fa-circle nav-icon"></i><p>Fixed Asset List - by Fixed Asset Type</p></a>
            </li>       -->
            <!-- <li class="nav-item">
              <a href="" class="nav-link <?php echo menu_is_active('') ?>">
              <i class="far fa-circle nav-icon"></i><p>General Ledger Detail</p></a>
            </li>        -->
            <li class="nav-item">
              <a href="" class="nav-link <?php echo menu_is_active('') ?>">
              <i class="far fa-circle nav-icon"></i><p>Profit & Loss by Department</p></a>
            </li>      
            <li class="nav-item">
              <a href="{site_url}laporan_labarugi/compare_period" class="nav-link <?php echo menu_is_active('laporan_labarugi_compare_period') ?>">
              <i class="far fa-circle nav-icon"></i><p>Profit & Loss (Compare Period)</p></a>
            </li>      
            <li class="nav-item">
              <a href="{site_url}laporan_labarugi/multi_period" class="nav-link <?php echo menu_is_active('laporan_labarugi_multi_period') ?>">
              <i class="far fa-circle nav-icon"></i><p>Profit & Loss (Multi Period)</p></a>
            </li>      
            <li class="nav-item">
              <a href="{site_url}laporan_labarugi/standar" class="nav-link <?php echo menu_is_active('laporan_labarugi_standar') ?>">
              <i class="far fa-circle nav-icon"></i><p>Profit & Loss (Standard)</p></a>
            </li>         
            <li class="nav-item">
              <a href="{site_url}purchase_payment_detail" class="nav-link <?php echo menu_is_active('purchase_payment_detail') ?>">
              <i class="far fa-circle nav-icon"></i><p>Purchase Payment Detail</p></a>
            </li>      
            <li class="nav-item">
              <a href="{site_url}sales_receipts_detail" class="nav-link <?php echo menu_is_active('sales_receipts_detail') ?>">
              <i class="far fa-circle nav-icon"></i><p>Sales Receipts Detail</p></a>
            </li>      
            <!-- <li class="nav-item">
              <a href="" class="nav-link <?php echo menu_is_active('') ?>">
              <i class="far fa-circle nav-icon"></i><p>Trial Balance</p></a>
            </li>       -->
          </ul>
        </li>	

        <li class="nav-header">AKUNTANSI</li>  

        <?php $menuSaldoAwal = ['saldo_awal', 'saldo_awal_hutang', 'saldo_awal_piutang', 'saldo_awal_inventaris', 'saldo_awal_persediaan']; ?>
        <li class="nav-item has-treeview <?= menu_is_open($menuSaldoAwal) ?>">
          <a href="#" class="nav-link
            <?php
              if (in_array($this->uri->segment(1), $menuSaldoAwal)) {
                echo 'active';
              }
            ?>"><i class="nav-icon fas fa-copy"></i>
            <p>Saldo Awal <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview" data-submenu-title="<?= 'Saldo Awal' ?>">                        
            <li class="nav-item">
              <a href="{site_url}saldo_awal" class="nav-link <?= menu_is_active('saldo_awal') ?>">
                <i class="far fa-circle nav-icon"></i><p> Saldo Awal</p>
              </a>
            </li>            
            <li class="nav-item">
              <a href="{site_url}saldo_awal_hutang" class="nav-link <?php echo menu_is_active('saldo_awal_hutang') ?>">
                <i class="far fa-circle nav-icon"></i><p> Saldo Awal Hutang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{site_url}saldo_awal_piutang" class="nav-link <?php echo menu_is_active('saldo_awal_piutang') ?>">
                <i class="far fa-circle nav-icon"></i><p> Saldo Awal Piutang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{site_url}saldo_awal_inventaris" class="nav-link <?php echo menu_is_active('saldo_awal_inventaris') ?>">
                <i class="far fa-circle nav-icon"></i><p> Saldo Awal Inventaris</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{site_url}saldo_awal_persediaan" class="nav-link <?php echo menu_is_active('saldo_awal_persediaan') ?>">
                <i class="far fa-circle nav-icon"></i><p> Saldo Awal Persediaan</p>
              </a>
            </li>                                           
          </ul>
        </li>	

				<li class="nav-item">
					<a href="{site_url}nomor_akun" class="nav-link <?php echo menu_is_active('nomor_akun') ?>">
						<i class="icon-database"></i>
						<i class="nav-icon fas fa-file-invoice-dollar"></i><p> <?php echo lang('account_number') ?> </p>
					</a>
				</li>
        
				<li class="nav-item">
					<a href="{site_url}SetUpJurnal" class="nav-link <?php echo menu_is_active('SetUpJurnal') ?>">
						<i class="icon-cash"></i>
						<i class="nav-icon fas fa-cogs"></i><p>Setup Jurnal</p>
					</a>
        </li>

        <?php $menuUtangPiutang = ['utang', 'piutang']; ?>
        <li class="nav-item has-treeview  <?php echo menu_is_open($menuUtangPiutang) ?>">
          <a href="#" class="nav-link
            <?php
              if (in_array($this->uri->segment(1), $menuUtangPiutang)) {
                echo 'active';
              }
            ?>"><i class="nav-icon fas fa-copy"></i>
            <p><?php echo lang('Utang &amp; Piutang') ?><i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('Utang &amp; Piutang') ?>">                        
            <li class="nav-item">
              <a href="{site_url}utang" class="nav-link <?php echo menu_is_active('utang') ?>">
                <i class="far fa-circle nav-icon"></i><p><?php echo lang('Utang Usaha') ?></p>
              </a>
            </li>            
            <li class="nav-item">
              <a href="{site_url}piutang" class="nav-link <?php echo menu_is_active('piutang') ?>">
                <i class="far fa-circle nav-icon"></i><p><?php echo lang('Piutang Usaha') ?></p>
              </a>
            </li>                                           
          </ul>
        </li>	

        <li class="nav-item">
					<a href="{site_url}jurnal" class="nav-link <?php echo menu_is_active('jurnal') ?>">
						<i class="icon-stack"></i>
						<i class="fas fa-book-open nav-icon"></i><p><?php echo lang('general_journal') ?> </p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}jurnal_penyesuaian" class="nav-link <?php echo menu_is_active('jurnal_penyesuaian') ?>">
						<i class="icon-stack"></i>
						<i class="far fas fa-adjust nav-icon"></i><p><?php echo lang('adjusting_entries') ?> </p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}metaakun" class="nav-link <?php echo menu_is_active('metaakun') ?>"> <i class="icon-gear"></i>
					<i class="fas fa-search nav-icon"></i><p> Pemetaan Akun </p>
					</a>
				</li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
  </div>
</aside>