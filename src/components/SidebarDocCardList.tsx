/**
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

import React, { type ReactNode } from "react";
import clsx from "clsx";
import {
  filterDocCardListItems,
  useDoc,
  useDocsSidebar,
} from "@docusaurus/plugin-content-docs/client";
import DocCard from "@theme/DocCard";
import type { Props } from "@theme/DocCardList";

function SidebarDocCardListFull({ className }: Props) {
  const sidebar = useDocsSidebar();

  // Filter self
  const page = useDoc().metadata.title;
  const items = sidebar?.items.filter((item) => {
    if ("label" in item && item.label === page) {
      return false;
    }
    return true;
  });

  return <SidebarDocCardList items={items} className={className} />;
}

export default function SidebarDocCardList(props: Props): ReactNode {
  const { items, className } = props;
  if (!items) {
    return <SidebarDocCardListFull {...props} />;
  }
  const filteredItems = filterDocCardListItems(items);
  return (
    <section className={clsx("row", className)}>
      {filteredItems.map((item, index) => (
        <article key={index} className="col col--6 margin-bottom--lg">
          <DocCard item={item} />
        </article>
      ))}
    </section>
  );
}
