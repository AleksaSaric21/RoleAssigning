<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="/css/app.css">
    <style>
        .router-link:hover{
            color:blue;
        }
    </style>
</head>
<body>
<div id="app">
    <div class="">
        <div>
            <router-link class="btn btn-secondary rounded-3 w-25 router-link" to="/"><a>Home</a></router-link>
            <router-link class="btn btn-secondary rounded-3 w-25 router-link"
                         to="/tasks"><a>Tasks</a></router-link>
            <router-link class="btn btn-secondary rounded-3 w-25 router-link"
                         to="/tasks/create"> <a>Task Create</a></router-link>
        </div>
        <div>
            <router-view></router-view>
        </div>

    </div>
</div>


<script src="/js/app.js"></script>
</body>


</html>
