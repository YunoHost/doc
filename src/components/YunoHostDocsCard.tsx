import React, { ReactNode } from "react";
import clsx from "clsx";

import Link from "@docusaurus/Link";
import Heading from "@theme/Heading";

import styles from "./YunoHostDocsCard.module.css";

export function YunoHostDocsCard({ children }: { children: ReactNode }) {
  return (
    <div className="col col--6 margin-bottom--lg">
      <div className={clsx("card", styles.ynhCardContainer)}>{children}</div>
    </div>
  );
}

export function YunoHostDocsCardHeading({
  children,
  url,
  color,
}: {
  children: ReactNode;
  url: string;
  color: string;
}) {
  return (
    <Link to={url} style={{ marginBottom: "1rem" }}>
      <div
        className="card__body"
        style={{ backgroundColor: color, color: "white" }}
      >
        <Heading as="h3">{children}</Heading>
      </div>
    </Link>
  );
}
