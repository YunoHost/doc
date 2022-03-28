/**
 * Get Reveal-element computed width
 */
function getRevealWidth() {
  var revealElement = document.querySelector('.reveal');
  var computedStyles = window.getComputedStyle(revealElement);
  var revealWidth = computedStyles.getPropertyValue('width').replace('px', '');
  return revealWidth;
}

/**
 * Get fitting font size from given width
 * @param {int} width Element width
 */
function getFontSize(width) {
  var match = getClosest(width, Object.keys(presentationBreakpoints));
  return presentationBreakpoints[match];
}

/**
 * Set base font size
 * @param {HTMLCollection} element Applicable slide
 * @param {int} width Reveal-element width
 */
function applyBaseSize(element, width) {
  var fontSize = getFontSize(parseInt(width));
  if (element.dataset.textsizeModifier) {
    var fontSize = fontSize * parseFloat(element.dataset.textsizeModifier);
  }
  element.style.fontSize = fontSize + 'px';
}

/**
 * Set header font sizes
 * @param {HTMLCollection} element Applicable slide
 * @param {int} width Reveal-element width
 */
function applyHeaderSizes(element, width) {
  var headers = {
    h1: element.getElementsByTagName('h1'),
    h2: element.getElementsByTagName('h2'),
    h3: element.getElementsByTagName('h3'),
    h4: element.getElementsByTagName('h4'),
    h5: element.getElementsByTagName('h5'),
    h6: element.getElementsByTagName('h6')
  };
  var ms = ModularScale({
    ratio: parseFloat(element.dataset.textsizeScale),
    base: getFontSize(parseInt(width)) + 'px'
  })
  var modularScales = {
    h1: ms(6, true),
    h2: ms(5, true),
    h3: ms(4, true),
    h4: ms(3, true),
    h5: ms(2, true),
    h6: ms(1, true)
  };
  Object.entries(headers).forEach(([key, value]) => {
    Array.prototype.forEach.call(value, function (header) {
      header.style.fontSize = modularScales[key] + 'em';
    });
  });
}

/**
 * Apply modular scale logic
 */
function applyModularScale() {
  var currentSlide = document.querySelector('.slides section section.present');
  applyBaseSize(currentSlide, getRevealWidth());
  applyHeaderSizes(currentSlide, getRevealWidth());
}

/* Run after DOM loads */
window.addEventListener("load", function (event) {
  var slides = getSlides('.slides section section.textsizing');
  Object.entries(slides).forEach(([key, value]) => {
    applyBaseSize(value, getRevealWidth());
    applyHeaderSizes(value, getRevealWidth());
  });
}, false);

/* Debounce and throttle */
/* @see https://codepen.io/dreit/pen/gedMez?editors=0010 */
var forLastExec = 100;
var delay = 200;
var throttled = false;
var calls = 0;

/* Run after slide changes size */
window.addEventListener("resize", function () {
  if (!throttled) {
    throttled = true;
    setTimeout(function () {
      throttled = false;
    }, delay);
  }
  clearTimeout(forLastExec);
  forLastExec = setTimeout(applyModularScale, delay);
});