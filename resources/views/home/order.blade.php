<!DOCTYPE html>
<html>
 <head>
   <title>Invoice</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title></title>

   @include('home.css')

   <style type="text/css">
   .div_center
   {
         display: flex;
        justify-content: center;
        align-items: center;
        margin: 60px;
   }
   table
   {
      border: 2px solid black;
      text-align: center;
      width: 800px;
   }
   th
   {
   border: 2px solid skyblue;
   background-color: black;
   color: white;
   font-size: 23;
   font-weight: bold;
   text-align: center;

   }
   td
   {
   border: 2px solid skyblue;
   paddding: 10px;

   }

   </style>
 </head>
 <body>
     <div class="hero_area">
      <!-- header section strats -->
       @include('home.header')
        <div class="div_center">
         <table>
               <tr>
                 <th>Product name</th>
                   <th>Delivery Status</th>
                    <th>Image</th>
                      <th>Price</th>

               </tr>

               @foreach($order as $order)
                  <tr>
                      <td>{{$order->product->title}}</td>
                      <td>{{$order->status}}</td>
                      <td><img height="50" width="50" src="products/{{$order->product->image}}"></td>
                      <td>{{$order->product->price}}</td>
               @endforeach
               </tr>
         </table>
        </div>
     </div>

      @include('home.footer')
   </body>
</html>
