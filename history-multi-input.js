class MultiInput extends HTMLElement {
    constructor() {
      super();
      this.innerHTML +=
      `<style>
      multi-input input::-webkit-calendar-picker-indicator {
        display: none;
      }
      multi-input div.item::after {
        color: black;
        content: '×';
        cursor: pointer;
        font-size: 18px;
        pointer-events: auto;
        position: absolute;
        right: 5px;
        top: -1px;
      }
  
      </style>`;
      this._shadowRoot = this.attachShadow({mode: 'open'});
      this._shadowRoot.innerHTML =
      `<style>
      :host {
        display: block;
        overflow: hidden;
      }
      /* NB use of pointer-events to only allow events from the × icon */
      ::slotted(div.item) {
        background-color: var(--multi-input-item-bg-color, #dedede);
        border-radius: 2px;
        color: #222;
        display: inline-block;
        font-size: var(--multi-input-item-font-size, 14px);
        margin: 5px;
        padding: 2px 25px 2px 5px;
        pointer-events: none;
        position: relative;
        top: -1px;
      }
      /* NB pointer-events: none above */
      ::slotted(div.item:hover) {
        background-color: #eee;
        color: black;
      }
      ::slotted(input) {
        border: none;
        font-size: var(--multi-input-input-font-size, 14px);
        outline: none;
        padding: 10px 10px 10px 5px; 
      }
      </style>
      <slot></slot>`;
  
      this._datalist = this.querySelector('datalist');
      this._resList = this.querySelector('datalist');

      this._allowedValues = [];
      
      for (const option of this._datalist.options) {
        this._allowedValues.push(option.value);
      }

      for (const option1 of this._resList.options) {
        this._allowedValues.push(option1.value);
      }
      this._input = this.querySelector('input');
      this._input.onblur = this._handleBlur.bind(this);
      this._input.oninput = this._handleInput.bind(this);
      this._input.onkeydown = (event) => {
        this._handleKeydown(event);
      };
  
      this._allowDuplicates = this.hasAttribute('allow-duplicates');
    }
  
    _addItem(value) {
        this._input.value = '';
        const item = document.createElement('div');
        item.classList.add('item');
        item.textContent = value;
        this.insertBefore(item, this._input);
        item.onclick = () => {
          this._deleteItem(item);
        };
    
        if (!this._allowDuplicates) {
          for (const option of this._datalist.options) {
            if (option.value === value) {
              option.remove();
            };
          }
          this._allowedValues =
          this._allowedValues.filter((item) => item !== value);
        }
      }
    
      _deleteItem(item) {
        const value = item.textContent;
        item.remove();
        if (!this._allowDuplicates) {
          const option = document.createElement('option');
          option.value = value;
          // Insert as first option seems reasonable...
          this._datalist.insertBefore(option, this._datalist.firstChild);
          this._allowedValues.push(value);
        }
      }

    _handleBlur() {
      this._input.value = '';
    }
  

    _handleInput() {
      const value = this._input.value;
      if (this._allowedValues.includes(value)) {
        this._addItem(value);
      }
    }

  
    _handleKeydown(event) {
      const itemToDelete = event.target.previousElementSibling;
      const value = this._input.value;
      if (value ==='' && event.key === 'Backspace' && itemToDelete) {
        this._deleteItem(itemToDelete);
      } else if (this._allowedValues.includes(value)) {
        this._addItem(value);
      }
    }
  
    getValues() {
      const values = [];
      const items = this.querySelectorAll('.item');
      for (const item of items) {
        values.push(item.textContent);
      }
      return values;
    }
  }
  
  window.customElements.define('multi-input', MultiInput);