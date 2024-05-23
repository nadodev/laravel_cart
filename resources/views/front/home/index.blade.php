@extends('front.master')



@section('content')
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <li data-filter=".oranges">Oranges</li>
                        <li data-filter=".fresh-meat">Fresh Meat</li>
                        <li data-filter=".vegetables">Vegetables</li>
                        <li data-filter=".fastfood">Fastfood</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">

            @if(isset($products) && $products->count())
            @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('storage/'. $product->thumbnail) }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li>
                                <a onclick="event.preventDefault();Cart.add('{{  $product->slug }}');" href="#">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a></h6>
                        <h5>${{ $product->price }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p>Nenhum produto cadastrado</p>
            @endif


        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    class Cart {
        static add = (slug) => {

            let formData = new FormData();
            let token = $("meta[name='_token'").attr('content')
            formData.append('slug', slug);
            formData.append('_token', token);

           $.ajax({
            url: "{{ route('add_to_cart') }}",
            data: formData,
            type: "POST",
            dataType: "json",
            contentType: false,
            processData: false,
            success: (response ) => {
                console.log(response)
            }
           })
        }
    }
</script>
@endsection
