<?php $uri = $this->uri->segment(1)?>
<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md {bg_sidebar}">

	<!-- Sidebar mobile toggler -->
	<div class="sidebar-mobile-toggler text-center">
		<a href="#" class="sidebar-mobile-main-toggle">
			<i class="icon-arrow-left8"></i>
		</a>
		Navigation
		<a href="#" class="sidebar-mobile-expand">
			<i class="icon-screen-full"></i>
			<i class="icon-screen-normal"></i>
		</a>
	</div>
	<!-- /sidebar mobile toggler -->


	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- Main navigation -->
		<div class="card card-sidebar-mobile">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
				<li class="nav-item">
					<a href="{site_url}dashboard" class="nav-link <?php echo menu_is_active('dashboard') ?>">
						<i class="icon-chart"></i>
						<span> <?php echo lang('Dashboard') ?> </span>
					</a>
				</li>
				<li class="nav-item-header">
					<div class="text-uppercase font-size-xs line-height-xs">MASTER DATA</div>
					<i class="icon-menu" title="Data visualization"></i>
				</li>
				<?php $menu = array('item', 'kategori', 'satuan')?>
				<li class="nav-item nav-item-submenu <?php echo menu_is_open($menu) ?>">
					<a href="#" class="nav-link"><i class="icon-folder"></i> <span><?php echo lang('item') ?></span></a>
					<ul class="nav nav-group-sub" data-submenu-title="<?php echo lang('item') ?>">
						<li class="nav-item">
							<a href="{site_url}item" class="nav-link <?php echo menu_is_active('item') ?>"><?php echo lang('item') ?></a>
						</li>
						<li class="nav-item">
							<a href="{site_url}kategori" class="nav-link <?php echo menu_is_active('kategori') ?>">
								<?php echo lang('category') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}satuan" class="nav-link <?php echo menu_is_active('satuan') ?>">
								<?php echo lang('unit') ?>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="{site_url}gudang" class="nav-link <?php echo menu_is_active('gudang') ?>">
						<i class="icon-store"></i>
						<span> <?php echo lang('warehouse') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}kontak" class="nav-link <?php echo menu_is_active('kontak') ?>">
						<i class="icon-vcard"></i>
						<span> <?php echo lang('contact') ?> </span>
					</a>
				</li>

				<?php $menu = array('user', 'user_akses', 'user_hak_akses', 'perusahaan', 'departemen', 'tahun_anggaran', 'multi_curency')?>
				<li class="nav-item nav-item-submenu <?php echo menu_is_open($menu) ?> ">
					<a href="#" class="nav-link"><i class="icon-users"></i> <span><?php echo lang('user_management') ?></span></a>
					<ul class="nav nav-group-sub" data-submenu-title="<?php echo lang('user_management') ?>">
						<li class="nav-item">
							<a href="{site_url}user" class="nav-link" <?php echo menu_is_active('user') ?> ><?php echo lang('user') ?></a>
						</li>
						<li class="nav-item">
							<a href="{site_url}perusahaan" class="nav-link" <?php echo menu_is_active('perusahaan') ?> ><?php echo lang('perusahaan') ?></a>
						</li>
						<li class="nav-item">
							<a href="{site_url}departemen" class="nav-link" <?php echo menu_is_active('departemen') ?> ><?php echo lang('departemen') ?></a>
						</li>
						<li class="nav-item">
							<a href="{site_url}tahunanggaran" class="nav-link" <?php echo menu_is_active('tahunanggaran') ?>>Tahun Anggaran</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}multi_curency" class="nav-link" <?php echo menu_is_active('multi_curency') ?>>Multi Currency</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}rekening" class="nav-link" <?php echo menu_is_active('rekening_bank') ?>>Rekening Bank</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}user_akses" class="nav-link" <?php echo menu_is_active('user_akses') ?> >Akses</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}user_hak_akses" class="nav-link" <?php echo menu_is_active('user_hak_akses') ?> >Hak Akses</a>
						</li>
					</ul>
				</li>

				<li class="nav-item-header">
					<hr>
					<div class="text-uppercase font-size-xs line-height-xs">TRANSAKSI</div>
					<i class="icon-menu" title="Data visualization"></i>
				</li>

				
				<?php $menu = array('anggaran_pendapatan', 'anggaran_belanja', 'validasi_anggaran_pendapatan', 'validasi_anggaran_belanja') ?>
				<li class="nav-item nav-item-submenu <?php echo menu_is_open($menu) ?>">
					<a href="#" class="nav-link"><i class="icon-basket"></i> <span><?php echo lang('Anggaran') ?></span></a>
					<ul class="nav nav-group-sub" data-submenu-title="<?php echo lang('anggaran') ?>">
						<li class="nav-item">
							<a href="{site_url}anggaran_pendapatan" class="nav-link <?php echo menu_is_active('anggaran_pendapatan') ?>">
								<?php echo lang('Aggaran_Pendapatan') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}anggaran_belanja" class="nav-link <?php echo menu_is_active('anggaran_belanja') ?>">
								<?php echo lang('Anggaran_Belanja') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}validasi_anggaran_pendapatan" class="nav-link <?php echo menu_is_active('validasi_anggaran_pendapatan') ?>">
								<?php echo lang('Valiadasi_Anggaran_Pendapatan') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}validasi_anggaran_belanja" class="nav-link <?php echo menu_is_active('validasi_anggaran_belanja') ?>">
								<?php echo lang('Validasi_Anggaran_Belanja') ?>
							</a>
						</li>
					</ul>
				</li>

				<?php $menu = array('pemesanan_pembelian', 'pengiriman_pembelian', 'faktur_pembelian', 'pembayaran_pembelian', 'retur_pembelian')?>
				<li class="nav-item nav-item-submenu <?php echo menu_is_open($menu) ?>">
					<a href="#" class="nav-link"><i class="icon-basket"></i> <span><?php echo lang('purchasing') ?></span></a>
					<ul class="nav nav-group-sub" data-submenu-title="<?php echo lang('purchasing') ?>">
					<li class="nav-item">
							<a href="{site_url}requiremen" class="nav-link <?php echo menu_is_active('requirement_order') ?>">
								Permintaan Pembelian
							</a>
						</li>	
					<li class="nav-item">
							<a href="{site_url}pemesanan_pembelian" class="nav-link <?php echo menu_is_active('pemesanan_pembelian') ?>">
								<?php echo lang('purchase_order') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}pengiriman_pembelian" class="nav-link <?php echo menu_is_active('pengiriman_pembelian') ?>">
								<?php echo lang('goods_receipt') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}faktur_pembelian" class="nav-link <?php echo menu_is_active('faktur_pembelian') ?>">
								<?php echo lang('invoice') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}pembayaran_pembelian" class="nav-link <?php echo menu_is_active('pembayaran_pembelian') ?>">
								<?php echo lang('payment') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}retur_pembelian" class="nav-link <?php echo menu_is_active('retur_pembelian') ?>">
								<?php echo lang('return') ?>
							</a>
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
				<li class="nav-item nav-item-submenu <?php echo menu_is_open($menu) ?>">
					<a href="#" class="nav-link"><i class="icon-cart"></i> <span><?php echo lang('selling') ?></span></a>
					<ul class="nav nav-group-sub" data-submenu-title="<?php echo lang('selling') ?>">
						<li class="nav-item">
							<a href="{site_url}pemesanan_penjualan" class="nav-link <?php echo menu_is_active('pemesanan_penjualan') ?>">
								<?php echo lang('sales_order') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}pengiriman_penjualan" class="nav-link <?php echo menu_is_active('pengiriman_penjualan') ?>">
								<?php echo lang('delivery') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}faktur_penjualan" class="nav-link <?php echo menu_is_active('faktur_penjualan') ?>">
								<?php echo lang('invoice') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}pembayaran_penjualan" class="nav-link <?php echo menu_is_active('pembayaran_penjualan') ?>">
								<?php echo lang('payment') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}retur_penjualan" class="nav-link <?php echo menu_is_active('retur_penjualan') ?>">
								<?php echo lang('return') ?>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="{site_url}memo" class="nav-link <?php echo menu_is_active('memo') ?>">
						<i class="icon-vcard"></i>
						<span> <?php echo lang('memos') ?> </span>
					</a>
				</li>

				<li class="nav-item">
					<a href="{site_url}stokopname" class="nav-link <?php echo menu_is_active('stokopname') ?>">
						<i class="icon-cabinet"></i>
						<span> <?php echo lang('Stock_Opname') ?> </span>
					</a>
				</li>

				<?php $menu = array(
    'laporan_pembelian',
    'laporan_penjualan',
    'laporan_retur_pembelian',
    'laporan_retur_penjualan',
    'laporan_stok',
    'laporan_stok_akhir_barang',
)?>
				<li class="nav-item nav-item-submenu <?php echo menu_is_open($menu) ?>">
					<a href="#" class="nav-link"><i class="icon-book"></i> <span><?php echo lang('report') ?></span></a>
					<ul class="nav nav-group-sub" data-submenu-title="<?php echo lang('report') ?>">
						<li class="nav-item">
							<a href="{site_url}laporan_pembelian" class="nav-link <?php echo menu_is_active('laporan_pembelian') ?>">
								<?php echo lang('purchasing_report') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}laporan_penjualan" class="nav-link <?php echo menu_is_active('laporan_penjualan') ?>">
								<?php echo lang('selling_report') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}laporan_retur_pembelian" class="nav-link <?php echo menu_is_active('laporan_retur_pembelian') ?>">
								<?php echo lang('Laporan Retur') ?>
							</a>
						</li>
						<li class="nav-item" hidden>
							<a href="{site_url}laporan_retur_penjualan" class="nav-link <?php echo menu_is_active('laporan_retur_penjualan') ?>">
								<?php echo lang('sales_return_report') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}laporan_stok" class="nav-link <?php echo menu_is_active('laporan_stok') ?>">
								<?php echo lang('stock_report') ?> (In/Out)
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}laporan_stok_akhir_barang" class="nav-link <?php echo menu_is_active('laporan_stok_akhir_barang') ?>">
								<?php echo lang('Lap Stok Akhir Barang') ?>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item-header">
					<hr>
					<div class="text-uppercase font-size-xs line-height-xs">AKUNTANSI</div>
					<i class="icon-menu" title="Data visualization"></i>
				</li>
				<li class="nav-item">
					<?php $url = site_url('saldo_awal')?>
					<?php $count = $this->db->count_all_results('tsaldoawal');?>
					<?php if ($count > 0): ?>
						<?php $url = site_url('saldo_awal/manage')?>
					<?php endif?>
					<a href="<?php echo $url ?>" class="nav-link <?php echo menu_is_active('saldo_awal') ?>">
						<i class="icon-gear"></i>
						<span> <?php echo lang('beginning_balance') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}noakun" class="nav-link <?php echo menu_is_active('noakun') ?>">
						<i class="icon-database"></i>
						<span> <?php echo lang('account_number') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}pengeluaran_kas" class="nav-link <?php echo menu_is_active('pengeluaran_kas') ?>">
						<i class="icon-cash"></i>
						<span> <?php echo lang('Pengeluaran Kas') ?> </span>
					</a>
				</li>
				<?php $menu = array(
    'utang',
    'piutang',
)?>
				<li class="nav-item nav-item-submenu <?php echo menu_is_open($menu) ?>">
					<a href="#" class="nav-link"><i class="icon-notebook"></i> <span><?php echo lang('Utang &amp; Piutang') ?></span></a>
					<ul class="nav nav-group-sub" data-submenu-title="<?php echo lang('Utang &amp; Piutang') ?>">
						<li class="nav-item">
							<a href="{site_url}utang" class="nav-link <?php echo menu_is_active('pemesanan_pembelian') ?>">
								<?php echo lang('Utang Usaha') ?>
							</a>
						</li>
						<li class="nav-item">
							<a href="{site_url}piutang" class="nav-link <?php echo menu_is_active('pengiriman_pembelian') ?>">
								<?php echo lang('Piutang Usaha') ?>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="{site_url}jurnal" class="nav-link <?php echo menu_is_active('jurnal') ?>">
						<i class="icon-stack"></i>
						<span> <?php echo lang('general_journal') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}buku_besar" class="nav-link <?php echo menu_is_active('buku_besar') ?>">
						<i class="icon-notebook"></i>
						<span> <?php echo lang('ledger') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}neraca_saldo" class="nav-link <?php echo menu_is_active('neraca_saldo') ?>">
						<i class="icon-cash"></i>
						<span> <?php echo lang('trial_balance') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}jurnal_penyesuaian" class="nav-link <?php echo menu_is_active('jurnal_penyesuaian') ?>">
						<i class="icon-stack"></i>
						<span> <?php echo lang('adjusting_entries') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}neraca_saldo_penyesuaian" class="nav-link <?php echo menu_is_active('neraca_saldo_penyesuaian') ?>">
						<i class="icon-cash"></i>
						<span> <?php echo lang('adjusted_trial_balance') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}laba_rugi" class="nav-link <?php echo menu_is_active('laba_rugi') ?>">
						<i class="icon-cash3"></i>
						<span> <?php echo lang('income_statement') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}perubahan_modal" class="nav-link <?php echo menu_is_active('perubahan_modal') ?>">
						<i class="icon-cash3"></i>
						<span> <?php echo lang('Statement_of_Owner_Equity') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}neraca" class="nav-link <?php echo menu_is_active('neraca') ?>"> <i class="icon-cash3"></i>
						<span> <?php echo lang('Balance_sheet') ?> </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{site_url}metaakun" class="nav-link <?php echo menu_is_active('metaakun') ?>"> <i class="icon-gear"></i>
						<span> Pemetaan Akun </span>
					</a>
				</li>
				<li class="nav-item-header" hidden>
					<hr>
					<div class="text-uppercase font-size-xs line-height-xs">OTHER</div>
					<i class="icon-menu" title="Data visualization"></i>
				</li>
				<li class="nav-item" hidden>
					<a href="{site_url}generate_crud" class="nav-link"> <i class="icon-sync"></i>
						<span> Generate CRUD </span>
					</a>
				</li>
				<!-- /main -->
			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>
<!-- /main sidebar -->