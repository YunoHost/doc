import React from 'react';
import { renderToString } from 'react-dom/server'

import { FontAwesomeIcon as FAIcon } from '@fortawesome/react-fontawesome'; // Import the FontAwesomeIcon component.
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
library.add(fas);

import YunoHostDocsCard from '@site/src/components/YunoHostDocsCard';

export default function YunoHostImagesList({hardware}) {
  return (
    <div>
      <div id="cards-list" className={hardware}>
      </div>
    </div>
  )
}

export function YunoHostImagesListElement() {
  return (
    <YunoHostDocsCard>
      <div>
        <h3>_name_</h3>
        <div className="card-comment">_comment_</div>
        <div className="card-desc text-center">
          <img src="/img/_image_" height="100" style={{verticalAlign: "middle"}}/>
        </div>
      </div>
      <div className="annotations flex-container">
        <div className="flex-child annotation"><a href="_file_.sha256sum"><FAIcon icon="fa-barcode"/> Checksum</a></div>
        <div className="flex-child annotation"><a href="_file_.sig"><FAIcon icon="fa-tag"/> Signature</a></div>
      </div>
      <div className="btn-group" role="group">
        <a href="_file_" target="_BLANK" type="button" className="btn btn-info col-sm-12"><FAIcon icon="fa-download"/> Download <small>_version_</small></a>
      </div>
    </YunoHostDocsCard>
  )
}

/* This code runs client-side, called by YunoHostImagesListScript.js / onRouteDidUpdate
 * Dunno how it works but it does!
 */
export function generateImagesList() {
  const list_div = document.getElementById('cards-list');
  if (!list_div) {
    return;
  }
  const hardware = list_div.className;

  fetch('https://repo.yunohost.org/images/images.json').then(
    (response) => response.json()).then(
      (responseJson) => {
        Object.keys(responseJson).forEach(function(key) {
          const infos = responseJson[key];

          if (infos.hide == true) { return; }
          if (infos.tuto.indexOf(hardware) == -1) return;

          if (!infos.file.startsWith("http"))
            infos.file="https://repo.yunohost.org/images/"+infos.file;

          // Fill the template
          var html = renderToString(YunoHostImagesListElement())
          .replaceAll('_id_', infos.id)
          .replaceAll('_name_', infos.name)
          .replaceAll('_image_', infos.image)
          .replaceAll('_comment_', infos.comment || "&nbsp;")
          .replaceAll('%7Bimage%7D', infos.image)
          .replaceAll('_version_', infos.version)
          .replaceAll(/%7Bfile%7D/g, infos.file)
          .replaceAll(/_file_/g, infos.file);

          if ((typeof(infos.has_sig_and_sums) !== 'undefined') && infos.has_sig_and_sums == false) {
            var $html = $(html);
            $html.find(".annotations").html("&nbsp;");
            html = $html[0];
          }
          list_div.insertAdjacentHTML('beforeend', html);
        })
      }
    ).catch((error) => {
      console.error(error);
    });

}
