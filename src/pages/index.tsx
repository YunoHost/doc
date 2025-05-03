import React from 'react'
import type {ReactNode} from 'react';
import clsx from 'clsx';
import Link from '@docusaurus/Link';
import useDocusaurusContext from '@docusaurus/useDocusaurusContext';
import Layout from '@theme/Layout';
import Heading from '@theme/Heading';
import Translate, {translate} from '@docusaurus/Translate';

import styles from './index.module.css';


function HomepageHeader() {
  const {siteConfig} = useDocusaurusContext();
  return (
    <center>
      <br/>
      <img src={require('!!url-loader!/img/icons/logo-ynh.svg').default}
        alt={translate({ message: "YunoHost logo" })} id="ynhlogo" style={{ width: "9rem" }}/>

      <p className="hero__subtitle">{translate({ message: "Learn how to self-host!" })}</p>

      <div className={styles.buttons}><br/>
          <Link
              className="button button--secondary button--lg"
              to="/admin/install"
              style={{ backgroundColor: `rgb(76, 195, 74)`}}>
              <Translate
                  id="homepage.link.item.label.Install Documentation"
                  description="The label for the link to Install documentation">
                  Install YunoHost !
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
