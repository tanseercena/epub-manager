<footer class="footer mt-auto">
	<div class="copyright bg-white">
		<p>
			&copy; <span id="copy-year">2019</span> Copyright Epub Dashboard by
			<a class="text-primary" href="http://viralwebbs.com/" target="_blank">ViralWebbs</a>.
		</p>
	</div>
	<script>
		var d = new Date();
		var year = d.getFullYear();
		document.getElementById("copy-year").innerHTML = year;
	</script>
</footer>

</div>
</div>

<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="../assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/jekyll-search.min.js"></script>



<script src="../assets/plugins/charts/Chart.min.js"></script>



<script src="../assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>



<script src="../assets/plugins/daterangepicker/moment.min.js"></script>
<script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>



<script src="../assets/plugins/toastr/toastr.min.js"></script>



<script src="../assets/js/sleek.bundle.js"></script>


<script>
	toastr.options = {
		closeButton: true,
		debug: false,
		newestOnTop: false,
		progressBar: true,
		positionClass: "toast-top-right",
		preventDuplicates: false,
		onclick: null,
		showDuration: "300",
		hideDuration: "1000",
		timeOut: "5000",
		extendedTimeOut: "1000",
		showEasing: "swing",
		hideEasing: "linear",
		showMethod: "fadeIn",
		hideMethod: "fadeOut"
	};

	<?php
	if (Session::has('errors')) {

	?>
		toastr.warning('<?php echo Session::flash('errors'); ?>', "Error!");
	<?php
	}

	if (Session::has('success')) {

	?>
		toastr.success('<?php echo Session::flash('success'); ?>', "Success!");
	<?php
	}
	?>
</script>

