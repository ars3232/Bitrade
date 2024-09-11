<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<head>
@include('home.css')

<style type="text/css">
.div_deg
{
display: flex;
justify-content: center;
align-items: center;
margin: 60px;

}
table
{
border:2px solid black;
text-align: center;
width: 150px;
}

th
{
border:2px solid black;
text-align: center;
color: #2916F5;
font: 20 px;
font-weght: bold;
background-color:#DAEE01;
}

td
{
border: 1px solid skyblue;
}
.cart_value
{
text-align: center;
margin-bottom: 70px;
padding: 18px;
}

.order_deg
{
padding-right: 100px;
margin-top: 150px;

}

.div_gap
{
padding: 20px;
}

label
{
     display:inline-block
    width: 150px;
    font-weight: bold;
}


}
</style>
</head>

<body>

<div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->
</div>

<div class="div_deg">



    <table>
        <tr>
            <th>Product Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th >Remove</th>
        </tr>

        <?php $totalValue = 0; ?>

        @foreach($cart as $cart)
        <tr>
            <td>{{ $cart->product->title }}</td>
            <td>сом{{ $cart->product->price }}</td>
            <td><img width="50" src="/products/{{ $cart->product->image }}"></td>
            <td>{{ $cart->quantity }}</td>
            <td>сом{{ $cart->total_price }}</td>
            <td><a class="btn btn-danger" href="{{url('delete_cart' ,$cart->id) }}" >Remove</a ></td>
        </tr>

        <?php $totalValue += $cart->total_price; ?>
        @endforeach
    </table>
</div>

<div class="cart_value">
    <h3>Total Value of Cart is: ${{ $totalValue }}</h3>
</div>

<div class="order_deg" style="display: flex; justify-content: center; align-items: center;">
     <form action="{{url('confirm_order')}}" method="Post">
     @csrf
        <div class="div_gap">
         <label>Receiver Name</label>
         <input type="text" name="name" value="{{Auth::user()->name}}">
        </div>
           <div class="div_gap" >
               <label>Receiver Address</label>
               <textarea name="address">{{Auth::user()->address}}</textarea>
           </div>
             <div class="div_gap">
               <label>Receiver Phone</label>
               <input type="text" name="phone" value="{{Auth::user()->phone}}" >
             </div>
             <div class="div_gap">
              <label>Receiver email</label>
               <input type="text" name="email" value="{{Auth::user()->email}}" >
             </div>

                <div class="div_gap">

                <input class="btn btn-primary" type="submit" value="Cash On Delivery">
                <a class="btn btn-success" href="{{url('stripe',  $totalValue)}}">Pay Using Card</a>
                </div


     </form>
</div>

<!-- info section -->
@include('home.footer')

</body>

</html>

