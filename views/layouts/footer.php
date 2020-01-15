<footer class="footer mt-auto">
	<div class="copyright bg-white">
		<p>
			&copy; <span id="copy-year"><?php echo date("Y"); ?></span> Copyright Epub Tracker by
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
<script src="../assets/plugins/jquery.lazy.min.js"></script>


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
		toastr.error('<?php echo Session::flash('errors'); ?>', "Error!");
	<?php
	}

	if (Session::has('success')) {

	?>
		toastr.success('<?php echo Session::flash('success'); ?>', "Success!");
	<?php
	}
	?>
</script>

<?php
	$page = basename($_SERVER['PHP_SELF']);
	if($page == "dashboard.php"){
		$book = new Book();

		$uk_all_records = $book->getAllCurrentBooks('uk');
		$uk_completed_records = $book->getAllCompletedBooks('uk');
		$total_uk = $book->countTotal($uk_all_records);

		$usa_all_records = $book->getAllCurrentBooks('usa');
		$usa_completed_records = $book->getAllCompletedBooks('usa');
		$total_usa = $book->countTotal($usa_all_records);

		$uae_all_records = $book->getAllCurrentBooks('uae');
		$uae_completed_records = $book->getAllCompletedBooks('uae');
		$total_uae = $book->countTotal($uae_all_records);
	}
?>

<script>
	/*======== 20. BAR CHART ========*/
	var barX = document.getElementById("barChart");
	if (barX !== null) {

	var config = {
		type: 'line',
		data: {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun'],
			datasets: [{
				label: 'Not Done',
				backgroundColor: "rgba(255,255,255,1)",
				borderColor: "rgb(255, 99, 132)",
				data: [
					<?php
					foreach($uk_all_records as $key => $uk_all_rec){
						echo $uk_all_rec['total'] > 0 ? ($uk_all_rec['total'] - $uk_completed_records[$key]['total'])."," : "0,";
					}
					?>
				],
				fill: false,
			}, {
				label: 'Done',
				fill: false,
				backgroundColor: "rgba(255,255,255,1)",
				borderColor: "rgb(75, 192, 192)",
				pointRadius: 4,
				pointBorderWidth: 2,
				fill: false,
				borderWidth: 2,
				data: [
					<?php
					foreach($uk_completed_records as $uk_com_rec){
						echo $uk_com_rec['total'] > 0 ? $uk_com_rec['total']."," : "0,";
					}
					?>
				],
			}]
		},
		options: {
			responsive: true,
			title: {
				display: false,
				text: 'Chart.js Line Chart'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			legend: {
				display: false
			},
			scales: {
				xAxes: [{
					display: false,
					scaleLabel: {
						display: true,
						labelString: 'Month'
					}
				}],
				yAxes: [{
					display: false,
					scaleLabel: {
						display: false,
						labelString: 'Value'
					},
					ticks: {
						min: 0,
						max: <?php echo ($total_uk) ? $total_uk : 0; ?>,

						// forces step size to be 5 units
						stepSize: 1
					}
				}]
			}
		}
	};
		var ukChart = new Chart(barX, config);
	}

	/*======== 1. DUAL LINE CHART ========*/
	var dual = document.getElementById("dual-line");
	if (dual !== null) {
		var urChart = new Chart(dual, {
			type: "line",
			data: {
				labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
				datasets: [{
						label: "Not Done",
						pointRadius: 4,
						pointBackgroundColor: "rgba(255,255,255,1)",
						pointBorderWidth: 2,
						fill: false,
						backgroundColor: "transparent",
						borderWidth: 2,
						borderColor: "#fdc506",
						data: [
							<?php
							foreach($usa_all_records as $key => $usa_all_rec){
								echo $usa_all_rec['total'] > 0 ? ($usa_all_rec['total'] - $usa_completed_records[$key]['total'])."," : "0,";
							}
							?>
						]
					},
					{
						label: "Done",
						fill: false,
						pointRadius: 4,
						pointBackgroundColor: "rgba(255,255,255,1)",
						pointBorderWidth: 2,
						backgroundColor: "transparent",
						borderWidth: 2,
						borderColor: "#4c84ff",
						data: [
							<?php
							foreach($usa_completed_records as $usa_com_rec){
								echo $usa_com_rec['total'] > 0 ? $usa_com_rec['total']."," : "0,";
							}
							?>
						]
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
							beginAtZero: true,
							min: 0,
							max: <?php echo ($total_usa) ? $total_usa : 0; ?>,
							stepSize: 1
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


	/*======== 6. AREA CHART ========*/
	var area = document.getElementById("area-chart");
	if (area !== null) {
		var areaChart = new Chart(area, {
			type: "line",
			data: {
				labels: ["Mon", "Tue", "Wed", "Thu","Fri", "Sat", "Sun"],
				datasets: [{
						label: "Not Done",
						pointHitRadius: 10,
						pointRadius: 0,
						fill: true,
						backgroundColor: "rgba(253, 197, 6, 0.9)",
						borderColor: "rgba(253, 197, 6, 1)",
						data: [
							<?php
							foreach($uae_all_records as $key => $uae_all_rec){
								echo $uae_all_rec['total'] > 0 ? ($uae_all_rec['total'] - $uae_completed_records[$key]['total'])."," : "0,";
							}
							?>
						]
					},
					{
						label: "Done",
						pointHitRadius: 10,
						pointRadius: 0,
						fill: true,
						backgroundColor: "rgba(76, 132, 255, 0.9)",
						borderColor: "rgba(76, 132, 255, 0.9)",
						data: [
							<?php
							foreach($uae_completed_records as $uae_com_rec){
								echo $uae_com_rec['total'] > 0 ? $uae_com_rec['total']."," : "0,";
							}
							?>
						]
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
							beginAtZero: true,
							min: 0,
							max: <?php echo ($total_uae) ? $total_uae : 0; ?>,
							stepSize: 1
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


	var line = document.getElementById("line");
	if (line !== null) {
		line = line.getContext("2d");
		var gradientFill = line.createLinearGradient(0, 120, 0, 0);
		gradientFill.addColorStop(0, "rgba(41,204,151,0.10196)");
		gradientFill.addColorStop(1, "rgba(41,204,151,0.30196)");

		var lChart = new Chart(line, {
			type: "line",
			data: {
				labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
				datasets: [
					{
						label: "Book",
						lineTension: 0,
						pointRadius: 4,
						pointBackgroundColor: "rgba(255,255,255,1)",
						pointBorderWidth: 2,
						fill: true,
						backgroundColor: gradientFill,
						borderColor: "#29cc97",
						borderWidth: 2,
						data: [
							<?php
								foreach($uk_all_records as $key => $uk_all_rec){
									echo $uk_all_rec['total']+$usa_all_records[$key]['total']+$uae_all_records[$key]['total'].",";
								}
							?>
						]
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
					xAxes: [
						{
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
						}
					],
					yAxes: [
						{
							gridLines: {
								drawBorder: false, // hide main y-axis line
								display: false
							},
							ticks: {
								display: false,
								beginAtZero: true
							}
						}
					]
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

	$(document).click(function (e)
	{
	    var container = $("#search-results");

	    if (!container.is(e.target) || !container.child().is(e.target))
	    {
	        $('#search-results').hide();
	    }
	});

	$(function() {
        $('.lazy').Lazy();
    });
</script>

</body>

</html>