<script>
	/*======== 20. BAR CHART ========*/
	var barX = document.getElementById("barChart");
	if (barX !== null) {
		var myChart = new Chart(barX, {
			type: "bar",
			data: {
				labels: [
					"Jan",
					"Feb",
					"Mar",
					"Apr",
					"May",
					"Jun",
					"Jul",
					"Aug",
					"Sep",
					"Oct",
					"Nov",
					"Dec"
				],
				datasets: [{
					label: "signup",
					data: [5, 6, 4.5, 5.5, 3, 6, 4.5, 6, 8, 3, 5.5, 4],
					// data: [2, 3.2, 1.8, 2.1, 1.5, 3.5, 4, 2.3, 2.9, 4.5, 1.8, 3.4, 2.8],
					backgroundColor: "#4c84ff"
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				scales: {
					xAxes: [{
						gridLines: {
							drawBorder: false,
							display: false
						},
						ticks: {
							display: false, // hide main x-axis line
							beginAtZero: true
						},
						barPercentage: 1.8,
						categoryPercentage: 0.2
					}],
					yAxes: [{
						gridLines: {
							drawBorder: false, // hide main y-axis line
							display: false
						},
						ticks: {
							display: false,
							beginAtZero: true
						}
					}]
				},
				tooltips: {
					titleFontColor: "#888",
					bodyFontColor: "#555",
					titleFontSize: 12,
					bodyFontSize: 15,
					backgroundColor: "rgba(256,256,256,0.95)",
					displayColors: false,
					borderColor: "rgba(220, 220, 220, 0.9)",
					borderWidth: 2
				}
			}
		});
	}

	<?php

	$book_query = new Book();
	$s_date = date("Y-m-01");
	$e_date = date("Y-m-t");
	$book_query->where("publication_date", "$s_date", " >= ")->where("publication_date", "$e_date", " <= ");
	$book_query->where("status_id", 10);
	$books = $book_query->get();
	


	?>
	/*======== 1. DUAL LINE CHART ========*/
	var dual = document.getElementById("dual-line");
	if (dual !== null) {
		var urChart = new Chart(dual, {
			type: "line",
			data: {
				labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
				datasets: [{
						label: "Old",
						pointRadius: 4,
						pointBackgroundColor: "rgba(255,255,255,1)",
						pointBorderWidth: 2,
						fill: false,
						backgroundColor: "transparent",
						borderWidth: 2,
						borderColor: "#fdc506",
						data: [0, 4, 3, 5.5, 3, 4.7, 0]
					},
					{
						label: "New",
						fill: false,
						pointRadius: 4,
						pointBackgroundColor: "rgba(255,255,255,1)",
						pointBorderWidth: 2,
						backgroundColor: "transparent",
						borderWidth: 2,
						borderColor: "#4c84ff",
						data: [0, 2, 4.3, 3.8, 5.2, 1.8, 2.2]
					}
				]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				layout: {
					padding: {
						right: 10
					}
				},

				legend: {
					display: false
				},
				scales: {
					xAxes: [{
						gridLines: {
							drawBorder: false,
							display: false
						},
						ticks: {
							display: false, // hide main x-axis line
							beginAtZero: true
						},
						barPercentage: 1.8,
						categoryPercentage: 0.2
					}],
					yAxes: [{
						gridLines: {
							drawBorder: false, // hide main y-axis line
							display: false
						},
						ticks: {
							display: false,
							beginAtZero: true
						}
					}]
				},
				tooltips: {
					titleFontColor: "#888",
					bodyFontColor: "#555",
					titleFontSize: 12,
					bodyFontSize: 14,
					backgroundColor: "rgba(256,256,256,0.95)",
					displayColors: true,
					borderColor: "rgba(220, 220, 220, 0.9)",
					borderWidth: 2
				}
			}
		});
	}

	<?php

	$book_query = new Book();
	$s_date = date("Y-m-01");
	$e_date = date("Y-m-t");
	$book_query->where("publication_date", "$s_date", " >= ")->where("publication_date", "$e_date", " <= ");
	$book_query->where("status_id", 10);
	$books = $book_query->get();
	// print_r($books);
	// exit;
	?>

	/*======== 6. AREA CHART ========*/
	var area = document.getElementById("area-chart");
	if (area !== null) {
		var areaChart = new Chart(area, {
			type: "line",
			data: {
				labels: ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"],
				datasets: [{
						label: "New",
						pointHitRadius: 10,
						pointRadius: 0,
						fill: true,
						backgroundColor: "rgba(76, 132, 255, 0.9)",
						borderColor: "rgba(76, 132, 255, 0.9)",
						data: [0, 4, 2, 6.5, 3, 4.7, 0]
					},
					{
						label: "Old",
						pointHitRadius: 10,
						pointRadius: 0,
						fill: true,
						backgroundColor: "rgba(253, 197, 6, 0.9)",
						borderColor: "rgba(253, 197, 6, 1)",
						data: [0, 2, 4.3, 3.8, 5.2, 1.8, 2.2]
					}
				]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				layout: {
					padding: {
						right: 10
					}
				},
				scales: {
					xAxes: [{
						gridLines: {
							drawBorder: false,
							display: false
						},
						ticks: {
							display: false, // hide main x-axis line
							beginAtZero: true
						},
						barPercentage: 1.8,
						categoryPercentage: 0.2
					}],
					yAxes: [{
						gridLines: {
							drawBorder: false, // hide main y-axis line
							display: false
						},
						ticks: {
							display: false,
							beginAtZero: true
						}
					}]
				},
				tooltips: {
					titleFontColor: "#888",
					bodyFontColor: "#555",
					titleFontSize: 12,
					bodyFontSize: 14,
					backgroundColor: "rgba(256,256,256,0.95)",
					displayColors: true,
					borderColor: "rgba(220, 220, 220, 0.9)",
					borderWidth: 2
				}
			}
		});
	}


	/*======== 3. LINE CHART ========*/
	var ctx = document.getElementById("linechart");
	if (ctx !== null) {
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: "line",

			// The data for our dataset
			data: {
				labels: [
					"Jan",
					"Feb",
					"Mar",
					"Apr",
					"May",
					"Jun",
					"Jul",
					"Aug",
					"Sep",
					"Oct",
					"Nov",
					"Dec"
				],
				datasets: [{
					label: "",
					backgroundColor: "transparent",
					borderColor: "rgb(82, 136, 255)",
					data: [
						100,
						11000,
						10000,
						14000,
						11000,
						17000,
						14500,
						18000,
						5000,
						23000,
						14000,
						19000
					],
					lineTension: 0.3,
					pointRadius: 5,
					pointBackgroundColor: "rgba(255,255,255,1)",
					pointHoverBackgroundColor: "rgba(255,255,255,1)",
					pointBorderWidth: 2,
					pointHoverRadius: 8,
					pointHoverBorderWidth: 1
				}]
			},

			// Configuration options go here
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				layout: {
					padding: {
						right: 10
					}
				},
				scales: {
					xAxes: [{
						gridLines: {
							display: false
						}
					}],
					yAxes: [{
						gridLines: {
							display: true,
							color: "#eee",
							zeroLineColor: "#eee",
						},
						ticks: {
							callback: function(value) {
								var ranges = [{
										divider: 1e6,
										suffix: "M"
									},
									{
										divider: 1e4,
										suffix: "k"
									}
								];

								function formatNumber(n) {
									for (var i = 0; i < ranges.length; i++) {
										if (n >= ranges[i].divider) {
											return (
												(n / ranges[i].divider).toString() + ranges[i].suffix
											);
										}
									}
									return n;
								}
								return formatNumber(value);
							}
						}
					}]
				},
				tooltips: {
					callbacks: {
						title: function(tooltipItem, data) {
							return data["labels"][tooltipItem[0]["index"]];
						},
						label: function(tooltipItem, data) {
							return "$" + data["datasets"][0]["data"][tooltipItem["index"]];
						}
					},
					responsive: true,
					intersect: false,
					enabled: true,
					titleFontColor: "#888",
					bodyFontColor: "#555",
					titleFontSize: 12,
					bodyFontSize: 18,
					backgroundColor: "rgba(256,256,256,0.95)",
					xPadding: 20,
					yPadding: 10,
					displayColors: false,
					borderColor: "rgba(220, 220, 220, 0.9)",
					borderWidth: 2,
					caretSize: 10,
					caretPadding: 15
				}
			}
		});
	}

	//   search script
	function searchBook(el){
		$('#search-results').hide();
    // $("#search_processing").show();
		var query = $(el).val();

		if(query.length > 2){
			$('#search-results').show();
		
			$.ajax({
				type:'POST',
				url: '<?php echo $base_url;?>actions/book_filter.php',
				data: {"query":query},
				success: function(response){
					// $('#search_processing').hide();
					$('#search-results').html(response);
				}
			});
		}
		
	}
</script>

</body>

</html>