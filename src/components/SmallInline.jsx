import React from 'react';
import useBaseUrl from '@docusaurus/useBaseUrl'

export default function SmallInline({url, alt}) {
  return (<img src={useBaseUrl(url)} width="32" style={{verticalAlign: "middle", margin: "5px"}} alt={alt}/>);
}
