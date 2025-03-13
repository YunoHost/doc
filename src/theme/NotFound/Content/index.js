import React from 'react';
import clsx from 'clsx';
import Translate from '@docusaurus/Translate';
import Heading from '@theme/Heading';

import {useDoc} from '@docusaurus/plugin-content-docs/client';
import Link from '@docusaurus/Link';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons';
library.add(fas)

export default function NotFoundContent({className}) {
  // const {metadata} = useDoc();
  // const {editUrl, lastUpdatedAt, lastUpdatedBy, tags} = metadata;
  const editUrl = "https://pouet.com";

  return (
    <main className={clsx('container margin-vert--xl', className)}>
      <div className="row">
        <div className="col col--6 col--offset-3">
          <Heading as="h1" className="hero__title">
            <Translate
              id="theme.NotFound.title"
              description="The title of the 404 page">
              Page Not Found
            </Translate>
          </Heading>
          <Heading as="h2">
            <Translate
              id="theme.NotFound.p1"
              description="The first paragraph of the 404 page">
            </Translate>
          </Heading>
          <p>
            <Translate
              id="theme.NotFound.p2"
              description="The 2nd paragraph of the 404 page"
              values={{
                heartIcon: (<FontAwesomeIcon icon={["fa", "heart"]}/>),
                editButton: (
                    // <Link to={editUrl}>
                      <Translate
                        id="theme.NotFound.p2.editLinkText"
                        description="The label for the edit page link">
                        editing it
                      </Translate>
                    // </Link>
                )
              }}
              >
            </Translate>
          </p>
        </div>
      </div>
    </main>
  );
}



// fa fa-heart-o pulse


// blogLink: (
//   <Link to="https://docusaurus.io/blog">
//     <Translate
//       id="homepage.visitMyBlog.linkLabel"
//       description="The label for the link to my blog">
//       blog
//     </Translate>
//   </Link>
// ),
