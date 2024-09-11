<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<head>
@include('home.css')

<style type="text/css">

.div_center
{
display: flex;
justify-content: center;
align-items: center;
margin: 30px;
}
.detail-box
{
padding: 15px;
}
</style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
 @include('home.header')
    <!-- end header section -->

  </div>


  <!-- Product details start -->

<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">



        <div class="col-md-12">
          <div class="box">

              <div class="div_center" >
                <img width 400 src="/products/{{$data->image}}" alt="">
              </div>

              <div class="detail-box">
              <h6>{{ $data->title }}</h6>
              <h6>
                  Price
                  <span>сом{{$data->price}}</span>
                </h6>
              </div>

              <div class="detail-box">
              <h6>Category : {{ $data->category }}</h6>
              <h6>
                  Available Quantity
                  <span>сом{{$data->quantity}}</span>
                </h6>
              </div>

                <div class="detail-box">
                   <p>{{ $data->description }}</p>
                </div>


               <div class="detail-box">
                <a class="btn btn-primary" href="{{url('add_cart', $data->id)}}">Add to Cart</a>

               </div>

           </div>

        </div>



    </div>
    </div>
  </section>




  <!-- product_details end-->

<!-- info info_section-->

  @include('home.footer')

</body>

</html>
