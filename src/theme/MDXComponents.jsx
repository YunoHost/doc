import React from 'react';
// Import the original mapper
import MDXComponents from '@theme-original/MDXComponents';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { fas } from '@fortawesome/free-solid-svg-icons';

import Columns from '@site/src/components/Columns';
import Column from '@site/src/components/Column';

// Add all icons to the library so you can use them without importing them individually.
library.add(fab, fas);

export default {
  // Re-use the default mapping
  ...MDXComponents,
  Columns,
  Column,
  FAIcon: FontAwesomeIcon,
};
