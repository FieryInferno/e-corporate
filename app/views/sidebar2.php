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
                if ($this->uri->segment(1) == 'kategori' || $this->uri->segment(1) == 'item' || $this->uri->segment(1) == 'satuan') {
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
          <?php $menu = array('user', 'user_akses', 'user_hak_akses', 'perusahaan', 'departemen', 'tahun_anggaran', 'multi_curency')?>
          <li class="nav-item has-treeview  <?php echo menu_is_open($menu) ?>">
            <a href="#" class="nav-link
              <?php
                if ($this->uri->segment(1) == 'user' || $this->uri->segment(1) == 'perusahaan' || $this->uri->segment(1) == 'departemen') {
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
                <a href="{site_url}tahunanggaran" class="nav-link <?php echo menu_is_active('tahunanggaran') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('tahunanggaran') ?></p></a>
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
            <a href="SistemPenomoran" class="nav-link <?php echo menu_is_active('sistemPenomoran') ?>">
              <i class="nav-icon fas fa-list-ol"></i>
              <p>Sistem Penomoran</p>
            </a>
          </li>
          <li class="nav-header">TRANSAKSI</li>  
      <?php $menu = array('anggaran_pendapatan', 'anggaran_belanja', 'validasi_anggaran_pendapatan', 'validasi_anggaran_belanja') ?>
			<li class="nav-item has-treeview  <?php echo menu_is_open($menu) ?>">
            <a href="#" class="nav-link
              <?php
                if ($this->uri->segment(1) == 'anggaran_pendapatan' || $this->uri->segment(1) == 'anggaran_belanja') {
                  echo 'active';
                }
              ?>"><i class="nav-icon fas fa-comments-dollar"></i>
              <p><?php echo lang('Anggaran') ?><i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('anggaran') ?>">
              <li class="nav-item">
              <a href="{site_url}anggaran_pendapatan" class="nav-link <?php echo menu_is_active('anggaran_pendapatan') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('anggaran_pendapatan') ?></p></a>
              </li>
              <li class="nav-item">
              <a href="{site_url}anggaran_belanja" class="nav-link <?php echo menu_is_active('anggaran_belanja') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('anggaran_belanja') ?></p></a>
              </li>
              <li class="nav-item">
              <a href="{site_url}validasi_anggaran_pendapatan" class="nav-link <?php echo menu_is_active('validasi_anggaran_pendapatan') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('validasi_anggaran_pendapatan') ?></p></a>
              </li>            
              <li class="nav-item">
              <a href="{site_url}validasi_anggaran_belanja" class="nav-link <?php echo menu_is_active('validasi_anggaran_belanja') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('validasi_anggaran_belanja') ?></p></a>
              </li>            
                       
            </ul>
          </li>	

          <?php $menu = array('pemesanan_pembelian', 'pengiriman_pembelian', 'faktur_pembelian', 'pembayaran_pembelian', 'retur_pembelian')?>
          <li class="nav-item has-treeview  <?php echo menu_is_open($menu) ?>">
            <a href="#" class="nav-link
              <?php
                if ($this->uri->segment(1) == 'requiremen' || $this->uri->segment(1) == 'pemesanan_pembelian' || $this->uri->segment(1) == 'pengiriman_pembelian') {
                  echo 'active';
                }
              ?>"><i class="nav-icon fas fa-clipboard-list"></i>
              <p><?php echo lang('purchasing') ?><i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('purchasing') ?>">
              <li class="nav-item">
              <a href="{site_url}requiremen" class="nav-link <?php echo menu_is_active('requiremen') ?>"><i class="far fa-circle nav-icon"></i><p><?php echo lang('Permintaan_pembelian') ?></p></a>
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
              <a href="{site_url}pembayaran_pembelian" class="nav-link <?php echo menu_is_active('pembayaran_pembelian') ?>">
              <i class="far fa-circle nav-icon"></i><p><?php echo lang('payment') ?></p></a>
              </li>            
              <li class="nav-item">
              <a href="{site_url}retur_pembelian" class="nav-link <?php echo menu_is_active('retur_pembelian') ?>">
              <i class="far fa-circle nav-icon"></i><p><?php echo lang('return') ?></p></a>
              </li>            
                       
            </ul>
          </li>	

          <?php $menu = array(
    'pemesanan_penjualan',
    'pengiriman_penjualan',
    'faktur_penjualan',
    'pembayaran_penjualan',
    'retur_penjualan',
)?>
 <li class="nav-item has-treeview  <?php echo menu_is_open($menu) ?>">
            <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
              <p><?php echo lang('selling') ?><i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('selling') ?>">                        
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
        <?php $menu = array(
            'kas_bank',
            'kas_kecil',
        )?>
          <li class="nav-item has-treeview  <?php echo menu_is_open($menu) ?>">
            <a href="#" class="nav-link
              <?php
                if ($this->uri->segment(1) == 'kas_bank' || $this->uri->segment(1) == 'pengeluaran_kas_kecil') {
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
              <?php $menu1 = array(
                'pengajuan_kas_kecil',
                'pemindahbukuan',
                'pengeluaran_kas_kecil',
                'setor_kas_kecil',
              )?>
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
          <?php 
            $menuInventaris = [
              'daftarInventaris',
              'pemeliharaanAset',
              'mutasiAset',
              'penghapusanAset',
              'penyusutan'
            ];
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link"><i class="nav-icon fas fa-dolly"></i>
              <p>Inventaris<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" data-submenu-title="inventaris">                        
              <li class="nav-item">
                <a href="#" class="nav-link <?php echo menu_is_active('daftarInventaris') ?>">
                <i class="far fa-circle nav-icon"></i><p>Daftar Inventaris</p></a>
              </li>          
              <li class="nav-item">
                <a href="#" class="nav-link <?php echo menu_is_active('pemeliharaanAset') ?>">
                <i class="far fa-circle nav-icon"></i><p>Pemeliharaan Aset</p></a>
              </li>          
              <li class="nav-item">
                <a href="#" class="nav-link <?php echo menu_is_active('mutasiAset') ?>">
                <i class="far fa-circle nav-icon"></i><p>Mutasi Aset</p></a>
              </li>          
              <li class="nav-item">
                <a href="#" class="nav-link <?php echo menu_is_active('penghapusanAset') ?>">
                <i class="far fa-circle nav-icon"></i><p>Penghapusan Aset</p></a>
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

          <?php $menu = array(
              'laporan_pembelian',
              'laporan_penjualan',
              'laporan_retur_pembelian',
              'laporan_retur_penjualan',
              'laporan_stok',
              'laporan_stok_akhir_barang',
          )?>
        <li class="nav-item has-treeview  <?php echo menu_is_open($menu) ?>">
            <a href="#" class="nav-link"><i class="nav-icon fas fa-copy"></i>
              <p><?php echo lang('report') ?><i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('report') ?>">                        
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
            </ul>
          </li>	

        <li class="nav-header">AKUNTANSI</li>  

        <?php $menuSaldoAwal = ['saldo_awal', 'saldoawalhutang', 'saldoawalpiutang', 'saldoawalinventaris', 'saldoawalpersediaan']; ?>
        <li class="nav-item has-treeview <?= menu_is_open($menuSaldoAwal) ?>">
          <a href="#" class="nav-link
            <?php
              if ($this->uri->segment(1) == 'saldo_awal' || $this->uri->segment(1) == 'SaldoAwalHutang' || $this->uri->segment(1) == 'SaldoAwalPiutang' || $this->uri->segment(1) == 'SaldoAwalInventaris' || $this->uri->segment(1) == 'SaldoAwalPersediaan') {
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
              <a href="{site_url}SaldoAwalHutang" class="nav-link <?php echo menu_is_active('SaldoAwalHutang') ?>">
                <i class="far fa-circle nav-icon"></i><p> Saldo Awal Hutang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{site_url}SaldoAwalPiutang" class="nav-link <?php echo menu_is_active('SaldoAwalPiutang') ?>">
                <i class="far fa-circle nav-icon"></i><p> Saldo Awal Piutang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{site_url}SaldoAwalInventaris" class="nav-link <?php echo menu_is_active('SaldoAwalInventaris') ?>">
                <i class="far fa-circle nav-icon"></i><p> Saldo Awal Inventaris</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{site_url}SaldoAwalPersediaan" class="nav-link <?php echo menu_is_active('SaldoAwalPersediaan') ?>">
                <i class="far fa-circle nav-icon"></i><p> Saldo Awal Persediaan</p>
              </a>
            </li>                                           
          </ul>
        </li>	

				<li class="nav-item">
					<a href="{site_url}noakun" class="nav-link <?php echo menu_is_active('noakun') ?>">
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

        <?php $menu = ['utang', 'piutang']; ?>
        <li class="nav-item has-treeview  <?php echo menu_is_open($menu) ?>">
          <a href="#" class="nav-link"><i class="nav-icon fas fa-copy"></i>
            <p><?php echo lang('Utang &amp; Piutang') ?><i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview" data-submenu-title="<?php echo lang('Utang &amp; Piutang') ?>">                        
            <li class="nav-item">
              <a href="{site_url}utang" class="nav-link <?php echo menu_is_active('pemesanan_pembelian') ?>">
                <i class="far fa-circle nav-icon"></i><p><?php echo lang('Utang Usaha') ?></p>
              </a>
            </li>            
            <li class="nav-item">
              <a href="{site_url}piutang" class="nav-link <?php echo menu_is_active('pengiriman_pembelian') ?>">
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
					<a href="{site_url}buku_besar" class="nav-link <?php echo menu_is_active('buku_besar') ?>">
						<i class="icon-notebook"></i>
						<i class="fas fa-journal-whills nav-icon"></i><p><?php echo lang('ledger') ?> </p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}neraca_saldo" class="nav-link <?php echo menu_is_active('neraca_saldo') ?>">
						<i class="icon-cash"></i>
						<i class="fas fa-donate nav-icon"></i><p><?php echo lang('trial_balance') ?> </p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}jurnal_penyesuaian" class="nav-link <?php echo menu_is_active('jurnal_penyesuaian') ?>">
						<i class="icon-stack"></i>
						<i class="far fas fa-adjust nav-icon"></i><p><?php echo lang('adjusting_entries') ?> </p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}neraca_saldo_penyesuaian" class="nav-link <?php echo menu_is_active('neraca_saldo_penyesuaian') ?>">
						<i class="icon-cash"></i>
						<i class="fas fa-file-invoice nav-icon"></i><p><?php echo lang('adjusted_trial_balance') ?> </p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}laba_rugi" class="nav-link <?php echo menu_is_active('laba_rugi') ?>">
						<i class="icon-cash3"></i>
						<i class="fas fa-chart-bar nav-icon"></i><p><?php echo lang('income_statement') ?> </p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}perubahan_modal" class="nav-link <?php echo menu_is_active('perubahan_modal') ?>">
						<i class="icon-cash3"></i>
						<i class="fas fa-sync-alt nav-icon"></i><p><?php echo lang('Statement_of_Owner_Equity') ?> </p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}neraca" class="nav-link <?php echo menu_is_active('neraca') ?>"> <i class="icon-cash3"></i>
					<i class="fas fa-balance-scale nav-icon"></i><p><?php echo lang('Balance_sheet') ?> </p>
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