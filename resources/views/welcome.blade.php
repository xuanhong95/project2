@extends('layouts.app')
<link rel="stylesheet" href="css/homepage.css">

@section('content')
<div class="container" style="margin-top:70px">
    <div class="row">
        <div class="col-md-12">
            <!--Ads-->
            <div id="slider" class="panel panel-default col-md-12">
                <div id="ads">
                    <div id="adsleft">
                        <section class="slider " >
                            <div class="flexslider">
                                <ul class="slides">
                                    <li>
                                        <img src="images/abc.jpg" />
                                    </li>
                                    <li>
                                        <img src="images/def.jpg" />
                                    </li>
                                    <li>
                                        <img src="images/abc.jpg" />
                                    </li>
                                    <li>
                                        <img src="images/def.jpg" />
                                    </li>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!--End Ads-->

            <div class="content" style="margin-top:20px; z-index: 5;">
                <div class="col-md-8" style="height:500px; padding:0px 0px; background: white;position: static;"></div>
                <div class="col-md-4" style="height:500px; padding:0px 0px; background: gray;position: static;"></div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="flexslider.css" type="text/css" media="screen" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script defer src="jquery.flexslider.js"></script>

<script type="text/javascript">
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
      }
  });
  });
</script>
@endsection
