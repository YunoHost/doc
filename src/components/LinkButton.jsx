import React from 'react';
import Link from '@docusaurus/Link';
import Heading from '@theme/Heading';

export default function LinkButton({children, url, color}) {
  return (
    <Link to={url}>
        <div style={{
            marginBottom: "1rem",
            backgroundColor: color,
            borderRadius: '4px',
            padding: '0.6rem',
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
