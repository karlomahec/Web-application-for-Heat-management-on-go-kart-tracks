document.addEventListener('DOMContentLoaded', function () {
    // Function to handle input (selected option or clicked area)
    function _handleInput(value) {
      if (multiInput._allowedValues.includes(value)) {
        multiInput._addItem(value);
      }
    }

document.querySelector('input').focus();
});