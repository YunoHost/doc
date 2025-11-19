import React, { ReactNode, CSSProperties } from "react";
import clsx from "clsx";
import Link from "@docusaurus/Link";

export default function Button({
  children,
  url,
  backgroundColor,
  border,
  color,
  padding,
  margin,
}: {
  children: ReactNode;
  url: string;
  backgroundColor: string;
  border: string;
  color: string;
  padding: string;
  margin: string;
}) {
  return (
    <Link to={url}>
      <div
        style={{
          marginBottom: "1rem",
          backgroundColor: backgroundColor ? backgroundColor : "var(--ifm-card-background-color)",
          border: border ? border : "1px solid var(--ifm-color-emphasis-300)",
          borderRadius: "4px",
          padding: padding ? padding : "0.7rem 1.6rem",
          margin: margin ? margin : '0 0.5rem 1rem 0.5rem',
          width: "auto",
          display: "inline-block",
          textAlign: "center",
          color: color ? color : "var(--ifm-color-emphasis-800)",
          fontWeight: "bold",
        }}
      >
        {children}
      </div>
    </Link>
  );
}
