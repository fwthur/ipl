<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View AR {{ $wisata->name }}</title>
    <script src="https://aframe.io/releases/1.6.0/aframe.min.js"></script>
</head>
<body>
    <a-scene>
        <a-assets>
            <img id="wisata" src="{{ asset('images/'. $wisata->image) }}">
        </a-assets>
        <a-sky  src="#wisata" rotation="0 -130 0" radius="10"></a-sky>

        <a-text font="kelsonsans" value="Baturraden" width="6" position="-2.5 0.25 -1.5"
                rotation="0 15 0"></a-text>
    </a-scene>
</body>
</html>
