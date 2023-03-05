<!DOCTYPE html>
<html lang="en">
    @php
        $seo = App\Models\Seo::find(1);
        $site = App\Models\SiteSetting::find(1);
    @endphp
<head>
<!-- Meta -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="{{$seo->meta_description}}">
<meta name="author" content="{{$seo->meta_author}}">
<meta name="keywords" content="{{$seo->meta_keyword}}">
<meta name="robots" content="all">
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<title>{{$site->company_name}}</title>
<link rel="icon" href="{{ url($site->icon) }}">
<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awe') }}some.css">

{{-- toast menampilkan edit foto --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">


<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

{{-- jquery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{-- stripe --}}
<script src="https://js.stripe.com/v3/"></script>

{{-- google analyst --}}
<script>{{$seo->google_analytics}}</script>



</head>
<body class="cnt-home">

{{-- header --}}
@include('frontend.templates.header')

{{--main content  --}}
@yield('content')

{{-- footer --}}
@include('frontend.templates.footer')

<!-- Button trigger modal -->


  <!-- Modal produk-->
  <div class="modal product-modal fade" id="product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><span id="pname"></span></h4>
          <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
                <div class="card" >
                    <img src="" id="pimage" alt="product-image" class="card-img-top" style="width: 200px; width: 200px;">
                </div>
            </div>

            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        Kode Produk: <strong><span id="pcode" style=""></span></strong>
                    </li>
                    <li class="list-group-item">
                        Kategori: <strong><span id="pcategory" style=""></span></strong>
                    </li>
                    <li class="list-group-item">
                        Merek: <strong><span id="pbrand" style=""></span></strong>
                    </li>
                    <li class="list-group-item">
                        Stok: <span class="badge badge-pill badge-success" id="aviable"
                        style="background: green; color: white;"></span>
                             <span class="badge badge-pill badge-danger" id="stockout"
                        style="background: red; color: white;"></span>
                    </li>
                    <li>
                        <div class="row" style="padding-right: 15px; margin-top: 20px;">
                        <span style="text-decoration: line-through; float: right; color: #b1b1b1; font-size: 13px; margin-bottom: 2px;">
                        <del id="oldprice">Rp</del>
                        </span>
                        </div>
                        <ul class="" style="margin-bottom: 15px;">
                        <li class="">
                            Harga: <strong style="float: right; font-size:16px;">Rp<span id="pprice"></span></strong>
                        </li>
                        </ul>
                    </li>
                </ul>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="color">Pilih Warna</label>
                    <select name="color" id="color" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group" id="sizeArea">
                    <label for="size">Pilih Ukuran</label>
                    <select name="size" id="size" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="qty">Atur Jumlah</label>
                    <input type="number" class="form-control" id="qty" value="1" min="1">
                </div>
                <input type="hidden" name="" id="product_id">
                <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Keranjang</button>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>


<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>

{{-- script toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- notifikasi berhasil edit  --}}
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch(type) {
        case 'info' :
            toastr.info("{{ Session::get('message') }}");
            break;

            case 'success' :
            toastr.success("{{ Session::get('message') }}");
            break;

            case 'warning' :
            toastr.warning("{{ Session::get('message') }}");
            break;

            case 'error' :
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>

{{-- script edit foto berubah --}}
<script>
    $(document).ready(function (){
        $('#profileImage').change(function (e){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    function numberformat(x){
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // menampilkan data produk di modal
    function productView(id){
        // alert(id)
        $.ajax({
            type: 'GET',
            url: '/product/view/modal/' + id,
            dataType: 'json',
            success: function(data){
                $('#pname').text(data.product.product_name);
                $('#pprice').text(data.product.product_price);
                $('#pcode').text(data.product.product_code);
                $('#pcategory').text(data.product.category.category_name);
                $('#pbrand').text(data.product.brand.brand_name);
                $('#pimage').attr('src', '/' + data.product.product_thumbnail);
                $('#qty').val(1);
                $('#product_id').val(id);

                // productprice
                // jika product proce sama dengn null atw tdk ada
                if(data.product.product_discount == null) {
                    // tampilkan data produk price
                    $('#pprice').text('');
                    $('#oldprice').text('');
                    $('#pprice').text(data.product.product_price);
                }else{
                    // jika produk diskon ada tampilkan ini
                    $('#pprice').text(data.product.product_discount);
                    $('#oldprice').text(data.product.product_price);
                }

                // stok option
                if(data.product.product_qty > 0){
                    $('#aviable').text('');
                    $('#stockout').text('');
                    $('#aviable').text('Tersedia');
                }else{
                    $('#aviable').text('');
                    $('#stockout').text('');
                    $('#aviable').text('Tidak Tersedia');
                }

                // size
                $('select[name="size"]').empty();
                $.each(data.size, function(key, value){
                    $('select[name="size"]').append('<option value=" ' + value + ' ">' + value + '</option>')
                })

                // color
                $('select[name="color"]').empty();
                $.each(data.color, function(key, value){
                    $('select[name="color"]').append('<option value=" '+ value +'">' + value + '</option>')
                    if(data.color == ""){
                        $('#colorArea').hide();
                    }else{
                        $('#colorArea').show();
                    }
                })
            }
        })
    }

// menambhakn data produk ke keranjang
function addToCart(){
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#color option:selected').text();
        var size = $('#size option:selected').text();
        var quantity = $('#qty').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                color: color,
                size: size,
                quantity: quantity,
                product_name: product_name
            },
            url: '/cart/data/store/' + id,
            success: function(data){
                //console.log(data)
                miniCart();
                $('#closeModal').click();

                //notification
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })

                if ($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
            }
        })
    }
</script>

<script>
    function numberformat(x){
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function miniCart(){
        $.ajax({
            type: 'GET',
            url: '/product/mini/cart',
            dataType: 'json',
            success: function (response){
                $('span[id="cartSubtotal"]').text(numberformat(response.cartSubtotal));
                $('#cartQty').text(response.cartQty);
                var miniCart = ""

                $.each(response.carts, function(key, value){
                    miniCart += `<div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="image">
                                                <a href="detail.html">
                                                    <img src="/${value.options.image}" alt="">
                                                </a>
                                                </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <h3 class="name">
                                            {{-- <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> --}}
                                            ${value.name}
                                            </a>
                                            </h3>
                                            <div class="price">
                                            <span>${value.qty} x </span>
                                            <span>Rp ${numberformat(value.price)}</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-1 action">
                                         <button type="submit" id="${value.rowId}"
                                         onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i>
                                         </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>`
                });

                $('#miniCart').html(miniCart);
            }
        })
    }

    // memanggil function minicart agar data keranjangdapat ditampilkan
    miniCart();


    //function hapus produk diminicart
    function miniCartRemove(rowId){
        $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/' + rowId,
            dataType: 'json',
            success: function(data){
                miniCart();

                //notif
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
            }
        });
    }

</script>

<script type="text/javascript">
    function numberformat(x){
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function cart(){
        $.ajax({
            type: 'GET',
            url: 'get-cart-product',
            dataType: 'json',
            success: function(response){

                var rows = ""
                $.each(response.carts, function(key, value){
                    rows += `<tr>
                                    <td class="col-md-3">
                                        <img src="/${value.options.image}" alt="img" style="width: 80px; height: 80px;">
                                    </td>
                                    <td class="col-md-3">
                                        <div class="product-name">
                                            <h5><a href="">${value.name}</a></h5>
                                        </div>
                                        <h5><strong>${value.options.color == null ? `<span>....</span>` : `<strong>${value.options.color} </strong>`} - ${value.options.size}</strong></h5>
                                        <div class="price"><h5>Rp${numberformat(value.price)}</h5></div>
                                    </td>

                                    <td class="col-md-3" style="padding: 0 1px">
                                    {{-- jika qty bernilai lebih dr 1 hilangkan atribut disable, jika bernilai 1 maka disablekan button kuang --}}

                                      ${value.qty > 1 ?
                                            `<button type="submit" class="btn btn-danger btn-md"
                                        id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>` :
                                        `<button type="submit" class="btn btn-danger btn-md" disabled>-</button>` }
                                        <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width: 25px;">
                                        <button type="submit" class="btn btn-success btn-md" id="${value.rowId}" onclick="cartIncrement(this.id)">+</button>
                                    </td>

                                    <td class="col-md-2">Rp${numberformat(value.subtotal)} </td>

                                    <td class="col-md-1 close-btn">
                                        <button type="submit" title="hapus" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>`
                });
                $('#cartPage').html(rows);
            }
        })
    }

    // panggil function cart yg telah dibuat
    cart();


    //function hapus produk halaman my cart
    function cartRemove(rowId){
        $.ajax({
            type: 'GET',
            url: 'user/cart-remove/' + rowId,
            dataType: 'json',
            success: function(data){
                miniCart();
                cart();
                couponCalculation();

                //notif
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
            }
        });
    }

    //cart increment
    function cartIncrement(rowId){
        $.ajax({
            type: 'GET',
            url: 'user/cart-increment/' + rowId,
            dataType: 'json',
            success: function(data){
                cart();
                miniCart();
                couponCalculation();
            }
        });
    }

    //cart decrement
    function cartDecrement(rowId){
        $.ajax({
            type: 'GET',
            url: 'user/cart-decrement/' + rowId,
            dataType: 'json',
            success: function(data){
                cart();
                miniCart();
                couponCalculation();
            }
        });
    }

</script>


<script type="text/javascript">
    function applyCoupon(){
        // variabel copon name menampung data kupon yg di inputkn olek user
        var coupon_name = $('#coupon_name').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                coupon_name: coupon_name
            },
            url: "{{ url('/user/coupon-apply') }}",
            success: function(data){
                couponCalculation();
               if(data.validity == true){
                    $('#couponField').hide();
                }

                //notif
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
            }
        })
    }

    function couponCalculation(){
        $.ajax({
            type: 'GET',
            url: "{{ url('/user/coupon-calculation') }}",
            dataType: 'json',
            success:function(data){
                if(data.total){
                    $('#couponCalField').html(
                        `<tr>
                                    <th>
                                        <div class="cart-sub-total">
                                            SubTotal <span class="inner-left-md" style="padding-left: 80px;">Rp${numberformat(data.total) }</span>
                                        </div>
                                        <div class="cart-grand-total">
                                            Total Bayar <span class="inner-left-md">Rp${ numberformat(data.total) }</span>
                                        </div>
                                    </th>
                                </tr>`
                    )
                }else{
                    $('#couponCalField').html(
                        `<tr>
                                    <th>
                                        <div class="cart-sub-total">
                                            SubTotal <span class="inner-left-md" style="padding-left: 80px;">Rp${numberformat(data.subtotal)}</span>
                                        </div>
                                        <div class="cart-sub-total" >
                                            Kupon <span class="inner-left-md" style="margin-left: 40px;">${data.coupon_name}</span>
                                            <button type="submit" onclick="couponRemove()" <i class="fa fa-times"></i> </button>
                                        </div>
                                        <div class="cart-sub-total" style="color: green;">
                                            Diskon <span class="" style="padding-left: 95px;">Rp${numberformat(data.discount_amount)}</span>
                                        </div>
                                        <div class="cart-grand-total" style="color: green;">
                                            Total Bayar <span class="inner-left-md" style="padding-left: 65px;">Rp${numberformat(data.total_amount)}</span>
                                        </div>
                                    </th>
                                </tr>`
                    )
                }
            }
        });
    }

    // punggil functionnya
    couponCalculation();


    // hapus kupon
    function couponRemove(){
        $.ajax({
            type: 'GET',
            url: "{{ url('/user/coupon-remove') }}",
            dataType: 'json',
            success: function(data){
                couponCalculation();
                $('#couponField').show();
                $('#coupon_name').val('');

                //notif
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }

            }
        });
    }

</script>


{{-- wishlist --}}
<script type="text/javascript">
    function numberformat(x){
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function addToWishList(product_id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "add-to-wishlist/" + product_id,
            success: function(data){

                //notif
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
            }
        })
    }

    //functon untuk menampilkan data produk di wishlist
    function wishlist(){
        $.ajax({
            type: 'GET',
            url: '/user/get-wishlist-product',
            dataType: 'json',
            success: function(response){
                var rows = ""

                $.each(response, function(key, value){
                    rows += `<tr>
                                        <td class="col-md-2"><img src="/${value.product.product_thumbnail}" alt="img"></td>
                                        <td class="col-md-7">
                                            <div class="product-name">
                                                <a href="">${value.product.product_name}
                                                </a>
                                            </div>
                                            <div class="price">
                                            ${value.product.product_discount == null ?
                                            `Rp${numberformat(value.product.product_price)}`:
                                            `Rp${numberformat(value.product.product_discount)}
                                            <span>Rp${numberformat(value.product.product_price)}</span>`
                                            }
                                            </div>
                                        </td>
                                        <td class="col-md-2">
                                            <button data-toggle="modal" data-target="#product-modal" class="btn btn-primary icon" title="Keranjang" type="button" id="${value.product_id}" onclick="productView(this.id)">Keranjang</button>
                                        </td>
                                        <td class="col-md-1 close-btn">
                                         <button type="submit" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>`
                });
                $('#wishlist').html(rows);
            }
        })
    }

    // panggil functionnya
    wishlist();

    function wishlistRemove(id){
        $.ajax({
            type: 'GET',
            url: '/user/wishlist-remove/' + id,
            dataType: 'json',
            success: function(data){
                wishlist();

                //notif
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
            }
        });
    }
</script>


</body>
</html>
