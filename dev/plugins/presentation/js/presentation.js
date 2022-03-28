/**
 * Display visual error-indication.
 * @param {string} message Message to prompt user to reload.
 */
function showError(message) {
  document.getElementById("snackbar-message").innerHTML = message;
  document.getElementById("snackbar").classList.add("visible");
}

/**
 * Hide visual error-indication.
 */
function hideError() {
  if (document.getElementById("snackbar").classList.contains("visible")) {
    document.getElementById("snackbar").classList.remove("visible");
  }
}

/**
 * Get value from GET-parameter.
 * @param {string} parameterName GET-query parameter name.
 */
function findGetParameter(parameterName) {
  var result = null,
    tmp = [];
  location.search
    .substr(1)
    .split("&")
    .forEach(function(item) {
      tmp = item.split("=");
      if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    });
  return result;
}

/**
 * Start a visual clock indicator.
 */
function initClock() {
  var d = new Date();
  var nhour = d.getHours();
  var nmin = d.getMinutes();
  var nsec = d.getSeconds();
  if (nmin <= 9) {
    nmin = "0" + nmin;
  }
  if (nsec <= 9) {
    nsec = "0" + nsec;
  }
  var clocktext = "" + nhour + ":" + nmin + ":" + nsec + "";
  document.getElementById("clockbox").innerHTML = clocktext;
}

/**
 * Format a date in ISO-format
 * @param {Date} d Date-instance
 *
 * @see https://stackoverflow.com/a/12550320/603387
 */
function ISODateString(d) {
  function pad(n) {
    return n < 10 ? "0" + n : n;
  }
  return (
    pad(d.getHours()) + ":" + pad(d.getMinutes()) + ":" + pad(d.getSeconds())
  );
}

/**
 * Find closest number
 * @param {float} number Number to search for
 * @param {array} array Numbers to search in
 *
 * @see https://jsfiddle.net/jaggedsoftware/g40krr4n/
 */
function getClosest(number, array) {
  var current = array[0];
  var difference = Math.abs(number - current);
  var index = array.length;
  while (index--) {
    var newDifference = Math.abs(number - array[index]);
    if (newDifference < difference) {
      difference = newDifference;
      current = array[index];
    }
  }
  return current;
}

/**
 * Get Slides
 */
function getSlides(target = ".slides section section") {
  return document.querySelectorAll(target);
}

function elevateIframe(event) {
  if (
    "backgroundIframe" in event.currentSlide.dataset &&
    "backgroundInteractive" in event.currentSlide.dataset &&
    event.currentSlide.dataset.backgroundIframe.length > 0
  ) {
    document
      .querySelector(".reveal .backgrounds")
      .style.setProperty("z-index", "2");
    document
      .querySelector(".reveal .controls")
      .style.setProperty("z-index", "3");
  } else {
    document
      .querySelector(".reveal .backgrounds")
      .style.removeProperty("z-index");
    document.querySelector(".reveal .controls").style.removeProperty("z-index");
  }
}

/* If printing, clear color and background*/
window.addEventListener(
  "load",
  function(event) {
    if (findGetParameter("print-pdf")) {
      Array.prototype.forEach.call(getSlides(), function(element) {
        element.style.setProperty("color", "unset", "important");
        element.style.setProperty("background", "unset", "important");
      });
    }
  },
  false
);
