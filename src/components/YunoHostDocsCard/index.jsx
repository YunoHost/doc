
import React from 'react';
import clsx from 'clsx';

export default function YunoHostDocsCard({children}) {
  return (
    <div className="col col--6 margin-bottom--lg">
      <div className={clsx('card')} style={{textAlign: 'center'}}>
        {children}
      </div>
    </div>
  );
}
