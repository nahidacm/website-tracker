<html>

<head></head>

<body>
    <script>
        // TASK: implement App object with methods conversion() and track() 
        var App = {
            conversionType: '',

            conversion: function(conversionType) {
                this.conversionType = conversionType; 
            },

            track: function(trackingConfigObj) {
                var trackingData = {
                    cid: trackingConfigObj.campaignId,
                    crid: trackingConfigObj.creativeId,
                    bid: trackingConfigObj.browserId,
                    did: trackingConfigObj.deviceId,
                    cip: trackingConfigObj.clientIp,
                    conv: this.conversionType
                };

                // Build URL query string
                var queryString = Object.keys(trackingData)
                    .map(function(key) {
                        return encodeURIComponent(key) + '=' + encodeURIComponent(trackingData[key]);
                    })
                    .join('&');

                // Create an image with src to the Laravel app backend
                var image = new Image();
                image.src = '<?= url("/")?>/track?' + queryString;

                // Append the image element to the DOM to load the pixel image
                document.body.appendChild(image);
            }
        };
    </script>
    <!-- do not edit below this line -->
    <script>
        App.conversion("post_impression"); // should support more potential conversion types e.g. post_impression, post_click
    </script>
    <!--
config of track (trackingConfigObj) method should be mapped to url query parameters e.g. campaignId -> cid
creativeId -> crid
browserId -> bid
deviceId -> did
clientIp -> cip
conv -> ??? (comes from App.conversion type param, where “post_impression” -> “imp”, ...)
-->
    <script>
        App.track({
            campaignId: 4235,
            creativeId: 23423,
            browserId: 5,
            deviceId: 8,
            clientIp: '78.60.201.201'
        });
    </script>
</body>

</html>