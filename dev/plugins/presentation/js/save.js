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
 * Save raw Markdown via API
 */
function presentationSaveRawMarkdown() {
  var now = new Date();
  var autoSaveButton = document.querySelector("#presentation-save");
  var autoSaveButtonContent = autoSaveButton.innerHTML;
  var markdownContent = document.querySelector('textarea[name="data[content]"]')
    .value;
  var lastSaved = document.querySelector("#last-saved");
  var lastSavedValue = document.querySelector("#last-saved-value");
  autoSaveButton.style.background = presentationColors.update;
  autoSaveButton.innerHTML =
    '<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Saving';
  autoSaveButton.disabled = true;
  axios
    .post(
      presentationAPIRoute + "?action=save",
      {
        content: Base64.encode(markdownContent),
        route: window.GravAdmin.config.route
      },
      {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8"
        }
      }
    )
    .then(function(response) {
      if (response.status == 200) {
        console.info("Saved at", now, response.status, "OK");
        const forms = Grav.default.Forms;
        forms.FormState.Instance = new forms.FormState.FormState();
        autoSaveButton.style.background = presentationColors.notice;
        autoSaveButton.innerHTML = '<i class="fa fa-check"></i> Saved';
        lastSaved.style.display = "block";
        lastSavedValue.innerHTML = ISODateString(now);
      }
    })
    .catch(function(error) {
      console.error(error);
      autoSaveButton.style.background = presentationColors.critical;
      autoSaveButton.innerHTML = '<i class="fa fa-close"></i> Failed';
      autoSaveButton.disabled = false;
    })
    .then(function() {
      setTimeout(function() {
        autoSaveButton.style.background = presentationColors.button;
        autoSaveButton.innerHTML = autoSaveButtonContent;
        autoSaveButton.disabled = false;
      }, 500);
    });
}

var presentationPollingErrors = 0;
var presentationColors = {
  button: "#0090D9",
  notice: "#06A599",
  update: "#77559D",
  critical: "#F45857"
};
window.addEventListener(
  "load",
  function(event) {
    var autoSaveButton = document.querySelector("#presentation-save");
    if (autoSaveButton) {
      autoSaveButton.addEventListener(
        "click",
        function(event) {
          presentationSaveRawMarkdown();
          event.preventDefault();
        },
        false
      );
    }

    document.addEventListener("keydown", function(event) {
      if (
        (event.ctrlKey || event.metaKey) &&
        event.shiftKey &&
        event.code === "KeyS"
      ) {
        presentationSaveRawMarkdown();
        event.preventDefault();
      }
    });

    if (presentationAdminAsyncSaveTyping === 1) {
      var markdownContent = document.querySelector(
        'textarea[name="data[content]"]  + .CodeMirror'
      );

      /* Debounce and throttle */
      /* @see https://codepen.io/dreit/pen/gedMez?editors=0010 */
      var forLastExec = 100;
      var delay = 500;
      var throttled = false;
      var calls = 0;

      if (markdownContent) {
        markdownContent.onkeyup = function() {
          if (!throttled) {
            throttled = true;
            setTimeout(function() {
              throttled = false;
            }, delay);
          }
          clearTimeout(forLastExec);
          forLastExec = setTimeout(presentationSaveRawMarkdown, delay);
        };
      }
    }
  },
  false
);
