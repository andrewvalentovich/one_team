@extends('project.includes.layouts')

<?php $title = 'Oneteam / ' . __('О проекте') ?>
@section('header')
    @include('project.includes.header')
@endsection

<style>
    /*.popular-locations__item:nth-last-child(-n+6){*/
    /*    display: block !important;*/
    /*}*/
    .popular-locations__item{
        align-items: center;
    }

</style>

@section('content')
    <div class="maxContainer police">
        <?php echo json_decode($get->privice_content )  ?>
    </div>

@endsection


@section('footer')
    @include('project.includes.footer')
@endsection


@section('scripts')
    <script src="{{asset('project/js/app.js')}} "></script>
@endsection
