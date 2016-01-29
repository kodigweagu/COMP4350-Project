@extends('layout')

@section('custom_css')
    <style>
        body
        {
            background-image: url(" {{ asset('img/stardust.png') }}");
        }

         /*Color list background and text*/
        .list-group-item{background-color: #dddddd;}
        .list-group-item .items{color: #000000;}

    </style>
@stop

@section('header_links')
    {{--insert name of link--}}
    <?php $nav_link = "clientlist";?>
    @include('inc.navigation_link')
@stop

@section('content')

    <div class="list-group col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">

        <?php
            //populate
            foreach($clients as $patient)
            {
               echo '<a href="#" class="list-group-item"><h4 class="items">'.$patient["name"].'</h4><span class="left items">ID#: '.$patient["id"].'</span></a>';
            }

        ?>

    </div>
@stop