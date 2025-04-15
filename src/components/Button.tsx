import React, { ReactNode, CSSProperties } from 'react';
import clsx from 'clsx';
import Link from '@docusaurus/Link';

export default function Button({children, url, color}) {
  return (
    <Link to={url}>
        <div style={{
            marginBottom: "1rem",
            backgroundColor: color,
            borderRadius: '4px',
            padding: '0.6rem',
            paddingLeft: '1rem',
            paddingRight: '1rem',
            width: 'auto',
            display: 'inline-block',
            textAlign: 'center',
            color: 'black',
            mixBlendMode: 'difference'
            }}>
        {children}
        </div>
    </Link>
  )
}
