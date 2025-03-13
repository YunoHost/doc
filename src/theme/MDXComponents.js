import React from 'react';
// Import the original mapper
import MDXComponents from '@theme-original/MDXComponents';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { fas } from '@fortawesome/free-solid-svg-icons';

// Add all icons to the library so you can use them without importing them individually.
library.add(fab, fas);

export default {
  // Re-use the default mapping
  ...MDXComponents,
  FAIcon: FontAwesomeIcon,
};
