/**
 * Continual querying of a set route, executing Reveal.js events in callback through Axios
 */
function poll() {
  var now = new Date();
  axios
    .get(location.origin + presentationAPIRoute, {
      params: {
        action: "poll",
        mode: "get"
      }
    })
    .then(function(response) {
      if (response.data.hasOwnProperty("command")) {
        console.info(
          "Ping at " + ISODateString(now) + ", " + response.status + " OK"
        );
        var data = response.data;
        try {
          switch (data.command) {
            case "slidechanged":
              Reveal.slide(data.indexh, data.indexv);
              break;
            case "fragmentshown":
              Reveal.slide(data.indexh, data.indexv, data.indexf);
              break;
            case "fragmenthidden":
              Reveal.slide(data.indexh, response.data.indexv, data.indexf);
              break;
          }
        } catch (error) {
          console.error(error);
        }
      } else {
        console.info("Ping at " + ISODateString(now) + ": " + response.status);
      }
    })
    .catch(function(error) {
      console.error(error);
      pollingErrors++;
      showError("Connection failure.");
    });
  if (pollingErrors >= presentationAPIRetryLimit) {
    console.warn("Retry limit reached at " + ISODateString(now));
    return;
  } else {
    setTimeout(poll, presentationAPITimeout);
  }
}

/**
 * Handle data-input from master, using Axios
 */
var revealMasterEventHandler = function(event) {
  var request = {
    command: event.type,
    indexh: event.indexh,
    indexv: event.indexv,
    indexf: event.indexf ? event.indexf : 0
  };

  if (presentationAPIAuth == "true") {
    if (findGetParameter("token") !== presentationAuthToken) {
      return;
    }
  }

  axios.defaults.params = {
    action: "poll",
    mode: "set",
    data: encodeURIComponent(JSON.stringify(request))
  };
  if (presentationAuthToken) {
    axios.defaults.params["token"] = presentationAuthToken;
  }
  axios
    .get(location.origin + presentationAPIRoute)
    .then(function(response) {
      var now = new Date();
      console.info(
        "Action at " + ISODateString(now) + ", " + response.data.command
      );
    })
    .catch(function(error) {
      console.error(error);
      showError("Connection failure.");
    });
};

/**
 * Handle changes in slave
 */
var revealSlaveEventHandler = function(event) {
  var now = new Date();
  console.info("Action at " + ISODateString(now) + ", " + event.type);
};

/* If Admin, handle input, otherwise poll server */
var pollingErrors = 0;
window.addEventListener(
  "load",
  function(event) {
    if (findGetParameter("admin") == "true") {
      Reveal.addEventListener("slidechanged", revealMasterEventHandler);
      Reveal.addEventListener("fragmentshown", revealMasterEventHandler);
      Reveal.addEventListener("fragmenthidden", revealMasterEventHandler);
    } else {
      Reveal.addEventListener("slidechanged", revealSlaveEventHandler);
      Reveal.addEventListener("fragmentshown", revealSlaveEventHandler);
      Reveal.addEventListener("fragmenthidden", revealSlaveEventHandler);
      poll();
    }
  },
  false
);
