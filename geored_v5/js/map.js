var boundingCoordinates = [
  [28.718901, -98.090003],
  [28.724558, -96.765398],
  [26.59814, -96.756306],
  [26.595767, -98.081188]
];

var map = L.map('map', {
  minZoom: 2,
  maxBounds: L.latLngBounds(boundingCoordinates),
}).setView([28.1618, -97.6014], 8);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);



// L.tileLayer('http://{s}.tile.stamen.com/terrain/{z}/{x}/{y}.png', {
//     attribution: '&copy; Stamen',
// }).addTo(map);

// L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/{layer}/{style}/MapServer/tile/{z}/{y}/{x}', {
//     attribution: '&copy; Esri',
//     layer: 'World_Street_Map',
//     style: 'MapServer'
// }).addTo(map);

// Example CartoDB tile layer
// L.tileLayer('https://{s}.basemaps.cartocdn.com/{style}/{z}/{x}/{y}.png', {
//     attribution: '© <a href="https://carto.com/attributions">CartoDB</a>',
//     style: 'dark_all', // You can choose different map styles here
// }).addTo(map);

// Initialize variables to store latitude and longitude
var latitudeInput = document.getElementById('latitude');
var longitudeInput = document.getElementById('longitude');
var countyInput = document.getElementById('county');

// Function to handle click on the map
function onMapClick(e) {
  var latlng = e.latlng;
  var lat = latlng.lat;
  var lng = latlng.lng;

  // Update latitude and longitude input fields
  latitudeInput.value = lat;
  longitudeInput.value = lng;

  // Reverse geocoding to get county information (you can use external services for more accurate results)
  reverseGeocode(lat, lng)
      .then(county => {
          countyInput.value = county;
      })
      .catch(error => {
          console.error(error);
      });
}

// Attach the click event to the map
map.on('click', onMapClick);

// Reverse geocoding function (Replace this with a proper reverse geocoding service)
function reverseGeocode(lat, lng) {
  return new Promise((resolve, reject) => {
      fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
          .then(response => response.json())
          .then(data => {
              const county = data.address.county;
              resolve(county);
          })
          .catch(error => {
              reject(error);
          });
  });
}


document.querySelector('form').addEventListener('reset', (event) => {
  window.location.reload();
});


// Add an event listener to the submit button
document.querySelector('form').addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent default form submission

  // Get the form data
  const formData = new FormData(event.target);

  

  // Send the form data to the server-side PHP file using the fetch API
  fetch('process_form.php', {
    method: 'POST',
    body: formData,
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.text(); // You can return JSON if needed, use response.json() instead
  })
  .then(data => {
    // Handle the response from the server (e.g., show a success message)
    console.log(data);
    
    event.target.reset();

    // Redirect to a success page if needed
    window.location.href = 'success_page.php';
  })
  .catch(error => {
    // Handle errors here (e.g., show an error message)
    console.error('Error:', error);
  });
});

const photoInputs = document.querySelectorAll(".photo-input");
const previewImages = document.querySelectorAll(".preview-image");
const removePhotoBtns = document.querySelectorAll(".remove-photo-btn");

for (let i = 0; i < photoInputs.length; i++) {
  photoInputs[i].addEventListener("change", () => handlePhotoUpload(i));
  removePhotoBtns[i].addEventListener("click", () => removeUploadedPhoto(i));
}

function handlePhotoUpload(index) {
  const file = photoInputs[index].files[0];
  const previewImage = previewImages[index];
  const removePhotoBtn = removePhotoBtns[index];

  if (file) {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function (e) {
      previewImage.innerHTML = `<img src="${e.target.result}" alt="Uploaded Photo">`;
      removePhotoBtn.style.display = "inline-block";
    };
  }
}

function removeUploadedPhoto(index) {
  photoInputs[index].value = "";
  previewImages[index].innerHTML = "";
  removePhotoBtns[index].style.display = "none";
}



