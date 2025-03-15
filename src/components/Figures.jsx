/* eslint-disable react/prop-types,import/no-unresolved */
import React from 'react'
import useBaseUrl from '@docusaurus/useBaseUrl'

export default function Figure({ src, caption }) {
  return (
    <div>
    <figure style={{ padding: 20 }}>
      <img src={useBaseUrl(src)} alt={caption} />
      <figcaption style={{textAlign: "center", fontStyle: "italic"}}>{`${caption}`}</figcaption>
    </figure>
    </div>
  )
}
