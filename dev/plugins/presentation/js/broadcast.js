/**
 * Register and broadcast events between windows. If admin, post events, otherwise handle them.
 */
var bc = new BroadcastChannel('grav-presentation');
window.addEventListener("load", function (event) {
  if (findGetParameter('admin') == 'true') {
    Reveal.addEventListener('slidechanged', function (event) {
      if (presentationAPIAuth == 'true') {
        if (findGetParameter('token') !== presentationAuthToken) {
          return;
        }
      }
      var now = new Date();
      console.info('Action at ' + ISODateString(now) + ', slidechanged');
      bc.postMessage({
        indexh: event.indexh,
        indexv: event.indexv,
        indexf: typeof event.indexf !== 'undefined' ? event.indexf : 0
      });
    });
  } else {
    bc.onmessage = function (event) {
      var now = new Date();
      console.info('Action at ' + ISODateString(now) + ', slidechanged');
      Reveal.slide(event.data.indexh, event.data.indexv, event.data.indexf);
    }
  }
}, false);