import React from "react";
import clsx from "clsx";
import { renderToString } from "react-dom/server";
import Heading from "@theme/Heading";
import Layout from "@theme/Layout";

import styles from "./YunoHostDocsCard.module.css";

import { FontAwesomeIcon as FAIcon } from "@fortawesome/react-fontawesome"; // Import the FontAwesomeIcon component.
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
library.add(fas);

import {
  YunoHostDocsCard,
  YunoHostDocsCardHeading,
} from "@site/src/components/YunoHostDocsCard";
import Link from "@docusaurus/Link";

export default function YunoHostImagesList({ hardware }: { hardware: string }) {
  return (
    <div id="cards-list" className={hardware}>
      <div className="row"></div>
    </div>
  );
}

export function YunoHostImagesListElement() {
  return (
    <div className="col col--4">
      <div className={clsx("card", styles.ynhCardContainer)}>
        <div className="card__body">
          <Heading as="h3" style={{ margin: "0px" }}>
            _name_
          </Heading>
          <div style={{ fontSize: "80%" }}>_comment_</div>
        </div>
        <div className="card__body">
          <img src="/img/icons/icon-_image_" style={{ height: "100px" }} />
        </div>

        <div className="card__body">
          <a href="_file_.sha256sum">
            <FAIcon icon="barcode" /> Checksum
          </a>
          {" | "}
          <a href="_file_.sig">
            <FAIcon icon="tag" /> Signature
          </a>
        </div>

        <a
          href="_file_"
          className="card__body"
          style={{
            backgroundColor: "rgba(128, 128, 128, 0.2)",
            textAlign: "center",
            marginTop: "0.5em",
          }}
        >
          <FAIcon icon="download" /> Download <small>_version_</small>
        </a>
      </div>
    </div>
  );
}

/* This code runs client-side, called by YunoHostImagesListScript.js / onRouteDidUpdate
 * Dunno how it works but it does!
 */
export function generateImagesList() {
  const hardware_div = document.getElementById("cards-list");
  if (!hardware_div) {
    return;
  }
  const hardware = hardware_div.className;
  const list_div = hardware_div.firstChild;

  fetch("https://repo.yunohost.org/images/images.json")
    .then((response) => response.json())
    .then((responseJson) => {
      Object.keys(responseJson).forEach(function (key) {
        const infos = responseJson[key];

        if (infos.hide == true) {
          return;
        }
        if (infos.tuto.indexOf(hardware) == -1) return;

        if (!infos.file.startsWith("http"))
          infos.file = "https://repo.yunohost.org/images/" + infos.file;

        // Fill the template
        var html = renderToString(YunoHostImagesListElement())
          .replaceAll("_id_", infos.id)
          .replaceAll("_name_", infos.name)
          .replaceAll("_image_", infos.image)
          .replaceAll("_comment_", infos.comment || "&nbsp;")
          .replaceAll("%7Bimage%7D", infos.image)
          .replaceAll("_version_", infos.version)
          .replaceAll(/%7Bfile%7D/g, infos.file)
          .replaceAll(/_file_/g, infos.file);

        if (
          typeof infos.has_sig_and_sums !== "undefined" &&
          infos.has_sig_and_sums == false
        ) {
          var $html = $(html);
          $html.find(".annotations").html("&nbsp;");
          html = $html[0];
        }
        list_div?.insertAdjacentHTML("beforeend", html);
      });
    })
    .catch((error) => {
      console.error(error);
    });
}
