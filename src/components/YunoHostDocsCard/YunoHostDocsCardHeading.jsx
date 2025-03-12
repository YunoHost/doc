import React from 'react';
import Link from '@docusaurus/Link';
import Heading from '@theme/Heading';

export default function YunoHostDocsCardHeading({children, url, color}) {
  return (
    <Link to={url} style={{marginBottom: "1rem"}}>
      <div class="card__body" style={{backgroundColor: color, color: 'white'}}>
      <Heading as="h3">
        {children}
      </Heading>
      </div>
    </Link>
  )
}
