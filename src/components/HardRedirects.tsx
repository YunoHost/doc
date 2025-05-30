import React from "react";
import Layout from "@theme/Layout";
import Head from "@docusaurus/Head";
import { useDoc } from "@docusaurus/plugin-content-docs/client";
import Translate, { translate } from "@docusaurus/Translate";
import Link from "@docusaurus/Link";

export default function HardRedirect({ url }: { url: string }) {
  return (
    <Head>
      <meta http-equiv="refresh" content={"0; url=" + url}></meta>
    </Head>
  );
}

export function DocumentedHardRedirect({
  url,
  description,
}: {
  url: string;
  description: string;
}) {
  return (
    <span>
      <HardRedirect url={url} />
      <Translate values={{ url: url, description: description }}>
        {
          "You will be redirected soon to {description}. If that doesn't work, please go to: "
        }
      </Translate>
      <Link>{url}</Link>
    </span>
  );
}

export function LangUrl({ lang }: { lang: string }) {
  const location = useDoc().metadata.id;
  const newLocation = `/${lang}/${location}`;
  return newLocation;
}

export function LangRedirect({ lang }: { lang: string }) {
  return <HardRedirect url={LangUrl({ lang })} />;
}
