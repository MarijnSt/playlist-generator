<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title inertia>{{ config('app.name') }}</title>
    @routes
    @vite('resources/ts/app.ts')
    @inertiaHead
</head>
<body>
@inertia
</body>
</html>
