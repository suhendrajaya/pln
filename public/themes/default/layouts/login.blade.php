
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{!! Theme::getTitle() !!}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="{!! Theme::get('keywords') !!}">
        <meta name="description" content="{!! Theme::getDescription() !!}">
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {!! Theme::getMeta() !!}


        {!! Theme::asset()->styles() !!}

        {!! Theme::asset()->scripts() !!}

    </head>
    <body class="login">

        {!! Theme::content() !!}


        {!! Theme::asset()->container('footer')->scripts() !!}

    </body>
</html>
