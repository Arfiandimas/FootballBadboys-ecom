@extends('layout.customer')

@section('title','Detail Product - FootballBadboys')

@section('content')

    <!-- all product -->
    <section class="detail border">
        <div class="">
            <div class="row">
                <div class="col-lg-6 detail__flex">
                    <div class="product-wrap">
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                <?php foreach (json_decode($product->image)as $picture) { ?>
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/products/'.$picture) }}" id="parent__img"  class="parent__img" alt="{{ $product->name }}">
                                </div>
                                <?php } ?>
                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"></div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <?php foreach (json_decode($product->image)as $picture) { ?>
                                <div class="swiper-slide">
                                    <img class="child__img" src="{{ asset('storage/products/'.$picture) }}" alt="{{ $product->name }}">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 detail-wrap">
                    <div class="description pt-3">
                        <h5 class="nama-produk">{{ $product->name }}</h5>
                        <h5 class="harga-produk">Rp. <span class="value">
                            <?php if($product->price_discount == 0){ echo format_uang($product->price); }else{echo format_uang($product->price_discount);}?>    
                        </span></h5>
                        <span class="color">Color : 
                            @foreach($product->colors as $color)
                                {{ $color->name }},
                            @endforeach
                        </span>
                        <p>Description</p>
                        <p class="desc">
                            {!! $product->description !!}
                        </p>

                        <form action="{{ route('cart.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="size__form form-group">
                                <span class="jdl" id="results">Pilih Warna </span>
                                <hr>
                                <ul class="size__ul">
                                    <div class="size__form2" id="searchForm">
                                        @foreach($product->colors as $color)
                                        <li class="size__li">
                                            <input type="radio" id="{{ $color->id }}" name="radio" value="{{ $color->name }}">
                                            <label class="btn btn-outline-dark warna" style="background-color: {{ $color->name_html }};" for="{{ $color->name }}">
                                            </label>
                                        </li>
                                        @endforeach
                                    </div>
                                    <!-- <span id="results" class="jdl"></span> -->
                                </ul>
                                
 <script>
//  USING AJAX
function validateForm() {
  // if valid
  return true;
  // else return false
}

function performSearch() {
  const radioValue = $("input:radio[name=radio]:checked").val();
  // What you'd actually do here is an AJAX call to get the search results
  // and pass all the values defined above in the request
  $("#results").html("Pilih Warna: " + radioValue);
}

function onChange() {
  if (validateForm()) {
    performSearch();
  }
}

$(document).ready(function() {
  $("#searchForm input, #searchForm select").change(function() {
    onChange();
  });
});
</script>
                                <div class="size form-group">
                                    <span class="jdl" id="result__size">Size : </span>
                                    <hr>

                                    <ul class="size__ul ">
                                        <div class="size__form2" id="size__form">
                                            @foreach($product->sizes as $size)
                                            <li class="size__li">
                                                <input type="radio" id="{{ $size->id }}" name="size" value="{{ $size->name }}" required>
                                                <label class="btn btn-outline-info" for="{{ $size->name }}">
                                                    {{ $size->name }}
                                                </label>
                                            </li>
                                            @endforeach
                                        </div>
                                    </ul>
                                </div>
    
                                <script>
//  USING AJAX
function validateFormSize() {
  // if valid
  return true;
  // else return false
}

function performSearchSize() {
  const radioValue2 = $("input:radio[name=size]:checked").val();
  // What you'd actually do here is an AJAX call to get the search results
  // and pass all the values defined above in the request
  $("#result__size").html("Size : " + radioValue2);
}

function onChangeSize() {
  if (validateFormSize()) {
    performSearchSize();
  }
}

$(document).ready(function() {
  $("#size__form input, #size__form select").change(function() {
    onChangeSize();
  });
});
</script>

                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                    <input type="hidden" name="image" value="{{ json_decode($product->image)[0] }}">
                                    <input type="hidden" name="price" value="<?php if($product->price_discount == 0){ echo $product->price; }else{echo $product->price_discount;}?>">
        
                                    <button type="submit" class="w-100 btn btn-dark mb-5">Add To Cart</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <div class="row push-top">
                <!-- YOUTUBE -->
                <div class="col-lg-6 video__preview">
                    <iframe width="100%" height="100%" src="{{ $product->link_video }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
                <!-- END YOUTUBE -->


                <div class="col-lg-6">
                    <div class="product__desc">
                        <h5>DESKRIPSI</h5>
                        <p>
                            {!! $product->description !!}
                        </p>
                        <p>Wearable innovation from FootballBadboys.
                        </p>
                        <ul>
                            {!! $product->material !!}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row rekomendasi__anda">
                <div class="col-md-12">
                    <h5>REKOMENDASI UNTUK ANDA</h5>
                    <div class="recom">

                        @foreach ($rekomendasi as $rekom)
                            <a href="all-product.html">
                                <figure>
                                    <?php $image = json_decode($rekom->image)[0]; ?>
                                    <img src="{{ asset('storage/products/'.$image) }}" alt="{{ $rekom->name }}">
                                </figure>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>

            <!-- modal 2  -->
            {{-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img src="/scss/assets/img/wa-cart.png" width="30px" height="30px" alt="icon Whatsapp ">
                            <h5 class="modal-title ml-1" id="staticBackdropLabel">Beli Via Whatsapp</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="data-item">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Nama Item</th>
                                                    <td>Skuda T Shirt</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">Warna</th>
                                                    <td>Merah</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">Ukuran</th>
                                                    <td>S</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Jumlah</th>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <th rowspan="2" scope="row">Sub Total</th>
                                                    <td>28000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img class="gmbr-produk" width="100%" src="/scss/assets/img/produknya.svg"
                                        alt="">
                                </div>
                            </div>


                            <form>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" placeholder="Nomor WA">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <select class="custom-select custom-select-sm">
                                        <option selected>Metode Pembayaran</option>
                                        <option value="1">Transfer BCA - 012345678 a/n Adnan Aziz
                                        </option>
                                        <option value="2">Transfer BTN - 012345678 a/n Adnan Aziz
                                        </option>
                                        <option value="3">Transfer BRI - 012345678 a/n Adnan Aziz
                                        </option>
                                        <option value="4">Transfer Mandiri - 012345678 a/n Adnan Aziz
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Catatan Tambahan"
                                        aria-label="With textarea"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary w-100">Kirim</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- end modal 2 -->
        </div>
    </section>
    <!-- CART SECTION -->

<script src="/node_modules/swiper/js/swiper.js"></script>
<script src="/node_modules/swiper/js/swiper.min.js"></script>
    <script>
        var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 5,
        speed: 900,
        freeMode: false,
        loopedSlides: 1, //looped slides should be the same

    });
    var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        slidesPerView: 1,
        freeMode: false,
        speed: 1500,
        autoplay: {
            delay: 3000,
            disableOnInteraction: true,
        },
        loopedSlides: 1, //looped slides should be the same
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs,
        },
    });
    </script>

@endsection