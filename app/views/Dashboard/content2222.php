<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-info22 mr-2"></i> <span class="font-weight-semibold">{title}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Laba Rugi <?php echo date('Y') ?></h5>
				</div>
				<div class="card-body">
					<div class="chart" id="chart-laba-rugi" style="height:500px;"></div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Biaya <?php echo date('Y') ?></h5>
				</div>
				<div class="card-body">
					<div class="chart" id="chart-biaya" style="height:500px;"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Produk Laris Bulan Ini</h5>
				</div>
				<div class="card-body">
					<div class="chart" id="produkLaris" style="height:500px;"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Utang & Piutang Bulang Ini</h5>
				</div>
				<div class="card-body">
					<div class="chart" id="utangPiutang" style="height:500px;"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Kas</h5>
				</div>
				<div class="card-body">
					<div class="chart" id="kas" style="height:500px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<script>
	am4core.ready(function() {

	// Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end

	// Create chart instance
	var chart = am4core.create("chart-biaya", am4charts.XYChart);
	chart.scrollbarX = new am4core.Scrollbar();

	// Add data
	chart.dataSource.url = "{site_url}dashboard/getChartExpense";

	// Create axes
	var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
	categoryAxis.dataFields.category = "namaakun";
	categoryAxis.renderer.grid.template.location = 0;
	categoryAxis.renderer.minGridDistance = 30;
	categoryAxis.renderer.labels.template.horizontalCenter = "right";
	categoryAxis.renderer.labels.template.verticalCenter = "middle";
	categoryAxis.renderer.labels.template.rotation = 270;
	categoryAxis.tooltip.disabled = true;
	categoryAxis.renderer.minHeight = 110;

	var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
	valueAxis.renderer.minWidth = 50;

	// Create series
	var series = chart.series.push(new am4charts.ColumnSeries());
	series.sequencedInterpolation = true;
	series.dataFields.valueY = "total";
	series.dataFields.categoryX = "namaakun";
	series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
	series.columns.template.strokeWidth = 0;

	series.tooltip.pointerOrientation = "vertical";

	series.columns.template.column.cornerRadiusTopLeft = 10;
	series.columns.template.column.cornerRadiusTopRight = 10;
	series.columns.template.column.fillOpacity = 0.8;

	// on hover, make corner radiuses bigger
	var hoverState = series.columns.template.column.states.create("hover");
	hoverState.properties.cornerRadiusTopLeft = 0;
	hoverState.properties.cornerRadiusTopRight = 0;
	hoverState.properties.fillOpacity = 1;

	series.columns.template.adapter.add("fill", function(fill, target) {
	  // return chart.colors.getIndex(target.dataItem.index);
		return am4core.color('#ff3e4c');
	});

	// Cursor
	chart.cursor = new am4charts.XYCursor();

	}); // end am4core.ready()
</script>


<script type="text/javascript">
	am4core.ready(function() {

		// Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end

		// Create chart instance
		var chart = am4core.create("chart-laba-rugi", am4charts.XYChart3D);

		// Add data
		chart.dataSource.url = "{site_url}dashboard/getChartLabaRugi";
		chart.dataSource.parser = new am4core.JSONParser();

		// Create axes
		let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "bulan";
		categoryAxis.renderer.labels.template.rotation = 270;
		categoryAxis.renderer.labels.template.hideOversized = false;
		categoryAxis.renderer.minGridDistance = 20;
		categoryAxis.renderer.labels.template.horizontalCenter = "right";
		categoryAxis.renderer.labels.template.verticalCenter = "middle";
		categoryAxis.tooltip.label.rotation = 270;
		categoryAxis.tooltip.label.horizontalCenter = "right";
		categoryAxis.tooltip.label.verticalCenter = "middle";

		let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.title.text = "Countries";
		valueAxis.title.fontWeight = "bold";

		// Create series
		var series = chart.series.push(new am4charts.ColumnSeries3D());
		series.dataFields.valueY = "total";
		series.dataFields.categoryX = "bulan";
		series.name = "Visits";
		series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
		series.columns.template.fillOpacity = .8;

		var columnTemplate = series.columns.template;
		columnTemplate.strokeWidth = 2;
		columnTemplate.strokeOpacity = 1;
		columnTemplate.stroke = am4core.color("#FFFFFF");

		columnTemplate.adapter.add("fill", function(fill, target) {
			if (target.dataItem && (target.dataItem.valueY == 0)) {
			return am4core.color('#ffffff');
			} else if (target.dataItem && (target.dataItem.valueY < 0)) {
			return am4core.color('#ff3e4c');
			} else {
			return am4core.color('#84b761');
			}
		});

		chart.cursor = new am4charts.XYCursor();
		chart.cursor.lineX.strokeOpacity = 0;
		chart.cursor.lineY.strokeOpacity = 0;

	});
