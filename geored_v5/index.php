<!DOCTYPE html>
<html>
<head>
  <title>Flooding Event Reporting Form</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>

  <div class="header">
    <h1>Flooding Event Reporting Form</h1>
  </div>
  <form action="process_form.php" method="POST" enctype="multipart/form-data">
  </div>
  <form action="process_form.php" method="POST" enctype="multipart/form-data">
    <div class="container">

      <section class="form-section">
        <div class="form-container">
        <div class="mandatory-container">
          <div class="mandatory-text"><small><small>Fields marked with <span class="mandatory-symbol">*</span> are mandatory</small></small></div>
        </div>
      
          <h2>Contact Information</h2>
          <div class="form-group">
            <label for="firstName">First Name<span class="mandatory-symbol">*</span></label>
            <input type="text" id="firstName" name="firstName" pattern="[A-Za-z\s]+" oninvalid="this.setCustomValidity(this.value === '' ? 'Please enter your First Name' : 'Please enter valid alphabetic characters for First Name.')" oninput="this.setCustomValidity('')" required>
          </div>
          <div class="form-group">
            <label for="lastName">Last Name<span class="mandatory-symbol">*</span></label>
            <input type="text" id="lastName" name="lastName" pattern="[A-Za-z\s]+" oninvalid="this.setCustomValidity(this.value === '' ? 'Please enter your Last Name' :'Please enter valid alphabetic characters for Last Name.')" oninput="this.setCustomValidity('')" required>
          </div>
          <div class="form-group">
            <label for="email">Email<span class="mandatory-symbol">*</span></label>
            <input type="email" id="email" name="email" oninvalid="this.setCustomValidity(this.value === '' ? 'Please enter your Email' :'Please enter valid email address.')" oninput="this.setCustomValidity('')" required>
          </div>
        </div>
      </section>

      <section class="middle-section">        
        <div id="map" class="left-div">
          <!-- <p>Click on the map to add latitude and longitude</p> -->
        </div>
        <div class="right-div">
          <h2>Location Details</h2>
          <p class="map-instructions-2"><small><small><small>Please zoom in to the flooding location on the map and click on it to add latitude and longitude below.</small></small></small></p>
          <div class="form-group">
            <label for="latitude">Latitude<span class="mandatory-symbol">*</span></label>
            <input type="text" id="latitude" name="latitude" pattern="-?\d+(\.\d+)?" oninvalid="this.setCustomValidity(this.value === '' ? 'Please enter Latitude.' : 'Please enter a valid numeric value for latitude')" oninput="this.setCustomValidity('')" required>
          </div>
          <div class="form-group">
            <label for="longitude">Longitude<span class="mandatory-symbol">*</span></label>
            <input type="text" id="longitude" name="longitude" pattern="-?\d+(\.\d+)?" oninvalid="this.setCustomValidity(this.value === '' ? 'Please enter Longitude.' : 'Please enter a valid numeric value for longitude')" oninput="this.setCustomValidity('')" required>
          </div>
          <div class="form-group">
            <label for="county">County<span class="mandatory-symbol">*</span></label>
            <input type="text" id="county" name="county" pattern="[\p{L}\s]+" oninvalid="this.setCustomValidity(this.value === '' ? 'Please enter County' :'Please enter valid alphabetic characters for County.')" oninput="this.setCustomValidity('')" required>
          </div>
        </div>
      </section>

      <section class="bottom-section">
        <div class="form-container">
          <h2>Flood Event Details</h2>
          <p class="map-instructions"><small><small><small>Please provide the date of flooding, approximate depth of flooding, and location of flooding.</small></small></small></p>
          <div class="container-2-holder">
              <div class="container-2">
              <div class="form-group">
            <label for="dateFound">Date of Flooding<span class="mandatory-symbol">*</span></label>
            <input type="date" id="dateFound" name="dateFound" max="<?php echo date('Y-m-d'); ?>" required
                oninvalid="this.setCustomValidity(this.validity.valueMissing ? 'Please select a date.' : 'Please select a date up to today or previous dates only.')"
                oninput="this.setCustomValidity('')">
            </div>

            <div class="form-group">
                <label for="floodDepth">Approximate Flood Depth (in feet)<span class="mandatory-symbol">*</span></label>
                <input type="text" id="floodDepth1" name="floodDepth" pattern="\d+(\.\d+)?" oninvalid="this.setCustomValidity(this.value === '' ? 'Please enter approximate flood occurrence depth (in ft).' : 'Please enter a valid positive value for depth (in ft).')" oninput="this.setCustomValidity('')" required>
            </div>

            <div class="custom-radio-group">
                <label>Flooded Location<span class="mandatory-symbol">*</span></label>
                <div class="radio-option">
                    <input type="radio" id="house" name="floodType" value="House" required>
                    <label for="house">House</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="yard" name="floodType" value="Yard" required>
                    <label for="yard">Yard</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="street" name="floodType" value="Street" required>
                    <label for="street">Street</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="intersection" name="floodType" value="Intersection" required>
                    <label for="intersection">Intersection</label>
                </div>
            </div>
            </div>
          </div>
          
          <div class="container-2">
          <div class="form-group">
              <label for="photo">Please upload photos relevant to this flooding event:</label>
              <div class="file-upload-container">
                  <input type="file" class="photo-input" name="photos[]" accept="image/*">
                  <div class="preview-image"></div>
              </div>
              <button type="button" class="remove-photo-btn" style="display:none;padding:1%;">Remove Photo</button>
          </div>

          <div class="form-group">
              <div class="file-upload-container">
                  <input type="file" class="photo-input" name="photos[]" accept="image/*">
                  <div class="preview-image"></div>
              </div>
              <button type="button" class="remove-photo-btn" style="display:none;padding:1%;">Remove Photo</button>
          </div>

          <div class="form-group">
              <div class="file-upload-container">
                  <input type="file" class="photo-input" name="photos[]" accept="image/*">
                  <div class="preview-image"></div>
              </div>
              <button type="button" class="remove-photo-btn" style="display:none;padding:1%;">Remove Photo</button>
          </div>
      </div>


          <div class="form-group">
            <label for="notes">Please provide any additional information relevant to this flooding event:</label>
            <textarea id="notes" name="notes" rows="4"></textarea>
            <p class="map-instructions"><small><small><small>For example, this flooding occurred due to heavy rainfall that lasted for two days. It flooded my backyard on the second day of this event. The water level reached up to 2 feet in my backyard. The photo here shows my backyard from my back porch, which shows how much water was built up in our backyards.</small></small></small></p>
          </div>
          <div class="form-group">
            <button type="submit" style ="text-align:center;">Submit</button>
            <button type="reset" style ="text-align:center;">Clear</button>
          </div>
        </div>
      </section>
    </div>
  </form>
  <script src="js/map.js"></script>

  <div class="footer">
    <img src="images/Logoharte.png" alt="Footer Logo">
  </div>
</body>
</html>
