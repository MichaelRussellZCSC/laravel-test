<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel POST request</title>
</head>
<body>
 
    <h1>Search</h1>

    <form action="{{ action('ApiController@handleForm') }}" method="post">
        @csrf

        <input type="text" name="search" value="">
        
        <input type="submit" value="Send to ApiController@handleForm">
 
    </form>

    <br>

    <form action="{{ action('ApiController@search_people') }}" method="get">

        <input type="text" name="search" value="">
        
        <input type="submit" value="Send to ApiController@search_people">
 
    </form>
 
</body>
</html>