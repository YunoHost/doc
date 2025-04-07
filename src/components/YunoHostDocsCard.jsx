import React from 'react';
import clsx from 'clsx';

import Link from '@docusaurus/Link';
import Heading from '@theme/Heading';

import styles from './YunoHostDocsCard.module.css';


export function YunoHostDocsCard({children}) {
  return (
    <div className="col col--6 margin-bottom--lg">
      <div className={clsx('card', styles.ynhCardContainer)}>
        {children}
      </div>
    </div>
  );
}

export function YunoHostDocsCardHeading({children, url, color}) {
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
