import React from 'react';
import {Redirect, useLocation} from '@docusaurus/router';

export function LangRedirect({lang}) {
  const location = useLocation();
  const newLocation = "/" + lang + location.pathname;
  return <Redirect to={newLocation} />;
}
