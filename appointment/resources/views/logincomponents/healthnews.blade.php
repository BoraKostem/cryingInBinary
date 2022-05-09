<style>
    .card{
        background-color: #dfedd6;
        width: 65%;
        height: 50%;
        margin: 0 auto
    }
    .btn-custom, .btn-custom:hover, .btn-custom:active, .btn-custom:visited {
        background-color: #003366 !important;
        color: #fff;
    }

    #innerbox{
        height: 83%;
        display: inline-block;
    }
</style>


<!--
<div class="jumbotron">
    <div class="container" id="innerbox">
        php
            //$healthText = DB::table('data')->where('dataType', 'healthNews')->value('value'); 
        endphp
        <h3 class="display-5 mt-3">Health Center News!</h3>
        <p class="lead" style="white-space: pre-line"></p>
    </div>
    <div class="me-4">
        <p class="lead text-end">
            <a class="btn btn-custom btn-md" href="https://www.who.int/emergencies/diseases/novel-coronavirus-2019" role="button">Learn more</a>
        </p>
    </div>
  </div>

-->

<div class="container">   
   <div class="card">
       <div class="card-header">
           <h4 class="card-title">Health Center News</h4>
       </div>
       <div class="card-body">
           @php
            $healthText = DB::table('data')->where('dataType', 'healthNews')->value('value');
            $lastEdited = DB::table('data')->where('dataType', 'healthNews')->value('lastEdited');         
           @endphp
         <p class="lead" style="white-space: pre-line"> {{$healthText}} </p>
         <div class="text-center">
            <a class="btn btn-custom btn-md" href="https://www.who.int/emergencies/diseases/novel-coronavirus-2019" role="button">Learn more</a>
         </div>
       </div>
       <div class="card-footer text-muted d-flex">
            {{$lastEdited}}
       </div>
     </div>
</div> 
