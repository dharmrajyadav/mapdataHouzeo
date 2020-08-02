<!DOCTYPE html>
<html lang="en">
<head>
  <title>Houzeo-Api</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <style>

        .property_type
        {
            height: 250px;
            margin: 15px;
            background-color: #9e9e9e33;
            border-radius: 10px;
        }
        .headings
        {
            text-align: center;
            font-size: xx-large;
        }
      .radio_style
      {
        border: 0px;
        width: 100%;
        height: 1.5em;
        margin-left: 45%;
      }
  </style>
</head>
<body>

<div class="container-fluid">
  
  <div class="container-fluid">
   
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 headings">What's your property address?</div>
      <div class="col-sm-3"></div>
    </div>
    <br>
    
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8" id="mapLocation" name="mapLocation" style="height: 250px;"></div>
      <div class="col-sm-2"></div>
    </div>
    <br>

    
    <div class="row">
    <div class="col-sm-1" > </div>
      <div class="col-sm-4" >
            <div class="form-group">
               <input type="text" class="form-control"  name="address" id="address" placeholder="Address" required>
                      <table name="addressUpdate" id="addressUpdate" class="addressUpdate">

                      </table>
            </div>
      </div>

      <div class="col-sm-2" >
            <div class="form-group">
           <input type="text" class="form-control"  name="city" id="city" placeholder="City" readonly>
            </div>
      </div>

      <div class="col-sm-2" >
            <div class="form-group">
           <input type="text" class="form-control"  name="state" id="state" placeholder="State" readonly>
            </div>
      </div>
      
      <div class="col-sm-2" >
            <div class="form-group">
            <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip" readonly>
            </div>
      </div>
      <div class="col-sm-1" > </div>
    </div>
    <br>
    
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 headings">And what's your property address?</div>
      <div class="col-sm-3"></div>
    </div>
    <br>


    <div class="row">
     
      <div class="col-sm-2 property_type" >
         <div><img src="images/single_family.png" alt="Girl in a jacket" ></div>
             <div class="radio">
                 <label><input type="radio" name="optradio" value="single_family" class="radio_style" checked><br>Single Family</label>
             </div>
      </div>

      <div class="col-sm-2 property_type" >
         <div><img src="images/building.png" alt="Girl in a jacket" ></div>
            <div class="radio">
               <label><input type="radio" name="optradio" value="condo/coop/town/mobile" class="radio_style" ><br>condo/coop/town/Mobile</label>
            </div>
      </div>
      <div class="col-sm-2 property_type" >
      <div><img src="images/multi_family.png" alt="Girl in a jacket" ></div>
            <div class="radio">
               <label><input type="radio" name="optradio" value="multi_family" class="radio_style">Multi-Family</label>
            </div>
      </div>
      <div class="col-sm-2 property_type" >
      <div><img src="images/building.png" alt="Girl in a jacket" ></div>
            <div class="radio">
               <label><input type="radio" name="optradio" value="land/lot" class="radio_style">Land/Lot</label>
            </div>
      </div>
      <div class="col-sm-2 property_type" >
      <div><img src="images/single_family.png" alt="Girl in a jacket" ></div>
            <div class="radio">
               <label><input type="radio" name="optradio" value="Other" class="radio_style" >Other</label>
            </div>
      </div>
     
    </div>
  </div>
</div>





  <script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false&key=AIzaSyD71a_ebz0eq1U9Vj4muX_nHZw4fegUVo4">
</script>

  <script>
$(document).ready(function () {
  var mapOptions = {
      center: new google.maps.LatLng(-34.397, 150.644),
      zoom: 8,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("mapLocation"),mapOptions);
  });




    $("#address").on("change keyup paste", function(){
          var addressData = $('#address').val();
          $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
          $.ajax({
                type:'post',
                url: 'index.php',
                dataType: "json",  
                data:{addressData:addressData},
                success:function(data) 
                  {
                     var jsonData = JSON.parse(data);
                      var dataLength =jsonData.suggestions.length;
                      var dataAppend = '';
                      for(var i = 0 ; i < dataLength ; i++)
                        {
                          dataAppend+='<tr class="rowData"><td value="'+jsonData.suggestions[i].text+'">'+jsonData.suggestions[i].text+'</td></tr>';
                        }    
                            $("#addressUpdate").html(dataAppend);

                            //$( ".rowData" ).click(function() 
                              //    {
                                //            alert("data");
                                  //       });

                   }
          });  
            });

</script>


</body>
</html>
