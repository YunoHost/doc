import React from 'react'
import type {ReactNode} from 'react';
import clsx from 'clsx';
import Link from '@docusaurus/Link';
import useDocusaurusContext from '@docusaurus/useDocusaurusContext';
import Layout from '@theme/Layout';
import Heading from '@theme/Heading';
import Translate from '@docusaurus/Translate';

import styles from './index.module.css';


function HomepageHeader() {
  const {siteConfig} = useDocusaurusContext();
  return (
    <center>
      <br/><br/>

      <img src={require('/img/icons/logo-ynh_horizontal.png').default}
        alt="YunoHost logo" id="ynhlogo" style={{ width: 400 }}/>

      {/* <Heading as="h1" className="hero__title">
        <Translate id="homepage.title">Documentation</Translate>
      </Heading> */}

      <p className="hero__subtitle">{siteConfig.tagline}</p>

      <div className={styles.buttons}><br/>
          <Link
              className="button button--secondary button--lg"
              to="/admin/install"
              style={{ backgroundColor: `rgb(76, 195, 74)`}}>
              <Translate
                  id="homepage.link.item.label.Install Documentation"
                  description="The label for the link to Install documentation">
                  Install !
              </Translate>
          </Link>
      </div>
      <br/>
      <div className={styles.buttons}>
          <Link
              className="button button--secondary button--lg"
              to="/user">
              <Translate
                  id="homepage.link.item.label.User Documentation"
                  description="The label for the link to user documentation">
                  User Documentation
              </Translate>
          </Link>
      </div>
      <br/>
      <div className={styles.buttons}>
          <Link
              className="button button--secondary button--lg"
              to="/admin">
              <Translate
                  id="homepage.link.item.label.Admin Documentation"
                  description="The label for the link to admin documentation">
                  Admin Documentation
              </Translate>
          </Link>
      </div>
      <br/>
      <div className={styles.buttons}>
          <Link
              className="button button--secondary button--lg"
              to="/dev/">
              <Translate
                  id="homepage.link.item.label.Developer Documentation"
                  description="The label for the link to developer documentation">
                  Developer Documentation
              </Translate>
          </Link>
      </div>
      <br/>
      <div className={styles.buttons}>
          <Link
              className="button button--secondary button--lg"
              to="/dev/">
              <Translate
                  id="homepage.link.item.label.Packaging Documentation"
                  description="The label for the link to Packaging documentation">
                  Packaging Documentation
              </Translate>
          </Link>
      </div>
    </center>
  );
}

export default function Home(): ReactNode {
  const {siteConfig} = useDocusaurusContext();
  return (
    <Layout
      title={`${siteConfig.title}`}
      description="Semalibre SCOP <head />">
      <HomepageHeader />
      {/* <main>
        <HomepageFeatures />
      </main> */}
    </Layout>
  );
}
