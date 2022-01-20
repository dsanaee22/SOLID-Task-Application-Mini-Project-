@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-md-9">

                <!-- Display Validation Errors -->
                @include('common.status')
                <div id="content">
                    @php
                        $time = now()->diffForHumans(now()->endOfDay(), ['parts' => 2, 'join' => false, 'short' => true]);
                    @endphp
                    <h4>
                        You have {!! $time !!} the end of the day
                    </h4>
                    <br>

                    <div class="tabs">
                        <ul id="tabs-nav">
                            <li><a href="#all">All</a></li>
                            <li><a href="#done">Do</a></li>
                            <li><a href="#doing">Doing</a></li>
                            <li><a href="#failed">Failed</a></li>
                            <li><a href="#skipped">Skipped</a></li>
                            <li><a href="#not_started">Not Started</a></li>
                        </ul>
                        <div id="tabs-content">
                            @widget('\TaskApp\Widgets\TaskList', ['state' => null, 'tab' => 'all', 'title' => 'All Tasks', 'status' => 'show active'])
                            @widget('\TaskApp\Widgets\TaskList', ['state' => '5', 'tab' => 'not_started', 'title' =>
                            'Not
                            Started'])
                            @widget('\TaskApp\Widgets\TaskList', ['state' => '1', 'tab' => 'done', 'title' => 'Done'])
                            @widget('\TaskApp\Widgets\TaskList', ['state' => '2', 'tab' => 'doing', 'title' =>
                            'Doing...'])
                            @widget('\TaskApp\Widgets\TaskList', ['state' => '3', 'tab' => 'failed', 'title' =>
                            'Failed'])
                            @widget('\TaskApp\Widgets\TaskList', ['state' => '4', 'tab' => 'skipped', 'title' =>
                            'Skipped'])
                        </div>
                    </div>

                    <script>
                        // Show the first tab and hide the rest
                        $('#tabs-nav li:first-child').addClass('active');
                        $('.tab-content').hide();
                        $('.tab-content:first').show();

                        // Click function
                        $('#tabs-nav li').click(function () {
                            $('#tabs-nav li').removeClass('active');
                            $(this).addClass('active');
                            $('.tab-content').hide();

                            var activeTab = $(this).find('a').attr('href');
                            $(activeTab).show();
                            return false;
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    /* Tabs */
    .tabs {
        background-color: #09F;
        border-radius: 5px 5px 5px 5px;
    }

    ul#tabs-nav {
        list-style: none;
        margin: 0;
        padding: 5px;
        overflow: auto;
    }

    ul#tabs-nav li {
        float: left;
        font-weight: bold;
        margin-right: 2px;
        padding: 8px 10px;
        border-radius: 5px 5px 5px 5px;
        /*border: 1px solid #d5d5de;
        border-bottom: none;*/
        cursor: pointer;
    }

    ul#tabs-nav li:hover,
    ul#tabs-nav li.active {
        background-color: #08E;
    }

    #tabs-nav li a {
        text-decoration: none;
        color: #FFF;
    }

    .tab-content {
        padding: 10px;
        border: 5px solid #09F;
        background-color: #FFF;
    }

    /* Just for CodePen styling - don't include if you copy paste */
    html {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
        font-weight: 300;
        margin: 2em;
    }
</style>

