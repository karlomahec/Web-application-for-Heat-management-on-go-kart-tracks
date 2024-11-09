document.addEventListener('DOMContentLoaded', function () {
    // Function to handle input (selected option or clicked area)
    function _handleInput(value) {
      if (multiInput._allowedValues.includes(value)) {
        multiInput._addItem(value);
      }
    }
  
    // Function to handle click on map areas
    function handleMapAreaClick(areaValue) {
      _handleInput(areaValue);
    }
  
    // Add click event listeners to each map area
    const mapAreas = document.querySelectorAll('area');
    mapAreas.forEach(area => {
      area.addEventListener('click', function () {
        handleMapAreaClick(this.title);
      });
    });

document.querySelector('input').focus();
});