</script>

<script>
	am4core.ready(function() {

		// Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end

		// Create chart instance
		var chart = am4core.create("produkLaris", am4charts.PieChart);

		chart.dataSource.url = "{site_url}dashboard/getChartProdukLaris";

		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "item";
		pieSeries.innerRadius = am4core.percent(50);
		pieSeries.ticks.template.disabled = true;
		pieSeries.labels.template.disabled = true;

		var rgm = new am4core.RadialGradientModifier();
		rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
		pieSeries.slices.template.fillModifier = rgm;
		pieSeries.slices.template.strokeModifier = rgm;
		pieSeries.slices.template.strokeOpacity = 0.4;
		pieSeries.slices.template.strokeWidth = 0;

		chart.legend = new am4charts.Legend();
		chart.legend.position = "bottom";

		pieSeries.colors.list = [
			new am4core.color('#F44336'),
			new am4core.color('#8E24AA'),
			new am4core.color('#388E3C'),
			new am4core.color('#FBC02D'),
			new am4core.color('#0288D1'),
			new am4core.color('#060811'),
			new am4core.color('#920891'),
			new am4core.color('#B2F8F1'),
			new am4core.color('#02F8F1'),
			new am4core.color('#044336'),
		];


	}); // end am4core.ready()
</script>

<script>
	am4core.ready(function() {

		// Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end

		// Create chart instance
		var chart = am4core.create("utangPiutang", am4charts.PieChart);

		chart.dataSource.url = "{site_url}dashboard/getChartUtangPiutang";

		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "tipe";
		pieSeries.innerRadius = am4core.percent(50);
		pieSeries.ticks.template.disabled = true;
		pieSeries.labels.template.disabled = true;

		var rgm = new am4core.RadialGradientModifier();
		rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
		pieSeries.slices.template.fillModifier = rgm;
		pieSeries.slices.template.strokeModifier = rgm;
		pieSeries.slices.template.strokeOpacity = 0.4;
		pieSeries.slices.template.strokeWidth = 0;

		chart.legend = new am4charts.Legend();
		chart.legend.position = "bottom";


		pieSeries.colors.list = [
			new am4core.color('#388E3C'),
			new am4core.color('#FBC02D'),
		];


	}); // end am4core.ready()
</script>

<script>
	am4core.ready(function() {

		// Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end

		// Create chart instance
		var chart = am4core.create("kas", am4charts.PieChart);

		chart.dataSource.url = "{site_url}dashboard/getChartKas";

		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "namaakun";
		pieSeries.innerRadius = am4core.percent(50);
		pieSeries.ticks.template.disabled = true;
		pieSeries.labels.template.disabled = true;

		var rgm = new am4core.RadialGradientModifier();
		rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
		pieSeries.slices.template.fillModifier = rgm;
		pieSeries.slices.template.strokeModifier = rgm;
		pieSeries.slices.template.strokeOpacity = 0.4;
		pieSeries.slices.template.strokeWidth = 0;

		chart.legend = new am4charts.Legend();
		chart.legend.position = "bottom";


		pieSeries.colors.list = [
			new am4core.color('#0288D1'),
			new am4core.color('#8E24AA'),
			new am4core.color('#F44336'),
			new am4core.color('#060811'),
			new am4core.color('#388E3C'),
			new am4core.color('#FBC02D'),
			new am4core.color('#920891'),
			new am4core.color('#B2F8F1'),
			new am4core.color('#02F8F1'),
			new am4core.color('#044336'),
		];


	}); // end am4core.ready()
</script>