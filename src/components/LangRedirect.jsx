import React from 'react';
import {useDoc} from '@docusaurus/plugin-content-docs/client';
import HardRedirect from '@site/src/components/HardRedirect';

export default function LangRedirect({lang}) {
  const location = useDoc().metadata.id;
  const newLocation = `/${lang}/${location}`;
  return <HardRedirect url={newLocation}/>
}
