const axios = require('axios'); // Assuming you're using axios for HTTP requests

test('Test if if /track with correct parameters was called', async () => {
  const expectedParameter = 'example'; // The parameter you're expecting

  var trackingData = {
    cid: 4235,
    crid: 23423,
    bid: 5,
    did: 8,
    cip: '78.60.201.201',
    conv: 'post_impression'
};

  // Build URL query string
  var queryString = Object.keys(trackingData)
  .map(function(key) {
      return encodeURIComponent(key) + '=' + encodeURIComponent(trackingData[key]);
  })
  .join('&');

  // Make the request to the Laravel route
  const response = await axios.get(`http://localhost/track?${queryString}`);

  // Confirms that, we received an GIF image in response
  expect(response.data).toMatch(/GIF/);
});
