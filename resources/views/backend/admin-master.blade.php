<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">

		<title>Sunny Admin - Dashboard</title>

		<!-- Vendors Style-->
		<link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

		<!-- Style-->
		<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">

		{{-- ajax jquery--}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

		{{-- toastr --}}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

		<link rel="stylesheet" href="{{ asset('../assets/vendor_components/sweetalert2/sweetalert2.css') }}">


	</head>


	<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

		<div class="wrapper">
			{{-- header --}}
			@include('backend.includes.header')
			{{-- end header --}}

			{{-- sidebar --}}
			@include('backend.includes.sidebar')
			{{-- end sidebar --}}

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				@yield('content')
			</div>

			{{-- sidebar --}}
			@include('backend.includes.footer')
			{{-- end sidebar --}}
		</div>
		<!-- ./wrapper -->


		<!-- Vendor JS -->
		<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
		<script src="{{ asset('../assets/icons/feather-icons/feather.min.js') }}"></script>
		<script src="{{ asset('../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
		<script src="{{ asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
		<script src="{{ asset('../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>

		<!-- Sunny Admin App -->
		<script src="{{ asset('backend/js/template.js') }}"></script>
		<script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>

		<script src="{{ asset('../assets/vendor_components/datatable/datatables.min.js') }}"></script>
		<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>

		{{-- tags input --}}
		<script src="{{ asset('../assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>


		{{-- cek editor --}}
		<script src="{{ asset('../assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
		<script src=" {{ asset('../assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
		<script src="{{ asset('backend/js/pages/editor.js') }}"></script>

		{{-- toastr --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<script>
			@if(Session::has('message'))
			var type = "{{ Session::get('alert-type', 'info') }}"
			switch(type) {
				case 'info' :
					toastr.info("{{ Session::get('message') }}");
					break;

					case 'success' :
					toastr.info("{{ Session::get('message') }}");
					break;

					case 'warning' :
					toastr.info("{{ Session::get('message') }}");
					break;

					case 'error' :
					toastr.info("{{ Session::get('message') }}");
					break;
			}
			@endif
		</script>

		{{-- pemberuithguan hapus --}}
		<script src="{{ asset('../assets/vendor_components/sweetalert2/sweetalert2.all.min.js') }}"></script>
		<script>
			$(function() {
				$(document).on('click', '#delete', function(e){
					e.preventDefault();
					var link = $(this).attr("href");

					Swal.fire({
						title: 'Apakah Anda Yakin ?',
						text: "Data Yang Di Hapus Tidak Bisa Kembali",
						icon: 'warning',
						showCancelButton: true,
						confirmButtomColor: '#3085d6',
						cancelButtomColor: '#d33',
						confirmButtomText: 'Ya, Hapus Saja',
						cancelButtomText: 'Batal',
					}).then((result) => {
						if (result.isConfirmed){
							window.location.href = link
							Swal.fire(
								'Deleted!',
								'Data Berhasil Dihapus.',
								'success'
							)
						}
					});
				});
			});
		</script>
		<script>
			$(function() {
				$(document).on('click', '#deleteCategory', function(e){
					e.preventDefault();
					var link = $(this).attr("href");
					Swal.fire({
						title: 'Apakah Anda Yakin ?',
						text: "Data Yang Di Hapus Tidak Bisa Kembali",
						icon: 'warning',
						showCancelButton: true,
						confirmButtomColor: '#3085d6',
						cancelButtomColor: '#d33',
						confirmButtomText: 'Ya, Hapus Saja',
						cancelButtomText: 'Batal',
					}).then((result) => {
						if (result.isConfirmed){
							window.location.href = link
							Swal.fire(
								'Deleted!',
								'Data Berhasil Dihapus.',
								'success'
							)
						}
					});
				});
			});
		</script>
	</body>
</html>
