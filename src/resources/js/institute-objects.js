var CSRF = document.querySelector('input[name=_token]').value;
var objects_map = document.getElementById("objects-map");

if (typeof(objects_map) != 'undefined' && objects_map != null)
{
    const request = new XMLHttpRequest();
    const url = "/ajax/get-institute-object";
    const params = '';

    request.open("POST", url, true);

    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.setRequestHeader("X-CSRF-TOKEN", CSRF);

    request.addEventListener("readystatechange", () => {
        if(request.readyState === 4 && request.status === 200) {
            let data = JSON.parse(request.responseText),
                map_params = [];

            data.forEach(function (object, index) {
                let object_data = {
                    "type": "Feature",
                    "id": index,
                    "geometry": {
                        "type": "Point",
                        "coordinates": [
                            object.coordinates_x,
                            object.coordinates_y,
                        ]
                    },
                    "properties": {
                        "balloonText": object.text,
                        "balloonLink": "#"
                    },
                    "options": {
                        "preset": "mark#icon",
                        "hideIconOnBalloonOpen": false
                    }
                };

                map_params.push(object_data);
            });

            initMap('objects-map', map_params);

        }
    });

    request.send(params);
}


