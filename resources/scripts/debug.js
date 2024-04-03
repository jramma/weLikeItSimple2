export default class Debug {
  constructor() {
    this.debugSection = document.querySelector('#debug-dev');
    this.debugGrid = document.querySelector('#debug-grid');

    if (!this.debugSection) {
      console.error('[debug.js] Debug Section not found');
      return;
    }
    if (!this.debugGrid) {
      console.error('[debug.js] Debug Grid not found');
      return;
    }

    this.debugScreen = this.debugSection.querySelector('#debug-screen');
    this.debugScreen.classList.add('cursor-pointer');

    this.gridLocalValue = 'mrtnsn--debug-tools';
    if (!localStorage.getItem(this.gridLocalValue) || localStorage.getItem(this.gridLocalValue) === "on") {
      this.EnableGrid();
    } else {
      this.DisableGrid();
    }
    this.addListener();
  }

  addListener() {
    this.debugScreen.addEventListener('click', () => {
      this.ToggleGrid();
    });
  }

  toggleGrid() {
    this.debugGrid.querySelector('button').click();
  }

  ToggleGrid() {
    let isGrid = localStorage.getItem(this.gridLocalValue);
    if (isGrid === null || isGrid === "off") {
      this.EnableGrid();
    } else {
      this.DisableGrid();
    }
  }
  EnableGrid() {
    localStorage.setItem(this.gridLocalValue, "on");
    this.debugGrid.classList.remove("hidden");
    this.debugScreen.classList.remove('opacity-20');
  }
  DisableGrid() {
    localStorage.setItem(this.gridLocalValue, "off");
    this.debugGrid.classList.add("hidden");
    this.debugScreen.classList.add('opacity-20');
  }
};

