---
title: Cleanup
template: docs
taxonomy:
    category: docs
routes:
  default: '/cleanup'
---

These are a few guidelines on how to perform some cleanup on the server, for instance when storage space becomes a bit short.

# Execute the basic-space-cleanup tool

One may use the following command, to perform basic space cleanup (apt, journalctl, logs, ...) :
`sudo yunohost tools basic-space-cleanup`

Additional steps may be needed, to address current shortcomings : see https://github.com/YunoHost/issues/issues/2329 for instance.
