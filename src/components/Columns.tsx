import React, { CSSProperties, ReactNode } from "react";
import clsx from "clsx";

export default function Columns({
  children,
  className,
  style,
}: {
  children: ReactNode;
  className: string;
  style: CSSProperties;
}) {
  return (
    <div className="container center">
      <div className={clsx("row", className)} style={style}>
        {children}
      </div>
    </div>
  );
}
