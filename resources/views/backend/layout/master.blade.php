<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('backend/assets/images/favicon-32x32.png')}}" type="image/png" />
	<!--plugins-->
	<link href="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('backend/assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('backend/assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('backend/assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset('backend/assets/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{asset('backend/assets/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{asset('backend/assets/css/header-colors.css')}}" />
	<title>Rukada - Responsive Bootstrap 5 Admin Template</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		@include('backend.layout.body.sidebar')
		<!--end sidebar wrapper -->
		<!--start header -->
		@include('backend.layout.body.navbar')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				@yield('content')
				{{-- <div class="page-content">
					<div class="card radius-10">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="mb-0">Orders Summary</h5>
								</div>
								<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
								</div>
							</div>
							<hr>
							<div class="table-responsive">
								<table class="table align-middle mb-0">
									<thead class="table-light">
										<tr>
											<th>Order id</th>
											<th>Product</th>
											<th>Customer</th>
											<th>Date</th>
											<th>Price</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>#897656</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="recent-product-img">
														<img src="assets/images/icons/chair.png" alt="">
													</div>
													<div class="ms-2">
														<h6 class="mb-1 font-14">Light Blue Chair</h6>
													</div>
												</div>
											</td>
											<td>Brooklyn Zeo</td>
											<td>12 Jul 2020</td>
											<td>$64.00</td>
											<td>
												<div class="badge rounded-pill bg-light-info text-info w-100">In
													Progress</div>
											</td>
											<td>
												<div class="d-flex order-actions"> <a href="javascript:;" class=""><i
															class="bx bx-cog"></i></a>
													<a href="javascript:;" class="ms-4"><i
															class="bx bx-down-arrow-alt"></i></a>
												</div>
											</td>
										</tr>
										<tr>
											<td>#987549</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="recent-product-img">
														<img src="assets/images/icons/shoes.png" alt="">
													</div>
													<div class="ms-2">
														<h6 class="mb-1 font-14">Green Sport Shoes</h6>
													</div>
												</div>
											</td>
											<td>Martin Hughes</td>
											<td>14 Jul 2020</td>
											<td>$45.00</td>
											<td>
												<div class="badge rounded-pill bg-light-success text-success w-100">
													Completed</div>
											</td>
											<td>
												<div class="d-flex order-actions"> <a href="javascript:;" class=""><i
															class="bx bx-cog"></i></a>
													<a href="javascript:;" class="ms-4"><i
															class="bx bx-down-arrow-alt"></i></a>
												</div>
											</td>
										</tr>
										<tr>
											<td>#685749</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="recent-product-img">
														<img src="assets/images/icons/headphones.png" alt="">
													</div>
													<div class="ms-2">
														<h6 class="mb-1 font-14">Red Headphone 07</h6>
													</div>
												</div>
											</td>
											<td>Shoan Stephen</td>
											<td>15 Jul 2020</td>
											<td>$67.00</td>
											<td>
												<div class="badge rounded-pill bg-light-danger text-danger w-100">
													Cancelled</div>
											</td>
											<td>
												<div class="d-flex order-actions"> <a href="javascript:;" class=""><i
															class="bx bx-cog"></i></a>
													<a href="javascript:;" class="ms-4"><i
															class="bx bx-down-arrow-alt"></i></a>
												</div>
											</td>
										</tr>
										<tr>
											<td>#887459</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="recent-product-img">
														<img src="assets/images/icons/idea.png" alt="">
													</div>
													<div class="ms-2">
														<h6 class="mb-1 font-14">Mini Laptop Device</h6>
													</div>
												</div>
											</td>
											<td>Alister Campel</td>
											<td>18 Jul 2020</td>
											<td>$87.00</td>
											<td>
												<div class="badge rounded-pill bg-light-success text-success w-100">
													Completed</div>
											</td>
											<td>
												<div class="d-flex order-actions"> <a href="javascript:;" class=""><i
															class="bx bx-cog"></i></a>
													<a href="javascript:;" class="ms-4"><i
															class="bx bx-down-arrow-alt"></i></a>
												</div>
											</td>
										</tr>
										<tr>
											<td>#335428</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="recent-product-img">
														<img src="assets/images/icons/user-interface.png" alt="">
													</div>
													<div class="ms-2">
														<h6 class="mb-1 font-14">Purple Mobile Phone</h6>
													</div>
												</div>
											</td>
											<td>Keate Medona</td>
											<td>20 Jul 2020</td>
											<td>$75.00</td>
											<td>
												<div class="badge rounded-pill bg-light-info text-info w-100">In
													Progress</div>
											</td>
											<td>
												<div class="d-flex order-actions"> <a href="javascript:;" class=""><i
															class="bx bx-cog"></i></a>
													<a href="javascript:;" class="ms-4"><i
															class="bx bx-down-arrow-alt"></i></a>
												</div>
											</td>
										</tr>
										<tr>
											<td>#224578</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="recent-product-img">
														<img src="assets/images/icons/watch.png" alt="">
													</div>
													<div class="ms-2">
														<h6 class="mb-1 font-14">Smart Hand Watch</h6>
													</div>
												</div>
											</td>
											<td>Winslet Maya</td>
											<td>22 Jul 2020</td>
											<td>$80.00</td>
											<td>
												<div class="badge rounded-pill bg-light-danger text-danger w-100">
													Cancelled</div>
											</td>
											<td>
												<div class="d-flex order-actions"> <a href="javascript:;" class=""><i
															class="bx bx-cog"></i></a>
													<a href="javascript:;" class="ms-4"><i
															class="bx bx-down-arrow-alt"></i></a>
												</div>
											</td>
										</tr>
										<tr>
											<td>#447896</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="recent-product-img">
														<img src="assets/images/icons/tshirt.png" alt="">
													</div>
													<div class="ms-2">
														<h6 class="mb-1 font-14">T-Shirt Blue</h6>
													</div>
												</div>
											</td>
											<td>Emy Jackson</td>
											<td>28 Jul 2020</td>
											<td>$96.00</td>
											<td>
												<div class="badge rounded-pill bg-light-success text-success w-100">
													Completed</div>
											</td>
											<td>
												<div class="d-flex order-actions"> <a href="javascript:;" class=""><i
															class="bx bx-cog"></i></a>
													<a href="javascript:;" class="ms-4"><i
															class="bx bx-down-arrow-alt"></i></a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div> --}}
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
				class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		@include('backend.layout.body.footer')
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr />
			<h6 class="mb-0">Theme Styles</h6>
			<hr />
			<div class="d-flex align-items-center justify-content-between">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
					<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
					<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
					<label class="form-check-label" for="semidark">Semi Dark</label>
				</div>
			</div>
			<hr />
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr />
			<h6 class="mb-0">Header Colors</h6>
			<hr />
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator headercolor1" id="headercolor1"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor2" id="headercolor2"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor3" id="headercolor3"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor4" id="headercolor4"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor5" id="headercolor5"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor6" id="headercolor6"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor7" id="headercolor7"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor8" id="headercolor8"></div>
					</div>
				</div>
			</div>

			<hr />
			<h6 class="mb-0">Sidebar Backgrounds</h6>
			<hr />
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/chartjs/js/Chart.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/jquery-knob/excanvas.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
	<script>
		$(function() {
			  $(".knob").knob();
		  });
	</script>
	<script src="{{asset('backend/assets/js/index.js')}}"></script>
	<!--app JS-->
	<script src="{{asset('backend/assets/js/app.js')}}"></script>
</body>

</html>