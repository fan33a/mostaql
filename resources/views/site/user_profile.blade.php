@extends('site.master')

@section('title')

@section('content')
    <!-- Hero Area Start-->
    <div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset('siteassets/img/hero/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>{{ Auth::user()->name }} Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Hero Area End -->
    <!-- job post company Start -->
    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h4>Notifications ({{ Auth::user()->unreadNotifications->count() }})</h4>
                    <div class="list-group">
                        @foreach (Auth::user()->notifications as $notify)
                            <a href="{{ route('site.read_notify',$notify->id) }}" class="list-group-item list-group-item-action {{ $notify->read_at ? '' : 'active' }}">
                                {{ $notify->data['msg'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job post company End -->
@stop