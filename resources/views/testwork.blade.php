<!DOCTYPE html>
<html>
<head>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test work with websockets and google map markers</title>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN-xb5f1m1Lc2bRRoNgAp5UkkY-sdmeoU&callback=initMap"></script>
</head>
<body>
    <form id="add-marker-form" action="/add-new-marker">
        <label>Широта <input name="lat" type="number" min="-90" max="90" step="0.0000001"  required></label>
        <label>Довгота <input name="lng" type="number" min="-180" max="180" step="0.0000001"  required></label>
        <input type="submit" name="Додати Позначку">
    </form>
    <div id="map" style="margin-top: 30px;height: 514px;width: 514px;"></div>
    <script type="text/javascript">
        var oldMarkers = {!! json_encode($markers) !!};
    </script>
    @vite('resources/js/app.js')
</body>
</html>