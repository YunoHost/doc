import React, { ReactNode } from "react";
import clsx from "clsx";

export default function Column({
  children,
  className,
  style,
}: {
  children: ReactNode;
  className: any;
  style: any;
}) {
  return (
    <div className={clsx("col", className)} style={style}>
      {children}
    </div>
  );
}
